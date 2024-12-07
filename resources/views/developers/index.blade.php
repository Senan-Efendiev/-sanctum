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
    </tr>
    </thead>
    <tbody>
    @foreach ($developers as $developer)
        <tr>
            <td>{{ $developer->id }}</td>
            <td>{{ $developer->name }}</td>
            <td>{{ $developer->founded }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
