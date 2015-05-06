<?php

namespace App\Component\Clock;

/**
 * A clock used to retrieve datetimes
 */
class Clock
{
    /**
     * Retrieve the current time
     *
     * @return \DateTime
     */
    public function now()
    {
        return new \DateTime();
    }
}
