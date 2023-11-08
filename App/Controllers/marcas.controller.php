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

    public function getSort(){
        if (isset($_GET['sort'])){
            $sort = $_GET['sort'];
            return $sort;
        } else {
            return $sort = 'ASC';
        }

    }

    public function setCondicion(){
        if (isset($_GET['condicion'])){
            $campo = $_GET['condicion'];
            return $campo;
        }
    }


    public function getMarcas($params = []){
        $parametrosGet = [];
        $condicionWhere = $this->setCondicion();

        if (isset($_GET['order'])){
            $parametrosGet['sort'] = $this->getSort();
            $parametrosGet['order'] = $_GET['order'];
        }

        if (!empty($condicionWhere)){
            $parametrosGet['condicion'] = $condicionWhere;
        }

        $marcas = $this->model->getMarcas($params, $parametrosGet);

        if ($marcas) {
            $this->view->response($marcas);
        } else {
            $this->view->response("No existe", 404)
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