<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonFormRequest;
use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('persons.overview', ['persons' => $persons->withCount(['supportRequests'])->paginate()]);
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

    /**
     * Method for storing a new person in the application.
     *
     * @param  PersonFormRequest    $request    The form request class that handles all the validation logic.
     * @param  Person               $person     The database model for the persons in the application.
     * @return RedirectResponse
     */
    public function store(PersonFormRequest $request, Person $person): RedirectResponse
    {
        DB::transaction(static function () use ($request, $person) {
            $person->create($request->all());
            $request->user()->logActivity($person, 'Personen', 'Heeft een hulpbehoevend persoon toegevoegd in de applicatie');

            flash('De persoon is aan gemaakt in de applicatie.');
        });

        return redirect()->route('persons.overview');
    }
}
