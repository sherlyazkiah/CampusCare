<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Repair Recommendation Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        h2,
        h3 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Repair Recommendation Report (VIKOR Method)</h2>

    <h3>Damage Report Data Matrix</h3>
    <table>
        <thead>
            <tr>
                <th>Facility</th>
                @foreach ($criteriaLabels as $key => $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->facility->facility_name }}</td>
                    @foreach ($criteriaLabels as $key => $label)
                        <td>{{ $report->$key }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Step 1: F+ and F-</h3>
    <table>
        <thead>
            <tr>
                <th>Criteria</th>
                @foreach ($criteriaLabels as $key => $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>F+</strong></td>
                @foreach ($criteriaLabels as $key => $label)
                    <td>{{ $fPlus[$key] }}</td>
                @endforeach
            </tr>
            <tr>
                <td><strong>F-</strong></td>
                @foreach ($criteriaLabels as $key => $label)
                    <td>{{ $fMinus[$key] }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <h3>Step 2: Normalized & Weighted Values</h3>
    <table>
        <thead>
            <tr>
                <th>Facility</th>
                @foreach ($criteriaLabels as $key => $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($normalized as $i => $row)
                <tr>
                    <td>{{ $reports[$i]->facility->facility_name }}</td>
                    @foreach ($criteriaLabels as $key => $label)
                        <td>{{ number_format($row[$key], 4) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Step 3: S and R Calculation</h3>
    <table>
        <thead>
            <tr>
                <th>Facility</th>
                <th>S</th>
                <th>R</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $i => $res)
                <tr>
                    <td>{{ $reports[$i]->facility->facility_name }}</td>
                    <td>{{ number_format($res['S'], 4) }}</td>
                    <td>{{ number_format($res['R'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Step 4: Q Calculation</h3>
    <table>
        <thead>
            <tr>
                <th>Facility</th>
                <th>Q</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $i => $res)
                <tr>
                    <td>{{ $reports[$i]->facility->facility_name }}</td>
                    <td>{{ number_format($res['Q'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Step 5: Final Ranking</h3>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Facility</th>
                <th>Q</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rankedResults as $rank => $res)
                <tr>
                    <td>{{ $rank + 1 }}</td>
                    <td>{{ $res['nama'] }}</td>
                    <td>{{ number_format($res['Q'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>