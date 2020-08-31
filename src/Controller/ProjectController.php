<?php

namespace App\Controller;

use App\Service\ProjectService;
use App\Service\ReadJWTTokenService;
use App\Service\UserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractFOSRestController
{
    /**
     * @var ReadJWTTokenService
     */
    private $readJWTTokenService;

    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ProjectService
     */
    private $projectService;

    /**
     * ProjectController constructor.
     * @param ReadJWTTokenService $readJWTTokenService
     * @param UserService $userService
     * @param ProjectService $projectService
     */
    public function __construct(
        ReadJWTTokenService $readJWTTokenService,
        UserService $userService,
        ProjectService $projectService
    )
    {
        $this->userService = $userService;
        $this->readJWTTokenService = $readJWTTokenService;
        $this->projectService = $projectService;
    }

    /**
     * @Rest\Get("/api/v1/projectList", name="project_list")
     */
    public function list(): View
    {
        $userEmail = $this->readJWTTokenService->getUsernameFromToken();
        $projectList = [];
        if($userEmail)
        {
            $projectList = $this->projectService->getAllProjects();
            return View::create($projectList, Response::HTTP_OK);
        }
        return View::create(['message' => 'Something went wrong'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
