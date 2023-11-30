<?php 

namespace app\Controller;

include "../codelabmodul5/Traits/ApiResponseFormatter.php";
include "../codelabmodul5/Model/Product.php";

use app\Models\Product;
use app\Traits\ApiResponseFormatter;

class ProductController{
    use ApiResponseFormatter;

    public function index(){
        //Definisi Object Model yang sudah dibuat
        $productModel = new Product();
        //Panggil Fungsi findAll
        $response = $productModel->findAll();
        //return response dengan melakukan formatting terlebih dahulu menggunakan tarits formatting
        return $this->apiResponse(200, "success", $response);
    }

    public function getbyId($id){ // Tambahkan parameter $id di sini
        $productModel = new Product();
        $response = $productModel->findId($id); // Kirimkan $id ke metode findId()
        return $this->apiResponse(200, "success", $response);
    }

    public function insert(){
        //Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        //Validasi apakah input valid
        if (json_last_error()){
            return $this->apiResponse(400, "error invalid input", null);
        }
        //Lanjut jika tidak error
        $productModel = new Product();
        $response = $productModel->create([
            "product_name" => $inputData['product_name']
        ]);
        return $this->apiResponse(200, "success", $response);
    }

    public function update($id){
        //Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        //Validasi apakah input valid
        if (json_last_error()){
            return $this->apiResponse(400, "error invalid input", null);
        }
        //Lanjut jika tidak error
        $productModel = new Product();
        $response = $productModel->update([
            "product_name" => $inputData['product_name']
        ], $id);
        return $this->apiResponse(200, "success", $response);
    }

    public function destroy($id){
        //Definisi Object Model yang sudah dibuat
        $productModel = new Product();
        //Panggil Fungsi findAll
        $response = $productModel->destroy($id);
        //return response dengan melakukan formatting terlebih dahulu menggunakan tarits formatting
        return $this->apiResponse(200, "success", $response);
    }
}