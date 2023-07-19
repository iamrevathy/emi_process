<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class ProcessController extends Controller
{
    public function processData()
    {
        // Get the min first_payment_date and max last_payment_date from the loan_details table
        $result = DB::select('SELECT MIN(first_payment_date) as min_date, MAX(last_payment_date) as max_date FROM loan_details');
        $minDate = $result[0]->min_date;
        $maxDate = $result[0]->max_date;

        // Drop the emi_details table if it exists
        DB::statement('DROP TABLE IF EXISTS emi_details');

        // Generate the column names for each month between minDate and maxDate
        $columnNames = [];
        $updateArray = [];
        $currentDate = $minDate;
        while ($currentDate <= $maxDate) {
            $columnName = date('M Y',strtotime($currentDate));
            $columnName = str_replace(' ', '_', $columnName);
            $columnNames[] = $columnName;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 month'));
        }

        // Create the emi_details table with the generated column names
        $query = $query = 'CREATE TABLE emi_details (clientid INT, ' . implode(' DECIMAL(10, 2) DEFAULT 0, ', $columnNames) . ' DECIMAL(10, 2) DEFAULT 0)';
        DB::statement($query);
        $loanDetails = LoanDetail::all();
        foreach ($loanDetails as $loanDetail) {
            $columnName = "";
            $updateArray = array();
            $loanAmount = $loanDetail->loan_amount;
            $numOfPayments = $loanDetail->num_of_payment;
            $emiAmount = $loanAmount / $numOfPayments;
            $firstPayment =$loanDetail->first_payment_date;
            $updateArray['clientid']  = $loanDetail->clientid;
            $payAmount =0;
            while ($firstPayment <= $loanDetail->last_payment_date) {
                $columnName = date('M Y',strtotime($firstPayment));
                $columnName = str_replace(' ', '_', $columnName);
                $payAmount +=$emiAmount;
                if($payAmount < $loanAmount){
                $updateArray[$columnName] = $emiAmount ;
                }
                else
                {
                $updateArray[$columnName] = 0 ;
                }
                $firstPayment = date('Y-m-d', strtotime($firstPayment . ' +1 month'));
            }
            DB::table('emi_details')->insert($updateArray);
        }
        
        Session::flash('message', 'You have been successfully completed.');
        $emiData = DB::table('emi_details')->get();
        $data = array();
        $i=0;
        
         foreach ($emiData as $emi) {

            $data[$i]['client_id'] =$emi->clientid;
            unset($emi->clientid);
            $data[$i]['month_details']=$emi;
            $i++;
    }
    $columns = Schema::getColumnListing('emi_details');
    unset($columns[0]);
    return view('process-data',['data' => $data , 'columns' => $columns]);
    
        return redirect()->back();
    }
    
}
