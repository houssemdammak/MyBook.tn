<?php

class ControllerSession  {
    public static function startSession() {
        session_start();
    }

    public static function setClientData($clientData) {
        $_SESSION['client_data'] = $clientData;
    }

    public static function getClientData() {
        return isset($_SESSION['client_data']) ? $_SESSION['client_data'] : null;
    }

    public static function isSessionEmpty() {
        return empty($_SESSION['client_data']);
    }

    public static function destroySession() {
      session_unset(); 
      session_destroy();
        
    }
}/*
session_start();
require('..\models\Database.php');
$db =DataBase::getInstance();
$loginError = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
  if ($db->getConnection()) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($db->logIn("users", $username, $password)) {
      // Vérification de l'option "Remember me"
      if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
        // Créez une session pour l'utilisateur
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

      }

    } else {
      $loginError = "Username or Password wrong"; // Message d'erreur en anglais
      */