<?php
	session_start();
	class ClsConex {
		function getConexion() {
			// $user = $_SESSION['auth_user'];
			// $pass = $_SESSION['pass'];
			$user =	623041;
			$pass = 623041;
			try {
                $conexion = new PDO("informix:host=192.168.73.30; service=1526; database=mdn; server=atila_tcp; protocol=onsoctcp; EnableScrollableCursors=1;", $user, $pass); //atila
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                echo json_encode([
					"error" => "ERROR DE CONEXION BD"
				]);
                exit;
            }
            // $conexion = new PDO("informix:host=srvlnx; service=1526; database=MDN; server=srvlnx_tcp; protocol=onsoctcp; EnableScrollableCursors=1;", $user, $pass);
            return $conexion;

		}

		function exec_query($sql){
			$conexion = $this->getConexion();
			$stm = $conexion->prepare($sql);
            $stm->execute();
            $resultado =  $stm->fetchAll(PDO::FETCH_ASSOC);
            $stm->closeCursor();
            return $resultado;
		}
		function exec_sql($sql){
			$conexion = $this->getConexion();
			$stm = $conexion->prepare($sql);
            $resultado = $stm->execute();
            $stm->closeCursor();
            return $resultado;
		}
		function guardar($sql){
			$conexion = $this->getConexion();
			$stm = $conexion->prepare($sql);
            $resultado = $stm->execute();
			$id = $conexion -> lastInsertId();
            $stm->closeCursor();
            return [
				"resultado" => $resultado,
				"id" => $id,
			];
		}
    }

	