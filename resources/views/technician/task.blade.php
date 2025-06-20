@extends('layouts.technician')

@section('main')
    <div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
        <div class="w-full mb-1 sm:flex">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Task</h1>
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
                                        NO
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
                                        <td
                                                class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 border-b dark:border-gray-700 border-gray-200">
                                                {{ $loop->iteration }}
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
                                            @php
                                                $status = $report->status ?? '-';
                                            @endphp

                                            @if ($status === 'pending')
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-md border border-yellow-200 dark:bg-gray-700 dark:border-yellow-300 dark:text-yellow-300">
                                                    Pending
                                                </span>
                                            @elseif ($status === 'In Progress')
                                                <span
                                                    class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-md border border-purple-200 dark:bg-gray-700 dark:border-blue-300 dark:text-blue-300">
                                                    In Progress
                                                </span>
                                            @elseif ($status === 'Done')
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-md border border-yellow-200 dark:bg-gray-700 dark:border-green-300 dark:text-green-300">
                                                    Done
                                                </span>
                                            @else
                                                <span
                                                    class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-md border border-gray-200 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-300">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($report->damage_date)->format('M d, Y') }}
                                        </td>
                                        <td class="p-4 space-x-2 whitespace-nowrap">
                                            <button type="button"
                                                data-modal-target="detail-report-modal-{{ $report->damage_report_id }}"
                                                data-modal-show="detail-report-modal-{{ $report->damage_report_id }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-green-600 hover:bg-green-800">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>Detail
                                            </button>

                                            <button type="button" onclick="openUploadModal({{ $report->damage_report_id }})"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-700">
                                                Completed
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

        <!-- Upload Completion Modal -->
        <div id="uploadModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->

                <form id="uploadForm" method="POST" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    @csrf
                    @method('POST') 
                    <input type="hidden" name="task_id" id="modal_task_id" />
                    <!-- Modal header -->
                    <div
                        class="flex items-start justify-between p-4 border-b rounded-t border-gray-200 dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Upload Completion Report
                        </h3>
                        <button type="button" onclick="closeUploadModal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Completion
                                Photo</label>
                            <input type="file" name="image_technician" required
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea name="completion_description" rows="4" placeholder="Optional description..."
                                class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Submit
                        </button>
                        <button type="button" onclick="closeUploadModal()"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            async function markInProgressAndUpload(reportId) {
                try {
                    const response = await fetch(`/technician/task`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    });

                    const data = await response.json();

                    if (!response.ok) throw new Error(data.message || 'Failed to mark as in progress');

                    openUploadModal(reportId);
                } catch (error) {
                    console.error('Error:', error);
                    alert(error.message || 'Failed to process request');
                }
            }

            function openUploadModal(reportId) {
                    const form = document.getElementById('uploadForm');
                    form.action = `/technician/task/${reportId}/complete`;
                    document.getElementById('modal_task_id').value = reportId;
                    document.getElementById('uploadModal').classList.remove('hidden');
                }

            function closeUploadModal() {
                document.getElementById('uploadModal').classList.add('hidden');
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
                        <div
                            class="flex items-start justify-between p-4 border-b rounded-t border-gray-200 dark:border-gray-600">
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
                                    <input type="text" value="{{ $report->user->username }}" readonly
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input type="text" value="{{ $report->role->name }}" readonly
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
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
                                        readonly
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date &
                                        Time</label>
                                    <input type="text" value="{{ $report->created_at->format('Y-m-d H:i') }}" readonly
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly">
                                </div>

                                <!-- 1. Damage Severity -->
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="c1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Damage Level
                                    </label>

                                    @php
    $selectedScale = $c1_scales->firstWhere('scale_value', old('c1', $report->c1 ?? ''));
    $displayValue = $selectedScale
        ? $selectedScale->scale_value . ' - ' . $selectedScale->scale_description
        : 'N/A';
                                    @endphp

                                    <input type="text" id="c1"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly"
                                        value="{{ $displayValue }}" readonly>

                                    <!-- Hidden input to submit actual value -->
                                    <input type="hidden" name="c1" value="{{ old('c1', $report->c1 ?? '') }}">
                                </div>

                                <div class="col-span-6">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea readonly rows="4"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly resize-none">{{ $report->description }}</textarea>
                                </div>

                                @if($report->image_path)
                                    <div class="col-span-6">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo</label>
                                        <img src="{{ asset($report->image_path) }}" alt="Reported Facility" class="rounded-lg w-full max-h-64 object-contain border border-gray-300 dark:border-gray-600">
                                    </div>
                                @endif
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
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                            <textarea readonly rows="4"
                                                class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-readonly resize-none">{{ $report->completion_description }}</textarea>
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
@endsection