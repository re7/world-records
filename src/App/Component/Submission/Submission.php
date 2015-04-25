<?php

namespace App\Component\Submission;

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
     * Whether this submission has been validated
     *
     * @var bool
     */
    private $validated;

    /**
     * __construct
     *
     * @param Run       $run
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     * @param bool      $validated
     */
    public function __construct(Run $run, $createdAt, $updatedAt, $validated = false)
    {
        $this->run       = $run;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->validated = $validated;
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

    /**
     * Get validated
     *
     * @return bool
     */
    public function isValidated()
    {
        return $this->validated;
    }

    /**
     * Set validated
     *
     * @param bool $validated
     *
     * @return self
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

}
