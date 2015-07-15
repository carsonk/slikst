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
    protected $storageLocation;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['getCreate', 'postCreate']]);

        $this->storageLocation = storage_path() . DIRECTORY_SEPARATOR . 'app';
    }

    public function getIndex()
    {
        $user = Auth::user();
        $mySchool = $user->school;

        $cribQuery = Crib::whereHas('course', function($q)
        {
            $q->where('school_id', Auth::user()->school->id);
        });

        $cribQuery = $cribQuery->take(20);

        $cribs = $cribQuery->get();

        return view('cribs_index', [
            'cribs' => $cribs,
            'mySchool' => $mySchool
        ]);
    }

    public function getShow($id)
    {
        return view('create_crib');
    }

    public function getDownload($id)
    {
        $crib = Crib::findOrFail($id);
        $file = Storage::get($crib->filename);

        return (new Response($file, 200))
                    ->header('Content-Type', 'application/pdf');
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
            'file' => 'required|max:15000|mimes:pdf'
        ]);

        $file = $request->file('file');

        do
        {
            $newFilename = substr(md5($file->getClientOriginalName() . rand(0,100)), 0, 7)
                . time() . '.' . strtolower($file->getClientoriginalExtension());
        } while (File::exists($this->storageLocation . '/' . $newFilename));

        $file->move($this->storageLocation, $newFilename);

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
