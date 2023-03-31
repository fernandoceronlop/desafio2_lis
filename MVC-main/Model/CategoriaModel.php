<?php
require_once 'Model.php';
class CategoriaModel extends Model{

    public function get($id=''){
        if($id==''){
            $query="SELECT * FROM categoria";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM productos WHERE ID_Categoria=:ID_Categoria";
            return $this->getQuery($query,['ID_Categoria'=>$id]);
        }
       
        
    }

    public function insertProductos($editorial=array()){
        $query="INSERT INTO categoria VALUES (:ID_Categoria,:Categoria)";
        return $this->setQuery($query,$editorial);

    }

    public function updateProductos($editorial=array()){
        $query="UPDATE categoria SET Categoria=:Categoria  WHERE ID_Categoria=:ID_Categoria";
        return $this->setQuery($query,$editorial);

    }

    public function removeProductos($id){
        $query="DELETE FROM categoria WHERE ID_Categoria=:ID_Categoria";
        return $this->setQuery($query,['ID_Categoria'=>$id]);
    }
}