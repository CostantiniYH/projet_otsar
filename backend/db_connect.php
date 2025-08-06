<?php
define('BASE_URL', '/projet_otsar/');
function connect() {
    try {
        $dsn = "mysql:host=localhost;dbname=otsar";
        $user = "root";
        $password = "";

        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
function getAll($pdo, $table) {
    try {
        $sql = "SELECT * FROM $table";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function findBy2($pdo, $table, $champ, $value) {
    try {
        $value = trim($value);
        $sql = "SELECT * FROM $table WHERE $champ = ?"; // Sélectionner toutes les colonnes

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les lignes correspondantes
        return $result;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
function insert($pdo, $table, $data) {
    try {
        $column = implode(',', array_keys($data));
        $value = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($column) VALUES ($value)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute(array_values($data))) {
            return $stmt->rowCount();
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        echo "SQL : " . $sql . "\n";
        return false;
    }
}


function insertUser($pdo, $nom, $prenom, $email, $password) {
    try {
        $sql = "INSERT INTO t_users (nom, prenom, mail, passwd) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $password]);
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

function getUser($pdo) {
    try {
        $sql = "SELECT * FROM t_users";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
    } catch (PDOException $e) {
        die("Erreur de récupération des données d'utilisateur : " . $e->getMessage());
    }
}