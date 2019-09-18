<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', '2fa']);
    }

    public function index(Person $persons): Renderable
    {
        return view('persons.overview', ['persons' => $persons->paginate()]);
    }
}
