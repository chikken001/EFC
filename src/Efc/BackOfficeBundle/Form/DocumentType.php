<?php

namespace Efc\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text', array(
                'label' => "Nom",
                'required' => true
            ))
            ->add('description', 'textarea', array(
                'label' => 'Description',
                'required' => false
            ))
            ->add('file', 'file', array(
                'label' => 'Photo',
                'required' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Efc\MainBundle\Entity\Document'
        ));
    }

    public function getName()
    {
        return 'efc_back_office_bundle_document_type';
    }
}
