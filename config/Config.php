<?php

class Config
{
    /**
     * @var SimpleXMLElement
     */
    protected $configData;

    /**
     * @var array
     */
    protected $objects = [];

    /**
     * Config constructor.
     * @param string $xmlPath
     */
    public function __construct(string $xmlPath)
    {
        $this->configData = simplexml_load_file($xmlPath);
    }

    public function config()
    {
        foreach ($this->configData->class as $class) {
            $this->objects[(string)$class['abstract']]= $this->createInstance($class);
        }
    }

    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function getObject(string $key){
        if(isset($this->objects[$key])){
            return $this->objects[$key];
        }
        throw new Exception("Class $key not found in ". get_class($this));
    }

    /**
     * @param object $data
     * @return object
     * @throws ReflectionException
     */
    protected function createInstance(object $data)
    {
        $constructorArgs = [];
        $classToInstantiate = new ReflectionClass((string)$data['name']);
        if (count($data->arg) > 0) {
            foreach ($data->arg as $arg) {
                if ((string)$arg['type'] === 'class') {
                    $constructorArgs[] = $this->createInstance($arg);
                }
                elseif((string)$arg['type'] === 'int'){
                    $constructorArgs[] = intval((string)$arg['name']);
                }
            }
        }
        return $classToInstantiate->newInstanceArgs($constructorArgs);
    }
}