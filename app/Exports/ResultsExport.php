<?php

namespace App\Exports;

use App\Models\Position;
use App\Models\Vote;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ResultsExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $position;

    public function __construct($position = null)
    {
        $this->position = $position;
    }

    /**
     * Get the data to export
     */
    public function collection()
    {
        if ($this->position) {
            // Export results for a specific position
            return $this->position->candidates()
                ->withCount([
                    'votes as yes_votes' => function ($query) {
                        $query->where('vote', 'yes');
                    },
                    'votes as no_votes' => function ($query) {
                        $query->where('vote', 'no');
                    },
                    'votes as total_votes'
                ])
                ->get();
        }

        // Export all results
        $positions = Position::with('candidates')->get();
        $results = collect();

        foreach ($positions as $position) {
            foreach ($position->candidates as $candidate) {
                $yesVotes = Vote::where('position_id', $position->id)
                    ->where('candidate_id', $candidate->id)
                    ->where('vote', 'yes')
                    ->count();

                $noVotes = Vote::where('position_id', $position->id)
                    ->where('candidate_id', $candidate->id)
                    ->where('vote', 'no')
                    ->count();

                $results->push((object)[
                    'position' => $position->name,
                    'candidate' => $candidate->name,
                    'yes_votes' => $yesVotes,
                    'no_votes' => $noVotes,
                    'total_votes' => $yesVotes + $noVotes,
                ]);
            }
        }

        return $results;
    }

    /**
     * Map the data for each row
     */
    public function map($row): array
    {
        if ($this->position) {
            return [
                $row->name,
                $row->yes_votes ?? 0,
                $row->no_votes ?? 0,
                $row->total_votes ?? 0,
            ];
        }

        return [
            $row->position,
            $row->candidate,
            $row->yes_votes,
            $row->no_votes,
            $row->total_votes,
        ];
    }

    /**
     * Define the headings
     */
    public function headings(): array
    {
        if ($this->position) {
            return [
                'Candidate',
                'Yes Votes',
                'No Votes',
                'Total Votes',
            ];
        }

        return [
            'Position',
            'Candidate',
            'Yes Votes',
            'No Votes',
            'Total Votes',
        ];
    }

    /**
     * Set the sheet title
     */
    public function title(): string
    {
        return $this->position ? $this->position->name : 'All Results';
    }
}

