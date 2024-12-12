<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developers</title>
</head>
<body>
<h1>Developers</h1>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Founded</th>
        <th>Games</th>
    </tr>
    </thead>

        <tr>
            <td>{{ $developer->id }}</td>
            <td>{{ $developer->name }}</td>
            <td>{{ $developer->founded }}</td>
            <td>{{ implode(', ', $developer->games->pluck('title')->toArray()) }}</td>
        </tr>

</table>
</body>
</html>
