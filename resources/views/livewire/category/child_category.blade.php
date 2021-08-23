<li class="text-sm">{{ $child_category->title }}</li>

<ol class="pl-6 ml-auto list-disc list-inside bodyig">
    @foreach ($child_category->child as $childCategory)
        @include('livewire.category.child_category', ['child_category' => $childCategory])
    @endforeach
</ol>
