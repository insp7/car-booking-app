<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Wedriti – Commute</title>

    <link rel="stylesheet" href="{{ asset('css/car-selection.css') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="logo-bar">
    <input type="checkbox" id="menu-toggle" class="menu-toggle">

    <img src="{{ asset('img/Wedriti Logo.png') }}" alt="Wedriti Logo" class="logo">

    <nav class="main-nav">
        <a href="#home" class="nav-item">HOME</a>
        <a href="#weddings" class="nav-item01">WEDDINGS</a>
        <a href="#services" class="nav-item02">SERVICES</a>
        <a href="#about" class="nav-item03">ABOUT US</a>
        <a href="#faqs" class="nav-item04">FAQS</a>
    </nav>

    <div class="header-actions">
{{--        <a href="{{ route('bookings.index') }}">MY BOOKINGS</a>--}}
        <a href="#bookings">MY BOOKINGS</a>
        <span class="navbar-icon cart-icon" title="Shopping Cart">
        <i class="fas fa-shopping-bag"></i>
    </span>
        <span class="navbar-icon"><i class="fas fa-user-circle"></i></span>
        <label for="menu-toggle" class="hamburger">
            <i class="fas fa-bars"></i>
        </label>
    </div>
</header>

<main class="main-content">

    {{-- SEARCH FORM --}}
    <form method="GET" action="{{ route('car.selection') }}">
        <div class="trip-type-row">
            <label class="radio-option">
                <input type="radio" name="trip_type" value="oneway" {{ request('trip_type', 'oneway') === 'oneway' ? 'checked' : '' }}/>
                <span class="radio-circle"></span>
                <span class="radio-label">Oneway</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="trip_type" value="roundtrip" {{ request('trip_type') === 'roundtrip' ? 'checked' : '' }}/>
                <span class="radio-circle"></span>
                <span class="radio-label">Round trip</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="trip_type" value="airportpickup" {{ request('trip_type') === 'airportpickup' ? 'checked' : '' }}/>
                <span class="radio-circle"></span>
                <span class="radio-label">Airport Pickup</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="trip_type" value="airportdrop" {{ request('trip_type') === 'airportdrop' ? 'checked' : '' }}/>
                <span class="radio-circle"></span>
                <span class="radio-label">Airport Drop</span>
            </label>
        </div>

        <div class="booking-grid custom-grid">
            <div class="input-group from">
                <label>From</label>
                <input type="text" name="from" placeholder="Enter Location" value="{{ request('from') }}">
            </div>

            <div class="swap-wrap">
                <button type="button" class="swap-btn" id="swapLocationsBtn">⇄</button>
            </div>

            <div class="input-group to">
                <label>To</label>
                <input type="text" name="to" placeholder="Enter Destination" value="{{ request('to') }}">
            </div>

            <div class="input-group pickup">
                <label>Pickup time</label>
                <input type="time" name="pickup_time" value="{{ request('pickup_time') }}">
            </div>

            <div class="input-group date">
                <label>Date</label>
                <input type="date" name="pickup_date" value="{{ request('pickup_date') }}">
            </div>

            <div class="input-group days">
                <label>No. of days</label>
                <input type="number" name="days" min="1" placeholder="0" value="{{ request('days') }}">
            </div>

            <div class="input-group seater">
                <label>Seater</label>
                <select name="seater">
                    <option value="">Select</option>
                    <option value="4 Seater" {{ request('seater') === '4 Seater' ? 'selected' : '' }}>4 Seater</option>
                    <option value="6 Seater" {{ request('seater') === '6 Seater' ? 'selected' : '' }}>6 Seater</option>
                </select>
            </div>
        </div>

        <div class="sort-row" style="justify-content: flex-end;">
            <button type="submit" class="sort-btn">
                <span>Search</span>
            </button>
        </div>
    </form>

    @php
        $hasSearched =
            request()->filled('from') ||
            request()->filled('to') ||
            request()->filled('pickup_time') ||
            request()->filled('pickup_date') ||
            request()->filled('days') ||
            request()->filled('seater') ||
            request()->filled('trip_type');
    @endphp

    @if($hasSearched)
        <div class="sort-row">
            <button type="button" class="sort-btn" id="sortBtn" aria-expanded="false" aria-controls="sortDropdown">
                <span>Sort by</span>
                <svg class="caret-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 9L12 15L18 9" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="sort-dropdown" id="sortDropdown" role="listbox">
                <div class="sort-option" role="option">Price: Low to High</div>
                <div class="sort-option" role="option">Price: High to Low</div>
                <div class="sort-option" role="option">Rating: High to Low</div>
                <div class="sort-option" role="option">Most Popular</div>
            </div>
        </div>

        <div class="results-layout">

            <aside class="filter-panel">
                <h3 class="filter-title">Filters</h3>
                <hr class="filter-divider"/>

                <div class="filter-section">
                    <h4 class="filter-section-title">Cab Type</h4>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">Hatchback</span><span class="check-count">(04)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">Mini</span><span class="check-count">(06)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">Sedan</span><span class="check-count">(03)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">SUV</span><span class="check-count">(12)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">MiniBus</span><span class="check-count">(08)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">Auto</span><span class="check-count">(16)</span>
                    </label>
                </div>

                <hr class="filter-divider"/>

                <div class="filter-section">
                    <h4 class="filter-section-title">Model Type</h4>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">Innova Crysta</span><span class="check-count">(04)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">Toyota Innova</span><span class="check-count">(02)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">Wagon R</span><span class="check-count">(11)</span>
                    </label>
                </div>

                <hr class="filter-divider"/>

                <div class="filter-section">
                    <h4 class="filter-section-title">Price Range</h4>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">under $20</span><span class="check-count">(40)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">under $30</span><span class="check-count">(22)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">under $50</span><span class="check-count">(10)</span>
                    </label>
                    <label class="filter-check">
                        <input type="checkbox"/><span class="checkmark"></span>
                        <span class="check-label">$50 +</span><span class="check-count">(30)</span>
                    </label>
                </div>
            </aside>

            <section class="results-grid">
                @forelse($cars as $car)
                    <form method="POST" action="{{ route('confirmation') }}">
                        @csrf

                        <input type="hidden" name="trip_type" value="{{ request('trip_type', 'oneway') }}">
                        <input type="hidden" name="from" value="{{ request('from') }}">
                        <input type="hidden" name="to" value="{{ request('to') }}">
                        <input type="hidden" name="pickup_time" value="{{ request('pickup_time') }}">
                        <input type="hidden" name="pickup_date" value="{{ request('pickup_date') }}">
                        <input type="hidden" name="days" value="{{ request('days') }}">
                        <input type="hidden" name="seater" value="{{ request('seater') }}">

                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <input type="hidden" name="car_name" value="{{ $car->name }}">
                        <input type="hidden" name="car_rating" value="{{ $car->rating }}">
                        <input type="hidden" name="car_ratings_count" value="{{ $car->ratings_count }}">
                        <input type="hidden" name="car_seats" value="{{ $car->seats }}">
                        <input type="hidden" name="car_price" value="{{ $car->price_per_day }}">
                        <input type="hidden" name="car_other_charges" value="{{ $car->other_charges }}">
                        <input type="hidden" name="car_image" value="{{ $car->image ? asset('img/' . $car->image) : '' }}">

                        <div class="cab-card">
                            <div class="cab-img" style="background: linear-gradient(135deg,#c9d2d9 0%,#8fa3b1 100%);">
                                @if($car->image)
                                    <img src="{{ asset('img/' . $car->image) }}" alt="{{ $car->name }} image">
                                @else
                                    <svg class="cab-svg-icon" viewBox="0 0 80 50" fill="none">
                                        <path d="M12 35h56v4H12z" fill="#4B131F" opacity=".2"/>
                                        <path d="M16 21l8-11h28l8 11H16z" fill="#4B131F" opacity=".5"/>
                                        <rect x="10" y="21" width="60" height="15" rx="4" fill="#4B131F" opacity=".4"/>
                                        <circle cx="22" cy="37" r="5" fill="#4B131F"/>
                                        <circle cx="58" cy="37" r="5" fill="#4B131F"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="cab-info">
                                <div class="cab-name-price">
                                    <span class="cab-name">{{ $car->name }}</span>
                                    <span class="cab-price">${{ number_format($car->price_per_day, 2) }}</span>
                                </div>

                                <div class="cab-charges-row">
                                    <div class="star-rating">
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star empty">★</span>
                                    </div>
                                    <span class="other-charges">+${{ number_format($car->other_charges, 2) }} (other charges)</span>
                                </div>

                                <p class="cab-ratings">({{ $car->ratings_count }} Ratings)</p>

                                <div class="cab-footer">
                                    <div class="cab-specs">
                                        <span>{{ $car->seats }} Seats</span>
                                        <span class="spec-divider">|</span>
                                        <span>{{ $car->has_ac ? 'AC' : 'Non-AC' }}</span>
                                    </div>
                                    <button type="submit" class="select-btn">Select</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @empty
                    <div class="cab-card">
                        <div class="cab-info">
                            <p class="cab-name">No cars found</p>
                            <p class="cab-ratings">Try changing the seater or availability filters.</p>
                        </div>
                    </div>
                @endforelse
            </section>
        </div>
    @endif
