<?php

namespace App\Composers;

use App\Models\Person;
use Illuminate\View\View;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class AppNavComposer
 *
 * @package App\Composers
 */
class AppNavComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view The view builder instance.
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('person_count', Person::count());
    }
}
