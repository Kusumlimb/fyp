<?php

namespace App\Http\Controllers\Dashboard;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
     public function index()
     {
          $data['activeMenu'] = 'users';
          $data['users'] =  User::query()->select('id', 'name', 'role', 'created_at')->paginate(10);
          return view('dashboard.users.index')->with($data);
     }


     public function create()
    {
        $data['activeMenu'] = 'users';
        $data['user'] = new User();
        return view('dashboard.users.create')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
             'name'     => ['required', 'string', 'max:255'],
             'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
             'password' => ['required', 'confirmed', Rules\Password::defaults()],
             'role'      => ['required', Rule::in([Role::TEACHER->value, Role::STUDENT->value])],
        ]);
        User::query()->create([
              'name'     => $request->name,
              'email'    => $request->email,
              'password' => Hash::make($request->password),
              'email_verified_at ' => now(),
              'role'     => $request->role,
         ]);
        return redirect()->route('dashboard.users.index')->with('toastr.success', 'User created successfully!');
   
    }

    public function edit(User $user)
    {
        $data['activeMenu'] = 'users';
        $data['user'] = $user;
        return view('dashboard.users.edit')->with($data);
    }

    public function update(Request $request, User $user)
    {
         $request->validate([
             'name'     => ['required', 'string', 'max:255'],
        ]);

         User::query()->where([
              'id' => $user->id
         ])->update([
              'name'     => $request->name,
         ]);

        return redirect()->route('dashboard.users.index')->with('toastr.success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if(auth()->user()->id === $user->id){
              abort(403);
        }
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('toastr.success', 'User deleted successfully!');
    }

}
