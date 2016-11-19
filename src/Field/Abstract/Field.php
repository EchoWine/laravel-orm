<?php

namespace EchoWine\Laravel\ORM\Field\Abstract;

class Field{
	
	/**
	 * Name of field
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Hidden field
	 *
	 * @var boolean
	 */
	public $hidden = false;

	/**
	 * Unique field
	 *
	 * @var boolean
	 */
	public $unique = false;

	/**
	 * Construct
	 *
	 * @param string $name
	 */
	public function __construct($name){
		$this -> name = $name;
	}

	/**
	 * Set hidden field
	 *
	 * @param boolean $hidden
	 *
	 * @return this
	 */
	public function hidden($hidden = true){
		$this -> hidden = $hidden;
		return $this;
	}	

	/**
	 * Set unique field
	 *
	 * @param boolean $unique
	 *
	 * @return this
	 */
	public function unique($unique = true){
		$this -> unique = $unique;
		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName(){
		return $this -> name;
	}
}
