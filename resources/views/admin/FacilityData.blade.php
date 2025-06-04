@extends('layouts.admin')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="w-full mb-1">

        {{-- Action Buttons --}}
        <div class="sm:flex">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Facility Data</h1>
            </div>
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <button type="button" data-modal-target="add-facility-modal" data-modal-toggle="add-facility-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Add facility
                </button>
            </div>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <table id="selection-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">ID</th>
                                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Facility Name</th>
                                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Jumlah</th>
                                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Floor</th>
                                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Room</th>
                                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            @forelse ($facilities as $facility)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $facility->facility_id }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $facility->facility_name }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $facility->jumlah }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $facility->floor->floor_name ?? '-' }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $facility->room->room_name ?? '-' }}</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        {{-- Tombol Edit --}}
                                        <button type="button"
                                            class="edit-facility-btn inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            data-modal-target="edit-facility-modal"
                                            data-modal-toggle="edit-facility-modal"
                                            data-id="{{ $facility->facility_id }}"
                                            data-name="{{ $facility->facility_name }}"
                                            data-jumlah="{{ $facility->jumlah }}"
                                            data-floor="{{ $facility->floor_id }}"
                                            data-room="{{ $facility->room_id }}">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                            </svg>
                                          Edit
                                        </button>
                                        <form action="{{ route('facilitydata.destroy', $facility->facility_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-gray-500 dark:text-gray-400">Tidak ada fasilitas yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add Facility (Dummy Static for Now) --}}
    <div id="add-facility-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
          <form action="{{ route('facilitydata.store') }}" method="POST" class="bg-white rounded-lg shadow dark:bg-gray-700">
            @csrf
            <!-- Modal Header -->
            <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add New Facility</h3>
              <button type="button" data-modal-hide="add-facility-modal" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6m-6-6l6-6m-6 6L1 13"/></svg>
              </button>
            </div>
      
            <!-- Modal Body -->
            <div class="p-6 space-y-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="facility-name" class="block text-sm font-medium text-gray-900 dark:text-white">Facility Name</label>
                  <input type="text" id="facility-name" name="facility_name" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white" placeholder="e.g. Projector">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="jumlah" class="block text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                  <input type="number" id="jumlah" name="jumlah" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white" placeholder="e.g. 2">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="floor" class="block text-sm font-medium text-gray-900 dark:text-white">Floor</label>
                  <select id="floor" name="floor_id" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    <option selected>Pilih Lantai</option>
                    @foreach($floors as $floor)
                      <option value="{{ $floor->floor_id }}">{{ $floor->floor_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="room" class="block text-sm font-medium text-gray-900 dark:text-white">Room</label>
                  <select id="room" name="room_id" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    <option selected>Pilih Ruangan</option>
                    @foreach($rooms as $room)
                      <option value="{{ $room->room_id }}">{{ $room->room_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
      
            <!-- Modal Footer -->
            <div class="flex items-center p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700">Add Facility</button>
            </div>
          </form>
        </div>
      </div>

    {{-- Modal Edit Facility --}}
    <div id="edit-facility-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
          <form id="edit-facility-form" action="/admin/facilitydata/${facilityId}" method="POST" class="bg-white rounded-lg shadow dark:bg-gray-700">
            @csrf
            @method('PUT')
            <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Facility</h3>
              <button type="button" data-modal-hide="edit-facility-modal" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6m-6-6l6-6m-6 6L1 13"/></svg>
              </button>
            </div>
            <div class="p-6 space-y-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-900 dark:text-white">Facility Name</label>
                  <input type="text" id="edit-facility-name" name="facility_name" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                  <input type="number" id="edit-jumlah" name="jumlah" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-900 dark:text-white">Floor</label>
                  <select id="edit-floor" name="floor_id" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                    @foreach($floors as $floor)
                      <option value="{{ $floor->floor_id }}">{{ $floor->floor_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-900 dark:text-white">Room</label>
                  <select id="edit-room" name="room_id" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                    @foreach($rooms as $room)
                      <option value="{{ $room->room_id }}">{{ $room->room_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="justify-end flex items-center p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-600">
              <button type="submit" class="text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-5 py-2.5">Save</button>
            </div>
          </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-facility-btn');
            const editForm = document.getElementById('edit-facility-form');
            const inputName = document.getElementById('edit-facility-name');
            const inputJumlah = document.getElementById('edit-jumlah');
            const selectFloor = document.getElementById('edit-floor');
            const selectRoom = document.getElementById('edit-room');
        
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const facilityId = this.getAttribute('data-id');
                    const facilityName = this.getAttribute('data-name');
                    const jumlah = this.getAttribute('data-jumlah');
                    const floorId = this.getAttribute('data-floor');
                    const roomId = this.getAttribute('data-room');
        
                    // Set nilai ke form input
                    inputName.value = facilityName;
                    inputJumlah.value = jumlah;
                    selectFloor.value = floorId;
                    selectRoom.value = roomId;
        
                    // Set action form untuk update, sesuaikan route dan parameter
                    editForm.action = /admin/facilitydata/${facilityId};
                    
                    // Tampilkan modal (jika pakai Tailwind/Flowbite/Alpine, trigger toggle modal)
                    const modal = document.getElementById('edit-facility-modal');
                    modal.classList.remove('hidden');
                });
            });
        
            // Optional: tombol close modal bisa sembunyikan modal kembali
            document.querySelectorAll('[data-modal-hide="edit-facility-modal"]').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('edit-facility-modal').classList.add('hidden');
                });
            });
        });
    </script>
</div>      

@endsection