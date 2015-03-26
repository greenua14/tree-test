<?php

namespace PHP\TreeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilderInterface, array $options)
    {
        $formBuilderInterface
            ->add('title', 'text', array(
                'label' => 'Enter your title: ',
            ))
            ->add('content', 'textarea', array(
                'label' => 'Enter content: ',
            ))
            ->add('parent', 'entity', array(
                'class' => 'PHPTreeBundle:Node',
                'property' => 'title',
                'required' => false,
            ))
            ->add('Save', 'submit', array(
                'label' => 'Save'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $optionsResolverInterface)
    {
        $optionsResolverInterface->setDefaults(array(
            'data_class' => 'PHP\TreeBundle\Entity\Node'
        ));
    }

    public function getName()
    {
        return 'node';
    }
}
