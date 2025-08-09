<?php

namespace App\Http\Controllers;

use App\Exports\ResultsExport;
use App\Models\Position;
use App\Models\Vote;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ResultsExportController extends Controller
{
    /**
     * Export all results to Excel
     */
    public function exportExcel()
    {
        return Excel::download(new ResultsExport(), 'election-results-' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Export specific position results to Excel
     */
    public function exportPositionExcel(Position $position)
    {
        return Excel::download(
            new ResultsExport($position),
            'results-' . \Str::slug($position->name) . '-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Export all results to PDF
     */
    public function exportPdf()
    {
        $positions = Position::with(['candidates'])->get();
        $results = [];

        foreach ($positions as $position) {
            $positionResults = [];

            foreach ($position->candidates as $candidate) {
                $yesVotes = Vote::where('position_id', $position->id)
                    ->where('candidate_id', $candidate->id)
                    ->where('vote', 'yes')
                    ->count();

                $noVotes = Vote::where('position_id', $position->id)
                    ->where('candidate_id', $candidate->id)
                    ->where('vote', 'no')
                    ->count();

                $positionResults[] = [
                    'candidate' => $candidate,
                    'yes_votes' => $yesVotes,
                    'no_votes' => $noVotes,
                    'total_votes' => $yesVotes + $noVotes,
                ];
            }

            // Sort by yes votes descending
            usort($positionResults, function ($a, $b) {
                return $b['yes_votes'] <=> $a['yes_votes'];
            });

            $results[] = [
                'position' => $position,
                'results' => $positionResults,
            ];
        }

        $pdf = Pdf::loadView('exports.results-pdf', [
            'results' => $results,
            'exportDate' => now(),
        ]);

        return $pdf->download('election-results-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export specific position results to PDF
     */
    public function exportPositionPdf(Position $position)
    {
        $results = [];

        foreach ($position->candidates as $candidate) {
            $yesVotes = Vote::where('position_id', $position->id)
                ->where('candidate_id', $candidate->id)
                ->where('vote', 'yes')
                ->count();

            $noVotes = Vote::where('position_id', $position->id)
                ->where('candidate_id', $candidate->id)
                ->where('vote', 'no')
                ->count();

            $results[] = [
                'candidate' => $candidate,
                'yes_votes' => $yesVotes,
                'no_votes' => $noVotes,
                'total_votes' => $yesVotes + $noVotes,
            ];
        }

        // Sort by yes votes descending
        usort($results, function ($a, $b) {
            return $b['yes_votes'] <=> $a['yes_votes'];
        });

        $pdf = Pdf::loadView('exports.position-results-pdf', [
            'position' => $position,
            'results' => $results,
            'exportDate' => now(),
        ]);

        return $pdf->download('results-' . \Str::slug($position->name) . '-' . now()->format('Y-m-d') . '.pdf');
    }
}

