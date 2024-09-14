@extends('user.layouts.master')

@section('title')
    <title>Investorbhai - RD Calculator</title>
@endsection

@section('content')
<div class="main_content_wrapper p-4">
    <!-- Content for the left side -->
    <h3 class="page-header border-b pb-2 mb-3">Recurring Deposit Calculator</h3>

    <!-- Flex container for form and result -->
    <div class="flex flex-col lg:flex-row">
        <!-- RD Calculator Form -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
            <form id="rd-calculator-form">
                <div class="mb-4">
                    <label for="monthly-deposit" class="block text-gray-700 font-bold mb-2">Monthly Deposit (P):</label>
                    <input type="number" id="monthly-deposit" name="monthly-deposit" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter monthly deposit" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="monthly-deposit-error">Please enter a valid monthly deposit.</p>
                </div>
                <div class="mb-4">
                    <label for="annual-interest-rate" class="block text-gray-700 font-bold mb-2">Annual Interest Rate (R in %):</label>
                    <input type="number" id="annual-interest-rate" name="annual-interest-rate" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter annual interest rate" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="annual-interest-rate-error">Please enter a valid annual interest rate.</p>
                </div>
                <div class="mb-4">
                    <label for="investment-duration" class="block text-gray-700 font-bold mb-2">Investment Duration (T in years):</label>
                    <input type="number" id="investment-duration" name="investment-duration" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter investment duration in years" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="investment-duration-error">Please enter a valid investment duration.</p>
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
            <p id="maturity-amount-result" class="text-gray-700 mt-2">Maturity Amount: <span class="font-semibold" id="maturity-amount"></span></p>
            <p id="total-deposits-result" class="text-gray-700 mt-2">Total Deposits: <span class="font-semibold" id="total-deposits"></span></p>
            <p id="total-interest-result" class="text-gray-700 mt-2">Total Interest Earned: <span class="font-semibold" id="total-interest"></span></p>
        </div>
    </div>
</div>

<!-- Script to handle the calculation, validation, and reset -->
<script>
$(document).ready(function() {
    // Handle form submission and calculation
    $('#rd-calculator-form').on('submit', function(event) {
        event.preventDefault();

        // Clear any previous error messages
        $('.text-red-500').addClass('hidden');

        // Get the input values
        let monthlyDeposit = parseFloat($('#monthly-deposit').val());
        let annualInterestRate = parseFloat($('#annual-interest-rate').val());
        let investmentDuration = parseFloat($('#investment-duration').val());
        let isValid = true;

        // Validate the inputs
        if (isNaN(monthlyDeposit) || monthlyDeposit <= 0) {
            $('#monthly-deposit-error').removeClass('hidden');
            isValid = false;
        }
        if (isNaN(annualInterestRate) || annualInterestRate <= 0) {
            $('#annual-interest-rate-error').removeClass('hidden');
            isValid = false;
        }
        if (isNaN(investmentDuration) || investmentDuration <= 0) {
            $('#investment-duration-error').removeClass('hidden');
            isValid = false;
        }

        if (isValid) {
            // Calculate maturity amount of RD
            let monthlyRate = annualInterestRate / 100 / 12;
            let numberOfMonths = investmentDuration * 12;
            let maturityAmount = monthlyDeposit * ((Math.pow(1 + monthlyRate, numberOfMonths) - 1) / monthlyRate) * (1 + monthlyRate);
            let totalDeposits = monthlyDeposit * numberOfMonths;
            let totalInterest = maturityAmount - totalDeposits;

            // Display the result
            $('#maturity-amount').text(maturityAmount.toFixed(2));
            $('#total-deposits').text(totalDeposits.toFixed(2));
            $('#total-interest').text(totalInterest.toFixed(2));
            $('#result').removeClass('hidden');
        }
    });

    // Handle reset button click
    $('#reset-button').on('click', function() {
        // Clear all input fields
        $('#rd-calculator-form')[0].reset();

        // Hide the result section
        $('#result').addClass('hidden');

        // Clear any error messages
        $('.text-red-500').addClass('hidden');
    });
});
</script>
@endsection
