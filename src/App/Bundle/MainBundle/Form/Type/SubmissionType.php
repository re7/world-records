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
            ->add('playerName', 'text', [
                'label' => 'form.submission.label.playerName',
            ])
            ->add('playerLink', 'url', [
                'required' => false,
                'label' => 'form.submission.label.playerLink',
            ])
            ->add('game', 'text', [
                'label' => 'form.submission.label.game',
            ])
            ->add('category', 'text', [
                'label' => 'form.submission.label.category',
            ])
            ->add('link', 'url', [
                'required' => false,
                'label' => 'form.submission.label.url',
            ])
            ->add('platform', 'text', [
                'label' => 'form.submission.label.platform',
            ])
            ->add('time', 'text', [
                'label' => 'form.submission.label.time',
            ])
            ->add('date', 'date', [
                'label' => 'form.submission.label.date',
            ])
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
