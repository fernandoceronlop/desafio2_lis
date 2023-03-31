<?php
require_once 'Controller.php';
require_once './Model/ProductosModel.php';
require_once './Model/CategoriasModel.php';
require_once './Core/validaciones.php';

class ProductosController extends Controller{

    private $model;

    function __construct(){
        $this->model=new ProductosModel();  
    }

    public function Detalles(){
        $viewBag=array();
        $detalle=$this->model->Detalles();
        $viewBag['detalles']=$detalle;
        //var_dump($viewBag);
        $this->render("DetallesVentas.php",$viewBag);   
    }

    public function index(){
        $categoriaModel = new CategoriasModel();
        $viewBag=array();
        $productos=$this->model->get();
        $viewBag['productos']=$productos;
        $viewBag['categorias']=$categoriaModel->get();
        //var_dump($viewBag);
        $this->render("index.php",$viewBag);
    }

    public function Admin(){
        $categoriaModel = new CategoriasModel();
        $viewBag=array();
        $productos=$this->model->get();
        $viewBag['productos']=$productos;
        $viewBag['categorias']=$categoriaModel->get();
        //var_dump($viewBag);
        $this->render("VistaAdmin.php",$viewBag);
    }

    public function Empleado(){
        $categoriaModel = new CategoriasModel();
        $viewBag=array();
        $productos=$this->model->get();
        $viewBag['productos']=$productos;
        $viewBag['categorias']=$categoriaModel->get();
        //var_dump($viewBag);
        $this->render("VistaEmpleado.php",$viewBag);
    }

    public function details($id){
        echo json_encode($this->model->get($id)[0]); //crea un json por medio de un arreglo
    }

    public function create(){
        $viewBag=array();
        $categoriaModel = new CategoriasModel();
        $viewBag['categorias']=$categoriaModel->get();
        //var_dump($viewBag);
        $this->render("new.php",$viewBag);
    }

    public function VerCarrito(){
        if(is_null($_SESSION['Carrito'])){
            header('location:'.PATH.'/Productos/index');
        }else{
            $this->render("carrito.php");
        } 
    }

    public function VaciarCarrito(){
        unset($_SESSION['Carrito']);
        header('location:'.PATH.'/Productos/index');
    }

    public function Eliminar($id){
        unset($_SESSION['Carrito'][$id]);
        header('location:'.PATH.'/Productos/VerCarrito');
    }

    public function Carrito(){
        if(isset($_POST['Guardar'])){
            extract($_POST);

            $advertencias=array();

            $i = "";

            if(isset($_SESSION["Carrito"])){
                foreach($_SESSION["Carrito"] as $productos => $producto) {
                    if($productos == $ID_Producto){
                        $i = $ID_Producto;
                        break;
                    }
                }
            }

            if($i == $ID_Producto){
                $_SESSION["Carrito"][$ID_Producto]["Cantidad"] += $Cantidad;
                //array_push($advertencias,'Producto Actualizado.');
                //$productos=$this->model->get();
                //$viewBag['productos']=$productos;
                //$viewBag['errores']=$advertencias;
                //$this->render("index.php",$viewBag);
                header('location:'.PATH.'/Productos/index');
            }else {
                $_SESSION["Carrito"][$ID_Producto]["Nombre"] = $Nombre;
                $_SESSION["Carrito"][$ID_Producto]["Precio"] = $Precio;
                $_SESSION["Carrito"][$ID_Producto]["Cantidad"] = $Cantidad;
                /*array_push($advertencias,'Producto Ingresado.');
                $productos=$this->model->get();
                $viewBag['productos']=$productos;
                $viewBag['errores']=$advertencias;
                $this->render("index.php",$viewBag);*/
                header('location:'.PATH.'/Productos/index');
            }
            
        }   
    }

