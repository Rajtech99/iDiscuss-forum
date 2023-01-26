<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forums">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forums">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
    <div class="d-md-flex justify-content-md-end">';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      <p class="text-light my-auto mx-2">Welcome '.$_SESSION['useremail'].'</p></form>
      <a class="btn btn-outline-success mx-1" href="logout.php">Logout</a>
    ';
    }
    else{
      echo '<form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
    <button class="btn btn-outline-success mx-1" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
    </div>';
    }
  
  echo '</div>
</div>
</nav>';

include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == true){
  echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>Account created successfully!</strong> Now proceed to login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
            <strong>Logged In!</strong> Activate All Actions.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

?>