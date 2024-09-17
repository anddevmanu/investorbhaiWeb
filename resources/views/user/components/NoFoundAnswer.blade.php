<div class="bg-white shadow-sm rounded mb-2 mt-3 p-4 border">
    <div class="flex items-center">
        <!-- Image Section (Hidden on small screens) -->
        <div class="hidden sm:block w-2/12">
            <img src="{{ asset('frontend/img/home_support/answer.png') }}" alt="no-answer" class=""/>
        </div>
        <!-- Text Section (Hidden on small screens) -->
        <div class="hidden sm:block w-7/12 pl-4">
            <h3 class="text-lg font-semibold">Can't find an answer?</h3>
            <p class="mb-0 text-gray-600">Make use of a qualified tutor to get the answer</p>
        </div>
        <!-- Button Section (Visible on all screens) -->
        <div class="w-full sm:w-full flex justify-center sm:justify-end items-center">
            <a href="{{ route('create.question') }}" class="bg-blue-600 text-white text-lg py-2 px-4 rounded-lg text-center sm:text-lg sm:py-2 sm:px-4">
                Ask a question
            </a>
        </div>
    </div>
</div>
