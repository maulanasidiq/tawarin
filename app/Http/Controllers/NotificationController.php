<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Tampilkan daftar notifikasi user login.
     */
    public function index()
    {
        $user = auth()->user();

        // Pakai relasi query biar bisa paginate
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca.
     */
    public function readAll()
    {
        $user = auth()->user();

        if ($user->unreadNotifications()->exists()) {
            $user->unreadNotifications->markAsRead();
        }

        return back()->with('success', '✅ Semua notifikasi sudah ditandai sebagai terbaca.');
    }
}
