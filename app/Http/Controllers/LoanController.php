<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\LoanDetails;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // show loan details
    public function loan_details(){
        $loanDetails  = LoanDetails::all();

        return view('loan-details', compact('loanDetails'));
    }

    public function process_data(){
        return view('process-data');
    }

    public function process_emi(){

        $loanDetails = LoanDetails::get();

        $firstDate = $loanDetails->min('first_payment_date');
        $lastDate = $loanDetails->max('last_payment_date');


        $start = new DateTime($firstDate);
        $end = new DateTime($lastDate);
        return $start;
    }


}
