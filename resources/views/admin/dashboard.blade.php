@extends('layouts.admin')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-gray-50 dark:bg-gray-900">
<div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-4">
    <!-- Card 1 -->
    <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="flex items-center">
        <div class="p-3 rounded-lg bg-red-100 dark:bg-red-700 flex items-center justify-center me-3">
            <svg class="w-6 h-6 text-red-500 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
            <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
            <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
            </svg>
        </div>
        <div class="ml-2">
            <h5 class="mb-1 leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">{{ $pendingCount }}</h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Pending Report</p>
        </div>
        </div>
    </div>
    <!-- Card 2 -->
    <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="flex items-center">
        <div class="p-3 rounded-lg bg-yellow-100 dark:bg-yellow-700 flex items-center justify-center me-3">
            <svg class="w-6 h-6 text-yellow-500 dark:text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
            <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
            <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
            </svg>
        </div>
        <div class="ml-2">
            <h5 class="mb-1 leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">{{ $inqueueCount }}</h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">In Queue</p>
        </div>
        </div>
    </div>
    <!-- Card 3 -->
    <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="flex items-center">
        <div class="p-3 rounded-lg bg-green-100 dark:bg-green-700 flex items-center justify-center me-3">
            <svg class="w-6 h-6 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
            <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
            <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
            </svg>
        </div>
        <div class="ml-2">
            <h5 class="mb-1 leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">{{ $inProgressCount }}</h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">In Progress</p>
        </div>
        </div>
    </div>
    <!-- Card 4 -->
    <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="flex items-center">
        <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-700 flex items-center justify-center me-3">
            <svg class="w-6 h-6 text-blue-500 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
            <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
            <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
            </svg>
        </div>
        <div class="ml-2">
            <h5 class="mb-1 leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">{{ $doneCount }}</h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Repaired</p>
        </div>
        </div>
    </div>
</div>

<!-- Chart -->
<div class="flex flex-col lg:flex-row gap-4">
  <div class="mt-5 w-full lg:w-3/4 bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between mb-5">
      <div class="grid gap-4 grid-cols-2">
        <div>
          <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">Damage</h5>
          <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">{{ $total }}</p>
        </div>
        <div>
          <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">Repaired</h5>
          <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">{{ $doneCount }}</p>
        </div>
      </div>
    </div>
    <div id="line-chart"></div>
  </div>

  <script>
const options = {
  chart: { type: "line", fontFamily: "Inter, sans-serif", toolbar: { show: false } },
  stroke: { curve: 'smooth', width: 4 },
  grid: { strokeDashArray: 4 },
  tooltip: { enabled: true },
  dataLabels: { enabled: false },
  series: [
    { name: "Damage", data: @json($chartDamage), color: "#1A56DB" },
    { name: "Repaired", data: @json($chartRepaired), color: "#7E3AF2" }
  ],
  xaxis: {
    categories: @json($chartCategories),
    labels: {
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    }
  },
  yaxis: { show: false },
};

if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("line-chart"), options);
  chart.render();
}
</script>
  
  <!-- Rating -->
<div class="mt-5 w-full lg:w-1/4 bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
  <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Rating</h3>
  
  <!-- Donut Chart -->
  <div class="flex justify-center">
    <div id="rating-donut-chart" class="mb-2 min-h-[200px]"></div>
  </div>
  <p class="text-center text-md font-medium text-gray-500 dark:text-gray-400">4.80 / 5.00</p>
  <p class="text-center text-sm font-medium text-gray-500 dark:text-gray-400">from 25 user ratings</p>
  <div class="pl-10">
    <div class="flex items-center mt-6">
        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">5 star</a>
        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded-sm dark:bg-gray-700">
            <div class="h-5 bg-yellow-300 rounded-sm" style="width: 70%"></div>
        </div>
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">70%</span>
    </div>
    <div class="flex items-center mt-4">
        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">4 star</a>
        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded-sm dark:bg-gray-700">
            <div class="h-5 bg-yellow-300 rounded-sm" style="width: 17%"></div>
        </div>
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">17%</span>
    </div>
    <div class="flex items-center mt-4">
        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">3 star</a>
        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded-sm dark:bg-gray-700">
            <div class="h-5 bg-yellow-300 rounded-sm" style="width: 8%"></div>
        </div>
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8%</span>
    </div>
    <div class="flex items-center mt-4">
        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">2 star</a>
        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded-sm dark:bg-gray-700">
            <div class="h-5 bg-yellow-300 rounded-sm" style="width: 4%"></div>
        </div>
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">4%</span>
    </div>
    <div class="flex items-center mt-4">
        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">1 star</a>
        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded-sm dark:bg-gray-700">
            <div class="h-5 bg-yellow-300 rounded-sm" style="width: 1%"></div>
        </div>
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">1%</span>
    </div>
  </div>
</div>

<script>
// Rating Donut Chart - Showing only average rating (4.80 out of 5)
const ratingChartOptions = {
  series: [4.80, 0.20], // 4.80 out of 5 (remaining is 0.20)
  colors: ["#F59E0B", "#E5E7EB"], // Yellow for rating, gray for remaining
  chart: {
    height: 200,
    type: "donut",
    fontFamily: "Inter, sans-serif",
  },
  plotOptions: {
    pie: {
      donut: {
        size: '65%',
        labels: {
          show: true,
          total: {
            show: true,
            label: 'Avg Rating',
            formatter: function () {
              return '4.80';
            }
          }
        }
      }
    }
  },
  labels: ["Rating", ""], // Empty label for the remaining part
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false // Hide legend since we only show average
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      }
    }
  }]
};

if (document.getElementById("rating-donut-chart") && typeof ApexCharts !== 'undefined') {
  const ratingChart = new ApexCharts(document.getElementById("rating-donut-chart"), ratingChartOptions);
  ratingChart.render();
}
</script>
</div>

<!-- Table -->
<div class="mt-5 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
      <!-- Card header -->
      <div class="items-center justify-between lg:flex">
        <div class="mb-4 lg:mb-0">
          <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Report</h3>
          <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of latest report</span>
        </div>
      </div>

    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto rounded-lg">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-700">
                  <tr>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      No
                    </th><th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Reporter
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Facility Name
                    </th>
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Damage Level
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Location
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Role
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Status
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Date &amp; Time
                    </th>
                   
                  </tr>
                </thead>
                <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    @forelse ($reports as $report)
                     <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                        {{ $loop->iteration }}
                           </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                            {{ $report->user->username ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                            {{ $report->facility->facility_name ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                            {{ optional($c1_scales->firstWhere('scale_value', old('c1', $report->c1 ?? '')))->scale_description ?? 'N/A' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                            {{ $report->room->room_name ?? '-' }}, {{ $report->floor->floor_name ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                            {{ $report->user->role->name ?? '-' }}
                        </td>
                        <td class="p-4 whitespace-nowrap border-b dark:border-gray-700 border-gray-200">
                            <span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">{{ $report->status?? '-' }}</span>
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                            {{ \Carbon\Carbon::parse($report->damage_date)->format('M d, Y') }}
                        </td>
                       
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-4 text-sm text-center text-gray-500 dark:text-gray-400">No reports found.</td>
                    </tr>
                    @endforelse
                </tbody>                
              </table>
            </div>
          </div>
        </div>
    </div>

      <!-- Card Footer -->
      <div class="flex items-center justify-between pt-3 sm:pt-6">
          <a href="{{ url('admin/damagereport') }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
           Show All Report
            <svg class="w-4 h-4 ml-1 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          </a>
      </div>
    </div>
</div>
</div>
@endsection