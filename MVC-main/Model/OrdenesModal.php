<?php
require_once 'Model.php';
class OrdenesModel extends Model{

    public function get($id=''){
        if($id==''){
            $query="SELECT * FROM ordenes";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM ordenes WHERE ID_Orden=:ID_Orden";
            return $this->getQuery($query,['ID_Orden'=>$id]);
        }
       
        
    }

    public function insertOrdenes($orden=array()){
        $query="INSERT INTO ordenes VALUES (:ID_Orden,:id_usuario,:Total,:Fecha,:Tarjeta)";
        return $this->setQuery($query,$orden);

    }

    public function insertOrdenesDetalles($orden=array()){
        $query="INSERT INTO ordenes_detalles VALUES (:ID_Detalles,:id_producto,:id_orden,:Cantidad)";
        return $this->setQuery($query,$orden);

    }
  
}