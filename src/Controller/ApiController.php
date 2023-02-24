<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

#[Route('/api')]
class ApiController extends AbstractController
{

    public function __construct(
         RequestStack $requestStack,
         public readonly UserPasswordHasherInterface $passwordHasher
    )
    {
        $apiKey = $requestStack->getCurrentRequest()->headers->get('X-API-KEY');

        if ($apiKey !== $_ENV['AUTH_TOKEN']) {
            throw $this->createAccessDeniedException('Error, Unauthorized !');
        }
    }
}