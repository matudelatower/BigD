<?php

namespace BigD\UtilBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of R2CollectionType
 *
 * @author santiago.semhan
 */
class BootstrapCollectionType extends AbstractType {
    
     /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
       
        $view->vars = array_replace($view->vars, array(
            'max_items_add' => $options['max_items_add'],         
            'display_history' => $options['display_history']         
        ));
    }
    
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(array(
            'max_items_add' => 99999,
            'display_history' => true
        ));
    }
    
    public function getParent() {
        return 'collection';
    }

    public function getName() {
        return 'bootstrapcollection';
    }

}
