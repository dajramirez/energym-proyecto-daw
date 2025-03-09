<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Nuevo Usuario</h1>
        
        <form method="POST" action="{{ route('clerk.users.store') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select class="form-select" name="role" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>