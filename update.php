<?php 

include_once 'config.php';


if (count($_POST) > 0) {

 
    if($_POST['action'] == 'get_id' ) {

        $past_last_name     = trim($_POST['past_last_name']);
        $past_first_name    = trim($_POST['past_first_name']);
        $past_middle_name   = trim($_POST['past_middle_name']);
        $past_status        = trim($_POST['past_status']);


        $query = $db->prepare("SELECT id FROM users WHERE first_name = '$past_first_name' 
        AND last_name = '$past_last_name' AND middle_name = '$past_middle_name' 
        AND status = '$past_status'");

        $query->execute();    
        $id_arr = $query->fetch(PDO::FETCH_ASSOC);        
        echo $id_arr['id'];   

    }

    if($_POST['action'] =='change') {
      
        $first_name   = trim($_POST['first_name']);
        $last_name    = trim($_POST['last_name']);
        $middle_name  = trim($_POST['middle_name']);
        $status       = trim($_POST['status']);
        $user_id      = trim($_POST['user_id']);
    
        $first_name   = htmlspecialchars($first_name, ENT_QUOTES);
        $last_name    = htmlspecialchars($last_name, ENT_QUOTES);
        $middle_name  = htmlspecialchars($middle_name, ENT_QUOTES);
        $status       = htmlspecialchars($status, ENT_QUOTES);
        $user_id      = htmlspecialchars($user_id, ENT_QUOTES);
    
        
        if ($first_name != '' && $last_name != '' && $status != '') {
            
            if (strlen($first_name) < 1 && strlen($first_name) > 30) {        
                exit();
            };

            if (strlen($last_name) < 1 && strlen($last_name) > 30) {        
                exit();
            };

            if (strlen($middle_name) > 30) {        
                exit();
            };

        
           $query = $db->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, 
           middle_name = :middle_name, status = :status  WHERE id = :user_id");

            $values = [
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'middle_name'   => $middle_name,
                'status'        => $status,
                'user_id'       => $user_id
            ];
            
            $query->execute($values);

            $query = $db->prepare("SELECT  last_name, first_name,
            middle_name, status FROM users WHERE id = '$user_id'");

            $query->execute();            
            $users_data = $query->fetch(PDO::FETCH_ASSOC);

            if (!$users_data) {

                echo "";

            } else {

                echo "<tr class='change'><td>".$users_data['last_name']."</td><td>".$users_data['first_name']."</td>
                <td>".$users_data['middle_name']."</td><td>".$users_data['status']."</td>
                <td><a href='#'>Изменить</a></td></tr>"; 
            }               
                             
        }      
    
    }

    if($_POST['action'] =='delete') {

        $user_id = trim($_POST['user_id']);
        
        $query = $db->prepare("DELETE FROM users WHERE id = '$user_id'");
        if($query->execute()){
            echo "Успешно удалено";
        }else {
            echo "Не удалено";
        }       
               

    }
    
};

  

 



?>