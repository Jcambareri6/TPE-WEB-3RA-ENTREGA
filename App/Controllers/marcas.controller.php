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

    public function getMarcas($params = []){
        $marcas = $this->model->getMarcas();
        return $this->view->response($marcas, 200);
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