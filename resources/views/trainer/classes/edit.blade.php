<!DOCTYPE html>
<html>

<head>
    <title>Editar Clase</title>
</head>

<body>
    <h1>Editar Clase</h1>
    <form action="{{ route('trainer.classes.update', $class) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nombre:</label>
            <input type="text" name="name" value="{{ old('name', $class->name) }}" required>
        </div>
        <div>
            <label>Descripción:</label>
            <textarea name="description" required>{{ old('description', $class->description) }}</textarea>
        </div>
        <div>
            <label>Fecha/Hora Inicio:</label>
            <input type="datetime-local" name="start" value="{{ old('start', $class->start) }}" required>
        </div>
        <div>
            <label>Fecha/Hora Fin:</label>
            <input type="datetime-local" name="end" value="{{ old('end', $class->end) }}" required>
        </div>
        <div>
            <label>Capacidad:</label>
            <input type="number" name="capacity" min="1" value="{{ old('capacity', $class->capacity) }}" required>
        </div>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>
