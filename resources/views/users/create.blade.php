<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label>Nickname:</label>
        <input type="text" name="nickname" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required minlength="8"><br>

        <label>Gender:</label>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>

        <label>Date of Birth:</label>
        <input type="date" name="tanggal_lahir"><br>

        <label>Avatar:</label>
        <input type="file" name="avatar" accept="image/*"><br>

        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('users.index') }}">Back to Users</a><br>
</body>
</html>