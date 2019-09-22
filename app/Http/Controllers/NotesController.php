<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteFormRequest;
use App\Models\Note;
use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Implementing method for displaying the note in the application.
     *
     * @param  Note $note The database entity from the given note.
     * @return Renderable
     */
    public function show(Note $note): Renderable
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Method for displaying the edit view from a note.
     *
     * @todo Register route
     *
     * @param  Note $note The database entity from the given note.
     * @return Renderable
     */
    public function edit(Note $note): Renderable
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Method for updating a note from the person in the application.
     *
     * @param  NoteFormRequest $request The form request class that handles all the validation logic.
     * @param  Note            $note    The database entity from the given note.
     * @return RedirectResponse
     */
    public function update(NoteFormRequest $request, Note $note): RedirectResponse
    {
        DB::transaction(static function () use ($request, $note) {
            $note->update($request->all());
            $request->user()->logActivity($note, 'Notities', "Heeft een notitie van {$note->person->name} gewijzigd");

            flash('De notitie is gewijzigd met succes in de applicatie');
        });

        return redirect()->route('person.notes.overview', $note->person);
    }

    /**
     * Method for creating a new note for the person.
     *
     * @param  Person $person The resource entity from the given person.
     * @return Renderable
     */
    public function create(Person $person): Renderable
    {
        return view('notes.create', compact('person'));
    }

    /**
     * Method for deleting a note in the application.
     *
     *  @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not authorized.
     *
     * @param Request $request  Instance that holds all the request data
     * @param Note    $note     Database entity from the given note.
     * @return RedirectResponse
     */
    public function destroy(Request $request, Note $note): RedirectResponse
    {
        $this->authorize('delete', $note);

        DB::transaction(static function () use ($request, $note): void {
            $note->delete();
            $request->user()->logActivity($note, 'Notities', 'Heeft een notitie verwijderd in de applicatie.');

            flash('De notitie is verwijderd in de applicatie.');
        });

        return redirect()->route('person.notes.overview', $note->person);
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
        DB::transaction(static function () use ($request, $person): void {
            $note = Note::create($request->all())->setCreator($request->user())->setPerson($person);

            $request->user()->logActivity($note, 'Notities', 'Heeft een notitie toegevoegd voor ' . $person->name);
            flash('De notitie is opgeslagen in de applicatie.');
        });

        return redirect()->route('person.notes.overview', $person);
    }
}
