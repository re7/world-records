<?php

namespace App\Bundle\MainBundle\Services\Vote;

use App\Bundle\MainBundle\Entity\Vote\Vote as VoteEntity;
use App\Component\Vote\Vote;

/**
 * Convert submissions from/to entities
 */
class EntityConverter
{
    /**
     * Instanciate a vote from the given entity
     *
     * @param VoteEntity $entity
     *
     * @return Vote
     */
    public function from(VoteEntity $entity)
    {
        $vote = new Vote(
            $entity->getObject(),
            $entity->getUsername(),
            $entity->getCreatedAt()
        );

        return $vote;
    }
}
