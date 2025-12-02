<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Experience;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Contracts\Service\Attribute\Required;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $employees=Employee::with('country','city')->get();

        return view('index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
              $countries=Country::pluck('name','id');
              return view('create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeDate=$request->validate([
            'name'=>'required|regex:/^[a-zA-Z\s]+$/',
            'email'=>'required|email|unique:employees,email',
            'profile_image'=>'file|image|mimes:png,jpg|max:1000',
            'phonenumber'=>'required|digits:10',
            'dateofjoin'=>'required|date',
            'department'=>'required|string|in:Hr,IT,Sales,Support',
            'skills'=>'required|min:1|array',
            'address'=>'nullable|string',
            'country'=>'required',
            'city'=>'required',
            'exp'=>'required|min:1|array',
            'exp.*.companyname'=>'required|string',
            'exp.*.designation'=>'required|string',
            'exp.*.duration'=>'required|string',

        ]);
        do{
            $employee_id=mt_rand(100000,999999);
        }while(Employee::where('employee_id',$employee_id)->exists());
         $proileimage=$request->file('profile_image')->store('employee_photos','public');
            $skills=implode(',',$storeDate['skills']);
            // dd($employee_id);

            $employee=Employee::create([
                'employee_id'=>$employee_id,
                'name'=>$storeDate['name'],
                'email'=>$storeDate['email'],
                'profile_image'=>$proileimage,
                'phonenumber'=>$storeDate['phonenumber'],
                'dateofjoin'=>$storeDate['dateofjoin'],
                'department'=>$storeDate['department'],
                'skills'=>$skills,
                'address'=>$storeDate['address'],
                'country_id'=>$storeDate['country'],
                'city_id'=>$storeDate['city'],

            ]);
            foreach($storeDate['exp']as$exp){
                Experience::create([
                    'employee_id' => $employee->id,
                    'companyname'=>$exp['companyname'],
                    'designation'=>$exp['designation'],
                    'duration'=>$exp['duration']
                ]);
            }
            return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee,$id)
    {

        $employee=Employee::findorFail($id);
        $employee->load('experiences');
        // dd($employee);
        $countries=Country::pluck('name','id');
        return view('edit',compact('employee','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $employee=Employee::find($id);


          $storeDate=$request->validate([
            'name'=>'required|regex:/^[a-zA-Z\s]+$/',
            'email'=>'required|email|',
            'profile_image'=>'file|image|mimes:png,jpg|max:1000',
            'phonenumber'=>'required|digits:10',
            'dateofjoin'=>'required|date',
            'department'=>'required|string|in:Hr,IT,Sales,Support',
            'skills'=>'required|min:1|array',
            'address'=>'nullable|string',
            'country'=>'required',
            'city'=>'required',
            'exp'=>'required|min:1|array',
            'exp.*.companyname'=>'required|string',
            'exp.*.designation'=>'required|string',
            'exp.*.duration'=>'required|string',

        ]);
       if($request->has('profile_image')){
            FacadesStorage::disk('public')->delete($employee->profile_image);
            $proileimage=$request->file('profile_image')->store('employee_photos');
        }else{
            $proileimage=$employee->profile_image;
        }
            $skills=implode(',',$storeDate['skills']);


            $employee->update([

                'name'=>$storeDate['name'],
                'email'=>$storeDate['email'],
                'profile_image'=>$proileimage,
                'phonenumber'=>$storeDate['phonenumber'],
                'dateofjoin'=>$storeDate['dateofjoin'],
                'department'=>$storeDate['department'],
                'skills'=>$skills,
                'address'=>$storeDate['address'],
                'country_id'=>$storeDate['country'],
                'city_id'=>$storeDate['city'],

            ]);
          foreach($request['exp'] as $exp){
            // dd($request['exp']);
            if(!empty($exp['id'])){
            Experience::where('id', $exp['id'])->where('employee_id',$employee->id)->update([
            'companyname' => $exp['companyname'],
            'designation' => $exp['designation'],
            'duration' => $exp['duration'],
    ]);
            }
            else{
                  Experience::create([
                    'employee_id' => $employee->id,
                    'companyname'=>$exp['companyname'],
                    'designation'=>$exp['designation'],
                    'duration'=>$exp['duration']
                ]);
            }

}
            return redirect()->route('emp.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     public function getCountryCities(Request $request,City $city){
        $cities=City::where('country_id',$request->id)->get();
        $options="<option value=''>--Select</option>";
        //$selected=($city->id == $request->city)? 'selected':'';
        foreach($cities as $city){
            $selected = ($city->id == $request->city)? "selected":"";
            $options.="<option value='{$city->id}' {$selected}>{$city->name}</option>";
        }
        return $options;
    }
}
