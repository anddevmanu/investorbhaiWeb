<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function simpleInterest(){
        return view('user.pages.calculator.simpleInterest');
    }

    public function compoundInterest(){
        return view('user.pages.calculator.compoundInterest');
    }

    public function loanCalculator(){
        return view('user.pages.calculator.loanCalculator');
    }

    public function sipCalculator(){
        return view('user.pages.calculator.sipCalculator');
    }

    public function ppfCalculator(){
        return view('user.pages.calculator.ppfCalculator');
    }

    public function rdCalculator(){
        return view('user.pages.calculator.rdCalculator');
    }
}
