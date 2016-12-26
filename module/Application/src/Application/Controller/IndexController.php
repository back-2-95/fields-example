<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use BackTo95\Fields\API;
use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\Storage\FileStorage;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $api = new API();
        $storage = new FileStorage('data/entities');
        $api->setStorage($storage);

//$track_configuration = new \BackTo95\Fields\Entity\EntityConfiguration(include 'config/track.php');
//$api->storeEntityConfiguration($track_configuration);

        $entity_configuration = $api->getEntityConfiguration('track');
        $form = $this->getForm($entity_configuration);

        return new ViewModel(['entity_configuration' => $entity_configuration, 'form' => $form]);
    }

    private function getForm(EntityConfiguration $entity_configuration)
    {
        $form = new Form($entity_configuration->getName());
        $inputFilter = new InputFilter();

        // Loop entity fields
        foreach ($entity_configuration->getFields() as $fname => $field) {
            // Take in only the fields with form configuration
            if (isset($field->form)) {
                switch ($field->form->widget) {
                    case 'text':
                    case 'tags':

                        $el = new Element\Text($fname);
                        $el->setAttributes([
                            'class' => 'form-control'
                        ]);

                        break;

                    case 'editor':

                        $el = new Element\Textarea($fname);
                        $el->setAttributes([
                            'class' => 'form-control editor'
                        ]);

                        break;

                    case 'image':

                        $el = new Element\File($fname);
                        $el->setAttributes([
                            'class' => 'form-control'
                        ]);

                        break;

                    default:

                        // Fallback?
                        $el = new Element($fname);
                }

                // Set label
                $el->setLabel($field->name);

                $input = new Input($fname);

                // Mark required
                if ($field->required) {
                    $el->setAttribute('required', 'required');
                    $input->setRequired(true);
                }

                $inputFilter->add($input);

                $form->add($el);
            }
        }

        $send = new Element\Submit('submit');
        $send->setValue('Create');
        $send->setAttributes([
            'class'  => 'btn btn-default'
        ]);
        
        $form->add($send);

        $form->setInputFilter($inputFilter);

        return $form;
    }
}
