<?php


namespace App\Service;


use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ReadJWTTokenService
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorageInterface;
    /**
     * @var JWTTokenManagerInterface
     */
    private $JWTTokenManager;

    /**
     * ReadJWTTokenService constructor.
     * @param TokenStorageInterface $tokenStorageInterface
     * @param JWTTokenManagerInterface $JWTTokenManager
     */
    public function __construct(
        TokenStorageInterface $tokenStorageInterface,
        JWTTokenManagerInterface $JWTTokenManager
    )
    {
        $this->tokenStorageInterface = $tokenStorageInterface;
        $this->JWTTokenManager = $JWTTokenManager;
    }

    /**
     * Get username from JWT token
     * @return string
     */
    public function getUsernameFromToken(): string
    {
        $decodedData = $this->JWTTokenManager->decode($this->tokenStorageInterface->getToken());
        return $decodedData['username'];
    }
}