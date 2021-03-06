<?php

namespace BigD\PersonasBundle\Controller;

use BigD\PersonasBundle\Entity\Persona;
use BigD\PersonasBundle\Entity\PersonaEtiqueta;
use BigD\PersonasBundle\Entity\Domicilio;
use BigD\PersonasBundle\Entity\Contacto;
use BigD\PersonasBundle\Form\PersonaFilterType;
use BigD\PersonasBundle\Form\PersonaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller {

	/**
	 * Lists all Persona entities.
	 *
	 */
	public function indexAction( Request $request ) {
		$em = $this->getDoctrine()->getManager();


		$form          = $this->createForm( new PersonaFilterType() );
		$form_etiqueta = $this->createForm( new \BigD\PersonasBundle\Form\EtiquetaType( true ) );

		if ( $request->isMethod( "post" ) ) {
			$form->handleRequest( $request );
			if ( $form->isValid() ) {
				$data     = $form->getData();
				$entities = $em->getRepository( 'PersonasBundle:Persona' )->getAcPersonas( $data );
			}
		} else {
			$entities = $em->getRepository( 'PersonasBundle:Persona' )->getAcPersonas();
		}


		$paginator = $this->get( 'knp_paginator' );
		$entities  = $paginator->paginate(
			$entities,
			$this->get( 'request' )->query->get( 'page', 1 )/* page number */,
			10/* limit per page */
		);

		return $this->render( 'PersonasBundle:Persona:index.html.twig',
			array(
				'entities'      => $entities,
				'form'          => $form->createView(),
				'form_etiqueta' => $form_etiqueta->createView(),
			) );
	}

	/*
	 * Listado de personas por etiquetas
	 */

	public function indexFiltroEtiquetasAction( Request $request ) {
		$em = $this->getDoctrine()->getManager();


		$form = $this->createForm( new \BigD\PersonasBundle\Form\PersonaEtiquetaFilterType() );

		$cantidadPorPagina = 10;

		$entities = $em->getRepository( 'PersonasBundle:Persona' )->getAcPersonasEtiquetas();

		if ( $request->isMethod( "post" ) ) {
			$form->handleRequest( $request );
			if ( $form->isValid() ) {
				$data     = $form->getData();
				$entities = $em->getRepository( 'PersonasBundle:Persona' )->getAcPersonasEtiquetas( $data );
			}
			if ( $request->get( 'cant-per-page' ) ) {
				$cantidadPorPagina = $request->get( 'cant-per-page' );
			}
		}


		$paginator = $this->get( 'knp_paginator' );
		$entities  = $paginator->paginate(
			$entities,
			$this->get( 'request' )->query->get( 'page', 1 )/* page number */,
			$cantidadPorPagina/* limit per page */
		);

		return $this->render( 'PersonasBundle:Persona:indexFiltroEtiquetas.html.twig',
			array(
				'entities' => $entities,
				'form'     => $form->createView(),
			) );
	}

	/**
	 * Creates a new Persona entity.
	 *
	 */
	public function createAction( Request $request ) {
		$entity             = new Persona();
		$etiquetasAgregadas = array();
		$form               = $this->createCreateForm( $entity );
		$form->handleRequest( $request );

		if ( $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $entity );

			$etiquetas = $entity->getEtiquetas();
			foreach ( $etiquetas as $personaEtiqueta ) {
				if ( ! in_array( $personaEtiqueta->getEtiqueta(), $etiquetasAgregadas ) ) {
					$personaEtiqueta->setPersona( $entity );
					$etiquetasAgregadas[] = $personaEtiqueta->getEtiqueta();
				}
			}


			$em->flush();
			$this->get( 'session' )->getFlashBag()->add(
				'success',
				'Persona Creada correctamente.'
			);

			return $this->redirect( $this->generateUrl( 'persona_show', array( 'id' => $entity->getId() ) ) );
		}

		return $this->render( 'PersonasBundle:Persona:new.html.twig',
			array(
				'entity' => $entity,
				'form'   => $form->createView(),
			) );
	}

	/**
	 * Creates a form to create a Persona entity.
	 *
	 * @param Persona $entity The entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createCreateForm( Persona $entity ) {
		$form = $this->createForm( new PersonaType(), $entity );

		return $form;
	}

	/**
	 * Displays a form to create a new Persona entity.
	 *
	 */
	public function newAction() {
		$entity = new Persona();
		$form   = $this->createCreateForm( $entity );

		return $this->render( 'PersonasBundle:Persona:new.html.twig',
			array(
				'entity' => $entity,
				'form'   => $form->createView(),
			) );
	}

	/**
	 * Finds and displays a Persona entity.
	 *
	 */
	public function showAction( $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'PersonasBundle:Persona' )->find( $id );
		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find Persona entity.' );
		}

		$iibb = $em->getRepository( 'PersonasBundle:Persona' )->getDatosIngresosBrutosPorPersonaId( $id );


		$parametro = array(
			"nombre"   => $entity->getNombre(),
			"apellido" => $entity->getApellido(),
		);
		foreach ( $entity->getDomicilio() as $domicilio ) {
			if ( $domicilio->getPrincipal() ) {
				$parametro['calle']     = $domicilio->getCalle();
				$parametro['numero']    = $domicilio->getNumero();
				$parametro['ciudad']    = $domicilio->getLocalidad()->getDescripcion();
				$parametro['provincia'] = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getDescripcion();
				$parametro['pais']      = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getPais()->getDescripcion();
			}
		}

		return $this->render( 'PersonasBundle:Persona:show.html.twig',
			array(
				'entity'    => $entity,
				'parametro' => $parametro,
				'iibb'      => $iibb
			) );
	}

	/**
	 * Displays a form to edit an existing Persona entity.
	 *
	 */
	public function editAction( $id ) {
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository( 'PersonasBundle:Persona' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find Persona entity.' );
		}

		$editForm = $this->createEditForm( $entity );


		return $this->render( 'PersonasBundle:Persona:edit.html.twig',
			array(
				'entity' => $entity,
				'form'   => $editForm->createView(),
			) );
	}

	/**
	 * Creates a form to edit a Persona entity.
	 *
	 * @param Persona $entity The entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createEditForm( Persona $entity ) {
		$form = $this->createForm( new PersonaType(), $entity );

		return $form;
	}

	/**
	 * Edits an existing Persona entity.
	 *
	 */
	public function updateAction( Request $request, $id ) {
		$em                 = $this->getDoctrine()->getManager();
		$etiquetasAgregadas = array();
		$entity             = $em->getRepository( 'PersonasBundle:Persona' )->find( $id );

		if ( ! $entity ) {
			throw $this->createNotFoundException( 'Unable to find Persona entity.' );
		}

		$originalEtiquetas = new ArrayCollection();

		// Create an ArrayCollection of the current Tag objects in the database
		foreach ( $entity->getEtiquetas() as $etiqueta ) {
			$originalEtiquetas->add( $etiqueta );
		}


		$editForm = $this->createEditForm( $entity );
		$editForm->handleRequest( $request );


		if ( $editForm->isValid() ) {

			foreach ( $originalEtiquetas as $etiqueta ) {
				if ( false === $entity->getEtiquetas()->contains( $etiqueta ) ) {
					$em->remove( $etiqueta );
				}
			}
			$etiquetas = $entity->getEtiquetas();


			foreach ( $etiquetas as $etiqueta ) {
				if ( ! in_array( $etiqueta->getEtiqueta(), $etiquetasAgregadas ) ) {
					$nuevo = true;
					foreach ( $originalEtiquetas as $etiquetaOriginal ) {
						if ( $etiqueta->getEtiqueta() == $etiquetaOriginal->getEtiqueta() ) {
							$nuevo = false;
						}
					}
					if ( $nuevo ) {
						$etiqueta->setPersona( $entity );
						$etiquetasAgregadas[] = $etiqueta->getEtiqueta();
					}
				}
			}


			$em->flush();
			$this->get( 'session' )->getFlashBag()->add(
				'success',
				'Persona Actualizada correctamente.'
			);

			return $this->redirect( $this->generateUrl( 'persona_edit', array( 'id' => $id ) ) );
		}

		return $this->render( 'PersonasBundle:Persona:edit.html.twig',
			array(
				'entity' => $entity,
				'form'   => $editForm->createView(),
			) );
	}

	/**
	 * Deletes a Persona entity.
	 *
	 */
	public function deleteAction( Request $request, $id ) {
		$form = $this->createDeleteForm( $id );
		$form->handleRequest( $request );

		if ( $form->isValid() ) {
			$em     = $this->getDoctrine()->getManager();
			$entity = $em->getRepository( 'PersonasBundle:Persona' )->find( $id );

			if ( ! $entity ) {
				throw $this->createNotFoundException( 'Unable to find Persona entity.' );
			}

			$em->remove( $entity );
			$em->flush();
		}

		return $this->redirect( $this->generateUrl( 'persona' ) );
	}

	/**
	 * Creates a form to delete a Persona entity by id.
	 *
	 * @param mixed $id The entity id
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm( $id ) {
		return $this->createFormBuilder()
		            ->setAction( $this->generateUrl( 'persona_delete', array( 'id' => $id ) ) )
		            ->setMethod( 'DELETE' )
		            ->add( 'submit', 'submit', array( 'label' => 'Delete' ) )
		            ->getForm();
	}

	public function showReporteDireccionesAction( Request $request ) {


		$idPersonas = $request->get( 'personas' );

		if ( ! $idPersonas ) {
			$idPersonas = array();
		}

		$em = $this->getDoctrine()->getManager();

		$json = array();

		foreach ( $idPersonas as $id ) {

			$entity = $em->getRepository( 'PersonasBundle:Persona' )->find( $id );

			if ( ! $entity ) {
				throw $this->createNotFoundException( 'Unable to find Persona entity.' );
			}
			$parametro = array(
				"nombre"   => $entity->getNombre(),
				"apellido" => $entity->getApellido(),
			);
			foreach ( $entity->getDomicilio() as $domicilio ) {
				if ( $domicilio->getPrincipal() ) {
					$parametro['calle']     = $domicilio->getCalle();
					$parametro['numero']    = $domicilio->getNumero();
					$parametro['ciudad']    = $domicilio->getLocalidad()->getDescripcion();
					$parametro['provincia'] = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getDescripcion();
					$parametro['pais']      = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getPais()->getDescripcion();
				} else if ( $domicilio ) {
					$parametro['calle']     = $domicilio->getCalle();
					$parametro['numero']    = $domicilio->getNumero();
					$parametro['ciudad']    = $domicilio->getLocalidad()->getDescripcion();
					$parametro['provincia'] = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getDescripcion();
					$parametro['pais']      = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getPais()->getDescripcion();
				}
			}
			$json[] = $parametro;
		}

		return $this->render( 'PersonasBundle:Persona:showReporteDirecciones.html.twig',
			array(
				'arrayPersonas' => json_encode( $json )
			) );
	}

	public function etiquetarPersonaListadoAction( Request $request ) {
		$em            = $this->getDoctrine()->getManager();
		$etiquetaNueva = $em->getRepository( 'PersonasBundle:etiqueta' )->find( $request->get( 'etiqueta' ) );
		$personas      = $request->get( 'personas' );
		if ( $personas ) {
			foreach ( $personas as $persona ) {
				$persona = $em->getRepository( 'PersonasBundle:persona' )->find( $persona );
				$nuevo   = true;
				foreach ( $persona->getEtiquetas() as $etiqueta ) {
					if ( $etiqueta->getEtiqueta() == $etiquetaNueva ) {
						$nuevo = false;
						break;
					}
				}
				if ( $nuevo ) {
					$personaEtiqueta = new PersonaEtiqueta();
					$personaEtiqueta->setPersona( $persona );
					$personaEtiqueta->setEtiqueta( $etiquetaNueva );
					$em->persist( $personaEtiqueta );
				}
			}
			$em->flush();

			return new JsonResponse( 'true' );
		}

		return new JsonResponse( 'false' );
	}

	public function etiquetarPersonasCsvAction( Request $request ) {

		$form = $this->createForm( new \BigD\PersonasBundle\Form\PersonaEtiquetarCsvType() );

		return $this->render( 'PersonasBundle:Persona:etiquetarPersonasCsv.html.twig',
			array(
				'form' => $form->createView(),
			) );
	}

	public function updateEtiquetasPersonasCsvAction( Request $request ) {
		$em = $this->getDoctrine()->getManager();

		ini_set( 'upload_max_filesize', '50M' );
		ini_set( "memory_limit", "2000M" );
		set_time_limit( 0 );

		$form = $this->createForm( new \BigD\PersonasBundle\Form\PersonaEtiquetarCsvType() );
		$form->handleRequest( $request );
		$data = $form->getData();

		$validMimeTypes = array(
			"text/csv",
			"application/vnd.ms-excel"
		);

		$archivo         = $data['archivo'];
		$path            = $archivo->getPathName();
		$etiquetasNuevas = $data['etiquetas'];

		if ( in_array( $archivo->getClientMimeType(), $validMimeTypes ) ) {

			if ( ( $fichero = fopen( "$path", "r" ) ) !== false ) {
				//proceso archivo
				while ( ( $datos = fgetcsv( $fichero, 1000, ";" ) ) !== false ) {
					$persona = null;
					if ( $datos[0] != '' ) {
						$persona = $em->getRepository( 'PersonasBundle:persona' )->findOneByNumeroDocumento( trim( $datos[0] ) );
					}
					if ( ! $persona && $datos[1] != '' ) {
						$persona = $em->getRepository( 'PersonasBundle:persona' )->findByCuitCuil( trim( $datos[1] ) );
					}
					if ( $persona ) {
						foreach ( $etiquetasNuevas as $etiquetaNueva ) {
							$nuevo = true;
							foreach ( $persona->getEtiquetas() as $etiqueta ) {
								if ( $etiqueta->getEtiqueta()->getId() == $etiquetaNueva['nombre']->getId() ) {
									$nuevo = false;
									break;
								}
							}
							if ( $nuevo ) {
								$personaEtiqueta = new PersonaEtiqueta();
								$personaEtiqueta->setPersona( $persona );
								$personaEtiqueta->setEtiqueta( $etiquetaNueva['nombre'] );
								$em->persist( $personaEtiqueta );
							}
						}
					}
				}
				$em->flush();
				$this->get( 'session' )->getFlashBag()->add(
					'success',
					'Proceso terminado correctamente.'
				);
			}
		} else {

			$this->get( 'session' )->getFlashBag()->add(
				'error',
				'Seleccione un archivo csv válido'
			);
		}


		return $this->redirect( $this->generateUrl( 'etiquetar_personas_csv' ) );
	}

	public function exportarPersonasEtiquetadasAction( Request $request ) {
		$em = $this->getDoctrine()->getManager();

		$form = $this->createForm( new \BigD\PersonasBundle\Form\PersonaEtiquetaFilterType() );
		$form->handleRequest( $request );
		if ( $form->isValid() ) {
			$data = $form->getData();
		}

		$filename = "listado_personas.xls";


		/* @var $exportExcel \BigD\UtilBundle\Services\ExcelTool */
		$exportExcel = $this->get( 'excel.tool' );
		$exportExcel->setTitle( 'Resultado Encuestas' );
		$exportExcel->setDescripcion( 'Listado de personas' );

		$personas = $em->getRepository( 'PersonasBundle:Persona' )->getAcPersonasEtiquetas( $data );


		$response = $exportExcel->buildSheetPersonasEtiquetadas( $personas );

		$response->headers->set( 'Content-Type', 'text/vnd.ms-excel; charset=utf-8' );
		$response->headers->set( 'Content-Disposition', 'attachment;filename=' . $filename . '' );
		$response->headers->set( 'Pragma', 'public' );
		$response->headers->set( 'Cache-Control', 'maxage=1' );

		return $response;
	}

	/*
	 * retorna el formulario para importar datos de personas desde csv
	 */

	public function importarPersonasCsvAction( Request $request ) {

		$form = $this->createForm( new \BigD\PersonasBundle\Form\PersonaImportarCsvType() );

		return $this->render( 'PersonasBundle:Persona:importarPersonasCsv.html.twig',
			array(
				'form' => $form->createView(),
			) );
	}

	/*
	 * recorre csv con datos de persona, si no existe la persona en BD la agrega
	 * agrega la direccion y los contactos que tenga el csv (cel, tel, mail)
	 * localidad se autosetea con POSADAS
	 */

	public function updatePersonasCsvAction( Request $request ) {

		ini_set( 'upload_max_filesize', '50M' );
		ini_set( "memory_limit", "2000M" );
		ini_set( "max_execution_time", 0 );
		set_time_limit( 0 );

		$em = $this->getDoctrine()->getManager();

		$tipoDocumento    = $em->getRepository( 'PersonasBundle:TipoDocumento' )->findOneByDescripcion( 'DNI' );
		$localidad        = $em->getRepository( 'UbicacionBundle:Localidad' )->findOneByDescripcion( 'POSADAS' );
		$tipoDomicilio    = $em->getRepository( 'PersonasBundle:TipoDomicilio' )->findOneByDescripcion( 'Principal' );
		$tipoContactoCel  = $em->getRepository( 'PersonasBundle:TipoContacto' )->findOneBySlug( 'celular' );
		$tipoContactoTel  = $em->getRepository( 'PersonasBundle:TipoContacto' )->findOneBySlug( 'telefono-fijo' );
		$tipoContactoMail = $em->getRepository( 'PersonasBundle:TipoContacto' )->findOneBySlug( 'mail' );


		$form = $this->createForm( new \BigD\PersonasBundle\Form\PersonaImportarCsvType() );
		$form->handleRequest( $request );
		$data        = $form->getData();
		$fuenteDatos = $data['fuenteDatos'];
		$etiqueta    = $data['etiqueta'];

		$validMimeTypes = array(
			"text/csv",
			"application/vnd.ms-excel"
		);

		$archivo = $data['archivo'];
		$path    = $archivo->getPathName();
//        $etiquetasNuevas = $data['etiquetas'];

		if ( in_array( $archivo->getClientMimeType(), $validMimeTypes ) ) {

			if ( ( $fichero = fopen( "$path", "r" ) ) !== false ) {
				//proceso archivo
				while ( ( $datos = fgetcsv( $fichero, 1000, ";" ) ) !== false ) {
					$j = 0;
					foreach ( $datos as $dato ) {
						$datos[ $j ] = trim( preg_replace( "(')", " ", $dato ) );
						$j ++;
					}
//                    $numero_documento = $datos[12];
					if ( is_numeric( $datos[12] ) ) {
						$persona = $em->getRepository( 'PersonasBundle:Persona' )->findOneByNumeroDocumento( $datos[12] );
						if ( $persona ) {
							//si existe
							$domicilioPrincipal = 'false';
							//pregunto si ya tiene registrada la etiqueta seleccionada
							$etiquetaOriginal = $em->getRepository( 'PersonasBundle:PersonaEtiqueta' )->findOneBy( array(
								'persona'  => $persona->getId(),
								'etiqueta' => $etiqueta->getId()
							) );
							if ( ! $etiquetaOriginal ) {
								//agrego la etiqueta
								$personaEtiqueta = new PersonaEtiqueta();
								$personaEtiqueta->setPersona( $persona );
								$personaEtiqueta->setEtiqueta( $etiqueta );
								$em->persist( $personaEtiqueta );
							}
						} else {
							$domicilioPrincipal = 'true';
							$persona            = new Persona();
							$persona->setTipoDocumento( $tipoDocumento );
							$persona->setNombre( $datos[1] );
							$persona->setApellido( $datos[13] );
							$persona->setNumeroDocumento( $datos[12] );
							$persona->setFuenteDatos( $fuenteDatos );
							if ( strlen( $datos[14] ) > 8 ) {
								$persona->setCuitCuil( $datos[14] );
							}
							$fechaNacimiento = $em->getRepository( 'PersonasBundle:Persona' )->getFechaComoDB( $datos[17] );
							if ( $fechaNacimiento ) {// \DateTime::createFromFormat("d/m/Y H:i","25/04/2015 15:00");
								$fechaNacimiento = \DateTime::createFromFormat( 'Y-m-d H:i:s',
									$fechaNacimiento . " 00:00:00" );
								$persona->setFechaNacimiento( $fechaNacimiento );
							}
							if ( $datos[16] == 'Masculino' ) {
								$persona->setSexo( 'M' );
							} else if ( $datos[16] == 'Femenino' ) {
								$persona->setSexo( 'F' );
							}
							$em->persist( $persona );

							//agrego la etiqueta a la nueva persona
							$personaEtiqueta = new PersonaEtiqueta();
							$personaEtiqueta->setPersona( $persona );
							$personaEtiqueta->setEtiqueta( $etiqueta );
							$em->persist( $personaEtiqueta );
						}

						//inserto el domicilio
						$domicilio = new Domicilio();
						$domicilio->setCalle( $datos[5] );
						$domicilio->setNumero( $datos[19] );
						if ( $datos[20] != '' ) {
							$domicilio->setPiso( $datos[20] );
						}
						$domicilio->setLocalidad( $localidad );
						$domicilio->setTipoDomicilio( $tipoDomicilio );
						$domicilio->setPrincipal( $domicilioPrincipal );
						$domicilio->setValidado( 'false' );
						$domicilio->setFuenteDatos( $fuenteDatos );
						$domicilio->setPersona( $persona );
						$domicilio->setPartida( $datos[22] );
						$em->persist( $domicilio );

						//pregunto si tiene cel e inserto
						if ( $datos[6] != '' ) {
							$contacto = new Contacto();
							$contacto->setFuenteDatos( $fuenteDatos );
							$contacto->setTipoContacto( $tipoContactoCel );
							$contacto->setPersona( $persona );
							$contacto->setValor( $datos[6] );
							$contacto->setPrincipal( 'false' );
							$contacto->setValidado( 'false' );
							$em->persist( $contacto );
						}
						//pregunto si tiene tel fijo
						if ( $datos[15] != '' ) {
							$contacto = new Contacto();
							$contacto->setFuenteDatos( $fuenteDatos );
							$contacto->setTipoContacto( $tipoContactoTel );
							$contacto->setPersona( $persona );
							$contacto->setValor( $datos[15] );
							$contacto->setPrincipal( 'false' );
							$contacto->setValidado( 'false' );
							$em->persist( $contacto );
						}

						//pregunto si tiene mail
						if ( $datos[7] != '' ) {
							$contacto = new Contacto();
							$contacto->setFuenteDatos( $fuenteDatos );
							$contacto->setTipoContacto( $tipoContactoMail );
							$contacto->setPersona( $persona );
							$contacto->setValor( $datos[7] );
							$contacto->setPrincipal( 'false' );
							$contacto->setValidado( 'false' );
							$em->persist( $contacto );
						}
					}
					//fin while
				}
				$em->flush();
				$this->get( 'session' )->getFlashBag()->add(
					'success',
					'Proceso terminado correctamente.'
				);
			} else {
				$this->get( 'session' )->getFlashBag()->add(
					'error',
					'Error en lectura de archivo csv'
				);
			}
		} else {
			$this->get( 'session' )->getFlashBag()->add(
				'error',
				'Seleccione un archivo csv válido'
			);
		}

		return $this->redirect( $this->generateUrl( 'importar_personas_csv' ) );
	}

}
