@extends('layouts.app')

@section('content')
    <x-page-header
        eyebrow="Technology Stack"
        :title="$seo['h1']"
        :subtitle="$technologyStack['intro'] ?? 'Explore the technologies, frameworks, tools and platforms used to build modern digital products.'"
    />

    <section class="page-body">
        <div
            class="container"
            x-data="stackDirectory(@js($stackCategories))"
        >
            <div class="stack-toolbar">
                <label class="stack-search">
                    <span class="sr-only">Search technologies</span>
                    <input
                        type="search"
                        x-model="query"
                        @input.debounce.200ms="syncUrl()"
                        placeholder="Search technology by name"
                        autocomplete="off"
                    >
                </label>
                <div class="stack-filters" role="tablist" aria-label="Technology categories">
                    <button
                        type="button"
                        class="stack-filter"
                        :class="{ 'is-active': category === 'all' }"
                        @click="setCategory('all')"
                    >All</button>
                    <template x-for="cat in categories" :key="cat.id">
                        <button
                            type="button"
                            class="stack-filter"
                            :class="{ 'is-active': category === cat.id }"
                            @click="setCategory(cat.id)"
                            x-text="shortLabel(cat)"
                        ></button>
                    </template>
                </div>
            </div>

            <div class="stack-summary">
                <template x-for="cat in visibleCategoryCards" :key="'sum-' + cat.id">
                    <div class="stack-summary__card">
                        <p class="stack-summary__label" x-text="cat.shortLabel"></p>
                        <p class="stack-summary__value"><span x-text="cat.count"></span></p>
                        <p class="stack-summary__meta">Technologies</p>
                    </div>
                </template>
            </div>

            <template x-for="cat in filteredCategories" :key="cat.id">
                <section class="stack-category" :id="'stack-' + cat.id">
                    <div class="stack-category__head">
                        <h2 class="section-title" style="font-size:1.35rem" x-text="cat.label"></h2>
                        <p class="muted" x-text="cat.summary"></p>
                    </div>
                    <div class="stack-grid">
                        <template x-for="item in cat.items" :key="cat.id + '-' + item.name">
                            <article class="stack-card">
                                <div class="stack-card__top">
                                    <h3 x-text="item.name"></h3>
                                    <span class="stack-card__tag" x-text="cat.shortLabel"></span>
                                </div>
                                <p class="stack-card__desc" x-text="item.description"></p>
                                <dl class="stack-card__meta">
                                    <div>
                                        <dt>Purpose</dt>
                                        <dd x-text="item.purpose"></dd>
                                    </div>
                                    <div>
                                        <dt>Key advantage</dt>
                                        <dd x-text="item.advantage"></dd>
                                    </div>
                                </dl>
                                <template x-if="item.slug">
                                    <a class="stack-card__link" :href="'/stack/' + item.slug">View guide</a>
                                </template>
                            </article>
                        </template>
                    </div>
                </section>
            </template>

            <p class="muted" x-show="filteredCategories.length === 0" x-cloak style="margin-top:1.5rem">
                No technologies match that search.
            </p>
        </div>
    </section>
@endsection
