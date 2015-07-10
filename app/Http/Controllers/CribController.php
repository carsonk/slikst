<?php namespace App\Http\Controllers;

class CribController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['getCreate', 'postCreate']]);
    }

    public function getIndex()
    {

    }

    public function getShow($id)
    {

    }

    public function getCreate($course = null)
    {
        $user = Auth::user();

        if($user->school())
        {
            $my_school = $user->school();
        }
        else
        {
            $schools = School::all();
        }

        return view('create_crib', [
            'schools' => $schools,
            'my_school' => $my_school
        ]);
    }

    public function postCreate()
    {

    }
}
