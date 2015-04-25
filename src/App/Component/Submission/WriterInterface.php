<?php

namespace App\Component\Submission;

/**
 * The service to perform write, edit and delete operations about submissions on
 * the database
 */
interface WriterInterface
{
    /**
     * Save the given submission in database
     *
     * @param Submission $submission
     */
    public function save(Submission $submission);
}
