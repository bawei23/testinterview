<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Companies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function index()
    {
       
        $company = Companies::all();
        return view('employees', compact('company'));
    }


    public function datauser(Request $request)
    {
       

        $user = User::join('companies', 'users.company', '=', 'companies.id')
        ->get(['users.*', 'companies.name']);

        if (count($user) > 0) {
            foreach ($user as $row) {

                 $json['data'][] = array(
                    $row['id'],$row['first_name'],$row['last_name'],$row['email'],$row['name'],$row['company'],''
                );
            }
        }else{
            $json['data'][] = array('','No matching records found','','','','');
        }

        return json_encode($json);
    }

    public function create_employees()
    {
        $company = Companies::all();
        
        return view('create_employees', compact('company'));
    }

    public function store_employees(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
            
        ]);


        $user = new User();
        $user->company = $request->input('company');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if (!is_null($request->input('password_confirmation'))) {
                $user->password = Hash::make($request->input('new_password')) ;   
        }
   
       
        $user->save();

        return redirect()->route('employees');
    }

    public function update_employees(Request $request)
    {
 

        $user = User::findOrFail($request->input('user_id'));
        $user->company = $request->input('company');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('employees');
    }

    public function delete_user(Request $request)
    {
        $delete = User::where('id',$request->user_id)->delete();

        return redirect()->route('employees');
    }
}
