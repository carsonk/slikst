<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\School;

class SchoolController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['getCreate', 'postCreate']]);
    }

    public function getIndex()
    {

    }

    public function getShow($id)
    {

    }

    public function getCreate()
    {
        return view('create_school');
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:schools|max:255'
        ]);

        $school = new School;
        $school->name = $request->input('name');
        $school->save();

        return Redirect::back()->with('success', 'School was succesfully created!');
    }

    public function getUpdate($id)
    {

    }

    public function postUpdate($id)
    {

    }
}
