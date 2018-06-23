<?php

// Although abstract classes let you provide some measure of implementation, interfaces are pure templates.
// An interface can only define functionality; it can never implement it. It can contain properties and method declarations but not method bodies.

interface Chargeable
{
	public function getPrice(): float;
}

// As you can see, an interface looks very much like a class. Any class that incorporates this interface
// commits to implementing all the methods it defines, or it must be declared abstract.
class ShopProduct implements Chargeable
{
	
	protected $price;

	public function getPrice() :float
	{
		return $this->price;
	}
}


// A class can both extend a superclass and implement any number of interfaces. The extends clause should precede the implements clause.
class Consultancy extends TimedService implements Bookable, Chargeable
{
	// ...
}
