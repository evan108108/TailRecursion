<?php
class TailRecursion
{
		public $func;
		public $acc;
		public $recursing;
		public $clousure;

		public static function init($func)
		{
			$tail = new TailRecursion();
			$tail->clousure = $tail->getClosure($func);
			return $tail;
		}

		public function run()
		{
			return call_user_func_array($this->clousure, func_get_args());
		}

		public function tail()
		{
				return call_user_func_array($this->func, func_get_args());
		}

		public function getClosure($fn)
		{
				$this->acc = array();
				$this->recursing = false;
				$fn = $fn->bindTo($this);

				return $this->func = function() use ($fn) {

						$this->acc[] = func_get_args();		

						if ( ! $this->recursing) {
								$this->recursing = true;

								while ($this->acc) {
										$result = call_user_func_array($fn, array_shift($this->acc));
								}

								$this->recursing = false;

								return $result;
						}
				};
		}
}
