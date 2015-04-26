<?php

namespace App\Bundle\MainBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * A world record submission
 */
class Submission
{
    /**
     * The player name
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $playerName;

    /**
     * A link to the player's profile
     *
     * @var string
     */
    private $playerLink;

    /**
     * The name of the game
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $game;

    /**
     * The speedrun category played
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * An array of links showing the run
     *
     * @var string
     */
    private $link;

    /**
     * The platform on which the run has been played
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $platform;

    /**
     * The duration of the run
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $time;

    /**
     * The date at which the run has been played
     *
     * @var \DateTime
     *
     * @Assert\Date()
     */
    private $date;

    /**
     * Get playerName
     *
     * @return string
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * Set playerName
     *
     * @param string $playerName
     *
     * @return self
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;

        return $this;
    }

    /**
     * Get playerLink
     *
     * @return string
     */
    public function getPlayerLink()
    {
        return $this->playerLink;
    }

    /**
     * Set playerLink
     *
     * @param string $playerLink
     *
     * @return self
     */
    public function setPlayerLink($playerLink)
    {
        $this->playerLink = $playerLink;

        return $this;
    }

    /**
     * Get game
     *
     * @return string
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set game
     *
     * @param string $game
     *
     * @return self
     */
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set platform
     *
     * @param string $platform
     *
     * @return self
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set time
     *
     * @param string $time
     *
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return self
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }
}
