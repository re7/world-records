<?php

namespace App\Component\Run;

/**
 * A run and all its details
 */
class Run
{
    /**
     * The runner who has played this run
     *
     * @var Player
     */
    private $player;

    /**
     * The game played in this run
     *
     * @var string
     */
    private $game;

    /**
     * The speedrun category played in this run
     *
     * @var string
     */
    private $category;

    /**
     * Links showing this run
     *
     * @var string[]
     */
    private $links;

    /**
     * The platform used to play the game
     *
     * @var string
     */
    private $platform;

    /**
     * The duration of this run
     *
     * @var string
     */
    private $time;

    /**
     * The date at which this run has been played
     *
     * @var \DateTime
     */
    private $date;

    /**
     * The URL of the thumbnail of this run
     *
     * @var string|null
     */
    private $thumbnail;

    /**
     * __construct
     *
     * @param Player      $player
     * @param string      $game
     * @param string      $category
     * @param string[]    $links
     * @param string      $platform
     * @param string      $time
     * @param \DateTime   $date
     * @param string|null $thumbnail
     */
    public function __construct(Player $player, $game, $category, array $links, $platform, $time, $date, $thumbnail = null)
    {
        $this->player    = $player;
        $this->game      = $game;
        $this->category  = $category;
        $this->links     = $links;
        $this->platform  = $platform;
        $this->time      = $time;
        $this->date      = $date;
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get player
     *
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set player
     *
     * @param Player $player
     *
     * @return self
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;

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
     * Get links
     *
     * @return string[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set links
     *
     * @param string[] $links
     *
     * @return self
     */
    public function setLinks(array $links)
    {
        $this->links = $links;

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

    /**
     * Get thumbnail
     *
     * @return string|null
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set thumbnail
     *
     * @param string|null $thumbnail
     *
     * @return self
     */
    public function setThumbnail($thumbnail = null)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
