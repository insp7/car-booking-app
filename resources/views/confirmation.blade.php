<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Wedriti – Commute Booking</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/index.js"></script>
    <link rel="stylesheet" href="{{ asset('css/confirmation.css') }}"/>
</head>
<body>

@php
    use Carbon\Carbon;

    $pickupDateFormatted = !empty($booking['pickup_date'])
        ? Carbon::parse($booking['pickup_date'])->format('jS M Y')
        : '';

    $pickupTimeFormatted = !empty($booking['pickup_time'])
        ? Carbon::parse($booking['pickup_time'])->format('h:i a')
        : '';

    $days = $booking['days'] ?? 1;
    $carPrice = $selectedCar['price'] ?? 0;
    $otherCharges = $selectedCar['other_charges'] ?? 0;

    $fullPay = ($carPrice + $otherCharges) * $days;
    $partPay = round($fullPay * 0.25, 2);
@endphp

<header class="wb-navbar">
    <div class="wb-navbar__inner">
        <div class="wb-logo">
            <img src="{{ asset('img/Wedriti Logo.png') }}" alt="Wedriti Logo">
        </div>
        <nav class="wb-nav">
            <a class="wb-nav__link" href="#">WEDDINGS</a>
            <a class="wb-nav__link" href="#">RENT AN ATTIRE</a>
            <a class="wb-nav__link" href="#">BOOK A STAY</a>
            <a class="wb-nav__link wb-nav__link--active" href="#">COMMUTE</a>
            <a class="wb-nav__link" href="#">FAQS</a>
            <a class="wb-nav__link" href="#">ABOUT US</a>
        </nav>
    </div>
</header>

