<?php

	namespace app\controllers;
	use app\models\mainModel;

	class searchController extends mainModel{

		/*----------  Controlador modulos de busquedas  ----------*/
		public function modulosBusquedaControlador($modulo){

			$listaModulos=['userSearch','cashierSearch','clientSearch','categorySearch','productSearch','saleSearch'];

			if(in_array($modulo, $listaModulos)){
				return false;
			}else{
				return true;
			}
		}


		/*----------  Controlador iniciar busqueda  ----------*/
		public function iniciarBuscadorControlador(){

		    $url=$this->limpiarCadena($_POST['modulo_url']);
			/* $texto=$this->limpiarCadena($_POST['txt_buscador']); */
			$fechaDesde=$this->limpiarCadena($_POST['fechaDesde']);
			$fechaHasta=$this->limpiarCadena($_POST['fechaHasta']);

			if($this->modulosBusquedaControlador($url)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos procesar la petición en este momento",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}

			if($fechaDesde==""||$fechaHasta==""){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Introduce un termino de busqueda",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}
/* 
			if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\- ]{1,30}",$texto)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El termino de busqueda no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			} */

			$_SESSION["fechaDesde"]=$fechaDesde;
			$_SESSION["fechaHasta"]=$fechaHasta;

			$alerta=[
				"tipo"=>"redireccionar",
				"url"=>APP_URL.$url."/"
			];

			return json_encode($alerta);
		}


		/*----------  Controlador eliminar busqueda  ----------*/
		public function eliminarBuscadorControlador(){

			$url=$this->limpiarCadena($_POST['modulo_url']);

			if($this->modulosBusquedaControlador($url)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos procesar la petición en este momento",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}

			unset($_SESSION["fechaDesde"]);
			unset($_SESSION["fechaHasta"]);

			$alerta=[
				"tipo"=>"redireccionar",
				"url"=>APP_URL.$url."/"
			];

			return json_encode($alerta);
		}

	}