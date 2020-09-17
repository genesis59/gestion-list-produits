<?php
/*********  fonctions CRUD  **************/

// ajouter un produit à la BD
function addProduct($db){
    $query = $db->prepare("INSERT INTO products(product_name,price,category) 
    VALUES (:product_name,:price,:category)");
    $query->bindValue(':product_name', $_POST["product_name"], PDO::PARAM_STR);
    $query->bindValue(':price',$_POST["price"]);
    $query->bindValue(':category', $_POST["category"], PDO::PARAM_STR);
    $query->execute();
}
// Vérification par le nom si la ligne n'existe pas dans la BD
function searchProductByName($db){
    $testName = $db->prepare("SELECT * FROM products WHERE product_name = ?");
    $testName->execute([$_POST['product_name']]);
    $verif = $testName->fetch(PDO::FETCH_ASSOC);
    if(empty($verif)){
        return true;
    }
    return false;
}
// Vérification par l'id existe dans la BD
function searchProductById($db,$id){
    $testName = $db->prepare("SELECT * FROM products WHERE id = ?");
    $testName->execute([$id]);
    $verif = $testName->fetch(PDO::FETCH_ASSOC);
    if(empty($verif)){
        return false;
    }
    return true;
}

// Supprimer un produit
function deleteProduct($db){
    $db->exec("DELETE FROM products WHERE id=" . $_POST['sup']);
}

function updateProduct($db){
    $query = $db->prepare("UPDATE products SET product_name=:product_name,price=:price,category=:category WHERE id=:id");
    $query->bindValue(':id', $_POST["id"], PDO::PARAM_INT);
    $query->bindValue(':product_name', $_POST["product_name"], PDO::PARAM_STR);
    $query->bindValue(':price',$_POST["price"] );
    $query->bindValue(':category', $_POST["category"], PDO::PARAM_STR);
    $query->execute();  
}

function getList($db){
    // Récupération de tous les articles
    $query = $db->query('SELECT * FROM products');
    $query->execute();
    // Création d'un tableau pour stocker les lignes
    $productsList = [];
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        array_push($productsList,$row);
    }
    return $productsList;
}