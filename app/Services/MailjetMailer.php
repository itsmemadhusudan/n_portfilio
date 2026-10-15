<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class MailjetMailer
{
    /**
     * @param  array{email: string, name?: string}  $to
     * @param  array{email: string, name?: string}|null  $replyTo
     */
    public function send(
        array $to,
        string $subject,
        string $html,
        string $text = '',
        ?array $replyTo = null,
    ): void {
        $apiKey = config('services.mailjet.key');
        $apiSecret = config('services.mailjet.secret');

        if (empty($apiKey) || empty($apiSecret)) {
            throw new RuntimeException('Mailjet API credentials are missing.');
        }

        $message = [
            'From' => [
                'Email' => config('mail.from.address'),
                'Name' => config('mail.from.name'),
            ],
            'To' => [[
                'Email' => $to['email'],
                'Name' => $to['name'] ?? $to['email'],
            ]],
            'Subject' => $subject,
            'HTMLPart' => $html,
            'TextPart' => $text !== '' ? $text : strip_tags($html),
        ];

        if ($replyTo) {
            $message['ReplyTo'] = [
                'Email' => $replyTo['email'],
                'Name' => $replyTo['name'] ?? $replyTo['email'],
            ];
        }

        $response = Http::withBasicAuth($apiKey, $apiSecret)
            ->acceptJson()
            ->asJson()
            ->timeout(20)
            ->post('https://api.mailjet.com/v3.1/send', [
                'Messages' => [$message],
            ]);

        if (! $response->successful()) {
            Log::error('Mailjet API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new RuntimeException('Mailjet API request failed (HTTP '.$response->status().').');
        }

        $status = data_get($response->json(), 'Messages.0.Status');
        if ($status !== 'success') {
            Log::error('Mailjet API rejected message', [
                'response' => $response->json(),
            ]);

            throw new RuntimeException('Mailjet rejected the message.');
        }
    }
}
