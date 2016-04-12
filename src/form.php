<?php

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

$form = new Form($entity_configuration->getName());
$inputFilter = new InputFilter();

// Loop entity fields
foreach ($entity_configuration->getFields() as $fname => $field) {
    // Take in only the fields with form configuration
    if (isset($field->form)) {
        switch ($field->form->widget) {
            case 'text':
            case 'tags':

                $el = new Element($fname);
                $el->setAttributes([
                    'type'  => 'text',
                    'class' => 'form-control'
                ]);

                break;

            case 'editor':

                $el = new Element\Textarea($fname);
                $el->setAttributes([
                    'type'  => 'text',
                    'class' => 'form-control editor'
                ]);

                break;

            case 'image':

                $el = new Element\File($fname);
                $el->setAttributes([
                    'class' => 'form-control'
                ]);

                break;
        }

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

$send = new Element('send');
$send->setValue('Submit');
$send->setAttributes(array(
    'type'  => 'submit'
));

$form->add($send);


// configure input... and all others

// attach all inputs

$form->setInputFilter($inputFilter);
