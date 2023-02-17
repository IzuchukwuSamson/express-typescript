<?php
require_once("Database.php");

class User  {
  private $db;

  function __construct() {
    $this->db = new Database;
  }

  // function insert($data){

    public function insert($firstname, $lastname, $email, $phone) {
      $query = "INSERT INTO users (firstname, lastname, email, phone) VALUES (?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param("sss", $firstname, $lastname, $email, $phone);
      $stmt->execute();
      $stmt->close();
    

    // $implodeColumns = implode(',', array_keys($data));
    // $implodePlaceholder = implode(', :', array_keys($data));

    // $this->db->query("INSERT INTO users ($implodeColumns) VALUES (:".$implodePlaceholder.')');
    // // $stmt = $this->db->query($sql);



    // foreach ($data as $key => $value) {
    //   $this->db->bind(':'.$key, $value);

    // }

    // if ($this->db->execute()) {
    //   return true;
    // }
    // else {
    //   return false;
    // }

    // $this->db->query("INSERT INTO users(firstname,lastname, email, phone) VALUES (:firstname, :lastname, :email, :phone )");
   
    // $firstName = array($this->db->bind(":firstname", ($data['firstname'])));
    // $lastname  = array($this->db->bind(":lastname", ($data['lastname'])));
    // $email = array($this->db->bind(":email", ($data['email'])));
    // $phone = array($this->db->bind(":phone", ($data['phone'])));

    // echo $firstName;


    
    // $this->db->bind(":firstname", $data['firstname']);
    // $this->db->bind(":lastname", $data['lastname']);
    // $this->db->bind(":email", $data['email']);
    // $this->db->bind(":phone", $data['phone']);

    // if ($this->db->execute()) {
    //   return true;
    // }
    // else {
    //   return false;
    // }
  }

  function read(){
    $this->db->query("SELECT * FROM users");
    return $this->db->resultSet();
  }

  function readOne(){
    $this->db->query("SELECT * FROM users WHERE id = :id");
    $this->db->bind(':id', $id);

    return $this->db->single();
  }

  function update($data){
    // $this->db->query("UPDATE employees SET emails = :emails, firstname = :firstname, lastname = :lastname, addresses = :addresses WHERE id = :id");
    $st = "";
    $counter = 1;
    $total_fields = count($fields,$id);
    foreach ($fields as $key => $value) {
        if ($counter === $total_fields) {
            $set = "$key= :" . $key;
            $st = $st . $set;
        } else {
            $set = "$key= :" . $key . ", ";
            $st = $st . $set;
            $counter++;
        }
    }

    $sql = "";
    $sql .= "UPDATE users SET  " . $st;
    $sql .= " WHERE id=" . $id;
   
    $stmt = $this->pdo->prepare($sql);

    foreach ($fields as $key => $value) {
      $this->db->bind(':' . $key, $value);
    }


    // $this->db->bind(":id", $data['id']);
    // $this->db->bind(":emails", $data['emails']);
    // $this->db->bind(":firstname", $data['firstname']);
    // $this->db->bind(":lastname", $data['lastname']);
    // $this->db->bind(":addresses", $data['addresses']);

    if ($this->db->execute()) {
      return true;
    }
    else {
      return false;
    }
  }
//   public function updateEmployee($fields,$id){  
//     //sql = "UPDATE employees SET name=:name, city=:city, designation=:designation";
//     $st = "";
//     $counter = 1;
//     $total_fields = count($fields);
//     foreach ($fields as $key => $value) {
//         if ($counter === $total_fields) {
//             $set = "$key= :" . $key;
//             $st = $st . $set;
//         } else {
//             $set = "$key= :" . $key . ", ";
//             $st = $st . $set;
//             $counter++;
//         }
//     }
//     $sql = "";
//     $sql .= "UPDATE scholarship_application SET " . $st;
//     $sql .= " WHERE tid=" . $id;

//     $stmt = $this->pdo->prepare($sql);

//     foreach ($fields as $key => $value) {
//         $stmt->bindValue(':' . $key, $value);
//     }

//     $stmtExec = $stmt->execute();
//     if ($stmtExec) {
//         $_SESSION['step2tod'] = 'STEP_2';
//         echo'<script type="text/javascript">
//             jQuery(function validation(){
//             swal({
//                 title: "Step 2 completed",
//                 text: "Proceed to step 3",
//                 icon: "success",
//                 button: "Ok",
//                     });
//                 });
//             </script>';
//         header('Location: application_step3');
//     }

// }
  
  function delete(){
    $this->db->query("DELETE FROM users WHERE id = :id");
    
    $this->db->bind(":id", $id);

    if ($this->db->execute()) {
      return true;
    }
    else {
      return false;
    }
  }

  // public function totalRowCount() {
  //   $sql = $this->db->query("SELECT * FROM users");

  //   $stmt = $this->conn->prepare($sql);
  //   $stmt->execute();
  //   $t_rows = $stmt->rowCount();

  //   return $t_rows;
  // }
}

$user = new User();
// Post Request
// $dat = ["firstname" => "Izu",
// "lastname" => "Izu",
// "email" => "izu@gmail.com",
// "phone" => 1234
// ];

// $user->insert($dat);

// var_dump($user->read());


// Call the insertUser method to insert a new user
$user->insert("john_doe", "eee", "john@example.com", 88);