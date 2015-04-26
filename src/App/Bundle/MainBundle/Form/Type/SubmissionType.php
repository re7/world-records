<?php

namespace App\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
        $builder
            ->add('playerName', 'text')
            ->add('playerLink', 'url')
            ->add('game', 'text')
            ->add('category', 'text')
            ->add('link', 'url')
            ->add('platform', 'text')
            ->add('time', 'text')
            ->add('date', 'date')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Bundle\MainBundle\Form\Model\Submission',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'submission';
    }
}
