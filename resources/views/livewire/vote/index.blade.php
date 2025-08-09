<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Voting</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    {{-- Voting Progress Indicator --}}
    @if($totalPositions > 0)
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold text-gray-700">Your Voting Progress</h2>
                <span class="text-sm font-medium text-gray-600">{{ $votedPositions }} of {{ $totalPositions }} positions</span>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                <div class="bg-blue-600 h-4 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
            </div>

            <p class="text-sm text-gray-600">
                @if($progress === 100)
                    <span class="text-green-600 font-semibold">✓ You've completed all your votes!</span>
                @elseif($progress > 0)
                    <span class="text-blue-600">Keep going! {{ $totalPositions - $votedPositions }} position(s) remaining.</span>
                @else
                    <span class="text-gray-600">Start voting to track your progress.</span>
                @endif
            </p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($positions as $position)
            @php
                $hasVoted = app(\App\Services\ElectionService::class)->hasUserVoted(auth()->user(), $position);
            @endphp
            <div class="bg-white rounded-lg shadow p-6 {{ $hasVoted ? 'border-l-4 border-green-500' : '' }}">
                <div class="flex justify-between items-start mb-2">
                    <h2 class="text-lg font-semibold">{{ $position->name }}</h2>
                    @if($hasVoted)
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">✓ Voted</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">Pending</span>
                    @endif
                </div>
                <p class="text-sm text-gray-600 mb-2">Type: <strong>{{ $position->type }}</strong></p>
                <p class="text-sm text-gray-600 mb-4">Candidates: <strong>{{ $position->candidates->count() }}</strong></p>

                @if($hasVoted)
                    <span class="text-sm text-green-600 font-medium">You have already voted for this position</span>
                @else
                    <a href="/vote/{{ \Illuminate\Support\Str::slug($position->name, '-') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Vote Now</a>
                @endif
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">No positions available for voting.</p>
            </div>
        @endforelse
    </div>
</div>
