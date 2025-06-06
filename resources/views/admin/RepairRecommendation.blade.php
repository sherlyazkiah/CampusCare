@extends('layouts.admin')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="w-full mb-1">
            <div class="mb-8">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Repair Recommendation</h1>
            </div>
    </div>

    <!-- Top Bar with Export and Steps -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <!-- Breadcrumb Steps -->
        <div class="flex items-center overflow-x-auto py-2 w-full sm:w-auto">
            <!-- Step 1 -->
            <div class="flex items-center shrink-0">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white dark:bg-blue-700">
                    1
                </div>
                <div class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-400 whitespace-nowrap">Criteria</div>
            </div>
            
            <!-- Arrow -->
            <div class="flex items-center mx-2 shrink-0">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            
            <!-- Step 2 -->
            <div class="flex items-center shrink-0">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white dark:bg-blue-700">
                    2
                </div>
                <div class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-400 whitespace-nowrap">Weights</div>
            </div>
            
            <!-- Arrow -->
            <div class="flex items-center mx-2 shrink-0">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            
            <!-- Step 3 -->
            <div class="flex items-center shrink-0">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white dark:bg-blue-700">
                    3
                </div>
                <div class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-400 whitespace-nowrap">Normalize</div>
            </div>
            
            <!-- Arrow -->
            <div class="flex items-center mx-2 shrink-0">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            
            <!-- Step 4 -->
            <div class="flex items-center shrink-0">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white dark:bg-blue-700">
                    4
                </div>
                <div class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-400 whitespace-nowrap">Calculate</div>
            </div>
            
            <!-- Arrow -->
            <div class="flex items-center mx-2 shrink-0">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            
            <!-- Step 5 -->
            <div class="flex items-center shrink-0">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white dark:bg-blue-700">
                    5
                </div>
                <div class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-400 whitespace-nowrap">Prioritize</div>
            </div>
        </div>

        <!-- Export Button -->
        <div class="shrink-0">
            <a href="#" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                </svg>
                Export
            </a>
        </div>
    </div>
    
    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto rounded-lg">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="text-center bg-gray-100 dark:bg-gray-700">
                  <tr>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Facility
                    </th><th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Damage Severity (C1)
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Usage Importance (C2)
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Safety Concern (C3)
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Repair Urgency (C4)
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Impact on Many People (C5)
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Time to Repair (C6)
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Vikor Score
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                  <tr>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      Projector
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      5
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      2
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      4
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      3
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      2
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      4
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      0.65
                    </td>
                    <td class="p-4 whitespace-nowrap">
                      <button type="button" data-modal-target="add-room-modal" data-modal-toggle="add-room-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      Assign
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      AC
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      3
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      1
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      2
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      4
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      2
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      3
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      0.82
                    </td>
                  </tr>
                  <tr>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      Chair
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      2
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      3
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      1
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      2
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      3
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      2
                    </td>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      0.94
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

  <div class="mt-10"></div>
  <h1 class="text-3xl font-bold mb-6 text-gray-800">VIKOR Calculation - Step by Step</h1>
  <div id="output" class="space-y-6"></div>

  <script>
    const weights = [0.2, 0.15, 0.2, 0.2, 0.15, 0.1];
    const isBenefit = [true, true, true, true, true, false];

    const alternatives = [
      { name: "Air Conditioner", values: [4, 4, 3, 4, 4, 3] },
      { name: "Projector", values: [3, 4, 2, 3, 3, 4] },
      { name: "Classroom Chair", values: [2, 5, 4, 4, 5, 5] },
      { name: "Whiteboard", values: [2, 4, 1, 2, 4, 4] },
      { name: "Computer (Lab)", values: [5, 5, 3, 5, 5, 2] },
      { name: "Wi-Fi", values: [3, 5, 2, 5, 5, 3] },
      { name: "Water Dispenser", values: [3, 4, 4, 4, 3, 3] },
      { name: "Printer", values: [2, 3, 1, 2, 2, 4] },
      { name: "CCTV", values: [4, 4, 5, 4, 4, 2] },
      { name: "Room Light", values: [3, 4, 2, 3, 4, 3] },
      { name: "Toilet", values: [4, 5, 5, 5, 5, 3] },
      { name: "Classroom Table", values: [2, 4, 1, 3, 4, 4] },
      { name: "Ceiling Fan", values: [2, 3, 1, 3, 3, 4] },
      { name: "Electrical Outlet", values: [3, 5, 4, 5, 5, 2] },
      { name: "Sink", values: [3, 4, 4, 4, 4, 3] }
    ];

    const output = document.getElementById("output");

    // Step 1: Calculate f+ (best) and f- (worst)
    const fPlus = [], fMinus = [];
    for (let i = 0; i < 6; i++) {
      const col = alternatives.map(a => a.values[i]);
      fPlus.push(isBenefit[i] ? Math.max(...col) : Math.min(...col));
      fMinus.push(isBenefit[i] ? Math.min(...col) : Math.max(...col));
    }

    // Step 1 table
    output.innerHTML += `
      <div>
        <h2 class="text-xl font-semibold mb-2">Step 1: Determine f⁺ and f⁻</h2>
        <div class="overflow-x-auto rounded-lg">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="text-center bg-gray-100 dark:bg-gray-700">
                  <tr>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Criterion</th>
                    ${weights.map((_, i) => `<th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">C${i + 1}</th>`).join('')}
                  </tr>
                </thead>
                <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                  <tr>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 font-semibold">f⁺ (Best)</td>
                    ${fPlus.map(v => `<td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${v}</td>`).join('')}
                  </tr>
                  <tr>
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 font-semibold">f⁻ (Worst)</td>
                    ${fMinus.map(v => `<td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${v}</td>`).join('')}
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    `;

    // Step 2: Normalize and weighted values
    const normalizedTable = [];
    const S = [], R = [];

    alternatives.forEach((alt, idx) => {
      let s = 0, r = -Infinity;
      const normRow = [];

      alt.values.forEach((val, i) => {
        const norm = (fPlus[i] - val) / (fPlus[i] - fMinus[i]);
        const weighted = weights[i] * norm;
        s += weighted;
        if (weighted > r) r = weighted;
        normRow.push(weighted.toFixed(4));
      });

      S.push({ name: alt.name, value: s });
      R.push({ name: alt.name, value: r });
      normalizedTable.push({ name: alt.name, values: normRow });
    });

    output.innerHTML += `
      <div>
        <h2 class="text-xl font-semibold mb-2">Step 2: Normalization and Weighted Values</h2>
        <div class="flex flex-col mt-6">
          <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
              <div class="overflow-hidden shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                  <thead class="text-center bg-gray-100 dark:bg-gray-700">
                    <tr>
                      <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
                      ${weights.map((_, i) => `
                        <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">C${i + 1}</th>
                      `).join('')}
                    </tr>
                  </thead>
                  <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    ${normalizedTable.map(row => `
                      <tr>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${row.name}</td>
                        ${row.values.map(v => `<td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${v}</td>`).join('')}
                      </tr>
                    `).join('')}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    // Step 3: Show S and R values
    output.innerHTML += `
      <div>
        <h2 class="text-xl font-semibold mb-2 mt-4">Step 3: Calculate S and R</h2>
        <div class="flex flex-col mt-6">
          <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
              <div class="overflow-hidden shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                  <thead class="text-center bg-gray-100 dark:bg-gray-700">
                    <tr>
                      <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Facility</th>
                      <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">S (Sum)</th>
                      <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">R (Max)</th>
                    </tr>
                  </thead>
                  <tbody class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    ${alternatives.map((alt, idx) => `
                      <tr>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${alt.name}</td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${S[idx].value.toFixed(4)}</td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${R[idx].value.toFixed(4)}</td>
                      </tr>
                    `).join('')}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    // Step 4: Calculate Q values
    const v = 0.5;
    const Smin = Math.min(...S.map(o => o.value));
    const Smax = Math.max(...S.map(o => o.value));
    const Rmin = Math.min(...R.map(o => o.value));
    const Rmax = Math.max(...R.map(o => o.value));

    const Q = alternatives.map((alt, idx) => {
      const q = v * ((S[idx].value - Smin) / (Smax - Smin)) +
                (1 - v) * ((R[idx].value - Rmin) / (Rmax - Rmin));
      return { name: alt.name, Q: q };
    });

    output.innerHTML += `
      <div>
        <h2 class="text-xl font-semibold mb-2 mt-4">Step 4: Calculate Q Values</h2>
        <div class="flex flex-col mt-6">
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
                    ${Q.map(q => `
                      <tr>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${q.name}</td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${q.Q.toFixed(4)}</td>
                      </tr>
                    `).join('')}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    // Step 5: Final ranking sorted by Q
    Q.sort((a, b) => a.Q - b.Q);

    output.innerHTML += `
      <div>
        <h2 class="text-xl font-semibold mb-2 mt-4">Step 5: Final VIKOR Ranking</h2>
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
                  ${Q.map((alt, i) => `
                    <tr>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${i + 1}</td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${alt.name}</td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${alt.Q.toFixed(4)}</td>
                    </tr>
                  `).join('')}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    `;
  </script>
</div>
@endsection
