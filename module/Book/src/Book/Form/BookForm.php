<?php
namespace Book\Form;

use Zend\Form\Form;
use Zend\Form\Element;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator;
use Zend\Filter;

class BookForm extends Form
{
    public function __construct($name = null)  {
        parent::__construct('book');
        //Form type:
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));

        // File Upload:
        $myFile = new Element\File('filePath');
        $myFile
            ->setOptions(array())
            ->setLabel('Uplaod the file (PDF Only)');
        $this->add($myFile);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'id' => 'submitbutton',
            ),
        ));


    }

        // Get input filter:
    public function addInputFilter() {
        
            $inputFilter = new InputFilter();

            // Title is mandatory and should not exceed 500 char:
            $inputFilter->add(new InputFilter(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 500,
                        ),
                    ),
                ),
            )));



        $this->setInputFilter($inputFilter);
    }    
}