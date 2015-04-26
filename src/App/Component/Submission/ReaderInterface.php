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
}
