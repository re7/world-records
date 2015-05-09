<?php

namespace App\Bundle\MainBundle\Entity\Security;

use Doctrine\ORM\Mapping as ORM;

/**
 * The security user
 *
 * @ORM\Entity
 * @ORM\Table(name="security_user")
 */
class User
{
    /**
     * The unique identifier
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
