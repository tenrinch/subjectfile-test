<ol class="w-full ml-auto list-decimal list-inside bodyig">
    @foreach ($categories as $category)
        <li class="text-lg">{{ $category->title }}</li>
        <ol class="pl-6 ml-auto list-disc list-inside bodyig">
        @foreach ($category->child as $childCategory)
            @include('livewire.category.child_category', ['child_category' => $childCategory])
        @endforeach
        </ol>
    @endforeach
</ol>
