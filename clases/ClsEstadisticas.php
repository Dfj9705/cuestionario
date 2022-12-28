<?php
require_once 'ClsConex.php';

class ClsEstadisticas extends ClsConex{

    public $inicio;
    public $fin;

    public function __construct($args = [])
    {   
        $this->inicio = $args['inicio'] ?: '';
        $this->fin = $args['fin'] ?: '';
    }

    public function getUsuariosRegistrados(){
        $sql = "SELECT count(*) as cantidad from ciber_usuarios where usu_situacion = 1 ";
        if($this->inicio != ''){
            $sql.= " and usu_registro  >= '$this->inicio'";
        }

        if($this->fin != ''){
            $sql.= " and usu_registro <= '$this->fin' ";
        }
        
        $resultado = $this->exec_query($sql);
        return  array_shift($resultado)['CANTIDAD'];
    }

    public function getEvaluacionesIniciadas(){
        $sql = "SELECT count(*) as cantidad from ciber_evaluaciones where evaluacion_situacion = 1";
        if($this->inicio != ''){
            $sql.= " and evaluacion_fecha >= '$this->inicio'  ";
        }

        if($this->fin != ''){
            $sql.= " and evaluacion_fecha <= '$this->fin' ";
        }
        
        $resultado = $this->exec_query($sql);
        return  array_shift($resultado)['CANTIDAD'];
    }

    public function getEvaluacionesFinalizadas(){
        $sql = "SELECT count(*) as cantidad from ciber_evaluaciones where evaluacion_situacion = 1 and evaluacion_modulo > 4";
        if($this->inicio != ''){
            $sql.= " and evaluacion_fecha >= '$this->inicio'  ";
        }

        if($this->fin != ''){
            $sql.= " and evaluacion_fecha <= '$this->fin' ";
        }
        
        $resultado = $this->exec_query($sql);
        return  array_shift($resultado)['CANTIDAD'];
    }

    public function getCertificaciones(){
        $sql = "SELECT count(*) as cantidad from ciber_usuarios where usu_diploma is not null";
        if($this->inicio != ''){
            $sql.= " and usu_fecha_diploma >= '$this->inicio'  ";
        }

        if($this->fin != ''){
            $sql.= " and usu_fecha_diploma <= '$this->fin' ";
        }
        
        $resultado = $this->exec_query($sql);
        return  array_shift($resultado)['CANTIDAD'];
    }

    public function getComandos(){
        $sql = "SELECT distinct trim( dep_desc_ct ) as comando ,
        (
            select count(*) from ciber_usuarios inner join mper on usu_catalogo = per_catalogo inner join morg on per_plaza = org_plaza where org_dependencia = dep_llave and usu_situacion = 1 ";
            if($this->inicio != ''){
                $sql.= " and usu_registro  >= '$this->inicio'";
            }
    
            if($this->fin != ''){
                $sql.= " and usu_registro <= '$this->fin' ";
            }

        $sql .= "
        ) as activos,
        (
            SELECT count(*) from ciber_usuarios inner join mper on usu_catalogo = per_catalogo inner join morg on per_plaza = org_plaza inner join ciber_evaluaciones on usu_id = evaluacion_usuario where org_dependencia = dep_llave and usu_situacion = 1 and evaluacion_modulo = 5 ";
        
        if($this->inicio != ''){
            $sql.= " and evaluacion_fecha >= '$this->inicio'  ";
        }

        if($this->fin != ''){
            $sql.= " and evaluacion_fecha <= '$this->fin' ";
        }
        
        $sql .= " ) as evaluados,
        (
            select count(*) from ciber_usuarios inner join mper on usu_catalogo = per_catalogo inner join morg on per_plaza = org_plaza inner join ciber_evaluaciones on usu_id = evaluacion_usuario where org_dependencia = dep_llave and usu_situacion = 1 and evaluacion_modulo = 5 and usu_diploma is not null ";
        
        if($this->inicio != ''){
            $sql.= " and usu_fecha_diploma >= '$this->inicio'  ";
        }

        if($this->fin != ''){
            $sql.= " and usu_fecha_diploma <= '$this->fin' ";
        }
        $sql .= " ) as certificados,
        (
            select count(*) from ciber_usuarios inner join mper on usu_catalogo = per_catalogo inner join morg on per_plaza = org_plaza inner join ciber_evaluaciones on usu_id = evaluacion_usuario where org_dependencia = dep_llave and usu_situacion = 1 and evaluacion_situacion = 1 ";
        if($this->inicio != ''){
            $sql.= " and evaluacion_fecha >= '$this->inicio'  ";
        }

        if($this->fin != ''){
            $sql.= " and evaluacion_fecha <= '$this->fin' ";
        }
        $sql .= ") as iniciados
        from mdep inner join morg on org_dependencia = dep_llave 
        where org_situacion = 'A'";
        
        $resultado = $this->exec_query($sql);
        return  $resultado;
    }

}