<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use App\Repository\ProjectsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * Projects constructor.
     */
    public function __construct()
    {
        $this->user = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param ArrayCollection $user
     */
    public function setUser(ArrayCollection $user): void
    {
        $this->user = $user;
    }


}
