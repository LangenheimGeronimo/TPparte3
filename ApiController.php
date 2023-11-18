<?php
require_once 'ApiView.php';
require_once 'ApiModel.php';
class ApiController {
    private $model;
    private $view;
    private $data;
    public function __construct() {
        $this->model = new ApiModel();
        $this->view = new ApiView();
        $this->data = file_get_contents('php://input');
    }
    function getData() {
        return json_decode($this->data);
    }
    function traerAsesinos() {
        $asesinos = $this->model->getAsesinos();
        if(!empty($asesinos)) {
            $this->view->response($asesinos, 200);
        }else {
            $this->view->response('no hay nada',404);
        }
    }

    function traerAsesino($params = []){
        $id = $params[':ID'];
        $asesino = $this->model->getAsesino($id);
        if(!empty($asesino)) {
            $this->view->response($asesino,200);
        }else {
            $this->view->response('not found',404);
        }
    }
    function ordenarAsesinosPor($params = []) {
        $columna = ucfirst($params[':COLUMNA']);
        $orden = $params[':ORDEN'];
        $asesinosOrdenados = null; 
        switch($columna) {
            case 'ID': {
                $asesinosOrdenados = $this->model->getAsesinosOrdenados($columna, $orden);
            };break;
            case 'Nombre': {
                $asesinosOrdenados = $this->model->getAsesinosOrdenados($columna, $orden);
            };break;
            case 'Apellido': {
                $asesinosOrdenados = $this->model->getAsesinosOrdenados($columna, $orden);
            };break;
            case 'Edad': {
                $asesinosOrdenados = $this->model->getAsesinosOrdenados($columna, $orden);
            };break;
            case 'Peso': {
                $asesinosOrdenados = $this->model->getAsesinosOrdenados($columna, $orden);
            };break;
            case 'Altura': {
                $asesinosOrdenados = $this->model->getAsesinosOrdenados($columna, $orden);
            };break;
            default: {
                $this->view->response('No es una columna valida', 404);
                die();
            };
        }
        $this->view->response($asesinosOrdenados, 200);
    }

    function agregar_editar_asesino($params = []) {
        $datos = $this->getData();

        $nombre = $datos->Nombre;
        $apellido = $datos->Apellido;
        $edad = $datos->Edad;
        $genero = $datos->Genero;
        $peso = $datos->Peso;
        $altura = $datos->Altura;

        if(!empty($nombre) && !empty($apellido) && !empty($edad) && 
        !empty($genero) && !empty($peso) && !empty($altura)) {
            if(empty($params)) {
                $id = $this->model->addAsesino($nombre, $apellido, $edad, $genero, $peso, $altura);
                $asesinoAgregado = $this->model->getAsesino($id);
                $this->view->response($asesinoAgregado, 200);
            }else {
                $id = $params[':ID'];
                $this->model->editAsesino($nombre, $apellido, $edad, $genero, $peso, $altura, $id);
                $asesinoEditado = $this->model->getAsesino($id);
                $this->view->response($asesinoEditado, 200);
            }
        }
    }

    function BorrarAsesinato($params = []){
        $id = $params[':ID'];
        $this->model->BorrarVictima($id);
        $this->model->BorrarAsesino($id);
    }

    function filtrarPorEdad($params = []) {
        $desde = $params[':DESDE'];
        $hasta = $params[':HASTA'];
        if(is_numeric($desde) && is_numeric($hasta)) {
            $asesinosFiltrados = $this->model->getAsesinosFiltrados($desde, $hasta);
            if(!empty($asesinosFiltrados)) {
                $this->view->response($asesinosFiltrados, 200);
            }else {
                $this->view->response('¡No se encontraron asesinos en ese rango de edad!',404);
            }
        }else {
            $this->view->response('no ingresaste numeros', 404);
        }
    }

    function filtrarPorGenero($params = []){
        $genero = ucfirst($params[':GENERO']);
        if(!empty($genero)){
            $generoAsesino = $this->model->BuscarGeneroAsesino($genero);
            $this->view->response($generoAsesino, 200);
        }
        else{
            $this->view->response('not found.', 404);
        }
    }

    function filtrarPorPeso($params = []) {
        $desde = $params[':DESDE'];
        $hasta = $params[':HASTA'];
        if(is_numeric($desde) & is_numeric($hasta)) {
            $asesinosFiltrados = $this->model->getAsesinosPorPeso($desde, $hasta);
            if(!empty($asesinosFiltrados)) {
                $this->view->response($asesinosFiltrados, 200);
            }else {
                $this->view->response('', 404);
            }
        }else {
            $this->view->response('no ingresaste numeros', 404);
        }
    }

