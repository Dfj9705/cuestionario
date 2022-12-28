<?php
   	include_once 'clases/ClsMenu.php';
   	include_once 'clases/ClsUser.php';
   	include_once 'clases/ClsTemas.php' ;
   	include_once 'clases/ClsSubtema.php';
   	include_once 'clases/ClsPreguntas.php';
   	include_once 'clases/ClsEvaluaciones.php';
   	include_once 'clases/ClsDetalle.php';
   	include_once 'clases/ClsEstadisticas.php';


	function formatearGrado ($grado, $codigogrado , $arma, $codigoarma){
        $gradoArma = $grado;


    
        if($codigoarma != 6){
            if($codigogrado != 93 && $codigogrado != 97 && $codigogrado != 92 && $codigogrado != 96){
                $gradoArma .= " DE " . $arma; 
    
            }
        }
        // OFICIALES SUPERIORES 
        $gradoOficialesSuperiores = [80,82,89,85,88,77,79,81];
    
        if(array_search($codigogrado, $gradoOficialesSuperiores)){
            switch ($codigoarma) {
                case '6':
                    $gradoArma .= " D.E.M.N."; 
                    break;
                case '7':
                    $gradoArma .= " D.E.M.A."; 
    
                    break;
                    
                default:
                    $gradoArma .= " D.E.M."; 
                 
                    break;
            }
        } 

        return $gradoArma;
    }
		

    function validarIngresoApi($tipo = 1){

        if($tipo == 1){
            if(!$_SESSION['auth']){
                echo json_encode([
                    "error" => "NO ESTA AUTENTICADO"
                ]);
                exit;
            }

        }else if($tipo == 2){
            if(!$_SESSION['auth'] || $_SESSION['rol'] != 2){
                echo json_encode([
                    "error" => "NO ESTA AUTORIZADO"
                ]);
                exit;
            }
        }

    }
    function validarIngreso($tipo = 1){

        if($tipo == 1){
            if(!$_SESSION['auth']){
                header('location: ../cp_menu/menu.php');
            }

        }else if($tipo == 2){
            if(!$_SESSION['auth'] || $_SESSION['rol'] != 2){
                header('location: ../cp_menu/menu.php');
            }
        }

    }
?>