<?php
// CONTROLADOR HOME 
// Carga el modelo de productos para acceder a los datos
require_once __DIR__ . '/../models/ProductModel.php';

class IndexController
{
    //Obtiene el listado de productos y carga la vista asociada
    public static function index(mysqli $db): void
    {
        $products = ProductModel::getAll($db);
        require __DIR__ . '/../views/IndexView.php';
    }
}