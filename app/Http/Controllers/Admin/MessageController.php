<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Daftar pesan masuk (terbaru di atas).
     */
    public function index(): View
    {
        $messages = Message::query()
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'unreadCount' => Message::unread()->count(),
        ]);
    }

    /**
     * Tandai sudah dibaca / belum dibaca.
     */
    public function toggleRead(Message $message): RedirectResponse
    {
        $message->update(['is_read' => ! $message->is_read]);

        return back()->with(
            'success',
            $message->is_read
                        ? "Pesan dari {$message->name} ditandai sudah dibaca."
                        : "Pesan dari {$message->name} ditandai belum dibaca."
        );
    }

    /**
     * Hapus pesan.
     */
    public function destroy(Message $message): RedirectResponse
    {
        $name = $message->name;
        $message->delete();

        return back()->with('success', "Pesan dari {$name} berhasil dihapus.");
    }
}
