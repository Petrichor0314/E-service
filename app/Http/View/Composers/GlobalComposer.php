<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\FiliereModel;
use App\Models\DepartementModel;

class GlobalComposer
{
    protected function isSectorCoordinator($userId)
    {
        return FiliereModel::where('coord', $userId)->exists();
    }

    protected function isDepartementHead($userId)
    {
        return DepartementModel::where('head', $userId)->exists();
    }

    public function compose(View $view)
    {
        $user = Auth::user();
        $view->with('is_sector_coordinator', $this->isSectorCoordinator($user->id))
             ->with('is_departement_head', $this->isDepartementHead($user->id));
    }
}
