@extends('layouts.admin')

@section('main')
    <div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="w-full mb-1">
    <div class="mb-8">
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Repair Recommendation</h1>
    </div>
    </div>

    <div class="flex flex-col mt-10">
    <div class="overflow-x-auto rounded-lg">
    <div class="inline-block min-w-full align-middle">
    <div class="overflow-hidden shadow sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
    <thead class="text-center bg-gray-100 dark:bg-gray-700">
    <tr>
    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Rank</th>
    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">VIKOR Score</th>
    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Action</th>
    </tr>
    </thead>
    <tbody id="table-body" class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
      @foreach ($rankedResults as $index => $result)
      <tr class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $index + 1 }}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
      {{ $result['report']->facility->facility_name ?? '-' }}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
      {{ number_format($result['Q'], 4) }}</td>
      <td class="p-4 whitespace-nowrap">
      <button onclick="openAssignModal({{ $result['report']->damage_report_id }})"
      class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
      Assign
      </button>
      </tr>
    @endforeach
    </tbody>

    </table>
    </div>
    </div>
    </div>
    </div>

    <!-- Assign Modal -->
    <div id="assign-modal" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="relative w-full max-w-2xl max-h-full">
    <form action="{{ route('assign.technician') }}" method="POST"
    class="relative bg-white rounded-lg shadow dark:bg-gray-700">
    @csrf
    <input type="hidden" name="damage_report_id" id="damage_report_id">

    <!-- Modal Header -->
    <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t dark:border-gray-600">
    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Assign Technician</h3>
    <button type="button"
    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
    onclick="closeAssignModal()">
    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
    </svg>
    <span class="sr-only">Close modal</span>
    </button>
    </div>

    <!-- Modal Body -->
    <div class="p-6 space-y-4">
    <div class="grid grid-cols-6 gap-6">
    <div class="col-span-6">
    <label for="technician_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
    Technician
    </label>
    @isset($technicians)
    <select id="technician_id" name="technician_id" required
    class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    <option value="" disabled selected>-- Choose Technician --</option>
    @foreach($technicians as $technician)
    <option value="{{ $technician->id }}">
    {{ $technician->username }}
    </option>
    @endforeach
    </select>
    @else
    <p class="text-red-600 text-sm">Tidak ada teknisi tersedia saat ini.</p>
    @endisset
    </div>
    </div>
    </div>

    <!-- Modal Footer -->
    <div class="flex justify-end p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
    <button type="submit"
    class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    Assign
    </button>
    </div>
    </form>
    </div>
    </div>

    <!-- Modal Control Script -->
    <script>
    function openAssignModal(reportId) {
    document.getElementById('assign-modal').classList.remove('hidden');
    document.getElementById('damage_report_id').value = reportId;
    }
    function closeAssignModal() {
    document.getElementById('assign-modal').classList.add('hidden');
    document.getElementById('damage_report_id').value = '';
    }
    </script>

  <div class="mt-10">
    <div class="flex justify-end space-x-4 mb-6">
    <a href="{{ route('repair.pdf') }}" target="_blank"
    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow">
    Export PDF
    </a>
    </div>

    <h1 class="text-2xl font-bold mb-6">VIKOR Calculation Steps</h1>

    {{-- Step 1: Decision Matrix --}}
    <div class="mb-10">
    <h2 class="text-xl font-semibold mb-2">Decision Matrix</h2>
    <div class="overflow-x-auto rounded-lg">
      <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden shadow sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
      <thead class="text-center bg-gray-100 dark:bg-gray-700">
        <tr>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
        @foreach ($criteriaLabels as $label)
      <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">{{ $label }}</th>
      @endforeach
        </tr>
      </thead>
      <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
        @foreach ($reports as $report)
        <tr>
        <td class="p-4 text-sm text-gray-700 dark:text-gray-200">{{ $report->facility->facility_name ?? '-' }}</td>
        @foreach (array_keys($criteriaLabels) as $c)
      <td class="p-4 text-sm text-gray-600 dark:text-gray-300">{{ $report->$c }}</td>
      @endforeach
        </tr>
      @endforeach
      </tbody>
      </table>
      </div>
      </div>
    </div>
    </div>

    {{-- Step 2: f+ and f- --}}
    <div class="mb-10">
    <h2 class="text-xl font-semibold mb-2">Step 1: f⁺ (Best) and f⁻ (Worst)</h2>
    <div class="overflow-x-auto rounded-lg">
      <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden shadow sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
      <thead class="text-center bg-gray-100 dark:bg-gray-700">
        <tr>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Criterion</th>
        @foreach ($criteriaLabels as $key => $label)
      <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">{{ $label }}</th>
      @endforeach
        </tr>
      </thead>
      <tbody class="text-center bg-white dark:bg-gray-800">
        <tr>
        <td class="p-4 text-sm font-semibold text-gray-700 dark:text-gray-300">f⁺ (Best)</td>
        @foreach ($fPlus as $val)
      <td class="p-4 text-sm text-gray-600 dark:text-gray-300">{{ $val }}</td>
      @endforeach
        </tr>
        <tr>
        <td class="p-4 text-sm font-semibold text-gray-700 dark:text-gray-300">f⁻ (Worst)</td>
        @foreach ($fMinus as $val)
      <td class="p-4 text-sm text-gray-600 dark:text-gray-300">{{ $val }}</td>
      @endforeach
        </tr>
        <tr class="text-center bg-gray-100 dark:bg-gray-700">
        <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
        Weight
        </td>
        <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">0.2</td>
        <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">0.15</td>
        <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">0.2</td>
        <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">0.2</td>
        <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">0.15</td>
        <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">0.1</td>
        </tr>
      </tbody>
      </table>
      </div>
      </div>
    </div>
    </div>

    {{-- Step 3: Normalization and Weighted Values --}}
    <div class="mb-10">
    <h2 class="text-xl font-semibold mb-2">Step 2: Normalization and Weighted Values</h2>
    <p class="mb-4 text-gray-600 dark:text-gray-400">Normalized values are computed using f⁺ and f⁻, then multiplied by their respective weights.</p>
    <div class="overflow-x-auto rounded-lg">
      <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden shadow sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
      <thead class="text-center bg-gray-100 dark:bg-gray-700">
        <tr>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
        @foreach ($criteriaLabels as $label)
      <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">{{ $label }}</th>
      @endforeach
        </tr>
      </thead>
      <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
        @foreach ($normalized ?? [] as $i => $row)
        <tr>
        <td class="p-4 text-sm text-gray-700 dark:text-gray-200">{{ $reports[$i]->facility->facility_name ?? '-' }}</td>
        @foreach (array_keys($criteriaLabels) as $key)
      <td class="p-4 text-sm text-gray-600 dark:text-gray-300">{{ number_format($row[$key], 4) }}</td>
      @endforeach
        </tr>
      @endforeach
      </tbody>
      </table>
      </div>
      </div>
    </div>
    </div>

    {{-- Step 4: S and R Calculation --}}
    <div class="mb-10">
    <h2 class="text-xl font-semibold mb-2">Step 3: S and R Calculation</h2>
    <div class="overflow-x-auto rounded-lg">
      <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden shadow sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
      <thead class="text-center bg-gray-100 dark:bg-gray-700">
        <tr>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">S</th>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">R</th>
        </tr>
      </thead>
      <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
        @foreach ($results as $res)
      <tr>
      <td class="p-4 text-sm text-gray-700 dark:text-gray-200">{{ $res['report']->facility->facility_name ?? '-' }}</td>
      <td class="p-4 text-sm text-gray-600 dark:text-gray-300">{{ number_format($res['S'], 4) }}</td>
      <td class="p-4 text-sm text-gray-600 dark:text-gray-300">{{ number_format($res['R'], 4) }}</td>
      </tr>
      @endforeach
      </tbody>
      </table>
      </div>
      </div>
    </div>
    </div>

    {{-- Step 5: Q Calculation --}}
    <div class="mb-10">
    <h2 class="text-xl font-semibold mb-2">Step 4: Q Calculation</h2>
    <div class="overflow-x-auto rounded-lg">
      <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden shadow sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
      <thead class="text-center bg-gray-100 dark:bg-gray-700">
        <tr>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Q</th>
        </tr>
      </thead>
      <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
        @foreach ($results as $res)
      <tr>
      <td class="p-4 text-sm text-gray-700 dark:text-gray-200">{{ $res['report']->facility->facility_name ?? '-' }}</td>
      <td class="p-4 text-sm text-gray-700 dark:text-gray-200">{{ number_format($res['Q'], 4) }}</td>
      </tr>
      @endforeach
      </tbody>
      </table>
      </div>
      </div>
    </div>
    </div>

    {{-- Step 6: Final Ranking --}}
    <div class="mb-10">
    <h2 class="text-xl font-semibold mb-2">Step 5: Final Ranking</h2>
    <div class="overflow-x-auto rounded-lg">
    <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden shadow sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
      <thead class="text-center bg-gray-100 dark:bg-gray-700">
      <tr>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Rank</th>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Q</th>
      </tr>
      </thead>
      <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
      @foreach ($rankedResults as $index => $res)
      <tr>
      <td class="p-4 text-sm text-gray-700 dark:text-gray-200">{{ $index + 1 }}</td>
      <td class="p-4 text-sm text-gray-700 dark:text-gray-200">{{ $res['report']->facility->facility_name ?? '-' }}</td>
      <td class="p-4 text-sm font-bold text-gray-600 dark:text-gray-400">{{ number_format($res['Q'], 4) }}</td>
      </tr>
    @endforeach
      </tbody>
      </table>
      </div>
    </div>
    </div>
    </div>
    </div>


    </div>
@endsection

