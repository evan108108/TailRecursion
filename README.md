TailRecursion
=============

Tail-Recursion class for php 5.4 or greater

Inspired by [beberlei](https://gist.github.com/beberlei/4145442)


```php
echo TailRecursion::init(function($n, $acc = 1) {
    if ($n == 1) {
        return $acc;
    }
    return $this->tail($n - 1, $acc * $n);
})->run(4);  // 1 * 2 * 3 * 4 = 24
```
