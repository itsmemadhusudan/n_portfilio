<?php

namespace Tests\Feature;

use App\Mail\ContactMessageConfirmation;
use App\Mail\ContactMessageReceived;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_form_sends_owner_and_confirmation_mail(): void
    {
        Mail::fake();

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Hello',
            'message' => 'I would like to discuss a Laravel API project with you.',
            'website' => '',
        ]);

        $response->assertRedirect(route('contact').'#contact-form');
        $response->assertSessionHas('contact_success');

        Mail::assertSent(ContactMessageReceived::class, function (ContactMessageReceived $mail) {
            return $mail->senderEmail === 'visitor@example.com'
                && $mail->hasTo(config('mail.contact_to'));
        });

        Mail::assertSent(ContactMessageConfirmation::class, function (ContactMessageConfirmation $mail) {
            return $mail->hasTo('visitor@example.com');
        });
    }

    public function test_contact_form_rejects_honeypot_bots(): void
    {
        Mail::fake();

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'message' => 'Spam message that is long enough.',
            'website' => 'https://spam.example',
        ]);

        $response->assertSessionHasErrors('website');
        Mail::assertNothingSent();
    }
}
