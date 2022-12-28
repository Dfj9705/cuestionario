<?php
   	include_once 'clases/ClsMenu.php';
   	include_once 'clases/ClsUser.php';
   	include_once 'clases/ClsTemas.php' ;
   	include_once 'clases/ClsSubtema.php';
   	include_once 'clases/ClsPreguntas.php';
   	include_once 'clases/ClsEvaluaciones.php';
   	include_once 'clases/ClsDetalle.php';
   	include_once 'clases/ClsRespuestas.php';


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
		
?>