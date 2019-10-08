<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CostumerResource;
use App\Http\Resources\PurchasedProductsResource;
use App\Http\Resources\UserPaymentResource;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Twilio\Rest\Client;

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

    public function showUserPayments(){
        return UserPaymentResource::collection(User::whereHas('roles', function(Builder $query){ $query->where('name', 'Customer'); })->get());
    }

    public function getCustomersWithPurchase()
    {
        return CostumerResource::collection(User::whereHas('purchased_product')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'firstname' => $request->customer['customer_name']['firstname'],
            'middlename' => $request->customer['customer_name']['middlename'],
            'lastname' => $request->customer['customer_name']['lastname']
        ]);

        $user->roles()->attach(Role::where('name', 'Customer')->first());

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

    public function getPurchasedProducts(User $user)
    {
        return new PurchasedProductsResource($user->purchased_product);
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
        $user = User::find($id);
        $user->update([
            'firstname' => $request->name['firstname'],
            'middlename' => $request->name['middlename'],
            'lastname' => $request->name['lastname']
        ]);

        $user->cust_details()->update($request->details);

        $user->cust_family()->update($request->family);

        $user->cust_address()->update($request->address);

        foreach ($user->cust_income() as $key => $income) {
            $income->sync($request->income[$key]);
        }

        foreach ($user->cust_liability() as $key => $liability) {
            $liability->sync($request->liability[$key]);
        }

        if ($request->details['employment_type'] === 'Self-Employed') {
            $user->cust_self_employed()->update($request->employment_details);
        } else {
            $user->cust_employed()->update($request->employment_details);
        }


        return new CostumerResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([ 'value' => true]);
    }
}
