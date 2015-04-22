<?php

namespace App\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * The form type to handle a world record submission
 */
class SubmissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // @TODO Add necessary fields
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'submission';
    }
}
