<?php
class Controller{
    
    protected function getData(){
        return json_decode(file_get_contents("php://input"));
    }

    function getLimit(){
        if (!empty($_GET['limit'])){
            $limit = $_GET['limit'];
            $page = $this->getPage();
            if (is_numeric($limit) && $limit >= 1){
                return ' LIMIT ' . $limit . $page;
            }
            $this->view->response("Parametro incorrecto",404);
            die();
        }
        return " ";
    }

    function getPage(){
        if (!empty($_GET['page'])){
            $page = $_GET['page'];
            if (is_numeric($page) && $page >= 1){
                return ' OFFSET '.$page;
            }
        }
        return " ";
    }
}