<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *	collection.base.php
	 *  by Ryan Williams, 2013
	 *	� Ryan Williams & Stream 9, LLC
	 *
	 *  Stream 9 LLC
	 *	Cleveland, Ohio, USA
	 *	stream9.net
	 *
	 *  This framework is the sole property of Ryan Williams and Stream 9, LLC.  It may not
	 *	be used for any purpose without the expressed consent of its owners.
	 *
	 *
	 */


	namespace LiftKit\Input;

	use ArrayAccess;
	use Countable;
	use Iterator;


	class Input implements ArrayAccess, Countable, Iterator
	{
		protected $items = array();


		public function __construct ($array = array())
		{
			$this->items = (array) $array;
		}


		public function & getAll ()
		{
			return $this->items;
		}


		public function count ()
		{
			return count($this->items);
		}


		public function current ()
		{
			return current($this->items);
		}


		public function key ()
		{
			return key($this->items);
		}


		public function next ()
		{
			return next($this->items);
		}


		public function rewind ()
		{
			return reset($this->items);
		}


		public function valid ()
		{
			return key($this->items) !== null;
		}


		public function offsetExists ($offset)
		{
			return isset($this->items[$offset]);
		}


		public function offsetGet ($offset)
		{
			return $this->items[$offset];
		}


		public function offsetSet ($offset, $value)
		{
			$this->items[$offset] = $value;
		}


		public function offsetUnset ($offset)
		{
			unset($this->items[$offset]);
		}
	}