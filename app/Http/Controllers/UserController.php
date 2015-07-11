<?php namespace App\Http\Controllers;

use App\User;
use App\School;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getEdit($id)
    {
        $this->canEditUser($id);

        $user = User::findOrFail($id);
        $school = $user->school;

        if(!$school)
        {
            $school = new School;
        }

        return view('edit_user', [
            'user' => $user,
            'school' => $school
        ]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->canEditUser($id);

        $user = User::findOrFail($id);

        $this->validate($request, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,' . $id,
			'school_id' => 'required|numeric|exists:schools,id'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $school = School::findOrFail($request->input('school_id'));
        $user->school()->associate($school);

        $user->push();

        return Redirect::back()->with('success', 'Profile was succesfully changed!');
    }

    private function canEditUser($id)
    {
        $authUser = Auth::user();

        if($id != $authUser->id && !$authUser->moderator)
        {
            abort(403, 'You do not have access to edit another user\'s account.');
        }
    }
}
