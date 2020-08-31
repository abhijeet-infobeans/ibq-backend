<?php


namespace App\Service;


use App\Repository\UsersRepository;

class UserService
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * UserService constructor.
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function getUserByEmail($email)
    {
        $userRecord = [];
        if (isset($email)) {
            $userRecord = $this->usersRepository->findOneBy([
                'email' => $email
            ]);
        }
        return $userRecord;
    }
}