<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function home(): View
    {
        return $this->page('portfolio.home', 'Home');
    }

    public function about(): View
    {
        return $this->page('portfolio.about', 'About');
    }

    public function skills(): View
    {
        return $this->page('portfolio.skills', 'Skills');
    }

    public function projects(): View
    {
        return $this->page('portfolio.projects', 'Projects');
    }

    public function education(): View
    {
        return $this->page('portfolio.education', 'Education');
    }

    public function contact(): View
    {
        return $this->page('portfolio.contact', 'Contact');
    }

    private function page(string $view, string $pageTitle): View
    {
        return view($view, [
            'portfolio' => config('portfolio'),
            'pageTitle' => $pageTitle,
        ]);
    }
}
