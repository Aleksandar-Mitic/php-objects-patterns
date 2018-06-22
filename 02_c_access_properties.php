<?php

// Inheritance is the means by which one or more classes can be derived from a base class.

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

// $ShopProduct = new ShopProduct('Deep Purple', 'Richie', 'Blackmoore', 4.99, 0, 157);
// echo $ShopProduct->getProducer();
// echo '<br />';
// echo $ShopProduct->getSummaryLine();
// echo $ShopProduct->getPrice();
// echo  $ShopProduct->price;
	

class CdProduct extends ShopProduct
{
	public $playLength;

	public function __construct(
		string $title,
		string $producerFirstName,
		string $producerLastName,
		int    $price,
		int    $playLength,
		int    $discount
	) {
		parent::__construct(
			$title,
			$producerFirstName,
			$producerLastName,
			$price,
			$discount
		);
		$this->playLength = $playLength;
	}

	public function getPlayLength()	
	{
		return $this->playLength;
	}

	// Notice that both the CdProduct and BookProduct classes override the getSummaryLine() method,
    // providing their own implementation. Derived classes can extend but also alter the functionality of their parents.
	public function getSummaryLine()
	{
		$base = parent::getSummaryLine();
		$base .= "Playing time: {$this->playLength} )";
		return $base;
	}

	public function getPrice()
	{
		return ($this->price - $this->discount);
	}

} 

echo 'CD <br />';
$cd = new CdProduct('Pink Floyd', 'Mark', 'Knopfler', 10, 299, 5);
// echo $cd->getSummaryLine();
echo $cd->getPrice();
echo '<br />';

class BookProduct extends ShopProduct
{
	public $numPages;
	public function __construct(
		string $title,
		string $producerFirstName,
		string $producerLastName,
		float  $price,
		int    $numPages

	) {
		parent::__construct(
			$title,
			$producerFirstName,
			$producerLastName,
			$price
		);

		$this->numPages = $numPages;
	}

	public function getNumberOfPages()	
	{
		return $this->numPages;
	}
	// Notice that both the CdProduct and BookProduct classes override the getSummaryLine() method,
    // providing their own implementation. Derived classes can extend but also alter the functionality of their parents.
	public function getSummaryLine()
	{
		$base = parent::getSummaryLine();
		$base .= "Number of pages: {$this->numPages} )";
		return $base;
	}

} 

// echo 'Books <br />';
// $book = new BookProduct('Master of  Orion', 'Mark', 'Twain', 3.99, 264, 157);
// echo $book->getSummaryLine();
// echo $book->getNumberOfPages();


