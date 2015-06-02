<?php

namespace BigD\CampaniasBundle\Controller;

use BigD\CampaniasBundle\Entity\Preguntas;
use BigD\CampaniasBundle\Form\PreguntasType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller {

    public function agregarPreguntasAction(Request $request) {

        $agrupadorId = $request->get("agrupadorId");
        $itemId = $request->get("itemId");

        $pregunta = new Preguntas();
        $form = $this->createForm(new PreguntasType(), $pregunta);


        return $this->render('CampaniasBundle:Ajax:agregarPreguntas.html.twig', array(
                    "form" => $form->createView(),
                    "agrupadorId" => $agrupadorId,
                    "itemId" => $itemId,
        ));
    }

    public function guardarPreguntasAction(Request $request) {
        $agrupadorId = $request->get("agrupador_id");
        $itemId = $request->get("item_id");

        $preguntas = new Preguntas();

        $form = $this->createForm(new PreguntasType(), $preguntas);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();


        $agrupador = $em->getRepository('CampaniasBundle:AgrupadorPregunta')->find($agrupadorId);
        if (!$agrupador) {
            $cantidadPreguntas = 0;
        } else {
            $cantidadPreguntas = (count($agrupador->getPreguntas()) + 1);
        }




        $html = $this->render("CampaniasBundle:Ajax:tpl_preguntas.html.twig", array(
                    "form" => $form->createView(),
                ))->getContent()
        ;
        $valor = "bigd_campaniasbundle_campaniaencuesta[agrupador][$agrupadorId][preguntas][$cantidadPreguntas]";

        $pregunta = str_replace($form->getName(), $valor, $html);
        $pregunta = strstr($pregunta, "<script", true);

        return new JsonResponse($pregunta);
    }

}
