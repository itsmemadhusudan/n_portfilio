class Particle {
    constructor(x, y, vx, vy, color, size, life, drag = 0.98, gravity = 0) {
        this.x = x;
        this.y = y;
        this.vx = vx;
        this.vy = vy;
        this.color = color;
        this.size = size;
        this.initialSize = size;
        this.life = life;
        this.maxLife = life;
        this.drag = drag;
        this.gravity = gravity;
    }

    update() {
        this.vx *= this.drag;
        this.vy *= this.drag;
        this.vy += this.gravity;
        this.x += this.vx;
        this.y += this.vy;
        this.life -= 0.02;
        this.size = Math.max(0, this.initialSize * (this.life / this.maxLife));
    }

    draw(ctx) {
        if (this.life <= 0) return;
        ctx.save();
        ctx.globalAlpha = Math.max(0, this.life / this.maxLife);
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();
    }
}

class ShockwaveRing {
    constructor(x, y, maxRadius, color = '#ff9800') {
        this.x = x;
        this.y = y;
        this.radius = 2;
        this.maxRadius = maxRadius;
        this.color = color;
        this.alpha = 1.0;
        this.speed = maxRadius / 15;
    }

    update() {
        this.radius += this.speed;
        this.alpha = Math.max(0, 1 - (this.radius / this.maxRadius));
    }

    draw(ctx) {
        if (this.alpha <= 0) return;
        ctx.save();
        ctx.globalAlpha = this.alpha;
        ctx.strokeStyle = this.color;
        ctx.lineWidth = Math.max(1, 4 * (1 - this.radius / this.maxRadius));
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.stroke();
        ctx.restore();
    }
}

export class ParticleSystem {
    constructor() {
        this.particles = [];
        this.shockwaves = [];
        this.flashes = [];
    }

    createExplosion(x, y, targetColor = '#ff6d00') {
        this.flashes.push({
            x,
            y,
            radius: 60,
            alpha: 1.0,
        });

        this.shockwaves.push(new ShockwaveRing(x, y, 90, '#ffffff'));
        this.shockwaves.push(new ShockwaveRing(x, y, 60, targetColor));

        const particleCount = 45;
        const colors = ['#ffffff', '#ffeb3b', '#ff9800', '#ff5722', '#e91e63'];

        for (let i = 0; i < particleCount; i++) {
            const angle = Math.random() * Math.PI * 2;
            const speed = Math.random() * 8 + 2;
            const vx = Math.cos(angle) * speed;
            const vy = Math.sin(angle) * speed;
            const color = colors[Math.floor(Math.random() * colors.length)];
            const size = Math.random() * 4 + 2;
            const life = Math.random() * 0.8 + 0.4;

            this.particles.push(new Particle(x, y, vx, vy, color, size, life, 0.95));
        }

        for (let i = 0; i < 12; i++) {
            const angle = Math.random() * Math.PI * 2;
            const speed = Math.random() * 2 + 0.5;
            const vx = Math.cos(angle) * speed;
            const vy = Math.sin(angle) * speed;
            const size = Math.random() * 12 + 8;
            const life = Math.random() * 1.2 + 0.8;

            this.particles.push(new Particle(x, y, vx, vy, 'rgba(80, 80, 100, 0.5)', size, life, 0.92));
        }
    }

    addTrailParticle(x, y, vx, vy) {
        const pVx = (Math.random() - 0.5) * 1.5 - vx * 0.1;
        const pVy = (Math.random() - 0.5) * 1.5 - vy * 0.1;
        const colors = ['#ffeb3b', '#ff9800', '#ff3d00'];
        const color = colors[Math.floor(Math.random() * colors.length)];

        this.particles.push(new Particle(x, y, pVx, pVy, color, Math.random() * 3 + 1.5, 0.5, 0.9, 0));
    }

    update() {
        for (let i = this.particles.length - 1; i >= 0; i--) {
            const p = this.particles[i];
            p.update();
            if (p.life <= 0) {
                this.particles.splice(i, 1);
            }
        }

        for (let i = this.shockwaves.length - 1; i >= 0; i--) {
            const sw = this.shockwaves[i];
            sw.update();
            if (sw.alpha <= 0) {
                this.shockwaves.splice(i, 1);
            }
        }

        for (let i = this.flashes.length - 1; i >= 0; i--) {
            const f = this.flashes[i];
            f.alpha -= 0.08;
            if (f.alpha <= 0) {
                this.flashes.splice(i, 1);
            }
        }
    }

    draw(ctx) {
        this.flashes.forEach((f) => {
            if (f.alpha <= 0) return;
            ctx.save();
            const grad = ctx.createRadialGradient(f.x, f.y, 0, f.x, f.y, f.radius);
            grad.addColorStop(0, `rgba(255, 255, 255, ${f.alpha})`);
            grad.addColorStop(0.4, `rgba(255, 170, 0, ${f.alpha * 0.6})`);
            grad.addColorStop(1, 'rgba(255, 60, 0, 0)');
            ctx.fillStyle = grad;
            ctx.beginPath();
            ctx.arc(f.x, f.y, f.radius, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
        });

        this.shockwaves.forEach((sw) => sw.draw(ctx));
        this.particles.forEach((p) => p.draw(ctx));
    }
}
