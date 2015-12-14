<?php

/**
 * Created by PhpStorm.
 * User: matias
 * Date: 13/7/15
 * Time: 17:44
 */

namespace BigD\CampaniasBundle\Services;

use BigD\CampaniasBundle\Entity\PreguntaResultadoRespuesta;
use BigD\CampaniasBundle\Entity\ResultadoCabecera;
use BigD\CampaniasBundle\Entity\ResultadoRespuesta;
use Doctrine\ORM\EntityManager;

class EncuestasManager {

	private $container;
	/* @var $em EntityManager */
	private $em;

	public function __construct( $container ) {
		$this->container = $container;
		$this->em        = $container->get( 'doctrine' )->getManager();
	}

	public function getPreguntasPorIdEncuesta( $id ) {
		$em        = $this->em;
		$preguntas = $em->getRepository( 'CampaniasBundle:Encuesta' )->getPreguntasPorIdEncuesta( $id );

		return $preguntas;
	}

	public function getPreguntasRespuestaPorIdEncuesta( $id ) {
		$em        = $this->em;
		$preguntas = $em->getRepository( 'CampaniasBundle:Encuesta' )->getPreguntasRespuestaPorIdEncuesta( $id );

		return $preguntas;
	}

	/**
	 * Traigo un array de encuestas para armar el excel.
	 *
	 * @param $id
	 * @param mixed $filtros
	 *
	 * @return array
	 */
	public function getAEncuestas( $id, $filtros = null ) {
		ini_set( 'display_errors', true );
		set_time_limit( 0 );
		ini_set( "memory_limit", "-1" );
		$em = $this->em;

		$cabecera             = array();
		$orden                = 0;
		$arrayOrden           = array();
		$cantidadPorAgrupador = array();
		$tabla                = array();

		//Traigo los agrupadores
		$agrupadores = $em->getRepository( 'CampaniasBundle:AgrupadorPregunta' )->getAgrupadoresPorEncuestaId( $id );

		foreach ( $agrupadores as $agrupador ) {
			if ( ! $agrupador['multiple'] ) {
				$preguntas = $em->getRepository( 'CampaniasBundle:Preguntas' )->getPreguntasPorAgrupadorId(
					$agrupador['agrupador_id']
				);
				foreach ( $preguntas as $pregunta ) {
					$cabecera[]                             = $pregunta['texto_pregunta'];
					$arrayOrden[ $pregunta['pregunta_id'] ] = $orden;
					$orden ++;
				}
				$cantidadPorAgrupador[] = array( "id" => $agrupador['agrupador_id'], "cantidad" => 1 );
			} else {

				$cantidadAgrupador = $em->getRepository( 'CampaniasBundle:Encuesta' )->getMaxCamposEncuestaPorAgrupadorId(
					$agrupador['agrupador_id']
				);

				//traigo las preguntas de este agrupador y las creo la cantidad de $cantidadAgrupador
				$preguntasPorAgrupador = $em->getRepository(
					'CampaniasBundle:AgrupadorPregunta'
				)->getPreguntasMultiplesPorAgrupadorId(
					$agrupador['agrupador_id']
				);

				$cabeceraAgrupador = array();
				foreach ( $preguntasPorAgrupador as $preguntaPorAgrupador ) {
					$cabeceraAgrupador[]                                = $preguntaPorAgrupador['texto_pregunta'];
					$arrayOrden[ $preguntaPorAgrupador['pregunta_id'] ] = $orden;
					$orden ++;
				}
				$contadorPreguntasReales = 1;
				$cantidadAgrupador       = $cantidadAgrupador[0]['max'];
				for ( $i = 0; $i < $cantidadAgrupador; $i ++ ) {
					foreach ( $cabeceraAgrupador as $pregunta ) {
						$cabecera[] = $pregunta;
						$contadorPreguntasReales ++;
						if ( $contadorPreguntasReales >= $cantidadAgrupador ) {
							$orden ++;
						}
					}
				}
				$cantidadPorAgrupador[] = array( "id" => $agrupador['agrupador_id'], "cantidad" => $cantidadAgrupador );
			}
		}

		$cabecera[] = "Fecha creado";
		$fila1      = ksort( $arrayOrden );

		$encuestasResultado = $em->getRepository( 'CampaniasBundle:ResultadoCabecera' )->getResultadoCabeceraPorEncuesta(
			$id,
			$filtros
		);

		foreach ( $encuestasResultado as $encuestaResultado ) {
			//consulto cuantas preguntas tiene la encuesta para saber si es la encuesta con error de 52 o la de 53
			$cantidadPreguntasEncuesta = $em->getRepository(
				'CampaniasBundle:Preguntas'
			)->getCantidadPreguntasPorAgrupadorIdParaPosadasPremia( $encuestaResultado['resultado_cabecera_id'] );

			$fila = array();

			foreach ( $cantidadPorAgrupador as $aAgrupador ) {
				//consulto cantidad de preguntas que tiene el agrupador
				$cantidadPreguntasAgrupador = $em->getRepository(
					'CampaniasBundle:AgrupadorPregunta'
				)->getCantidadPreguntasPorAgrupadorId(
					$aAgrupador['id']
				)[0];

				//consulto si el agrupador es multiple
				$multiple = $em->getRepository(
					'CampaniasBundle:AgrupadorPregunta'
				)->esAgrupadorMultiple(
					$aAgrupador['id'],
					$encuestaResultado['resultado_cabecera_id']
				);

				$respuestasAgrupador = $em->getRepository(
					'CampaniasBundle:ResultadoRespuesta'
				)->getRespuestasPorAgrupadorId(
					$aAgrupador['id'],
					$encuestaResultado['resultado_cabecera_id']
				);

				if ( isset( $multiple[0] ) && $multiple[0]['multiple'] ) {
					$contadorPreguntasAgrupador = 0;
					foreach ( $respuestasAgrupador as $respuestaAgrupador ) {

//                        TODO aca corregir en casode que no este bien exportar con codigos
						$textoRespuesta = $respuestaAgrupador['slug'] ? $respuestaAgrupador['slug'] : $respuestaAgrupador['texto_respuesta'];

						if ( $contadorPreguntasAgrupador < $cantidadPreguntasAgrupador['cantidad'] ) {
							//mientras sea el primer modulo de este agrupador puedo sacar als posiciones por id
							$ordenCorrecto          = $arrayOrden[ $respuestaAgrupador['pregunta_id'] ];
							$fila[ $ordenCorrecto ] = $textoRespuesta;
							$contadorPreguntasAgrupador ++;
							$ordenCorrectoMultiple = $ordenCorrecto;
							//guardo la ultima posicion de orden_correcto en orden_correcto_multiple para despues
							//sacar las posiciones sumando
						} else {
							//cuando ya no puedo sacar el orden por array_orden lo saco sumando posiciones
							$ordenCorrectoMultiple ++;
							$fila[ $ordenCorrectoMultiple ] = $textoRespuesta;
							$contadorPreguntasAgrupador ++;
						}
					}
					$faltante = ( $cantidadPreguntasAgrupador['cantidad'] * $aAgrupador['cantidad'] ) - $contadorPreguntasAgrupador;
					if ( $faltante > 0 ) {
						//cuando el hay lugar para mas modulos de este agrupador y la encuesta no tiene datos, los
						//completo con  ""
						for ( $m = 0; $m < $faltante; $m ++ ) {
							$ordenCorrectoMultiple ++;
							$fila[ $ordenCorrectoMultiple ] = "";
						}
					}
				} else {
					foreach ( $respuestasAgrupador as $respuestaAgrupador ) {
//                        TODO aca corregir en casode que no este bien exportar con codigos
						$textoRespuesta = $respuestaAgrupador['slug'] ? $respuestaAgrupador['slug'] : $respuestaAgrupador['texto_respuesta'];

						$ordenCorrecto = $arrayOrden[ $respuestaAgrupador['pregunta_id'] ];
						if ( $cantidadPreguntasEncuesta[0]['count'] == 52 && $respuestaAgrupador['pregunta_id'] == 34 ) {
							//si es la encuesta de 52 preguntas y es el id de pregunta 34, osea un id menos del id que falta, lo
							//relleno con blanco
							$fila[ $ordenCorrecto ] = $textoRespuesta;
							$ordenCorrecto ++;
							$fila[ $ordenCorrecto ] = "";
						} else {

							$fila[ $ordenCorrecto ] = $textoRespuesta;
						}
					}
				}
			}

			$fechaCreado = $em->getRepository( 'CampaniasBundle:ResultadoCabecera' )->findOneById(
				$encuestaResultado['resultado_cabecera_id']
			);

			/**
			 * completo los indices que no existen para exportar.
			 */
			$maximoCabecera = count( $cabecera );

			if ( count( $fila ) < $maximoCabecera ) {
				for ( $j = 0; $j < $maximoCabecera; $j ++ ) {
					if ( ! array_key_exists( $j, $fila ) ) {
						$fila[ $j ] = "";
					}
				}
			}
			$fila[ $maximoCabecera - 1 ] = $fechaCreado->getFecha()->format( 'd/m/Y' );

			$fila1   = ksort( $fila );
			$tabla[] = $fila;
		}

		return array(
			'cabecera' => $cabecera,
			'tabla'    => $tabla,
		);
	}

