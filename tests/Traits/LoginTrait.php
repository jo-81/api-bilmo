<?php

namespace App\Tests\Traits;

use ApiPlatform\Symfony\Bundle\Test\Client;

trait LoginTrait
{
    private ?string $token = null;

    public function createClientWithCredentials(string $token = null): Client
    {
        $token = $token ?: $this->getToken();

        return static::createClient([], ['headers' => ['authorization' => 'Bearer '.$token]]);
    }

    /**
     * getToken.
     *
     * @param array<string> $body
     */
    public function getToken(array $body = []): string
    {
        if ($this->token) {
            return $this->token;
        }

        $response = static::createClient()->request('POST', '/auth', ['json' => $body ?: [
            'username' => 'admin',
            'password' => '0000',
        ]]);

        $data = $response->toArray();
        $this->token = $data['token'];

        return $data['token'];
    }
}
