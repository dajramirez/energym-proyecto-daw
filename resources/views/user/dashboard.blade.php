<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard del usuario - EnerGym</title>
</head>

<body>
    <header>
        <h1>Bienvenido, {{ auth()->user()->name }}</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">Cerrar sesión</button>
        </form>
    </header>

    <h2>Clases disponibles</h2>

    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <div>
        @forelse ($classes as $class)
            <div>
                <h3>{{ $class->name }}</h3>
                <p>{{ $class->description }}</p>
                <p>Entrendador: {{ $class->trainer->name }}</p>
                <p>Horario: {{ $class->start->format('d/m/Y H:i') }} - {{ $class->end->format('H:i') }}</p>
                <p>Plazas disponibles: {{ $class->capacity - $class->members_count }}</p>

                @if ($class->is_enrolled)
                    <form action="{{ route('classes.unenroll', $class->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Cancelar inscripción</button>
                    </form>
                @else
                    <form action="{{ route('classes.enroll', $class->id) }}" method="POST">
                        @csrf
                        <button type="submit" @if ($class->capacity <= $class->members_count) disabled @endif>
                            Inscribirse
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p>No hay clases disponibles en este momento.</p>
        @endforelse
    </div>
</body>

</html>
