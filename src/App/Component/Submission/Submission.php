<?php

namespace App\Component\Submission;

use App\Component\Run\Run;

/**
 * A run submission
 */
class Submission
{
    /**
     * The unique identifier
     *
     * @var int|null
     */
    private $identifier;

    /**
     * The run submitted and all its details
     *
     * @var Run
     */
    private $run;

    /**
     * The creation date of this submission
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * The date of the update
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * __construct
     *
     * @param Run       $run
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct(Run $run, $createdAt, $updatedAt)
    {
        $this->run       = $run;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
