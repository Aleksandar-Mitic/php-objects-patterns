<?php

// Not the best approach to class hierarchy !!!
// abstract class Lesson
// {
// 	private $duration;
// 	private $costtype;

// 	CONST   FIXED = 0;
// 	CONST   TIMED = 1;

// 	function __construct(int $duration, int $costtype = 1) {
// 		$this->duration = $duration;
// 		$this->costtype = $costtype;
// 	}

// 	public function cost() :int
// 	{
// 		if ($this->costtype == 1) {
// 			return (5 * $this->duration);
// 		} else {
// 			return 30;
// 		}
// 	}

// 	public function chargeType()
// 	{

// 		if ($this->costtype == 1) {
// 			return 'Hourly rate';
// 		} else {
// 			return 'Fixed rate';
// 		}
		
// 	}

// }


// class Lecture extends Lesson
// {
//     // Lecture-specific implementations ...
// }

// class Seminar extends Lesson
// {
//     // Seminar-specific implementations ...
// }

// $lecture = new Lecture(5, Lesson::FIXED);
// print "{$lecture->cost()} ({$lecture->chargeType()})<br />";
// $seminar = new Seminar(3, Lesson::TIMED);
// print "{$seminar->cost()} ({$seminar->chargeType()})<br />";


// Using the strategy pattern approacch!!!

abstract class Lesson
{
	private $duration;
	private $costStrategy;

	public function __construct(int $duration, CostStrategy $costStrategy){
		$this->duration 	= $duration;
		$this->costStrategy = $costStrategy;
	}

	public function cost() :int
	{
		// This method is sending THIS instance for calculation to outside method 
		return $this->costStrategy->cost($this);
	}

	public function chargeType() :string
	{

		return $this->costStrategy->chargeType();
	}
	
	public function getDuration() :int
	{
		return $this->duration;
	}	

}

class Lecture extends Lesson
{

}


class Seminar extends Lesson
{
	
}


abstract class CostStrategy
{
	abstract public function cost(Lesson $lesson): int;
	abstract public function chargeType(): string;
}

class TimedCostStrategy extends CostStrategy
{
	public function cost(Lesson $lesson): int
	{
		return ($lesson->getDuration() * 5);
	}
	
	public function chargeType(): string
	{
		return "hourly rate";
	}
}

class FixedCostStrategy extends CostStrategy
{
	public function cost(Lesson $lesson): int
	{
		return 30;
	}

	public function chargeType(): string
	{
		return "fixed rate";
	}
}

$lessons = new Seminar(4, new TimedCostStrategy());

echo $lessons->cost();