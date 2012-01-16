<?php

namespace Acme\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Acme\AdminBundle\DependencyInjection\Compiler\AdminPoolCompilerPass;

class AcmeAdminBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AdminPoolCompilerPass());
    }    
}
