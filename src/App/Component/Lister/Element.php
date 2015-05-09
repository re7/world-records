<?php

namespace App\Component\Lister;

/**
 * An element of a list
 */
class Element
{
    /**
     * The identifier of the element
     *
     * @var int
     */
    private $identifier;

    /**
     * __construct
     *
     * @param int $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier
     *
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
