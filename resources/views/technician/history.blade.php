@extends('layouts.technician')

@section('main')
    <div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
        <div class="w-full mb-1 sm:flex">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">History</h1>
            </div>
        </div>
        <div class="flex flex-col mt-6">
            <div class="overflow-x-auto rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow sm:rounded-lg">
                        <table id="selection-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        ID
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Reporter
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Facility Name
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Location
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Status
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Date &amp; Time
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                @foreach ($reports as $report)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->damage_report_id }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->user->username ?? '-' }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->facility->facility_name ?? '-' }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->floor->floor_name ?? '' }}, {{ $report->room->room_name ?? '' }}
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            {{ $report->status }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="p-4 space-x-2 whitespace-nowrap">
                                            <button type="button" data-modal-target="detail-report-modal-{{ $report->damage_report_id }}"
                                                data-modal-show="detail-report-modal-{{ $report->damage_report_id }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-green-600 hover:bg-green-800">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>Detail
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
        <script>
            if (document.getElementById("selection-table") && typeof simpleDatatables.DataTable !== 'undefined') {

                let multiSelect = true;
                let rowNavigation = false;
                let table = null;

                const resetTable = function () {
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

        <!-- Detail Report modal -->
        @foreach ($reports as $report)

            <!-- Modal Detail Laporan -->
            <div id="detail-report-modal-{{ $report->damage_report_id }}" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <form class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal Header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-200 dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Task Detail
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="detail-report-modal-{{ $report->damage_report_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reporter</label>
                                    <input type="text" value="{{ $report->user->username }}" readonly class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input type="text" value="{{ $report->role->name }}" readonly class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facility
                                        Name</label>
                                    <input type="text" value="{{ $report->facility->facility_name }}" readonly
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                    <input type="text" value="{{ $report->room->room_name }} - {{ $report->floor->floor_name }}"
                                        readonly class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date & Time</label>
                                    <input type="text" value="{{ $report->created_at->format('Y-m-d H:i') }}" readonly
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Damage Level</label>
                                    <input type="text" value="{{ $report->damage_level }}" readonly class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea readonly rows="4"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly resize-none">{{ $report->description }}</textarea>
                                </div>

                                <div class="col-span-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reported
                                        Photo</label>
                                    <img src="{{ asset('storage/' . $report->photo) }}" alt="Reported Facility"
                                        class="rounded-lg w-full max-h-64 object-contain border border-gray-300 dark:border-gray-600">
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
                                            <img src="{{ asset('storage/' . $report->completion_photo) }}" alt="Completion Photo"
                                                class="rounded-lg w-full max-h-64 object-contain border border-gray-300 dark:border-gray-600">
                                        </div>

                                        <div>
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                            <textarea readonly rows="4"
                                                class="input-readonly resize-none">{{ $report->completion_description }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No completion report available.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="detail-report-modal-{{ $report->damage_report_id }}" type="button"
                                class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection