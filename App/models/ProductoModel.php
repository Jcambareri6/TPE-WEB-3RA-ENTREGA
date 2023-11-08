<?php
require_once './App/models/model.php';
class ProductoModel extends DB{
    public function getProducts($params=null,$parametrosGet){
        //SI EL PARAMS ES ASC{
            // $sql .= ' ORDER BY'
        //} 
        $sql = 'SELECT * FROM productos';
        //ordenado por campo
        
        if(!empty($parametrosGet)){
            switch ($parametrosGet){
                case isset($parametrosGet['order']) :
<<<<<<< HEAD
                 $sql.=' ORDER BY '.$parametrosGet['order'].' '.$parametrosGet['sort'];
=======
                 $sql.=' ORDER BY '.$parametrosGet['order'] . " ". $parametrosGet['sort'] ; 
>>>>>>> 780d3ddcc7989cb19f217fce49732419a1841831
                 break;
                 case isset($parametrosGet['Condicion']) :
                    $sql.=' WHERE '.$parametrosGet['Condicion'] ; 
                 break;
            }
        }
<<<<<<< HEAD
=======
        //filtro
>>>>>>> 780d3ddcc7989cb19f217fce49732419a1841831
        $query= $this->connect()->prepare($sql);
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
    
    public function getProductPerPage($limit, $offset){
        $query = $this->connect()->prepare("SELECT * FROM productos LIMIT ? OFFSET ?");
        $query->bindValue(1, $limit, PDO::PARAM_INT);
        $query->bindValue(2, $offset, PDO::PARAM_INT);
    
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;

    }
<<<<<<< HEAD
   
    public function updateProduct($id, $nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion){
        $query = $this->connect()->prepare('UPDATE productos SET NombreProducto = ?, Descripcion = ?, Precio = ?, Stock = ?, IDmarca = ?, Condicion = ?, WHERE ProductoID = ?');
        $query->execute([$nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion, $id]);
=======

    public function updateProduct($id, $nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion){
        $query = $this->connect()->prepare('UPDATE productos SET NombreProducto = ?, Descripcion = ?, Precio = ?, Stock = ?,IDmarca = ?, Condicion = ? WHERE ProductoID = ?');
        $query -> execute([$nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion, $id]);
>>>>>>> 780d3ddcc7989cb19f217fce49732419a1841831
    }


}