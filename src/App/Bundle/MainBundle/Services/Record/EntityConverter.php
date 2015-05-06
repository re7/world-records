<?php

namespace App\Bundle\MainBundle\Services\Record;

use App\Bundle\MainBundle\Entity\Record\Record as RecordEntity;
use App\Component\Run\Player;
use App\Component\Run\Run;
use App\Component\Record\Record;

/**
 * Convert records from/to entities
 */
class EntityConverter
{
    /**
     * Instanciate a record from the given entity
     *
     * @param RecordEntity $entity
     *
     * @return Record
     */
    public function from(RecordEntity $entity)
    {
        $player = new Player(
            $entity->getPlayerName(),
            $entity->getPlayerLink()
        );
        $run    = new Run(
            $player,
            $entity->getGame(),
            $entity->getCategory(),
            $entity->getLinks(),
            $entity->getPlatform(),
            $entity->getTime(),
            $entity->getDate()
        );
        $record = new Record(
            $run,
            $entity->getCreatedAt()
        );
        $record->setIdentifier($entity->getIdentifier());

        return $record;
    }

    /**
     * Compute data from the given record in the given record entity
     *
     * @param Record       $record
     * @param RecordEntity $entity
     */
    public function computeTo(Record $record, RecordEntity $entity)
    {
        $run    = $record->getRun();
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
            ->setCreatedAt($record->getCreatedAt())
        ;
    }
}
