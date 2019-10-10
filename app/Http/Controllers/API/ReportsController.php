<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Payment;
use App\PurchasedProduct;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function generateReport(Request $request)
    {
        if ($request->report_type == 'Daily') {
            $payments = Payment::whereDay('created_at', Carbon::parse($request->date)->day)->with('customer')->with('purchased_product.product')->with('cashier.branch')->get();
            $purchased_products = PurchasedProduct::whereDay('created_at', Carbon::parse($request->date)->day)->with('user')->with('product')->get();
            $data = [
                'payments' => $payments,
                'purchased_products' => $purchased_products,
                'purchased_products_count' => $purchased_products->count(),
                'payments_count' => $payments->count(),
                'total_payment' => $payments->sum('amount'),
                'total_downpayments' => $purchased_products->sum('product.downpayment'),
                'date' => Carbon::parse($request->date)->format('F m, Y'),

            ];
            return $data;
        }
        else if ($request->report_type == 'Monthly') {
            $payments = Payment::whereMonth('created_at', Carbon::parse($request->date)->month)->with('customer')->with('purchased_product.product')->with('cashier.branch')->get();
            $purchased_products = PurchasedProduct::whereMonth('created_at', Carbon::parse($request->date)->month)->with('user')->with('product')->get();
            $data = [
                'payments' => $payments,
                'purchased_products' => $purchased_products,
                'purchased_products_count' => $purchased_products->count(),
                'payments_count' => $payments->count(),
                'total_payment' => $payments->sum('amount'),
                'total_downpayments' => $purchased_products->sum('product.downpayment'),
                'date' => Carbon::parse($request->date)->format('F'),

            ];
            return $data;
        }
        else{
            $payments = Payment::whereYear('created_at', $request->date)->with('customer')->with('purchased_product.product')->with('cashier.branch')->get();
            $purchased_products = PurchasedProduct::whereYear('created_at', $request->date)->with('user')->with('product')->get();
            $data = [
                'payments' => $payments,
                'purchased_products' => $purchased_products,
                'purchased_products_count' => $purchased_products->count(),
                'payments_count' => $payments->count(),
                'total_payment' => $payments->sum('amount'),
                'total_downpayments' => $purchased_products->sum('product.downpayment'),
                'date' => $request->date,

            ];
            return $data;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
