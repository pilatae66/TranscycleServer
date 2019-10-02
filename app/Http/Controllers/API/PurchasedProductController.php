<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchasedProductsResource;
use App\PurchasedProduct;

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
        return $request->all();
        $purchased_product = PurchasedProduct::create($request->all());

        return $purchased_product;
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
