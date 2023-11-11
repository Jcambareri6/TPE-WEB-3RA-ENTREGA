<?php
require_once './App/models/ProductoModel.php';
require_once './App/views/api.view.php';
require_once './App/helpers/auth.api.helper.php';

class productosController
{
    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct()
    {
        $this->model = new ProductoModel();
        $this->view = new ApiView();
        $this->authHelper= new AuthHelper();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }
    public function getCondicion() {
        
        // Verificar si hay un parámetro 'filterBy' en la URL
        if (!empty($_GET['filterBy'])) {
            $condicion = $_GET['filterBy'];
            if ($this->condicionValida($condicion)) {
                $filterBy = ' WHERE ' . $_GET['filterBy'];
                return $filterBy;
            }
        }
        return '';
    }
    public function condicionValida($condicion)
    {

        $patron = '/^(\w+)\s*([=<>]+)\s*(\w+)(\s*(AND|OR)\s*(\w+)\s*([=<>]+)\s*(\w+))*$/'; // posibles condiciones que puede presentar la consulta

        if (preg_match($patron, $condicion, $matches)) { // funcion para encontrar coincidencia con el patron
            $columnName = $matches[1]; // obtiene el campo en la posicion 1
            if ($this->model->HasColumn($columnName)) { // verifica si el campo existe 
                return  true;
            }
        }
        return false; // el campo no existe o esta vacio
    }

    public function GetOrder()
    {
        $sort = $this->GetSort();
        if (!empty($_GET['order'])) {
            $order = $_GET['order'];

            if ($this->model->HasColumn($order)) { // aplico la funcion para  validar que el campo es correcto
                return 'ORDER BY ' . $order . ' ' . $sort; // aplico el sort ya que si no esta seteado es por defecto
            }
        }
        return ' ORDER BY Precio ' . $sort;
    }
    public function GetSort()
    {
        if (!empty($_GET['sort'])) {
            $sort = $_GET['sort'];
            return $sort;
        }
        return 'DESC';
    }

    public function getProducts()
    {
        // ?sort=nombre&order=desc
        // ?page=3
        $user=$this->authHelper->currentUser();
        
        if(!$user){
            $this->view->response("unauthorized",401);
        }else{

        

        $parametrosGet['order'] = $this->GetOrder();
        $parametrosGet['filterBy'] = $this->getCondicion();
        //consulta a lo ultimo si hay algun orden para establecer sino establece el orden por defecto del campo 
        $productos = $this->model->GetAll($parametrosGet);
        if ($productos) {
            $this->view->response($productos);
        } else {
            $this->view->response("no existe", 404);
        }
    }
    }

    //   


    public function getProduct($params = null)
    {
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

    public function deleteProduct($params = null)
    {
        $id = $params[':ID'];

        $product = $this->model->getProduct($id);
        if ($product) {
            $this->model->delete($id);
            $this->view->response($product);
        } else
            $this->view->response("La tarea con el id=$id no existe", 404);
    }


    public function GuardarProducto($params = null)
    {
        $product = $this->getData();

        if (empty($product->NombreProducto) || empty($product->Descripcion) || empty($product->Precio) || empty($product->Stock) || empty($product->IDmarca) || empty($product->Condicion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertProduct($product->NombreProducto, $product->Descripcion, $product->Precio, $product->Stock, $product->IDmarca, $product->Condicion);
            $producto = $this->model->getProduct($id);
            $this->view->response($product, 201);
        }
    }

    public function actualizarProducto($params = [])
    {
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);
        if ($product) {
            $body = $this->getData();
            $nombre = $body->NombreProducto;
            $descripcion = $body->Descripcion;
            $precio = $body->Precio;
            $stock = $body->Stock;
            $idMarca = $body->IDmarca;
            $condicion = $body->Condicion;
            $this->model->updateProduct($id, $nombre, $descripcion, $precio, $stock, $idMarca, $condicion);

            $this->view->response('La tarea con id=' . $id . ' ha sido modificada.', 200);
        } else {
            $this->view->response('La tarea con id=' . $id . ' no existe. ', 404);
        }
    }
}