	public function crearResultadoRespuesta( $request, $idEncuesta ) {
		/* @var $em EntityManager */
		$em = $this->em;

		$encuesta = $em->getRepository( 'CampaniasBundle:Encuesta' )->find( $idEncuesta );

		/**
		 * armo las preguntas para saber despues cuales son las que faltan
		 */
		$aPreguntasEnEncuesta = array();

		foreach ( $encuesta->getAgrupador() as $agrupador ) {
			if ( $agrupador->getMultiple() ) {
				foreach ( $agrupador->getPreguntas() as $pregunta ) {
					$aPreguntasEnEncuesta[][ ucwords(
						preg_replace(
							'/[^A-Za-z0-9\-]/',
							'',
							str_replace( ' ', '', $agrupador->getNombre() )
						)
					) ][ $pregunta->getId() ] = '';
				}
			}
		}


		$resultadoCabecera = new ResultadoCabecera();


		$resultadoCabecera->setFecha( new \DateTime( 'now' ) );
		$resultadoCabecera->setInfoExterna( 2 );


		$respuestasRequest = $request->get( 'campanias_bundle_preguntas_parameter_type' );


		foreach ( $respuestasRequest as $key => $respuesta ) {

			/**
			 *  desaocio el array para saber cuantas preguntas me faltan competar
			 */
			unset( $aPreguntasEnEncuesta[ $key ] );

			if ( is_array( $respuesta ) ) {
				foreach ( $respuesta as $indexMult => $textoRespuesta ) {
					foreach ( $textoRespuesta as $keyPregunta => $aRespuesta ) {

						$this->buildRespuesta(
							$keyPregunta,
							$aRespuesta,
							$resultadoCabecera
						);

					}
				}

			} else {
				$this->buildRespuesta( $key, $respuesta, $resultadoCabecera );

			}

		}

		/**
		 * completo las preguntas con el mismo bucle de arriba
		 */
		foreach ( $aPreguntasEnEncuesta as $key => $respuesta ) {

			if ( is_array( $respuesta ) ) {
				foreach ( $respuesta as $indexMult => $textoRespuesta ) {
					foreach ( $textoRespuesta as $keyPregunta => $aRespuesta ) {

						$this->buildRespuesta(
							$keyPregunta,
							$aRespuesta,
							$resultadoCabecera
						);

					}
				}

			}
		}


		$em->flush();

		return true;
	}

