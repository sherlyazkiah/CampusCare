@extends('layouts.admin')

@section('main')
<div class="container" style="padding: 20px;">
    <h2 style="text-align: center; margin-bottom: 20px;">Facilities List</h2>

    <div style="overflow-x:auto;">
        <table style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background-color: #f4f4f4;">
                    <th style="border: 1px solid #333; padding: 8px 12px;">ID</th>
                    <th style="border: 1px solid #333; padding: 8px 12px;">Facility Name</th>
                    <th style="border: 1px solid #333; padding: 8px 12px;">Description</th>
                    <th style="border: 1px solid #333; padding: 8px 12px;">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facilities as $facility)
                    <tr>
                        <td style="border: 1px solid #333; padding: 8px 12px;">{{ $facility->id }}</td>
                        <td style="border: 1px solid #333; padding: 8px 12px;">{{ $facility->facility_name }}</td>
                        <td style="border: 1px solid #333; padding: 8px 12px;">{{ $facility->facility_description }}</td>
                        <td style="border: 1px solid #333; padding: 8px 12px;">{{ $facility->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
