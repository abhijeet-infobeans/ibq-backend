<?php

namespace App\DataFixtures;

use App\Entity\Projects;
use App\Entity\Users;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private const USERS = [
        [
            'email' => 'abhijeet@infobeans.com',
            'password' => 'welcome123',
            'roles' => [Users::ROLE_USER],
            'full_name' => 'Abhijeet Dange'
        ],
        [
            'email' => 'anil@infobeans.com',
            'password' => 'welcome123',
            'roles' => [Users::ROLE_USER],
            'full_name' => 'Anil Info'
        ],
        [
            'email' => 'nk@infobeans.com',
            'password' => 'welcome123',
            'roles' => [Users::ROLE_USER],
            'full_name' => 'Nikhil Kumar'
        ]
    ];
    private const PROJECTS = [
        [
            'project_name' => 'Project 1 The iterator',
            'project_description' => 'This iterator allows to unset and modify values and keys while iterating over Arrays and Objects.
When you want to iterate over the same array multiple times you need to instantiate ArrayObject and let it create ArrayIterator instances that refer to it either by using foreach or by calling its getIterator() method manually.',
        ],
        [
            'project_name' => 'Setup Devops for IB-Q project',
            'project_description' => 'You can use the manually downloaded local PHP code quality tool scripts or scripts associated with PHP interpreters. There can be a number of local and remote PHP interpreters, the one specified on the PHP page of the Settings/Preferences dialog is considered Project Default. Learn more about configuring PHP interpreters in Configure remote PHP interpreters or in Configure local PHP interpreters.'
        ],
        [
            'project_name' => 'Project 3 Configure a PHP_CodeSniffer script associated',
            'project_description' => 'You can include information on the default and custom PHP_CodeSniffer rulesets inside the scripts section of composer.json. When you install or update project dependencies, the specified rulesets will be detected and the PHP_CodeSniffer validation inspection will be enabled automatically.'],
        [
            'project_name' => 'Project 5 automation in symfony project',
            'project_description' => 'From the Severity list, choose the severity degree for the PHP_CodeSniffer inspection. The selected value determines how serious the detected discrepancies will be treated by PhpStorm and presented in the inspection results.'],
        [
            'project_name' => 'YRF singer',
            'project_description' => 'To use one of the predefined coding standards, select it the Coding standard list, appoint the coding style to check your code against. The list contains all the coding standards installed inside the main php_codesniffer directory structure.'],
    ];
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->loadUsers($manager);
        $this->loadProjects($manager);
    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new Users();
        foreach (self::USERS as $userData)
        {
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $user->setFullName($userData['full_name']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $userData['password']));
            $this->addReference($userData['email'], $user);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function loadProjects(ObjectManager $manager)
    {
        $project = new Projects();
        foreach (self::PROJECTS as $projectData)
        {
            $project->setProjectName($projectData['project_name']);
            $project->setProjectDescription($projectData['project_description']);
            $start_date = new DateTime();
            $start_date = $start_date->modify('-'. rand(1,20) . 'day');
            $project->setProjectStartDate($start_date);
            $end_date = new DateTime();
            $end_date = $end_date->modify('+'. rand(1,20) . 'day');
            $project->setProjectEndDate($end_date);
            $project->setProjectCreatedBy($this->getReference(self::USERS[rand(0, count(self::USERS) - 1)]['email']));
            $manager->persist($project);
        }
        $manager->flush();
    }
}