	public function actualizarResultadoRespuesta( $request, $cabeceraId ) {

		$em = $this->em;

		$resultadoCabecera = $em->getRepository( 'CampaniasBundle:ResultadoCabecera' )->find( $cabeceraId );


		$agrupadores = $em->getRepository( "CampaniasBundle:AgrupadorPregunta" )->getOAgrupadoresPorResultadoCabeceraId(
			$cabeceraId
		);


		$idEncuesta = $agrupadores[0]->getEncuesta()->getId();


		$encuesta = $em->getRepository( 'CampaniasBundle:Encuesta' )->find( $idEncuesta );

		/**
		 * armo las preguntas para saber despues cuales son las que faltan
		 */
		$aPreguntasEnEncuesta = array();

		foreach ( $encuesta->getAgrupador() as $agrupador ) {
			if ( $agrupador->getMultiple() ) {
				foreach ( $agrupador->getPreguntas() as $pregunta ) {
					$aPreguntasEnEncuesta[][ ucwords(
						preg_replace(
							'/[^A-Za-z0-9\-]/',
							'',
							str_replace( ' ', '', $agrupador->getNombre() )
						)
					) ][ $pregunta->getId() ] = '';
				}
			}
		}


		$respuestasRequest = $request->get( 'campanias_bundle_preguntas_parameter_type' );

		/** armo las respuestas multiples*/
		$originalCollections = array();
		foreach ( $respuestasRequest as $key => $respuesta ) {
			$indice = explode( '_', $key );
			if ( array_key_exists( 1, $indice ) ) {
				$preguntaAgrupador                                              = $em->getRepository( 'CampaniasBundle:Preguntas' )->find( $indice[1] );
				$indexAgrup                                                     = ucwords( preg_replace(
					'/[^A-Za-z0-9\-]/',
					'',
					str_replace( ' ', '', $preguntaAgrupador->getAgrupadorPregunta()->getNombre() )
				) );
				$originalCollections[ $indexAgrup ][ $indice[0] ][ $indice[1] ] = $respuesta;
				unset( $respuestasRequest[ $indice[0] . '_' . $indice[1] ] );
			} else {
				if ( ! is_string( $indice[0] ) ) {
					$respuestasRequest[ $indice [0] ] = $respuesta;
				}
			}
		}
//		exit;
		foreach ( $respuestasRequest as $key => $respuesta ) {

			/**
			 *  desaocio el array para saber cuantas preguntas me faltan competar
			 */
			unset( $aPreguntasEnEncuesta[ $key ] );

			if ( is_array( $respuesta ) ) {
				foreach ( $respuesta as $indexMult => $textoRespuesta ) {
					foreach ( $textoRespuesta as $keyPregunta => $aRespuesta ) {

						$this->buildRespuesta(
							$keyPregunta,
							$aRespuesta,
							$resultadoCabecera
						);

					}
				}

			} else {
				$this->buildRespuestaEdit( $key, $respuesta, $resultadoCabecera );

			}

		}

		foreach ( $originalCollections as $originalCollection ) {
			foreach ( $originalCollection as $indexMult => $textoRespuesta ) {
				foreach ( $textoRespuesta as $keyPregunta => $aRespuesta ) {

					$this->buildRespuestaEdit(
						$keyPregunta,
						$aRespuesta,
						$resultadoCabecera,
						$indexMult

					);

				}
			}

		}


//		exit;

		$em->flush();

		return true;
	}

