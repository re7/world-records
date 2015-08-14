<?php

namespace App\Component\Submission;

/**
 * The service to perform read operations about submissions on the database
 */
interface ReaderInterface
{
    /**
     * Retrieve all submissions that are not validated yet
     *
     * @return Submission[]
     */
    public function findAllNotValidated();

    /**
     * Retrieve the submission having the given identifier
     *
     * @param int $identifier
     *
     * @return Submission|null
     */
    public function findByIdentifier($identifier);

    /**
     * Check if the submission having the given identifier is refused. Return
     * true if the submission does not exist
     *
     * @param int $identifier
     *
     * @return bool
     */
    public function isRefused($identifier);

    /**
     * Count all submissions that are not validated yet
     *
     * @return int
     */
    public function countAllNotValidated();
}
