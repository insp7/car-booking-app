<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/my-bookings.css') }}">
</head>
<body>
<h1>My Bookings</h1>

@if(session('success'))
    <p class="success-message">{{ session('success') }}</p>
@endif

@forelse($bookings as $booking)
    @if($loop->first)
        <div class="booking-list">
            @endif

            <div class="booking-card">
                <h3>{{ $booking->car->name }}</h3>

                <div class="booking-meta">
                    <div class="booking-field">
                        <strong>From</strong>
                        <span>{{ $booking->from_location }}</span>
                    </div>

                    <div class="booking-field">
                        <strong>To</strong>
                        <span>{{ $booking->to_location }}</span>
                    </div>

                    <div class="booking-field">
                        <strong>Date</strong>
                        <span>{{ $booking->pickup_date }}</span>
                    </div>

                    <div class="booking-field">
                        <strong>Time</strong>
                        <span>{{ $booking->pickup_time }}</span>
                    </div>

                    <div class="booking-field">
                        <strong>Days</strong>
                        <span>{{ $booking->days }}</span>
                    </div>
                </div>

                <div class="booking-total">
                    <span class="amount">${{ number_format($booking->total_amount, 2) }}</span>
                    <span class="booking-status">{{ $booking->booking_status }}</span>
                </div>
            </div>

            @if($loop->last)
        </div>
    @endif
@empty
    <div class="empty-state">
        <h2>No bookings found</h2>
        <p>You have not made any bookings yet.</p>
    </div>
@endforelse
</body>
