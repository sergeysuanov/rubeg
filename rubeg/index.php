<!DOCTYPE html>
<html>
<head>
	<title>Парковка</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
</head>
<body>
	<h1>Парковка</h1>
	<table>
		<tr>
			<td>Марка:</td>
			<td><input type="text" id="brand"></td>
		</tr>
		<tr>
			<td>Модель:</td>
			<td><input type="text" id="model"></td>
		</tr>
		<tr>
			<td>Цвет:</td>
			<td><input type="text" id="color"></td>
		</tr>
		<tr>
			<td>Номер:</td>
			<td><input type="text" id="number"></td>
		</tr>
		<tr>
			<td colspan="2"><button id="createBtn">Создать</button></td>
		</tr>
	</table>
	<hr>
	<table>
		<tr>
			<td>ID:</td>
			<td><input type="text" id="id"></td>
		</tr>
		<tr>
			<td>Марка:</td>
			<td><input type="text" id="brand"></td>
		</tr>
		<tr>
			<td>Модель:</td>
			<td><input type="text" id="model"></td>
		</tr>
		<tr>
			<td>Цвет:</td>
			<td><input type="text" id="color"></td>
		</tr>
		<tr>
			<td>Номер:</td>
			<td><input type="text" id="number"></td>
		</tr>
		<tr>
			<td colspan="2"><button id="updateBtn">Обновить</button></td>
		</tr>
	</table>
	<hr>
	<table id="parkingTable">

	</table>
	<hr>
	<table>
		<tr>
			<td>ID:</td>
			<td><input type="text" id="id"></td>
		</tr>
		<tr>
			<td colspan="2"><button id="deleteBtn">Удалить</button></td>
		</tr>
	</table>
	
<script>
		$(document).ready(function() {
			
			$("#createBtn").click(function() {
				var brand = $("#brand").val();
				var model = $("#model").val();
				var color = $("#color").val();
				var number = $("#number").val();
				$.ajax({
					url: "create.php",
					type: "POST",
					data: {
						brand: brand,
						model: model,
						color: color,
						number: number
					},
					success: function(result) {
						alert(result);
					}
				});
			});

			
			$("#readBtn").click(function() {
				$.ajax({
					url: "read.php",
					type: "GET",
					success: function(result) {
						$("#parkingTable").html(result);
					}
				});
			});

		
			$("#updateBtn").click(function() {
				var id = $("#id").val();
				var brand = $("#brand").val();
				var model = $("#model").val();
				var color = $("#color").val();
				var number = $("#number").val();
				$.ajax({
					url: "update.php",
					type: "POST",
					data: {
						id: id,
						brand: brand,
						model: model,
						color: color,
						number: number
					},
					success: function(result) {
						alert(result);
					}
				});
			});

			
			$("#deleteBtn").click(function() {
				var id = $("#id").val();
				$.ajax({
					url: "delete.php",
					type: "POST",
					data: {
						id: id
					},
					success: function(result) {
						alert(result);
					}
				});
			});
		});
	</script>

	<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Ошибка соединения: " . $conn->connect_error);
}


$brand = $_POST['brand'];
$model = $_POST['model'];
$color = $_POST['color'];
$number = $_POST['number'];


$sql = "INSERT INTO parking (brand, model, color, number) VALUES ('$brand', '$model', '$color', '$number')";
if ($conn->query($sql) === TRUE) {
  echo "Запись успешно создана";
} else {
  echo "Ошибка: " . $sql . "<br>" . $conn->error;
}
$sql = "SELECT * FROM parking";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  echo "<table><tr><th>ID</th><th>Марка</th><th>Модель</th><th>Цвет</th><th>Номер</th></tr>";
  
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["brand"] . "</td><td>" . $row["model"] . "</td><td>" . $row["color"] . "</td><td>" . $row["number"] . "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 результатов";
}


$conn->close();
?>
</body>
</html>
