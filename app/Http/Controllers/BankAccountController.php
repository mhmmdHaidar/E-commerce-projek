<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankAccountController extends Controller
{
    public function index()
    {
        $accounts = BankAccount::all();
        return view('admin.bank_accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.bank_accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:100',
        ]);

        BankAccount::create($request->all());

        return redirect()->route('bank-accounts.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function edit(BankAccount $bankAccount)
    {
        return view('admin.bank_accounts.edit', compact('bankAccount'));
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:100',
            'is_active' => 'nullable|boolean'
        ]);

        $bankAccount->update($request->all());

        return redirect()->route('bank-accounts.index')->with('success', 'Rekening berhasil diperbarui.');
    }

    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        return redirect()->route('bank-accounts.index')->with('success', 'Rekening dihapus.');
    }
}
