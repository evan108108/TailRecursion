TailRecursion
=============

Tail-Recursion class for php 5.4 or greater

Inspired by [beberlei](https://gist.github.com/beberlei/4145442)

## Install

The recommended way to install react/scalar is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "starship/tailrecursion": "dev-master"
    }
}
```

## Examples

```php
use \Starship\TailRecursion\TailRecursion as tr;

echo tr::init(function($n, $acc = 1) {
    if ($n == 1) {
        return $acc;
    }
    return $this->tail($n - 1, $acc * $n);
})->run(4);  // 1 * 2 * 3 * 4 = 24
```

```php
use \Starship\TailRecursion\TailRecursion as tr;

$flatList = tr::init(function($list, $acc=[]) {
	if(count($list) < 1) {
		return $acc;
	}
	if(is_array($result = array_shift($list))) {	
		 return $this->tail(array_merge($result, $list), $acc);	
	}
	
	$acc[] = $result;		
	return $this->tail($list, $acc);
});

//Will output 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
print_r($flatList->run([1,[2,3],[4,[5]],[6], [7,[8,9],10]], [0])); 
```
