<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::with(['customer','order'])->paginate(env('PAGINATION_CODE'));
        return view('admin.payments.payments')->with([
        'payments'=>$payments]);
    }
}
