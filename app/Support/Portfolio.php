<?php

namespace App\Support;

class Portfolio
{
    public static function all(): array
    {
        return config('portfolio', []);
    }

    public static function skills(): array
    {
        $skills = self::all()['skills'] ?? [];
        usort($skills, fn ($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

        return $skills;
    }

    public static function skillsByCategory(): array
    {
        $grouped = [];
        foreach (self::skills() as $skill) {
            $grouped[$skill['category']][] = $skill;
        }

        return $grouped;
    }

    public static function skill(string $slug): ?array
    {
        foreach (self::skills() as $skill) {
            if (($skill['slug'] ?? '') === $slug) {
                return $skill;
            }
        }

        return null;
    }

    public static function skillMap(): array
    {
        $map = [];
        foreach (self::skills() as $skill) {
            $map[$skill['slug']] = $skill;
        }

        return $map;
    }

    public static function projects(): array
    {
        $projects = self::all()['projects'] ?? [];
        usort($projects, fn ($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

        return $projects;
    }

    public static function project(string $slug): ?array
    {
        foreach (self::projects() as $project) {
            if (($project['slug'] ?? '') === $slug) {
                return $project;
            }
        }

        return null;
    }

    public static function featuredProjects(): array
    {
        return array_values(array_filter(self::projects(), fn ($p) => ! empty($p['featured'])));
    }

    public static function projectsForSkill(string $slug): array
    {
        return array_values(array_filter(
            self::projects(),
            fn ($p) => in_array($slug, $p['tech'] ?? [], true)
        ));
    }

    public static function heroTechSkills(): array
    {
        $slugs = self::all()['hero_tech'] ?? [];
        $map = self::skillMap();
        $out = [];
        foreach ($slugs as $slug) {
            if (isset($map[$slug])) {
                $out[] = $map[$slug];
            }
        }

        return $out;
    }

    public static function stackGuide(string $slug): ?array
    {
        $guides = config('stack-guides', []);

        return $guides[$slug] ?? null;
    }

    /**
     * Always return a guide for a skill page: custom SEO guide if present,
     * otherwise a solid generated overview so every /stack/{slug} has content.
     */
    public static function stackGuideForSkill(array $skill): array
    {
        $slug = $skill['slug'] ?? '';
        $custom = $slug !== '' ? self::stackGuide($slug) : null;
        if ($custom) {
            return $custom;
        }

        return self::buildFallbackGuide($skill);
    }

    public static function relatedSkillsFor(array $skill, int $limit = 8): array
    {
        $slug = $skill['slug'] ?? '';
        $guide = self::stackGuideForSkill($skill);
        $map = self::skillMap();
        $related = [];

        foreach ($guide['related_skills'] ?? [] as $relatedSlug) {
            if ($relatedSlug !== $slug && isset($map[$relatedSlug])) {
                $related[] = $map[$relatedSlug];
            }
        }

        if (count($related) < $limit) {
            foreach (self::skills() as $candidate) {
                if (($candidate['slug'] ?? '') === $slug) {
                    continue;
                }
                if (($candidate['category'] ?? '') !== ($skill['category'] ?? '')) {
                    continue;
                }
                if (collect($related)->contains(fn ($r) => ($r['slug'] ?? '') === ($candidate['slug'] ?? ''))) {
                    continue;
                }
                $related[] = $candidate;
                if (count($related) >= $limit) {
                    break;
                }
            }
        }

        return array_slice($related, 0, $limit);
    }

    private static function buildFallbackGuide(array $skill): array
    {
        $name = $skill['name'] ?? 'Technology';
        $slug = $skill['slug'] ?? 'skill';
        $categoryKey = $skill['category'] ?? 'tools';
        $categories = self::all()['skill_categories'] ?? [];
        $category = $categories[$categoryKey] ?? ucfirst($categoryKey);
        $proficiency = $skill['proficiency'] ?? 'proficient';
        $levelLabel = match ($proficiency) {
            'expert' => 'expert-level',
            'learning' => 'actively learning',
            default => 'proficient',
        };

        $categoryBlurb = match ($categoryKey) {
            'language' => 'programming language used across web backends, scripts, and application logic',
            'backend' => 'backend framework or runtime for APIs, servers, and application services',
            'frontend' => 'frontend library or framework for building user interfaces',
            'database' => 'database technology for storing and querying application data',
            'apis' => 'API or integration approach for connecting clients and services',
            default => 'tool in my day-to-day web development workflow',
        };

        $howIUse = match ($categoryKey) {
            'language' => "I use {$name} when writing application logic, APIs, and features that need clear, maintainable code.",
            'backend' => "I use {$name} to structure server-side features — routing, business rules, authentication, and data access.",
            'frontend' => "I use {$name} to build responsive interfaces that connect cleanly to APIs and product flows.",
            'database' => "I use {$name} for schema design, queries, and reliable data storage in web applications.",
            'apis' => "I use {$name} when designing or integrating APIs so clients get clear, secure contracts.",
            default => "I use {$name} as part of shipping and maintaining web products at Smart Sarks and on freelance work.",
        };

        $learnBullets = match ($categoryKey) {
            'language' => [
                "Learn {$name} syntax and core types before frameworks",
                'Practice small programs and API snippets daily',
                'Read official docs alongside a real mini-project',
                'Focus on readable code, errors, and debugging early',
            ],
            'backend' => [
                "Understand HTTP, routing, and middleware in {$name}",
                'Build a CRUD API with validation and auth',
                'Connect a real database and write migrations',
                'Add logging, env config, and basic tests',
            ],
            'frontend' => [
                "Learn components, state, and props/patterns in {$name}",
                'Build a small UI that talks to a JSON API',
                'Practice responsive layout and accessible markup',
                'Keep components small and reusable',
            ],
            'database' => [
                "Model tables/collections for a real domain in {$name}",
                'Practice queries, indexes, and migrations',
                'Enforce constraints — do not rely on the app alone',
                'Measure slow queries and fix N+1 access patterns',
            ],
            'apis' => [
                "Design clear resources and status codes with {$name}",
                'Document request/response shapes for clients',
                'Secure endpoints with auth and validation',
                'Test happy paths and failure cases',
            ],
            default => [
                "Learn the core workflow of {$name} with a small real task",
                'Prefer official docs over random outdated tutorials',
                'Automate what you repeat more than twice',
                'Keep notes on commands and gotchas you hit',
            ],
        };

        $related = [];
        foreach (self::skills() as $candidate) {
            if (($candidate['slug'] ?? '') === $slug) {
                continue;
            }
            if (($candidate['category'] ?? '') === $categoryKey) {
                $related[] = $candidate['slug'];
            }
            if (count($related) >= 6) {
                break;
            }
        }

        return [
            'eyebrow' => $name.' guide',
            'subtitle' => "Overview of {$name} as a {$categoryBlurb}, how I use it at {$levelLabel} proficiency, and related projects from this portfolio.",
            'seo_title' => "{$name} Developer Guide — {$category} | Madhusudan Timalsina",
            'seo_description' => "Learn about {$name} for web development: what it is, when to use it, practical guidance, and projects by Madhusudan Timalsina, a developer in Lalitpur, Nepal.",
            'h1' => "{$name} developer guide",
            'cta_label' => "Hire a developer ({$name})",
            'intro' => "{$name} is a {$categoryBlurb}. On this page you will find a practical overview, how I apply it in real work, and projects tagged with {$name}.",
            'sections' => [
                [
                    'heading' => "What is {$name}?",
                    'body' => [
                        "{$name} sits in the {$category} part of a modern web stack. Developers reach for it when they need reliable building blocks for products users actually ship.",
                        "Whether you are learning {$name} or hiring someone who knows it, the goal is the same: clear architecture, maintainable code, and features that hold up in production.",
                    ],
                ],
                [
                    'heading' => "How I use {$name}",
                    'body' => [
                        $howIUse,
                        "My current proficiency with {$name} is {$levelLabel}. That means I can contribute on real tasks".($proficiency === 'learning' ? ' while still deepening advanced patterns' : '').', especially alongside Laravel, React/Vue, Node, and SQL databases.',
                    ],
                ],
                [
                    'heading' => "Guidance for working with {$name}",
                    'bullets' => $learnBullets,
                ],
                [
                    'heading' => 'When it is a good fit',
                    'body' => [
                        "Choose {$name} when it matches your product needs and team skills. On this site, related skills and tagged projects show how {$name} connects to the rest of my stack.",
                        'Based in Lalitpur, Nepal — available for selective freelance and remote work. Use the contact page if you want help with this technology.',
                    ],
                ],
            ],
            'related_skills' => $related,
            'faqs' => [
                [
                    'question' => "What is {$name} used for?",
                    'answer' => "{$name} is used in web development as a {$categoryBlurb}. It helps teams build and maintain application features more effectively.",
                ],
                [
                    'question' => "Do you work with {$name}?",
                    'answer' => "Yes. {$name} is part of my skill set ({$levelLabel}). See related projects on this page or contact me for freelance work.",
                ],
                [
                    'question' => "Where can I see {$name} in your portfolio?",
                    'answer' => "Scroll to the projects section on this page for work tagged with {$name}, or filter the projects list by this technology.",
                ],
            ],
        ];
    }
}
