<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Items;
use Illuminate\Contracts\Support\Renderable;

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
}
