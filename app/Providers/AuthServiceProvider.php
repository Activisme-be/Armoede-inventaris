<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Note;
use App\Models\Person;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\NotePolicy;
use App\Policies\PersonPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class     => UserPolicy::class,
        Note::class     => NotePolicy::class,
        Person::class   => PersonPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
