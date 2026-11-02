import fs from 'fs';

const html = fs.readFileSync('index.html', 'utf8');
const start = html.indexOf('/* ── Planet scene');
const end = html.indexOf('</script>', start);
let body = html.slice(start, end);

body = body.replace("const canvas = document.querySelector('.planet-canvas');\n", '');
body = body.replace('window.__atmoRes = mat.uniforms.uRes;', 'atmoResU = mat.uniforms.uRes;');
body = body.replace('window.__starMat = mat;', 'starMat = mat;');
body = body.replace('window.__starRes = mat.uniforms.uRes;', 'starResU = mat.uniforms.uRes;');
body = body.replace('window.__markerMat = mMat;', 'markerMat = mMat;');
body = body.replace('window.__markerRes = mMat.uniforms.uRes;', 'markerResU = mMat.uniforms.uRes;');
body = body.replace(
  'if (window.__starMat) window.__starMat.uniforms.uTime.value = starTime;',
  'if (starMat) starMat.uniforms.uTime.value = starTime;',
);
body = body.replace(
  'if (window.__markerMat) window.__markerMat.uniforms.uTime.value = markerTime;',
  'if (markerMat) markerMat.uniforms.uTime.value = markerTime;',
);
body = body.replace(
  'if (window.__atmoRes) window.__atmoRes.value.set(ww, hh);',
  'if (atmoResU) atmoResU.value.set(ww, hh);',
);
body = body.replace(
  'if (window.__starRes) window.__starRes.value.set(ww, hh);',
  'if (starResU) starResU.value.set(ww, hh);',
);
body = body.replace(
  'if (window.__markerRes) window.__markerRes.value.set(ww, hh);',
  'if (markerResU) markerResU.value.set(ww, hh);',
);
body = body.replace('animate();\n', 'animate();\n  return { renderer, scene, camera };\n}\n');

const header = `import * as THREE from 'three';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/examples/jsm/postprocessing/UnrealBloomPass.js';
import { ShaderPass } from 'three/examples/jsm/postprocessing/ShaderPass.js';
import { GammaCorrectionShader } from 'three/examples/jsm/shaders/GammaCorrectionShader.js';
import { CopyShader } from 'three/examples/jsm/shaders/CopyShader.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { DRACOLoader } from 'three/examples/jsm/loaders/DRACOLoader.js';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

export function initPlanetScene(canvas) {
  if (!canvas) return null;
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let atmoResU, starMat, starResU, markerMat, markerResU;

`;

fs.mkdirSync('resources/js/planet', { recursive: true });
fs.writeFileSync('resources/js/planet/scene.js', header + body);
console.log('wrote resources/js/planet/scene.js', (header + body).length);
