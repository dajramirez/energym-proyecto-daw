<!DOCTYPE html>
<html>

<head>
    <title>Crear Nueva Clase</title>
</head>

<body>
    <h1>Crear Nueva Clase</h1>
    <form action="{{ route('trainer.classes.store') }}" method="POST">
        @csrf
        <div>
            <label>Nombre:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Descripción:</label>
            <textarea name="description" required></textarea>
        </div>
        <div>
            <label>Fecha/Hora Inicio:</label>
            <input type="datetime-local" name="start" required>
        </div>
        <div>
            <label>Fecha/Hora Fin:</label>
            <input type="datetime-local" name="end" required>
        </div>
        <div>
            <label>Capacidad:</label>
            <input type="number" name="capacity" min="1" required>
        </div>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>
