<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
    $id = $_GET['questionid'];
    $sql = "SELECT * FROM `threads` WHERE question_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $qtitle = $row['question_title'];
        $qdesc = $row['question_desc'];
        $quser = $row['question_user_name'];
        $qdate = $row['date'];
    }
    ?>

    <?php
        $showAlert = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $answer = $_POST['answer'];
        $sql = "INSERT INTO `answers` (`answer_content`, `question_id`, `date`) VALUES ('$answer', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    
    ?>

    <div class="container">
        <div class="p-5 bg-light rounded-3 shadow-lg my-4">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"><?php echo $qtitle; ?></h1>
                <p class="col-md-8 fs-4"><?php echo $qdesc; ?></p>
                <hr>
                <p>Keep it friendly / Be courteous and respectful / Appreciate that others may have an opinion different
                    from yours / Stay on topic / Share your knowledge / Refrain from demeaning, discriminatory, or
                    harassing behaviour and speech.</p>
                <a class="btn text-success btn-lg">Posted by @<?php echo $quser . " at " . $qdate; ?></a>
            </div>
        </div>
    </div>
    <div class="container mb-5" id="qhight">
        <h1 class="py-2">Discussion</h1>
        <?php 
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Answer has been added.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <div class="form-floating mb-3">
                <textarea class="form-control" name="answer" placeholder="Write your answer here"
                    id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Elaborate Your Problem</label>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <h1 class="py-2">Browse Answer</h1>
        <?php
        $id = $_GET['questionid'];
        $sql = "SELECT * FROM `answers` WHERE question_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $answer = $row['answer_content'];
            $date = $row['date'];
            $id = $row['answer_id'];
            echo '<div class="d-flex align-items-center my-3">
                <div class="flex-shrink-0">
                    <img src="src/img/userdefault.jpeg" width="40px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                <p class="m-0">at '.$date.'</p>
                    '.$answer.'
                </div>
            </div>';
    }
    if($noResult){
        echo '<div class="alert alert-dark my-3" role="alert">
        <h3>No Answer Found!</h3>
        <hr class="my-2">
        <h6>Be the first person to ask a question</h6>
      </div>';
    }
    ?>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>