export class Starfield {
    constructor(getSize) {
        this.getSize = getSize;
        this.stars = [];
        this.shootingStars = [];
        this.nebulae = [];
        this.warpSpeed = false;
        this.warpFactor = 1;
        this.targetWarpFactor = 1;
        this.starCount = 450;

        this.initNebulae();
        this.initStars();
    }

    initNebulae() {
        this.nebulae = [
            { x: 0.25, y: 0.3, radius: 0.45, color1: 'rgba(138, 43, 226, 0.08)', color2: 'rgba(75, 0, 130, 0)', phase: 0 },
            { x: 0.75, y: 0.65, radius: 0.5, color1: 'rgba(0, 191, 255, 0.07)', color2: 'rgba(0, 0, 139, 0)', phase: 2 },
            { x: 0.5, y: 0.8, radius: 0.4, color1: 'rgba(255, 20, 147, 0.05)', color2: 'rgba(128, 0, 128, 0)', phase: 4 },
            { x: 0.8, y: 0.2, radius: 0.35, color1: 'rgba(72, 209, 204, 0.06)', color2: 'rgba(0, 128, 128, 0)', phase: 1 },
        ];
    }

    initStars() {
        const { width, height } = this.getSize();
        this.stars = [];
        const colors = ['#ffffff', '#e0f7fa', '#fff9c4', '#b3e5fc', '#f3e5f5', '#80deea'];
        const count = width < 768 ? 280 : this.starCount;

        for (let i = 0; i < count; i++) {
            this.stars.push({
                x: Math.random() * width,
                y: Math.random() * height,
                z: Math.random() * 3 + 0.5,
                baseSize: Math.random() * 1.5 + 0.5,
                color: colors[Math.floor(Math.random() * colors.length)],
                alpha: Math.random() * 0.8 + 0.2,
                twinkleSpeed: Math.random() * 0.03 + 0.005,
                twinklePhase: Math.random() * Math.PI * 2,
                vx: (Math.random() - 0.5) * 0.2,
                vy: Math.random() * 0.4 + 0.1,
            });
        }
    }

    resize() {
        this.initStars();
    }

    setWarpSpeed(active) {
        this.warpSpeed = active;
        this.targetWarpFactor = active ? 18 : 1;
    }

    spawnShootingStar() {
        const { width, height } = this.getSize();
        if (this.shootingStars.length < 3 && Math.random() < 0.015) {
            const startX = Math.random() * width * 1.2 - width * 0.1;
            const startY = Math.random() * height * 0.4;
            const angle = Math.PI / 4 + (Math.random() - 0.5) * 0.3;
            const speed = Math.random() * 10 + 12;

            this.shootingStars.push({
                x: startX,
                y: startY,
                vx: Math.cos(angle) * speed,
                vy: Math.sin(angle) * speed,
                length: Math.random() * 80 + 60,
                alpha: 1,
                life: 1,
                color: Math.random() > 0.5 ? '#e0f7fa' : '#ffd54f',
            });
        }
    }

    update() {
        const { width, height } = this.getSize();
        this.warpFactor += (this.targetWarpFactor - this.warpFactor) * 0.05;

        this.nebulae.forEach((n) => {
            n.phase += 0.002;
        });

        this.stars.forEach((star) => {
            star.twinklePhase += star.twinkleSpeed;
            const currentVy = star.vy * star.z * this.warpFactor;
            const currentVx = star.vx * star.z * (this.warpSpeed ? 3 : 1);

            star.y += currentVy;
            star.x += currentVx;

            if (star.y > height) {
                star.y = 0;
                star.x = Math.random() * width;
            } else if (star.y < 0) {
                star.y = height;
                star.x = Math.random() * width;
            }

            if (star.x > width) star.x = 0;
            if (star.x < 0) star.x = width;
        });

        this.spawnShootingStar();
        for (let i = this.shootingStars.length - 1; i >= 0; i--) {
            const ss = this.shootingStars[i];
            ss.x += ss.vx;
            ss.y += ss.vy;
            ss.life -= 0.02;
            ss.alpha = Math.max(0, ss.life);

            if (ss.life <= 0 || ss.x > width || ss.y > height) {
                this.shootingStars.splice(i, 1);
            }
        }
    }

    draw(ctx) {
        const { width, height } = this.getSize();

        const bgGrad = ctx.createRadialGradient(
            width * 0.5, height * 0.5, 50,
            width * 0.5, height * 0.5, Math.max(width, height) * 0.8,
        );
        bgGrad.addColorStop(0, '#0a091a');
        bgGrad.addColorStop(0.5, '#05050e');
        bgGrad.addColorStop(1, '#020205');
        ctx.fillStyle = bgGrad;
        ctx.fillRect(0, 0, width, height);

        this.nebulae.forEach((n) => {
            const cx = (n.x + Math.sin(n.phase) * 0.05) * width;
            const cy = (n.y + Math.cos(n.phase * 0.8) * 0.05) * height;
            const rad = n.radius * Math.min(width, height);

            const grad = ctx.createRadialGradient(cx, cy, 0, cx, cy, rad);
            grad.addColorStop(0, n.color1);
            grad.addColorStop(1, n.color2);

            ctx.fillStyle = grad;
            ctx.beginPath();
            ctx.arc(cx, cy, rad, 0, Math.PI * 2);
            ctx.fill();
        });

        this.stars.forEach((star) => {
            const currentAlpha = Math.max(0.1, Math.min(1, star.alpha + Math.sin(star.twinklePhase) * 0.3));
            ctx.fillStyle = star.color;
            ctx.globalAlpha = currentAlpha;

            if (this.warpFactor > 2) {
                const trailLen = star.vy * star.z * this.warpFactor * 2.5;
                ctx.strokeStyle = star.color;
                ctx.lineWidth = star.baseSize * (star.z * 0.5);
                ctx.beginPath();
                ctx.moveTo(star.x, star.y);
                ctx.lineTo(star.x - star.vx * trailLen, star.y - trailLen);
                ctx.stroke();
            } else {
                const radius = star.baseSize * (star.z * 0.6);
                ctx.beginPath();
                ctx.arc(star.x, star.y, radius, 0, Math.PI * 2);
                ctx.fill();

                if (star.z > 2.5) {
                    ctx.fillStyle = star.color;
                    ctx.globalAlpha = currentAlpha * 0.25;
                    ctx.beginPath();
                    ctx.arc(star.x, star.y, radius * 2.5, 0, Math.PI * 2);
                    ctx.fill();
                }
            }
        });

        this.shootingStars.forEach((ss) => {
            ctx.globalAlpha = ss.alpha;
            const grad = ctx.createLinearGradient(
                ss.x, ss.y,
                ss.x - ss.vx * (ss.length / 10),
                ss.y - ss.vy * (ss.length / 10),
            );
            grad.addColorStop(0, ss.color);
            grad.addColorStop(0.3, 'rgba(255, 255, 255, 0.8)');
            grad.addColorStop(1, 'rgba(255, 255, 255, 0)');

            ctx.strokeStyle = grad;
            ctx.lineWidth = 2.5;
            ctx.beginPath();
            ctx.moveTo(ss.x, ss.y);
            ctx.lineTo(
                ss.x - ss.vx * (ss.length / 10),
                ss.y - ss.vy * (ss.length / 10),
            );
            ctx.stroke();
        });

        ctx.globalAlpha = 1;
    }
}
