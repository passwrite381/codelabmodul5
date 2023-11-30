<?php
namespace app\Routes;

include "../codelabmodul5/Controller/ProductController.php";
use app\Controller\ProductController;

class ProductRoutes{
    
    public function handle($path, $method){
        //Jika request method GET dan path sama dengan 'api/product'
        if ($method === 'GET' && $path === '/api/product'){
            $controller = new ProductController();
            echo $controller->index();
        }

        //Jika request method GET dan path mengandung 'api/product'
        if ($method === 'GET' && strpos($path,'/api/product/') === 0){
            //Extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) -1];

            $controller = new ProductController();
            echo $controller->getbyId($id);
        }

        //Jika request method POST dan path sama dengan 'api/product'
        if ($method === 'POST' && $path === '/api/product'){
            $controller = new ProductController();
            echo $controller->insert();
        }

        //Jika request method PUT dan path mengandung 'api/product'
        if ($method === 'PUT' && strpos($path,'/api/product/') === 0){
            //Extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) -1];

            $controller = new ProductController();
            echo $controller->update($id);
        }

           //Jika request method DELETE dan path mengandung 'api/product'
           if ($method === 'DELETE' && strpos($path,'/api/product/') === 0){
            //Extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) -1];

            $controller = new ProductController();
            echo $controller->destroy($id);
        }
    }
}