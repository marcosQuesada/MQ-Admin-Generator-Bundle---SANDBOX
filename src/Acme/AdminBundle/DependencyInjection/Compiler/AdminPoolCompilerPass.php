<?php

namespace Acme\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class AdminPoolCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('acme_admin.admin_pool')) {
            return;
        }

        $definition = $container->getDefinition('acme_admin.admin_pool');

        foreach ($container->findTaggedServiceIds('admin.pool') as $id => $attributes) {
            $definition->addMethodCall('addTransport', array(new Reference($id)));
        }
    }
}