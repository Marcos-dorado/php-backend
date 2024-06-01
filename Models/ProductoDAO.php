<?php
include '../Connections/conexion.php';


class ProductoDAO{
    public $id;
    public $nombre;
    public $descripcion;

    function __construct($id=null,$nom=null,$cod=null){
        $this->id=$id;
        $this->nombre=$nom;
        $this->descripcion=$cod;
    }

    function TraerClases (){
        $conexion = new Conexion ('localhost', 'root', '', 'php');
        try {
            $conn = $conexion->Conectar();
            $stmt = $conn->query('SELECT * FROM electrodomesticos');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
            $conexion->cerrarConexion();
        } catch(PDOException $e) {
            echo "error al conectar a la base de datos ======>".$e->getMessage();
        }
    }
    function eliminarClases ($id){
        $conexion = new Conexion ('localhost', 'root', '', 'php');
        try {
            $conn = $conexion->Conectar();

            $consulta = $conn->prepare("DELETE FROM electrodomesticos WHERE id = $id");
            $consulta->execute();
            return "Exito";
        } catch(PDOException $e) {
            echo "error al conectar a la base de datos ======>".$e->getMessage();
        }
    }
    function agregarClases($id,$nombre, $descripcion) {
        $conexion = new Conexion('localhost', 'root', '', 'php');
        try {
            $conn = $conexion->Conectar(); 
            $agregar = $conn->prepare("INSERT INTO electrodomesticos (`id`, `nombre`, `descripcion`) VALUES (?, ?, ?)");
            $agregar->bindParam(1, $id);
            $agregar->bindParam(2, $nombre);
            $agregar->bindParam(3, $descripcion);
            $agregar->execute();
            return "Agregado Exitosamente";
        } catch(PDOException $e) {
            return "Error al conectar a la base de datos: " . $e->getMessage();
        }
    } 

    function TraerClase ($id){
        $conexion = new Conexion ('localhost', 'root', '', 'php');
        try {
            $conn = $conexion->Conectar();
            $stmt = $conn->query("SELECT * FROM electrodomesticos WHERE id={$id}");
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            return $rows;
            $conexion->cerrarConexion();
        } catch(PDOException $e) {
            echo "error al conectar a la base de datos ======>".$e->getMessage();
        }
    }

    function actualizarClase($id, $nombre, $descripcion) {
        $conexion = new Conexion('localhost', 'root', '', 'php');
        try {
            $conn = $conexion->Conectar(); 
            $agregar = $conn->prepare("UPDATE electrodomesticos SET nombre='$nombre', descripcion='$descripcion' WHERE id =$id");
            $agregar->execute();
            return "Actualizado Exitosamente";
        } catch(PDOException $e) {
            return "Error al conectar a la base de datos: " . $e->getMessage();
        }
    }
    
}


 $conexion = new Conexion('localhost', 'root', '', 'php');


?>