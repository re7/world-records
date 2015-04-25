<?php

namespace App\Component\Submission;

/**
 * A player and its details
 */
class Player
{
    /**
     * The name of the player
     *
     * @var string
     */
    private $name;

    /**
     * A link to the player's main profile
     *
     * @var string|null
     */
    private $link;

    /**
     * __construct
     *
     * @param string      $name
     * @param string|null $link
     */
    public function __construct($name, $link = null)
    {
        $this->name = $name;
        $this->link =$link;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get link
     *
     * @return string|null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set link
     *
     * @param string|null $link
     *
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

}
