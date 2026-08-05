@php
    $palette = $portfolio['palette'];
    $requests = collect($portfolio['requests'])->map(function ($r) use ($palette) {
        return [
            'method' => $r['method'],
            'path' => $r['path'],
            'status' => $r['status'],
            'color' => $palette[$r['color']],
        ];
    })->values();
@endphp

<div
    x-data="{
        visible: 0,
        requests: {{ Js::from($requests) }},
        init() {
            this.tick();
        },
        tick() {
            if (this.visible >= this.requests.length) return;
            setTimeout(() => {
                this.visible++;
                this.tick();
            }, 700);
        }
    }"
    class="rounded-2xl p-5 sm:p-6 w-full max-w-md"
    style="
        background: rgba(8, 12, 24, 0.85);
        border: 1px solid rgba(148,163,184,0.25);
        box-shadow: 0 0 40px rgba(45, 212, 191, 0.12);
        backdrop-filter: blur(16px);
    "
>
    <div class="flex items-center gap-2 mb-4">
        <span class="w-2.5 h-2.5 rounded-full" style="background: #F87171;"></span>
        <span class="w-2.5 h-2.5 rounded-full" style="background: #FBBF24;"></span>
        <span class="w-2.5 h-2.5 rounded-full" style="background: #34D399;"></span>
        <span class="ml-2 text-xs font-mono" style="color: #94A3B8;">portfolio.log</span>
    </div>

    <div class="space-y-2.5 min-h-[168px]">
        <template x-for="(r, i) in requests.slice(0, visible)" :key="i">
            <div class="flex items-center gap-2 text-sm animate-fade-in font-mono">
                <span class="font-medium" x-text="r.method" :style="{ color: r.color }"></span>
                <span style="color: #E2E8F0;" x-text="r.path"></span>
                <span class="ml-auto" style="color: #6EE7B7;" x-text="r.status + ' OK'"></span>
            </div>
        </template>

        <template x-if="visible < requests.length">
            <div class="text-sm animate-pulse font-mono" style="color: #64748B;">
                compiling profile ...
            </div>
        </template>

        <template x-if="visible >= requests.length">
            <div class="text-sm flex items-center gap-1 font-mono" style="color: #64748B;">
                $<span class="inline-block w-2 h-4 animate-blink" style="background: #64748B;"></span>
            </div>
        </template>
    </div>
</div>
