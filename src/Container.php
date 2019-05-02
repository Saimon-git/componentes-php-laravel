<?php

namespace SimonMontoya;

use Closure;
use http\Exception\InvalidArgumentException;
use ReflectionClass;

class Container
{
    protected $shared = array();
    protected $bindings = array();

    public function bind($name, $resolver)
    {
        $this->bindings[$name] = [
            'resolver' => $resolver,
        ];
    }

    public function instance($name, $object)
    {
        $this->shared[$name] = $object;
        
    }

    public function make($name)
    {
        if (isset($this->shared[$name])) {
            return $this->shared[$name];
        }
        
        $resolver = $this->bindings[$name]['resolver'];

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        }else{
            $object =  $this->build($resolver);
        }

        

        return $object;
    }

    public  function  build($name)
    {
        $reflection = new ReflectionClass($name);

        if(!$reflection->isInstantiable())
        {
            throw new InvalidArgumentException("$name is not instanciable");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)){
            return new $name;
        }

        $constructorParameters = $constructor->getParameters();

        $arguments = array();

        foreach ($constructorParameters as $constructorParameter){

            $parameterClassName = $constructorParameter->getClass()->getName();

            $arguments[] = $this->build($parameterClassName);

        }

        return $reflection->newInstanceArgs($arguments);
    }

    
}