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
    class="terminal-panel"
>
    <div class="flex items-center gap-2 mb-4">
        <span class="w-2.5 h-2.5 rounded-full" style="background: #F87171;"></span>
        <span class="w-2.5 h-2.5 rounded-full" style="background: #FBBF24;"></span>
        <span class="w-2.5 h-2.5 rounded-full" style="background: #34D399;"></span>
        <span class="ml-2 text-xs font-mono" style="color: var(--text-secondary);">portfolio.log</span>
    </div>

    <div class="space-y-2.5 min-h-[168px]">
        <template x-for="(r, i) in requests.slice(0, visible)" :key="i">
            <div class="flex items-center gap-2 text-sm animate-fade-in font-mono">
                <span class="font-medium" x-text="r.method" :style="{ color: r.color }"></span>
                <span style="color: var(--text-primary);" x-text="r.path"></span>
                <span class="ml-auto" style="color: var(--text-accent);" x-text="r.status + ' OK'"></span>
            </div>
        </template>

        <template x-if="visible < requests.length">
            <div class="text-sm animate-pulse font-mono" style="color: var(--text-secondary);">
                compiling …
            </div>
        </template>

        <template x-if="visible >= requests.length">
            <div class="text-sm flex items-center gap-1 font-mono" style="color: var(--text-secondary);">
                $<span class="inline-block w-2 h-4 animate-blink" style="background: var(--text-secondary);"></span>
            </div>
        </template>
    </div>
</div>