    function filtrarPorAltura($params = []){
        $desde = $params[':DESDE'];
        $hasta = $params[':HASTA'];
        if(is_numeric($desde) & is_numeric($hasta)) {
            $asesinosFiltrados = $this->model->getAsesinosPorAltura($desde, $hasta);
            if(!empty($asesinosFiltrados)) {
                $this->view->response($asesinosFiltrados, 200);
            }else {
                $this->view->response('', 404);
            }
        }else {
            $this->view->response('no ingresaste numeros', 404);
        }
    }

    // VICTIMAS

    function traerVictimas($params = []) {
        if(empty($params)) {
            $victimas = $this->model->getVictimas();
            if($victimas) {
                $this->view->response($victimas, 200);
            }else {
                $this->view->response('', 404);
            }
        }
        else{
            $id = $params[':ID'];
            $victima = $this->model->buscarVictima($id);
            if($victima) {
                $this->view->response($victima, 200);
            }else {
                $this->view->response('', 404);
            }
        }
    }


    function ordenarVictimasPor($params = []) {
        $columna = ucfirst($params[':COLUMNA']);
        $orden = $params[':ORDEN'];
        $victimasOrdenadas = null;
        switch($columna) {
            case 'Nombre': {
                $victimasOrdenadas = $this->model->getVictimasOrdenadas($columna, $orden);
            };break;
            case 'Apellido': {
                $victimasOrdenadas = $this->model->getVictimasOrdenadas($columna, $orden);
            };break;
            case 'Edad': {
                $victimasOrdenadas = $this->model->getVictimasOrdenadas($columna, $orden);
            };break;
            case 'ID':{
                $victimasOrdenadas = $this->model->getVictimasOrdenadas($columna, $orden);
            };break;
            default: {
                $this->view->response('No es una columna valida', 404);
                die();
            };
        }
        $this->view->response($victimasOrdenadas, 200);
    }

    function agregar_editar_victimas($params = []) {
        $datos = $this->getData();

        $nombre = $datos->Nombre;
        $apellido = $datos->Apellido;
        $edad = $datos->Edad;
        $genero = $datos->Genero;
        $id_asesino = $datos->ID_asesino;

        if(!empty($nombre) && !empty($apellido) && !empty($edad) && !empty($genero) && !empty($id_asesino)) {
            if(empty($params)) {
                $id = $this->model->addVictima($nombre, $apellido, $edad, $genero, $id_asesino);
                $victimaAgregada = $this->model->buscarVictima($id);
                $this->view->response($victimaAgregada, 200);
            }else {
                $id = $params[':ID'];
                $this->model->editVictima($nombre, $apellido, $edad, $genero, $id_asesino, $id);
                $VictimaEditada = $this->model->buscarVictima($id);
                $this->view->response($VictimaEditada, 200);
            }
        }else {
            $this->view->response('Te faltan datos!!!', 404);
        }
    }

    function BorrarVictimaDeAsesino($params = []){
        $id = $params[':ID'];
        $this->model->BorrarVictimaDeAsesino($id);
    }

    function filtrarVictimasPorEdad($params = []){
        $desde = $params[':DESDE'];
        $hasta = $params[':HASTA'];
        if(is_numeric($desde) && is_numeric($hasta)) {
            $victimasFiltradas = $this->model->getVictimasFiltradas($desde, $hasta);
            if(!empty($victimasFiltradas)) {
                $this->view->response($victimasFiltradas, 200);
            }else {
                $this->view->response('¡No se encontraron asesinos en ese rango de edad!',404);
            }
        }else {
            $this->view->response('no ingresaste numeros', 404);
        }
    }

    function filtrarVictimaPorGenero($params = []){
        $genero = ucfirst($params[':GENERO']);
        if(!empty($genero)){
            $generoVictima = $this->model->BuscarGeneroVictima($genero);
            $this->view->response($generoVictima, 200);
        }
        else{
            $this->view->response('not found.', 404);
        }
    }

    function filtrarVictimaPorAsesino($params = []){
        $asesino = is_numeric($params[':ID']);
        if(!empty($asesino)){
            $asesinoDeVictima = $this->model->BuscarAsesinoDeVictima($asesino);
            $this->view->response($asesinoDeVictima, 200);
        }
        else{
            $this->view->response('not found.', 404);
        }
    }

    

}


?>