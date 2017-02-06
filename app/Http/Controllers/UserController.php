<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use JsValidator;

class UserController extends Controller
{

    protected $validationRules = [
        'name' => 'required',
        'username' => 'required|min:3|max:15|regex:/^[a-z\d._-]{3,15}$/i',
        'email' => 'required|email',
        'phone' => 'regex:/^[0-9\-+]*$/',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('user.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $input = $request->all();

//        $input['password'] = bcrypt($input['password']);

//        $newUser = User::create($input);
//
//        $newUser->profile()->create($input);

        Session::flash('flash_message', 'User successfully added!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);

        return view('user.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $validator = JsValidator::make($this->validationRules);

        $user = User::findOrFail($id);

        return view('user.edit')->with([
            'validator' => $validator,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($input, $this->validationRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user->fill($input)->update();
        $user->profile->fill($input)->update();

        Session::flash('flash_message', 'User successfully updated!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('flash_message', 'User successfully deleted!');

        return redirect()->route('user.index');
    }
}