    public function add(){
        if(isset($_POST['Guardar'])){

            $archivo = $_FILES['Img']['name'];
            $tipo = $_FILES['Img']['type'];
            $tamano = $_FILES['Img']['size'];
            $temp = $_FILES['Img']['tmp_name'];

            extract($_POST);
            $errores=array();
            $producto=array();
            $viewBag=array();
            $producto['ID_Producto']=$ID_Producto;
            $producto['Nombre']=$Nombre;
            $producto['Descripcion']=$Descripcion;
            $producto['Img']=$archivo;
            $producto['id_categoria']=$Categoria;
            $producto['Precio']=$Precio;
            $producto['Existencias']=$Existencias;         

            if(estaVacio($ID_Producto)||!isset($ID_Producto)){
                array_push($errores,'Debes ingresar el codigo del Producto');
            }
            elseif(!esCodigoProducto($ID_Producto)){
                array_push($errores,'El codigo del producto debe tener el formato PROD#####');
            }

            if(estaVacio($Nombre)||!isset($Nombre)){
                array_push($errores,'Debes ingresar el nombre del Producto');
            }
            
            if(estaVacio($Categoria)||!isset($Categoria)){
                array_push($errores,'Debes ingresar la Categoria'); 
            }
            
            if(estaVacio($Descripcion)||!isset($Descripcion)){
                array_push($errores,'Debes ingresar Una Descripcion');
            }

            if(estaVacio($Precio)||!isset($Precio)){
                array_push($errores,'Debes ingresar el Precio');
            }

            if(estaVacio($Existencias)||!isset($Existencias)){
                array_push($errores,'Debes ingresar el numero de existencias');
            }

            if(estaVacio($archivo)||!isset($archivo)){
                array_push($errores,'Debes ingresar una imagen');
            }


            if (!((strpos($tipo, "jpg") || strpos($tipo, "png")) )) {
                array_push($errores,'Error. La extensión o el tamaño de los archivos no es correcta.');
            }else{
                if (move_uploaded_file($temp, './View/img/'.$producto['Img'])) {
                    chmod('./View/img/'.$producto['Img'].'', 0777);

                }else{
                    array_push($errores,'Ocurrió algún error al subir el fichero. No pudo guardarse.');
                }
            }
            
            if(count($errores)==0){
               
                $this->model->insertProductos($producto);
                header('location:'.PATH.'/Productos/Admin');

            }
            else{
                $categoriaModel = new CategoriasModel();
                $viewBag['errores']=$errores;
                $viewBag['productos']=$producto;
                $viewBag['categorias']=$categoriaModel->get();
                $this->render("new.php",$viewBag);
            }


            
        }
    }

    public function edit($id){
        $viewBag=array();
        $producto=$this->model->get($id);
        $categoriaModel = new CategoriasModel();
        $viewBag['categorias']=$categoriaModel->get();
        $viewBag['producto']=$producto[0];
        $this->render("edit.php",$viewBag);
    }

    public function update($id){
        if(isset($_POST['Guardar'])){

            $archivo = $_FILES['Img']['name'];
            
            extract($_POST);
            $errores=array();
            $producto=array();
            $viewBag=array();
            $producto['ID_Producto']=$ID_Producto;
            $producto['Nombre']=$Nombre;
            $producto['Descripcion']=$Descripcion;
            //$producto['Img']=$Img;
            $producto['id_categoria']=$Categoria;
            $producto['Precio']=$Precio;
            $producto['Existencias']=$Existencias;

            if(estaVacio($ID_Producto)||!isset($ID_Producto)){
                array_push($errores,'Debes ingresar el codigo del Producto');
            }
            elseif(!esCodigoProducto($ID_Producto)){
                array_push($errores,'El codigo del producto debe tener el formato PROD#####');
            }

            if(estaVacio($Nombre)||!isset($Nombre)){
                array_push($errores,'Debes ingresar el nombre del Producto');
            }
            
            if(estaVacio($Categoria)||!isset($Categoria)){
                array_push($errores,'Debes ingresar la Categoria'); 
            }
            
            if(estaVacio($Descripcion)||!isset($Descripcion)){
                array_push($errores,'Debes ingresar Una Descripcion');
            }

            if(estaVacio($Precio)||!isset($Precio)){
                array_push($errores,'Debes ingresar el Precio');
            }

            if(estaVacio($Existencias)||!isset($Existencias)){
                array_push($errores,'Debes ingresar el numero de existencias');
            }

            if(isset($archivo) && $archivo != ""){

                $tipo = $_FILES['Img']['type'];
                $tamano = $_FILES['Img']['size'];
                $temp = $_FILES['Img']['tmp_name'];

                if (!((strpos($tipo, "jpg") || strpos($tipo, "png")))) {
                    array_push($errores,'Error. La extensión o el tamaño de los archivos no es correcta.');
                }else{
                    if (move_uploaded_file($temp, './View/img/'.$archivo)) {
                        chmod('./View/img/'.$archivo.'', 0777);
                        $producto['Img']=$archivo;
    
                    }else{
                        array_push($errores,'Ocurrió algún error al subir el fichero. No pudo guardarse.');
                    }
                }
            }
            

            if(count($errores)==0){
                if(!isset($producto['Img']) || $$producto['Img'] ==""){
                    $this->model->updateProductos2($producto);
                    header('location:'.PATH.'/Productos/Admin');
                }else{
                    $this->model->updateProductos($producto);
                    header('location:'.PATH.'/Productos/Admin');
                }
                
            }
            else{
                $categoriaModel = new CategoriasModel();
                $viewBag['errores']=$errores;
                $viewBag['producto']=$producto;
                $viewBag['categorias']=$categoriaModel->get();
                $this->render("edit.php",$viewBag);
            }


            
        }
    }

    public function remove($id){
        $this->model->removeProductos($id);
        //var_dump($id);
        header('location:'.PATH.'/Productos/Admin');
    }

}