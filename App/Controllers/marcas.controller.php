<?php
require_once './App/controllers/controller.php';
require_once './App/models/Marcas.Model.php';
require_once './App/views/api.view.php';
require_once './App/helpers/auth.api.helper.php';

class marcasController extends Controller{
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

            $parametrosGet['order']=$this->getOrder();
            $parametrosGet['page'] = $this->getLimit();
            $marcas = $this->model->getAllMarcas($parametrosGet);
            if ($marcas){
                $this->view->response($marcas);
            }else{
                $this->view->response("No existe", 404);
            }
    }


    function getMarca($params = []){
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

    function insertarMarca($params = []){
        $user = $this -> authHelper->currentUser();
        if (!$user){
            $this->view->response("Unauthorized", 401);
        }else{
            $marca = $this->getData();
            if (empty($marca->Nombre)){
                $this->view->response("Complete los datos", 400);
            }else {
                $id = $this->model->insertMarca($marca->Nombre);
                $marca = $this->model->getMarca($id);
                $this->view->response($marca, 201);
            }
        }
    }

    function actualizarMarca($params = []){
        $user = $this -> authHelper->currentUser();
        if (!$user){
            $this->view->response("Unauthorized", 401);
        }else{
            $id = $params[':ID'];
            $marca = $this->model->getMarca($id);
            if ($marca){
                $body = $this->getData();
                if (empty($marca->Nombre)){
                    $this->view->response("No se completaron todos los datos", 400);
                }else {
                    $nombre = $body -> Nombre;
                    $this->model->updateMarca($id, $nombre);
                    $this->view->response('La marca con el id='.$id.' ha sido modificada', 200);
                }
            }else{
                $this->view->response('La tarea con id='.$id.' no existe', 404);
            }
        }
    }



}