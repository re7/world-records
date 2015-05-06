<?php

namespace App\Bundle\MainBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Register handlers in the autocompleter
 */
class AutocompleterCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('app_main.submission.autocompleter')) {
            return;
        }

        $definition = $container->getDefinition('app_main.submission.autocompleter');

        $taggedServices = $container->findTaggedServiceIds('app_main.submission.autocompleter');
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall('register', [new Reference($id)]);
        }
    }
}
