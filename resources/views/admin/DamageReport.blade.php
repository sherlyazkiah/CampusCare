@extends('layouts.admin')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Damage Report</h1>
            </div>
    </div>
    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto rounded-lg">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow sm:rounded-lg">
              <table id="selection-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
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
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Action
                    </th>
                  </tr>
                </thead>
                <div class="mb-4 flex justify-end">
    <form method="GET" action="{{ route('damage-reports.index') }}" class="flex items-center space-x-2 mb-4">
    <label for="status" class="text-sm font-medium text-gray-700">Filter Status:</label>
    
    <select name="status" id="status" class="px-3 py-2 text-sm border rounded text-gray-700">
        <option value="">-- All Status --</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="In_Queue" {{ request('status') == 'In_Queue' ? 'selected' : '' }}>In Queue</option>
    </select>

    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
        Filter
    </button>
    
</form>
</div>

                
                <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    
                    @forelse ($reports as $report)

                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                           {{ ($reports->currentPage() - 1) * $reports->perPage() + $loop->iteration }}
                                        </td>
                    <!--<tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->damage_report_id }}
                        </td>-->
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->user->username ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->facility->facility_name ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ optional($c1_scales->firstWhere('scale_value', old('c1', $report->c1 ?? '')))->scale_description ?? 'N/A' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->room->room_name ?? '-' }}, {{ $report->floor->floor_name ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->user->role->name ?? '-' }}
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">{{ $report->status?? '-' }}</span>
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($report->damage_date)->format('M d, Y') }}
                        </td>
                        <td class="p-4 space-x-2 whitespace-nowrap">
                            <button type="button" data-modal-target="detail-report-modal-{{ $report->damage_report_id }}" data-modal-show="detail-report-modal-{{ $report->damage_report_id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-green-600 hover:bg-green-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>Detail
                            </button>
                            <button type="button" data-modal-target="delete-report-modal-{{$report->damage_report_id}}" data-modal-toggle="delete-report-modal-{{$report->damage_report_id}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-800">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-4 text-sm text-center text-gray-500 dark:text-gray-400">No reports found.</td>
                    </tr>
                    @endforelse
                </tbody>    
                      
        </table>
                    <div class="mt-4">
    {{ $reports->withQueryString()->links('vendor.pagination.tailwind') }}
