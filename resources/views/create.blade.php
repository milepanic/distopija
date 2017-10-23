<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>create</title>
</head>
<body>
	<form action="create" method="POST">
		{{ CSRF_field() }}

		<input type="text" name="name" placeholder="Category name" required><br>
		<input type="checkbox" name="nsfw" value="1"> NSFW<br>
		<input type="checkbox" name="cover_box" value="1"> Cover box<br>
		<input type="checkbox" name="pictures" value="1"> Pictures<br>
		<input type="checkbox" name="videos" value="1"> Videos<br>
		<button type="submit">Create</button>
	</form>
</body>
</html>