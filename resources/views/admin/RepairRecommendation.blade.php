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
                      Vikor Score
                    </th>
                    <th class="p-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                      Priority
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
                      0.65
                    </td>
                    <td class="p-4 whitespace-nowrap">
                      <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-red-100 dark:border-red-400 dark:bg-gray-700 dark:text-red-400">High</span>
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
                      0.82
                    </td>
                    <td class="p-4 whitespace-nowrap">
                      <span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">Medium</span>
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
                      0.94
                    </td>
                    <td class="p-4 whitespace-nowrap">
                      <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">Low</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
