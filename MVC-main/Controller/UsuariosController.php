<?php
require_once 'Controller.php';
require_once './Model/UsuariosModel.php';
require_once './Model/TipoUsuariosModel.php';

class UsuariosController extends Controller{

    function __construct(){
        
        $this->model=new UsuariosModel();
       
    }

    public function index(){
        $viewBag=array();
        $usuarios=$this->model->get();
        $viewBag['usuarios']=$usuarios;
        $this->render("index.php",$viewBag);
    }

    public function create(){
        $viewBag=array();
        $tipousuarios = new TipoUsuariosModel();
        $viewBag['tipos']=$tipousuarios->get();
        //var_dump($viewBag);
        $this->render("new.php",$viewBag);
    }

    public function add(){
        if(isset($_POST['Guardar'])){

            extract($_POST);
            $errores=array();
            $usuario = array();
            $viewBag=array();

            $usuario['ID_Usuario'] = "";
            $usuario['Nombres'] = $Nombres;
            $usuario['Apellidos'] = $Apellidos;
            $usuario['Telefono'] = $Telefono;
            $usuario['Correo'] = $Correo;
            $usuario['Pass'] = $pass1;
            $usuario['Estado'] = $Estado;
            $usuario['id_tipo_usuario'] =$tipo;

            if(estaVacio($Nombres) || is_null($Nombres)){
                array_push($errores,"Debes ingresar su nombre.");

            }
            else if(!esTexto($Nombres)){
                array_push($errores,"Solo se permite Texto en el campo Nombre.");
            }
            
            if(estaVacio($Apellidos) || is_null($Apellidos)){
                array_push($errores,"Debes ingresar su apellido.");
            }
            else if(!esTexto($Apellidos)){
                array_push($errores,"Solo se permite Texto en el campo Apellido.");
            }

            if(estaVacio($Correo) || is_null($Correo)){
                array_push($errores,"Debes ingresar un correo.");
            }
            else if(!esMail($Correo)){
                array_push($errores,"formato del correo erroneo.");
            }

            if(estaVacio($Telefono) || is_null($Telefono)){
                array_push($errores,"Debes ingresar Un numero de telefono.");
            }
            else if(!esTelefono($Telefono)){
                array_push($errores,"El telefono debe cumplir con el formato..");
            }

            if((estaVacio($pass1) || is_null($pass1)) || (estaVacio($pass2) || is_null($pass2)) ){
                array_push($errores,"Debe ingresar su contraseña");
            }elseif($pass1 != $pass2){
                array_push($errores,"Las contraseñas con coinciden ");
            }

            if(estaVacio($Estado) || is_null($Estado)){
                array_push($errores,"El estado no debe estar vacio.");

            }

            if(count($errores) == 0){
                $this->model->insertUsuario($usuario);
                header('location:' .PATH. '/Usuarios/index');
            }
            else{
                $viewBag['errores']=$errores;
                $viewBag['usuario']=$usuario;
                $tipousuarios = new TipoUsuariosModel();
                $viewBag['tipos']=$tipousuarios->get();
                $this->render("new.php",$viewBag);
            }
        }
    }

    public function register(){
        $this->render("registro.php");
    }

    public function registerUser(){
        if(isset($_POST['Guardar'])){

            extract($_POST);
            $errores=array();
            $usuario = array();
            $viewBag=array();

            $usuario['ID_Usuario'] = "";
            $usuario['Nombres'] = $Nombres;
            $usuario['Apellidos'] = $Apellidos;
            $usuario['Telefono'] = $Telefono;
            $usuario['Correo'] = $Correo;
            $usuario['Pass'] = $pass1;
            $usuario['Estado'] = "Activo";
            $usuario['id_tipo_usuario'] = 3;

            if(estaVacio($Nombres) || is_null($Nombres)){
                array_push($errores,"Debes ingresar su nombre.");

            }
            else if(!esTexto($Nombres)){
                array_push($errores,"Solo se permite Texto en el campo Nombre.");
            }
            
            if(estaVacio($Apellidos) || is_null($Apellidos)){
                array_push($errores,"Debes ingresar su apellido.");
            }
            else if(!esTexto($Apellidos)){
                array_push($errores,"Solo se permite Texto en el campo Apellido.");
            }

            if(estaVacio($Correo) || is_null($Correo)){
                array_push($errores,"Debes ingresar un correo.");
            }
            else if(!esMail($Correo)){
                array_push($errores,"formato del correo erroneo.");
            }

            if(estaVacio($Telefono) || is_null($Telefono)){
                array_push($errores,"Debes ingresar Un numero de telefono.");
            }
            else if(!esTelefono($Telefono)){
                array_push($errores,"El telefono debe cumplir con el formato..");
            }

            if((estaVacio($pass1) || is_null($pass1)) || (estaVacio($pass2) || is_null($pass2)) ){
                array_push($errores,"Debe ingresar su contraseña");
            }elseif($pass1 != $pass2){
                array_push($errores,"Las contraseñas con coinciden ");
            }

            if(count($errores) == 0){
                $this->model->insertUsuario($usuario);
                header('location:' .PATH. '/Usuarios/login');
            }
            else{
                $viewBag['errores']=$errores;
                $viewBag['usuario']=$usuario;
                $this->render("registro.php",$viewBag);
            }
        }
    }

