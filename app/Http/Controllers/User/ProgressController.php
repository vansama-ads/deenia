<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserQuizProgress;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Display the user's quiz progress.
     */
    public function myProgress()
    {
        $userId = Auth::id();
        
        $progresses = UserQuizProgress::where('user_id', $userId)
            ->with(['quiz'])
            ->orderBy('completed_at', 'desc')
            ->paginate(10);

        return view('user.my-progress', [
            'progresses' => $progresses,
        ]);
    }
}
