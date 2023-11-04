<?php

require_once 'App/models/model.php';

class MarcasModel extends DB{
    public function getMarcas(){
        $query = $this->connect()->prepare('SELECT * FROM marcas');
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