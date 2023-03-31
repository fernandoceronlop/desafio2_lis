<?php
require_once 'Controller.php';
require_once './Model/ProductosModel.php';
require_once './Model/CategoriasModel.php';
require_once './Model/OrdenesModal.php';
require_once './Core/validaciones.php';

class OrdenesController extends Controller{

    private $model;

    function __construct(){
        
        $this->model=new OrdenesModel();
       
    }

    /*public function index(){
        $viewBag=array();
        $Categoria=$this->model->get();
        $viewBag['categorias']=$Categoria;
        //var_dump($viewBag);
        $this->render("index.php",$viewBag);
    }*/

    
    /*public function details($id){
        echo json_encode($this->model->get($id)[0]); //crea un json por medio de un arreglo
    }*/

    /*public function create(){
        $this->render("new.php");
    }*/

    public function add(){
        if(isset($_POST['Guardar'])){

            extract($_POST);
            $errores=array();
            $orden=array();
            $orden['ID_Orden'] = "";
            $orden['id_usuario']=$usuario;
            $orden['Total'] = $total;
            $orden['Fecha']= $fecha;
            $orden['Tarjeta']=$tarjeta;

           

            if(estaVacio($tarjeta)||!isset($tarjeta)){
                array_push($errores,'Debes ingresar la Tarjeta de Credito.');
            }
            elseif(!esTarjeta($tarjeta)){
                array_push($errores,'La tarjeta ingresada no es valida.');
            }

            if(count($errores)==0){
               
                $this->model->insertOrdenes($orden);
                $Ordenes=$this->model->get();
                $UltimaOrden = end($Ordenes);
                //var_dump($UltimaOrden['ID_Orden']);
                $ordendetalles=array();
                foreach($_SESSION["Carrito"] as $productos => $product){
                    $ordendetalles['ID_Detalles'] = "";
                    $ordendetalles['id_producto'] = $productos;
                    $ordendetalles['id_orden'] = $UltimaOrden['ID_Orden'];
                    $ordendetalles['Cantidad'] = $product["Cantidad"];
                    $this->model->insertOrdenesDetalles($ordendetalles);
                }
                header('location:'.PATH.'/Productos/index');
                unset($_SESSION['Carrito']);

            }
            else{
                
                header('location:'.PATH.'/Productos/VerCarrito');
            }


            
        }
    }

    /*public function edit($id){
        $viewBag=array();
        $categoria=$this->model->get($id);
        $viewBag['categoria']=$categoria[0];
        $this->render("edit.php",$viewBag);
    }

    public function update($id){
        if(isset($_POST['Guardar'])){
            extract($_POST);
            $errores=array();
            $categoria=array();
            $viewBag=array();
            $categoria['ID_Categoria'] = $ID_Categoria;
            $categoria['Categoria']= $Categoria;

            if(estaVacio($Categoria)||!isset($Categoria)){
                array_push($errores,'Debes ingresar la categoria');
            }

            if(count($errores)==0){
                $this->model->updateCategorias($categoria);
                header('location:'.PATH.'/Categorias/Index');

            }
            else{
                $categoria=$this->model->get($id);
                $viewBag['categoria']=$categoria[0];
                $viewBag['errores']=$errores;
                $this->render("edit.php",$viewBag);
            }


            
        }
    }
    
    public function remove($id){
        $this->model->removeCategorias($id);
        //var_dump($id);
        header('location:'.PATH.'/Categorias/Index');
    }*/

}