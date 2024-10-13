<?php

include __DIR__ . '/../Database/Database.php';


class Model extends Database{

    private static $table = 'patients';
    private static $table_viloyat = 'viloyat';
    private static $table_tuman = 'tuman';
    private static $table_drugs = 'drugs';

    public static function get_all(){
        $sql =  "SELECT * FROM ".self::$table;
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function get_viloyat() {
        $sql = "SELECT * FROM viloyatlar";
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get_tuman_by_viloyat($viloyat_id) {
        $sql = "SELECT * FROM tumans WHERE viloyat_id = :viloyat_id";
        $stmt = self::getConnection()->prepare($sql);
        $stmt->bindParam(':viloyat_id', $viloyat_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function register_patient($name, $surname, $email, $phone, $password, $viloyat_id, $tuman_id) {
        $sql = "INSERT INTO patients (name, surname, email, phone, password, viloyat_id, tuman_id) 
                VALUES (:name, :surname, :email, :phone, :password, :viloyat_id, :tuman_id)";
        $stmt = self::getConnection()->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':viloyat_id', $viloyat_id);
        $stmt->bindParam(':tuman_id', $tuman_id);

        return $stmt->execute();
    }
    public static function get_tuman($viloyat_id) {
        try {
            $sql = "SELECT * FROM " . self::$table_tuman . " WHERE viloyat_id = :viloyat_id";
            $query = self::getConnection()->prepare($sql);
            $query->bindParam(':viloyat_id', $viloyat_id, PDO::PARAM_INT);
            $query->execute();
            
            // Debugging output to check for errors
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                echo "No tumans found for viloyat_id: " . htmlspecialchars($viloyat_id);
            }
            return $result;
        } catch (PDOException $e) {
            // Debugging error message
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    

        private static $table_patients = 'patients';

    public static function login($phone, $password) {
        $sql = "SELECT * FROM " . self::$table_patients . " WHERE phone = :phone";
        $stmt = self::getConnection()->prepare($sql);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; 
        }

        return false;
    }

    public static function get_drugs(){
        $sql = 'SELECT * FROM ' . self::$table_drugs;
        $query = self::getConnection()->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function get_drug_by_id($id){
        $sql = 'SELECT * FROM ' . self::$table_drugs . " Where id = :id";
        $query = self::getConnection()->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
}