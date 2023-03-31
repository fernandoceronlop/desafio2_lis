<?php
require_once 'Model.php';
class ProductosModel extends Model{

    public function get($id=''){
        if($id==''){
            $query="SELECT * FROM productos";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM productos WHERE ID_Producto=:ID_Producto";
            return $this->getQuery($query,['ID_Producto'=>$id]);
        }
       
        
    }

    public function Detalles($id=''){
        if($id==''){
            $query="SELECT O.ID_Orden, (U.Nombres) AS Usuario, U.Correo, O.Total, O.Fecha, O.Tarjeta, SUM(OD.Cantidad)  AS Cantidad_Producto FROM ordenes O INNER JOIN ordenes_detalles OD ON O.ID_Orden = OD.id_orden
            INNER JOIN usuarios U ON O.id_usuario = U.ID_Usuario
            GROUP BY O.ID_Orden, U.Nombres,  U.Correo, O.Total, O.Fecha, O.Tarjeta";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM productos WHERE ID_Producto=:ID_Producto";
            return $this->getQuery($query,['ID_Producto'=>$id]);
        }
       
        
    }

    public function insertProductos($producto=array()){
        $query="INSERT INTO productos VALUES (:ID_Producto,:Nombre,:Descripcion,:Img, :id_categoria, :Precio, :Existencias)";
        return $this->setQuery($query,$producto);

    }

    public function updateProductos($producto=array()){
        $query="UPDATE productos SET Nombre=:Nombre, Descripcion=:Descripcion, Img=:Img ,id_categoria=:id_categoria, Precio=:Precio, Existencias=:Existencias WHERE ID_Producto=:ID_Producto";
        return $this->setQuery($query,$producto);

    }

    public function updateProductos2($producto=array()){
        $query="UPDATE productos SET Nombre=:Nombre, Descripcion=:Descripcion, id_categoria=:id_categoria, Precio=:Precio, Existencias=:Existencias WHERE ID_Producto=:ID_Producto";
        return $this->setQuery($query,$producto);

    }

    public function removeProductos($id){
        $query="DELETE FROM productos WHERE ID_Producto=:ID_Producto";
        return $this->setQuery($query,['ID_Producto'=>$id]);
    }
}