export class Planet {
    constructor(config) {
        this.id = config.id || Math.random().toString(36).substr(2, 9);
        this.name = config.name || 'Unnamed World';
        this.x = config.x || 0;
        this.y = config.y || 0;
        this.radius = config.radius || 70;
        this.type = config.type || 'terran';

        this.baseAngle = config.angle || 0;
        this.rotationSpeed = config.rotationSpeed || 0.002;
        this.currentAngle = this.baseAngle;

        this.floatPhase = Math.random() * Math.PI * 2;
        this.floatSpeed = config.floatSpeed || 0.0015;
        this.floatAmplitude = config.floatAmplitude || 8;

        this.craters = [];
        this.hasRings = config.hasRings || false;
        this.ringColor = config.ringColor || 'rgba(240, 200, 150, 0.4)';

        this.atmosColor = config.atmosColor || 'rgba(0, 220, 255, 0.4)';
        this.coreColor1 = config.coreColor1 || '#1e3c72';
        this.coreColor2 = config.coreColor2 || '#2a5298';
        this.surfaceDetailColor = config.surfaceDetailColor || '#204368';
    }

    addImpact(hitX, hitY, energy = 1.0) {
        const relX = hitX - this.currentX;
        const relY = hitY - this.currentY;
        const dist = Math.sqrt(relX * relX + relY * relY);
        const angle = Math.atan2(relY, relX) - this.currentAngle;

        this.craters.push({
            relDist: Math.min(dist / this.radius, 0.92),
            angleOffset: angle,
            size: (Math.random() * 8 + 8) * energy,
            heat: 1.0,
            coolRate: 0.0015 + Math.random() * 0.001,
            maxLife: 1.0,
        });

        if (this.craters.length > 25) {
            this.craters.shift();
        }
    }

    update(width, height) {
        this.currentX = this.x * width;
        this.currentY = this.y * height + Math.sin(this.floatPhase) * this.floatAmplitude;

        this.floatPhase += this.floatSpeed;
        this.currentAngle += this.rotationSpeed;

        this.craters.forEach((crater) => {
            if (crater.heat > 0) {
                crater.heat = Math.max(0, crater.heat - crater.coolRate);
            }
        });
    }

    draw(ctx) {
        const cx = this.currentX;
        const cy = this.currentY;
        const r = this.radius;

        ctx.save();

        const atmosGrad = ctx.createRadialGradient(cx, cy, r * 0.85, cx, cy, r * 1.35);
        atmosGrad.addColorStop(0, this.atmosColor);
        atmosGrad.addColorStop(0.7, this.atmosColor.replace(/[\d.]+\)$/, '0.15)'));
        atmosGrad.addColorStop(1, 'rgba(0, 0, 0, 0)');
        ctx.fillStyle = atmosGrad;
        ctx.beginPath();
        ctx.arc(cx, cy, r * 1.35, 0, Math.PI * 2);
        ctx.fill();

        if (this.hasRings) {
            this.drawRings(ctx, cx, cy, r, true);
        }

        ctx.beginPath();
        ctx.arc(cx, cy, r, 0, Math.PI * 2);
        ctx.clip();

        const lightAngle = -Math.PI / 4;
        const lx = cx + Math.cos(lightAngle) * r * 0.4;
        const ly = cy + Math.sin(lightAngle) * r * 0.4;

        const bodyGrad = ctx.createRadialGradient(lx, ly, r * 0.1, cx, cy, r);
        bodyGrad.addColorStop(0, this.coreColor1);
        bodyGrad.addColorStop(0.65, this.coreColor2);
        bodyGrad.addColorStop(1, '#03050a');
        ctx.fillStyle = bodyGrad;
        ctx.fillRect(cx - r, cy - r, r * 2, r * 2);

        this.drawSurfaceDetails(ctx, cx, cy, r);

        this.craters.forEach((crater) => {
            const craterAngle = this.currentAngle + crater.angleOffset;
            const cDist = crater.relDist * r;
            const craterX = cx + Math.cos(craterAngle) * cDist;
            const craterY = cy + Math.sin(craterAngle) * cDist;

            const shadowDist = Math.hypot(craterX - lx, craterY - ly);
            const shadowFactor = Math.max(0.2, 1 - shadowDist / (r * 1.8));

            ctx.save();
            ctx.translate(craterX, craterY);

            ctx.fillStyle = '#08080c';
            ctx.beginPath();
            ctx.arc(0, 0, crater.size, 0, Math.PI * 2);
            ctx.fill();

            ctx.strokeStyle = `rgba(180, 180, 200, ${0.4 * shadowFactor})`;
            ctx.lineWidth = 1.5;
            ctx.stroke();

            if (crater.heat > 0) {
                const heatGrad = ctx.createRadialGradient(0, 0, 0, 0, 0, crater.size * 1.5);
                heatGrad.addColorStop(0, `rgba(255, 255, 255, ${crater.heat})`);
                heatGrad.addColorStop(0.3, `rgba(255, 140, 0, ${crater.heat * 0.8})`);
                heatGrad.addColorStop(0.7, `rgba(255, 40, 0, ${crater.heat * 0.4})`);
                heatGrad.addColorStop(1, 'rgba(255, 0, 0, 0)');

                ctx.fillStyle = heatGrad;
                ctx.beginPath();
                ctx.arc(0, 0, crater.size * 1.5, 0, Math.PI * 2);
                ctx.fill();
            }

            ctx.restore();
        });

        const rimGrad = ctx.createRadialGradient(cx, cy, r * 0.7, cx, cy, r);
        rimGrad.addColorStop(0, 'rgba(0, 0, 0, 0)');
        rimGrad.addColorStop(0.85, 'rgba(0, 0, 0, 0.2)');
        rimGrad.addColorStop(1, this.atmosColor);
        ctx.fillStyle = rimGrad;
        ctx.fillRect(cx - r, cy - r, r * 2, r * 2);

        ctx.restore();

        if (this.hasRings) {
            this.drawRings(ctx, cx, cy, r, false);
        }
    }

    drawSurfaceDetails(ctx, cx, cy, r) {
        ctx.save();
        ctx.fillStyle = this.surfaceDetailColor;
        ctx.globalAlpha = 0.45;

        const detailCount = this.type === 'gas_giant' ? 6 : 8;
        for (let i = 0; i < detailCount; i++) {
            const rot = this.currentAngle + (i * Math.PI / 4);
            const px = cx + Math.cos(rot) * (r * 0.4);
            const py = cy + Math.sin(rot * 0.8) * (r * 0.5);

            if (this.type === 'gas_giant') {
                const bandY = cy - r + (i / detailCount) * r * 2;
                const bandHeight = (r * 2 / detailCount) * 0.6;
                ctx.fillRect(cx - r, bandY, r * 2, bandHeight);
            } else if (this.type === 'terran') {
                ctx.beginPath();
                ctx.arc(px, py, r * (0.2 + (i % 3) * 0.1), 0, Math.PI * 2);
                ctx.fill();
            } else if (this.type === 'volcanic') {
                ctx.strokeStyle = '#ff3d00';
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.arc(px, py, r * 0.3, rot, rot + 1.2);
                ctx.stroke();
            }
        }
        ctx.restore();
    }

    drawRings(ctx, cx, cy, r, isRear) {
        ctx.save();
        ctx.translate(cx, cy);
        ctx.rotate(Math.PI / 8);
        ctx.scale(1, 0.32);

        const innerR = r * 1.4;
        const outerR = r * 2.3;

        ctx.beginPath();
        if (isRear) {
            ctx.rect(-outerR * 1.2, -outerR * 1.2, outerR * 2.4, outerR * 1.2);
        } else {
            ctx.rect(-outerR * 1.2, 0, outerR * 2.4, outerR * 1.2);
        }
        ctx.clip();

        const ringGrad = ctx.createRadialGradient(0, 0, innerR, 0, 0, outerR);
        ringGrad.addColorStop(0, 'rgba(0, 0, 0, 0)');
        ringGrad.addColorStop(0.2, this.ringColor);
        ringGrad.addColorStop(0.5, this.ringColor.replace(/[\d.]+\)$/, '0.7)'));
        ringGrad.addColorStop(0.8, this.ringColor.replace(/[\d.]+\)$/, '0.3)'));
        ringGrad.addColorStop(1, 'rgba(0, 0, 0, 0)');

        ctx.fillStyle = ringGrad;
        ctx.beginPath();
        ctx.arc(0, 0, outerR, 0, Math.PI * 2);
        ctx.arc(0, 0, innerR, 0, Math.PI * 2, true);
        ctx.fill();

        ctx.restore();
    }
}
