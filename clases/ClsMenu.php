<?php
    
    require_once('ClsConex.php');

    class ClsMenu extends ClsConex{

        function getUser($user){
            $sql = "SELECT * FROM mper, grados, armas, morg, mdep
            where  per_catalogo = $user
            and per_arma = arm_codigo 
            and per_plaza = org_plaza
            and org_dependencia = dep_llave 
            and per_grado = gra_codigo 
            and per_situacion in('11','TH', 'T0') ";
            

            $resultado = $this->exec_query($sql);
            return $resultado;
        }


    }
?>