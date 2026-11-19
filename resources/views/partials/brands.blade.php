@if (! empty($portfolio['brands']))
    <section class="brands" aria-label="Clients and partners">
        <div class="container">
            <div class="brands__grid">
                @foreach ($portfolio['brands'] as $brand)
                    <div class="brands__item">
                        @if (! empty($brand['logo']))
                            <img src="{{ asset(ltrim($brand['logo'], '/')) }}" alt="{{ $brand['name'] }}" width="120" height="40" loading="lazy">
                        @else
                            {{ $brand['name'] }}
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
