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

    public function postSearch(Request $request)
    {
        if($request->ajax())
        {
            $query = '%' . $request->input('query') . '%';
            $schools = School::where('name', 'like', $query)->take(5)->get();

            $schoolsReturn = [];
            foreach($schools as $key => $school)
            {
                $schoolsReturn[] = [
                    'id' => $school->id,
                    'name' => $school->name,
                ];
            }

            return response()->json([
                'schools' => $schoolsReturn,
                'query' => $query,
            ]);
        }

        abort(404);
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
