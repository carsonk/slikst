<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\School;
use App\Professor;
use App\Course;

class ProfessorController extends Controller {
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
        return view('add_professor');
    }

    public function postAdd(Request $request)
    {
        // TODO: Check if exists checks for soft deletion.
        $this->validate($request, [
            'name' => 'required|unique:schools|max:255',
            'school_id' => 'required|numeric|exists:schools,id'
        ]);

        $professor = Professor::create(array_merge(
            $request->only('name', 'school_id'),
            ['added_by_user_id' => $request->user()->id]
        ));

        return Redirect::back()->with('success', 'That professor was successfully added.!');
    }

    public function getUpdate($id)
    {

    }

    public function postUpdate($id)
    {

    }

    public function postSearch(Request $request, $school_id)
    {
        if($request->ajax())
        {
            $query = '%' . $request->input('query') . '%';
            $professors = Professor::where('name', 'like', $query)->take(5)->get();

            $professorsReturn = [];
            foreach($professors as $key => $professor)
            {
                $professorsReturn[] = [
                    'id' => $professor->id,
                    'name' => $professor->name,
                ];
            }

            return response()->json([
                'professors' => $professorsReturn,
                'query' => $query,
            ]);
        }

        abort(404);
    }
}
