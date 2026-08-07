<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function home(): View
    {
        return $this->page('portfolio.home', 'home');
    }

    public function about(): View
    {
        return $this->page('portfolio.about', 'about');
    }

    public function skills(): View
    {
        return $this->page('portfolio.skills', 'skills');
    }

    public function projects(): View
    {
        return $this->page('portfolio.projects', 'projects');
    }

    public function education(): View
    {
        return $this->page('portfolio.education', 'education');
    }

    public function contact(): View
    {
        return $this->page('portfolio.contact', 'contact');
    }

    private function page(string $view, string $pageKey): View
    {
        $portfolio = config('portfolio');
        $seo = $portfolio['seo'] ?? [];
        $page = $seo['pages'][$pageKey] ?? [];

        $siteUrl = rtrim($seo['site_url'] ?? config('app.url'), '/');
        $path = $page['path'] ?? '/';
        $canonical = $siteUrl.($path === '/' ? '/' : $path);
        $imagePath = $seo['image'] ?? '/favicon.png';
        $ogImage = str_starts_with($imagePath, 'http')
            ? $imagePath
            : $siteUrl.'/'.ltrim($imagePath, '/');

        return view($view, [
            'portfolio' => $portfolio,
            'pageKey' => $pageKey,
            'seo' => [
                'site_url' => $siteUrl,
                'site_name' => $seo['site_name'] ?? $portfolio['brand'],
                'title' => $page['title'] ?? ($seo['default_title'] ?? $portfolio['brand']),
                'description' => $page['description'] ?? ($seo['default_description'] ?? $portfolio['bio']),
                'keywords' => implode(', ', $seo['keywords'] ?? []),
                'canonical' => $canonical,
                'path' => $path,
                'h1' => $page['h1'] ?? null,
                'og_image' => $ogImage,
                'og_image_alt' => $seo['image_alt'] ?? $portfolio['full_name'],
                'locale' => $seo['locale'] ?? 'en_US',
                'theme_color' => $seo['theme_color'] ?? '#020205',
                'twitter' => $seo['twitter'] ?? null,
                'faqs' => $seo['faqs'] ?? [],
            ],
        ]);
    }
}
