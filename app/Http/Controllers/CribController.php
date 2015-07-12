<?php namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use App\Crib;
use App\Course;
use App\Professor;

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
        return view('create_crib');
    }

    public function getCreate()
    {
        $user = Auth::user();
        $my_school = $user->school;

        return view('create_crib', [
            'my_school' => $my_school
        ]);
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:4000',
            'course_id' => 'required|numeric|exists:courses,id',
            'professor_id' => 'required|numeric|exists:professors,id',
            'file' => 'required|max:15000|mimes:pdf,jpeg,png,gif'
        ]);

        $storageLocation = storage_path() . '/app';

        $file = $request->file('file');

        do
        {
            $newFilename = substr(md5($file->getClientOriginalName() . rand(0,100)), 0, 7)
                . time() . '.' . strtolower($file->getClientoriginalExtension());
        } while (File::exists($storageLocation . '/' . $newFilename));

        $file->move($storageLocation, $newFilename);

        $professor = Professor::findOrFail($request->input('professor_id'));
        $course = Course::findOrFail($request->input('course_id'));

        $crib = new Crib;
        $crib->name = $request->input('name');
        $crib->description = $request->input('description');
        $crib->filename = $newFilename;

        $crib->professor_id = $professor->id;
        $crib->course_id = $course->id;

        $crib->push();

        return Redirect::back()->with('success', 'Crib added successfully.');
    }
}