</main>

<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-logo">
            <img src="{{ asset('img/Wedriti (white).png') }}" alt="Wedriti Footer Logo" height="50">
        </div>

        <div class="footer-links-grid">
            <div class="footer-column">
                <h4>BLOGS</h4>
                <ul>
                    <li><a href="#">Wedding Traditions</a></li>
                    <li><a href="#">Host Stories</a></li>
                    <li><a href="#">Guest Experiences</a></li>
                    <li><a href="#">Safety & Trust</a></li>
                    <li><a href="#">How Wedriti Works</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>CONTACT US</h4>
                <ul>
                    <li><a href="#">Contact Support</a></li>
                    <li><a href="#">Host Help</a></li>
                    <li><a href="#">Traveler Help</a></li>
                    <li><a href="#">Partnerships</a></li>
                    <li><a href="#">Feedback</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>TERMS</h4>
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Payment & Refund Policy</a></li>
                    <li><a href="#">Cancellation Policy</a></li>
                    <li><a href="#">Safety Guidelines</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>ABOUT US</h4>
                <ul>
                    <li><a href="#">Our Story</a></li>
                    <li><a href="#">Why Wedriti</a></li>
                    <li><a href="#">How It Works</a></li>
                    <li><a href="#">Safety & Trust</a></li>
                    <li><a href="#">Team</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="get-in-touch">Get in touch</p>
        <div class="social-icons">
            <a href="#"><img src="{{ asset('img/ThreadsLogo.png') }}" alt="Threads"></a>
            <a href="#"><img src="{{ asset('img/InstagramLogo.png') }}" alt="Instagram"></a>
            <a href="#"><img src="{{ asset('img/YoutubeLogo.png') }}" alt="YouTube"></a>
            <a href="#"><img src="{{ asset('img/FacebookLogo.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('img/WhatsappLogo.png') }}" alt="WhatsApp"></a>
        </div>
        <p class="copyright">Wedriti Team / All rights reserved</p>
    </div>
</footer>

<script src="{{ asset('js/car-selection.js') }}"></script>

<script>
    const swapBtn = document.getElementById('swapLocationsBtn');
    if (swapBtn) {
        swapBtn.addEventListener('click', function () {
            const fromInput = document.querySelector('input[name="from"]');
            const toInput = document.querySelector('input[name="to"]');

            const temp = fromInput.value;
            fromInput.value = toInput.value;
            toInput.value = temp;
        });
    }
</script>
</body>
</html>
