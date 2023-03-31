<?php
require_once 'Model.php';
class UsuariosModel extends Model{

    public function validateUser($correo,$pass){
        $query="SELECT ID_Usuario, Nombres,Estado,id_tipo_usuario FROM usuarios
        WHERE Correo=:Correo AND Pass=:Pass";
        return $this->getQuery($query,['Correo'=>$correo, 'Pass'=>$pass]);
    }

    public function get($id=''){
        if($id==''){
            $query="SELECT * FROM usuarios";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM usuarios WHERE ID_Usuario=:ID_Usuario";
            return $this->getQuery($query,['ID_Usuario'=>$id]);
        }      
    }

    public function insertUsuario($usuario=array()){
        $query="INSERT INTO usuarios VALUES (:ID_Usuario,:Nombres,:Apellidos,:Telefono,:Correo,:Pass,:Estado,:id_tipo_usuario)";
        return $this->setQuery($query,$usuario);
    }

    public function updateUsuario($usuario=array()){
        $query="UPDATE usuarios SET Nombres=:Nombres, Apellidos=:Apellidos, Telefono=:Telefono, Correo=:Correo, Pass=:Pass, Estado=:Estado, id_tipo_usuario=:id_tipo_usuario  WHERE ID_Usuario=:ID_Usuario";
        return $this->setQuery($query,$usuario);

    }

}