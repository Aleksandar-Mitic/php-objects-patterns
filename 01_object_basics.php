<?php

// declare(strict_types=1);

class ShopProduct
{
	public $title;
	public $producerFirstName;
	public $producerLastName;
	public $price = 0;

	public function __construct(string $title, string $producerFirstName, string $producerLastName, float $price)
	{
		$this->title             = $title;
		$this->producerFirstName = $producerFirstName;
		$this->producerLastName  = $producerLastName;
		$this->price             = $price;
	}

	public function getProducer()
	{
		return $this->producerFirstName . " " . $this->producerLastName;
	}
}

// Example

$product = new ShopProduct('Product Name', 'Willa', 'Antonio', 5.99);

// var_dump($product);

// Given wrong data type so it produces error
// $product = new ShopProduct('Product Name', 'Willa', 'Antonio', []);

// This will produce error ONLY if we have strict type delared = "declare(strict_types=1);"
// $product = new ShopProduct('Product Name', 'Willa', 'Antonio', "5.99");


print "author: {$product->getProducer()} \n";