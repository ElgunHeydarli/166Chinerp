<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountantBookController extends Controller
{
    public function index()
    {
        return view('back.pages.account.accountant-book.index');
    }

    public function detail(int $id)
    {
        return view('back.pages.account.accountant-book.detail');
    }
}
