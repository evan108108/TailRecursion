<?php
/**
 * Starship\TailRecursion
 *
 * Tail Recusion class
 */

namespace Starship\TailRecursion;

class TailRecursion
{
		private $_func;
		private $_acc;
		private $_recursing;
		private $_closure;

		/**
		 * init
		 *
		 * Initializes the class and returns an instance of TailRecursion
		 *
		 * @param (Callable) (func) Recursive Callback
		 *
		 * @return (Object) (TailRecursion)
		 */ 
		public static function init(Callable $func)
		{
			$tail = new TailRecursion();
			$tail->setClosure($tail->getClosure($func));
			return $tail;
		}

		/**
		 * run
		 *
		 * Starts the recursion
		 *
		 * @return (Mixed) The end result of your recursion
		 */ 
		public function run()
		{
			return call_user_func_array($this->_closure, func_get_args());
		}

		/**
		 * Tail
		 *
		 * Call tail inside your callback to recurse
		 *
		 * @return (Callable) callback
		 */ 
		public function tail()
		{
				return call_user_func_array($this->_func, func_get_args());
		}

		/**
		 * setClosure
		 *
		 * Called internally to set the objects _closure private property
		 *
		 * @param (Callable) ($func)
		 *
		 * @return (Void)
		 */ 
		public function setClosure(Callable $func)
		{
			$this->_closure = $func;
		}

		/**
		 * getClosure
		 *
		 * @param (Callable) (func) Recursive Callback
		 *
		 * @return (Mixed) (result) can be call back or mixed value
		 */ 
		public function getClosure(Callable $func)
		{
				$this->_acc = array();
				$this->_recursing = false;
				$func = $func->bindTo($this);

				return $this->_func = function() use ($func) {

						$this->_acc[] = func_get_args();		

						if ( ! $this->_recursing) {
								$this->_recursing = true;

								while ($this->_acc) {
										$result = call_user_func_array($func, array_shift($this->_acc));
								}

								$this->_recursing = false;

								return $result;
						}
				};
		}
}
