<?php

require_once 'App/models/model.php';

class MarcasModel extends DB{
    public function getAllMarcas($parametrosGet){
        $sql = 'SELECT * FROM marcas '.$parametrosGet['order'].' '.$parametrosGet['page'];
        $query = $this->connect()->prepare($sql);
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }
    public function hasColumn($columna){
        $query=$this->connect()->prepare('SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = ?
        AND TABLE_NAME = ?
        AND COLUMN_NAME = ?');
        $query->execute([DB_NAME,'marcas',$columna]);
        $row= $query->fetch(PDO::FETCH_OBJ);
        if ($row !== false) {
            return  $row->COLUMN_NAME == $columna;
        }
        return false;
    }



    public function getMarca($id){
        $query = $this -> connect()->prepare('SELECT * FROM marcas WHERE marcaID = ?');
        $query->execute([$id]);
        $marca = $query->fetch(PDO::FETCH_OBJ);
        return $marca;
    }

    public function insertMarca($nombreMarca){
        $query = $this->connect()->prepare('INSERT INTO marcas(Nombre) VALUES (?)');
        $query->execute([$nombreMarca]);
        return $this->connect()->lastInsertId();
    }

    public function getMarcasPaginadas($limit, $offset){
        $query = $this->connect()->prepare("SELECT * FROM marcas LIMIT ? OFFSET ?");
        $query->bindValue(1, $limit, PDO::PARAM_INT);
        $query->bindValue(2, $offset, PDO::PARAM_INT);
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }

    public function updateMarca($id, $nombre){
        $query = $this->connect()->prepare('UPDATE marcas SET Nombre = ? WHERE MarcaID = ?');
        $query->execute([$nombre, $id]);
    }
}