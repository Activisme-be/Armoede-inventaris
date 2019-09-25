<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Inventory
 */
class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', '2fa']);
    }

    /**
     * Method for displaying all the categories in the application.
     *
     * @todo Implement search
     *
     * @param  Category $categories The database model for the item categories.
     * @return Renderable
     */
    public function index(Category $categories): Renderable
    {
        return view('categories.index', ['categories' => $categories->withCount(['items'])->paginate()]);
    }

    /**
     * Method for creating a new category in the application.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('categories.create');
    }

    /**
     * Method for updating a category in the application.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not permitted for the operation.
     *
     * @param  CategoryFormRequest $request  The form request class that handles the validation logic
     * @param  Category            $category Entity from the authenticated user.
     * @return RedirectResponse
     */
    public function update(CategoryFormRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('edit', $category);

        DB::transaction(static function () use ($request, $category): void {
            $category->update($request->all());
            $request->user()->logActivity($category, 'Categorieen', "Heeft een categorie ({$category->name}) aangepast in de applicatie.");

            flash('De categorie is met succes aangepast in de applicatie.');
        });

        return redirect()->route('categories.index');
    }

    /**
     * Method for displaying the information from the item category
     *
     * @param  Category $category The resource entity from the given entity
     * @return Renderable
     */
    public function show(Category $category): Renderable
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Method for saving a new category in the application.
     *
     * @param  CategoryFormRequest  $request  THe request form class that handle the validation logic.
     * @param  Category             $category The database model class for the categories.
     * @return RedirectResponse
     */
    public function store(CategoryFormRequest $request, Category $category): RedirectResponse
    {
        DB::transaction(static function () use ($request, $category): void {
            $category = $category->create($request->all())->setCreator($request->user());
            $request->user()->logActivity($category, 'Categorieen', "Heeft de categorie ({$category->naam}) toegevoegd in de applicatie");

            flash('De categorie is met succes opgeslagen in de applicatie');
        });

        return redirect()->route('categories.index');
    }

    /**
     * Method for deleting a category in the application.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not Authorized
     *
     * @param  Request  $request  The resquest entity that holds all the request information.
     * @param  Category $category The resource entity from the given Category in the application.
     * @return RedirectResponse
     */
    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);

        if ($request->isMethod('GET')) {
            return view('categories.delete', compact('category'));
        }

        DB::transaction(function () use ($category): void {
            $category->delete();
            $this->getAuthenticatedUser()->logActivity($category, 'Categorieen', 'Heefteen categorie verwijderd in de applicatie.');

            flash("De categorie <strong>($category->naam)</strong> is verwijderd uit de applicatie");
        });

        return redirect()->route('categories.index');
    }
}
