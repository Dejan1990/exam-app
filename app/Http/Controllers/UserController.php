<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $limit = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate($this->limit);
        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('backend.user.create', [ 'user' => $user ]);
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
            'name'=>'required|min:3|max:255',
            'email'=>'required|unique:users',
            'password'=>'required',
            'occupation' => 'min:3|max:255',
            'address' => 'min:3|max:255',
            'phone' => 'min:3|max:255'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'occupation' => $request->occupation,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->route('user.index')->with('message', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.user.edit', [ 'user' => $user ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);

        if ($request->password == '') {
            $data = $request->except('password');
        } else {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user()->id == $user->id){
            return redirect()->route('user.index')->with('message', 'You cannot delete yourself!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('message', 'User deleted successfully!');
    }
}