	private function buildRespuesta( $key, &$textoRespuesta, &$resultadoCabecera ) {
		/* @var $em EntityManager */
		$em                         = $this->em;
		$pregunta                   = $em->getRepository( 'CampaniasBundle:Preguntas' )->find( $key );
		$resultadoRespuesta         = new ResultadoRespuesta();
		$preguntaResultadoRespuesta = new PreguntaResultadoRespuesta();
		/**
		 * si tiene opcion busco la que viene seleccionada
		 */
		if ( ! is_array( $textoRespuesta ) ) {
			if ( count( $pregunta->getOpcionRespuesta() ) > 0 ) {

				$textoOpcion        = "";
				$opcionSeleccionada = null;
				if ( $textoRespuesta != "" ) {
					$opcionSeleccionada = $em->getRepository( 'CampaniasBundle:OpcionesRespuesta' )->findOneById(
						$textoRespuesta
					);
					$textoOpcion        = $opcionSeleccionada->getTextoOpcion();

				}
				$resultadoRespuesta->setTextoRespuesta(
					$textoOpcion
				);

				$resultadoRespuesta->setOpcionesRespuesta( $opcionSeleccionada );
			} else {
				$resultadoRespuesta->setTextoRespuesta( $textoRespuesta );
			}

			$resultadoRespuesta->addPreguntaResultadoRespuestum( $preguntaResultadoRespuesta );

			$resultadoRespuesta->setResultadoCabecera( $resultadoCabecera );
			$preguntaResultadoRespuesta->setPreguntas( $pregunta );
			$preguntaResultadoRespuesta->setResultadoRespuesta( $resultadoRespuesta );

		} else {
			foreach ( $textoRespuesta as $indiceAgrupador => $valorRespuesta ) {
				$this->buildRespuesta(
					$indiceAgrupador,
					$valorRespuesta,
					$preguntaResultadoRespuesta,
					$resultadoCabecera
				);
			}

		}

		$em->persist( $resultadoRespuesta );

		return array(
			'resultadoRespuesta'         => $resultadoRespuesta,
			'preguntaResultadoRespuesta' => $preguntaResultadoRespuesta,
			'resultadoCabecera'          => $resultadoCabecera,

		);
	}

