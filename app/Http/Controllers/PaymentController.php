<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function mockPay(Request $request)
    {
        $pendingBooking = session('pending_booking');

        if (!$pendingBooking) {
            return redirect()
                ->route('car.selection')
                ->with('error', 'Booking session expired. Please try again.');
        }

        // Mock payment success
        $paymentStatus = 'success';
        $mockTransactionId = 'TXN-' . strtoupper(uniqid());

        if ($paymentStatus !== 'success') {
            return redirect()
                ->route('confirmation.final')
                ->with('error', 'Payment failed. Please try again.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $pendingBooking['car_id'],
            'trip_type' => $pendingBooking['trip_type'],
            'from_location' => $pendingBooking['from_location'],
            'to_location' => $pendingBooking['to_location'],
            'pickup_date' => $pendingBooking['pickup_date'],
            'pickup_time' => $pendingBooking['pickup_time'],
            'days' => $pendingBooking['days'],
            'seater' => $pendingBooking['seater'],
            'total_amount' => $pendingBooking['total_amount'],
            'booking_status' => 'confirmed',
            // add this only if your table has this column
            // 'payment_status' => 'paid',
            // 'transaction_id' => $mockTransactionId,
        ]);

        session()->forget('pending_booking');

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Mock payment successful. Your booking has been confirmed. Transaction ID: ' . $mockTransactionId);
    }
}
