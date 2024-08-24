@extends('user.layouts.master')

@section('title')
    <title>Investorbhai - PPF Calculator</title>
@endsection

@section('content')
<div class="main_content_wrapper p-4">
    <!-- Content for the left side -->
    <h3 class="page-header border-b pb-2 mb-3">PPF Calculator</h3>

    <!-- Flex container for form and result -->
    <div class="flex flex-col lg:flex-row">
        <!-- PPF Calculator Form -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
            <form id="ppf-calculator-form">
                <div class="mb-4">
                    <label for="monthly-contribution" class="block text-gray-700 font-bold mb-2">Monthly Contribution (P):</label>
                    <input type="number" id="monthly-contribution" name="monthly-contribution" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter monthly contribution" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="monthly-contribution-error">Please enter a valid monthly contribution.</p>
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
            <p id="future-value-result" class="text-gray-700 mt-2">Future Value of Investment: <span class="font-semibold" id="future-value"></span></p>
            <p id="total-investment-result" class="text-gray-700 mt-2">Total Investment: <span class="font-semibold" id="total-investment"></span></p>
            <p id="total-returns-result" class="text-gray-700 mt-2">Total Returns: <span class="font-semibold" id="total-returns"></span></p>
        </div>
    </div>
</div>

<!-- Script to handle the calculation, validation, and reset -->
<script>
$(document).ready(function() {
    // Handle form submission and calculation
    $('#ppf-calculator-form').on('submit', function(event) {
        event.preventDefault();

        // Clear any previous error messages
        $('.text-red-500').addClass('hidden');

        // Get the input values
        let monthlyContribution = parseFloat($('#monthly-contribution').val());
        let annualInterestRate = parseFloat($('#annual-interest-rate').val());
        let investmentDuration = parseFloat($('#investment-duration').val());
        let isValid = true;

        // Validate the inputs
        if (isNaN(monthlyContribution) || monthlyContribution <= 0) {
            $('#monthly-contribution-error').removeClass('hidden');
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
            // Calculate future value of PPF
            let monthlyRate = annualInterestRate / 100 / 12;
            let numberOfMonths = investmentDuration * 12;
            let futureValue = monthlyContribution * ((Math.pow(1 + monthlyRate, numberOfMonths) - 1) / monthlyRate) * (1 + monthlyRate);
            let totalInvestment = monthlyContribution * numberOfMonths;
            let totalReturns = futureValue - totalInvestment;

            // Display the result
            $('#future-value').text(futureValue.toFixed(2));
            $('#total-investment').text(totalInvestment.toFixed(2));
            $('#total-returns').text(totalReturns.toFixed(2));
            $('#result').removeClass('hidden');
        }
    });

    // Handle reset button click
    $('#reset-button').on('click', function() {
        // Clear all input fields
        $('#ppf-calculator-form')[0].reset();

        // Hide the result section
        $('#result').addClass('hidden');

        // Clear any error messages
        $('.text-red-500').addClass('hidden');
    });
});
</script>
@endsection
