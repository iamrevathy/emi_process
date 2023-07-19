<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $currentDate = $minDate;
        while ($currentDate <= $maxDate) {
            $columnName = date('M Y',strtotime($currentDate));
            $columnName = str_replace(' ', '_', $columnName);
            $columnNames[] = $columnName;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 month'));
        }

        // Create the emi_details table with the generated column names
        $query = 'CREATE TABLE emi_details (clientid INT, ' . implode(' INT, ', $columnNames) . ' INT)';
        DB::statement($query);

        // Return the view with the button
        //return view('process-data');
    }
}
