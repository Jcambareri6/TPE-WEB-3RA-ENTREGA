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
            $this->view->response("el producto con el id=$id no existe", 404);
     }
     public function getProductByCondicion($params = null) { // opcional
        // obtengo el id del arreglo de params
        $Condicion = $params[':CONDICION'];
       $producto = $this->model->filtrarXCondicion($Condicion);

        if ($producto)
            $this->view->response($producto);
       else 
           //s
           $this->view->response("los productos por  con  Condicion $Condicion no existe", 404);
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
    

     public function GuardarProducto($params = null) {
         $product = $this->getData();
        
         if (empty($product->NombreProducto) || empty($product->Descripcion) || empty($product->Precio)|| empty($product->Stock)|| empty($product->IDmarca) || empty($product->Condicion)) {
             $this->view->response("Complete los datos", 400);
         } else {
             $id = $this->model->insertProduct($product->NombreProducto, $product->Descripcion, $product->Precio,$product->Stock,$product->IDmarca,$product->Condicion);
            $producto = $this->model->getProduct($id);
            $this->view->response($product, 201);
        }
     }

}