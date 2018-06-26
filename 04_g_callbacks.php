<?php

class Product {
	public $name;
	public $price;

	public function __construct(string $name, float $price)
	{
		$this->name = $name;
		$this->price = $price;
	}
}

class ProcessSale
{
	private $callbacks;

	public function registerCallback(callable $callback)
	{
		if (! is_callable($callback)) {
			throw new Exception("callback not callable");
		}
		$this->callbacks[] = $callback;
	}

	public function sale(Product $product)
	{
		print "{$product->name}: processing \n";
		foreach ($this->callbacks as $callback) {
			call_user_func($callback, $product);
		}
	}
}

// Now we add a callback function, example: log entries
// $logger = create_function(
// 	'$product',
// 	'print " logging ({$product->name})<br />";'
// );


// Lambda function
$logger = function($product) {
	print "logging ({$product->name})<br />";
};


$processor = new ProcessSale();
$processor->registerCallback($logger);
$processor->sale(new Product("shoes", 6));

$processor->sale(new Product("coffee", 6));

// var_dump($logger);

class Mailer
{
	public function doMail(Product $product)
	{
		print " mailing ({$product->name})\n";
	}
}

echo '<br /> <b>Output from Mailer class</b> <br />';
$processor = new ProcessSale();

// When I call registerCallback(), I pass it an array. The first element is a Mailer
// object, and the second is a string that matches the name of the method I want invoked. Remember that
// registerCallback() checks its argument for callability. is_callable() is smart enough to test arrays of this sort.
$processor->registerCallback([new Mailer(), "doMail"]);
$processor->sale(new Product("shoes", 6));
print "<br />";
$processor->sale(new Product("coffee", 6));


// Return an anonymous function
class Totalizer 
{
	public static function warnAmount() 
	{
		return function(Product $product) {
			if ($product->price > 5) {
				print "<br /> You have reached high price: {$product->price} <br />";
			}
		};
	}
}

print "<br /> <br /> <b>New warnAmount() callback output!</b> <br />";
$processor->registerCallback(Totalizer::warnAmount());
$processor->sale(new Product("shoes", 69));