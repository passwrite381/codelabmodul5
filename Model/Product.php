<?php
namespace app\Models;
include "../codelabmodul5/Config/Database_config.php";
use app\Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig{

    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database_name, $this->port);
        if ($this->conn->connect_error){
            die("Connection failed" .$this->conn->connect_error);
        }
    }
    //Cari semua data
    public function findAll(){
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    //Cari berdasarkan Id
    public function findId($id){
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    //Tambah data
    public function create($data){
        $product_name = $data['product_name'];
        $sql = "INSERT INTO products (product_name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $this->conn->close();
    }

    //Update data
    public function update($data, $id){
        $product_name = $data['product_name'];
        $sql = "UPDATE products SET product_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $product_name, $id);
        $stmt->execute();
        $this->conn->close();
    }

    //Delete data
    public function destroy($id){
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}