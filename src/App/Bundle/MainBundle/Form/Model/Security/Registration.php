<?php

namespace App\Bundle\MainBundle\Form\Model\Security;

use App\Bundle\MainBundle\Validator\Constraints\Security\Registration\UniqueEmail;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A user account registration
 */
class Registration
{
    /**
     * The unique email
     *
     * @var string
     *
     * @Assert\Email()
     * @UniqueEmail()
     */
    public $email;

    /**
     * The password for this account
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    public $password;
}
