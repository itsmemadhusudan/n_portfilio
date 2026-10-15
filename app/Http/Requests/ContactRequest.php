<?php

namespace App\Http\Requests;

use App\Rules\Turnstile;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) config('portfolio.contact.form_enabled', true);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'website' => ['nullable', 'max:0'], // honeypot
            'cf-turnstile-response' => ['required', 'string', new Turnstile],
        ];
    }

    public function messages(): array
    {
        return [
            'website.max' => 'Unable to send this message.',
            'message.min' => 'Please write at least a short message (10+ characters).',
            'cf-turnstile-response.required' => 'Please complete the captcha verification.',
        ];
    }
}
