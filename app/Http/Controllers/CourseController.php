<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\School;
use App\Professor;
use App\Course;

class CourseController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('admin', ['only' => ['getAdd', 'postAdd']]);
    }

    public function getIndex()
    {

    }

    public function getShow($id)
    {

    }

    public function getAdd()
    {
        return view('add_course');
    }

    public function postAdd(Request $request)
    {
        // TODO: Check if exists checks for soft deletion.
        $this->validate($request, [
            'name' => 'required|unique:schools|max:255',
            'school_id' => 'required|numeric|exists:schools,id'
        ]);

        $course = Course::create(array_merge(
            $request->only('name', 'school_id'),
            ['added_by_user_id' => $request->user()->id]
        ));

        return Redirect::back()->with('success', 'That course was successfully added!');
    }

    public function getUpdate($id)
    {

    }

    public function postUpdate($id)
    {

    }
}
