<?php

namespace App\Component\Record;

/**
 * The service to perform write, edit and delete operations about records on the
 * database
 */
interface WriterInterface
{
    /**
     * Save the given record in database
     *
     * @param Record $record
     */
    public function save(Record $record);
}
