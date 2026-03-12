<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wedriti – Payment Gateway</title>
    <link rel="stylesheet" href="{{ asset('css/confirmation-final.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="logo-bar">
    <input type="checkbox" id="menu-toggle" class="menu-toggle">

    <img src="{{ asset('img/Wedriti Logo.png') }}" alt="Wedriti Logo" class="logo">

    <nav class="main-nav">
        <a href="#home">HOME</a>
        <a href="#weddings">WEDDINGS</a>
        <a href="#services">SERVICES</a>
        <a href="#about">ABOUT US</a>
        <a href="#faqs">FAQS</a>
    </nav>

    <div class="header-actions">
        <a href="{{ route('bookings.index') }}">MY BOOKINGS</a>
        <span class="navbar-icon cart-icon" title="Shopping Cart">
            <i class="fas fa-shopping-bag"></i>
        </span>
        <span class="navbar-icon"><i class="fas fa-user-circle"></i></span>
        <label for="menu-toggle" class="hamburger">
            <i class="fas fa-bars"></i>
        </label>
    </div>
</header>

@php
    $pendingBooking = session('pending_booking');
@endphp

<main class="main-section">
    <div class="payment-card">
        <h2 class="page-title">Payment Gateway</h2>

        @if(session('error'))
            <div class="payment-error">
                {{ session('error') }}
            </div>
        @endif

        @if($pendingBooking)
            @php
                $baseFare = ($pendingBooking['car_price'] ?? 0) * ($pendingBooking['days'] ?? 1);
                $otherCharges = $pendingBooking['car_other_charges'] ?? 0;
                $totalAmount = $pendingBooking['total_amount'] ?? ($baseFare + $otherCharges);
            @endphp

            <div class="order-container">
                <div class="order-card">
                    <div class="order-number">
                        1. Commute
                    </div>

                    <div class="order-info">
                        <div class="item-name">{{ $pendingBooking['car_name'] }}</div>
                        <div class="item-date">
                            Route: {{ $pendingBooking['from_location'] }} → {{ $pendingBooking['to_location'] }}
                        </div>
                        <div class="item-date">
                            Date: {{ \Carbon\Carbon::parse($pendingBooking['pickup_date'])->format('d F Y') }}
                        </div>
                        <div class="item-date">
                            Time: {{ \Carbon\Carbon::createFromFormat('H:i', $pendingBooking['pickup_time'])->format('h:i A') }}
                        </div>
                    </div>

                    <div class="order-qty">
                        <div class="qty-box">
                            Days: {{ $pendingBooking['days'] }}
                        </div>
                    </div>

                    <div class="order-price">
                        @if($otherCharges > 0)
                            <span class="price-original">${{ number_format($baseFare + $otherCharges, 2) }}</span>
                        @endif
                        <span class="price-discounted">${{ number_format($totalAmount, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="section-box payment-box">
                <div class="section-label">Payment options</div>
                <hr class="divider" />

                <div class="payment-row">
                    <div class="payment-icon">
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none">
                            <rect width="27" height="27" rx="4" fill="#E7E0D0"/>
                            <text x="4" y="19" font-family="Lora" font-weight="700" font-size="10" fill="#750D2B">UPI</text>
                        </svg>
                    </div>
                    <div class="payment-text">
                        <span class="payment-name">UPI options</span>
                        <span class="payment-desc">Pay directly from your bank account</span>
                    </div>
                    <svg class="caret-right" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 6l6 6-6 6" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <hr class="divider" />

                <div class="payment-row">
                    <div class="payment-icon">
                        <svg width="31" height="26" viewBox="0 0 31 26" fill="none">
                            <rect width="31" height="26" rx="4" fill="#E7E0D0"/>
                            <rect x="2" y="6" width="27" height="14" rx="2" fill="#750D2B" opacity=".4"/>
                            <rect x="2" y="10" width="27" height="4" fill="#750D2B" opacity=".6"/>
                        </svg>
                    </div>
                    <div class="payment-text">
                        <span class="payment-name">Credit and Debit Cards</span>
                        <span class="payment-desc">Visa, Mastercard, Amex, Rupay</span>
                    </div>
                    <svg class="caret-right" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 6l6 6-6 6" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <hr class="divider" />

                <div class="payment-row">
                    <div class="payment-icon">
                        <svg width="23" height="24" viewBox="0 0 23 24" fill="none">
                            <rect width="23" height="24" rx="4" fill="#E7E0D0"/>
                            <text x="2" y="16" font-family="Lora" font-weight="700" font-size="9" fill="#750D2B">PAY</text>
                        </svg>
                    </div>
                    <div class="payment-text">
                        <span class="payment-name">Pay Later</span>
                        <span class="payment-desc">LazyPay, Amazon</span>
                    </div>
                    <svg class="caret-right" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 6l6 6-6 6" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <hr class="divider" />

                <div class="payment-row">
                    <div class="payment-icon">
                        <svg width="31" height="11" viewBox="0 0 31 11" fill="none">
                            <rect width="31" height="11" rx="2" fill="#E7E0D0"/>
                            <text x="2" y="9" font-family="Lora" font-size="7" fill="#750D2B">NET</text>
                        </svg>
                    </div>
                    <div class="payment-text">
                        <span class="payment-name">Net banking</span>
                        <span class="payment-desc">All major banks supported</span>
                    </div>
                    <svg class="caret-right" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 6l6 6-6 6" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <div class="right-column">
                <div class="section-box total-box">
                    <div class="total-header">
                        <span class="total-label">Total Due</span>
                        <span class="total-amount">${{ number_format($totalAmount, 2) }}</span>
                    </div>
                    <hr class="divider" />

                    <div class="fare-row">
                        <span class="fare-text">Base Fare</span>
                        <span class="fare-amount">${{ number_format($baseFare, 2) }}</span>
                    </div>

                    <div class="fare-row">
                        <span class="fare-text">Other Charges</span>
                        <span class="fare-amount">${{ number_format($otherCharges, 2) }}</span>
                    </div>

                    <div class="fare-row">
                        <span class="fare-text">Trip Type</span>
                        <span class="fare-amount">{{ ucfirst($pendingBooking['trip_type']) }}</span>
                    </div>

                    <div class="fare-row">
                        <span class="fare-text">Seats</span>
                        <span class="fare-amount">{{ $pendingBooking['car_seats'] }}</span>
                    </div>
                </div>

                <div class="section-box scan-box">
                    <div class="scan-header">
                        <span class="scan-label">Scan to Pay</span>
                        <div class="scan-logos">
                            <div class="upi-logo">
                                <svg width="28" height="23" viewBox="0 0 28 23" fill="none">
                                    <rect width="28" height="23" rx="3" fill="#E7E0D0"/>
                                    <text x="2" y="16" font-family="Lora" font-weight="700" font-size="9" fill="#750D2B">UPI</text>
                                </svg>
                            </div>
                            <div class="upi-logo">
                                <svg width="19" height="23" viewBox="0 0 19 23" fill="none">
                                    <rect width="19" height="23" rx="3" fill="#E7E0D0"/>
                                    <path d="M4 11l5 5 6-8" stroke="#750D2B" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <div class="upi-logo">
                                <svg width="59" height="40" viewBox="0 0 59 40" fill="none">
                                    <rect width="59" height="40" rx="3" fill="#E7E0D0"/>
                                    <text x="4" y="25" font-family="Lora" font-size="11" fill="#4B131F">GPay</text>
                                </svg>
                            </div>
                            <div class="upi-logo">
                                <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                                    <rect width="42" height="42" rx="6" fill="#E7E0D0"/>
                                    <text x="4" y="26" font-family="Lora" font-size="10" fill="#4B131F">PhonePe</text>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="scan-desc">Instant refund and high success rate</div>

                    <div class="qr-placeholder">
                        <svg width="140" height="140" viewBox="0 0 140 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="2" width="136" height="136" rx="4" stroke="#750D2B" stroke-width="3" fill="white"/>
                            <rect x="12" y="12" width="36" height="36" rx="2" stroke="#750D2B" stroke-width="3" fill="white"/>
                            <rect x="20" y="20" width="20" height="20" rx="1" fill="#750D2B"/>
                            <rect x="92" y="12" width="36" height="36" rx="2" stroke="#750D2B" stroke-width="3" fill="white"/>
                            <rect x="100" y="20" width="20" height="20" rx="1" fill="#750D2B"/>
                            <rect x="12" y="92" width="36" height="36" rx="2" stroke="#750D2B" stroke-width="3" fill="white"/>
                            <rect x="20" y="100" width="20" height="20" rx="1" fill="#750D2B"/>
                            <rect x="58" y="12" width="6" height="6" fill="#750D2B"/>
                            <rect x="68" y="12" width="6" height="6" fill="#750D2B"/>
                            <rect x="58" y="22" width="6" height="6" fill="#750D2B"/>
                            <rect x="58" y="32" width="6" height="6" fill="#750D2B"/>
                            <rect x="68" y="32" width="6" height="6" fill="#750D2B"/>
                            <rect x="78" y="22" width="6" height="6" fill="#750D2B"/>
                            <rect x="12" y="58" width="6" height="6" fill="#750D2B"/>
                            <rect x="22" y="58" width="6" height="6" fill="#750D2B"/>
                            <rect x="32" y="68" width="6" height="6" fill="#750D2B"/>
                            <rect x="12" y="78" width="6" height="6" fill="#750D2B"/>
                            <rect x="22" y="78" width="6" height="6" fill="#750D2B"/>
                            <rect x="58" y="58" width="6" height="6" fill="#750D2B"/>
                            <rect x="68" y="58" width="6" height="6" fill="#750D2B"/>
                            <rect x="78" y="58" width="6" height="6" fill="#750D2B"/>
                            <rect x="88" y="68" width="6" height="6" fill="#750D2B"/>
                            <rect x="58" y="78" width="6" height="6" fill="#750D2B"/>
                            <rect x="78" y="78" width="6" height="6" fill="#750D2B"/>
                            <rect x="88" y="78" width="6" height="6" fill="#750D2B"/>
                            <rect x="98" y="58" width="6" height="6" fill="#750D2B"/>
                            <rect x="108" y="68" width="6" height="6" fill="#750D2B"/>
                            <rect x="118" y="58" width="6" height="6" fill="#750D2B"/>
                            <rect x="108" y="78" width="6" height="6" fill="#750D2B"/>
                            <rect x="118" y="78" width="6" height="6" fill="#750D2B"/>
                            <rect x="58" y="98" width="6" height="6" fill="#750D2B"/>
                            <rect x="68" y="108" width="6" height="6" fill="#750D2B"/>
                            <rect x="78" y="98" width="6" height="6" fill="#750D2B"/>
                            <rect x="88" y="108" width="6" height="6" fill="#750D2B"/>
                            <rect x="58" y="118" width="6" height="6" fill="#750D2B"/>
                            <rect x="78" y="118" width="6" height="6" fill="#750D2B"/>
                            <rect x="98" y="98" width="6" height="6" fill="#750D2B"/>
                            <rect x="118" y="108" width="6" height="6" fill="#750D2B"/>
                            <rect x="108" y="118" width="6" height="6" fill="#750D2B"/>
                        </svg>
                    </div>

                    <form method="POST" action="{{ route('confirmation.final.pay') }}">
                        @csrf
                        <button type="submit" class="pay-now-btn">Pay Now</button>
                    </form>
                </div>
            </div>
        @else
            <div class="payment-error">
                No pending booking found. Please go back and select a car again.
            </div>
        @endif
    </div>
</main>

<footer class="footer">
    <div class="footer__inner">
        <div class="footer__logo">
            <svg viewBox="0 0 196 39" fill="none" xmlns="http://www.w3.org/2000/svg" width="196" height="39">
                <text x="0" y="30" font-family="Lora" font-weight="700" font-size="28" fill="#E7E0D0">wedriti</text>
            </svg>
        </div>

        <div class="footer__nav">
            <div class="footer__col">
                <h4>BLOGS</h4>
                <ul>
                    <li>Wedding Traditions</li>
                    <li>Host Stories</li>
                    <li>Guest Experiences</li>
                    <li>Safety &amp; Trust</li>
                    <li>How Wedriti Works</li>
                    <li>FAQs</li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>CONTACT US</h4>
                <ul>
                    <li>Contact Support</li>
                    <li>Host Help</li>
                    <li>Traveler Help</li>
                    <li>Partnerships</li>
                    <li>Feedback</li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>TERMS</h4>
                <ul>
                    <li>Terms &amp; Conditions</li>
                    <li>Privacy Policy</li>
                    <li>Payment &amp; Refund Policy</li>
                    <li>Cancellation Policy</li>
                    <li>Safety Guidelines</li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>ABOUT US</h4>
                <ul>
                    <li>Our Story</li>
                    <li>Why Wedriti</li>
                    <li>How It Works</li>
                    <li>Safety &amp; Trust</li>
                    <li>Team</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="footer__social">
            <a href="#" class="social-icon" aria-label="Threads">...</a>
            <a href="#" class="social-icon" aria-label="Instagram">...</a>
            <a href="#" class="social-icon" aria-label="YouTube">...</a>
            <a href="#" class="social-icon" aria-label="Facebook">...</a>
            <a href="#" class="social-icon" aria-label="WhatsApp">...</a>
        </div>
        <div class="footer__copyright">
            Wedriti Team / All rights reserved
        </div>

        <div class="footer__get-in-touch">
            <a href="#">Get in touch</a>
        </div>
    </div>
</footer>

</body>
</html>
