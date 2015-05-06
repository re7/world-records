<?php

namespace App\Component\Record;

/**
 * The service to perform read operations about world records on the database
 */
interface ReaderInterface
{
    /**
     * Retrieve all existing world records
     *
     * @return Record[]
     */
    public function findAll();
}
