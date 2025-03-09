<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h1>Usuarios</h1>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('clerk.users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
            
            <form method="GET" class="form-inline">
                <select name="per_page" class="form-control" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 por página</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 por página</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 por página</option>
                </select>
            </form>
        </div>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('clerk.users.edit', $user) }}" 
                                   class="btn btn-sm btn-warning">
                                   <i class="bi bi-pencil"></i> Editar
                                </a>
                                
                                <form action="{{ route('clerk.users.delete', $user) }}" 
                                      method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            {{ $user->role === 'admin' ? 'disabled' : '' }}>
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Bootstrap JS para alertas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>