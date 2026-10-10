@php
    $statIcons = ['briefcase', 'server', 'globe', 'users'];
    $backendTools = collect($portfolio['stack'])->firstWhere('label', 'Backend')['tools'] ?? $portfolio['backend_stack'];
    $databaseTools = collect($portfolio['stack'])->firstWhere('label', 'Database')['tools'] ?? ['Database Design', 'SQLite'];
    $practiceTools = collect($portfolio['stack'])->firstWhere('label', 'Practices')['tools'] ?? ['Problem-Solving'];
@endphp

<section class="stats-code page-wrap" aria-label="Highlights and stack overview">
    <div class="stats-code__grid">
        <div class="stats-code__stats">
            @foreach ($portfolio['stats'] as $index => $stat)
                <div
                    class="reveal"
                    style="--reveal-delay: {{ $index * 60 }}ms"
                    x-data="{ shown: false }"
                    x-intersect:enter.once="shown = true"
                    :class="shown && 'is-revealed'"
                >
                    <x-stat-card
                        :value="$stat['value']"
                        :label="$stat['label']"
                        :suffix="$stat['suffix'] ?? null"
                        :icon="$statIcons[$index] ?? 'sparkles'"
                    />
                </div>
            @endforeach
        </div>

        <div
            class="code-card reveal"
            style="--reveal-delay: 120ms"
            x-data="{ shown: false }"
            x-intersect:enter.once="shown = true"
            :class="shown && 'is-revealed'"
        >
            <div class="code-card__bar" aria-hidden="true">
                <span class="code-card__dot"></span>
                <span class="code-card__dot"></span>
                <span class="code-card__dot"></span>
                <span class="code-card__title">developer.php</span>
            </div>
            <pre class="code-card__body" tabindex="0"><code><span class="kw">class</span> <span class="prop">Developer</span> <span class="punct">{</span>
  <span class="prop">name</span><span class="punct">:</span> <span class="str">"{{ $portfolio['full_name'] }}"</span><span class="punct">,</span>
  <span class="prop">role</span><span class="punct">:</span> <span class="str">"{{ $portfolio['title'] }}"</span><span class="punct">,</span>
  <span class="prop">skills</span><span class="punct">:</span> <span class="punct">{</span>
    <span class="prop">backend</span><span class="punct">:</span> <span class="punct">[</span><span class="str">{{ collect($backendTools)->take(4)->map(fn ($t) => '"'.$t.'"')->implode(', ') }}</span><span class="punct">],</span>
    <span class="prop">database</span><span class="punct">:</span> <span class="punct">[</span><span class="str">{{ collect($databaseTools)->take(3)->map(fn ($t) => '"'.$t.'"')->implode(', ') }}</span><span class="punct">],</span>
    <span class="prop">tools</span><span class="punct">:</span> <span class="punct">[</span><span class="str">{{ collect($practiceTools)->take(3)->map(fn ($t) => '"'.$t.'"')->implode(', ') }}</span><span class="punct">]</span>
  <span class="punct">}</span>
<span class="punct">}</span></code></pre>
        </div>
    </div>
</section>
