<?php

namespace EchoWine\Laravel\ORM;

class BuilderFields{

	/**
	 * Array of all aliases field
	 *
	 * @var array
	 */
	public $aliases = [];

	/**
	 * Array of all fields
	 *
	 * @var array
	 */
	public $fields = [];

	/**
	 * Construct
	 *
	 * @param array $aliases
	 */
	public function __construct($aliases){
		$this -> aliases = $aliases;
	}

	/**
	 * Call for fields
	 *
	 * @param string $method
	 * @param array $arguments
	 *
	 * @return mixed
	 */
	public function __call($method,$arguments){

		if(!in_array($method,$this -> aliases)){
			throw new \Exception("Alias not found");
		}

		$reflection = new \ReflectionClass($this -> aliases[$method]); 
		$field = $reflection -> newInstanceArgs($arguments); 

		$this -> addField($field);

		return $field;
	}
	
	/**
	 * Return all fields
	 *
	 * @return array
	 */
    public function getFields(){
        return $this -> fields;
    }

    /**
     * Add a field
     *
     * @param Field $field
     *
     * @return void
     */
    public function addField($field){
        $this -> fields[$field -> getName()] = $field;
    }
}

?>