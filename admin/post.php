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
                            <h1 class="mt-4">Post</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Post</li>
                            </ol>

                        </div>
                        <div>
                            <a href="addPost.php" class="btn btn-primary">Add Post</a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Post List
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
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Post Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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