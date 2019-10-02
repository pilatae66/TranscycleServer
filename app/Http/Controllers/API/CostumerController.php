<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CostumerResource;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CostumerResource::collection(User::whereHas('roles', function(Builder $query){ $query->where('name','Customer'); })->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $messages = [
        //     'customer.customer_name.firstname.required' => 'Customer firstname is required',
        //     'customer.customer_name.firstname.string' => 'Customer firstname must be a string',
        //     'customer.customer_name.firstname.max' => 'Customer firstname must not be more than 255 characters',
        //     'customer.customer_name.middlename.required' => 'Customer middlename is required',
        //     'customer.customer_name.middlename.string' => 'Customer middlename must be a string',
        //     'customer.customer_name.middlename.max' => 'Customer middlename must not be more than 255 characters',
        //     'customer.customer_name.lastname.required' => 'Customer lastname is required',
        //     'customer.customer_name.lastname.string' => 'Customer lastname must be a string',
        //     'customer.customer_name.lastname.max' => 'Customer lastname must not be more than 255 characters',
        //     "customer.customer_details.landline_number.required" => 'Customer Landline number is required',
        //     "customer.customer_details.email.required" => 'Customer E-mail is required',
        //     "customer.customer_details.email.email" => 'Customer E-mail must be a valid e-mail address',
        //     "customer.customer_details.religion.required" => 'Religion is required',
        //     "customer.customer_details.date_of_birth.required" => 'Date of Birth is required',
        //     "customer.customer_details.age.required" => 'Age is required',
        //     "customer.customer_details.age.numberic" => 'Age must be a number',
        //     "customer.customer_details.place_of_birth.required" => 'Place of Birth is required',
        //     "customer.customer_details.civil_status.required" => 'Civil Status is required',
        //     "customer.customer_details.educational_attainment.required" => 'Educational Attainment is required',
        //     "customer.customer_details.employment_type.required" => 'Borrower Type is required',
        //     "customer.customer_details.mobile_number.required"=> "Mobile Number is required",
        //     "customer.customer_address.present_address.required" => 'Present Address is required',
        //     "customer.customer_address.permanent_address.required" => 'Permanent Address is required',
        //     "customer.customer_family.father_name.required" => 'Father\'s name is required',
        //     "customer.customer_family.mother_name.required" => 'Mother\'s name is required',
        //     "customer.customer_family.spouse_name.required" => 'Spouse\'s name is required',
        //     "customer.customer_family.dependent1.required" => '1st Dependent\'s name is required',
        //     "customer.customer_family.dependent2.required" => '2nd Dependent\'s name is required',
        //     "customer.customer_family.dependent3.required" => '3rd Dependent\'s name is required'
        // ];
        // $this->validate($request, [
        //     'customer.customer_name.firstname' => 'required|string|max:255',
        //     'customer.customer_name.middlename' => 'required|string|max:255',
        //     'customer.customer_name.lastname' => 'required|string|max:255',
        //     "customer.customer_details.mobile_number"=> "required|string",
        //     "customer.customer_details.landline_number" => "required|string",
        //     "customer.customer_details.email" => "required|email",
        //     "customer.customer_details.religion" => "required|string",
        //     "customer.customer_details.date_of_birth" => "required|date",
        //     "customer.customer_details.age" => 'required|numeric',
        //     "customer.customer_details.place_of_birth" => "required|string",
        //     "customer.customer_details.civil_status" => "required|string",
        //     "customer.customer_details.educational_attainment" => "required|string",
        //     "customer.customer_details.employment_type" => "required|string",
        //     "customer.customer_address.present_address" => "required|string",
        //     "customer.customer_address.permanent_address" => "required|string",
        //     "customer.customer_family.father_name" => "required|string",
        //     "customer.customer_family.mother_name" => "required|string",
        //     "customer.customer_family.spouse_name" => "required|string",
        //     "customer.customer_family.dependent1" => "required|string",
        //     "customer.customer_family.dependent2" => "required|string",
        //     "customer.customer_family.dependent3" => "required|string"
        // ],$messages);
        // return $request->customer['customer_name']['firstname'];

        $user = User::create([
            'firstname' => $request->customer['customer_name']['firstname'],
            'middlename' => $request->customer['customer_name']['middlename'],
            'lastname' => $request->customer['customer_name']['lastname']
        ]);

        $user->roles()->attach(Role::where('name', 'customer')->first());

        $user->cust_details()->create($request->customer['customer_details']);

        $user->cust_family()->create($request->customer['customer_family']);

        $user->cust_address()->create($request->customer['customer_address']);

        foreach ($request->customer['customer_financial_info']['income'] as $key => $income) {
            $user->cust_income()->create($income);
        }

        foreach ($request->customer['customer_financial_info']['liability'] as $key => $liability) {
            $user->cust_liability()->create($liability);
        }

        if ($request->customer['customer_details']['employment_type'] === 'Self-Employed') {
            $user->cust_self_employed()->create($request->customer['customer_employment_details']['self_employed']);
        } else {
            $user->cust_employed()->create($request->customer['customer_employment_details']['employed']);
        }


        return new CostumerResource($user);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
