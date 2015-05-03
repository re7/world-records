<?php

namespace App\Bundle\MainBundle\Services\Autocompleter\Handler;

use App\Bundle\MainBundle\Form\Model\Submission;
use App\Bundle\MainBundle\Services\Autocompleter\Exception\InvalidUrlException;

/**
 * Fetch data from a Speedrun.com run page
 */
class SpeedruncomHandler implements HandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function fill(Submission $submission, $url)
    {
        throw new InvalidUrlException();
    }
}
