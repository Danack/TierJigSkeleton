<?php

namespace FCFormsTest\ExampleForms;

use FCForms\Form\Form;

class AdminTicketForm extends Form
{
    public function getDefinition()
    {
        $definition = array(
            'class'         => 'blogEditForm',

            'startElements' => [
                [
                    'type'  => 'FCForms\FormElement\Title',
                    'value' => 'List of examples',
                    'class' => 'text-center'
                ]
            ],

            'rowElements'   => array(
            ),

            'endElements'   => array(
                array(
                    'isActive',
                    'type'  => 'FCForms\FormElement\Text',
                    'label' => 'Email',
                    'name'  => 'email',
                    //'placeHolder' => 'Emailadasd',
                    'validation' => array(
                        "Zend\\Validator\\StringLength" => array(
                            'min' => 20,
                        ),
                    )
                ),
                array(
                    'type' => 'FCForms\FormElement\Password',
                    'label' => 'Password',
                    'name' => 'Password',
                    'validation' => array(
                        "Zend\\Validator\\StringLength" => array(
                            'min' => 4,
                        ),
                    )
                ),
                array(
                    'isActive',
                    'type'  => 'FCForms\FormElement\CheckBox',
                    'label' => 'Remember me',
                    'name'  => 'rememberMe',
                ),
                array(
                    'isActive',
                    'type'  => 'FCForms\FormElement\Label',
                    'default' => 'This is some text that goes across the form.',
                ),
                array(
                    'isActive',
                    'type'  => 'FCForms\FormElement\RadioButton',
                    'label' => 'Radio button',
                    'name'  => 'example',
                    'options' => array(
                        'foo1' => 'bar1',
                        'foo2' => 'bar2',
                        'foo3' => 'bar3',
                    )
                ),
                array(
                    'isActive',
                    'type'  => 'FCForms\FormElement\Select',
                    'label' => 'Select',
                    'name'  => 'example',
                    'options' => array(
                        'foo1' => 'bar1',
                        'foo2' => 'bar2',
                        'foo3' => 'bar3',
                    )
                ),
                array(
                    'isActive',
                    'type'  => 'FCForms\FormElement\TextArea',
                    'label' => 'Description',
                    'name'  => 'description',
                    'placeholder' => 'Description'
                ),
                array(
                    'submitButton',
                    'type'  => 'FCForms\FormElement\SubmitButton',
                    'label' => null,
                    'name'  => 'submit',
                    'text'  => 'Update',
                ),
            ),

            'validation'    => array(
                //form level validation.
            )
        );

        return $definition;
    }
}
