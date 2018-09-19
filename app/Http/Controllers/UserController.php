<?php

namespace App\Http\Controllers;

use App\Occupation;
use App\Service;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::fullName($request->search)->get();

            return response()->json(['users' => $users], 200);
        }

        $users = User::withTrashed()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->occupation->id !== 1){
            $occupations = Occupation::where('id', '!=', 1)->get();
        }else{
            $occupations = Occupation::all();
        }
        $services = Service::all();

        return view('admin.users.create', compact('occupations', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'identification' => 'required',
            'address' => 'required',
            'cell_phone' => 'required|max:14',
            'phone' => 'max:8',
            'occupation_id' => 'required|exists:occupations,id',
        ]);

        if(in_array($request->occupation_id , [2, 4, 5])){
            $this->validate($request, [
                'services' => 'required|array|min:1',
                "services.*" => 'exists:services,id',
            ]);
        }

        $fields = $request->all();
        $fields['password'] = bcrypt($request->identification);
        $fields['full_name'] = $request->name.' '.$request->last_name;

        $user = User::create($fields);

        if (!empty($request->services)) {
            $user->services()->sync($request->services);
        }

        return redirect()->route('users.show', $user)->with('flash', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $services = Service::all();

        return view('admin.users.show', compact('user', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->occupation->id !== 1){
            $occupations = Occupation::where('id', '!=', 1)->get();
        }else{
            $occupations = Occupation::all();
        }
        $services = Service::all();

        return view('admin.users.edit', compact('user', 'occupations', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'identification' => 'required',
            'address' => 'required',
            'cell_phone' => 'required',
            'occupation_id' => 'exists:occupations,id',
        ]);

        if(in_array($request->occupation_id , [2, 4, 5])){
            $this->validate($request, [
                'services' => 'required|array|min:1',
                "services.*" => 'exists:services,id',
            ]);
        }

        if (!empty($request->password) || !empty($request->old_password) || !empty($request->password_confirmation)) {
            $this->validate($request, [
                'old_password' => [
                    'required',
                    function($attribute, $value, $fail) {
                        if(isset($value)){
                            if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                                return $fail('La antigua contraseña no coincide.');
                            }
                        }
                    }
                ],
                'password' => 'required|confirmed|min:5|different:old_password',
                'password_confirmation' => 'required|min:5'
            ]);

            $fields = $request->all();

            if($user->password_change !== true){
                $fields['password_change'] = true;
            }

            $fields['password'] = bcrypt($request->password);
            $fields['full_name'] = $request->name.' '.$request->last_name;

            $user->update($fields);
        }else{
            $fields = $request->except('password');
            $fields['full_name'] = $request->name.' '.$request->last_name;

            $user->update($fields);
        }

        if (!empty($request->services)) {
            $user->services()->sync($request->services);
        }else{
            $user->services()->detach();
        }

        return redirect()->route('users.show', $user)->with('flash', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->state_id = State::where('abbreviation', 'gen-del')->first()->id;
        $user->save();
        $user->delete();

        return redirect()->route('users.index')->with('flash', 'Usuario eliminado correctamente');
    }
}
