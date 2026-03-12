<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function showCarSelection()
    {
        $cars = Car::all();
        return view('car-selection', compact('cars'));
    }

//    public function showFinalConfirmation(Request $request)
//    {
//        $validated = $request->validate([
//            'trip_type' => 'required|string',
//            'from' => 'required|string',
//            'to' => 'required|string',
//            'pickup_time' => 'required',
//            'pickup_date' => 'required|date',
//            'days' => 'nullable|integer|min:1',
//            'seater' => 'nullable|string',
//            'car_id' => 'required|integer',
//            'car_name' => 'required|string',
//            'car_rating' => 'nullable',
//            'car_ratings_count' => 'nullable',
//            'car_seats' => 'required',
//            'car_price' => 'required|numeric',
//            'car_other_charges' => 'nullable|numeric',
//            'car_image' => 'nullable|string',
//        ]);
//
//        $days = (int) ($validated['days'] ?? 1);
//        $carPrice = (float) $validated['car_price'];
//        $otherCharges = (float) ($validated['car_other_charges'] ?? 0);
//
//        $pendingBooking = [
//            'trip_type' => $validated['trip_type'],
//            'from_location' => $validated['from'],
//            'to_location' => $validated['to'],
//            'pickup_time' => $validated['pickup_time'],
//            'pickup_date' => $validated['pickup_date'],
//            'days' => $days,
//            'seater' => $validated['seater'] ?? null,
//            'car_id' => $validated['car_id'],
//            'car_name' => $validated['car_name'],
//            'car_rating' => $validated['car_rating'] ?? null,
//            'car_ratings_count' => $validated['car_ratings_count'] ?? null,
//            'car_seats' => $validated['car_seats'],
//            'car_price' => $carPrice,
//            'car_other_charges' => $otherCharges,
//            'car_image' => $validated['car_image'] ?? null,
//            'total_amount' => ($carPrice * $days) + $otherCharges,
//        ];
//
//        session(['pending_booking' => $pendingBooking]);
//
//        return redirect()->route('confirmation.final');
//    }

    public function showConfirmation(Request $request)
    {
        $validated = $request->validate([
            'trip_type' => 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            'pickup_time' => 'required',
            'pickup_date' => 'required|date',
            'days' => 'nullable|integer|min:1',
            'seater' => 'required|string',

            'car_id' => 'required|integer',
            'car_name' => 'required|string',
            'car_rating' => 'nullable',
            'car_ratings_count' => 'nullable',
            'car_seats' => 'required',
            'car_price' => 'required|numeric',
            'car_other_charges' => 'nullable|numeric',
            'car_image' => 'nullable|string',
        ]);

        $days = (int) ($validated['days'] ?? 1);
        $carPrice = (float) $validated['car_price'];
        $otherCharges = (float) ($validated['car_other_charges'] ?? 0);

        $booking = [
            'trip_type' => $validated['trip_type'],
            'from' => $validated['from'],
            'to' => $validated['to'],
            'pickup_time' => $validated['pickup_time'],
            'pickup_date' => $validated['pickup_date'],
            'days' => $days,
            'seater' => $validated['seater'],
        ];

        $selectedCar = [
            'id' => $validated['car_id'],
            'name' => $validated['car_name'],
            'rating' => $validated['car_rating'] ?? null,
            'ratings_count' => $validated['car_ratings_count'] ?? 0,
            'seats' => $validated['car_seats'],
            'price' => $carPrice,
            'other_charges' => $otherCharges,
            'image' => $validated['car_image'] ?? null,
        ];

        return view('confirmation', compact('booking', 'selectedCar'));
    }

    public function showFinalConfirmation(Request $request)
    {
        $validated = $request->validate([
            'trip_type' => 'required|string',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'pickup_time' => 'required',
            'pickup_date' => 'required|date',
            'days' => 'required|integer|min:1',
            'seater' => 'required|string',

            'car_id' => 'required|integer',
            'car_name' => 'required|string',
            'car_rating' => 'nullable',
            'car_ratings_count' => 'nullable',
            'car_seats' => 'required',
            'car_price' => 'required|numeric',
            'car_other_charges' => 'nullable|numeric',
            'car_image' => 'nullable|string',

            'paymode' => 'required|in:part_pay,full_pay',
            'part_amount' => 'required|numeric',
            'full_amount' => 'required|numeric',
        ]);

        $validated['total_amount'] = $validated['paymode'] === 'part_pay'
            ? $validated['part_amount']
            : $validated['full_amount'];

        session(['pending_booking' => $validated]);

        return view('confirmation-final', [
            'pendingBooking' => $validated
        ]);
    }

    public function confirmationFinal()
    {
        $pendingBooking = session('pending_booking');

        if (!$pendingBooking) {
            return redirect()
                ->route('car.selection')
                ->with('error', 'No pending booking found.');
        }

        return view('confirmation-final', compact('pendingBooking'));
    }

    public function myBookings()
    {
        $bookings = Booking::with('car')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('my-bookings', compact('bookings'));
    }
}
