<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard del entrenador - EnerGym</title>
</head>

<body>
    <h1>Mis Clases</h1>
    <a href="{{ route('trainer.classes.create') }}">Crear Nueva Clase</a>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha/Hora</th>
                <th>Inscritos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->start->format('d/m/Y H:i') }}</td>
                    <td>{{ $class->members_count }} / {{ $class->capacity }}</td>
                    <td>
                        <a href="{{ route('trainer.classes.edit', $class) }}">Editar</a>
                        <form action="{{ route('trainer.classes.delete', $class) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No tienes clases programadas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
