<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;
use App\Worker;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ajaxPage()
    {
        return view('ajax.page');
    }

    public function ajaFoo(Request $request)
    {
	    //return '200';
	    $searchName = $request->input('search_name');

	    //$names = Person::where('first_name', $searchName)->get()->toJson();
	    $ritwiks = Worker::join('person', 'person.person_id', '=', 'worker.person_id')
		->where('person.first_name', 'like', $request->input('search_name') . '%')
	        ->orderBy('person.first_name')
	        ->get();

	    /* Ignore dummy ritwiks */
            $ritwiks = $ritwiks->except(1);
            $ritwiks = $ritwiks->except(2);
            $ritwiks = $ritwiks->except(3);

	    $ritwiks = $ritwiks->toJson();

	    return response()
	        ->json(
		    // $names,
		    $ritwiks,
	            200
		);
    }

    public function ajaxRequestProcess(Request $request)
    {
	return 'Foo';

	if ($request->isMethod('post')) {
	    $temp = $request->input('frm_name');
	    return response()
	        ->json([
	        'msg' => 'Just foo and ajax and ' . $temp,
	        //'json' => 'Biz bar and cup',
            ], 200);
	} else {
	    return response()
	        ->json([
	        'msg' => 'Some err',
	        //'sts' => 'Some err',
            ]);
	}
    }
}