</div>      
          
            </div>
          </div>
        </div>
    </div>

   

    <!-- Detail Report modal -->
    @forelse ($reports as $report)
    <div id="detail-report-modal-{{ $report->damage_report_id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Report Detail
                    </h3>
                   <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-report-modal-{{ $report->damage_report_id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reporter</label>
                        <input type="text" readonly value="{{  $report->user->username ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" readonly value="{{  $report->user->role->name ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Identity</label>
                        <input type="text" readonly value="{{ $report->user->biodata->identity ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">class</label>
                        <input type="text" readonly value="{{ $report->user->biodata->class->class_name ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facility Name</label>
                        <input type="text" readonly value="{{  $report->facility->facility_name ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                        <input type="text" readonly value="{{ $report->room->room_name ?? 'N/A' }}, {{ $report->floor->floor_name ?? '' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date & Time</label>
                        <input type="text" readonly value="{{ $report->created_at->format('M d, Y H:i') }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Damage Level</label>
                        <input type="text" readonly value="{{ optional($c1_scales->firstWhere('scale_value', old('c1', $report->c1 ?? '')))->scale_description ?? 'N/A' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea readonly rows="4" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $report->description }}</textarea>
                    </div>
                    <div class="col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                        <img src="{{ asset($report->image_path) }}" alt="Reported Facility" class="rounded-lg w-full max-h-64 object-contain border border-gray-300 dark:border-gray-600">
                    </div>
                </div>
            </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                    data-modal-hide="detail-report-modal-{{ $report->damage_report_id }}"
                    data-modal-target="criteria-modal-{{ $report->damage_report_id }}"
                    data-modal-show="criteria-modal-{{ $report->damage_report_id }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Process</button>
                    <button data-modal-hide="detail-report-modal-{{ $report->damage_report_id }}" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Return</button>
                </div>
            </form>
        </div>
    </div>
    @empty
   
    @endforelse

    <!-- Criteria Modal -->
    @forelse ($reports as $report)
    <div id="criteria-modal-{{ $report->damage_report_id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <form 
            action="{{ route('damage-report.storeAndCalculateVikor', $report->damage_report_id) }}" 
            method="POST" 
            class="relative bg-white rounded-lg shadow dark:bg-gray-700"
        >
            @csrf
            @method('PATCH')
            <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Define Damage Criteria
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="criteria-modal-{{ $report->damage_report_id }}">
                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                        <img src="{{ asset($report->image_path) }}" alt="Reported Facility" class="rounded-lg w-full max-h-64 object-contain border border-gray-300 dark:border-gray-600">
                    </div>
                    <div class="col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea readonly rows="4" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $report->description }}.</textarea>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                <!-- 1. Damage Severity -->
                <div>
                    <label for="c1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        C1 - Damage Severity
                    </label>

                    @php
                        $selectedScale = $c1_scales->firstWhere('scale_value', old('c1', $report->c1 ?? ''));
                        $displayValue = $selectedScale 
                            ? $selectedScale->scale_value . ' - ' . $selectedScale->scale_description 
                            : 'N/A';
                    @endphp

                    <input type="text"
                        id="c1"
                        class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        value="{{ $displayValue }}"
                        readonly>

                    <!-- Hidden input to submit actual value -->
                    <input type="hidden" name="c1" value="{{ old('c1', $report->c1 ?? '') }}">
                </div>

                <!-- 2. Usage Importance -->
                <div>
                    <label for="c2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        C2 - Usage Importance
                    </label>
                    <select id="c2" name="c2" class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                         @foreach($c2_scales as $scale)
                        <option value="{{ $scale->scale_value }}">{{ $scale->scale_value }} - {{ $scale->scale_description }}</option>
                    @endforeach
                    </select>
                </div>

                <!-- 3. Safety Concern -->
                <div>
                    <label for="c3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        C3 - Safety Concern
                    </label>
                    <select id="c3" name="c3" class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach($c3_scales as $scale)
                        <option value="{{ $scale->scale_value }}">{{ $scale->scale_value }} - {{ $scale->scale_description }}</option>
                    @endforeach
                    </select>
                </div>

                <!-- 4. Repair Urgency -->
                <div>
                    <label for="c4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        C4 - Repair Urgency
                    </label>
                    <select id="c4" name="c4" class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                       @foreach($c4_scales as $scale)
                        <option value="{{ $scale->scale_value }}">{{ $scale->scale_value }} - {{ $scale->scale_description }}</option>
                    @endforeach
                    </select>
                </div>

                <!-- 5. Impact on Many People -->
                <div>
                    <label for="c5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        C5 - Impact on Many People
                    </label>
                    <select id="c5" name="c5" class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach($c5_scales as $scale)
                        <option value="{{ $scale->scale_value }}">{{ $scale->scale_value }} - {{ $scale->scale_description }}</option>
                    @endforeach
                    </select>
                </div>

                <!-- 6. Time to Repair -->
                <div>
                    <label for="c6" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        C6 - Time to Repair
                    </label>
                    <select id="c6" name="c6" class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                         @foreach($c6_scales as $scale)
                        <option value="{{ $scale->scale_value }}">{{ $scale->scale_value }} - {{ $scale->scale_description }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            </div>

            <div class="flex justify-end p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </div>
            </form>
        </div>
    </div>
    @empty

    @endforelse

    <!-- Delete Report Modal -->
    @foreach($reports as $report)
    <div id="delete-report-modal-{{$report->damage_report_id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full h-full max-w-md px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-end p-2">
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-modal-hide="delete-report-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 pt-0 text-center">
                    <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Are you sure you want to delete this report?</h3>
                    <form id="delete-form-{{ $report->damage_report_id }}" method="POST" action="{{ route('reports.destroy', $report->damage_report_id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                            Yes, I'm sure
                        </button>
                    </form>

                    <a href="#" 
                    class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" 
                    data-modal-hide="delete-report-modal-{{ $report->damage_report_id }}"

                    No, cancel
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
 @endforeach
@endsection
