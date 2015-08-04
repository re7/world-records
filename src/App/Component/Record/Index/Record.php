<?php

namespace App\Component\Record\Index;

use App\Component\Run\Run;

/**
 * The record list object
 */
class Record
{
    /**
     * The unique identifier of this world record
     *
     * @var int
     */
    private $identifier;

    /**
     * The run considered as a world record
     *
     * @var Run
     */
    private $run;

    /**
     * The number of votes for this record
     *
     * @var int
     */
    private $votes;

    /**
     * __construct
     *
     * @param int $identifier
     * @param Run $run
     * @param int $votes
     */
    public function __construct($identifier, Run $run, $votes)
    {
        $this->identifier = $identifier;
        $this->run        = $run;
        $this->votes      = $votes;
    }

    /**
     * Get identifier
     *
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Get run
     *
     * @return Run
     */
    public function getRun()
    {
        return $this->run;
    }

    /**
     * Get votes
     *
     * @return int
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
