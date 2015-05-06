<?php

namespace App\Bundle\MainBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * A link used to autocomplete a submission
 */
class Link
{
    /**
     * The URL of this link
     *
     * @var string
     *
     * @Assert\Url()
     */
    private $url;

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
