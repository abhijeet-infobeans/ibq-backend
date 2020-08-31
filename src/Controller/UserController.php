<?php

namespace App\Controller;

use App\Service\ReadJWTTokenService;
use App\Service\UserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Rest\Route("/api/v1")
 */
class UserController extends AbstractFOSRestController
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ReadJWTTokenService
     */
    private $readJWTTokenService;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param ReadJWTTokenService $readJWTTokenService
     */
    public function __construct(UserService $userService, ReadJWTTokenService $readJWTTokenService)
    {

        $this->userService = $userService;
        $this->readJWTTokenService = $readJWTTokenService;
    }

    /**
     * @Route("/getUserByEmail", name="user_getUserByEmail")
     * @param Request $request
     * @return View
     */
    public function getUserByEmail(Request $request): View
    {
        $email = $this->readJWTTokenService->getUsernameFromToken();
        $userRecord = $this->userService->getUserByEmail($email);
        $responseArray = [
            'success' => true,
            'data' => $userRecord
        ];
        return View::create($responseArray, Response::HTTP_OK);
    }
}
