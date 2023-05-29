<?php


  $insert = false;
  $delete = false;
//----------------Connection to data base------------//
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "notes";

  $conn = mysqli_connect($servername,$username,$password,$database);

  if(!$conn){
    die("Sorry we failed to connect:". mysqli_connect_error());
  }
  ///////////////////////////////////////////////////////


  //------------Delete data from data base----------------//

  if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `notes` WHERE `S-no` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
      //echo "The record was inseted successfully";
      $delete = true;
    }
    else{
      echo "Record was not deleted successfully because of error ---->". mysqli_error($conn);
    }
  }
  /////////////////////////////////////////////////////////////////////////

  // ------------Edit data from database-----------------//
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset( $_POST['snoEdit'])){
      $sno = $_POST["snoEdit"];
      $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];
    
    $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`S-no` = $sno";
    $result = mysqli_query($conn,$sql);
    if($result){
      echo "we updated the result successfully";
    }
    else{
      echo "Record not updated sorry";
    }
    }
    ////////////////////////////////////////////////////////

    //-------------------Insert data to database-----------------//
    else{
    $title = $_POST["title"];
    $description = $_POST["description"];
    
    $sql = "INSERT INTO `notes`(`title`,`description`)VALUES ('$title','$description')";
    $result = mysqli_query($conn,$sql);

    if($result){
      //echo "The record was inseted successfully";
      $insert = true;
    }
    else{
      echo "Record was not inserted successfully because of error ---->". mysqli_error($conn);
    }

  }
}
/////////////////////////////////////////////////////////////
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <title>iNotes</title>
    
</head>
<body class="bg-dark">



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
<!-- ----------nav----end-- -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->


<!-- ----------------Edit Modal---------------- -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      
        <h5 class="modal-title" id="exampleModalLabel">Edit this note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
      <form action="/CRUD/index.php" method="post" >
        <input type="hidden" name="snoEdit" id="snoEdit">
      <label for="exampleInputEmail1" class="form-label">Note title</label>
      <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Note description</label>
      <textarea type="text" class="form-control" id="descriptionEdit" name="descriptionEdit"></textarea>
    </div>
    <div class="d-flex justify-content-end "><button type="submit" class="btn btn-primary me-2">Update note</button> <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button></div>
      </div>
  </form>
    </div>
  </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////////// -->


<!-- --------------Success notificaton for update and delete -->
  <?php
  ///////////////////////////Update/////////////////////////////////
  if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Note saved successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  //////////////////////////////Delete/////////////////////////////////
  if($delete){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Note Deleted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
?>
<!-- ////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////Note Form/////////////////////////// -->
<!-- ----------------note -->
<form action="/CRUD/index.php" method="post" class=" text-white mb-10">
    <div class="mb-3 mx-5 mt-5">
        <h1 class="mx-2">Add a note</h1>
      <label for="exampleInputEmail1" class="form-label">Note title</label>
      <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
    </div>
    <div class="mb-3 mx-5">
      <label for="exampleInputPassword1" class="form-label">Note description</label>
      <textarea type="text" class="form-control" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mx-5">Add note</button><br><br>
  </form>
<div class="container mt-5 bg-white pt-3 border rounded">


<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S-no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php

  $sql = "SELECT * FROM `notes`";
  $result = mysqli_query($conn,$sql);
  $sno = 0;
  while($row = mysqli_fetch_assoc($result)){
    $sno = $sno + 1;
    echo " <tr>
    <th scope='row'>".$sno ."</th>
    <td>" . $row['title'] ."</td>
    <td>".$row['description'] ."</td>
    <td> <button class='edit btn btn-sm btn-primary' id = ".$row['S-no'].">Edit</button> <button class='delete btn btn-sm btn-primary' id = d" .$row['S-no'].">Delete</button> </td>
  </tr>";
  }
?>
  <!-- ///////////////////////////////////////////////////////////////////////// -->
    
  </tbody>
</table>
</div>
  
<!-- ----------------JS for edit function -->
<script>
     edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("edit");
    tr = e.target.parentNode.parentNode;
    title = tr.getElementsByTagName("td")[0].innerText;
    description = tr.getElementsByTagName("td")[1].innerText;
    console.log(title, description);
    document.getElementById('titleEdit').value = title;
    document.getElementById('descriptionEdit').value = description;
    document.getElementById('snoEdit').value = e.target.id;
    $('#editModal').modal('toggle');
    console.log(e.target.id);
  });
});

// /////////////////////   JS for delete function/////////////////////////////
deletes = document.getElementsByClassName('delete');

Array.from(deletes).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("delete");
    sno = e.target.id.substr(1,);
   
    if(confirm("Are you sure you want to delete!")){
      console.log("Yes");
      window.location = `/CRUD/index.php?delete=${sno}`;
    }
    else{
      console.log("No");
    }
  });
});


    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"> </script>
    <script>
      /////////////////////    Data TAble /////////////////////////
      let table = new DataTable('#myTable');
      $('#myTable').DataTable();
    </script>

    
<!-- --------------------          END            ----------------------- -->
</body>
</html>