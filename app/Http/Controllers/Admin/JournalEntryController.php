<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LedgerAccount;
use App\Models\Receive;
use Illuminate\Http\Request;
use App\Models\JournalEntry; // 🔥 bunu əlavə etməmişdin

class JournalEntryController extends Controller
{
    public function index(Request $request)
    {
        $query = JournalEntry::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('debit_account_name', 'like', "%$search%")
                    ->orWhere('credit_account_name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($request->filled('start_time')) {
            $query->whereDate('operation_date', '>=', $request->start_time);
        }

        if ($request->filled('end_time')) {
            $query->whereDate('operation_date', '<=', $request->end_time);
        }

        $entries = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('back.pages.journal.index', compact('entries'));
    }
}
