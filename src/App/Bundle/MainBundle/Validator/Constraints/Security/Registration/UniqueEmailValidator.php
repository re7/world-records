<?php

namespace App\Bundle\MainBundle\Validator\Constraints\Security\Registration;

use App\Component\Security\User\ReaderInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validate the unique email constraint
 */
class UniqueEmailValidator extends ConstraintValidator
{
    /**
     * The service used to read security users from the database
     *
     * @var ReaderInterface
     */
    private $reader;

    /**
     * __construct
     *
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        $user = $this->reader->findByUsername($value);

        if ($user !== null) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation()
            ;
        }
    }
}
