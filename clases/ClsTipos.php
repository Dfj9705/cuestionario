<?php

    require_once 'ClsConex.php';

    class ClsTipos extends ClsConex{

        public $id;
        public $nombre;
        public $direccion;

        public function __construct($args = [])
        {   
            $this->id = $args['id'] ?: null;
            $this->nombre = $args['nombre'] ?: '';
            $this->direccion = $args['direccion'] ?: '';
        }

        public function getDirecciones(){
            $sql = "SELECT org_jerarquia[1,2] as jerarquia, trim(org_plaza_desc) as descripcion from morg inner join meom on org_ceom = meom_ceom  where org_dependencia = 2160 and org_situacion = 'A' and org_jerarquia like '%00000000' order by org_jerarquia";
            $resultado = $this->exec_query($sql);
            return $resultado;
        }

        public function getTipos(){
            $sql = "SELECT sol_desc as nombre, sol_id as id, trim(org_plaza_desc) as direccion, sol_direccion as codigo_direccion from solemdn_tipos inner join morg on sol_direccion= org_jerarquia[1,2] where org_dependencia = 2160 and org_situacion = 'A' and org_jerarquia like '%00000000' and sol_situacion = 1";
            $resultado = $this->exec_query($sql);
            return $resultado;
        }

        public function guardarTipo(){
            $sql = "INSERT INTO solemdn_tipos (sol_desc, sol_direccion) values ('$this->nombre', '$this->direccion')";
            $resultado = $this->exec_sql($sql);
            return $resultado;
        }

        public function modificarTipo(){
            $sql = "UPDATE solemdn_tipos set 
                    sol_desc = '$this->nombre',    
                    sol_direccion = '$this->direccion'
                    where sol_id = $this->id;
                    ";

            $resultado = $this->exec_sql($sql);
            return $resultado;
        }
        
        public function eliminar() {
            $sql = "UPDATE solemdn_tipos set 
                    sol_situacion = 0    
                    where sol_id = $this->id;
                    ";

            $resultado = $this->exec_sql($sql);
            return $resultado;
        }
    }