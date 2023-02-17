<?php
// require_once 'classes/Users.php';
require_once 'db.php';

// $db = new User();
$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == 'view') {
  $output = '';
  $data = $db->read();
  // print_r($data);
  # code...

  if ($db->totalRowCount() > 0) {
    # code...
    $output  .= '
    
    <table class="table table-striped table-sm table-bordered">
    <thead>
      <tr class="text-center ">
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>E-mail</th>
        <th>Phone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($data as $row) {
      $output .= '<tr class="text-center text-secondary">
      <td>'.$row['id'].'</td>
      <td>'.$row["firstname"].'</td>
      <td>'.$row["lastname"].'</td>
      <td>'.$row["email"].'</td>
      <td>'.$row["phone"].'</td>;
      <td>
          <a href="#" title="View Details" class="text-success"><i
              class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
          <a href="#" title="Edit" class="text-primary"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
          <a href="#" title="Delete" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
        </td> 
        </tr> ';
    }

    $output .= '</tbody></table>';
    echo $output;
    
  }

  else {
    echo '<h3  class="text-center text-secondary" mt-5>:(No User Found in the Database!</h3>';
  }
    
}

if (isset($_POST['action']) && $_POST['action'] == "insert") {
  $firstname = $_POST['firstname']; 
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $db->insert($firstname ,$lastname, $email, $phone);



  // $fields = [
  //   'firstname' => $firstname,
  //   'lastname' => $lastname,
  //   'email' => $email,
  //   'phone' => $phone

  // ];


  // $insert = $db->insert($fields);

  // if ($insert) {
  //   echo "Data Inserted";
  // }

  // else {
  //   echo "Data NOT inserted";
  // }
  
}