<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() 
    {
            $users = User::paginate(10)->withQueryString();
            return view('user_page/index', compact('users'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users', //fungsi dns untuk input email sesuai sampai.com
            'password' => 'required|min:5|max:255',
            'role_id' => 'required'

        ]);
        
        User::create([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('user_page/index')->with('success', 'Data Berhasil Dibuat, Please Login'); //untuk menuju hal login
    }

    public function create()
    { 
        $user = new User();
        return view('user_page/create', compact('user'));
    }

    public function edit($id)
    {
        $user = user::findOrFail($id);
        return view('user_page.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = user::findOrFail($id);
        $user->update($request->all());

        return redirect('user_page/index')->with('success', 'Update Data Berhasil'); //untuk menuju hal login
    }

    public function show(string $id)
    {
        //get post by ID
        $users = User::findOrFail($id);
        return view('user_page.show', compact('users'));

        //render view with post
    }
    // public function destroy($id)
    // {
    //     $user = user::find($id);
    //     $user->delete();

    //     return redirect('user_page/index')->with('success', 'Post has been deleted!');

    // }
    public function destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();
    
        return redirect('/user_page/index')->with('success', 'User has been deleted!');    
    }
  
}
