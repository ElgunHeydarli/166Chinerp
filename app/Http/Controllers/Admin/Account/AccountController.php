<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('back.pages.account.account.index');
    }

    public function pending()
    {
        return view('back.pages.account.account.pending');
    }

    public function summary()
    {
        return view('back.pages.account.account.summary');
    }
}
