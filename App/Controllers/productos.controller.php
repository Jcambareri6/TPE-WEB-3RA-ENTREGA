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
    public function GetSort(){
        if(isset($_GET['sort'])){
            $sort=$_GET['sort'];
            return $sort;
        }else{
            return $sort='ASC';
        }

    }
    public function getProducts($params = null) {
        // ?sort=nombre&order=desc
        // ?page=3
        $parametrosGet=[];
        $sql = 'SELECT * FROM productos';
        //switch para determinar si existen parametros get para concatenar a la consulta
        switch (!empty ($_GET)){
            case isset($_GET['filterBy']):
                $parametrosGet['filterBy'] = $_GET['filterBy'];
                $sql.= ' WHERE '. $parametrosGet['filterBy'];
            break;
        }
        //consulta a lo ultimo si hay algun orden para establecer sino establece el orden por defecto del campo 
        if (isset($_GET['order'])){
                $parametrosGet['order']=$_GET['order'];
                $sql .= ' ORDER BY '.$parametrosGet['order'];
                 if (isset($sort)){
                    $sort=$this->GetSort();
                     $sql.=$sort;
                }
        }else{
            $sql .= ' ORDER BY Precio';
        }

        
        $productos = $this->model->ejecutarConsulta($sql);
        
        if ($productos) {
            $this->view->response($productos);
        } else {
            $this->view->response("no existe", 404);
        }
        
             
    }
    
    //   
    

     public function getProduct($params = null) {
         // obtengo el id del arreglo de params
         if (!empty($params[':ID'])) {
            $id = $params[':ID'];
            $producto = $this->model->getProduct($id);
            if ($producto) {
                $this->view->response($producto);
            } else {
                $this->view->response('El producto con el ID=' . $id . ' no existe.', 404);
            };
     }
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

    public function actualizarProducto($params = []) {
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);
        if ($product){
            $body = $this->getData();
            $nombre = $body -> NombreProducto;
            $descripcion = $body -> Descripcion;
            $precio = $body -> Precio;
            $stock = $body -> Stock;
            $idMarca = $body -> IDmarca;
            $condicion = $body -> Condicion;
            $this->model->updateProduct($id, $nombre, $descripcion, $precio, $stock, $idMarca, $condicion);

            $this->view->response('La tarea con id='.$id.' ha sido modificada.', 200);
        

        } else {
            $this->view->response('La tarea con id='.$id.' no existe. ', 404);
        }
    }

}