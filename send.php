<?php 

// проверка подключения

include_once 'config.php';


if (count($_POST) > 1) {

    $first_name     = trim($_POST['first_name']);
    $last_name      = trim($_POST['last_name']);
    $middle_name    = trim($_POST['middle_name']);
    $status         = trim($_POST['status']);

  
    $first_name   = htmlspecialchars($first_name, ENT_QUOTES);
    $last_name    = htmlspecialchars($last_name, ENT_QUOTES);
    $middle_name  = htmlspecialchars($middle_name, ENT_QUOTES);
    $status       = htmlspecialchars($status, ENT_QUOTES);
  

  if ($first_name != '' && $last_name != '' && $status != '') {
       
    if (strlen($first_name) < 2 && strlen($first_name) > 30) {        
        exit();
    };

    if (strlen($last_name) < 2 && strlen($last_name) > 30) {        
        exit();
    };

    if (strlen($middle_name) > 30) {        
        exit();
    };

  // echo "проверки пройдены <br/>";

    
      $query = $db->prepare("INSERT INTO users SET first_name = :first_name, last_name = :last_name, 
      middle_name = :middle_name, status = :status");

  //  echo "запрос подготовлен<br/>";

      $values = [
        'first_name'    => $first_name,
        'last_name'     => $last_name,
        'middle_name'   => $middle_name,
        'status'        => $status
      ];
  //    echo "массив создан<br/>";

      $query->execute($values);  


      header("Location: admin.html");
      exit;  
      
      echo $final_msg."<a href=\"admin.html\">Назад</a>";

    };
  
};
 



?>