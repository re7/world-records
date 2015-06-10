<?php

namespace App\Bundle\MainBundle\Command;

use App\Component\Security\User\PromoteCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * The commmand used to promote security users as moderator
 */
class SecurityUserPromoteCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:security:user-promote')
            ->setDescription('Promote a user as moderator')
            ->addArgument(
                'email',
                InputArgument::REQUIRED,
                'Which user do you want to promote?'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument('email');

        $reader  = $this->getContainer()->get('app_main.security.user.reader');
        $user    = $reader->findByUsername($email);

        if ($user === null) {
            return $output->writeln(sprintf('<error>The user \'%s\' does not exist.</error>', $email));
        }
        if ($user->isModerator()) {
            return $output->writeln(sprintf('<comment>The user \'%s\' is already a moderator.</comment>', $email));
        }

        $command = new PromoteCommand($user->getIdentifier());

        $bus = $this->getContainer()->get('app_main.security.command_bus');
        $bus->launch($command);

        $updatedUser = $reader->findByUsername($email);
        if (!$updatedUser->isModerator()) {
            return $output->writeln(sprintf('<error>An error occurred while promoting the user \'%s\'.</error>', $email));
        }

        $output->writeln(sprintf('<info>The user \'%s\' has properly been promoted.</info>', $email));
    }
}
