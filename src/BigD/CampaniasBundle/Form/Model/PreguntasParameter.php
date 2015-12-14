<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 25/8/15
 * Time: 19:22
 */

namespace BigD\CampaniasBundle\Form\Model;


use Doctrine\ORM\EntityManager;

class PreguntasParameter {
	protected $data;

	/**
	 * @var PreguntasParameter
	 */
	protected $subPreguntas;

	protected $cantidadCollection;

	public function __construct( $parameters, EntityManager $entityManager, $edit = false, $extraParam = array() ) {
//		$this->subPreguntas = new \Doctrine\Common\Collections\ArrayCollection();
		/* @var $value \BigD\CampaniasBundle\Entity\Preguntas */
		if ( $edit == false ) {
			$this->subPreguntas = array();
			foreach ( $parameters as $k => $value ) {


				if ( $value->getAgrupadorPregunta()->getMultiple() ) {
					$fieldName                          = ucwords(
						preg_replace(
							'/[^A-Za-z0-9\-]/',
							'',
							str_replace( ' ', '', $value->getAgrupadorPregunta()->getNombre() )
						)
					);
					$this->subPreguntas[ $fieldName ][] = $this->buildFieldPregunta( $value, true )['aPregunta'];
				} else {

					$buildField          = $this->buildFieldPregunta( $value );
					$name                = $buildField['name'];
					$this->data[ $name ] = $buildField['aPregunta'][ $name ];
					$this->{$name}       = "";

				}
			}

			return $this;
		} else {

			foreach ( $parameters as $k => $value ) {

				if ( $value->getAgrupadorPregunta()->getMultiple() ) {

					$fieldName                          = ucwords(
						preg_replace(
							'/[^A-Za-z0-9\-]/',
							'',
							str_replace( ' ', '', $value->getAgrupadorPregunta()->getNombre() )
						)
					);
					$this->subPreguntas[ $fieldName ][] = $this->buildFieldPregunta( $value, true )['aPregunta'];

					$preguntaResultadoRespuesta = $entityManager->getRepository(
						'CampaniasBundle:PreguntaResultadoRespuesta'
					)->getRespuesta( $value, $extraParam['resultadoCabecera'] );


					$indiceCollection = 0;


					foreach ( $preguntaResultadoRespuesta as $respuetaColl ) {


//						$buildFieldCol = $this->buildFieldPregunta(
//							$respuetaColl->getPreguntas(),
//							true
//						);

						$buildField          = $this->buildFieldPregunta( $value, true );
						$name                = $indiceCollection . "_" . $buildField['name'];
						$this->data[ $name ] = $buildField['aPregunta'][ $buildField['name'] ];
						$this->{$name}       = "";

						$pValue                     = '';
						$preguntaResultadoRespuesta = $entityManager->getRepository(
							'CampaniasBundle:PreguntaResultadoRespuesta'
						)->getRespuesta( $respuetaColl->getPreguntas(), $extraParam['resultadoCabecera'] );


						if ( $extraParam['resultadoCabecera'] ) {
							$resultadoRespuesta = $preguntaResultadoRespuesta[ $indiceCollection ]->getResultadoRespuesta();
							if ( $resultadoRespuesta->getOpcionesRespuesta() ) {
								$pValue = $resultadoRespuesta->getOpcionesRespuesta()->getId();
							} else {
								$pValue = $resultadoRespuesta->getTextoRespuesta();
							}
						}

						$this->data[ $name ]['value'] = $pValue;
						$this->{$name}                = $pValue;
						$indiceCollection ++;

					}


				} else {

					$buildField          = $this->buildFieldPregunta( $value );
					$name                = $buildField['name'];
					$this->data[ $name ] = $buildField['aPregunta'][ $name ];
					$this->{$name}       = "";

					$pValue                     = '';
					$preguntaResultadoRespuesta = $entityManager->getRepository(
						'CampaniasBundle:PreguntaResultadoRespuesta'
					)->getRespuesta( $value, $extraParam['resultadoCabecera'] );


					if ( $extraParam['resultadoCabecera'] ) {
						$resultadoRespuesta = $preguntaResultadoRespuesta[0]->getResultadoRespuesta();
						if ( $resultadoRespuesta->getOpcionesRespuesta() ) {
							$pValue = $resultadoRespuesta->getOpcionesRespuesta()->getId();
						} else {
							$pValue = $resultadoRespuesta->getTextoRespuesta();
						}

					}

					$this->data[ $name ]['value'] = $pValue;
					$this->{$name}                = $pValue;
				}

			}
			if ( isset( $indiceCollection ) ) {
				$this->cantidadCollection = $indiceCollection;
			}

			ksort( $this->data );

			return $this;
		}
	}

	public function buildFieldPregunta( $pregunta, $collection = false ) {
		if ( $collection ) {
			$aPregunta = array();
		} else {
			$aPregunta = $this->data;
		}

		$name       = $pregunta->getId();
		$widgetType = 'text';
		if ( $pregunta->getTipoPregunta()->getMuestraOpciones() ) {
			$widgetType = 'choice';
		} elseif ( $pregunta->getTipoPregunta()->getSlug() == 'tipo-pregunta-date' ) {
			$widgetType = 'date';
		}
		$aPregunta[ $name ] = array(
			"widgetType" => $widgetType,
			"label"      => $pregunta->getTextoPregunta(),
			"value"      => "",
			"required"   => $pregunta->getRequerido() ? true : false,
		);
		if ( $pregunta->getTipoPregunta()->getMuestraOpciones() ) {
			foreach ( $pregunta->getOpcionRespuesta()->toArray() as $opcion ) {
				$aPregunta[ $name ]['choices'][ $opcion->getId() ] = $opcion->getTextoOpcion();
			}

		}


		return array( 'aPregunta' => $aPregunta, 'name' => $name );
	}

	public function get() {
		return $this->data;
	}

	public function __get( $name ) {
		return $this->data[ $name ];
	}

	public function getSubPreguntas() {
		return $this->subPreguntas;
	}

	public function getCantidadCollection() {
		return $this->cantidadCollection;
	}
}