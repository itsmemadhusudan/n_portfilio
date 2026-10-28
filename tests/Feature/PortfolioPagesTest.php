<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioPagesTest extends TestCase
{
    public function test_home_uses_developer_title_and_seo(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Developer building web', false);
        $response->assertSee('applications and APIs', false);
        $response->assertSee('heroTypewriter(', false);
        $response->assertDontSee('Full-stack', false);
        $response->assertSee('Madhusudan Timalsina | Developer', false);
        $response->assertDontSee('Backend Developer', false);
        $response->assertSee('How this site is built', false);
        $response->assertSee('areaServed', false);
    }

    public function test_home_does_not_expose_backend_developer_identity(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $this->assertStringNotContainsString('Backend Developer', $response->getContent());
    }

    public function test_projects_page_has_filter_markup(): void
    {
        $response = $this->get('/projects');

        $response->assertOk();
        $response->assertSee('data-project-filters', false);
        $response->assertSee('projectFilters(', false);
        $response->assertSee('Filter by type', false);
        $response->assertSee('Filter by technology', false);
        $this->assertStringNotContainsString('Backend Developer', $response->getContent());
    }

    public function test_project_show_returns_200_for_known_slug(): void
    {
        $response = $this->get('/projects/yfasma');

        $response->assertOk();
        $response->assertSee('Yfasma', false);
        $response->assertSee('Tech stack', false);
    }

    public function test_project_show_returns_404_for_unknown_slug(): void
    {
        $this->get('/projects/does-not-exist')->assertNotFound();
    }

    public function test_stack_show_returns_200_for_known_skill(): void
    {
        $response = $this->get('/stack/laravel');

        $response->assertOk();
        $response->assertSee('Laravel', false);
        $response->assertSee('Yfasma', false);
    }

    public function test_stack_show_returns_404_for_unknown_skill(): void
    {
        $this->get('/stack/does-not-exist')->assertNotFound();
    }

    public function test_skills_page_renders_tabs(): void
    {
        $response = $this->get('/skills');

        $response->assertOk();
        $response->assertSee('skills-tabs', false);
        $response->assertSee('Learning', false);
    }
}
