<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\ItemFormRequest;
use App\Models\Category;
use App\Models\Items;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * MainController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', '2fa']);
    }
    /**
     * Method for listing the inventory of items.
     *
     * @param  Items $items The database model for all the items registered in the application.
     * @return Renderable
     */
    public function index(Items $items): Renderable
    {
        return view('inventory.overview', ['items' => $items->paginate()]);
    }

    /**
     * Method for creating a new item in the application.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('inventory.create', ['categories' => Category::pluck('naam', 'id')]);
    }

    /**
     * Method for storing a new item in the inventory.
     *
     * @param  ItemFormRequest $request     The request method that holds inormation an perfom the validation.
     * @param  Items           $item        Database model class for the inventory items
     * @return RedirectResponse
     */
    public function store(ItemFormRequest $request, Items $item): RedirectResponse
    {
        $request->merge(['product_code' => $item::generateProductCode(), 'category_id' => $request->categoriex]);

        DB::transaction(static function () use ($request, $item): void {
            $item = $item->create($request->except('categorie'))->setCreator($request->user());
            $request->user()->logActivity($item, 'Inventaris', "Heeft {$item->naam} als nieuw item toegevoegd in de applicatie");

            flash($item->naam . 'is met success toegevoegd als nieuw item in de inventaris.');
        });

        return redirect()->route('inventory.index');
    }

    /**
     * Method for updating an item in the inventory.
     *
     * @param ItemFormRequest $request The request class that handles the validation an contains request data.
     * @param Items $item The database entity from the given item.
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not permitted
     */
    public function update(ItemFormRequest $request, Items $item): RedirectResponse
    {
        $this->authorize('edit', $item);

        DB::transaction(static function () use ($request, $item): void {
            $request->merge(['category_id' => $request->categorie]);
            $item->update($request->except('categorie'));

            flash("Het item is met success in de aaplicatie gewijzigd.");
        });

        return redirect()->route('inventory.item', $item);
    }

    /**
     * Method for displaying the information from the item.
     *
     * @param  Items $item The resource entity from the given item.
     * @return Renderable
     */
    public function show(Items $item): Renderable
    {
        $categories = Category::all();
        return view('inventory.show', compact('item', 'categories'));
    }
}
