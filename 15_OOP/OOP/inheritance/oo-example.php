<?php

require 'Item.php';
require 'Book.php';

$my_item = new Item();
$my_item->name = "TV";

echo $my_item->getListingDescription();

$book = new Book();
$book->name = "Hamlet";
$book->author = "Shakespeare";

echo'<br>';

echo $book->getListingDescription();

echo'<br>';

echo $my_item->code;

echo $book->getCode();

