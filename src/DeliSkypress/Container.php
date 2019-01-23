<?php

namespace DeliSkypress;

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

use DeliSkypress\Models\ContainerInterface;
use DeliSkypress\Models\ContainerServiceInterface;
use DeliSkypress\Models\MediatorServicesInterface;

use DeliSkypress\ContainerServiceTrait;

class Container implements ContainerInterface
{
    /**
     * @access protected
     */
    protected $services = array();

    public function __construct($array = array()){
        $this->setServices($array);
        foreach ($this->getServices() as $key => $service) {
            if ($service instanceOf MediatorServicesInterface) {
                $service->setServices($this->getServices());
            }
        }
    }

    public function getServices(){
        return $this->services;
    } 

    /**
     * @param string $key
     */
    public function getService($key){
        
        if(array_key_exists($key, $this->services)){
            return $this->services[$key];
        }

        return null;
        
    }

    /**
     * @param ContainerServiceInterface $service
     *
     * @return Container
     */
    public function setService(ContainerServiceInterface $service){

        $classname = get_class($service);

        if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
            $classname = $matches[1];
        }

        $classname = apply_filters("_container_set_service_classname", $classname);

        $this->services[$classname] = $service;

        return $this;
    }

    /**
     * @param ContainerServiceInterface[] $services default empty
     *
     * @return Container
     */
    public function setServices($services = array()){
        $services = apply_filters("_container_set_services", $services);

        foreach ($services as $key => $service) {
            $this->setService($service);
        }

        return $this;

    }
}