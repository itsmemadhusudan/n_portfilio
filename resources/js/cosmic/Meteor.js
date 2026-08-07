import { Vector2D } from './Vector2D.js';

export class Meteor {
    constructor(startX, startY, targetX, targetY, options = {}) {
        this.pos = new Vector2D(startX, startY);
        this.targetPos = new Vector2D(targetX, targetY);
        this.targetPlanet = options.targetPlanet || null;

        const dir = this.targetPos.clone().sub(this.pos).normalize();
        this.speed = options.speed || (Math.random() * 4 + 6);
        this.vel = dir.mult(this.speed);

        this.size = options.size || (Math.random() * 4 + 3);
        this.trailLength = options.trailLength || (Math.random() * 40 + 30);
        this.color = options.color || '#ffe082';

        this.isAlive = true;
        this.hasHit = false;
        this.onImpact = options.onImpact || null;
    }

    update(particleSystem, width, height) {
        if (!this.isAlive) return;

        this.pos.add(this.vel);

        if (particleSystem && Math.random() < 0.8) {
            particleSystem.addTrailParticle(this.pos.x, this.pos.y, this.vel.x, this.vel.y);
        }

        if (this.targetPlanet) {
            const distToPlanet = Math.hypot(
                this.pos.x - this.targetPlanet.currentX,
                this.pos.y - this.targetPlanet.currentY,
            );

            if (distToPlanet <= this.targetPlanet.radius) {
                this.triggerImpact(particleSystem, this.pos.x, this.pos.y);
                return;
            }
        } else if (this.pos.dist(this.targetPos) < this.speed * 1.5) {
            this.triggerImpact(particleSystem, this.targetPos.x, this.targetPos.y);
            return;
        }

        if (
            this.pos.x < -100
            || this.pos.x > width + 100
            || this.pos.y < -100
            || this.pos.y > height + 100
        ) {
            this.isAlive = false;
        }
    }

    triggerImpact(particleSystem, hitX, hitY) {
        this.isAlive = false;
        this.hasHit = true;

        if (this.targetPlanet) {
            this.targetPlanet.addImpact(hitX, hitY);
        }

        if (particleSystem) {
            particleSystem.createExplosion(hitX, hitY, '#ff5722');
        }

        if (this.onImpact) {
            this.onImpact(hitX, hitY);
        }
    }

    draw(ctx) {
        if (!this.isAlive) return;

        ctx.save();

        const trailEnd = this.pos.clone().sub(this.vel.clone().normalize().mult(this.trailLength));
        const grad = ctx.createLinearGradient(this.pos.x, this.pos.y, trailEnd.x, trailEnd.y);
        grad.addColorStop(0, '#ffffff');
        grad.addColorStop(0.2, '#ffb74d');
        grad.addColorStop(0.6, 'rgba(255, 61, 0, 0.6)');
        grad.addColorStop(1, 'rgba(255, 0, 0, 0)');

        ctx.strokeStyle = grad;
        ctx.lineWidth = this.size * 1.5;
        ctx.lineCap = 'round';
        ctx.beginPath();
        ctx.moveTo(this.pos.x, this.pos.y);
        ctx.lineTo(trailEnd.x, trailEnd.y);
        ctx.stroke();

        const headGrad = ctx.createRadialGradient(
            this.pos.x, this.pos.y, 0,
            this.pos.x, this.pos.y, this.size * 2,
        );
        headGrad.addColorStop(0, '#ffffff');
        headGrad.addColorStop(0.4, '#ffe082');
        headGrad.addColorStop(1, 'rgba(255, 112, 67, 0)');

        ctx.fillStyle = headGrad;
        ctx.beginPath();
        ctx.arc(this.pos.x, this.pos.y, this.size * 2, 0, Math.PI * 2);
        ctx.fill();

        ctx.restore();
    }
}
