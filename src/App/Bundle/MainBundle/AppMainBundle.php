<?php

namespace App\Bundle\MainBundle;

use App\Bundle\MainBundle\DependencyInjection\Compiler\AutocompleterCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppMainBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AutocompleterCompilerPass());
    }
}
