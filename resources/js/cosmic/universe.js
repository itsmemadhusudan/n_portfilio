import { Starfield } from './Starfield.js';
import { Planet } from './Planet.js';
import { ParticleSystem } from './ParticleSystem.js';
import { Meteor } from './Meteor.js';

function scaleRadius(base, width) {
    const factor = Math.min(1, Math.max(0.55, width / 1280));
    return Math.round(base * factor);
}

function createPlanets(width) {
    // Right half only — never behind hero copy
    return [
        new Planet({
            id: 'aegis',
            name: 'Aegis Prime',
            x: 0.88,
            y: 0.2,
            radius: scaleRadius(64, width),
            type: 'terran',
            coreColor1: '#0288d1',
            coreColor2: '#1565c0',
            surfaceDetailColor: '#2e7d32',
            atmosColor: 'rgba(3, 169, 244, 0.28)',
        }),
        new Planet({
            id: 'saturnia',
            name: 'Saturnia',
            x: 0.92,
            y: 0.78,
            radius: scaleRadius(70, width),
            type: 'gas_giant',
            coreColor1: '#ffb74d',
            coreColor2: '#f57c00',
            surfaceDetailColor: '#e65100',
            atmosColor: 'rgba(255, 183, 77, 0.22)',
            hasRings: true,
            ringColor: 'rgba(255, 204, 128, 0.3)',
        }),
        new Planet({
            id: 'vulcan',
            name: 'Vulcan IX',
            x: 0.78,
            y: 0.42,
            radius: scaleRadius(36, width),
            type: 'volcanic',
            coreColor1: '#d32f2f',
            coreColor2: '#b71c1c',
            surfaceDetailColor: '#ff6d00',
            atmosColor: 'rgba(255, 87, 34, 0.24)',
        }),
        new Planet({
            id: 'glacius',
            name: 'Glacius',
            x: 0.7,
            y: 0.88,
            radius: scaleRadius(40, width),
            type: 'ice',
            coreColor1: '#80deea',
            coreColor2: '#00acc1',
            surfaceDetailColor: '#00838f',
            atmosColor: 'rgba(128, 222, 234, 0.24)',
        }),
    ];
}

export function initCosmicUniverse(canvas) {
    if (!canvas) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let width = window.innerWidth;
    let height = window.innerHeight;
    let dpr = Math.min(window.devicePixelRatio || 1, 2);

    const getSize = () => ({ width, height });
    const starfield = new Starfield(getSize);
    const particleSystem = new ParticleSystem();
    let planets = createPlanets(width);
    let meteors = [];
    let meteorSpawnTimer = 0;
    const meteorSpawnInterval = prefersReducedMotion ? 99999 : 140;
    let rafId = 0;

    function resizeCanvas() {
        width = window.innerWidth;
        height = window.innerHeight;
        dpr = Math.min(window.devicePixelRatio || 1, 2);

        canvas.width = Math.floor(width * dpr);
        canvas.height = Math.floor(height * dpr);
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;

        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        starfield.resize();
        planets = createPlanets(width);
        planets.forEach((planet) => planet.update(width, height));
    }

    function launchMeteor(targetPlanet = null) {
        const side = Math.floor(Math.random() * 4);
        let startX;
        let startY;

        if (side === 0) {
            startX = Math.random() * width;
            startY = -50;
        } else if (side === 1) {
            startX = width + 50;
            startY = Math.random() * height;
        } else if (side === 2) {
            startX = Math.random() * width;
            startY = height + 50;
        } else {
            startX = -50;
            startY = Math.random() * height;
        }

        let selectedPlanet = targetPlanet;
        if (!selectedPlanet && Math.random() < 0.75 && planets.length > 0) {
            selectedPlanet = planets[Math.floor(Math.random() * planets.length)];
        }

        let targetX;
        let targetY;

        if (selectedPlanet) {
            const angle = Math.random() * Math.PI * 2;
            const rOffset = Math.random() * selectedPlanet.radius * 0.75;
            targetX = selectedPlanet.currentX + Math.cos(angle) * rOffset;
            targetY = selectedPlanet.currentY + Math.sin(angle) * rOffset;
        } else {
            targetX = Math.random() * width;
            targetY = Math.random() * height;
        }

        meteors.push(new Meteor(startX, startY, targetX, targetY, {
            targetPlanet: selectedPlanet,
            speed: Math.random() * 4 + 7,
            size: Math.random() * 4 + 3.5,
        }));
    }

    function drawStaticFrame() {
        starfield.update();
        planets.forEach((planet) => planet.update(width, height));
        ctx.clearRect(0, 0, width, height);
        starfield.draw(ctx);
        ctx.globalAlpha = 0.72;
        planets.forEach((planet) => planet.draw(ctx));
        ctx.globalAlpha = 1;
    }

    function animate() {
        rafId = requestAnimationFrame(animate);

        starfield.update();
        planets.forEach((planet) => planet.update(width, height));

        meteorSpawnTimer += 1;
        if (meteorSpawnTimer >= meteorSpawnInterval) {
            meteorSpawnTimer = 0;
            launchMeteor();
        }

        for (let i = meteors.length - 1; i >= 0; i -= 1) {
            const meteor = meteors[i];
            meteor.update(particleSystem, width, height);
            if (!meteor.isAlive) {
                meteors.splice(i, 1);
            }
        }

        particleSystem.update();

        ctx.clearRect(0, 0, width, height);
        starfield.draw(ctx);
        ctx.globalAlpha = 0.72;
        planets.forEach((planet) => planet.draw(ctx));
        ctx.globalAlpha = 0.85;
        meteors.forEach((meteor) => meteor.draw(ctx));
        particleSystem.draw(ctx);
        ctx.globalAlpha = 1;
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    if (prefersReducedMotion) {
        drawStaticFrame();
        return () => {
            window.removeEventListener('resize', resizeCanvas);
        };
    }

    rafId = requestAnimationFrame(animate);

    return () => {
        cancelAnimationFrame(rafId);
        window.removeEventListener('resize', resizeCanvas);
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('universe-canvas');
    if (canvas) {
        initCosmicUniverse(canvas);
    }
});
