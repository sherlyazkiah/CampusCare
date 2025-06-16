@extends('layouts.admin')

@section('main')
    <div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
        <div class="w-full mb-1 sm:flex">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Technician Progress</h1>
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
                                        No
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        ID Report
                                    </th>
                                    <th
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Technician
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
                                </tr>
                            </thead>
                            <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                @foreach ($reports as $report)
                                
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 ">
                        {{ $loop->iteration }}
                           </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->damage_report_id }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->technician->username ?? '-' }}
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
                                            <span
                                                class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">{{ $report->status ?? '-' }}
                                                
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $report->created_at->format('M d, Y') }}
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
@endsection