<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\LedgerAccount;
use Illuminate\Http\Request;

class LedgerAccountController extends Controller
{
    // 🟢 Hesabların siyahısı
    public function index()
    {
        $accounts = LedgerAccount::all();
        return view('back.pages.ledger_accounts.index', compact('accounts'));
    }

    // 🟢 Yeni form səhifəsi
    public function create()
    {
        $allAccounts = LedgerAccount::all();
        return view('back.pages.ledger_accounts.create', compact('allAccounts'));
    }

    // 🟢 Yadda saxla
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:ledger_accounts,code',
            'title' => 'required|string|max:255',
            'type' => 'required|in:aktiv,passiv,gəlir,xərc',
            'parent_id' => 'nullable|exists:ledger_accounts,id',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->has('status');
        LedgerAccount::create($validated);

        return redirect()->route('ledger-accounts.index')->with('success', 'Hesab yaradıldı');
    }

    // 🟢 Redaktə formu
    public function edit($id)
    {
        $account = LedgerAccount::findOrFail($id);
        $allAccounts = LedgerAccount::where('id', '!=', $id)->get(); // Özünü seçmək olmaz
        return view('back.pages.ledger_accounts.edit', compact('account', 'allAccounts'));
    }



    public function ajaxFilter(Request $request)
    {
        $query = LedgerAccount::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('code', 'like', '%' . $request->search . '%')
                    ->orWhere('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $accounts = $query->get();

        $html = view('back.pages.account.ledger.partials.table', compact('accounts'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html
        ]);
    }






    // 🟢 Yenilə
    public function update(Request $request, $id)
    {
        $account = LedgerAccount::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|unique:ledger_accounts,code,' . $account->id,
            'title' => 'required|string|max:255',
            'type' => 'required|in:aktiv,passiv,gəlir,xərc',
            'parent_id' => 'nullable|exists:ledger_accounts,id',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->has('status');
        $account->update($validated);

        return redirect()->route('ledger-accounts.index')->with('success', 'Hesab yeniləndi');
    }

    // 🟢 Sil
    public function destroy($id)
    {
        $account = LedgerAccount::findOrFail($id);
        $account->delete();

        return redirect()->route('ledger-accounts.index')->with('success', 'Hesab silindi');
    }
}
