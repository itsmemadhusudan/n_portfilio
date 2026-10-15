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

        $to = config('mail.contact_to') ?: config('portfolio.email');

        try {
            $ownerMail = new ContactMessageReceived(
                senderName: $data['name'],
                senderEmail: $data['email'],
                subjectLine: $subject,
                bodyMessage: $data['message'],
            );

            $confirmMail = new ContactMessageConfirmation(
                senderName: $data['name'],
                subjectLine: $subject,
                bodyMessage: $data['message'],
            );

            $mailjet->send(
                to: ['email' => $to, 'name' => config('mail.from.name')],
                subject: $ownerMail->envelope()->subject ?? ('Portfolio contact: '.$subject),
                html: $ownerMail->render(),
                replyTo: ['email' => $data['email'], 'name' => $data['name']],
            );

            $mailjet->send(
                to: ['email' => $data['email'], 'name' => $data['name']],
                subject: $confirmMail->envelope()->subject ?? 'Thanks for reaching out',
                html: $confirmMail->render(),
            );

            Log::info('Contact form mail sent via Mailjet', [
                'to_owner' => $to,
                'to_visitor' => $data['email'],
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