	private function buildRespuestaEdit( $key, &$textoRespuesta, &$resultadoCabecera, $index = null ) {
		/* @var $em EntityManager */
		$em                         = $this->em;
		$pregunta                   = $em->getRepository( 'CampaniasBundle:Preguntas' )->find( $key );
		$preguntaResultadoRespuesta = $em->getRepository( 'CampaniasBundle:PreguntaResultadoRespuesta' )->getRespuesta( $pregunta,
			$resultadoCabecera );
		if ( ! $index ) {
			$index = 0;
		}
		$resultadoRespuesta = $preguntaResultadoRespuesta[ $index ]->getResultadoRespuesta();

		/**
		 * si tiene opcion busco la que viene seleccionada
		 */
		if ( ! is_array( $textoRespuesta ) ) {
			if ( count( $pregunta->getOpcionRespuesta() ) > 0 ) {

				$textoOpcion        = "";
				$opcionSeleccionada = null;
				if ( $textoRespuesta != "" ) {
					$opcionSeleccionada = $em->getRepository( 'CampaniasBundle:OpcionesRespuesta' )->findOneById(
						$textoRespuesta
					);
					$textoOpcion        = $opcionSeleccionada->getTextoOpcion();

				}

				$resultadoRespuesta->setTextoRespuesta(
					$textoOpcion
				);

				$resultadoRespuesta->setOpcionesRespuesta( $opcionSeleccionada );
			} else {
				$resultadoRespuesta->setTextoRespuesta( $textoRespuesta );
			}

		} else {
			foreach ( $textoRespuesta as $indiceAgrupador => $valorRespuesta ) {
				$this->buildRespuestaEdit(
					$indiceAgrupador,
					$valorRespuesta,
					$preguntaResultadoRespuesta,
					$resultadoCabecera
				);
			}

		}
		$em->persist( $resultadoRespuesta );

		return array(
			'resultadoRespuesta'         => $resultadoRespuesta,
			'preguntaResultadoRespuesta' => $preguntaResultadoRespuesta,
			'resultadoCabecera'          => $resultadoCabecera,

		);
	}
}
