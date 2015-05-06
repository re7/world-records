<?php

namespace App\Bundle\MainBundle\Services\Autocompleter\Handler;

use App\Bundle\MainBundle\Form\Model\Submission;

/**
 * A service testing URLs to fetch data used to fill submissions
 */
interface HandlerInterface
{
    /**
     * Fill the given submissions with data fetched from the given URL. Throw an
     * InvalidUrlException when the URL is not usable by this handler
     *
     * @param Submission $submission
     * @param string     $url
     *
     * @throws \App\Bundle\MainBundle\Services\Autocompleter\Exception\InvalidUrlException
     */
    public function fill(Submission $submission, $url);
}
