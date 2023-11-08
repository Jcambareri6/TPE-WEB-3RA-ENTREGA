<?php

require_once 'App/models/model.php';

class MarcasModel extends DB{
    public function getMarcas($params=null, $parametrosGet){
        $sql = 'SELECT * FROM marcas';
        if (!empty($parametrosGet)){
            switch ($parametrosGet){
                case isset ($parametrosGet['order']):
                    $sql.= 'ORDER BY '.$parametrosGet['order'] . " " . $parametrosGet['sort'];
                    break;
                case isset ($parametrosGet['Condicion']) : 
                    $sql.= ' WHERE '.$parametrosGet['Condicion'];
                break;
            }
        }
        $query = $this->connect()->prepare($sql);
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }
    public function getMarca($id){
        $query = $this -> connect()->prepare('SELECT * FROM marcas WHERE marcaID = ?');
        $query->execute([$id]);
        $marca = $query->fetch(PDO::FETCH_OBJ);
        return $marca;
    }

    public function updateMarca($id, $nombre){
        $query = $this->connect()->prepare('UPDATE marcas SET Nombre = ? WHERE MarcaID = ?');
        $query->execute([$nombre, $id]);
    }
}