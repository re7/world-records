<?php

namespace App\Component\Record\Index;

use App\Component\Run\Run;

/**
 * The record list object
 */
class Record
{
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
     * @param Run $run
     * @param int $votes
     */
    public function __construct(Run $run, $votes)
    {
        $this->run   = $run;
        $this->votes = $votes;
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
