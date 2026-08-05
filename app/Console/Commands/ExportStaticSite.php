<?php

namespace App\Console\Commands;

use App\Http\Controllers\PortfolioController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;

class ExportStaticSite extends Command
{
    protected $signature = 'site:export
        {--base= : Absolute URL the export will be served from, e.g. https://user.github.io/repo}
        {--output=docs : Directory to write the static site into}';

    protected $description = 'Render every portfolio page to static HTML so a static host such as GitHub Pages can serve it';

    /**
     * Route name paired with the controller method that renders it.
     */
    private const PAGES = [
        'home' => 'home',
        'about' => 'about',
        'skills' => 'skills',
        'projects' => 'projects',
        'education' => 'education',
        'contact' => 'contact',
    ];

    private const COPIED_FILES = ['favicon.ico', 'robots.txt'];

    public function handle(PortfolioController $controller): int
    {
        if (! File::exists(public_path('build/manifest.json'))) {
            $this->components->error('public/build/manifest.json is missing. Run "npm run build" first.');

            return self::FAILURE;
        }

        $base = rtrim($this->option('base') ?: config('app.url'), '/');
        $output = base_path($this->option('output'));

        URL::forceRootUrl($base);
        URL::useAssetOrigin($base);

        // A running "npm run dev" leaves public/hot behind, which would otherwise
        // point the exported pages at the local Vite server instead of the build.
        Vite::useHotFile(storage_path('framework/static-export-hot'));

        File::deleteDirectory($output);
        File::ensureDirectoryExists($output);

        foreach (self::PAGES as $routeName => $method) {
            $path = $routeName === 'home' ? '' : $routeName;

            $this->bindRequest($path, $routeName);

            $target = $output.'/'.($path === '' ? '' : $path.'/').'index.html';
            File::ensureDirectoryExists(dirname($target));
            File::put($target, $controller->{$method}()->render());

            $this->components->twoColumnDetail($routeName, $this->relative($target));
        }

        File::copyDirectory(public_path('build'), $output.'/build');
        $this->components->twoColumnDetail('assets', $this->relative($output.'/build'));

        foreach (self::COPIED_FILES as $file) {
            if (File::exists(public_path($file))) {
                File::copy(public_path($file), $output.'/'.$file);
            }
        }

        // Without this, GitHub Pages runs the output through Jekyll and drops
        // directories and files whose names begin with an underscore.
        File::put($output.'/.nojekyll', '');

        $this->newLine();
        $this->components->info('Static site exported to '.$this->relative($output).' for '.$base);

        return self::SUCCESS;
    }

    /**
     * Give the views a request that resolves to the page being exported, so
     * route() and the nav's active-link check behave as they do when served.
     */
    private function bindRequest(string $path, string $routeName): void
    {
        $request = Request::create('/'.$path, 'GET');

        if ($route = Route::getRoutes()->getByName($routeName)) {
            $request->setRouteResolver(fn () => $route);
        }

        $this->laravel->instance('request', $request);
        Facade::clearResolvedInstance('request');

        URL::forceRootUrl(rtrim($this->option('base') ?: config('app.url'), '/'));
    }

    private function relative(string $path): string
    {
        return str_replace(base_path().DIRECTORY_SEPARATOR, '', $path);
    }
}
