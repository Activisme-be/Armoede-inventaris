<a class="nav-link {{ active('home') }}" href="{{ route('home') }}">
    <i class="fe fe-home mr-1 fe-brand"></i> Dashboard
</a>

<a class="nav-link {{ active(['persons.*', 'person.*']) }}" href="{{ route('persons.overview') }}">
    <i class="fe fe-users mr-1 fe-brand"></i> Clients <small class="text-muted">({{ $person_count }})</small>
</a>

<a class="nav-link {{ active(['categories.*', 'category.*']) }}" href="{{ route('categories.index') }}">
    <i class="fe fe-tag mr-1 fe-brand"></i> Categorieen
</a>

<a class="nav-link {{ active('inventory.*') }}" href="{{ route('inventory.index') }}">
    <i class="fe fe-list mr-1 fe-brand"></i> Inventaris
</a>
