<?php

namespace App\Policies;

use App\Models\Position;
use App\Models\User;
use App\Models\Vote;

class VotePolicy
{
    /**
     * Determine if the user can view any votes (results).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can view the vote.
     */
    public function view(User $user, Vote $vote): bool
    {
        // Users can only view their own votes, admins can view all
        return $user->id === $vote->user_id || $user->isAdmin();
    }

    /**
     * Determine if the user can cast a vote for a position.
     */
    public function cast(User $user, Position $position): bool
    {
        // Check if user is eligible for this position's category
        return $position->canUserVote($user);
    }

    /**
     * Determine if the user can delete votes.
     */
    public function delete(User $user, Vote $vote): bool
    {
        // Only admins can delete votes
        return $user->isAdmin();
    }
}

