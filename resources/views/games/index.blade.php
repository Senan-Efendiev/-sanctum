<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
</head>
<body>
<h1>Games</h1>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Release Date</th>
        <th>Developer</th>
        <th>Genre</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($games as $game)
        <tr>
            <td>{{ $game->id }}</td>
            <td>{{ $game->title }}</td>
            <td>{{ $game->release_date }}</td>
            <td>{{ $game->developer->name }}</td>
            <td>{{ $game->genre->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
