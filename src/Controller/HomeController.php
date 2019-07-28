<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index(): Response
    {
        $number = random_int(0, 100);

        /* return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        ); */

        return $this->render('home/welcome.html.twig', [
            'number' => $number
        ]);
    }
}