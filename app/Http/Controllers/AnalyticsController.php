<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Total counts
        $totalVoters = User::where('is_admin', false)->count();
        $totalPositions = Position::count();
        $totalCandidates = Candidate::count();
        $totalVotesCast = Vote::count();

        // Voter participation
        $votersWhoVoted = Vote::distinct('user_id')->count('user_id');
        $turnoutPercentage = $totalVoters > 0 ? round(($votersWhoVoted / $totalVoters) * 100, 2) : 0;

        // Votes by position
        $votesByPosition = Position::withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->get()
            ->map(function ($position) {
                return [
                    'name' => $position->name,
                    'votes_count' => $position->votes_count,
                    'type' => $position->type,
                ];
            });

        // Participation by category
        $participationByCategory = DB::table('users')
            ->leftJoin('votes', 'users.id', '=', 'votes.user_id')
            ->where('users.is_admin', false)
            ->select('users.category', DB::raw('COUNT(DISTINCT users.id) as total_users'), DB::raw('COUNT(DISTINCT CASE WHEN votes.id IS NOT NULL THEN users.id END) as voted_users'))
            ->groupBy('users.category')
            ->get()
            ->map(function ($item) {
                $percentage = $item->total_users > 0 ? round(($item->voted_users / $item->total_users) * 100, 2) : 0;
                return [
                    'category' => $item->category ?? 'No Category',
                    'total_users' => $item->total_users,
                    'voted_users' => $item->voted_users,
                    'percentage' => $percentage,
                ];
            });

        // Recent voting activity (last 10 votes)
        $recentVotes = Vote::with(['user', 'position', 'candidate'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($vote) {
                return [
                    'user_name' => $vote->user->name ?? 'Unknown',
                    'position_name' => $vote->position->name ?? 'Unknown',
                    'candidate_name' => $vote->candidate->name ?? 'Unknown',
                    'vote_type' => $vote->vote,
                    'created_at' => $vote->created_at->diffForHumans(),
                ];
            });

        // Voting timeline (votes per hour for last 24 hours)
        $votingTimeline = Vote::where('created_at', '>=', now()->subHours(24))
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->map(function ($item) {
                return [
                    'hour' => $item->hour,
                    'count' => $item->count,
                ];
            });

        // Top positions by participation
        $topPositions = Position::withCount('votes')
            ->having('votes_count', '>', 0)
            ->orderBy('votes_count', 'desc')
            ->limit(5)
            ->get();

        // Check if election is active
        $settings = Setting::first();
        $isElectionActive = $settings ? $settings->is_election_time : false;

        return view('analytics.index', compact(
            'totalVoters',
            'totalPositions',
            'totalCandidates',
            'totalVotesCast',
            'votersWhoVoted',
            'turnoutPercentage',
            'votesByPosition',
            'participationByCategory',
            'recentVotes',
            'votingTimeline',
            'topPositions',
            'isElectionActive'
        ));
    }
}
