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
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Damage Severity (C1)</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Usage Importance (C2)</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Safety Concern (C3)</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Repair Urgency (C4)</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Impact on Many People (C5)</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Time to Repair (C6)</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">VIKOR Score</th>
                <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Action</th>
              </tr>
            </thead>
            <tbody id="table-body" class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
              <!-- Rows will be inserted here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
  const alternatives = [
    { name: "Air Conditioner", values: [4, 4, 3, 4, 4, 3], vikor: 0.3112 },
    { name: "Projector", values: [3, 4, 2, 3, 3, 2], vikor: 0.6157 },
    { name: "Classroom Chair", values: [2, 5, 4, 4, 5, 2], vikor: 0.6277 },
    { name: "Whiteboard", values: [2, 4, 1, 2, 4, 2], vikor: 0.8883 },
    { name: "Computer (Lab)", values: [5, 5, 3, 5, 5, 4], vikor: 0.1782 },
    { name: "Wi-Fi", values: [3, 5, 2, 5, 5, 3], vikor: 0.4508 },
    { name: "Water Dispenser", values: [3, 4, 4, 4, 3, 3], vikor: 0.4787 },
    { name: "Printer", values: [2, 3, 1, 2, 2, 2], vikor: 1.0000 },
    { name: "CCTV", values: [4, 4, 5, 4, 4, 4], vikor: 0.2793 },
    { name: "Room Light", values: [3, 4, 2, 3, 4, 3], vikor: 0.6157 },
    { name: "Toilet", values: [4, 5, 5, 5, 5, 3], vikor: 0.0000 },
    { name: "Classroom Table", values: [2, 4, 1, 3, 4, 2], vikor: 0.8457 },
    { name: "Ceiling Fan", values: [2, 3, 1, 3, 3, 3], vikor: 0.9574 },
    { name: "Electrical Outlet", values: [3, 5, 4, 5, 5, 4], vikor: 0.3564 },
    { name: "Sink", values: [3, 4, 4, 4, 4, 3], vikor: 0.4468 }
  ];

  // Sort by VIKOR ascending (smallest is best)
  alternatives.sort((a, b) => a.vikor - b.vikor);

  const tbody = document.getElementById("table-body");

  alternatives.forEach((item, index) => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${index + 1}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.name}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.values[0]}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.values[1]}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.values[2]}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.values[3]}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.values[4]}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.values[5]}</td>
      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${item.vikor.toFixed(4)}</td>
      <td class="p-4 whitespace-nowrap">
        <button type="button" data-modal-target="assign-modal" data-modal-toggle="assign-modal"
          class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Assign
        </button>
      </td>
    `;
    tbody.appendChild(row);
  });
</script>

<!-- Assign Modal -->
    <div id="assign-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <form class="relative bg-white rounded-lg shadow dark:bg-gray-700">
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
                          <option value="">Select Technician</option>
                          <option value="">Technician 1</option>
                          <option value="">Technician 2</option>
                          <option value="">Technician 3</option>
                          <option value="">Technician 4</option>
                      </select>
                  </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
            </div>
            </div>

            <div class="flex justify-end p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Assign</button>
            </div>
            </form>
        </div>
    </div>


  <div class="mt-10">
  <a href="{{ url('admin/calculation-step') }}" class="underline font-semibold text-lg">
    Show the Calculation
  </a>
</div>

</div>
@endsection
