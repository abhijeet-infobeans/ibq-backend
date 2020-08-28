<?php

namespace App\Controller;

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

    public function __construct(UserService $userService)
    {

        $this->userService = $userService;
    }

    /**
     * @Route("/getUserByEmail", name="user_getUserByEmail")
     * @param Request $request
     * @return View
     */
    public function getUserByEmail(Request $request): View
    {
        $userRecord = $this->userService->getUserByEmail($request->get('email'));
        $responseArray = [
            'success' => true,
            'data' => $userRecord
        ];
        return View::create($responseArray, Response::HTTP_OK);
    }
}
