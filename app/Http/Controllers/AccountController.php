<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/* Models */
use App\Account;

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
		/* Redirect to home page */
		if (Gate::denies('create-account')) {
		    return redirect("/")
	            ->withErrors('Sorry: Operation not allowed');
		}

	    return view('account.add-account');
	}

	public function addAccountProcess(Request $request)
	{
		/* Todo: Validate input */

        $accName = $request->input('account_name');
		$remarks = $request->input('remarks');


        $newAcc = new Account;

	    $newAcc->name = $accName;
	    $newAcc->remarks = $remarks;
	    $newAcc->creator_id = $request->user()->id;

	    if (! $newAcc->save()) {
	        /* Todo: Recover from error in someway rather than dying */
	        die('Err: Could not create account.');
	    }

	    $request->session()->flash('status', 'Success: Account created!');

		return redirect("/");
	}

	public function listAccounts()
	{
		$accounts = Account::all();

	    return view('account.list-accounts')
		    ->with('accounts', $accounts);
	}
}
