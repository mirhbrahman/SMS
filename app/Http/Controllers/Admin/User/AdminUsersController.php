<?php

namespace App\Http\Controllers\Admin\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UserRole;
use Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index')
                ->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create')
                ->with('roles', UserRole::pluck('name','id')->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:50|confirmed',
            'role_id' => 'required|numeric',
        ],[
            'role_id.required' => 'The user role field is required.'
        ]);

        $input = $request->all();
        $input['user_id'] = User::generateUserId();
        $input['password'] = bcrypt($request->password);
        $input['verified'] = User::UNVERIFIED_USER;
        $input['verification_token'] = User::generateVerificationToken();

        if (User::create($input)) {
            Session::flash('success','User create successfull');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function verifyByAdmin($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;
        $user->is_active = User::ACTIVE_USER;
        $user->save();
        
        return redirect()->back();
    }
}
