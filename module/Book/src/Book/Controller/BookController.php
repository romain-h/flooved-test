<?php
namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Book\Model\Book; 
use Book\Form\BookForm;

class BookController extends AbstractActionController
{
    protected $bookTable;

    //  Retrieve BookTable instanciated into the module config and return it
    public function getBookTable() {
        if (!$this->bookTable) 
            $this->bookTable = $this->getServiceLocator()->get('Book\Model\BookTable');
        return $this->bookTable;
    }

    // Index action for this book controller. List all Books:
    public function indexAction() {
        return new ViewModel(array(
            'books' => $this->getBookTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $form = new BookForm('book-upload-form');

        if ($this->getRequest()->isPost()) {
            // Merge the files info
            $post = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );


            $form->setData($post);
            // Check form Validity:
            if ($form->isValid()) {
                $data = $form->getData();

                // Check file validation: 
                $validator = new \Zend\Validator\File\MimeType('application/pdf');
                if ($validator->isValid($post['filePath'])) {

                    // Clean file name to store into db
                    $name = str_replace(" ", "_", $data['filePath']['name']);
                    move_uploaded_file($data['filePath'], ROOT_PATH .'/data/upload/'.$name);

                    // Instantiate new book: 
                    $book = new Book();

                    // Change name for exchange array function:
                    $data['filePath'] = $name;
                    $book->exchangeArray($data);
                    $this->getBookTable()->saveBook($book);
                    return $this->redirect()->toRoute('book');
   
                }   

            }
        } 
        return array( 'form' => $form );

    }

    public function deleteAction() {
        // Get id form route:
        $id = (int) $this->params()->fromRoute('id', 0);
        // Redirect to list if no id:
        if (!$id) {
            return $this->redirect()->toRoute('book');
        } else {
            // Delete into db:
            $this->getBookTable()->deleteBook($id);
        }
        return $this->redirect()->toRoute('book');        
    }
}