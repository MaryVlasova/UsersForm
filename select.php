<?php

include_once 'config.php';

if ($_POST['get_header']) {

    $query = $db->prepare("SELECT * FROM users");
    $query->execute();
    $users_data = $query->fetchAll();
    if($users_data) {
        echo "<table>";
        echo "<tr><th>Фамилия <button id='l_n_o_a'>&dArr;</button><button id='l_n_o_d'>&uArr;</button></th>

                <th>Имя <button id='f_n_o_a'>&dArr;</button><button id='f_n_o_d'>&uArr;</button></th>

                <th>Отчество <button id='m_n_o_a'>&dArr;</button><button id='m_n_o_d'>&uArr;</button></th>

                <th>Статус<button  id='s_1'>1</button><button id='s_2'>2</button>
                <button id='s_3'>3</button>  <button id='not'>&times;</button></th>
                
                <th></th></tr>"; 

       
    } else {
        echo "<h4>Здесь ничего нет!</h4>";
    }
 
} 



if ($_POST["select"]) {
    $select = $_POST["select"];    
} 

switch ($select) {
    case 'l_n_o_a':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users ORDER BY last_name ASC";
        break;
    case 'l_n_o_d':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users ORDER BY last_name DESC";
        break;
    case 'f_n_o_a':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users ORDER BY first_name ASC";
        break;
    case 'f_n_o_d':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users ORDER BY first_name DESC";
        break;
    case 'm_n_o_a':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users ORDER BY middle_name ASC";
        break;
    case 'm_n_o_d':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users ORDER BY middle_name DESC";
        break;
    case 's_1':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users WHERE status='Первый'";
        break;
    case 's_2':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users WHERE status='Второй'";
        break;
    case 's_3':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users WHERE status='Третий'";
        break;
    case 'not':
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users";
        break;                   
}

echo get_table($query_order, $db);


function get_table($query_order, $db) {
    
    if (!$query_order) {
        $query_order = "SELECT last_name, first_name, middle_name, status FROM users";              
    }

    $query = $db->prepare($query_order);
    $query->execute();
    
    $users_data = $query->fetchAll();

    if (!$users_data) {
        echo "<h3>Данные о пользователях еще не добавлены</h3>";
    } else {
      //  echo "<table>";
        foreach ($users_data as $row) {
            $row_last_name      = $row['last_name'];
            $row_first_name     = $row['first_name'];
            $row_middle_name    = $row['middle_name'];
            $row_status         = $row['status'];
             
            echo "<tr class='change'>";                                    
            echo "<td>$row_last_name</td><td>$row_first_name</td><td>$row_middle_name
            </td><td>$row_status</td><td><a href='#'>Изменить</a></td>";                
            echo "</tr>";
            
        } 
        echo "</table>";
                     
    }      
}




?>