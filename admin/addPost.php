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



        if (empty($name)) {
            $errors['name'] = 'Tag name is required';
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
            $sql = "INSERT INTO tag(name,slug) VALUES(:name,:slug)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':slug', $data['slug'], PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['success'] = 'Tag added successfully';
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
                            <h1 class="mt-4">Post</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Post</li>
                            </ol>

                        </div>
                        <div>
                            <a href="post.php" class="btn btn-warning">Back to Post</a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                           Create New Post
                        </div>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                               <div class="row">
                                <div class="col-md-8">
                                     <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?= $data['title']??''?>">
                                    <span class="text-danger"><?php echo $errors['title'] ?? ''; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="<?= $data['slug']??''?>">
                                    <span class="text-danger"><?php echo $errors['slug'] ?? ''; ?></span>
                                </div>

                                 <div class="mb-3">
                                    <label for="slug" class="form-label">Description</label>
                                     <textarea name="description" id="description" class="form-control" rows="10"><?php echo $data['description']??''?></textarea>
                                    <span class="text-danger"><?php echo $errors['slug'] ?? ''; ?></span>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </div>
                                <div class="col-md-4">                                 
                                    <div class="mb-3">
                                        <label for="" class="form-label">Select Category</label>
                                        <select name="category" id="category" class="form-select">
                                            <option value="" selected disabled>Select Category</option>
                                         <?php 

                                         $sql = "SELECT * FROM category";
                                     $result = $conn->query($sql);
                                     if($result->rowCount()>0){         
                                        $i=1;                             
                                         while ($category = $result->fetch(PDO::FETCH_OBJ)) {?>
    `                                       <option value="<?= $category->id?>"><?= $category->name; ?></option>
                                         <?php
                                         }
                                         }
                                         ?>
                                        </select>
                                    </div>

                                </div>
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