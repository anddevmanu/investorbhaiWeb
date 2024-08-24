@extends('user.layouts.master')

@section('title')
    <title>Investorbhai - Loan Calculator</title>
@endsection

@section('content')
<div class="main_content_wrapper p-4">
    <!-- Content for the left side -->
    <h3 class="page-header border-b pb-2 mb-3">Loan Calculator</h3>

    <!-- Flex container for form and result -->
    <div class="flex flex-col lg:flex-row">
        <!-- Loan Calculator Form -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
            <form id="loan-calculator-form">
                <div class="mb-4">
                    <label for="loan-amount" class="block text-gray-700 font-bold mb-2">Loan Amount (L):</label>
                    <input type="number" id="loan-amount" name="loan-amount" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter loan amount" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="loan-amount-error">Please enter a valid loan amount.</p>
                </div>
                <div class="mb-4">
                    <label for="interest-rate" class="block text-gray-700 font-bold mb-2">Annual Interest Rate (R in %):</label>
                    <input type="number" id="interest-rate" name="interest-rate" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter annual interest rate" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="interest-rate-error">Please enter a valid interest rate.</p>
                </div>
                <div class="mb-4">
                    <label for="loan-term" class="block text-gray-700 font-bold mb-2">Loan Term (T in years):</label>
                    <input type="number" id="loan-term" name="loan-term" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter loan term in years" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="loan-term-error">Please enter a valid loan term.</p>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Calculate</button>
                    <button type="button" id="reset-button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 ml-2">Reset</button>
                </div>
            </form>
        </div>

        <!-- Result Section -->
        <div id="result" class="bg-white p-6 mt-4 lg:mt-0 lg:ml-4 rounded-lg shadow-md w-full lg:w-1/2 hidden">
            <h4 class="text-lg font-bold text-gray-800">Calculation Result:</h4>
            <p id="monthly-payment-result" class="text-gray-700 mt-2">Monthly EMI: <span class="font-semibold" id="monthly-payment"></span></p>
            <p id="total-interest-result" class="text-gray-700 mt-2">Total Interest: <span class="font-semibold" id="total-interest"></span></p>
            <p id="total-amount-result" class="text-gray-700 mt-2">Total Amount (Principal + Interest): <span class="font-semibold" id="total-amount"></span></p>
        </div>
    </div>
</div>

<!-- Script to handle the calculation, validation, and reset -->
<script>
$(document).ready(function() {
    // Handle form submission and calculation
    $('#loan-calculator-form').on('submit', function(event) {
        event.preventDefault();

        // Clear any previous error messages
        $('.text-red-500').addClass('hidden');

        // Get the input values
        let loanAmount = parseFloat($('#loan-amount').val());
        let interestRate = parseFloat($('#interest-rate').val());
        let loanTerm = parseFloat($('#loan-term').val());
        let isValid = true;

        // Validate the inputs
        if (isNaN(loanAmount) || loanAmount <= 0) {
            $('#loan-amount-error').removeClass('hidden');
            isValid = false;
        }
        if (isNaN(interestRate) || interestRate <= 0) {
            $('#interest-rate-error').removeClass('hidden');
            isValid = false;
        }
        if (isNaN(loanTerm) || loanTerm <= 0) {
            $('#loan-term-error').removeClass('hidden');
            isValid = false;
        }

        if (isValid) {
            // Calculate monthly payment and total interest
            let monthlyInterestRate = interestRate / 100 / 12;
            let numberOfPayments = loanTerm * 12;
            let monthlyPayment = (loanAmount * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -numberOfPayments));
            let totalAmount = monthlyPayment * numberOfPayments;
            let totalInterest = totalAmount - loanAmount;

            // Display the result
            $('#monthly-payment').text(monthlyPayment.toFixed(2));
            $('#total-interest').text(totalInterest.toFixed(2));
            $('#total-amount').text(totalAmount.toFixed(2));
            $('#result').removeClass('hidden');
        }
    });

    // Handle reset button click
    $('#reset-button').on('click', function() {
        // Clear all input fields
        $('#loan-calculator-form')[0].reset();

        // Hide the result section
        $('#result').addClass('hidden');

        // Clear any error messages
        $('.text-red-500').addClass('hidden');
    });
});
</script>
@endsection
