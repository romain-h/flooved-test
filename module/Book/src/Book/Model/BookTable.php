<?php
namespace Book\Model;

use Zend\Db\TableGateway\TableGateway;

class BookTable
{
    protected $tableGateway;

    // BookTable constructor, initialize Zend Table Gateway.
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    // Get all books into db
    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    // Get a book by id:
    public function getBook($id) {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        //  Exception if there is no row returned by SQL
        if (!$row) {
            throw new \Exception("We cannot find a book with $id as id");
        }
        return $row;
    }

    // Add or save a book into db:
    public function saveBook(Book $book) {
        // Initialize array with data for the SQL insert or update:
        $data = array(
            'title' => $book->title,
            'path'  => $book->path,
        );

        // Get current book id:
        $id = (int)$book->id;
        // If there is no book already, add the book directly
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBook($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('saveBook impossible: Form id does not exist');
            }
        }
    }

    // Delete a particular book
    public function deleteBook($id) {
        $this->tableGateway->delete(array('id' => $id));
    }
}