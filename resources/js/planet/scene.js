import * as THREE from 'three';

/**
 * Smooth planet backdrop — no GLTF/Draco (those freeze the main thread).
 * Uses a lightweight textured sphere + CSS space fallback until ready.
 */
export function initPlanetScene(canvas) {
  if (!canvas || canvas.dataset.planetReady === '1') return null;
  canvas.dataset.planetReady = '1';

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.matchMedia('(max-width: 720px)').matches;
  const isHome = document.body?.dataset?.page === 'home' || window.location.pathname === '/';

  // Local blue-marble maps (realistic ocean/land colors, no CDN CORS issues)
  const TEX = {
    day: '/assets/planet/earth-day.jpg',
    night: '/assets/planet/earth-night.jpg',
    clouds: '/assets/planet/earth-clouds.png',
  };

  const CONFIG = {
    glowColor: '#5b8cff',
    glowIntensity: 1.35,
    planetRadius: 1.95,
    spin: 0.022,
    initRotation: 2.07,
    tilt: 0.37,
    cloudHeight: 1.018,
    cloudOpacity: 0.32,
    cloudSpin: 0.05,
    bgColor: '#040a1e',
    starColor: '#cfe0ff',
    starCount: isMobile ? 60 : isHome ? 140 : 100,
    starSize: 1.4,
  };

  const STOPS_X = [
    { p: 0, v: 0 },
    { p: 0.32, v: -2.4 },
    { p: 0.64, v: 2.5 },
    { p: 1, v: 0 },
  ];
  const STOPS_Y = [
    { p: 0, v: -4.2 },
    { p: 0.32, v: 0.5 },
    { p: 0.64, v: 0.4 },
    { p: 1, v: 0.15 },
  ];
  const STOPS_S = [
    { p: 0, v: 2.0 },
    { p: 0.32, v: 1.0 },
    { p: 0.64, v: 0.94 },
    { p: 1, v: 1.08 },
  ];

  const lerp = (a, b, t) => a + (b - a) * t;
  const clamp = (v, lo, hi) => Math.max(lo, Math.min(hi, v));
  const hexToVec3 = (hex) => {
    const c = new THREE.Color(hex);
    return new THREE.Vector3(c.r, c.g, c.b);
  };
  const sample = (stops, p) => {
    if (p <= stops[0].p) return stops[0].v;
    if (p >= stops[stops.length - 1].p) return stops[stops.length - 1].v;
    for (let i = 0; i < stops.length - 1; i++) {
      const a = stops[i];
      const b = stops[i + 1];
      if (p >= a.p && p <= b.p) {
        let t = (p - a.p) / (b.p - a.p);
        t = t * t * (3 - 2 * t);
        return lerp(a.v, b.v, t);
      }
    }
    return stops[stops.length - 1].v;
  };

  const nextFrame = () => new Promise((r) => requestAnimationFrame(() => r()));
  const waitIdle = (ms = 48) =>
    new Promise((r) => {
      if ('requestIdleCallback' in window) {
        requestIdleCallback(() => r(), { timeout: ms });
      } else {
        setTimeout(r, ms);
      }
    });

  const maxDpr = isMobile ? 1 : Math.min(window.devicePixelRatio || 1, 1.15);
  const renderer = new THREE.WebGLRenderer({
    canvas,
    antialias: false,
    powerPreference: 'high-performance',
    alpha: false,
  });
  renderer.setPixelRatio(maxDpr);
  renderer.setSize(window.innerWidth, window.innerHeight, false);
  renderer.outputEncoding = THREE.sRGBEncoding;
  renderer.shadowMap.enabled = false;
  renderer.setClearColor(CONFIG.bgColor, 1);

  const scene = new THREE.Scene();
  scene.background = new THREE.Color(CONFIG.bgColor);

  const camera = new THREE.PerspectiveCamera(40, window.innerWidth / window.innerHeight, 0.1, 200);
  camera.position.set(0, 0, 8);
  scene.add(camera);

  // Soft fill + warm sun — keeps greens/browns from blowing out to white
  scene.add(new THREE.AmbientLight(0x8fa8c8, 0.45));
  const sun = new THREE.DirectionalLight(0xfff2dd, 1.55);
  sun.position.set(6, 3.2, 4);
  scene.add(sun);
  const fill = new THREE.DirectionalLight(0x6a8cff, 0.25);
  fill.position.set(-4, -1, -2);
  scene.add(fill);

  let starTime = 0;
  let starMat = null;
  let starResU = null;

  const worldGroup = new THREE.Group();
  worldGroup.position.set(STOPS_X[0].v, STOPS_Y[0].v, 0);
  worldGroup.scale.setScalar(STOPS_S[0].v);
  scene.add(worldGroup);

  const planetGroup = new THREE.Group();
  planetGroup.rotation.z = CONFIG.tilt;
  worldGroup.add(planetGroup);

  const cloudGroup = new THREE.Group();
  cloudGroup.rotation.z = CONFIG.tilt;
  cloudGroup.visible = false;
  worldGroup.add(cloudGroup);

  const glowMat = new THREE.ShaderMaterial({
    transparent: true,
    side: THREE.DoubleSide,
    depthWrite: false,
    blending: THREE.AdditiveBlending,
    uniforms: {
      uGlow: { value: hexToVec3(CONFIG.glowColor) },
      uIntensity: { value: CONFIG.glowIntensity },
    },
    vertexShader: `varying vec2 vUv; void main(){ vUv=uv; gl_Position = projectionMatrix*modelViewMatrix*vec4(position,1.0); }`,
    fragmentShader: `
      uniform vec3 uGlow; uniform float uIntensity; varying vec2 vUv;
      void main(){
        float d = length(vUv - 0.5) * 2.0;
        float a = pow(clamp(1.0 - d, 0.0, 1.0), 2.2);
        gl_FragColor = vec4(uGlow * a * uIntensity, a);
      }`,
  });
  const glowMesh = new THREE.Mesh(new THREE.PlaneGeometry(2, 2), glowMat);
  glowMesh.scale.setScalar(CONFIG.planetRadius * 2.25);
  worldGroup.add(glowMesh);

  {
    const count = CONFIG.starCount;
    const positions = new Float32Array(count * 3);
    const seeds = new Float32Array(count);
    const brights = new Float32Array(count);
    for (let i = 0; i < count; i++) {
      const u = Math.random();
      const v = Math.random();
      const theta = 2 * Math.PI * u;
      const phi = Math.acos(2 * v - 1);
      const r = 90;
      positions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
      positions[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
      positions[i * 3 + 2] = r * Math.cos(phi);
      seeds[i] = Math.random() * 100;
      brights[i] = 0.35 + Math.random() * 0.65;
    }
    const geo = new THREE.BufferGeometry();
    geo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    geo.setAttribute('seed', new THREE.BufferAttribute(seeds, 1));
    geo.setAttribute('bright', new THREE.BufferAttribute(brights, 1));
    starMat = new THREE.ShaderMaterial({
      transparent: true,
      depthWrite: false,
      depthTest: true,
      blending: THREE.AdditiveBlending,
      uniforms: {
        uTime: { value: 0 },
        uSize: { value: CONFIG.starSize },
        uFlicker: { value: 0.55 },
        uColor: { value: hexToVec3(CONFIG.starColor) },
        uRes: { value: new THREE.Vector2(window.innerWidth, window.innerHeight) },
      },
      vertexShader: `
        attribute float seed; attribute float bright;
        uniform float uTime; uniform float uSize; uniform float uFlicker; uniform vec2 uRes;
        varying float vTw;
        void main(){
          vec4 mv = modelViewMatrix * vec4(position, 1.0);
          float tw = 0.7 + 0.3 * sin(uTime * uFlicker + seed);
          vTw = bright * tw;
          gl_PointSize = max(uSize * uRes.y / 900.0 * (90.0 / max(-mv.z, 1.0)), 1.0);
          gl_Position = projectionMatrix * mv;
        }`,
      fragmentShader: `
        uniform vec3 uColor; varying float vTw;
        void main(){
          vec2 p = gl_PointCoord - 0.5; float l = length(p); if (l > 0.5) discard;
          float core = smoothstep(0.5, 0.0, l);
          gl_FragColor = vec4(uColor, core * vTw);
        }`,
    });
    starResU = starMat.uniforms.uRes;
    const stars = new THREE.Points(geo, starMat);
    stars.frustumCulled = false;
    scene.add(stars);
  }

  const segs = isMobile ? 32 : 48;
  const placeholderMat = new THREE.MeshStandardMaterial({
    color: 0x1c6a9e,
    roughness: 0.88,
    metalness: 0,
    emissive: 0x082038,
    emissiveIntensity: 0.2,
    transparent: true,
    opacity: 1,
  });
  const sharedGeo = new THREE.SphereGeometry(CONFIG.planetRadius, segs, segs);
  const placeholderPlanet = new THREE.Mesh(sharedGeo, placeholderMat);
  planetGroup.add(placeholderPlanet);

  let cloudMesh = null;
  let earthMesh = null;
  let fadeT = null;
  const FADE_MS = 700;
  let entryStart = null;
  const ENTRY_DUR = 1.4;
  const ENTRY_START_Y = -5.2;
  let planetLoaded = false;

  let sceneRevealed = false;
  let curP = 0;
  let curX = STOPS_X[0].v;
  let curY = STOPS_Y[0].v;
  let curS = STOPS_S[0].v;
  let spinPhase = 0;
  let lastT = performance.now();
  let visible = !document.hidden;
  let rafId = 0;
  const FRAME_MS = isMobile ? 1000 / 28 : 1000 / 36;
  let lastFrame = 0;

  worldGroup.position.set(curX, reducedMotion ? curY : curY + ENTRY_START_Y * 0.3, 0);
  worldGroup.scale.setScalar(curS);
  planetGroup.rotation.y = CONFIG.initRotation;
  glowMesh.quaternion.copy(camera.quaternion);

  function revealNow() {
    if (sceneRevealed) return;
    canvas.classList.add('is-ready');
    document.querySelector('.space-fallback')?.classList.add('is-upgraded');
    sceneRevealed = true;
    planetLoaded = true;
    if (!reducedMotion) entryStart = performance.now();
    lastT = performance.now();
    lastFrame = 0;
    if (!rafId) rafId = requestAnimationFrame(animate);
  }

  requestAnimationFrame(() => {
    glowMesh.quaternion.copy(camera.quaternion);
    renderer.render(scene, camera);
    revealNow();
  });

  async function prepTexture(tex, maxW = 1024) {
    // Downscale before GPU upload — 2K maps are a common one-frame hitch
    try {
      const img = tex.image;
      if (img && typeof createImageBitmap === 'function' && (img.width || 0) > maxW) {
        const h = Math.round(((img.height || maxW) / (img.width || maxW)) * maxW);
        tex.image = await createImageBitmap(img, {
          resizeWidth: maxW,
          resizeHeight: Math.max(1, h),
          resizeQuality: 'medium',
        });
        tex.needsUpdate = true;
      }
    } catch (_) {}
    tex.encoding = THREE.sRGBEncoding;
    tex.anisotropy = 1;
    tex.generateMipmaps = true;
    tex.minFilter = THREE.LinearMipmapLinearFilter;
    tex.magFilter = THREE.LinearFilter;
    return tex;
  }

  async function upgradeEarth() {
    const loader = new THREE.TextureLoader();
    loader.crossOrigin = 'anonymous';

    // Fetch textures off the critical path; decode one at a time with yields
    let dayMap;
    try {
      dayMap = await prepTexture(await loader.loadAsync(TEX.day), isMobile ? 768 : 1024);
    } catch (e) {
      console.warn('Earth day map failed', e);
      return;
    }
    await waitIdle(80);
    await nextFrame();

    let nightMap = null;
    try {
      nightMap = await prepTexture(await loader.loadAsync(TEX.night), isMobile ? 768 : 1024);
    } catch (_) {
      nightMap = null;
    }
    await waitIdle(80);
    await nextFrame();

    const mat = new THREE.MeshStandardMaterial({
      map: dayMap,
      // Subtle city lights only — high emissive was washing continents white
      emissiveMap: nightMap || undefined,
      emissive: nightMap ? new THREE.Color(0xffc48a) : new THREE.Color(0x000000),
      emissiveIntensity: nightMap ? 0.22 : 0,
      roughness: 0.78,
      metalness: 0.04,
      transparent: true,
      opacity: 0,
    });
    // Keep albedo faithful to the blue-marble texture
    mat.color.set(0xffffff);

    earthMesh = new THREE.Mesh(sharedGeo, mat);
    earthMesh.renderOrder = 1;
    planetGroup.add(earthMesh);

    // Compile new material on a quiet frame, then crossfade — no hard cut
    await nextFrame();
    try {
      renderer.compile(scene, camera);
    } catch (_) {}
    await nextFrame();
    fadeT = performance.now();

    // Clouds later — never on the same frame as the earth swap
    await waitIdle(400);
    await nextFrame();
    try {
      const cloudsTex = await prepTexture(await loader.loadAsync(TEX.clouds), 512);
      cloudsTex.wrapS = cloudsTex.wrapT = THREE.RepeatWrapping;
      // Clouds often ship as white-on-black — use as alpha so land colors stay visible
      const cloudMat = new THREE.MeshStandardMaterial({
        map: cloudsTex,
        alphaMap: cloudsTex,
        color: 0xffffff,
        transparent: true,
        opacity: CONFIG.cloudOpacity,
        depthWrite: false,
        roughness: 1,
        metalness: 0,
      });
      cloudMesh = new THREE.Mesh(
        new THREE.SphereGeometry(CONFIG.planetRadius * CONFIG.cloudHeight, segs, segs),
        cloudMat,
      );
      cloudMesh.renderOrder = 2;
      cloudGroup.add(cloudMesh);
      cloudGroup.visible = true;
      await nextFrame();
      try {
        renderer.compile(scene, camera);
      } catch (_) {}
    } catch (e) {
      console.warn('Clouds failed', e);
    }
  }

  // Start upgrade only after the soft placeholder is already spinning
  const scheduleUpgrade = () => {
    const run = () => upgradeEarth().catch((e) => console.error('Planet upgrade failed', e));
    if ('requestIdleCallback' in window) {
      requestIdleCallback(run, { timeout: 3500 });
    } else {
      setTimeout(run, 1600);
    }
  };
  if (document.readyState === 'complete') {
    scheduleUpgrade();
  } else {
    window.addEventListener('load', scheduleUpgrade, { once: true });
  }

  const onResize = () => {
    const ww = window.innerWidth;
    const hh = window.innerHeight;
    camera.aspect = ww / hh;
    camera.updateProjectionMatrix();
    renderer.setPixelRatio(isMobile ? 1 : Math.min(window.devicePixelRatio || 1, 1.15));
    renderer.setSize(ww, hh, false);
    if (starResU) starResU.value.set(ww, hh);
  };
  window.addEventListener('resize', onResize, { passive: true });
  document.addEventListener('visibilitychange', () => {
    visible = !document.hidden;
    if (visible && sceneRevealed) {
      lastT = performance.now();
      lastFrame = 0;
      rafId = requestAnimationFrame(animate);
    }
  });

  function animate(now) {
    if (!visible || !sceneRevealed) return;
    rafId = requestAnimationFrame(animate);
    if (now - lastFrame < FRAME_MS) return;
    lastFrame = now;

    let dt = (now - lastT) / 1000;
    lastT = now;
    dt = Math.min(dt, 0.05);

    starTime += dt;
    if (starMat) starMat.uniforms.uTime.value = starTime;

    // Soft crossfade placeholder → textured earth (spread over frames)
    if (fadeT != null && earthMesh) {
      const t = clamp((now - fadeT) / FADE_MS, 0, 1);
      const ease = t * t * (3 - 2 * t);
      earthMesh.material.opacity = ease;
      placeholderMat.opacity = 1 - ease;
      if (t >= 1) {
        fadeT = null;
        planetGroup.remove(placeholderPlanet);
        placeholderMat.dispose();
        earthMesh.material.transparent = false;
        earthMesh.material.opacity = 1;
        earthMesh.material.needsUpdate = true;
      }
    }

    const scrollMax = Math.max(1, document.documentElement.scrollHeight - window.innerHeight);
    const pTarget = clamp(window.scrollY / scrollMax, 0, 1);
    curP += (pTarget - curP) * Math.min(1, dt * 2.2);

    const sideScale = clamp(window.innerWidth / 1200, 0.5, 1);
    const tx = sample(STOPS_X, curP) * sideScale;
    const ty = sample(STOPS_Y, curP);
    const ts = sample(STOPS_S, curP);
    const k = Math.min(1, dt * 2.0);
    curX += (tx - curX) * k;
    curY += (ty - curY) * k;
    curS += (ts - curS) * k;

    let entryY = 0;
    if (planetLoaded && !reducedMotion && entryStart != null) {
      const t = clamp((now - entryStart) / 1000 / ENTRY_DUR, 0, 1);
      entryY = lerp(ENTRY_START_Y, 0, 1 - Math.pow(1 - t, 3));
      if (t >= 1) entryStart = null;
    }

    worldGroup.position.set(curX, curY + entryY, 0);
    worldGroup.scale.setScalar(curS);
    spinPhase += dt * CONFIG.spin;
    planetGroup.rotation.y = CONFIG.initRotation + spinPhase + curP * Math.PI * 1.4;
    if (cloudMesh) cloudMesh.rotation.y += dt * CONFIG.cloudSpin;
    glowMesh.quaternion.copy(camera.quaternion);

    renderer.render(scene, camera);
  }

  return {
    renderer,
    scene,
    camera,
    dispose() {
      cancelAnimationFrame(rafId);
      window.removeEventListener('resize', onResize);
      renderer.dispose();
    },
  };
}
