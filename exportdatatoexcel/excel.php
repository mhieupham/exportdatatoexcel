<?php
include ('database.php');

$output = '';

if($_GET['export-to-excel']){
    $query = 'SELECT * FROM students';
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $rowCount = $statement->rowCount();
    if($rowCount >0){
        $output .='<table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>
                      <tbody>';
        foreach ($result as $row){
            $output .= '<tr>
      <th scope="row">'.$row["id"].'</th>
      <td>'.$row["first_name"].'</td>
      <td>'.$row["last_name"].'</td>
      <td>@mdo</td>
    </tr>';
        }
        $output .= '</tbody>
        </table>';
        header("Content-Type:application/xls");
        header("Content-Disposition: attachment;filename=".rand().".xls");
        echo $output;
    }
}

