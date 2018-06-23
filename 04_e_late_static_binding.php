<?php

/**
 *
 * Code with duplication od methods
 *
 */

abstract class Vechiles
{
	
}

class Car extends Vechiles 
{

	public static function create() : Car
	{
		return new Car();
	}

}

class Truck extends Vechiles 
{

	public static function create() : Truck
	{
		return new Truck();
	}

}

Truck::create();


/**
 *
 * Code without duplication
 *
 */
abstract class NewVechiles
{
	public static function create() :NewVechiles
	{
		// static is similar to self, except that it refers to the invoked rather than
		// the containing class. In this case, it means that calling NewTruck::create() results in a new NewTruck object
		// and not a doomed attempt to instantiate a NewVechiles object.
		
		// return new self();
		return new static();
	}
}

class NewCar extends NewVechiles 
{

}

class NewTruck extends NewVechiles 
{

}

NewTruck::create();
