<?php 
require_once './App/models/ProductoModel.php';
require_once './App/views/api.view.php';

class productosController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ProductoModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getProducts($params = null) {
        $productos = $this->model->getProducts();
        $this->view->response($productos);
    }

     public function getProduct($params = null) {
         // obtengo el id del arreglo de params
         $id = $params[':ID'];
        $producto = $this->model->getProduct($id);

         if ($producto)
             $this->view->response($producto);
        else 
            //s
            $this->view->response("La tarea con el id=$id no existe", 404);
     }

     public function deleteProduct($params = null) {
        $id = $params[':ID'];

         $product = $this->model->getProduct($id);
        if ($product) {
             $this->model->delete($id);
            $this->view->response($product);
         } else 
             $this->view->response("La tarea con el id=$id no existe", 404);
        }
    

    // public function insertTask($params = null) {
    //     $task = $this->getData();

    //     if (empty($task->titulo) || empty($task->descripcion) || empty($task->prioridad)) {
    //         $this->view->response("Complete los datos", 400);
    //     } else {
    //         $id = $this->model->insert($task->titulo, $task->descripcion, $task->prioridad);
    //         $task = $this->model->get($id);
    //         $this->view->response($task, 201);
    //     }
    // }

}