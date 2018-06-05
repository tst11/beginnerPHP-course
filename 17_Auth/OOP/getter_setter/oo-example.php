<?php

require 'Item.php';

$my_item = new Item();

$my_item->setName("Example");
$my_item->setDescription("The example description");

echo $my_item->getName();