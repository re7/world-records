<?php

namespace App\Bundle\MainBundle\Entity\Vote;

use Doctrine\ORM\Mapping as ORM;

/**
 * A compilation of votes for a reference
 *
 * @ORM\Table(name="vote_compiled")
 * @ORM\Entity(repositoryClass="App\Bundle\MainBundle\Entity\Vote\CompiledRepository")
 */
class Compiled
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
     * The reference concerned by this compiled vote
     *
     * @var int
     *
     * @ORM\Column(name="reference", type="integer", nullable=false)
     */
    private $reference;

    /**
     * The number of votes for this reference
     *
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity = 0;

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
     * Get reference
     *
     * @return int
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
