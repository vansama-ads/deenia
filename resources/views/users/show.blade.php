<!DOCTYPE html>
<html>
<head>
    <title>Show User</title>
</head>
<body>
    <h1>User Details</h1>
    <p>ID: {{ $user->id }}</p>
    <p>Nickname: {{ $user->nickname }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Gender: {{ $user->gender }}</p>
    <p>Date of Birth: {{ $user->tanggal_lahir }}</p>
    <p>Age: {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->age : 'N/A' }}</p>
    <p>Account Created At: {{ $user->created_at->format('d M Y H:i') }}</p>
    <a href="{{ route('users.index') }}">Back to Users</a>
</body>
</html>