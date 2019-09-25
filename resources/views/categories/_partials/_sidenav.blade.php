<div class="list-group list-group-transparent">
    <a href="{{ route('category.show', $category) }}" class="list-group-item list-group-item-action {{ active('category.show') }}">
        <i class="fe fe-brand fe-info mr-2"></i> Algemene informatie
    </a>

    <a href="" class="list-group-item-action list-group-item">
        <i class="fe fe-brand fe-list mr-2"></i> Gecategoriseerde items
    </a>

    <a href="{{ route('categories.destroy', $category) }}" class="list-group-item list-group-item-action {{ active('categories.destroy') }}">
        <i class="fe fe-brand fe-trash-2 mr-2"></i> Verwijder categorie
    </a>
</div>
