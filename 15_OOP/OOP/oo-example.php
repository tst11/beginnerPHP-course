<?php

require 'Item.php';



$my_item = new Item('Huge', 'A big item');


// $my_item->name = 'Example';
// $my_item->description = 'A new description';
// $my_item->price = 2.99;

$item2 = new Item('Huge', 'A big item');

Item::showCount();

echo $my_item->getName();

define('MAXIMUM', 100);
define('COLOR', 'red');

echo MAXIMUM;

echo Item::MAX_LENGTH;

//$my_item->sayHello();
//$my_item->name = 'An example';

//echo $my_item->getName();


//$item2 = new Item();

// $item2->name = 'Another example';

//echo $my_item->getName(), " ", $item2->getName();
//var_dump($item2);