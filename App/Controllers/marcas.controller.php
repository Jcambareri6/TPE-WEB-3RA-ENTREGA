<?php
require_once './App/models/Marcas.Model.php';
require_once './App/views/api.view.php';

class marcasController{
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new MarcasModel();
        $this->view = new ApiView();
        
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
        } else {
            return $sort = 'ASC';
        }

    }

    public function getMarcas(){
        $parametros['order']=$this->getOrder();
        $marcas = $this->model->getAllMarcas($parametros);
        if ($marcas){
            $this->view->response($marcas);
        }else{
            $this->view->response("No existe", 404);
        }
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