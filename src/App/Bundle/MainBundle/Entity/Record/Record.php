<?php

namespace App\Bundle\MainBundle\Entity\Record;

use Doctrine\ORM\Mapping as ORM;

/**
 * Submission
 *
 * @ORM\Table(name="record")
 * @ORM\Entity(repositoryClass="App\Bundle\MainBundle\Entity\Record\RecordRepository")
 */
class Record
{
    /**
     * The unique identifier
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identifier;

    /**
     * The player name
     *
     * @var string
     *
     * @ORM\Column(name="player_name", type="string", nullable=false)
     */
    private $playerName;

    /**
     * A link to the player's profile
     *
     * @var string
     *
     * @ORM\Column(name="player_link", type="string", nullable=true)
     */
    private $playerLink;

    /**
     * The name of the game
     *
     * @var string
     *
     * @ORM\Column(name="game", type="string", nullable=false)
     */
    private $game;

    /**
     * The speedrun category played
     *
     * @var string
     *
     * @ORM\Column(name="category", type="string", nullable=false)
     */
    private $category;

    /**
     * An array of links showing the run
     *
     * @var string[]
     *
     * @ORM\Column(name="links", type="array", nullable=false)
     */
    private $links;

    /**
     * The platform on which the run has been played
     *
     * @var string
     *
     * @ORM\Column(name="platform", type="string", nullable=false)
     */
    private $platform;

    /**
     * The duration of the run
     *
     * @var string
     *
     * @ORM\Column(name="time", type="string", nullable=false)
     */
    private $time;

    /**
     * The date at which the run has been played
     *
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * The thumbnail URL for the associated link
     *
     * @var string|null
     *
     * @ORM\Column(name="thumbnail", type="string", length=255, nullable=true)
     */
    private $thumbnail;

    /**
     * The date at which the submission has been posted
     *
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * Get identifier
     *
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

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
    public function setLinks($links)
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

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
