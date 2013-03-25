<?php
namespace Book\Model;

class Book
{
    public $id;
    public $title;
    public $path;

    //  Require by Zend TableGateway
    public function exchangeArray($data) {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->path  = (isset($data['path'])) ? $data['path'] : null;
    }
}
