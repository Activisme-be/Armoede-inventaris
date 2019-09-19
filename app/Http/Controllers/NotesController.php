<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteFormRequest;
use App\Models\Note;
use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class NotesController
 *
 * Controller for handling internal notes about a person. Notes can contain data that can go
 * about resource deliveries, Statusses or other types of data that are related to the person.
 *
 * @package App\Http\Controllers
 */
class NotesController extends Controller
{
    /**
     * NotesController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', '2fa']);
    }

    /**
     * Method for displaying all the notes from the given user.
     *
     * @param  Person $person The entity from the given user.
     * @return Renderable
     */
    public function index(Person $person): Renderable
    {
        $notes = $person->notes()->paginate();
        return view('notes.overview', compact('person', 'notes'));
    }

    /**
     * Method for creating a new note for the person.
     *
     * @param  Person $person The resource entity from the given person.
     * @return Renderable
     */
    public function create(Person $person): Renderable
    {
        $statuses = [0 => 'Persoonlijke notitie', 1 => 'Publieke notitite'];
        return view('notes.create', ['statuses' => $statuses, 'person' => $person]);
    }

    /**
     * Method for storing an new note for the given person in the application.
     *
     * @param  NoteFormRequest  $request The form request class that handles the form validation.
     * @param  Person           $person  Database entity from the given person in the application.
     * @return RedirectResponse
     */
    public function store(NoteFormRequest $request, Person $person): RedirectResponse
    {
        // TODO
        dd($request->all(), $person);
    }
}
