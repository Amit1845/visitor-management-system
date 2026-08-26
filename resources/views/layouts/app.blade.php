<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Visitor Management System' }}</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="{{ route('dashboard') }}"
        >
            Visitor Management
        </a>

        <div class="navbar-nav ms-auto align-items-lg-center">

            <a
                class="nav-link"
                href="{{ route('dashboard') }}"
            >
                Home
            </a>

            <a
                class="nav-link"
                href="{{ route('visitors.create') }}"
            >
                Add Visitor
            </a>

            <a
                class="nav-link"
                href="{{ route('visitors.checkedout') }}"
            >
                Checked Out
            </a>

            <a
                class="nav-link"
                href="{{ route('visitors.index') }}"
            >
                View Data
            </a>

        </div>

    </div>

</nav>

<main class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>
    @endif

    @yield('content')

</main>

</body>
</html>
