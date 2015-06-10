<?php

namespace App\Bundle\MainBundle\Validator\Constraints\Security\Registration;

use Symfony\Component\Validator\Constraint;

/**
 * Unique email constraint accross all security users
 *
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    /**
     * The message displayed when this constraint failed
     *
     * @var string
     */
    public $message = 'This value is already used.';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'app_main_security_registration_unique_email';
    }
}
