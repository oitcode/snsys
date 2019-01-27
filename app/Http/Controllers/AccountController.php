<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		/* Only for authenticated users. */
        $this->middleware('auth');
    }

	public function journalEntry()
	{
	    return view('account.journal-entry');
	}

	public function addAccount()
	{
	    return view('account.add-account');
	}
}
