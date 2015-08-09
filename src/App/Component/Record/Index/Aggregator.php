<?php

namespace App\Component\Record\Index;

use App\Component\Record\ReaderInterface as RecordReaderInterface;
use App\Component\Vote\ReaderInterface as VoteReaderInterface;

/**
 * An implementation of the aggregator interface using record and vote readers
 */
class Aggregator implements AggregatorInterface
{
    /**
     * The record reader
     *
     * @var RecordReaderInterface
     */
    private $recordReader;

    /**
     * The vote reader
     *
     * @var VoteReaderInterface
     */
    private $voteReader;

    /**
     * __construct
     *
     * @param RecordReaderInterface $recordReader
     * @param VoteReaderInterface   $voteReader
     */
    public function __construct(RecordReaderInterface $recordReader, VoteReaderInterface $voteReader)
    {
        $this->recordReader = $recordReader;
        $this->voteReader   = $voteReader;
    }

    /**
     * {@inheritdoc}
     */
    public function get(array $identifiers, $username = null)
    {
        $aggregates = [];
        $records    = $this->recordReader->find($identifiers);
        $votes      = $this->voteReader->count($identifiers);
        $voted      = $this->voteReader->voted($identifiers, $username);

        foreach ($records as $record) {
            $aggregate = new Record(
                $record->getIdentifier(),
                $record->getRun(),
                $votes[$record->getIdentifier()],
                $voted[$record->getIdentifier()]
            );

            $aggregates[$record->getIdentifier()] = $aggregate;
        }

        return $aggregates;
    }
}
