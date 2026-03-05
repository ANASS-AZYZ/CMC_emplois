<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormateurMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(Request $request): View
    {
        $tab = $request->get('tab', 'inbox');
        if (! in_array($tab, ['inbox', 'archive'], true)) {
            $tab = 'inbox';
        }

        $query = FormateurMessage::query()->with('sender');

        if ($tab === 'archive') {
            $query->whereNotNull('read_at');
        } else {
            $query->whereNull('read_at');
        }

        $messages = $query
            ->latest()
            ->paginate(12)
            ->appends(['tab' => $tab]);

        $inboxCount = FormateurMessage::query()->whereNull('read_at')->count();
        $archiveCount = FormateurMessage::query()->whereNotNull('read_at')->count();

        return view('admin.messages.index', compact('messages', 'tab', 'inboxCount', 'archiveCount'));
    }

    public function markAsRead(FormateurMessage $message): RedirectResponse
    {
        if (! $message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return back();
    }
}
