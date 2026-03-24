<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CentrifugoService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function publish(string $channel, array $data): void
    {
        $url = rtrim((string) config('centrifugo.url'), '/').'/api/publish';

        $response = Http::withHeaders([
            'X-API-Key' => (string) config('centrifugo.api_key'),
        ])->post($url, [
            'channel' => $channel,
            'data' => $data,
        ]);

        $response->throw();
    }

    public function generateConnectionToken(int $userId): string
    {
        return $this->generateToken([
            'sub' => (string) $userId,
        ]);
    }

    /**
     * @param  array<string, mixed>  $claims
     */
    public function generateSubscriptionToken(int $userId, string $channel, array $claims = []): string
    {
        return $this->generateToken([
            'sub' => (string) $userId,
            'channel' => $channel,
            ...$claims,
        ]);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function generateToken(array $payload): string
    {
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];
        $payload['iat'] = time();
        $payload['exp'] = time() + (int) config('centrifugo.token_ttl');
        $payload['jti'] = (string) Str::uuid();

        $encodedHeader = $this->base64UrlEncode(json_encode($header));
        $encodedPayload = $this->base64UrlEncode(json_encode($payload));
        $signature = $this->base64UrlEncode(hash_hmac('sha256', $encodedHeader.'.'.$encodedPayload, (string) config('centrifugo.token_secret'), true));

        return $encodedHeader.'.'.$encodedPayload.'.'.$signature;
    }

    private function base64UrlEncode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }
}
