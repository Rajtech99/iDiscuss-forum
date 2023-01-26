<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        #qhight {
            min-height: 433px;
        }
    </style>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php
    $id = $_GET['cateid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catename = $row['category_name'];
        $catedesc = $row['category_description'];
    }
    ?>

    <?php
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` (`question_title`, `question_desc`, `question_user_name`, `question_category_id`, `date`) VALUES ('$title', '$desc', 'anyone', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }

    ?>

    <div class="container">
        <div class="p-5 bg-light rounded-3 shadow-lg my-4">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Welcome to <?php echo $catename; ?> Forums</h1>
                <p class="col-md-8 fs-4"><?php echo $catedesc; ?></p>
                <hr>
                <p>Keep it friendly / Be courteous and respectful / Appreciate that others may have an opinion different
                    from yours / Stay on topic / Share your knowledge / Refrain from demeaning, discriminatory, or
                    harassing behaviour and speech.</p>
                <a href="/forums" class="btn btn-success btn-lg" type="button">Browse Topic</a>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<div class="container">
            <h1 class="py-2">Start Discussion</h1>
            <form action='.$_SERVER["REQUEST_URI"].' method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as short ans as crisp as possible.</div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="desc" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Elaborate Your Problem</label>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>You are not Login!</strong> To add Questions to community please.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
            <?php
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            <strong>Success!</strong> Your Question has been added. Please wait for community to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            }
            ?>
        </div>
        <div class="container mb-4"  id="qhight">
            <h1 class="py-2">Browse Questions</h1>
            <?php
            $id = $_GET['cateid'];
            $sql = "SELECT * FROM `threads` WHERE question_category_id=$id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $question_title = $row['question_title'];
                $question_description = $row['question_desc'];
                $date = $row['date'];
                $id = $row['question_id'];


                echo '<div class="d-flex align-items-center my-3">
                    <div class="flex-shrink-0">
                        <img src="src/img/userdefault.jpeg" width="40px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="h6 my-0"><strong><a href="question.php?questionid=' . $id . '">' . $question_title . '</a></strong> ' . $date . '</p>
                        ' . $question_description . '
                    </div>
                </div>';
            }
            if ($noResult) {
                echo '<div class="alert alert-dark my-3" role="alert">
                    <h3>No Question Found!</h3>
                    <hr class="my-2">
                    <h6>Be the first person to ask a question</h6>
                    </div>';
                    }
            ?>
        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>