    public function edit($id){
        $viewBag=array();
        $tipousuarios = new TipoUsuariosModel();
        $viewBag['tipos']=$tipousuarios->get();
        $usuario=$this->model->get($id);
        $viewBag['usuario']=$usuario[0];
        $this->render("edit.php",$viewBag);
    }

    public function update($id){
        if(isset($_POST['Guardar'])){

            extract($_POST);
            $errores=array();
            $usuario = array();
            $viewBag=array();

            $usuario['ID_Usuario'] = $ID_Usuaio;
            $usuario['Nombres'] = $Nombres;
            $usuario['Apellidos'] = $Apellidos;
            $usuario['Telefono'] = $Telefono;
            $usuario['Correo'] = $Correo;
            $usuario['Pass'] = $pass1;
            $usuario['Estado'] = $Estado;
            $usuario['id_tipo_usuario'] =$tipo;

            if(estaVacio($Nombres) || is_null($Nombres)){
                array_push($errores,"Debes ingresar su nombre.");

            }
            else if(!esTexto($Nombres)){
                array_push($errores,"Solo se permite Texto en el campo Nombre.");
            }
            
            if(estaVacio($Apellidos) || is_null($Apellidos)){
                array_push($errores,"Debes ingresar su apellido.");
            }
            else if(!esTexto($Apellidos)){
                array_push($errores,"Solo se permite Texto en el campo Apellido.");
            }

            if(estaVacio($Correo) || is_null($Correo)){
                array_push($errores,"Debes ingresar un correo.");
            }
            else if(!esMail($Correo)){
                array_push($errores,"formato del correo erroneo.");
            }

            if(estaVacio($Telefono) || is_null($Telefono)){
                array_push($errores,"Debes ingresar Un numero de telefono.");
            }
            else if(!esTelefono($Telefono)){
                array_push($errores,"El telefono debe cumplir con el formato..");
            }

            if((estaVacio($pass1) || is_null($pass1)) || (estaVacio($pass2) || is_null($pass2)) ){
                array_push($errores,"Debe ingresar su contraseña");
            }elseif($pass1 != $pass2){
                array_push($errores,"Las contraseñas con coinciden ");
            }

            if(estaVacio($Estado) || is_null($Estado)){
                array_push($errores,"El estado no debe estar vacio.");

            }
            if(count($errores) == 0){
                $this->model->updateUsuario($usuario);
                header('location:' .PATH. '/Usuarios/index');
            }

            else{
                $viewBag['errores']=$errores;
                $viewBag['usuario']=$usuario;
                $tipousuarios = new TipoUsuariosModel();
                $viewBag['tipos']=$tipousuarios->get();
                $this->render("edit.php",$viewBag);
            }
        }
    }

    public function login(){
        $this->render("login.php");
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('location:'.PATH.'/Productos/index');

    }
    public function validate(){
        $model=new UsuariosModel();
        $correo=$_POST['Correo'];
        $pass=$_POST['pass1'];
        
        if(!empty($model->validateUser($correo,$pass))){
            $login_data=$model->validateUser($correo,$pass);
            $login_data=$login_data[0];
            $_SESSION['login_data']=$login_data;
            //var_dump($_SESSION['login_data'][0]['id_tipo_usuario']);
            if($_SESSION['login_data']['id_tipo_usuario'] == 3 && $_SESSION['login_data']['Estado'] == "Activo" ){
            header('location:'.PATH.'/Productos/index');
            }elseif($_SESSION['login_data']['id_tipo_usuario'] == 1 && $_SESSION['login_data']['Estado'] == "Activo" ){
                header('location:'.PATH.'/Productos/Admin');
            }elseif($_SESSION['login_data']['id_tipo_usuario'] == 2 && $_SESSION['login_data']['Estado'] == "Activo" ){
                header('location:'.PATH.'/Productos/Empleado');
            }else{
                $this->render("login.php");
            }
            
            
        }
        else{
            $this->render("login.php");
        }
    }
}