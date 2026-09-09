<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageConfirmation;
use App\Mail\ContactMessageReceived;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $subject = filled($data['subject'] ?? null)
            ? $data['subject']
            : 'New message from '.$data['name'];

        $to = config('mail.contact_to') ?: config('portfolio.email');

        try {
            Mail::to($to)->send(new ContactMessageReceived(
                senderName: $data['name'],
                senderEmail: $data['email'],
                subjectLine: $subject,
                bodyMessage: $data['message'],
            ));

            Mail::to($data['email'])->send(new ContactMessageConfirmation(
                senderName: $data['name'],
                subjectLine: $subject,
                bodyMessage: $data['message'],
            ));
        } catch (Throwable $e) {
            Log::error('Contact form mail failed', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('contact_error', 'Sorry — the message could not be sent right now. Please email me directly or try again later.');
        }

        return redirect()
            ->route('contact')
            ->with('contact_success', config('portfolio.contact.form_success'))
            ->withFragment('contact-form');
    }
}
