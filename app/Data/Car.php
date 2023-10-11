<?php

namespace App\Data;

class Car {

    public Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
    public function car()
    {
        return $this->brand->brand() . " - Xpander Cross";
    }
}
