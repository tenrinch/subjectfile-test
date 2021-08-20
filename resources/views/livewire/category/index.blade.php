<ol class="w-11/12 ml-auto list-decimal list-inside bodyig" x-data="{selected:null}">
    @foreach($categories as $category)
    <li @click="selected !== {{$category->id}} ? selected = {{$category->id}} : selected = null"
            class=" bg-gray-200 w-full cursor-pointer px-4 py-3 text-gray-800 inline-block hover:opacity-75 hover:shadow hover:-mb-3 rounded-t font-bold border border-gray-300 my-1">
        {{$category->title}}
    </li> 
    @if(count($category->child))
        @livewire('category.index',['categories'=>$category->child])
    @endif
    @endforeach   
</ol>
  
