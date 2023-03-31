<?php
require_once 'Model.php';
class CategoriasModel extends Model{

    public function get($id=''){
        if($id==''){
            $query="SELECT * FROM categoria";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM categoria WHERE ID_Categoria=:ID_Categoria";
            return $this->getQuery($query,['ID_Categoria'=>$id]);
        }
       
        
    }

    public function insertCategorias($categoria=array()){
        $query="INSERT INTO categoria VALUES (:ID_Categoria,:Categoria)";
        return $this->setQuery($query,$categoria);

    }

    public function updateCategorias($categoria=array()){
        $query="UPDATE categoria SET Categoria=:Categoria  WHERE ID_Categoria=:ID_Categoria";
        return $this->setQuery($query,$categoria);

    }

    public function removeCategorias($id){
        $query="DELETE FROM categoria WHERE ID_Categoria=:ID_Categoria";
        return $this->setQuery($query,['ID_Categoria'=>$id]);
    }
}