<main class="wb-canvas">

    <div class="wb-card wb-card--route">
        <div class="wb-route__label">{{ $booking['from'] ?? '' }}</div>
        <div class="wb-route__arrow">
            <span class="wb-route__arrow-line"></span>
        </div>
        <div class="wb-route__label">{{ $booking['to'] ?? '' }}</div>
        <div class="wb-route__date">{{ $pickupDateFormatted }}</div>
        <div class="wb-route__time">{{ $pickupTimeFormatted }}</div>
    </div>

    <div class="wb-card wb-card--car">
        <div class="wb-car__info">
            <div class="wb-car__name-row">
                <span class="wb-car__name">{{ $selectedCar['name'] ?? '' }}</span>
                <span class="wb-car__badge">{{ $selectedCar['rating'] ?? '' }}</span>
            </div>
            <div class="wb-car__ratings">({{ $selectedCar['ratings_count'] ?? 0 }} Ratings)</div>
            <div class="wb-car__stars">
                <span class="wb-star wb-star--full">★</span>
                <span class="wb-star wb-star--full">★</span>
                <span class="wb-star wb-star--full">★</span>
                <span class="wb-star wb-star--full">★</span>
                <span class="wb-star wb-star--empty">★</span>
            </div>
            <div class="wb-car__specs">
                <span>{{ $selectedCar['seats'] ?? '' }} Seats</span>
                <span class="wb-car__spec-sep"></span>
                <span>AC</span>
            </div>
        </div>

        <div class="wb-car__image-wrap">
            @if(!empty($selectedCar['image']))
                <img
                    src="{{ $selectedCar['image'] }}"
                    alt="{{ $selectedCar['name'] ?? 'Selected car' }}"
                    class="wb-car__image"
                />
            @endif
        </div>
    </div>

    <div class="wb-card wb-card--coupons">
        <h2 class="wb-coupons__title">Coupon &amp; Offers</h2>

        <div class="wb-coupon-item">
            <input type="radio" name="coupon" id="c1" class="wb-coupon-item__radio"/>
            <label for="c1" class="wb-coupon-item__label">
                <div class="wb-coupon-item__code-wrap">
                    <span class="wb-coupon-item__code">WEDRITICAB01</span>
                </div>
                <div class="wb-coupon-item__desc">Get 10% off using any of your bank credit cards only.</div>
            </label>
        </div>
        <hr class="wb-coupons__divider"/>

        <div class="wb-coupon-item">
            <input type="radio" name="coupon" id="c2" class="wb-coupon-item__radio"/>
            <label for="c2" class="wb-coupon-item__label">
                <div class="wb-coupon-item__code-wrap">
                    <span class="wb-coupon-item__code">WEDDEAL</span>
                </div>
                <div class="wb-coupon-item__desc">Get flat $1 off on your cab bookings!</div>
            </label>
        </div>
        <hr class="wb-coupons__divider"/>

        <div class="wb-coupon-item">
            <input type="radio" name="coupon" id="c3" class="wb-coupon-item__radio"/>
            <label for="c3" class="wb-coupon-item__label">
                <div class="wb-coupon-item__code-wrap">
                    <span class="wb-coupon-item__code">MEGASALE</span>
                </div>
                <div class="wb-coupon-item__desc">Get flat $1 off on your cab bookings! Hurry limited offer</div>
            </label>
        </div>
        <hr class="wb-coupons__divider"/>

        <div class="wb-coupons__input-row">
            <input type="text" class="wb-coupons__input" placeholder="Enter a coupon code"/>
            <button class="wb-coupons__apply" type="button">APPLY</button>
        </div>
    </div>

    <div class="wb-card wb-card--inclusions">
        <h2 class="wb-incl__title">Inclusions</h2>

        <div class="wb-incl__row">
            <div class="wb-incl__icon"><i class="ph ph-road-horizon"></i></div>
            <div class="wb-incl__text">
                <div class="wb-incl__label">150 km included</div>
                <div class="wb-incl__sub">₹10 per km will apply beyond the included kms</div>
            </div>
        </div>
        <hr class="wb-incl__divider"/>

        <div class="wb-incl__row">
            <div class="wb-incl__icon"><i class="ph ph-receipt"></i></div>
            <div class="wb-incl__text">
                <div class="wb-incl__label">Toll, tax and other charges</div>
                <div class="wb-incl__sub">Toll, state tax and other charges are included</div>
            </div>
        </div>
        <hr class="wb-incl__divider"/>

        <div class="wb-incl__row">
            <div class="wb-incl__icon"><i class="ph ph-user-square"></i></div>
            <div class="wb-incl__text">
                <div class="wb-incl__label">Driver allowance</div>
                <div class="wb-incl__sub">Driver food and accommodation charges are included</div>
            </div>
        </div>
        <hr class="wb-incl__divider"/>

        <div class="wb-incl__row">
            <div class="wb-incl__icon"><i class="ph ph-clock"></i></div>
            <div class="wb-incl__text">
                <div class="wb-incl__label">Waiting time</div>
                <div class="wb-incl__sub">Waiting time upto 45 mins for pickup, ₹1/min post 45 mins</div>
            </div>
        </div>
        <hr class="wb-incl__divider"/>

        <div class="wb-incl__row">
            <div class="wb-incl__icon"><i class="ph ph-gas-pump"></i></div>
            <div class="wb-incl__text">
                <div class="wb-incl__label">Fuel charges included</div>
                <div class="wb-incl__sub">Fuel charges are fully covered for the trip</div>
            </div>
        </div>

        <div class="wb-incl__policies">
            Policies <i class="ph ph-caret-right"></i>
        </div>
    </div>

    <form method="POST" action="{{ route('confirmation.final') }}">
        @csrf

        <input type="hidden" name="car_id" value="{{ $selectedCar['id'] ?? '' }}">
        <input type="hidden" name="car_name" value="{{ $selectedCar['name'] ?? '' }}">
        <input type="hidden" name="car_rating" value="{{ $selectedCar['rating'] ?? '' }}">
        <input type="hidden" name="car_ratings_count" value="{{ $selectedCar['ratings_count'] ?? 0 }}">
        <input type="hidden" name="car_seats" value="{{ $selectedCar['seats'] ?? '' }}">
        <input type="hidden" name="car_price" value="{{ $selectedCar['price'] ?? 0 }}">
        <input type="hidden" name="car_other_charges" value="{{ $selectedCar['other_charges'] ?? 0 }}">
        <input type="hidden" name="car_image" value="{{ $selectedCar['image'] ?? '' }}">

        <input type="hidden" name="trip_type" value="{{ $booking['trip_type'] ?? '' }}">
        <input type="hidden" name="from_location" value="{{ $booking['from'] ?? '' }}">
        <input type="hidden" name="to_location" value="{{ $booking['to'] ?? '' }}">
        <input type="hidden" name="pickup_date" value="{{ $booking['pickup_date'] ?? '' }}">
        <input type="hidden" name="pickup_time" value="{{ $booking['pickup_time'] ?? '' }}">
        <input type="hidden" name="days" value="{{ $booking['days'] ?? 1 }}">
        <input type="hidden" name="seater" value="{{ $booking['seater'] ?? '' }}">
        <input type="hidden" name="part_amount" value="{{ $partPay }}">
        <input type="hidden" name="full_amount" value="{{ $fullPay }}">

        <div class="wb-card wb-card--payment">
            <h2 class="wb-pay__title">Payment Details</h2>

            <div class="wb-pay__row">
                <input type="radio" name="paymode" id="p1" class="wb-pay__radio" value="part_pay" checked>
                <label for="p1" class="wb-pay__label">
                    <div class="wb-pay__mode">Part Pay</div>
                    <div class="wb-pay__sub">Pay rest to the driver</div>
                </label>
                <div class="wb-pay__amount">${{ number_format($partPay, 2) }}</div>
            </div>

            <div class="wb-pay__row">
                <input type="radio" name="paymode" id="p2" class="wb-pay__radio" value="full_pay">
                <label for="p2" class="wb-pay__label">
                    <div class="wb-pay__mode">Full Pay</div>
                    <div class="wb-pay__sub">Full amount</div>
                </label>
                <div class="wb-pay__amount">${{ number_format($fullPay, 2) }}</div>
            </div>

            <button class="wb-pay__now-btn" type="submit">Continue to Payment</button>
        </div>
    </form>

