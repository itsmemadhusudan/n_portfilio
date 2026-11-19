<section class="section section--white" aria-label="Key stats">
    <div class="container">
        <div class="stats-grid" data-stats>
            @foreach ($portfolio['ui_stats'] ?? $portfolio['stats'] as $stat)
                <div class="reveal" style="--reveal-delay: {{ $loop->index * 80 }}ms">
                    <p class="stat-value">
                        <span data-count-to="{{ $stat['value'] ?? 0 }}">0</span>{{ $stat['suffix'] ?? '' }}
                    </p>
                    <p class="stat-label">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
