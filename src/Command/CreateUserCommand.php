<?php

namespace App\Command;

use App\Entity\User\User;
use EasyApiBundle\Entity\User\AbstractUser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    protected static $defaultDescription = 'Creates a new user.';

    protected ?ManagerRegistry $managerRegistry;
    protected ?UserPasswordHasherInterface $passwordHasher;

    public function __construct(string $name = null, ManagerRegistry $managerRegistry = null, UserPasswordHasherInterface $passwordHasher = null)
    {
        parent::__construct($name);
        $this->managerRegistry = $managerRegistry;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            // ...
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('firstname', InputArgument::REQUIRED, 'User firstname')
            ->addArgument('lastname', InputArgument::REQUIRED, 'User lastname')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setUsername($input->getArgument('email'));
        $user->setFirstname($input->getArgument('firstname'));
        $user->setLastname($input->getArgument('lastname'));
        $user->setPassword($this->passwordHasher->hashPassword($user, $input->getArgument('password')));
        $user->addRole(User::ROLE_DEFAULT);

        $this->managerRegistry->getManager()->persist($user);
        $this->managerRegistry->getManager()->flush();

        return Command::SUCCESS;
    }
}