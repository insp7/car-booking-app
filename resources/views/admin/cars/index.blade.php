<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Cars</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-topbar">
    <div class="admin-topbar__inner">
        <div class="admin-brand">
            <img src="{{ asset('img/Wedriti Logo.png') }}" alt="Wedriti Logo" class="admin-brand__logo">
            <div class="admin-brand__text">Admin Panel</div>
        </div>

        <div class="admin-nav">
            <a href="{{ route('admin.cars.index') }}" class="admin-nav__link">Cars</a>
            <a href="{{ route('admin.cars.create') }}" class="admin-btn">Add Car</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="admin-btn-secondary">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="admin-page">
    <div class="admin-card">
        <div class="admin-header">
            <div>
                <h1 class="admin-title">Manage Cars</h1>
                <p class="admin-subtitle">Add, review, and manage the available commute vehicles.</p>
            </div>
            <a href="{{ route('admin.cars.create') }}" class="admin-btn">Add New Car</a>
        </div>

        @if(session('success'))
            <div class="admin-alert admin-alert--success">
                {{ session('success') }}
            </div>
        @endif

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Seats</th>
                    <th>Price / Day</th>
                    <th>Available</th>
                </tr>
                </thead>
                <tbody>
                @forelse($cars as $car)
                    <tr>
                        <td>{{ $car->name }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->seats }}</td>
                        <td>${{ number_format($car->price_per_day, 2) }}</td>
                        <td>
                                    <span class="admin-badge {{ $car->is_available ? 'admin-badge--yes' : 'admin-badge--no' }}">
                                        {{ $car->is_available ? 'Yes' : 'No' }}
                                    </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="admin-empty">No cars added yet.</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
