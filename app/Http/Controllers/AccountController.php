<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/* Models */
use App\Account;
use App\JournalEntry;

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

	public function journalEntryProcess(Request $request)
	{
	    /* Validate data */
	    $validatedData = $request->validate([
	        'dr_account' => 'required|exists:account,name',
	        'cr_account' => 'required|exists:account,name',
	    ]);



	    /* Save journal entry to the db */

		$newJe = new JournalEntry;

		$newJe->particulars = $request->input('particulars');

		$newJe->dr_account_id = $this->getAccountIdByName($request->input('dr_account'));
		$newJe->dr_amount = $request->input('dr_amount');

		$newJe->cr_account_id = $this->getAccountIdByName($request->input('cr_account'));
		$newJe->cr_amount = $request->input('cr_amount');

	    $newJe->creator_id = $request->user()->id;

		/* Todo: How to confirm it was saved in database? */
		$newJe->save();

	    $request->session()->flash('status', 'Success: Journal entry created!');

		return redirect('/');
	}

	public function journalEntryList()
	{
	    $jEntries = JournalEntry::all();

		return view('account.journal-list')
		    ->with('jEntries', $jEntries);
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

	public function getAccountIdByName($accName)
	{
	    $accounts = Account::where('name', $accName);

		/* If more then one account with same name */
		if (count($accounts->get()) > 1) {
		    die("Whoops ! Something o wrong.");
		}

		$account = $accounts->first();

		return $account->account_id;
	}
}
