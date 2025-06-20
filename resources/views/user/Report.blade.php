

@extends('layouts.user')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Report</h1>
            </div>
            <div class="sm:flex mt-8">
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <a href="/user/create-report" 
                        class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm sm:w-auto font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Create report
                    </a>
                </div>
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
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Name
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Facility
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Location
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                      Damage Level
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
                <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    @forelse ($reports as $report)
                    
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 ">
                        {{ $loop->iteration }}
                           </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->user->username ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->facility->facility_name ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->room->room_name ?? '-' }}, {{ $report->floor->floor_name ?? '-' }}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ optional($c1_scales->firstWhere('scale_value', old('c1', $report->c1 ?? '')))->scale_description ?? 'N/A' }}
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">{{$report->status}}</span>
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
                          @if(!in_array($report->status, ['in progres', 'done', 'In_Queue']))
    <button type="button" data-modal-target="delete-report-modal-{{$report->damage_report_id}}" data-modal-toggle="delete-report-modal-{{$report->damage_report_id}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-800">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                Delete
                            </button>
@endif
                           @if(strtolower($report->status) === 'done' && is_null($report->rating))
                            <button 
                                type="button"
                                data-modal-target="feedback-report-modal"
                                data-modal-toggle="feedback-report-modal"
                                data-report-id="{{ $report->damage_report_id }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                Feedback
                            </button>
                            @endif


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

    
<!-- Detail Report Modal -->
    @forelse ($reports as $report)
    <div id="detail-report-modal-{{ $report->damage_report_id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        {{-- @dd($report->damage_report_id); --}}
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
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Report ID</label>
                        <input type="text" readonly value="{{  $report->damage_report_id ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reporter</label>
                        <input type="text" readonly value="{{  $report->user->username ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" readonly value="{{  $report->user->role->name ?? '-' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                        <input type="text" readonly value="{{ \Carbon\Carbon::parse($report->damage_date)->format('M d, Y') }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                <!-- Completion Report -->
                                    <div class="mt-6">
                                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Completion Report</h2>

                                        @if ($report->completion_photo || $report->completion_description)
                                            <div class="grid grid-cols-1 gap-6">
                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Completion
                                                        Photo</label>
                                                    <img src="{{ asset($report->image_technician) }}" alt="Completion Photo"
                                                        class="rounded-lg w-full max-h-64 object-contain border border-gray-300 dark:border-gray-600">
                                                </div>

                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                    <textarea readonly rows="4"
                                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly resize-none">{{ $report->completion_description }}</textarea>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-500 dark:text-gray-400">No completion report available.</p>
                                        @endif
                                    </div>
                                

                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="detail-report-modal-{{ $report->damage_report_id }}" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Return</button>
                </div>
            </form>
        </div>
    </div>
    @empty
    <p></p>
    @endforelse

    <script>
        if (document.getElementById("selection-table") && typeof simpleDatatables.DataTable !== 'undefined') {

            let multiSelect = true;
            let rowNavigation = false;
            let table = null;

            const resetTable = function() {
                if (table) {
                    table.destroy();
                }

                const options = {
                    rowRender: (row, tr, _index) => {
                        if (!tr.attributes) {
                            tr.attributes = {};
                        }
                        if (!tr.attributes.class) {
                            tr.attributes.class = "";
                        }
                        if (row.selected) {
                            tr.attributes.class += " selected";
                        } else {
                            tr.attributes.class = tr.attributes.class.replace(" selected", "");
                        }
                        return tr;
                    }
                };
                if (rowNavigation) {
                    options.rowNavigation = true;
                    options.tabIndex = 1;
                }

                table = new simpleDatatables.DataTable("#selection-table", options);

                // Mark all rows as unselected
                table.data.data.forEach(data => {
                    data.selected = false;
                });

                table.on("datatable.selectrow", (rowIndex, event) => {
                    event.preventDefault();
                    const row = table.data.data[rowIndex];
                    if (row.selected) {
                        row.selected = false;
                    } else {
                        if (!multiSelect) {
                            table.data.data.forEach(data => {
                                data.selected = false;
                            });
                        }
                        row.selected = true;
                    }
                    table.update();
                });
            };

            // Row navigation makes no sense on mobile, so we deactivate it and hide the checkbox.
            const isMobile = window.matchMedia("(any-pointer:coarse)").matches;
            if (isMobile) {
                rowNavigation = false;
            }

            resetTable();
        }
    </script>

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

    <!-- Feedback Modal -->
<!-- Feedback Modal -->
<div id="feedback-report-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <form action="{{ route('user.feedback.submit') }}" method="POST" class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-6">
            @csrf
            
            <input type="hidden" name="report_id" id="feedback-report-id" value="">
            <input type="hidden" name="rating" id="rating-value" value="0">

            <!-- Header -->
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Feedback</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="feedback-report-modal">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Rating Stars -->
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Rating</label>
                <div class="flex space-x-1 text-yellow-400">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" class="star focus:outline-none" data-star="{{ $i }}">
                            <svg class="w-6 h-6 fill-gray-300 hover:fill-yellow-400 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.951h4.15c.969 0 1.371 1.24.588 1.81l-3.36 2.444 1.286 3.95c.3.922-.755 1.688-1.54 1.118L10 13.011l-3.36 2.444c-.784.57-1.838-.196-1.539-1.118l1.285-3.95-3.36-2.444c-.783-.57-.38-1.81.588-1.81h4.15L9.05 2.927z"/>
                            </svg>
                        </button>
                    @endfor
                </div>
            </div>

            

            <!-- Submit Button -->
            <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                Submit Feedback
            </button>
        </form>
    </div>
</div>

       
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const stars = document.querySelectorAll(".star");
                const ratingInput = document.getElementById("rating-value");

                stars.forEach((star, index) => {
                    star.addEventListener("click", function () {
                        const rating = this.getAttribute("data-star");
                        ratingInput.value = rating;

                        // Reset semua warna bintang ke abu-abu
                        stars.forEach(s => {
                            s.querySelector("svg").classList.remove("fill-yellow-400");
                            s.querySelector("svg").classList.add("fill-gray-300");
                        });

                        // Warnai semua bintang dari 1 sampai yang diklik
                        for (let i = 0; i < rating; i++) {
                            stars[i].querySelector("svg").classList.remove("fill-gray-300");
                            stars[i].querySelector("svg").classList.add("fill-yellow-400");
                        }
                    });
                });
            });
</script>




    <script>
    document.querySelectorAll('#feedback-report-modal .star').forEach((btn, index, stars) => {
        btn.addEventListener('click', () => {
        const rating = index + 1;
        document.getElementById('rating-value').value = rating;

        stars.forEach((star, i) => {
            const svg = star.querySelector('svg');
            if (i < rating) {
            svg.classList.remove('fill-gray-300');
            svg.classList.add('fill-yellow-400');
            } else {
            svg.classList.add('fill-gray-300');
            svg.classList.remove('fill-yellow-400');
            }
        });
        });
    });
    </script>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const feedbackButtons = document.querySelectorAll('[data-modal-target="feedback-report-modal"]');
        const reportIdInput = document.getElementById('feedback-report-id');

        feedbackButtons.forEach(button => {
            button.addEventListener('click', () => {
                const reportId = button.getAttribute('data-report-id');
                if (reportIdInput) {
                    reportIdInput.value = reportId;
                }
            });
        });
    });
</script>

@endsection