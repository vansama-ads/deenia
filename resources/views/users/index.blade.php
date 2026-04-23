<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>
    <h1>Users</h1>
    <a href="{{ route('users.create') }}">Add User</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Avatar</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nickname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('users.updateRole', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <select name="role" onchange="this.form.submit()" style="padding: 5px;">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>Moderator</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="50">
                        @else
                            No Avatar
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}">View</a>
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>