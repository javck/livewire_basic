<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire 基礎範例</title>
    <link rel="stylesheet" href="/css/app.css">
    <livewire:styles />
</head>

<body>
    <main class="container mx-auto">
        @yield('content')
    </main>

    <livewire:scripts />
</body>

</html>
