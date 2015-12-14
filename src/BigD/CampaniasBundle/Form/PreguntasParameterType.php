<?php

namespace BigD\CampaniasBundle\Form;

use BigD\CampaniasBundle\Form\Model\PreguntasParameter;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntasParameterType extends AbstractType {

	private $options;

	public function __construct( array $options = null ) {
		$this->options = $options;
	}


	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$data    = null;
		$subData = null;
		if ( $this->options ) {
			$data = $this->options;
		} else {
			if ( count( $options["data"]->getSubPreguntas() ) > 0 ) {
				$data    = $options["data"]->get();
				$subData = $options["data"]->getSubPreguntas();
			} else {
				$data = $options["data"]->get();
//				$subData = null;
			}


		}

//		$multiple = false;
//		$normal   = true;
//
//		if ( count( $data ) == 1 ) {
//			if ( is_integer( key( $data ) ) ) {
//				$multiple = false;
//				$normal   = true;
//			} else {
//				$multiple = false;
//				$normal   = true;
//			}
//		}

		$arrayOptions = array();
		if ( $data ) {

			foreach ( $data as $k => $value ) {
				$arrayOptions = array(
					"label"    => $value["label"],
					"required" => $value["required"],
				);
				if ( $value["widgetType"] == 'choice' ) {

					$aChoices = array();
					foreach ( $value['choices'] as $key => $choice ) {
						$aChoices[ $key ] = $choice;
					}
					$arrayOptions['choices'] = $aChoices;

				}
				if ( $value["widgetType"] == 'date' ) {
					$arrayOptions['input']  = 'string';
					$arrayOptions['widget'] = 'single_text';
					$arrayOptions['format'] = 'dd-MM-yyyy';
					$arrayOptions['attr']   = array( 'class' => 'datepicker', 'data-date-format' => 'dd-mm-yyy' );
				}

				if ( $value['value'] ) {
					if ( $value['widgetType'] == 'date' ) {

//                        $arrayOptions['data'] = $value['value'];
						$date = \DateTime::createFromFormat( 'd-m-Y', $value['value'] );

						$arrayOptions['data'] = $date;
						unset( $arrayOptions['input'] );
					} else if ( $value["widgetType"] == 'choice' ) {
						$arrayOptions['data'] = $value['value'];
					} else {
						$arrayOptions['data'] = $value['value'];
					}

				}

				$builder->add( $k, $value["widgetType"], $arrayOptions );

			}

		}
		if ( $subData ) {

			$subPreguntas = $subData;
			if ( $subPreguntas ) {
				$collectionName = "";

				foreach ( $subPreguntas as $i => $k ) {

					$collectionName = $i;
					foreach ( $k as $index => $subPregunta ) {
						$aSubPregunta[ key( $subPregunta ) ] = $subPregunta[ key( $subPregunta ) ];
					}

				}
				$arrayOptions = array(
					"label"    => 'Items',
					"required" => true,
				);

				$arrayOptions['allow_add']    = true;
				$arrayOptions['allow_delete'] = true;
				$arrayOptions['by_reference'] = true;
				$arrayOptions['type']         = new PreguntasParameterType( $aSubPregunta );
				$arrayOptions['mapped']       = false;
				$arrayOptions['count_start']  = $options['data']->getCantidadCollection();
				$builder->add( $collectionName, 'verticalcollection', $arrayOptions );
			}
		}
	}


	public
	function setDefaultOptions(
		OptionsResolverInterface $resolver
	) {
		$resolver->setDefaults(
			array(
				'data_class'      => 'BigD\CampaniasBundle\Form\Model\PreguntasParameter',
				'csrf_protection' => false,
			)
		);
	}

	public
	function getName() {
		return 'campanias_bundle_preguntas_parameter_type';
	}
}