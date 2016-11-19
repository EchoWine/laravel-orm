<?php

namespace EchoWine\Laravel\ORM;

use Illuminate\DataBase\Eloquent\Model as BaseModel;

class Model extends BaseModel{

	public static $aliases = [];

    /**
     * Get a new query builder for the model's table.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
	public static function repository(){
		return $this -> newQuery();
	}

	/**
	 * Set aliases files
	 *
	 */
	public static function setAliases($fields){
		self::$aliases = $fields;
	}

    /**
     * List of all fields
     *
     * @var Array
     */
    protected $fields = [];

    /**
     * Boot fields 
     *
     * @param FieldsBuilder $builder
     */
    protected function bootFields(){
        $builder = new BuilderFields(config('laravel-orm.fields'));
        $this -> fields($builder);
        $this -> fields = $builder -> getFields();
    }

    /**
     * Boot fields 
     *
     * @param FieldsBuilder $builder
     */
    protected function fields($builder){}

    /**
     * Get all fields
     *
     * @return array
     */
    public function getFields(){
        return $this -> fields;
    }

    /**
     * Exists the field ? 
     *
     * @param string $name
     */
    public function isField($name){
        return isset($this -> fields[$name]);
    }

    /**
     * Get the field
     *
     * @param string $name
     *
     * @return Field
     */
    public function getField($name){
        return $this -> fields[$name];
    }
  
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = []){

        $this -> bootFields();
        foreach($this -> getFields() as $field){
            $name = $field -> getName();
            if(!in_array($field -> getName(),$this -> fillable)){
                $this -> fillable[] = $name;
            }
            $field -> setModel($this);
        }

        $this -> bootIfNotBooted();

        $this -> syncOriginal();


        $this -> fill($attributes);


    }


    /**
     * Set the array of model attributes. No checking is done.
     *
     * @param  array  $attributes
     * @param  bool  $sync
     * @return $this
     */
    public function setRawAttributes(array $attributes, $sync = false){
        
        foreach($attributes as $name => $attribute){
            
            if($this -> isField($name)){
                $field = $this -> getField($name);
                $field -> setRawValue($attribute);
            }
            
        }

        return parent::setRawAttributes($attributes,$sync);

    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters){

        if($this -> isField($method))
            return $this -> getField($method); 

        return parent::__call($method, $parameters);

    }

}


?>