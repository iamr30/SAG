<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('payments.payments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function showAll()
    {

        return Payment::with('users_cdu')->get();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = new Payment();
        $payment->id_userCDU = $request->id_userCDU;
        $payment->reference = $request->reference;
        $payment->comments = $request->comments;
        $payment->expiration_date = $request->expiration_date;
        $payment->amount = $request->amount;
        $payment->id_assigned = $request->id_assigned;
        $payment->save();
        $payment = Payment::with('users_cdu')->findOrFail($payment->id);
        return $payment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $payment = Payment::with('users_cdu')->findOrFail($id);
        $data = ['payment'=>$payment];
        return view('payments.details', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $payment = Payment::with('users_cdu')->findOrFail($id);
        $data = ['payment'=>$payment];
        return view('payments.create_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {

        $payment->id_userCDU = $request->id_userCDU;
        $payment->reference = $request->reference;
        $payment->comments = $request->comments;
        $payment->expiration_date = $request->expiration_date;
        $payment->amount = $request->amount;
        $payment->id_assigned = $request->id_assigned;
        $payment->save();
        $payment;
        return $payment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $payment = Payment::findorFail($id);
            $payment->delete();
            $information = 'good';
            $data = ['information'=>$information];
            return $data;
        }catch (\Illuminate\Database\QueryException $e) {
            $information = 'bad';
            $data = ['information'=>$information];
            return $data;
        }
    }
}
