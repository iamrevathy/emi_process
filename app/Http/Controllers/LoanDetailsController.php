<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanDetail;

class LoanDetailsController extends Controller
{
    public function index()
    {
        $loanDetails = LoanDetail::all();

        return view('loanDetails', compact('loanDetails'));
    }
}
