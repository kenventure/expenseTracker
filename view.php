<!DOCTYPE html>
<head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {listt-style: none;}
</style>
</head>
<body>
<h1>Expense Query Page</h1>
<form name="retrieve" action="view.php" method="GET" >
<h2>Enter to and from date regarding expense</h2>
<li>From:</li><li><input type="date" name="from" /></li>
<li>To:</li><li><input type="date" name="to"></li>
<li><button name="search" width="50" height="10" onClick="find()">Search</button></li>

<script>
function find()
{
jQuery.ajax({
    type: "GET",
    url: 'view.php',
    dataType: 'json',
    data: {functionname: 'add', arguments: [1, 2]},

    success: function (obj, textstatus) {
                  if( !('error' in obj) ) {
                      yourVariable = obj.result;
                  }
                  else {
                      console.log(obj.error);
                  }
            }
});
}
</script>
<?php



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

try {
$db = pg_connect("host=localhost port=5432 dbname=expenseTracker user=postgres password=1234");
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
  
	//$day1 = date('y-m-d', strtotime($_POST["from"]));
//	$day2 = date('y-m-d', strtotime($_POST["to"]));
	if (isset($_GET["from"]) && strtotime($_GET["from"]))
	{
		$day1 = pg_escape_literal(isset($_GET["from"])?$_GET["from"]:null);
		//$day1 = '2017-03-11';
		$day2 = pg_escape_literal(isset($_GET["to"])?$_GET["to"]:null);
		
		if (strlen($day1)>1 && strlen($day2)>1)
		{
			$result = pg_query($db, "select * from expense where \"Date\">".$day1." and \"Date\"<".$day2);
		}
		else
		{
			
			
		}
		
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


	}
	//$result = pg_query($db, "select * from expense where \"Date\">'2017-03-03'");
?>






      </tbody>
    </table>
</form>	
</body>
</html>
