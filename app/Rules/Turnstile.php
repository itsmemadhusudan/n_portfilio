<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Turnstile implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || $value === '') {
            $fail('Please complete the captcha verification.');

            return;
        }

        // Local-only bypass so automated / manual smoke tests can submit the form.
        if (app()->environment('local') && $value === 'local-dev-ok') {
            return;
        }

        $secret = config('services.turnstile.secret_key');
        if (empty($secret)) {
            $fail('Captcha is not configured.');

            return;
        }

        try {
            $response = Http::asForm()
                ->timeout(8)
                ->post(config('services.turnstile.verify_url'), [
                    'secret' => $secret,
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]);
        } catch (\Throwable) {
            $fail('Captcha verification failed. Please try again.');

            return;
        }

        if (! $response->successful() || ! ($response->json('success') === true)) {
            $fail('Captcha verification failed. Please try again.');
        }
    }
}
