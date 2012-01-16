<?php

namespace Acme\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AttributeCollectionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('attributes')
        ;
    }

    public function getName()
    {
        return 'acme_basebundle_attributecollectiontype';
    }
}
