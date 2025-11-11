 <?php
   session_start();
  $filePath = realpath(dirname(__FILE__));
    include( $filePath."/../lib/connection.php");  
    if(isset($_GET['id']) && $_GET['id'] !=''){
        $id = $_GET['id'];
        $sql = "DELETE FROM tag WHERE id=:tagId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tagId', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success']="Tag delete successfully";
        header("location:tag.php");
    }
?>