<!DOCTYPE html>
<head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {listt-style: none;}
</style>
</head>
<body>
<h2>Enter information regarding expense</h2>
<ul>
<form name="insert" action="insert.php" method="POST" >
<li>Name:</li><li><input type="text" name="name" /></li>
<li>Type:</li>
<select name="type">
<?php
try {
$db = pg_connect("host=localhost port=5432 dbname=expenseTracker user=postgres password=1234");
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
$result = pg_query($db, "SELECT * FROM type");



while($row = pg_fetch_assoc($result))
{
	echo '<option value="'.htmlspecialchars($row['type']).'">'.htmlspecialchars($row['type']).'</option>';
}



  pg_close();

?>
</select>
<li>Amount:</li><li><input type="text" name="amount" /></li>
<li>Date:</li><li><input type="date" name="date"></li>
<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>
<?php

try {
$db = pg_connect("host=localhost port=5432 dbname=expenseTracker user=postgres password=1234");
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

$query = "INSERT INTO expense VALUES ('$_POST[date]', 2, '$_POST[name]', '$_POST[type]', $_POST[amount])";
$result = pg_query($query); 
pg_close();
?>