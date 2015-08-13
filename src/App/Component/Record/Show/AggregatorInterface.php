<?php

namespace App\Component\Record\Show;

/**
 * Aggregate data from readers to create a record object
 */
interface AggregatorInterface
{
    /**
     * Retrieve the record object having the given identifier, and given
     * username if not null
     *
     * @param int         $identifier
     * @param string|null $username
     *
     * @return Record|null
     */
    public function get($identifier, $username = null);
}
