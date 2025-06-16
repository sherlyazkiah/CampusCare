<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repair Completion Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #000;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td {
            vertical-align: top;
            padding: 6px 8px;
        }
        .label {
            width: 180px;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 13px;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }
        .quote {
            font-style: italic;
            margin-top: 5px;
            color: #444;
        }
        .photo {
            max-width: 100%;
            max-height: 250px;
            margin-top: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <h1>Repair Completion Report</h1>

    <table>
        <tr>
            <td class="label">Reporter Name:</td>
            <td>{{ $report->user->username }}</td>
        </tr>
        <tr>
            <td class="label">Role:</td>
            <td>{{ $report->user->role->name }}</td>
        </tr>
        <tr>
            <td class="label">Damage Report Date:</td>
            <td>{{ $report->created_at->format('F d, Y') }}</td>
        </tr>
        <tr>
            <td class="label">Facility Name:</td>
            <td>{{ $report->facility->facility_name }}</td>
        </tr>
        <tr>
            <td class="label">Damage Location:</td>
            <td>
                {{ $report->room->room_name }}, {{ $report->floor->floor_name }}
            </td>
        </tr>
    </table>

    <div class="section-title">Photo Before Repair</div>
    @if ($report->image_path && file_exists(public_path($report->image_path)))
        
        <img src="file://{{ public_path($report->image_path) }}" class="photo" alt="Before Repair">


    @else
        <p>No photo available.</p>
    @endif

    <div class="section-title">Photo After Repair</div>
    @if ($report->image_technician && file_exists(public_path($report->image_technician)))
        <img src="file://{{ public_path($report->image_technician) }}" class="photo" alt="After Repair">
    @else
        <p>No photo available.</p>
    @endif

    <div class="section-title">User's Damage Description</div>
    <p class="quote">"{{ $report->description ?? 'No description provided.' }}"</p>

    <div class="section-title">Technician's Repair Description</div>
    <p class="quote">"{{ $report->completion_description ?? 'No technician description available.' }}"</p>

    <div class="section-title">User Feedback</div>
    @if ($report->rating || $report->comment)
        <table>
            <tr>
                <td class="label">Rating:</td>
                <td>{{ $report->rating ?? '-' }} / 5</td>
            </tr>
        </table>
    @else
        <p>No feedback provided.</p>
    @endif

</body>
</html>