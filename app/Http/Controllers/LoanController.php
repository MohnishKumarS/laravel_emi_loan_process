<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\LoanDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // show loan details
    public function loan_details()
    {
        $loanDetails  = LoanDetails::all();

        return view('loan-details', compact('loanDetails'));
    }

    public function process_data()
    {
        // Check if the table exists
        $tableExists = DB::select('SHOW TABLES LIKE "emi_details"');

        if ($tableExists) {
            $emi = DB::table('emi_details')->get();
        } else {
            $emi = collect();
        }
        return view('process-data', compact('emi'));
    }

    public function process_emi()
    {
        $loanCount  = LoanDetails::count();
        if ($loanCount == 0) {
            return redirect('process-data')->with('status', 'error')->with('title', 'No data found in client loan');
        }
        DB::statement('DROP TABLE IF EXISTS emi_details');

        $loanDetails = DB::table('loan_details')->get();

        $firstDate = $loanDetails->min('first_payment_date');
        $lastDate = $loanDetails->max('last_payment_date');


        function getMonthNamesAndQuery($startDate, $endDate)
        {

            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);

            $monthColumn  = [];

            $sql = "CREATE TABLE emi_details (
            id BIGINT UNSIGNED  AUTO_INCREMENT  PRIMARY KEY,
            clientid int NOT NULL";
            // Iterate through each month between the start and end dates
            while ($start->lte($end)) {

                $monthColumn[] = $start->format('Y_M');
                $sql .= ", `{$start->format('Y_M')}` VARCHAR(255)  DEFAULT 0.00";
                // Move to the first day of the next month
                $start->addMonth()->startOfMonth();
            }

            $sql .= ")";

            return   ['sql' => $sql, 'allMonths' => $monthColumn];
        }



        // Get all months and sql query
        $res = getMonthNamesAndQuery($firstDate, $lastDate);
        // echo $res['sql'];

        // create the table
        DB::statement($res['sql']);

        foreach ($loanDetails as $loan) {
            $emiAmount = $loan->loan_amount / $loan->num_of_payment;

            $emiData = [
                'clientid' => $loan->clientid,
            ];

            $start = Carbon::parse($loan->first_payment_date);
            $end = Carbon::parse($loan->last_payment_date);
            $months = [];

            while ($start->lte($end)) {
                $monthColumn = $start->format('Y_M');
                $months[] = $monthColumn;
                $start->addMonth();
            }

            $totalEmi = 0;
            foreach ($months as $index => $month) {
                if ($index < $loan->num_of_payment - 1) {
                    $emiData[$month] = round($emiAmount, 2);
                    $totalEmi += $emiAmount;
                } else {
                    // last remaining payment 
                    $truncatedNumber = floor(($loan->loan_amount - $totalEmi) * 100) / 100;
                    $emiData[$month] = number_format($truncatedNumber, 2, '.', '');
                }
            }

            DB::table('emi_details')->insert($emiData);
        }

        $emi =  DB::table('emi_details')->get();
        // return $emi;

        return redirect('process-data')->with('status', 'success')->with('title', 'Emi Data has been successfully generated')->with('emi', $emi);
    }
}
