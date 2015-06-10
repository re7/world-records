<?php

namespace App\Component\Submission;

use App\Component\Command\CommandInterface;

/**
 * Refuse a submission
 */
class RefuseCommand implements CommandInterface
{
    /**
     * The unique identifier of the submission to refuse
     *
     * @var string
     */
    private $identifier;

    /**
     * __construct
     *
     * @param string $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'submission_refuse';
    }
}
