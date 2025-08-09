<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Election Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #1a1a1a;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .position-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .position-title {
            background-color: #f3f4f6;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            border-left: 4px solid #3b82f6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #e5e7eb;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #9ca3af;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:hover {
            background-color: #f9fafb;
        }
        .winner {
            background-color: #d1fae5;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Election Results</h1>
        <p>Generated on {{ $exportDate->format('F j, Y g:i A') }}</p>
    </div>

    @foreach($results as $positionData)
        <div class="position-section">
            <div class="position-title">{{ $positionData['position']->name }}</div>
            
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Candidate</th>
                        <th>Yes Votes</th>
                        <th>No Votes</th>
                        <th>Total Votes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($positionData['results'] as $index => $result)
                        <tr class="{{ $index === 0 ? 'winner' : '' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $result['candidate']->name }}</td>
                            <td>{{ $result['yes_votes'] }}</td>
                            <td>{{ $result['no_votes'] }}</td>
                            <td>{{ $result['total_votes'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="footer">
        <p>This is an official election results document.</p>
        <p>Confidential - For authorized personnel only</p>
    </div>
</body>
</html>

