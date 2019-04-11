<?php

// This code is designed to run my various callbacks. It consists of two classes, Product and ProcessSale.
// Product simply stores $name and $price properties. I’ve made these public for the purposes of brevity.
// Remember, in the real world, you’d probably want to make your properties private or protected and provide
// accessor methods. ProcessSale consists of two methods.
// The first, registerCallback(), accepts an unhinted scalar, tests it, and adds it to a callback array. The
// test, a built-in function called is_callable(), ensures that whatever I’ve been given can be invoked by a
// function such as call_user_func() or array_walk().
// The second method, sale(), accepts a Product object, outputs a message about it, and then loops
// through the $callback array property. It passes each element to call_user_func(), which calls the code,
// passing it a reference to the product. All of the following examples will work with the framework.

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


// Why are callbacks useful? They allow you to plug functionality into a component at runtime that is not
// directly related to that component’s core task. By making a component callback aware, you give others the
// power to extend your code in contexts you don’t yet know about.


// Anonymous function sent to callback
$logger = function($product) {
	print " | logging from callback ({$product->name})<br />";
};

$processor = new ProcessSale();
$processor->registerCallback($logger);
$processor->sale(new Product("shoes", 6));
$processor->sale(new Product("coffee", 6));

// Output
// shoes: processing | logging from callback (shoes)
// coffee: processing | logging from callback (coffee)

// var_dump($logger);

echo '<hr />';


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
