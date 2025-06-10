@extends('layouts.admin')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="w-full mb-1">
            <div class="mb-8">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Repair Recommendation</h1>
            </div>
    </div>

<div class="flex flex-col mt-6">
  <div class="overflow-x-auto rounded-lg">
    <div class="inline-block min-w-1/2 align-middle">
      <div class="overflow-hidden shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
          <thead class="text-center bg-gray-100 dark:bg-gray-700">
            <tr>
              <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Criterion</th>
              <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Weight</th>
              <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Type</th>
            </tr>
          </thead>
          <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
            <tr>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                C1: Damage Severity
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                0.2
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                Benefit
              </td>
            </tr>
            <tr>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                C2: Usage Importance
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                0.15
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                Benefit
              </td>
            </tr>
            <tr>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                C3: Safety Concern
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                0.2
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                Benefit
              </td>
            </tr>
            <tr>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                C4: Repair Urgency
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                0.2
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                Benefit
              </td>
            </tr>
            <tr>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                C5: Impact on People
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                0.15
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                Benefit
              </td>
            </tr>
            <tr>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                C6: Time to Repair
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                0.1
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                Cost
              </td>
            </tr>
            <tr class="text-center bg-gray-100 dark:bg-gray-700">
              <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                Total
              </td>
              <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                1.0
              </td>
              <td class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
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
                @foreach ($criteriaLabels as $key => $label)
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">{{ $label }} ({{ strtoupper($key) }})</th>
                @endforeach
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">VIKOR Score</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Action</th>
              </tr>
            </thead>
            <tbody id="table-body" class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
              @foreach ($results as $index => $result)
                    <tr class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $index + 1 }}</td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $result['report']->facility->facility_name ?? '-' }}</td>
                        @foreach ($criteriaLabels as $key => $label)
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $result['report']->$key }}</td>
                        @endforeach
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ number_format($result['Q'], 4) }}</td>
                        <td class="p-4 whitespace-nowrap">
                          <button type="button" data-modal-target="assign-modal" data-modal-toggle="assign-modal"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Assign
                          </button>
                        </td>
                      </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<!-- Assign Modal -->
    <div id="assign-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <form action="{{ route('assign.technician') }}" method="POST" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          @csrf
          <input type="hidden" name="report_id" id="report_id">
            <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Assign Technician
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="assign-modal">
                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6">
                      <label for="technician" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                          Technician
                      </label>
                      <select id="technician" name="technician" class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                          @foreach($reports as $report)
                          <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->user->name ?? '-' }}</td>
                            <td>{{ $report->facility->name ?? '-' }}</td>
                            <td>
                              <!-- Tombol untuk buka modal assign -->
                              <button 
                                onclick="openAssignModal({{ $report->id }})"
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
                              >
                                Assign Technician
                              </button>
                            </td>
                          </tr>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
            </div>
            </div>

            <div class="flex justify-end p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button
                    onclick="openAssignModal({{ $report->id }})"
                    class="text-white bg-green-600 px-3 py-1 rounded hover:bg-green-700">
                    Assign
                </button>
            </div>
            </form>
        </div>
    </div>

    <script>
    function openAssignModal(reportId) {
        document.getElementById('assign-modal').classList.remove('hidden');
        document.getElementById('report_id').value = reportId;
    }
    </script>

  <div class="mt-10">
  {{-- <a href="{{ url('admin/calculation-step') }}" class="underline font-semibold text-lg">
    Show the Calculation
  </a> --}}
</div>

</div>
@endsection