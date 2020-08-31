<?php


namespace App\Service;


use App\Repository\ProjectsRepository;

class ProjectService
{
    /**
     * @var ProjectsRepository
     */
    private $projectsRepository;

    /**
     * ProjectService constructor.
     * @param ProjectsRepository $projectsRepository
     */
    public function __construct(ProjectsRepository $projectsRepository)
    {

        $this->projectsRepository = $projectsRepository;
    }

    /**
     * @return \App\Entity\Projects[]
     */
    public function getAllProjects()
    {
        return $this->projectsRepository->findBy([],['id' => 'DESC']);
    }
}