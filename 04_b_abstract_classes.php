<?php

// declare(strict_types=1);

class ShopProduct
{
	private 		$title;
	private 		$producerFirstName;
	private 		$producerLastName;
	protected 		$price = 0;
	protected 		$discount = 0;

	public function __construct(
		string $title, 
		string $producerFirstName, 
		string $producerLastName, 
		float  $price,
		int    $discount
	) {
	 	$this->title             = $title;
		$this->producerFirstName = $producerFirstName;
		$this->producerLastName  = $producerLastName;
		$this->price             = $price;
		$this->discount          = $discount;
	}

	public function getProducerFirstName()
	{
		return $this->producerFirstName;
	}
	
	public function setDiscount($num)
	{
		$this->discount = $num;
	}
	
	public function getDiscount()
	{
		return $this->discount;
	}
	
	public function getTitle()
	{
		return $this->title;
	}

	public function getProducer()
	{
		return $this->producerFirstName . " " . $this->producerLastName;
	}

	public function getSummaryLine() 
	{
		return "{$this->title} ({$this->producerFirstName}, {$this->producerLastName}) ";	
	}

	public function getPrice()
	{
		return $this->price;
	}

}


abstract class ShopProductWriter
{
	protected $products = [];
	
	public function addProduct(ShopProduct $ShopProduct)
	{
		$this->products[] = $ShopProduct;
	}

	abstract public function write();
}


// Any class that extends an abstract class must implement all abstract methods or itself be declared
// abstract. An extending class is responsible for more than simply implementing an abstract method. In doing
// so, it must reproduce the method signature. This means that the access control of the implementing method
// cannot be stricter than that of the abstract method. The implementing method should also require the same
// number of arguments as the abstract method, reproducing any class type hinting.

class TextProductWriter extends ShopProductWriter
{
	public function write()
	{
		$str = "PRODUCTS:<br />";
		foreach ($this->products as $shopProduct) {
			$str .= $shopProduct->getSummaryLine()."<br />";
		}
		print $str;
	}
}

$obj1 = new ShopProduct('Deep Purple', 'Richie', 'Blackmoore', 4.99, 0);
$obj2 = new ShopProduct('Bells', 'Mike', 'Oldfield',  100, 20);			

$TextProductWriter = new TextProductWriter();
$TextProductWriter->addProduct($obj1);
$TextProductWriter->addProduct($obj2);
$TextProductWriter->write();