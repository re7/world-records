<?php

namespace App\Component\Record;

use App\Component\Run\Run;

/**
 * A world record
 */
class Record
{
    /**
     * The unique identifier
     *
     * @var int|null
     */
    private $identifier;

    /**
     * The run considered as a world record
     *
     * @var Run
     */
    private $run;

    /**
     * The date at which this record has been added
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * __construct
     *
     * @param Run       $run
     * @param \DateTime $createdAt
     */
    public function __construct(Run $run, \DateTime $createdAt)
    {
        $this->run       = $run;
        $this->createdAt = $createdAt;
    }

    /**
     * Get identifier
     *
     * @return int|null
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set identifier
     *
     * @param int|null $identifier
     *
     * @return self
     */
    public function setIdentifier($identifier = null)
    {
        $this->identifier = $identifier;

        return $this;
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
     * Set run
     *
     * @param Run $run
     *
     * @return self
     */
    public function setRun(Run $run)
    {
        $this->run = $run;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
