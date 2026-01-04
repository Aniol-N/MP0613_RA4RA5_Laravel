<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Estilos para la animación de despliegue -->
    <style>
        .h1-toggle {
            cursor: pointer;
            user-select: none;
            margin-bottom: 0;
            /* Transición de opacidad más lenta (0.5s) */
            transition: opacity 0.5s ease;
        }

        .h1-toggle:hover {
            opacity: 0.6;
            /* Un poco más transparente para que se note el efecto */
        }

        .collapsible-content {
            max-height: 0;
            overflow: hidden;
            /* Añadimos padding a la transición también */
            padding-top: 0;
            padding-bottom: 0;
            opacity: 0;
            transition: max-height 0.8s ease-in-out, padding 0.8s ease, opacity 0.8s ease;

            background-color: #f9f9f9;
            border-radius: 0 0 5px 5px;
            border: 0px solid #ddd;
        }

        .collapsible-content.show {
            max-height: 1000px;
            /* Altura máxima suficiente */
            padding: 15px;
            /* Espaciado cuando está abierto */
            opacity: 1;
            /* Totalmente visible */
            border: 1px solid #ddd;
            border-top: none;
    </style>
</head>

<body class="container">
    <h1 class="mt-4 h1-toggle">Registrar una pelicula</h1>
    <div class="collapsible-content">
        <form action="/filmout/addFilm" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="year">Año:</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="genre">Género:</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="img_url">URL de la imagen:</label>
                <input type="text" class="form-control" id="img_url" name="img_url" required>
            </div>
            <div class="form-group">
                <label for="country">País:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="duration">Duración (minutos):</label>
                <input type="number" class="form-control" id="duration" name="duration" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Película</button>
        </form>
    </div>

    <br>

    <h1 class="mt-4 h1-toggle">Lista de Peliculas</h1>
    <div class="collapsible-content">
        <ul>
            <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
            <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
            <li><a href=/filmout/films>Pelis</a></li>
            <li><a href="/filmout/filmsOrderedByGenre">Películas ordenadas por género</a></li>
            <li><a href="/filmout/filmsOrderedByYear">Películas ordenadas por año</a></li>
            <li><a href="{{ route('countFilms') }}">Contar películas</a></li>
        </ul>
    </div>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Script para la animación de despliegue en los h1 -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headings = document.querySelectorAll('.h1-toggle');

            headings.forEach(heading => {
                const content = heading.nextElementSibling;

                if (content && content.classList.contains('collapsible-content')) {
                    heading.addEventListener('mouseenter', function() {
                        content.classList.add('show');
                    });

                    heading.addEventListener('mouseleave', function() {
                        // No cerrar si el cursor está en el contenido
                        if (!content.matches(':hover')) {
                            content.classList.remove('show');
                        }
                    });

                    content.addEventListener('mouseenter', function() {
                        this.classList.add('show');
                    });

                    content.addEventListener('mouseleave', function() {
                        // No cerrar si el cursor está en el heading
                        if (!heading.matches(':hover')) {
                            this.classList.remove('show');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
