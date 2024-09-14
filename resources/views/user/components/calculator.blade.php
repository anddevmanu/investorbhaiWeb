<section class="my-3 calculators">
    <h3 class="page-header border-b pb-2 mb-3">Calculators</h3>
    <ul class="space-y-2 pl-4">
        <li class="flex justify-between items-center border-b py-2">
            <a href="{{ route('simple.calculator') }}" class="text-blue-600 hover:underline">Simple Interest</a>
        </li>
        <li class="flex justify-between items-center border-b py-2">
            <a class="text-blue-600 hover:underline" href="{{ route('compound.calculator') }}">Compound Interest</a>
        </li>
        <li class="flex justify-between items-center border-b py-2">
            <a class="text-blue-600 hover:underline" href="{{ route('loan.calculator') }}">Loan Calculator</a>
        </li>
        <li class="flex justify-between items-center border-b py-2">
            <a class="text-blue-600 hover:underline" href="{{ route('sip.calculator') }}">SIP Calculator</a>
        </li>
        <li class="flex justify-between items-center border-b py-2">
            <a class="text-blue-600 hover:underline" href="{{ route('ppf.calculator') }}">PPF Calculator</a>
        </li>
        <li class="flex justify-between items-center border-b py-2">
            <a class="text-blue-600 hover:underline" href="{{ route('rd.calculator') }}">RD Calculator</a>
        </li>
    </ul>
</section>
