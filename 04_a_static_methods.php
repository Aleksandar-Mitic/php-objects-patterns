<?php


class StaticExample
{
	
	public static $num = 5;

	public static function sayHello() {

		print 'Hello!';

	}
}

echo StaticExample::$num;

StaticExample::sayHello();

