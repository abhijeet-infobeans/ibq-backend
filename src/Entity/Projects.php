<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 */
class Projects
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Unique()
     */
    private $project_name;

    /**
     * @ORM\Column(type="text")
     */
    private $project_description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $project_start_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $project_end_date;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project_created_by;


    /**
     * Projects constructor.
     */
    public function __construct()
    {
        $this->project_created_by = new ArrayCollection();
    }
    /**
     * @return mixed
     */
    public function getProjectName()
    {
        return $this->project_name;
    }

    /**
     * @param mixed $project_name
     */
    public function setProjectName($project_name): void
    {
        $this->project_name = $project_name;
    }

    /**
     * @return mixed
     */
    public function getProjectDescription()
    {
        return $this->project_description;
    }

    /**
     * @param mixed $project_description
     */
    public function setProjectDescription($project_description): void
    {
        $this->project_description = $project_description;
    }

    /**
     * @return mixed
     */
    public function getProjectStartDate()
    {
        return $this->project_start_date;
    }

    /**
     * @param mixed $project_start_date
     */
    public function setProjectStartDate($project_start_date): void
    {
        $this->project_start_date = $project_start_date;
    }

    /**
     * @return mixed
     */
    public function getProjectEndDate()
    {
        return $this->project_end_date;
    }

    /**
     * @param mixed $project_end_date
     */
    public function setProjectEndDate($project_end_date): void
    {
        $this->project_end_date = $project_end_date;
    }

    /**
     * @return mixed
     */
    public function getProjectCreatedBy()
    {
        return $this->project_created_by;
    }

    /**
     * @param mixed $project_created_by
     */
    public function setProjectCreatedBy($project_created_by): void
    {
        $this->project_created_by = $project_created_by;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
}
