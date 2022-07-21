<?php
namespace App\Controller;

use App\Service\GeometryCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculateController extends AbstractController
{
    /**
     * @Route("/triangle/{a}/{b}/{c}", methods={"GET","HEAD"})
     */
    public function triangle($a, $b, $c)
    {

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode([
            'type' => 'triangle',
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'surface' => $this->calculateSurface($a, $b, $c),
            'circumference' => $this->calculateCircumference($a, $b, $c),
        ]));
        return $response;

    } 
    /**
     * @Route("/circle/{radius}", methods={"GET","HEAD"})
     */
    public function showCircle($radius): Response
    {
    
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode([
            'type' => 'circle',
            'radius' => $radius,
            'surface' => $this->calculateSurfaceCircle($radius),
            'circumference' => $this->calculateCircumferenceCircle($radius),
        ]));
        return $response;
    }


    public function calculateGeometry($object1, $object2)
    {
        $geomerty = new GeometryCalculator();
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode([
            'type' => 'geometry',
            'surface' => $geomerty->sumOfAreas($object1, $object2),
            'circumference' => $geomerty->sumOfDiameters($object1, $object2),
        ]));
    }




    public function calculateSurface(float $a, float $b, float $c): float
    {
        $p = ($a + $b + $c) / 2;
        return sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
    }
    public function calculateCircumference(float $a, float $b, float $c): float
    {
        return $a + $b + $c;
    }
    public function calculateSurfaceCircle(float $radius): float
    {
        return pi() * $radius * $radius;
    }
    public function calculateCircumferenceCircle(float $radius): float
    {
        return 2 * pi() * $radius;
    }
}
