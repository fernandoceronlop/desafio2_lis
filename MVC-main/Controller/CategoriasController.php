<?php
require_once 'Controller.php';
require_once './Model/ProductosModel.php';
require_once './Model/CategoriasModel.php';
require_once './Core/validaciones.php';

class CategoriasController extends Controller{

    private $model;

    function __construct(){
        
        $this->model=new CategoriasModel();
       
    }

    public function index(){
        $viewBag=array();
        $Categoria=$this->model->get();
        $viewBag['categorias']=$Categoria;
        //var_dump($viewBag);
        $this->render("index.php",$viewBag);
    }

    
    public function details($id){
        echo json_encode($this->model->get($id)[0]); //crea un json por medio de un arreglo
    }

    public function create(){
        $this->render("new.php");
    }

    public function add(){
        if(isset($_POST['Guardar'])){
            extract($_POST);
            $errores=array();
            $categoria=array();
            $viewBag=array();
            $categoria['ID_Categoria'] = "";
            $categoria['Categoria']=$Categoria;
                   

            if(estaVacio($Categoria)||!isset($Categoria)){
                array_push($errores,'Debes ingresar la categoria');
            }
            

            if(count($errores)==0){
               
                $this->model->insertCategorias($categoria);
                header('location:'.PATH.'/Categorias/Index');

            }
            else{
                $viewBag['errores']=$errores;
                $viewBag['categorias']=$Categoria;
                $this->render("new.php",$viewBag);
            }


            
        }
    }

    public function edit($id){
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
    }

}