<?php

namespace App\Bundle\MainBundle\Services\Autocompleter;

/**
 * Autocomplete a submission by accessing data from any URL
 */
interface AutocompleterInterface
{
    /**
     * Fill a submission with data retrieved from the given URL. The submission
     * returned can be invalid
     *
     * @param string $url
     *
     * @return \App\Bundle\MainBundle\Form\ModelSubmission
     */
    public function autocomplete($url);
}
