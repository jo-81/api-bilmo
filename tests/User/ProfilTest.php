<?php

namespace App\Tests;

use App\Tests\Traits\LoginTrait;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class ProfilTest extends ApiTestCase
{
    use ReloadDatabaseTrait;
    use LoginTrait;

    public function testAccessRouteProfilWhenUserNotLogged(): void
    {
        $client = self::createClient();
        $client->request('GET', '/api/me');

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testAccessRouteProfilWhenUserLogged(): void
    {
        $client = $this->createClientWithCredentials();
        $client->request('GET', '/api/me');

        $this->assertResponseIsSuccessful();
    }
}
