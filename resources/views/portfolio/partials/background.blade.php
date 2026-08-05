{{-- Blackhole background --}}
<div class="bh-scene pointer-events-none fixed inset-0 overflow-hidden -z-10" aria-hidden="true">
    <div class="bh-space"></div>
    <div class="bh-stars">
        @for ($i = 0; $i < 60; $i++)
            <span class="bh-star" style="--i: {{ $i }};"></span>
        @endfor
    </div>

    <div class="bh-core">
        <div class="bh-accretion bh-accretion-outer"></div>
        <div class="bh-accretion bh-accretion-mid"></div>
        <div class="bh-accretion bh-accretion-inner"></div>
        <div class="bh-horizon"></div>
        <div class="bh-singularity"></div>
        <div class="bh-lens"></div>
    </div>

    <div class="bh-debris">
        @for ($i = 0; $i < 24; $i++)
            <span class="bh-particle" style="--i: {{ $i }};"></span>
        @endfor
    </div>

    <div class="bh-vignette"></div>
</div>
