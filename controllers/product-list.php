<?php
require "../models/dao.php";
// Définition d'un tableau des erreurs
$errors = [];
$success = [];
$errorPDO = "Désolé impossible de communiquer avec la base de données";

try {
    // Création d un objet connexion
    $db = new PDO('mysql:host=localhost;dbname=formation','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /************ READ BD ******************/
    //  Récupération d'un tableau des produits de la BD
    $productsList = getList($db);


    // true si un formulaire est posté
    $isPosted = count($_POST) > 0;


    // Test si un formulaire a été posté
    if($isPosted){

        /************ UPDATE ******************/
        // IF demande de modification la clé id n'existe que dans le formulaire modification
        if(isset($_POST['id'])){
            $id = (int) $_POST['id'];
            if(!empty($_POST["product_name"]) && !empty($_POST["price"]) && $_POST["category"] != "Choisissez une catégorie..."){
                // Vérification que l'id existe dans la BD
                $exist = searchProductById($db,$_POST["id"]);
                if($exist){
                    updateProduct($db);
                    $productsList = getList($db);
                    array_push($success,"La modification a bien été enregistrée");
                } else {
                    array_push($errors,"Désolé la Réference renseignées n'existe pas");
                }/****** endif vérification que le produit existe  *****/
            } else {
                array_push($errors,"Veuillez renseigner tous les champs pour la modification");
            }/****** endif test des champs de modification *****/
        }/****** endif isset($_POST['id'])  *****/

        /************ DELETE ******************/
        // IF demande de suppression si name bouton = sup
        if(isset($_POST['sup'])){
            deleteProduct($db);
            $productsList = getList($db);
            array_push($success,"La suppression a bien été enregistrée");
        }

        /************ CREATE ******************/
        // IF demande d'ajout si si name bouton = add
        if(isset($_POST['add'])){
            // test si toutes les données sont renseignées
            if(!empty($_POST["product_name"]) && !empty($_POST["price"]) && $_POST["category"] != "Choisissez une catégorie..."){
                // test si l'article est déjà existant dans la bd
                $verif = searchProductByName($db);
                // si le produit n'existe pas on l'ajoute
                if($verif){
                    // ajout du produit à la base de données
                    addProduct($db);
                    $productsList = getList($db);
                    array_push($success,"La produit a bien été enregistrée");
                // sinon l'article existe création d'une erreur
                } else {
                    array_push($errors,"Désolé l'article existe déjà");
                } /***  endif  */
            // sinon si les champs ne sont pas tous renseignés création d'une erreur
            } else {
                array_push($errors,"Veuillez renseigner tous les champs pour l'ajout");
            } /**** endif test données renseignés bouton add */
        }/**** endif isset($_POST['add']) ***/   
    } /****** endif($isPosted)   ******/


} catch(PDOException $err){
    // Affichage d'une erreur si impossible de se connecter à la BD
    array_push($errors,$errorPDO);
} /*** end try catch pdo */

include "../views/view-product-list.php";