</main>

<footer class="wb-footer">
    <div class="wb-footer__inner">

        <div class="wb-footer__logo">
            <img src="{{ asset('img/Wedriti (white).png') }}" alt="Wedriti Footer Logo">
        </div>

        <div class="wb-footer__cols">
            <div class="wb-footer__col">
                <h4 class="wb-footer__col-title">BLOGS</h4>
                <ul class="wb-footer__list">
                    <li>Wedding Traditions</li>
                    <li>Host Stories</li>
                    <li>Guest Experiences</li>
                    <li>Safety &amp; Trust</li>
                    <li>How Wedriti Works</li>
                    <li>FAQs</li>
                </ul>
            </div>
            <div class="wb-footer__col">
                <h4 class="wb-footer__col-title">CONTACT US</h4>
                <ul class="wb-footer__list">
                    <li>Contact Support</li>
                    <li>Host Help</li>
                    <li>Traveler Help</li>
                    <li>Partnerships</li>
                    <li>Feedback</li>
                </ul>
                <a href="#" class="wb-footer__get-in-touch">Get in touch</a>
            </div>
            <div class="wb-footer__col">
                <h4 class="wb-footer__col-title">TERMS</h4>
                <ul class="wb-footer__list">
                    <li>Terms &amp; Conditions</li>
                    <li>Privacy Policy</li>
                    <li>Payment &amp; Refund Policy</li>
                    <li>Cancellation Policy</li>
                    <li>Safety Guidelines</li>
                </ul>
            </div>
            <div class="wb-footer__col">
                <h4 class="wb-footer__col-title">ABOUT US</h4>
                <ul class="wb-footer__list">
                    <li>Our Story</li>
                    <li>Why Wedriti</li>
                    <li>How It Works</li>
                    <li>Safety &amp; Trust</li>
                    <li>Team</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="wb-footer__social">
        <a href="#" class="wb-social-icon" title="Threads"><i class="ph ph-threads-logo"></i></a>
        <a href="#" class="wb-social-icon" title="Instagram"><i class="ph ph-instagram-logo"></i></a>
        <a href="#" class="wb-social-icon" title="YouTube"><i class="ph ph-youtube-logo"></i></a>
        <a href="#" class="wb-social-icon" title="Facebook"><i class="ph ph-facebook-logo"></i></a>
        <a href="#" class="wb-social-icon" title="WhatsApp"><i class="ph ph-whatsapp-logo"></i></a>
    </div>

    <div class="wb-footer__copyright">Wedriti Team / All rights reserved</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
