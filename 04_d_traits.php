<?php

// Code without traits and duplication of methods
class ShopProduct
{
	private $productName;
	private $price = 10;
	private $taxrate = 17;

	public function __construct(
		string $productName, 
		float  $price,
		float  $taxrate
	) {
	 	$this->productName	= $productName;
		$this->price        = $price;
		$this->taxrate      = $taxrate;
	}

	public function calculateTax(float $price): float
	{
		return (($this->taxrate / 100) * $price);
	}
}


$p = new ShopProduct("Fine Soap", 12.5, 22);
print $p->calculateTax(30) . "\n";


abstract class Service
{
	// service oriented stuff
}

class UtilityService extends Service
{
	private $taxrate = 17;
	function calculateTax(float $price): float
	{
		return ( ( $this->taxrate/100 ) * $price );
	}
}
$u = new UtilityService();
print $u->calculateTax(100)."\n";


// Using a Traits

trait PriceUtilities
{
	private $taxrate = 17;

	public function calculateTax(float $price): float
	{
		return (($this->taxrate / 100) * $price);
	}
	// other utilities
}

/**
 *
 * Now using Traits
 *
 */

class NewShopProduct
{
	use PriceUtilities;
}


abstract class NewService
{
// service oriented stuff
}


class NewUtilityService extends Service
{
	use PriceUtilities;
}

$p = new NewShopProduct();
print $p->calculateTax(100) . "\n";

$u = new NewUtilityService();
print $u->calculateTax(100) . "\n";


/**
 *
 * Defining Abstract Methods in Traits
 *
 */

trait PriceUtilitiesNew
{
	function calculateTax(float $price): float
	{
		// better design.. we know getTaxRate() is implemented
		return (($this->getTaxRate() / 100) * $price);
	}
	abstract function getTaxRate(): float;
	// other utilities
}


class UtilityServiceNew extends Service
{
	use PriceUtilitiesNew;

	public function getTaxRate(): float
	{
		return 17;
	}
}

$u = new UtilityServiceNew();
print $u->calculateTax(100) . "\n";