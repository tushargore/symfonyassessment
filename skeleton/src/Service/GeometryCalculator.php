<?php 
namespace App\Service;

class GeometryCalculator
{
    public function sumOfAreas(object $object1, object $object2): float
    {
        return $object1->area + $object2->area;
    }

    public function sumOfDiameters(object $object1, object $object2): float
    {
        return $object1->diameter + $object2->diameter;
    }
}