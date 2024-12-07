<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
<h1>User Details</h1>

<h2>{{ $user->name }}</h2>
<p>Email: {{ $user->email }}</p>

<h3>Roles:</h3>
<ul>
    @foreach ($user->roles as $role)
        <li>{{ $role->name }}</li>
    @endforeach
</ul>

<a href="{{ url('/users') }}">Back to Users</a>
</body>
</html>
