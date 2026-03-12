<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>

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
            <a href="{{ route('admin.cars.index') }}" class="admin-btn-secondary">Back to Cars</a>
        </div>
    </div>
</div>

<div class="admin-page">
    <div class="admin-card">
        <div class="admin-header">
            <div>
                <h1 class="admin-title">Add New Car</h1>
                <p class="admin-subtitle">Create a new car entry that users can book.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.cars.store') }}" class="admin-form">
            @csrf

            <div class="admin-form__row">
                <div class="admin-form__group">
                    <label class="admin-label">Name</label>
                    <input type="text" name="name" class="admin-input" required>
                </div>

                <div class="admin-form__group">
                    <label class="admin-label">Model</label>
                    <input type="text" name="model" class="admin-input">
                </div>
            </div>

            <div class="admin-form__row">
                <div class="admin-form__group">
                    <label class="admin-label">Car Type</label>
                    <input type="text" name="car_type" class="admin-input">
                </div>

                <div class="admin-form__group">
                    <label class="admin-label">Seats</label>
                    <input type="number" name="seats" class="admin-input" required>
                </div>
            </div>

            <div class="admin-form__row">
                <div class="admin-form__group">
                    <label class="admin-label">Price Per Day</label>
                    <input type="number" step="0.01" name="price_per_day" class="admin-input" required>
                </div>

                <div class="admin-form__group">
                    <label class="admin-label">Other Charges</label>
                    <input type="number" step="0.01" name="other_charges" class="admin-input" required>
                </div>
            </div>

            <div class="admin-form__group">
                <label class="admin-label">Image Filename</label>
                <input type="text" name="image" class="admin-input" placeholder="etios.png">
                <div class="admin-small-text">Put the image file inside public/img and enter only the filename.</div>
            </div>

            <div class="admin-checkbox-row">
                <input type="checkbox" name="has_ac" class="admin-checkbox" checked>
                <label class="admin-label">Has AC</label>
            </div>

            <div class="admin-checkbox-row">
                <input type="checkbox" name="is_available" class="admin-checkbox" checked>
                <label class="admin-label">Available for booking</label>
            </div>

            <div class="admin-actions">
                <button type="submit" class="admin-btn">Save Car</button>
                <a href="{{ route('admin.cars.index') }}" class="admin-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
