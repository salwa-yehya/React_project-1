
<?php require('config.php');?>

<?php
error_reporting(E_ALL);
ini_set('display_error',1);
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Origin:*');

$object = new crud;
$conn = $object->connect();


$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case "GET":

      
            $path = explode('/',$_SERVER['REQUEST_URI']);
            // print_r($path);
            $sql = "SELECT *
            FROM groups
            INNER JOIN users
            ON groups.user_id = users.id
            WHERE groups.group_id=:id";
            $stmt =$conn->prepare($sql);
            $stmt->bindParam(':id', $path[5]);

            $stmt->execute();

            $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode( $members);
    
        break;

    }