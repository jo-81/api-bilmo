<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class MeController
{
    public function __construct(private Security $security)
    {
    }

    public function __invoke(): ?User
    {
        /** @var User|null */
        $user = $this->security->getUser();

        return $user;
    }
}
