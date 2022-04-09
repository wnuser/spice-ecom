<?php

//fetch.php;

$connect = new PDO("mysql:host=localhost;dbname=lagpat_invdemo", "lagpat_invdemo", "uFn1y3ti2NQw");

if(isset($_POST['query']))
{
 $query = "
 SELECT DISTINCT rev_email FROM invoiceinfo_clb 
 WHERE rev_email LIKE '%".trim($_POST["query"])."%'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '';

 foreach($result as $row)
 {
  $output .= '
  <li class="list-group-item contsearch">
   <a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;">'.$row["rev_email"].'</a>
  </li>
  ';
 }

 echo $output;
}

if(isset($_POST['email']))
{
 $query = "
 SELECT * FROM invoiceinfo_clb 
 WHERE rev_email = '".trim($_POST["email"])."' 
 LIMIT 1
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '
 <table class="table table-bordered table-striped">
  <tr>
   <th>First Name</th>
   <th>Last Name</th>
   <th>Email</th>
   <th>Gender</th>
  </tr>
 ';

 foreach($result as $row)
 {
  $output .= '
  <tr>
   <td>'.$row["rev_name"].'</td>
   <td>'.$row["last_name"].'</td>
   <td>'.$row["rev_email"].'</td>
   <td>'.$row["rev_phone"].'</td>
  </tr>
  ';
 }
 $output .= '</table>';

 echo $output;
}

?>

