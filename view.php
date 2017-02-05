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

<?php
try {
$db = pg_connect("host=localhost port=5432 dbname=expenseTracker user=postgres password=1234");
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

?>

      <table border="2" style= "background-color: #84ed86; color: #761a9b; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Date</th>
          <th>Amount</th>
        </tr>
      </thead>
	  
	  
      <tbody>
	  
	<?php  
$result = pg_query($db, "SELECT * FROM expense");



while($row = pg_fetch_assoc($result))
{
	?>
	
	          <tr>
              <td><?php echo$row['Name']?></td>
              <td><?php echo$row['Type']?></td>
              <td><?php echo $row['Date']?></td>
              <td><?php echo $row['Amount']?></td>
            </tr>
			
<?php
}
  pg_close();

?>

      </tbody>
    </table>
	
</body>
</html>
