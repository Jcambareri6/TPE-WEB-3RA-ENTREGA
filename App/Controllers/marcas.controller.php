<?php
require_once './App/models/Marcas.Model.php';
require_once './App/views/api.view.php';
require_once './App/helpers/auth.api.helper.php';

class marcasController{
    private $model;
    private $view;
    private $data;
    private $authHelper;

    public function __construct() {
        $this->model = new MarcasModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getOrder(){
        $sort = $this->getSort();
        if (!empty ($_GET['order'])){
            $order=$_GET['order'];
            $order = filter_var($_GET['order']);
            if ($this->model->hasColumn($order)){
                return 'ORDER BY '.$order.' '.$sort;
            }

        }
        return 'ORDER BY Nombre '.$sort;
    }

    public function getSort(){
        if (!empty($_GET['sort'])){
            $sort = $_GET['sort'];
            return $sort;
        }
        return 'ASC';

    }

    public function getMarcas(){
        $user = $this -> authHelper->currentUser();
        if (!$user){
            $this->view->response("Unauthorized", 401);
        }else{
            $parametrosGet['order']=$this->getOrder();
            $parametrosGet['page'] = $this->getLimit();
            $marcas = $this->model->getAllMarcas($parametrosGet);
            if ($marcas){
                $this->view->response($marcas);
            }else{
                $this->view->response("No existe", 404);
            }
        }


    }

    public function getLimit(){
        if (!empty($_GET['limit'])){
            $limit = $_GET['limit'];
            $page = $this->getPage();
            if (is_numeric($limit) && $limit >= 1){
                return ' LIMIT ' . $limit . $page;
            }
        }
        return " ";
    }

    public function getPage(){
        if (!empty($_GET['page'])){
            $page = $_GET['page'];
            if (is_numeric($page) && $page >= 1){
                return ' OFFSET '.$page;
            }
        }
        return " ";
    }



    public function getMarca($params = []){
        if (!empty($params[':ID'])){
            $id = $params[':ID'];
            $marca = $this->model->getMarca($id);
            if ($marca){
                $this->view->response($marca);
            }else{
                $this->view->response('La marca con el ID='.$id.' no existe');
            }
        }
    }

    public function insertarMarca($params = []){
        $marca = $this->getData();
        if (empty($marca->Nombre)){
            $this->view->response("Complete los datos", 400);
        }else {
            $id = $this->model->insertMarca($marca->Nombre);
            $marca = $this->model->getMarca($id);
            $this->view->response($marca, 201);
        }
    }

    public function actualizarMarca($params = []){
        $id = $params[':ID'];
        $marca = $this->model->getMarca($id);
        if ($marca){
            $body = $this->getData();
            $nombre = $body -> Nombre;
            $this->model->updateMarca($id, $nombre);
            $this->view->response('La marca con el id='.$id.' ha sido modificada', 200);
        }else{
            $this->view->response('La tarea con id='.$id.' no existe', 404);
        }
    }



}