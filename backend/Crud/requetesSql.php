<?php
function alter($pdo, $table, $requete, $alteration) {
    try {
        $sql = "ALTER TABLE $table $requete $alteration ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}

function update($pdo, $table, $column, $value, $id) {
    try {
        $sql = "UPDATE $table SET $column = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$value, $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}