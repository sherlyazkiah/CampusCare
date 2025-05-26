@extends('layouts.technician')

@section('main')
<div class="max-w-7xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-blue-800 mb-8">Technician Dashboard</h1>

    <!-- 1. Laporan Masuk -->
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-indigo-700 mb-4">Laporan Masuk dari Sarana Prasarana</h2>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Fasilitas</th>
                        <th class="px-4 py-2 text-left">Lokasi</th>
                        <th class="px-4 py-2 text-left">Deskripsi</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Contoh Data Dummy -->
                    <tr>
                        <td class="px-4 py-2">001</td>
                        <td class="px-4 py-2">AC Ruang Kelas</td>
                        <td class="px-4 py-2">Gedung B - Lantai 2</td>
                        <td class="px-4 py-2">AC tidak menyala</td>
                        <td class="px-4 py-2">
                            <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Tandai Diproses</button>
                        </td>
                    </tr>
                    <!-- Tambahkan data lainnya sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. Update Status -->
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-indigo-700 mb-4">Update Status Perbaikan</h2>
        <div class="bg-white p-6 rounded-lg shadow">
            <form>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">ID Laporan</label>
                    <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Contoh: 001">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Status</label>
                    <select class="w-full border border-gray-300 rounded px-3 py-2">
                        <option>Sedang Diproses</option>
                        <option>Selesai</option>
                    </select>
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Update Status
                </button>
            </form>
        </div>
    </div>

    <!-- 3. Riwayat Laporan -->
    <div>
        <h2 class="text-xl font-semibold text-indigo-700 mb-4">Riwayat Perbaikan</h2>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Fasilitas</th>
                        <th class="px-4 py-2 text-left">Lokasi</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2">001</td>
                        <td class="px-4 py-2">AC Ruang Kelas</td>
                        <td class="px-4 py-2">Gedung B</td>
                        <td class="px-4 py-2">2024-05-26</td>
                        <td class="px-4 py-2 text-green-600 font-semibold">Selesai</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">002</td>
                        <td class="px-4 py-2">Lampu Koridor</td>
                        <td class="px-4 py-2">Gedung A</td>
                        <td class="px-4 py-2">2024-05-25</td>
                        <td class="px-4 py-2 text-yellow-600 font-semibold">Sedang Diproses</td>
                    </tr>
                    <!-- Tambahkan data lainnya -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection