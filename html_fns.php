<?php
   	include_once 'clases/ClsMenu.php ';
   	include_once 'clases/ClsTemas.php' ;


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