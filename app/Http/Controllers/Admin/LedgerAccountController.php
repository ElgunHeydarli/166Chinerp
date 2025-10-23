<?php

namespace App\Http\Controllers\Admin;

use App\Models\LedgerAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LedgerAccountController extends Controller
{
    // 🟢 Hesabların siyahısı
    public function index(Request $request)
    {
        $query = LedgerAccount::query();
        $search = $request->get('search');
        $type = $request->get('type');
        if (!empty($search))
            $query->where(function ($q) use ($search) {
                return $q->where('title', 'like', "%$search%")
                    ->orWhere('code', 'like', "%$search%");
            });

        if (!empty($type))
            $query->where('type', $type);

        $accounts = $query->get();
        return view('back.pages.ledger_accounts.index', compact('accounts'));
    }

    // 🟢 Yeni form səhifəsi
    public function create()
    {
        return view('back.pages.ledger_accounts.create');
    }

    // 🟢 Yadda saxla
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:ledger_accounts,code',
            'title' => 'required|string|max:255',
            'type' => 'required|in:aktiv,passiv,gəlir,xərc',
            'currency' => 'required|string|max:10',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);
        $validated['status'] = $request->has('status');
        LedgerAccount::create($validated);

        return redirect()->route('admin.ledger-accounts.index')->with('success', 'Hesab yaradıldı');
    }

    // 🟢 Redaktə formu
    public function edit($id)
    {
        $account = LedgerAccount::findOrFail($id);
        return view('back.pages.ledger_accounts.edit', compact('account'));
    }

    // 🟢 Yenilə
    public function update(Request $request, $id)
    {
        $account = LedgerAccount::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|unique:ledger_accounts,code,' . $account->id,
            'title' => 'required|string|max:255',
            'type' => 'required|in:aktiv,passiv,gəlir,xərc',
            'currency' => 'required|string|max:10',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->has('status');
        $account->update($validated);

        return redirect()->route('admin.ledger-accounts.index')->with('success', 'Hesab yeniləndi');
    }

    // 🟢 Sil
    public function destroy($id)
    {
        $account = LedgerAccount::findOrFail($id);
        $account->delete();

        return redirect()->route('admin.ledger-accounts.index')->with('success', 'Hesab silindi');
    }
}
