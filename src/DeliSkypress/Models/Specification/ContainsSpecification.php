<?php

namespace DeliSkypress\Models\Specification;

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

use DeliSkypress\Models\Specification\AbstractSpecification;

class ContainsSpecification extends AbstractSpecification
{
    public function __construct($string){
        $this->string = $string;
    }

    public function isSatisfedBy($item){    
        $pos = strpos($this->string, $item);

        if ($pos === false) {
            return false;
        } else {
            return true;
        }
    }
}