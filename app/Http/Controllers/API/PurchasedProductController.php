<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchasedProductsResource;
use App\PurchasedProduct;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PurchasedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PurchasedProductsResource::collection(PurchasedProduct::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dates = [ 1, 5, 9, 12, 16, 20, 23 ];
        $due_date = "";
        $day = Carbon::now()->day;
        foreach ($dates as $key => $date) {
            if ($day <= $date && $day > $dates[$key-1]) {
                $due_date = Carbon::parse(Carbon::now()->year."-".(Carbon::now()->month + 1)."-".$date)->toDateString();
            }
        }

        return PurchasedProduct::create([
            'term' => $request->term,
            'amount_finance' => $request->amount_finance,
            'amount_due' => $request->amount_due,
            'monthly_amortization' => $request->monthly_amortization,
            'due_date' => $due_date,
            'priority_level' => $request->priority_level,
            'MC_user_type' => $request->MC_user_type,
            'loan_purpose' => $request->loan_purpose,
            'sales_agent' => $request->sales_agent,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,

        ]);
    }

    public function setAppDetails(PurchasedProduct $purchased_product, Request $request)
    {
        $purchased_product->app_details()->create($request->all());

        return $purchased_product->app_details;
    }

    public function setRequirements(PurchasedProduct $purchased_product, Request $request)
    {
        foreach ($request->all() as $requirement) {
            $purchased_product->app_requirements()->create([
                'requirement_name' => $requirement
            ]);
        }

        return $purchased_product->app_requirements;
    }

    public function getDueCustomers()
    {
        $users = User::whereHas('purchased_product')->get();
        $due_users = new Collection();
        foreach ($users as $key => $user) {
            $due_date = Carbon::parse($user->purchased_product->due_date);
            $latest_payment = $user->latest_payment != null  ? $user->latest_payment : Carbon::now();
            if ($latest_payment >= $due_date) {
                $due_users->push($user->purchased_product);
            }
        }

        return PurchasedProductsResource::collection($due_users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PurchasedProduct $purchased_product)
    {
        return new PurchasedProductsResource($purchased_product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasedProduct $purchased_product)
    {
        $purchased_product->update($request->all());

        $purchased_product->app_details()->update($request->app_details);

        $purchased_product->app_requirements()->delete();
        foreach ($request->requirements as $requirement) {
            $purchased_product->app_requirements()->create([
                'requirement_name' => $requirement
            ]);
        }

        return new PurchasedProductsResource($purchased_product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasedProduct $purchased_product)
    {
        $purchased_product->delete();
        return response()->json([ 'value' => true]);
    }
}
