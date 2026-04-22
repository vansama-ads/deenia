<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nickname:</label>
        <input type="text" name="nickname" value="{{ $user->nickname }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br>

        <label>Password:</label>
        <input type="password" name="password"><br>

        <label>Gender:</label>
        <input type="text" name="gender" value="{{ $user->gender }}"><br>

        <label>Date of Birth:</label>
        <input type="date" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}"><br>

        <label>Avatar:</label>
        <input type="file" name="avatar" accept="image/*"><br>
        @if ($user->avatar)
            <p>Current Avatar:</p>
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="100">
        @endif

        <button type="submit">Update</button>
    </form>
</body>
</html>