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
    public function insertProduct($NombreProducto, $Descripcion, $Precio, $Stock, $IDmarca, $Condicion){
        $query = $this->connect()->prepare('INSERT INTO  productos ( NombreProducto, Descripcion, Precio, Stock, IDmarca, Condicion) VALUES (?,?,?,?,?,?)');
        $query->execute([$NombreProducto, $Descripcion, $Precio, $Stock, $IDmarca, $Condicion]);
        return $this->connect()->lastInsertId();

    }
    public function filtrarxCondicion($id) {
        $query = $this->connect()->prepare("SELECT * FROM Productos WHERE Condicion = ?");
        $query->execute([$id]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $productos;
    }
    public function getProductPerPage($limit){
        $query = $this->connect()->prepare("SELECT * FROM productos LIMIT ?");
        $query->bindValue(1, $limit, PDO::PARAM_INT);
    
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;

    }
   



    


}