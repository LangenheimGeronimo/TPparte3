<?php 
require_once 'conex.php';
class ApiModel {
    function getAsesinos() {
        $consulta = conex->prepare("SELECT * FROM asesinos");
        $consulta->execute();
        $asesinos = $consulta->fetchAll(PDO::FETCH_OBJ);  
        return $asesinos;
    }
    function getAsesino($id) {
        $consulta = conex->prepare("SELECT * FROM asesinos WHERE id=?");
        $consulta->execute([$id]);
        $asesino = $consulta->fetch(PDO::FETCH_OBJ);
        return $asesino;
    }
    function getAsesinosOrdenados($columna, $orden) {
        $consulta = conex->prepare("SELECT * FROM asesinos ORDER BY $columna $orden");
        $consulta->execute();
        $asesinosOrdenados = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $asesinosOrdenados;   
    }

    function addAsesino($nombre, $apellido, $edad, $genero, $peso, $altura) {
        $consulta = conex->prepare("INSERT INTO asesinos(Nombre, Apellido, Edad, Genero, Peso, Altura) VALUES (?,?,?,?,?,?)");
        $consulta->execute([$nombre, $apellido, $edad, $genero, $peso, $altura]);
        return conex->lastInsertId();
    }

    function editAsesino($nombre, $apellido, $edad, $genero, $peso, $altura, $id) {
        $consulta = conex->prepare("UPDATE asesinos SET Nombre=?, Apellido=?, Edad=?, Genero=?, Peso=?, Altura=? WHERE id=?");
        $consulta->execute([$nombre, $apellido, $edad, $genero, $peso, $altura, $id]);
    }

    function BorrarVictima($id){
        $sentencia = conex->prepare("DELETE FROM victimas WHERE ID_asesino=?");
        $sentencia->execute([$id]);
    }

    function BorrarAsesino($id){
        $sentencia = conex->prepare("DELETE FROM asesinos WHERE ID=?");
        $sentencia->execute([$id]);
    }

    function getAsesinosFiltrados($desde, $hasta) {
        $consulta = conex->prepare("SELECT * FROM asesinos WHERE edad BETWEEN $desde AND $hasta");
        $consulta->execute();
        $asesinosFiltrados = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $asesinosFiltrados;
    }

    function BuscarGeneroAsesino($genero){
        $consulta = conex->prepare("SELECT * FROM asesinos WHERE Genero=?");
        $consulta->execute([$genero]);
        $asesinosFiltrados = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $asesinosFiltrados;
    }

    function getAsesinosPorPeso($desde, $hasta) {
        $consulta = conex->prepare("SELECT * FROM asesinos WHERE Peso BETWEEN $desde AND $hasta");
        $consulta->execute();
        $asesinosFiltrados = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $asesinosFiltrados;
    }

    function getAsesinosPorAltura($desde, $hasta){
        $consulta = conex->prepare("SELECT * FROM asesinos WHERE Altura BETWEEN $desde AND $hasta");
        $consulta->execute();
        $asesinosFiltrados = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $asesinosFiltrados;
    }

    //VICTIMAS

    function getVictimas() {
        $consulta = conex->prepare("SELECT * FROM victimas");
        $consulta->execute();
        $victimas = $consulta->fetchAll(PDO::FETCH_OBJ);  
        return $victimas;
    }

    function buscarVictima($id) {
        $consulta = conex->prepare("SELECT * FROM victimas WHERE ID=$id");
        $consulta->execute();
        $victima = $consulta->fetch(PDO::FETCH_OBJ);  
        return $victima;
    }

    function getVictimasOrdenadas($columna, $orden){
        $consulta = conex->prepare("SELECT * FROM victimas ORDER BY $columna $orden");
        $consulta->execute();
        $victimasOrdenadas = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $victimasOrdenadas;   
    }

    function addVictima($nombre, $apellido, $edad, $genero, $id_asesino) {
        $consulta = conex->prepare("INSERT INTO victimas(Nombre, Apellido, Edad, Genero, ID_asesino) VALUES (?,?,?,?,?)");
        $consulta->execute([$nombre, $apellido, $edad, $genero, $id_asesino]);
        return conex->lastInsertId();
    }

    function editVictima($nombre, $apellido, $edad, $genero, $id_asesino, $id){
        $consulta = conex->prepare("UPDATE victimas SET Nombre=?, Apellido=?, Edad=?, Genero=?, ID_asesino =? WHERE id=?");
        $consulta->execute([$nombre, $apellido, $edad, $genero, $id_asesino, $id]);
    }

    function BorrarVictimaDeAsesino($id){
        $sentencia = conex->prepare("DELETE FROM victimas WHERE ID=?");
        $sentencia->execute([$id]);
    }
    
    function getVictimasFiltradas($desde, $hasta){
        $consulta = conex->prepare("SELECT * FROM victimas WHERE edad BETWEEN $desde AND $hasta");
        $consulta->execute();
        $victimasFiltradas = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $victimasFiltradas;
    }

    function BuscarGeneroVictima($genero){
        $consulta = conex->prepare("SELECT * FROM victimas WHERE Genero=?");
        $consulta->execute([$genero]);
        $victimasFiltradas = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $victimasFiltradas;
    }

    function BuscarAsesinoDeVictima($asesino){
        $consulta = conex->prepare("SELECT * FROM victimas WHERE ID_asesino=?");
        $consulta->execute([$asesino]);
        $victimasFiltradas = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $victimasFiltradas;
    }
}

?>