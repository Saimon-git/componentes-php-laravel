<?php

namespace SimonMontoya;

use Closure;

use http\Exception\InvalidArgumentException;

use ReflectionClass;
use ReflectionException;

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

    public function make($name, array $arguments = array())
    {

        if (isset($this->shared[$name])) {
            return $this->shared[$name];
        }

        if (isset($this->bindings[$name])){
            $resolver = $this->bindings[$name]['resolver'];
        }else{
            $resolver = $name;
        }

        if ($resolver instanceof Closure) {
            $object = $resolver($this);

        }else{

            $object =  $this->build($resolver,$arguments);
        }

        

        return $object;
    }

    public  function  build($name, array $arguments = array())
    {
        try{
            $reflection = new ReflectionClass($name);
        }catch (ReflectionException $e){
            throw new ContainerException("". $e->getMessage(), null, $e);
        }
        if(!$reflection->isInstantiable())
        {
            throw new InvalidArgumentException("$name is not instanciable");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)){
            return new $name;
        }

        $constructorParameters = $constructor->getParameters();

        $dependencies = array();

        foreach ($constructorParameters as $constructorParameter){

            $parameterName = $constructorParameter->getName();

            if (isset($arguments[$parameterName])){
                $dependencies[] = $arguments[$parameterName];
                continue;
            }

            try{
                $parameterClass = $constructorParameter->getClass();
            }catch (ReflectionException $e){
                throw new ContainerException("Unable to build [$name]" . $e->getMessage(),null , $e);
            }

            if ($parameterClass != null){
                $parameterClassName = $parameterClass->getName();

                $dependencies[] = $this->build($parameterClassName);
            }else{
                /*$parameterDefault = new \ReflectionParameter();
                $parameter = $parameterDefault->getDefaultValue();
                $dependencies[] .= $parameter;*/
                throw new ContainerException("Please provide value of  the parameter [$parameterName]");
            }

        }

        return $reflection->newInstanceArgs($dependencies);
    }

    
}