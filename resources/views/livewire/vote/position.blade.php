<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $position->name }}</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if(!$showConfirmation)
        {{-- Voting Form --}}
        <form wire:submit.prevent="showConfirmation">
        @if($position->isSingle())
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Select one candidate</label>
                <div class="space-y-2">
                    @foreach($candidates as $candidate)
                        <label class="flex items-center">
                            <input type="radio" name="{{ \Illuminate\Support\Str::slug($position->name, '-') }}" value="{{ $candidate->id }}" wire:model="selectedCandidates.single" class="mr-2">
                            <span>{{ $candidate->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

        @elseif($position->isMultiple())
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Select up to {{ $position->max_vote }} candidates</label>
                <div class="space-y-2">
                    @foreach($candidates as $candidate)
                        <label class="flex items-center">
                            <input type="checkbox" value="{{ $candidate->id }}" wire:model="selectedCandidates.multiple" class="mr-2">
                            <span>{{ $candidate->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

        @elseif($position->isYesNo())
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-4">Vote Yes/No for each candidate</label>
                @foreach($candidates as $candidate)
                    <div class="mb-4 p-4 border border-gray-200 rounded">
                        <label class="block text-sm font-medium mb-2">{{ $candidate->name }}</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="vote_{{ $candidate->id }}" value="yes" wire:model="selectedCandidates.yesno.{{ $candidate->id }}" class="mr-2">
                                <span>Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="vote_{{ $candidate->id }}" value="no" wire:model="selectedCandidates.yesno.{{ $candidate->id }}" class="mr-2">
                                <span>No</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

            <div class="flex items-center gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Continue</button>
                <a href="/vote" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Cancel</a>
            </div>
        </form>

    @else
        {{-- Confirmation Step --}}
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Confirm Your Vote</h3>
                    <p class="mt-2 text-sm text-yellow-700">Please review your selection before submitting. Once submitted, your vote cannot be changed.</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Your Selection:</h3>

            @if($position->isSingle())
                @php
                    $selectedCandidate = $candidates->firstWhere('id', $selectedCandidates['single'] ?? null);
                @endphp
                @if($selectedCandidate)
                    <div class="bg-blue-50 border border-blue-200 rounded p-4">
                        <p class="text-gray-700"><strong>Candidate:</strong> {{ $selectedCandidate->name }}</p>
                    </div>
                @endif

            @elseif($position->isMultiple())
                @php
                    $selectedIds = $selectedCandidates['multiple'] ?? [];
                    $selectedCandidatesList = $candidates->whereIn('id', $selectedIds);
                @endphp
                @if($selectedCandidatesList->count() > 0)
                    <div class="bg-blue-50 border border-blue-200 rounded p-4">
                        <p class="text-gray-700 mb-2"><strong>Selected Candidates:</strong></p>
                        <ul class="list-disc list-inside">
                            @foreach($selectedCandidatesList as $candidate)
                                <li>{{ $candidate->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            @elseif($position->isYesNo())
                <div class="bg-blue-50 border border-blue-200 rounded p-4">
                    <p class="text-gray-700 mb-2"><strong>Your Votes:</strong></p>
                    <ul class="space-y-1">
                        @foreach($candidates as $candidate)
                            @php
                                $vote = $selectedCandidates['yesno'][$candidate->id] ?? null;
                            @endphp
                            @if($vote)
                                <li>
                                    <span class="font-medium">{{ $candidate->name }}:</span>
                                    <span class="px-2 py-1 rounded text-sm {{ $vote === 'yes' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($vote) }}
                                    </span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-2">
            <button wire:click="confirmAndSubmit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-semibold">
                Confirm & Submit Vote
            </button>
            <button wire:click="goBack" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                Go Back
            </button>
        </div>
    @endif
</div>
