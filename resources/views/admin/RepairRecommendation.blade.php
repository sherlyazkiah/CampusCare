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
    { name: "Projector", values: [3, 4, 2, 3, 3, 4], vikor: 0.6157 },
    { name: "Classroom Chair", values: [2, 5, 4, 4, 5, 5], vikor: 0.6277 },
    { name: "Whiteboard", values: [2, 4, 1, 2, 4, 4], vikor: 0.8883 },
    { name: "Computer (Lab)", values: [5, 5, 3, 5, 5, 2], vikor: 0.1782 },
    { name: "Wi-Fi", values: [3, 5, 2, 5, 5, 3], vikor: 0.4508 },
    { name: "Water Dispenser", values: [3, 4, 4, 4, 3, 3], vikor: 0.4787 },
    { name: "Printer", values: [2, 3, 1, 2, 2, 4], vikor: 1.0000 },
    { name: "CCTV", values: [4, 4, 5, 4, 4, 2], vikor: 0.2793 },
    { name: "Room Light", values: [3, 4, 2, 3, 4, 3], vikor: 0.6157 },
    { name: "Toilet", values: [4, 5, 5, 5, 5, 3], vikor: 0.0000 },
    { name: "Classroom Table", values: [2, 4, 1, 3, 4, 4], vikor: 0.8457 },
    { name: "Ceiling Fan", values: [2, 3, 1, 3, 3, 4], vikor: 0.9574 },
    { name: "Electrical Outlet", values: [3, 5, 4, 5, 5, 2], vikor: 0.3564 },
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
        <button type="button" data-modal-target="add-room-modal" data-modal-toggle="add-room-modal"
          class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Assign
        </button>
      </td>
    `;
    tbody.appendChild(row);
  });
</script>


  <div class="mt-10">
  <a href="{{ url('admin/calculation-step') }}" class="underline font-semibold text-lg">
    Show the Calculation
  </a>
</div>

</div>
@endsection
