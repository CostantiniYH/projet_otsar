<?php
class User {
    private $nom;
    private $prenom;
    private $mail;
    private $passwd;
    public $error = [];

    public function __construct($nom, $prenom, $mail, $passwd) {
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($mail);
        $this->setPassword($passwd);
    }

    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->mail; }
    public function getPassword() { return $this->passwd; }
    public function getError() { return $this->error; }
    
 
    public function setNom($nom) {
        if (strlen($nom) < 2) {
            $this->error[] = "Le nom doit contenir au moins 2 caractères";
        } else {
            $this->nom = htmlspecialchars($nom);
        }
    } 
    public function setPrenom($prenom) {
        if (strlen($prenom) < 2) {
            $this->error[] = "Le prénom doit contenir au moins 2 caractères";
        } else {
            $this->prenom = htmlspecialchars($prenom);
        }
    }
    public function setEmail($mail) {
        $verif = $this->validateEmail($mail);
        if ($verif == false) {
            return $this->setError("L'adresse email n'est pas valide");
        }
        $this->mail = htmlspecialchars($mail);
        return $this->mail = $mail;
        
    }
    private function validateEmail($mail) {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function setPassword($passwd) {
        if (strlen($passwd) < 8) {
            return $this->setError("Le mot de passe doit contenir au moins 8 caracteres");
        }
        $passwd = $this->hashPassword($passwd);
        $this->passwd = $passwd;
        return $this->passwd;        
    }
    public function hashPassword($passwd) {
        return password_hash($passwd, PASSWORD_ARGON2ID);
    }
    public static function verifyPassword($passwd, $hash) {
        if (password_verify($passwd, $hash)) {
            return true;
        } else {
            return false;
                }
            }
    public function setError($error) {
        return array_push($this->error, $error);
    }
}