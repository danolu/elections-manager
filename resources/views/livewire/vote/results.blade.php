<div class="max-w-7xl mx-auto" wire:poll.10s>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Election Results</h1>
            @if($isElectionActive)
                <div class="flex items-center gap-2 mt-2">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    <span class="text-sm font-semibold text-red-600">LIVE RESULTS - Election in Progress</span>
                    <span class="text-xs text-gray-500">(Auto-refreshing every 10s)</span>
                </div>
            @else
                <p class="text-sm text-gray-600 mt-1">Final Results - Election Ended</p>
            @endif
        </div>

        @if(count($results) > 0)
            <div class="flex gap-2">
                <a href="{{ route('export.results.excel') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Excel
                </a>
                <a href="{{ route('export.results.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Export PDF
                </a>
            </div>
        @endif
    </div>

    @if(count($results) === 0)
        <div class="text-center py-8">
            <p class="text-gray-500">No results available yet.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($results as $result)
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">{{ $result['position']->name }}</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Candidate</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Votes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($result['results'] as $row)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $row['candidate']->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><strong>{{ $row['votes'] }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Back to Dashboard</a>
    </div>
</div>
