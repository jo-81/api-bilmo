<?php

namespace App\Tests;

use App\Tests\Traits\LoginTrait;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class UserTest extends ApiTestCase
{
    use ReloadDatabaseTrait;
    use LoginTrait;
    
    /**
     * testAccessRouteWhenUserNotLogged
     * Si un utilisateur n'est pas connecé et voulant accéder à api/user/{id}
     *
     * @return void
     */
    public function testAccessRouteWhenUserNotLogged(): void
    {
        $client = self::createClient();
        $client->request('GET', '/api/users/1');

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
    
    /**
     * testAccessRouteIfUserLoggedAndNotId
     * Si un utilisateur connecté voulant accéder à api/user/{id} mais $user->id != $id
     *
     * @return void
     */
    public function testAccessRouteIfUserLoggedAndNotId()
    {
        $client = $this->createClientWithCredentials();
        $client->request('GET', '/api/users/1');

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }
    
    /**
     * testAccessRouteIfUserLoggedAndId
     * Si un utilisateur connecté voulant accéder à api/user/{id} mais $user->id == $id
     *
     * @return void
     */
    public function testAccessRouteIfUserLoggedAndId(): void
    {
        $client = $this->createClientWithCredentials();
        $client->request('GET', '/api/users/31');

        $this->assertResponseIsSuccessful();
    }
}
