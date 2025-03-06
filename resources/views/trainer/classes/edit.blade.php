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
        <!-- Mismos campos que create.blade.php pero con value="{{ old('name', $class->name) }}" -->
    </form>
</body>

</html>
