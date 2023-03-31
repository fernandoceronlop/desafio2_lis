<?php
include_once 'Model/ProductosModel.php';

$model = new ProductosModel();
$datos = ['ID_Producto'=>'PROD00001','Nombre'=>'Camisa lisa','Descripcion'=>'comodo y ajustable','Img'=>'PROD00001.jpg','id_categoria'=>0, 'Precio'=>2.50, 'Existencias'=>6];
$model->updateProductos($datos);
var_dump($model->get());
?>