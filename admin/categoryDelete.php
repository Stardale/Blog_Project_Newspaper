 <?php
   session_start();
  $filePath = realpath(dirname(__FILE__));
    include( $filePath."/../lib/connection.php");  
                                if(isset($_GET['id']) && $_GET['id'] !=''){
                                    $id = $_GET['id'];
                                    $sql = "DELETE FROM category WHERE id=:categoryId";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':categoryId', $id, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $_SESSION['success']="Category delete successfully";
                                    header("location:category.php");
                                }
                            ?>