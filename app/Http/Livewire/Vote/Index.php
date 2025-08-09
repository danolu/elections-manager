<?php

namespace App\Http\Livewire\Vote;

use App\Models\Position;
use App\Services\ElectionService;
use Livewire\Component;

class Index extends Component
{
    protected ElectionService $electionService;

    public function __construct()
    {
        $this->electionService = app(ElectionService::class);
    }

    public function render()
    {
        $positions = $this->electionService->getAllPositions();
        $user = auth()->user();

        // Filter positions user can vote for
        $eligiblePositions = $positions->filter(function ($position) use ($user) {
            return $position->canUserVote($user);
        });

        // Calculate voting progress
        $totalPositions = $eligiblePositions->count();
        $votedPositions = $eligiblePositions->filter(function ($position) use ($user) {
            return $this->electionService->hasUserVoted($user, $position);
        })->count();

        $progress = $totalPositions > 0 ? round(($votedPositions / $totalPositions) * 100) : 0;

        return view('livewire.vote.index', [
            'positions' => $eligiblePositions,
            'totalPositions' => $totalPositions,
            'votedPositions' => $votedPositions,
            'progress' => $progress,
        ]);
    }
}
