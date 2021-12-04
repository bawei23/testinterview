<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {

        return view('company');
    }

    public function datacompany(Request $request)
    {
       

        $company = Companies::all();

        if (count($company) > 0) {
            foreach ($company as $row) {

                 $json['data'][] = array(
                    $row['id'],$row['name'],$row['logo'],$row['email'],$row['website'],''
                );
            }
        }else{
            $json['data'][] = array('','No matching records found','','','');
        }

        return json_encode($json);
    }

    public function create_company()
    {
        
        return view('create_company');
    }



    public function detail_company($id)
    {
       
        $company = Companies::where('id',$id)->first(); 
        $id = $id;
        return view('detail_company', compact('company','id'));
    }

    public function store_company(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $company = new Companies();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        if (!is_null($request->file('image'))) {
            $image = $request->file('image');
            
            $filename = Auth::user()->id.time() . '.' . $image->getClientOriginalExtension();
            
            $request->image->move(public_path('logo'), $filename);
       
            $company->logo = $filename;
            } 

        $company->save();

        return redirect()->route('companies');
    }

    public function update_company(Request $request)
    {


        $company = Companies::findOrFail($request->input('company_id'));
        $company->name = $request->input('name');
        $company->website = $request->input('website');
        $company->email = $request->input('email');
       
        if (!is_null($request->file('image'))) {
        $image = $request->file('image');
      
        $filename = Auth::user()->id.time() . '.' . $image->getClientOriginalExtension();
        
        $request->image->move(public_path('logo'), $filename);
   
        $company->logo = $filename;
        } 
       
        $company->save();

        return redirect()->route('companies');
    }

    public function delete_company(Request $request)
    {
        $delete = Companies::where('id',$request->company_id)->delete();

        return redirect()->route('companies');
    }

}
