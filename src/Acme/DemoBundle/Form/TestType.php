<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TestType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('text')
            ->add('string')
        ;
    }

    public function getName()
    {
        return 'acme_demobundle_testtype';
    }
}
