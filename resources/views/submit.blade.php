<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>create post</title>
</head>
<body>
	<form action="submit" method="POST">
		{{ CSRF_field() }}

		Write joke:<br>
		<textarea name="content" cols="30" rows="10"></textarea><br>
		<select name="category">
			<option value="" selected disabled hidden>Izaberi kategoriju</option>
			<option value="Kategorija 1">kat 1</option>
			<option value="Kategorija 2">kat 2</option>
		</select><br><br>
		<input type="checkbox" name="original" value="1"> Original<br><br>
		<button type="submit">Submit</button>
	</form>
</body>
</html>