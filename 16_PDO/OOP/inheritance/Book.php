<?php 

class Book extends Item
{
    public $author;   

    public function getCode() 
    {
        return $this->code;
    }
}