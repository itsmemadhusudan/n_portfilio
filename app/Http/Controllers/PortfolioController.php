<?php

namespace App\Http\Controllers;

use App\Support\Portfolio;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PortfolioController extends Controller
{
    public function home(): View
    {
        return $this->page('portfolio.home', 'home', [
            'skillsByCategory' => Portfolio::skillsByCategory(),
            'heroTech' => Portfolio::heroTechSkills(),
            'featuredProjects' => Portfolio::featuredProjects(),
            'skillMap' => Portfolio::skillMap(),
        ]);
    }

    public function about(): View
    {
        return $this->page('portfolio.about', 'about');
    }

    public function skills(): View
    {
        return $this->page('portfolio.skills', 'skills', [
            'skillsByCategory' => Portfolio::skillsByCategory(),
            'skillCategories' => config('portfolio.skill_categories', []),
        ]);
    }

    public function projects(): View
    {
        return $this->page('portfolio.projects', 'projects', [
            'projects' => Portfolio::projects(),
            'skills' => Portfolio::skills(),
            'skillMap' => Portfolio::skillMap(),
        ]);
    }

    public function projectShow(string $slug): View
    {
        $project = Portfolio::project($slug);
        if (! $project) {
            throw new NotFoundHttpException;
        }

        $name = $project['name'] ?? 'Project';
        $summary = $project['summary'] ?? ($project['desc'] ?? config('portfolio.seo.default_description'));

        return $this->page('portfolio.project-show', 'projects', [
            'project' => $project,
            'skillMap' => Portfolio::skillMap(),
        ], [
            'title' => $name.' | Developer Portfolio – Madhusudan Timalsina',
            'description' => $summary.' Web development case study by a web developer in Lalitpur, Nepal.',
            'path' => '/projects/'.$slug,
            'h1' => $name,
        ]);
    }

    public function stackShow(string $slug): View
    {
        $skill = Portfolio::skill($slug);
        if (! $skill) {
            throw new NotFoundHttpException;
        }

        $projects = Portfolio::projectsForSkill($slug);
        $name = $skill['name'];

        return $this->page('portfolio.stack-show', 'skills', [
            'skill' => $skill,
            'projects' => $projects,
            'skillMap' => Portfolio::skillMap(),
        ], [
            'title' => $name.' developer projects | Madhusudan Timalsina',
            'description' => $name.' developer projects from Madhusudan Timalsina, a web developer in Lalitpur, Nepal. Filter my developer portfolio by '.$name.'.',
            'path' => '/stack/'.$slug,
            'h1' => $name.' developer projects',
        ]);
    }

    public function education(): View
    {
        return $this->page('portfolio.education', 'education');
    }

    public function contact(): View
    {
        return $this->page('portfolio.contact', 'contact');
    }

    private function page(string $view, string $pageKey, array $extra = [], array $seoOverride = []): View
    {
        $portfolio = config('portfolio');
        $seo = $portfolio['seo'] ?? [];
        $page = $seo['pages'][$pageKey] ?? [];

        $siteUrl = rtrim($seo['site_url'] ?? config('app.url'), '/');
        $path = $seoOverride['path'] ?? ($page['path'] ?? '/');
        $canonical = $siteUrl.($path === '/' ? '/' : $path);
        $imagePath = $seo['image'] ?? '/favicon.png';
        $ogImage = str_starts_with($imagePath, 'http')
            ? $imagePath
            : $siteUrl.'/'.ltrim($imagePath, '/');

        return view($view, array_merge([
            'portfolio' => $portfolio,
            'pageKey' => $pageKey,
            'seo' => [
                'site_url' => $siteUrl,
                'site_name' => $seo['site_name'] ?? $portfolio['brand'],
                'title' => $seoOverride['title'] ?? ($page['title'] ?? ($seo['default_title'] ?? $portfolio['brand'])),
                'description' => $seoOverride['description'] ?? ($page['description'] ?? ($seo['default_description'] ?? $portfolio['bio'])),
                'keywords' => implode(', ', $seo['keywords'] ?? []),
                'canonical' => $canonical,
                'path' => $path,
                'h1' => $seoOverride['h1'] ?? ($page['h1'] ?? null),
                'og_image' => $ogImage,
                'og_image_alt' => $seo['image_alt'] ?? $portfolio['full_name'],
                'locale' => $seo['locale'] ?? 'en_US',
                'theme_color' => $seo['theme_color'] ?? '#0a0a1f',
                'twitter' => $seo['twitter'] ?? null,
                'faqs' => $seo['faqs'] ?? [],
                'knows_about' => $seo['knows_about'] ?? [],
                'area_served' => $seo['area_served'] ?? [],
            ],
        ], $extra));
    }
}
