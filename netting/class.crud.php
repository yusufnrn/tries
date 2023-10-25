<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Oturum başlatılmamışsa başlat
}

// Diğer kodlar burada devam eder

require_once 'dbconfig.php';

class Crud {
    private static $stmt;
    private static $crud;
    private function __construct() {}


    public static function init() {
        // Veritabanı bağlantısını başlatın ve $crud özelliğini ayarlayın.
        try {
            $dsn = 'mysql:host=localhost;dbname=panel';
            $username = 'root';
            $password = '';
            self::$crud = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            // Bağlantı hatası yönetimi
            echo 'Bağlantı hatası: ' . $e->getMessage();
        }
    }
    public static function addValue($argse){
        $values = implode(',',array_map(function ($item){
            return $item.'=?';
        },array_keys($argse)));
        return $values;
    }
    public static function insert($table, $values, $options = []) {

            if (isset($options['pass'])){
                $values[$options['pass']]=md5($values[$options['pass']]);
            }
            unset($values[$options['form_name']]);
            $valueString = self::addValue($values);
            $query = "INSERT INTO $table SET $valueString";


        try {

            if (!empty($_FILES[$options['file_name']]['name'])) {
                try {
                    $izinli_uzantilar = [
                        'jpg',
                        'jpeg',
                        'png',
                        'ico'];

                    $ext = strtolower(substr($_FILES[$options['file_name']]['name'], strpos($_FILES[$options['file_name']]['name'], '.') + 1));

                    if (in_array($ext, $izinli_uzantilar) === false) {
                        throw new PDOException('Bu dosya türü kabul edilmemektedir...');
                    }
                    if ($_FILES[$options['file_name']]['size'] > 4448576) {
                        throw new PDOException('Dosya boyutu çok büyük...');
                    }

                    $tmp_name = $_FILES[$options['file_name']]['tmp_name'];
                    $name = uniqid().".".$ext;

                    if (!@move_uploaded_file($tmp_name, "dimg/{$options['dir']}/$name")) {
                        throw new PDOException('Dosya yükleme hatası...');
                    }
                    $values += [$options['file_name'] => $name];

                } catch (PDOException $e) {
                    return ['status' => FALSE, 'error' => $e->getMessage()];
                }
            }



            $stmt = self::$crud->prepare($query);
            $stmt->execute(array_values($values));

            return ['status' => TRUE];
        } catch (Exception $e) {
            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }


//    public static function adminInsert($admins_namesurname,$admins_username,$admins_pass,$admins_status){
//        try {
//            self::$stmt =self::$crud->prepare("INSERT INTO admins SET admins_namesurname=?,admins_username=?,
//            admins_pass=?,admins_status=?");
//            self::$stmt->execute([$admins_namesurname,$admins_username,md5($admins_pass),$admins_status]);
//
//            return ['status' => TRUE];
//        }catch(Exception $e){
//            return ['status' => FALSE, 'error' => $e->getMessage()];
//        }
//
//    }

    public static function adminsLogin($admins_username, $admins_pass,$remember_me) {
        try {
            self::$stmt = self::$crud->prepare("SELECT * FROM admins WHERE admins_username=? AND admins_pass=? ");


            if (isset($_COOKIE['adminsLogin'])){
                self::$stmt->execute([$admins_username, md5(openssl_decrypt($admins_pass, "AES-128-ECB","admins_coz"))]);

            }else{
                self::$stmt->execute([$admins_username, md5($admins_pass)]);

            }

            if (self::$stmt->rowCount() == 1) {
                $row = self::$stmt->fetch(PDO::FETCH_ASSOC);
                if($row['admins_status']==0){
                    return ['status'=>FALSE];
                    exit;
                }

                $_SESSION["admins"] = [
                    "admins_username" => $admins_username,
                    "admins_namesurname" => $row['admins_namesurname'],
                    "admins_file" => $row['admins_file'],
                    "admins_id" => $row['admins_id']
                ];


                if (!empty($remember_me) AND empty($_COOKIE['adminsLogin'])){
                $admins=
                    [
                    "admins_username"=>$admins_username,
                    "admins_pass" => openssl_encrypt($admins_pass,"AES-128-ECB","admins_coz")
                ];
                setcookie('adminsLogin',json_encode($admins),strtotime("+30 day"),"/");
                }elseif(empty($remember_me)){
                    setcookie('adminsLogin',json_encode($admins),strtotime("-30 day"),"/");
                }

                return ['status' => TRUE];
            } else {
                return ['status' => FALSE];
            }
        } catch (Exception $e) {
            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    public static function read($table){

        try {
            self::$stmt = self::$crud->prepare("SELECT * FROM $table");
            self::$stmt->execute();

            return self::$stmt;
        }catch (Exception $e){
        echo $e->getMessage();
        return false;
        }

    }

}



?>