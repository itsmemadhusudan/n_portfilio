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
}
