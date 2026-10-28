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
        $this->sendMany([[
            'to' => $to,
            'subject' => $subject,
            'html' => $html,
            'text' => $text,
            'reply_to' => $replyTo,
        ]]);
    }

    /**
     * Send one or more messages in a single Mailjet API round-trip.
     *
     * @param  list<array{to: array{email: string, name?: string}, subject: string, html: string, text?: string, reply_to?: array{email: string, name?: string}|null}>  $messages
     */
    public function sendMany(array $messages): void
    {
        $apiKey = config('services.mailjet.key');
        $apiSecret = config('services.mailjet.secret');

        if (empty($apiKey) || empty($apiSecret)) {
            throw new RuntimeException('Mailjet API credentials are missing.');
        }

        if ($messages === []) {
            throw new RuntimeException('No Mailjet messages to send.');
        }

        $payload = [];
        foreach ($messages as $item) {
            $message = [
                'From' => [
                    'Email' => config('mail.from.address'),
                    'Name' => config('mail.from.name'),
                ],
                'To' => [[
                    'Email' => $item['to']['email'],
                    'Name' => $item['to']['name'] ?? $item['to']['email'],
                ]],
                'Subject' => $item['subject'],
                'HTMLPart' => $item['html'],
                'TextPart' => ($item['text'] ?? '') !== '' ? $item['text'] : strip_tags($item['html']),
            ];

            if (! empty($item['reply_to'])) {
                $message['ReplyTo'] = [
                    'Email' => $item['reply_to']['email'],
                    'Name' => $item['reply_to']['name'] ?? $item['reply_to']['email'],
                ];
            }

            $payload[] = $message;
        }

        $response = Http::withBasicAuth($apiKey, $apiSecret)
            ->acceptJson()
            ->asJson()
            ->timeout(12)
            ->connectTimeout(4)
            ->post('https://api.mailjet.com/v3.1/send', [
                'Messages' => $payload,
            ]);

        if (! $response->successful()) {
            Log::error('Mailjet API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new RuntimeException('Mailjet API request failed (HTTP '.$response->status().').');
        }

        foreach ($response->json('Messages') ?? [] as $index => $result) {
            if (($result['Status'] ?? null) !== 'success') {
                Log::error('Mailjet API rejected message', [
                    'index' => $index,
                    'response' => $result,
                ]);

                throw new RuntimeException('Mailjet rejected the message.');
            }
        }
    }
}
