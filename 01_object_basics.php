<?php

class ShopProduct
{
	public $title;
	public $producerFirstName;
	public $producerLastName;
	public $price = 0;

	public function __construct($title, $producerFirstName, $producerLastName, $price)
	{
		$this->title 				= $title;
		$this->producerFirstName 	= $producerFirstName;
		$this->producerLastName 	= $producerLastName;
		$this->price 				= $price;
	}

	public function getProducer()
	{
		return $this->producerFirstName . " " . $this->producerLastName;
	}
}

// Example

$product = new ShopProduct('Product Name', 'Willa', 'Antonio', 5.99);

print "author: {$product->getProducer()} \n";