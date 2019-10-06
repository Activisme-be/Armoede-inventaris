<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Items;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class QuantityController
 *
 * @package App\Http\Controllers\Inventory
 */
class QuantityController extends Controller
{
    /**
     * QuantityController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,webmaster', '2fa', 'forbid-banned-user']);
    }

    /**
     * Method for adding or updating the amount off items in the application.
     *
     * @param  Items $item The resource entity from the given item.
     * @return Renderable
     */
    public function create(Items $item): Renderable
    {
        return view('items.check-in', compact('item'));
    }

    /**
     * Method for updating the quantity of items in the application.
     *
     * @todo Register and embed route.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {

    }
}
