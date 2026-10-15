@php
    $categories = $skillCategories ?? ($portfolio['skill_categories'] ?? []);
    $grouped = $skillsByCategory ?? [];
    $keys = array_keys(array_filter($categories, fn ($label, $key) => ! empty($grouped[$key]), ARRAY_FILTER_USE_BOTH));
    $first = $keys[0] ?? 'language';
@endphp

<div
    class="skills-tabs"
    x-data="{ tab: '{{ $first }}' }"
>
    <div class="skills-tabs__nav" role="tablist" aria-label="Skill categories">
        @foreach ($categories as $key => $label)
            @continue(empty($grouped[$key]))
            <button
                type="button"
                class="skills-tabs__btn"
                role="tab"
                :aria-selected="(tab === '{{ $key }}').toString()"
                :class="tab === '{{ $key }}' && 'is-active'"
                @click="tab = '{{ $key }}'"
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    @foreach ($categories as $key => $label)
        @continue(empty($grouped[$key]))
        <div
            class="skills-tabs__panel"
            role="tabpanel"
            x-show="tab === '{{ $key }}'"
            x-cloak
        >
            <div class="skills-tabs__grid">
                @foreach ($grouped[$key] as $skill)
                    <x-skill-badge
                        :name="$skill['name']"
                        :slug="$skill['slug']"
                        :proficiency="$skill['proficiency'] ?? 'proficient'"
                        :icon="$skill['icon'] ?? 'code'"
                        :href="route('stack.show', $skill['slug'])"
                    />
                @endforeach
            </div>
        </div>
    @endforeach
</div>
