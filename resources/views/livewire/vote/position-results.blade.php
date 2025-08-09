<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6" wire:poll.10s>
    <div class="mb-4">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold">{{ $position->name }} - Results</h2>
                @if($isElectionActive)
                    <div class="flex items-center gap-2 mt-2">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                        <span class="text-sm font-semibold text-red-600">LIVE RESULTS</span>
                        <span class="text-xs text-gray-500">(Auto-refreshing)</span>
                    </div>
                @else
                    <p class="text-sm text-gray-600 mt-1">Final Results</p>
                @endif
            </div>

            <div class="flex gap-2">
                <a href="{{ route('export.position.excel', $position) }}" class="bg-green-600 text-white px-3 py-1 text-sm rounded-md hover:bg-green-700 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Excel
                </a>
                <a href="{{ route('export.position.pdf', $position) }}" class="bg-red-600 text-white px-3 py-1 text-sm rounded-md hover:bg-red-700 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    PDF
                </a>
            </div>
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Candidate</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Yes Votes</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Votes</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($results as $row)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $row['candidate']->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $row['yes_votes'] }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $row['no_votes'] }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900"><strong>{{ $row['total_votes'] }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('results') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Back to All Results</a>
    </div>
</div>
