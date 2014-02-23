<?php

namespace Starship\TailRecursion\Tests;

require_once __DIR__ . '/../../../src/Starship/TailRecursion/TailRecursion.php';

use \Starship\TailRecursion\TailRecursion as tr;

/** @test */
class TailRecursionTest extends \PHPUnit_Framework_TestCase
{
	public function testTailRecursionSimple()
	{
		$this->assertEquals(12502500, tr::init(function($n, $acc = 1) {
				if ($n == 1) {
						return $acc;
				}
				return $this->tail($n - 1, $acc + $n);
		})->run(5000));
	}

	public function testTailRecursionAdvanced()
	{
		$flattenList = tr::init(function($list, $acc=[]) {
			if(count($list) < 1) {
				return $acc;
			}
			if(is_array($result = array_shift($list))) {	
				 return $this->tail(array_merge($result, $list), $acc);	
			}
			
			$acc[] = $result;
			return $this->tail($list, $acc);
		});

		$this->assertEquals(
			[0,1,2,3,4,5,6,7,8,9,10],
			$flattenList->run([1,[2,3],[4,[5]],[6], [7,[8,9],10]], [0])
		);
		
	}

}

