<?php

namespace BigD\CampaniasBundle\Controller;

use BigD\CampaniasBundle\Entity\Preguntas;
use BigD\CampaniasBundle\Form\PreguntasType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller {

    public function agregarPreguntasAction(Request $request) {

        $pregunta = new Preguntas();
        $form = $this->createForm(new PreguntasType(), $pregunta);


        return $this->render('CampaniasBundle:Ajax:agregarPreguntas.html.twig', array(
                    "form" => $form->createView(),
        ));
    }

}
