<?php

namespace App\Bundle\MainBundle\Services\Submission;

use App\Bundle\MainBundle\Entity\Submission as SubmissionEntity;
use App\Component\Submission\Player;
use App\Component\Submission\Run;
use App\Component\Submission\Submission;

/**
 * Convert submissions from/to entities
 */
class EntityConverter
{
    /**
     * Instanciate a submission from the given entity
     *
     * @param SubmissionEntity $entity
     *
     * @return Submission
     */
    public function from(SubmissionEntity $entity)
    {
        $player     = new Player(
            $entity->getPlayerName(),
            $entity->getPlayerLink()
        );
        $run        = new Run(
            $player,
            $entity->getGame(),
            $entity->getCategory(),
            $entity->getLinks(),
            $entity->getPlatform(),
            $entity->getTime(),
            $entity->getDate()
        );
        $submission = new Submission(
            $run,
            $entity->getCreatedAt(),
            $entity->getUpdatedAt(),
            $entity->isValidated()
        );
        $submission->setIdentifier($entity->getId());

        return $submission;
    }

    /**
     * Compute data from the given submission in the given submission entity
     *
     * @param Submission       $submission
     * @param SubmissionEntity $entity
     */
    public function computeTo(Submission $submission, SubmissionEntity $entity)
    {
        $run    = $submission->getRun();
        $player = $run->getPlayer();

        $entity
            ->setPlayerName($player->getName())
            ->setPlayerLink($player->getLink())
            ->setGame($run->getGame())
            ->setCategory($run->getCategory())
            ->setLinks($run->getLinks())
            ->setPlatform($run->getPlatform())
            ->setTime($run->getTime())
            ->setDate($run->getDate())
            ->setCreatedAt($submission->getCreatedAt())
            ->setUpdatedAt($submission->getUpdatedAt())
            ->setValidated($submission->isValidated())
        ;
    }
}
