<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageConfirmation;
use App\Mail\ContactMessageReceived;
use App\Services\MailjetMailer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContactController extends Controller
{
    public function store(ContactRequest $request, MailjetMailer $mailjet): RedirectResponse
    {
        $data = $request->validated();
        $subject = filled($data['subject'] ?? null)
            ? $data['subject']
            : 'New message from '.$data['name'];

        // Always deliver the filled form data to this inbox.
        $ownerEmail = 'timmadh@gmail.com';
        $visitorEmail = $data['email'];

        try {
            $ownerMail = new ContactMessageReceived(
                senderName: $data['name'],
                senderEmail: $visitorEmail,
                subjectLine: $subject,
                bodyMessage: $data['message'],
            );

            $confirmMail = new ContactMessageConfirmation(
                senderName: $data['name'],
                subjectLine: $subject,
                bodyMessage: $data['message'],
            );

            // 1) Full form data → your inbox
            $mailjet->send(
                to: ['email' => $ownerEmail, 'name' => 'Madhusudan Timalsina'],
                subject: 'New portfolio contact from '.$data['name'].' — '.$subject,
                html: $ownerMail->render(),
                replyTo: ['email' => $visitorEmail, 'name' => $data['name']],
            );

            // 2) Thank-you confirmation → the person who filled the form
            $mailjet->send(
                to: ['email' => $visitorEmail, 'name' => $data['name']],
                subject: 'Thank you for your message | Madhusudan Timalsina',
                html: $confirmMail->render(),
            );

            Log::info('Contact form mail sent via Mailjet', [
                'to_owner' => $ownerEmail,
                'to_visitor' => $visitorEmail,
                'subject' => $subject,
            ]);
        } catch (Throwable $e) {
            Log::error('Contact form mail failed', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('contact_error', 'Sorry. The message could not be sent right now. Please email me directly or try again later.');
        }

        return redirect()
            ->route('contact')
            ->with('contact_success', config('portfolio.contact.form_success'))
            ->withFragment('contact-form');
    }
}
