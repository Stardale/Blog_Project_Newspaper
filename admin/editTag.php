<!DOCTYPE html>
<html lang="en">

<head>
    <?php
     include("layout/head.php"); 

    /* form submit */
    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name    = validate($_POST['name']);
        $slug    = validate($_POST['slug']);
        $id      = $_POST['tagId'];


        if (empty($name)) {
            $errors['name'] = 'Category name is required';
        } else {
            $data['name'] = $name;
        }

        if (empty($slug)) {
            $errors['slug'] = 'Slug is required';
        } else {
            $data['slug'] = $slug;
        }


        if (empty($errors)) {

            /* check email and password */
            $sql = "UPDATE tag SET name=:name,slug=:slug WHERE id=:tagId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':slug', $data['slug'], PDO::PARAM_STR);
            $stmt->bindParam(':tagId',$id, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['success'] = 'Tag update successfully';
            header('Location: tag.php');
        }
    }
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
                            <h1 class="mt-4">Tag</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Tag</li>
                            </ol>

                        </div>
                        <div>
                            <a href="tag.php" class="btn btn-warning">Back to Tag</a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Tag Edit
                        </div>
                        <div class="card-body">
                             <!-- Get url param id and select category from this id -->
                            <?php
                                if(isset($_GET['id']) && $_GET['id'] !=''){
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM tag WHERE id=:tagId";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':tagId', $id, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $tag = $stmt->fetch(PDO::FETCH_OBJ);
                                    $data['name'] = $tag->name;
                                    $data['slug'] = $tag->slug;
                                    $id = $tag->id;
                                }
                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                <!-- category id -->
                                 <input type="hidden" name="tagId" value="<?= $id ; ?>">
                                <div class="mb-3">
                                    <label for="name">Tag Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $data['name']??''; ?>">
                                    <span class="text-danger"><?php echo $errors['name'] ?? ''; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Tag Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="<?= $data['slug']??''; ?>">
                                    <span class="text-danger"><?php echo $errors['slug'] ?? ''; ?></span>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
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
    <!-- jQuery cnd -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $("#name").on("keyup", function() {
                let textVal = $(this).val().trim();

                // Convert English letters to lowercase (Bangla unaffected)
                textVal = textVal.replace(/[A-Z]/g, c => c.toLowerCase());

                // Replace all spaces or punctuation between words with a single dash
                // \s = whitespace, \p{P} = punctuation (Unicode)
                textVal = textVal.replace(/[\s\p{P}]+/gu, '-');

                // Remove any leading/trailing dashes
                textVal = textVal.replace(/^-+|-+$/g, '');

                $("#slug").val(textVal);
            });


        });
    </script>
</body>

</html>