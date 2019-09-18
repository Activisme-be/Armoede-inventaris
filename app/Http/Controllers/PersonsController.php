<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class PersonsController
 *
 * @package App\Http\Controllers
 */
class PersonsController extends Controller
{
    /**
     * PersonsController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', '2fa']);
    }

    /**
     * Method for listing all the persons in the application.
     *
     * @param  Person $persons The database model class for the persons in the application.
     * @return Renderable
     */
    public function index(Person $persons): Renderable
    {
        return view('persons.overview', ['persons' => $persons->paginate()]);
    }

    /**
     * Method for displaying the create view for a new person.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('persons.create');
    }
}
