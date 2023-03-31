<?php
require_once 'Model.php';
class TipoUsuariosModel extends Model{

    public function get($id=''){
        if($id==''){
            $query="SELECT * FROM tipo_usuarios";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM tipo_usuarios WHERE ID_Tipo_Usuario=:ID_Tipo_Usuario";
            return $this->getQuery($query,['ID_Tipo_Usuario'=>$id]);
        }
       
        
    }

    /*public function insertCategorias($editorial=array()){
        $query="INSERT INTO categoria VALUES (:ID_Categoria,:Categoria)";
        return $this->setQuery($query,$editorial);

    }

    public function updateCategorias($editorial=array()){
        $query="UPDATE categoria SET Categoria=:Categoria  WHERE ID_Categoria=:ID_Categoria";
        return $this->setQuery($query,$editorial);

    }

    public function removeCategorias($id){
        $query="DELETE FROM categoria WHERE ID_Categoria=:ID_Categoria";
        return $this->setQuery($query,['ID_Categoria'=>$id]);
    }*/
}