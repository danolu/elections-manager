<?php

namespace App\Policies;

use App\Models\Candidate;
use App\Models\User;

class CandidatePolicy
{
    /**
     * Determine if the user can view any candidates.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can view the candidate.
     */
    public function view(User $user, Candidate $candidate): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can create candidates.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can update the candidate.
     */
    public function update(User $user, Candidate $candidate): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can delete the candidate.
     */
    public function delete(User $user, Candidate $candidate): bool
    {
        return $user->isAdmin();
    }
}

