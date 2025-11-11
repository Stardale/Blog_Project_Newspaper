<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("layout/head.php");
    ?>
</head>

<body class="sb-nav-fixed">
   <?php 
       include ("layout/header.php")
     ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- left sidebar -->
            <?php
            include("left_sidebar.php");
            ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mt-4">Category</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Category</li>
                            </ol>

                        </div>
                        <div>
                            <a href="addCategory.php" class="btn btn-primary">Add Category</a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Category List
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_SESSION['success'])){?>
                                    <h5 class="text-success"><?= $_SESSION['success'];?></h5>
                              <?php   
                                unset($_SESSION['success']);
                            }
                            ?>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Post Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql = "SELECT * FROM category";
                                     $result = $conn->query($sql);
                                     if($result->rowCount()>0){         
                                        $i=1;                             
                                         while ($category = $result->fetch(PDO::FETCH_OBJ)) {?>
                                                <tr>
                                                    <td><?php echo $i++ ?></td>
                                                    <td><?php echo $category->name ?></td>
                                                    <td><?php echo $category->slug ?></td>
                                                    <td></td>
                                                    <td>
                                                        <a href="editCategory.php?id=<?php echo $category->id;?>" class="btn btn-success">Edit</a>
                                                        <a onclick ="return confirm('Are you sure to delete?')" href="categoryDelete.php?id=<?php echo $category->id?>" class="btn btn-danger">Delete</a>
                                                    </td>                              
                                                </tr>
                                        <?php   }
                                     }            
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <!-- footer -->
            <?php
            include("layout/footer.php");
            ?>
        </div>
    </div>



    <?php
    include("layout/_script.php");
    ?>
</body>

</html>