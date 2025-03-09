<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Editar Usuario</h1>
        
        <form method="POST" action="{{ route('clerk.users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nueva Contraseña (dejar vacío para no cambiar)</label>
                <input type="password" class="form-control" name="password">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select class="form-select" name="role" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>