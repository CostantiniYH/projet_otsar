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

function findBy($pdo, $table, $field, $value) {
    try {
        $sql = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les lignes correspondantes
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
function findBy2($pdo, $table, $champ, $id) {
    try {
        $sql = "SELECT $table.*, c.nom AS nom_categorie FROM $table
        INNER JOIN t_categories c ON $table.id_categorie = c.id WHERE $table.$champ = ?"; // Sélectionner toutes les colonnes

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

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

function getLivre($pdo) {
    try {
        $sql = "SELECT l.*, c.nom AS nom_categorie, s_c.nom AS nom_s_categorie, s_s_c.nom AS 
        nom_s_s_categorie, s_s_s_c.nom AS nom_s_s_s_categorie
                FROM t_livres l
                LEFT JOIN t_categories c ON l.id_categorie = c.id
                LEFT JOIN t_s_categories s_c ON l.id_s_categorie = s_c.id
                LEFT JOIN t_s_s_categories s_s_c ON l.id_s_s_categorie = s_s_c.id
                LEFT JOIN t_s_s_s_categories s_s_s_c ON l.id_s_s_s_categorie = s_s_s_c.id";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de récupération des livres : " . $e->getMessage());
    }
}

function getLivreByCategorieId($pdo, $id) {
    try {
        $sql = "SELECT l.*, c.nom AS nom_categorie, s_c.nom AS nom_s_categorie, s_s_c.nom AS 
        nom_s_s_categorie, s_s_s_c.nom AS nom_s_s_s_categorie
                FROM t_livres l
                LEFT JOIN t_categories c ON l.id_categorie = c.id
                LEFT JOIN t_s_categories s_c ON l.id_s_categorie = s_c.id
                LEFT JOIN t_s_s_categories s_s_c ON l.id_s_s_categorie = s_s_c.id
                LEFT JOIN t_s_s_s_categories s_s_s_c ON l.id_s_s_s_categorie = s_s_s_c.id
                WHERE l.id_categorie = ? OR l.id_s_categorie = ? OR l.id_s_s_categorie = ? OR 
                l.id_s_s_s_categorie = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de récupération des livres par catégorie : " . $e->getMessage());
    }
}