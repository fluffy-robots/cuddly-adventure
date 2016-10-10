<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cuddly Adventure</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body id="wrapper">
    <aside>
        @include('layouts.navigation')
    </aside>
    <main>
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
