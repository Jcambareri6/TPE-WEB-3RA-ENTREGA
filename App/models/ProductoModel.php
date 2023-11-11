<?php
require_once './App/models/model.php';
class ProductoModel extends DB{



   // public function getProducts($params=null,$parametrosGet){
        //SI EL PARAMS ES ASC{
            // $sql .= ' ORDER BY'
        //} 
        public function GetAll($parametrosGet){

            $sql = 'SELECT * FROM productos '.$parametrosGet['order'];
            echo ($sql);
            die(__FILE__);


        /*$sql = 'SELECT * FROM productos ORDER BY precio';
        //ordenado por campo
        
        if(!empty($parametrosGet)){
            switch ($parametrosGet){
                case isset($parametrosGet['order']) :
                 $sql.=' ORDER BY '.$parametrosGet['order'].' '.$parametrosGet['sort'];
                 break;
                 case isset($parametrosGet['Condicion']) :
                    $sql.=' WHERE '.$parametrosGet['Condicion'] ; 
                 break;
            }
        } */

        // select c1...
        // from tabla
        // where condicion
        // order by

        $query= $this->connect()->prepare($sql);
        $query->execute();
        $productos= $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    public function HasColumn($Columna){
        $query=$this->connect()->Prepare('SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = ?
        AND TABLE_NAME = ?
        AND COLUMN_NAME = ?');
        $query->execute([DB_NAME,'productos',$Columna]);
        $row= $query->fetch(PDO::FETCH_OBJ);
        // Obtener el nombre de la columna del objeto PDO
        if ($row !== false) {
            return  $row->COLUMN_NAME == $Columna;
        }
        return false;
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
   
    public function updateProduct($id, $nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion){
        $query = $this->connect()->prepare('UPDATE productos SET NombreProducto = ?, Descripcion = ?, Precio = ?, Stock = ?, IDmarca = ?, Condicion = ?, WHERE ProductoID = ?');
        $query->execute([$nombreProducto, $descripcion, $precio, $stock, $idMarca, $condicion, $id]);
    }


}