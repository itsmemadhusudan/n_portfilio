<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    private function fakeTurnstile(bool $success = true): void
    {
        Http::fake([
            'https://challenges.cloudflare.com/*' => Http::response([
                'success' => $success,
            ], 200),
            'https://api.mailjet.com/*' => Http::response([
                'Messages' => [[
                    'Status' => 'success',
                ]],
            ], 200),
        ]);
    }

    public function test_contact_form_sends_owner_and_confirmation_mail(): void
    {
        $this->fakeTurnstile(true);

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Hello',
            'message' => 'I would like to discuss a Laravel API project with you.',
            'website' => '',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertRedirect(route('contact').'#contact-form');
        $response->assertSessionHas('contact_success');

        Http::assertSentCount(3); // 1 turnstile + 2 mailjet
    }

    public function test_contact_form_rejects_honeypot_bots(): void
    {
        $this->fakeTurnstile(true);

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'message' => 'Spam message that is long enough.',
            'website' => 'https://spam.example',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertSessionHasErrors('website');
        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'api.mailjet.com'));
    }

    public function test_contact_form_requires_turnstile(): void
    {
        $this->fakeTurnstile(true);

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'message' => 'I would like to discuss a Laravel API project with you.',
            'website' => '',
        ]);

        $response->assertSessionHasErrors('cf-turnstile-response');
        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'api.mailjet.com'));
    }

    public function test_contact_form_rejects_failed_turnstile(): void
    {
        $this->fakeTurnstile(false);

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'message' => 'I would like to discuss a Laravel API project with you.',
            'website' => '',
            'cf-turnstile-response' => 'bad-token',
        ]);

        $response->assertSessionHasErrors('cf-turnstile-response');
        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'api.mailjet.com'));
    }

    public function test_contact_form_shows_error_when_mailjet_fails(): void
    {
        Http::fake([
            'https://challenges.cloudflare.com/*' => Http::response(['success' => true], 200),
            'https://api.mailjet.com/*' => Http::response(['Messages' => [['Status' => 'error']]], 200),
        ]);

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'message' => 'I would like to discuss a Laravel API project with you.',
            'website' => '',
            'cf-turnstile-response' => 'test-token',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('contact_error');
    }
}
