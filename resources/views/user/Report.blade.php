

@extends('layouts.user')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Report</h1>
            </div>
            <div class="sm:flex mt-8">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <form class="lg:pr-3" action="#" method="GET">
                    <label for="reports-search" class="sr-only">Search</label>
                    <div class="relative mt-1 lg:w-64 xl:w-96">
                        <input type="text" name="email" id="reports-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for reports">
                    </div>
                    </form>
                </div>
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
                      ID
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
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->damage_report_id }}
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
                            {{ $report->damage_level }}
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">{{$report->status}}</span>
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $report->created_at->format('M d, Y') }}
                        </td>
                        <td class="p-4 space-x-2 whitespace-nowrap">
                            <button 
                            type="button"
                             onclick="openModal('detailModal{{ $report->damage_report_id }}')"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-green-600 hover:bg-green-800"
                            data-report="{{ htmlspecialchars(json_encode($report), ENT_QUOTES, 'UTF-8') }}"
                        >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>Detail
                            </button>
                            <button type="button" data-modal-target="delete-report-modal" data-modal-toggle="delete-report-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-800">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                Delete
                            </button>
                            <button type="button" data-modal-target="feedback-report-modal" data-modal-toggle="feedback-report-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/></svg>
                                Feedback
                            </button>
                        </td>
                    </tr>
<!-- Detail Report Modal -->
<div id="detailModal{{ $report->damage_report_id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 relative dark:bg-gray-800">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Report Detail</h2>
            <button onclick="closeModal('detailModal{{ $report->damage_report_id }}')" class="text-gray-500 hover:text-gray-700 dark:text-gray-300">
                ✕
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reporter</label>
                <input type="text" readonly value="{{ $report->user->username ?? '-' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 text-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input type="text" readonly value="{{ $report->reporter->title ?? 'N/A' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 text-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facility Name</label>
                <input type="text" readonly value="{{ $report->facility->facility_name ?? 'N/A' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                <input type="text" readonly value="{{ $report->room->room_name ?? 'N/A' }}, {{ $report->floor->floor_name ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date & Time</label>
                <input type="text" readonly value="{{ $report->created_at->format('M d, Y H:i') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Damage Level</label>
                <input type="text" readonly value="{{ $report->c1 }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea readonly rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $report->description }}</textarea>
        </div>

        @if($report->image_path)
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo</label>
            <img src="{{ asset('storage/' . $report->image_path) }}" alt="Reported Facility" class="mt-2 rounded border max-h-64 object-contain shadow" />
        </div>
        @endif

        <div class="text-right">
            <button onclick="closeModal('detailModal{{ $report->damage_report_id }}')" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Return
            </button>
            
        </div>
    </div>
</div>


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

        function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    </script>

    

    <!-- Delete Report Modal -->
    <div id="delete-report-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                    <a href="#" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                        Yes, I'm sure
                    </a>
                    <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" data-modal-hide="delete-report-modal">
                        No, cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection