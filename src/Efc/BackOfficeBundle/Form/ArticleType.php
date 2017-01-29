<?php

namespace Efc\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\EntityManager;

class ArticleType extends AbstractType
{
    private $formCount;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var string
     */
    private $rolesUser;

    public function __construct(EntityManager $entityManager)
    {
        $this->formCount = 0;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->formCount ++ ;
        $contexts = array('edit_documents','edit_photos','new_article','edit_article') ;

        (isset($options['context']) && in_array($options['context'], $contexts)) ? $context = $options['context'] : $context = 'new_article' ;

        if($context == 'edit_photos')
        {
            $builder->add('photos', new CollectionType(), array(
                'entry_type' => new PhotoType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false
            ));
        }

        if($context == 'edit_documents')
        {
            $builder->add('tarifs', new CollectionType(), array(
                'entry_type' => new DocumentType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false
            ));
        }

        if($context == 'new_article' || $context == 'edit_article')
        {
            $builder->add('titre', 'text', array(
                'label' => 'Titre',
                'required' => true
            ));

            $builder->add('type', 'entity', array(
                'label' => "Type d'article",
                'required' => true,
                'class' => 'Efc\MainBundle\Entity\Type',
                'property' => 'nom',
                'choices' => $this->entityManager->getRepository('EfcMainBundle:Type')->findAll(),
                'empty_data' => false
            ));

            $builder->add('anotation', 'text', array(
                'label' => 'Anotation',
                'required' => false
            ));

            $builder->add('date_evenement', 'datetime', array(
                'label' => 'Date',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr' => array(
                    'class' => 'datetimepicker'
                ),
                'required' => true
            ));

            $builder->add('fichier_photo_principale', 'file', array(
                'label' => 'Photo principale',
                'required' => false
            ));

            $builder->add('introduction', 'textarea', array(
                'label' => 'Introduction',
                'required' => false
            ));

            $builder->add('paragraphe1', 'textarea', array(
                'label' => 'Paragraphe 1',
                'required' => false
            ));

            $builder->add('paragraphe2', 'textarea', array(
                'label' => 'Paragraphe 2',
                'required' => false
            ));

            $builder->add('fichier_photo', 'file', array(
                'label' => 'Photo',
                'required' => false
            ));

            $builder->add('paragraphe3', 'textarea', array(
                'label' => 'Paragraphe 3',
                'required' => false
            ));

            $builder->add('paragraphe4', 'textarea', array(
                'label' => 'Paragraphe 4',
                'required' => false
            ));

            $builder->add('auteur', 'text', array(
                'label' => 'Auteur',
                'required' => true
            ));

            $builder->add('isPublished', 'checkbox', array(
                'label' => 'Publié',
                'required' => false,
                'attr' => array(
                    'title' => 'Article publié sur le site ?'
                )
            ));
        }

        $builder->add('submit', 'submit', array(
            'label' => 'Enregistrer',
            'attr' => array(
                'class' => 'btn btn-default'
            )
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Efc\MainBundle\Entity\Article',
            'context' => 'new_article'
        ));
    }

    public function getName()
    {
        return 'efc_back_office_bundle_article_type';
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix().'_'.$this->formCount;
    }
}
