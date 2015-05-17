<?php

namespace App\Bundle\MainBundle\Form\Type\Security;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * The form type to handle a user account registration
 */
class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email')
            ->add('password', 'password')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Bundle\MainBundle\Form\Model\Security\Registration',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'security_registration';
    }
}
