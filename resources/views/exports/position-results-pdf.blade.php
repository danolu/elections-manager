<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $position->name }} - Results</title>
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
        .header h2 {
            margin: 10px 0 0 0;
            font-size: 18px;
            color: #3b82f6;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #e5e7eb;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #9ca3af;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:hover {
            background-color: #f9fafb;
        }
        .winner {
            background-color: #d1fae5;
            font-weight: bold;
        }
        .summary {
            margin-top: 30px;
            padding: 15px;
            background-color: #f3f4f6;
            border-left: 4px solid #3b82f6;
        }
        .summary h3 {
            margin-top: 0;
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
        <h2>{{ $position->name }}</h2>
        <p>Generated on {{ $exportDate->format('F j, Y g:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Candidate</th>
                <th>Yes Votes</th>
                <th>No Votes</th>
                <th>Total Votes</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalVotes = collect($results)->sum('total_votes');
            @endphp
            @foreach($results as $index => $result)
                <tr class="{{ $index === 0 ? 'winner' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result['candidate']->name }}</td>
                    <td>{{ $result['yes_votes'] }}</td>
                    <td>{{ $result['no_votes'] }}</td>
                    <td>{{ $result['total_votes'] }}</td>
                    <td>{{ $totalVotes > 0 ? number_format(($result['yes_votes'] / $totalVotes) * 100, 2) : 0 }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3>Summary</h3>
        <p><strong>Total Votes Cast:</strong> {{ $totalVotes }}</p>
        <p><strong>Number of Candidates:</strong> {{ count($results) }}</p>
        @if(count($results) > 0)
            <p><strong>Winner:</strong> {{ $results[0]['candidate']->name }} with {{ $results[0]['yes_votes'] }} yes votes</p>
        @endif
    </div>

    <div class="footer">
        <p>This is an official election results document.</p>
        <p>Confidential - For authorized personnel only</p>
    </div>
</body>
</html>

