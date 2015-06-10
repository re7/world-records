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

    /**
     * Validate the submission having the given identifier
     *
     * @param int $identifier
     *
     * @throws \App\Component\Submission\Exceptions\ValidationFailedException
     */
    public function validate($identifier);

    /**
     * Refuse the submission having the given identifier
     *
     * @param int $identifier
     *
     * @throws \App\Component\Submission\Exceptions\RefusalFailedException
     */
    public function refuse($identifier);
}
