@extends('user.layouts.master')

@section('title')
    <title>Investorbhai - Compound Interest Calculator</title>
@endsection

@section('content')
<div class="main_content_wrapper p-4">
    <!-- Content for the left side -->
    <h3 class="page-header border-b pb-2 mb-3">Compound Interest Calculator</h3>

    <!-- Flex container for form and result -->
    <div class="flex flex-col lg:flex-row">
        <!-- Compound Interest Calculator Form -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
            <form id="compound-interest-form">
                <div class="mb-4">
                    <label for="principal" class="block text-gray-700 font-bold mb-2">Principal Amount (P):</label>
                    <input type="number" id="principal" name="principal" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter principal amount" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="principal-error">Please enter a valid principal amount.</p>
                </div>
                <div class="mb-4">
                    <label for="rate" class="block text-gray-700 font-bold mb-2">Rate of Interest (R):</label>
                    <input type="number" id="rate" name="rate" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter rate of interest" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="rate-error">Please enter a valid rate of interest.</p>
                </div>
                <div class="mb-4">
                    <label for="time" class="block text-gray-700 font-bold mb-2">Time Period (T in years):</label>
                    <input type="number" id="time" name="time" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter time period in years" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="time-error">Please enter a valid time period.</p>
                </div>
                <div class="mb-4">
                    <label for="n" class="block text-gray-700 font-bold mb-2">Number of Compounding Periods per Year (n):</label>
                    <input type="number" id="n" name="n" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter number of compounding periods per year" required>
                    <p class="text-red-500 text-sm mt-1 hidden" id="n-error">Please enter a valid number of compounding periods.</p>
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
            <p id="interest-result" class="text-gray-700 mt-2">Compound Interest: <span class="font-semibold" id="compound-interest"></span></p>
            <p class="text-gray-700 mt-2">Total Amount (Principal + Interest): <span class="font-semibold" id="total-amount"></span></p>
        </div>
    </div>
</div>

<!-- Script to handle the calculation, validation, and reset -->
<script>
$(document).ready(function() {
    // Handle form submission and calculation
    $('#compound-interest-form').on('submit', function(event) {
        event.preventDefault();

        // Clear any previous error messages
        $('.text-red-500').addClass('hidden');

        // Get the input values
        let principal = parseFloat($('#principal').val());
        let rate = parseFloat($('#rate').val());
        let time = parseFloat($('#time').val());
        let n = parseFloat($('#n').val());
        let isValid = true;

        // Validate the inputs
        if (isNaN(principal) || principal <= 0) {
            $('#principal-error').removeClass('hidden');
            isValid = false;
        }
        if (isNaN(rate) || rate <= 0) {
            $('#rate-error').removeClass('hidden');
            isValid = false;
        }
        if (isNaN(time) || time <= 0) {
            $('#time-error').removeClass('hidden');
            isValid = false;
        }
        if (isNaN(n) || n <= 0) {
            $('#n-error').removeClass('hidden');
            isValid = false;
        }

        if (isValid) {
            // Calculate compound interest
            let compoundInterest = principal * Math.pow((1 + (rate / (100 * n))), n * time) - principal;
            let totalAmount = principal + compoundInterest;

            // Display the result
            $('#compound-interest').text(compoundInterest.toFixed(2));
            $('#total-amount').text(totalAmount.toFixed(2));
            $('#result').removeClass('hidden');
        }
    });

    // Handle reset button click
    $('#reset-button').on('click', function() {
        // Clear all input fields
        $('#compound-interest-form')[0].reset();

        // Hide the result section
        $('#result').addClass('hidden');

        // Clear any error messages
        $('.text-red-500').addClass('hidden');
    });
});
</script>
@endsection
