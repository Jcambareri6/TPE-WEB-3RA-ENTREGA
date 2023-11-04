<?php
require_once './App/models/model.php';
class ProductoModel extends DB{
    public function getProducts(){
        $query= $this->connect()->prepare('SELECT * FROM productos');
        $query->execute();
        $productos= $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    public function getProduct($id){
        $query= $this->connect()->prepare('SELECT * FROM productos WHERE productoID=?');
        $query->execute([$id]);
        $producto= $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }
    function delete($id) {
        $query = $this->connect()->prepare('DELETE FROM productos WHERE productoID = ?');
        $query->execute([$id]);
    }

    public function updateProduct($id, $nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion){
        $query = $this->connect()->prepare('UPDATE productos SET NombreProducto = ?, Descripcion = ?, Precio = ?, Stock = ?, IDmarca = ?, Condicion = ?, WHERE ProductoID = ?');
        $query = execute([$nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion, $id]);
    }


}