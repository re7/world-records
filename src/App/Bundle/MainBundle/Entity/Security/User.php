<?php

namespace App\Bundle\MainBundle\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * The security user
 *
 * @ORM\Entity
 * @ORM\Table(name="security_user")
 */
class User extends BaseUser
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
