<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $activeBookingId = $request->get('booking_id');

        $guideId = $user->guide ? $user->guide->id : null;

        // 1. Ubah nama variabel menjadi $activeChats agar dibaca oleh Blade Wisatawan
        if ($user->role === 'guide') {
            $activeChats = Booking::where('guide_id', $guideId)
                ->whereHas('messages')
                ->with(['user', 'messages' => function($query) {
                    $query->latest();
                }])
                ->get();
        } else {
            $activeChats = Booking::where('user_id', $userId)
                ->whereHas('messages')
                ->with(['guide.user', 'messages' => function($query) {
                    $query->latest();
                }])
                ->get();
        }

        // 2. Ambil detail obrolan aktif jika ada `booking_id` yang dipilih
        // Tambahkan juga variabel $currentChat agar dikenali oleh Blade Wisatawan baris ke-61
        $activeBooking = null;
        $currentChat = null;
        $messages = [];

        if ($activeBookingId) {
            $activeBooking = Booking::findOrFail($activeBookingId);
            $currentChat = $activeBooking; // Samakan dengan logic Blade Wisatawan

            Message::where('booking_id', $activeBookingId)
                ->where('receiver_id', $userId)
                ->update(['is_read' => true]);

            $messages = Message::where('booking_id', $activeBookingId)
                ->orderBy('created_at', 'asc')
                ->get();
        }

        // 3. RETURN VIEW: Lempar ke folder blade masing-masing aktor dengan variabel yang pas
        if ($user->role === 'guide') {
            // Untuk Guide, kita samakan kirimannya menggunakan nama variabel $recentChats agar sesuai view guide
            $recentChats = $activeChats->map(function($booking) {
                $lastMessage = $booking->messages->first();
                return (object) [
                    'booking_id' => $booking->id,
                    'tourist_name' => $booking->user->name,
                    'last_message' => $lastMessage ? $lastMessage->message : 'Belum ada pesan',
                ];
            });
            return view('guides.messages.index', compact('recentChats', 'activeBooking', 'messages', 'activeBookingId'));
        }

        // Untuk Wisatawan, kirim variabel $activeChats dan $currentChat sesuai kebutuhan Blademu
        return view('dashboard.messages.index', compact('activeChats', 'currentChat', 'messages', 'activeBookingId'));
    }

    /**
     * Menyimpan dan Mengirim Pesan Baru (Disamakan jadi sendMessage)
     */
    public function sendMessage(Request $request)
    {
        // ... isi codingan di dalamnya tetap sama persis seperti kemarin ...
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'message' => 'required|string|max:1000',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $myId = Auth::id();

        $receiverId = ($booking->user_id === $myId) ? $booking->guide->user_id : $booking->user_id;

        Message::create([
            'booking_id' => $booking->id,
            'sender_id' => $myId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Pesan terkirim!');
    }
}
