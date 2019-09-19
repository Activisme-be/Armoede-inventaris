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

    /**
     * Method for displaying the information about the given person.
     *
     * @param  Person $person The database entity from the given person.
     * @return Renderable
     */
    public function show(Person $person): Renderable
    {
        return view('persons.show', compact('person'));
    }

    /**
     * Method for updating the person information in the application;
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not authorized
     *
     * @param  PersonFormRequest $request
     * @param  Person            $person
     * @return RedirectResponse
     */
    public function update(PersonFormRequest $request, Person $person): RedirectResponse
    {
        $this->authorize('update', $person);

        DB::transaction(static function () use ($request, $person): void {
            $person->update($request->all());
            $request->user()->logActivity($person, 'Personen', "Heeft de gegegevens van {$person->name} aangepast in de applicatie");

            flash("De gegevens van {$person->name} zijn aangepast in de applicatie");
        });

        return redirect()->route('persons.show', $person); // The update is successfully so redirect the user back to the previous page.
    }

    /**
     * Method for deleting a person in the application.
     *
     * @param  Request $request The request instance that holds all the request information.
     * @param  Person  $person  The database entity from the given person in the application.
     * @return Renderable\RedirectResponse
     */
    public function destroy(Request $request, Person $person)
    {
        if ($request->isMethod('GET')) {
            return view('persons.delete', compact('person'));
        }

        // Method is a DELETE request so move on with the delete logic.
        DB::transaction(static function () use ($request, $person): void {
            $person->delete();
            $request->user()->logActivity($person, 'Personen', 'Heeft een hulpbehoevend persoon verwijderd in de applicatie.');

            flash($person->name . ' is verwijderd als hulpbehoevende persoon uit de applicatie.');
        });

        return redirect()->route('persons.overview');
    }
}
