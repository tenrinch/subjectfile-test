<div>
    <table class="w-full text-sm bg-white mt-3">
        <thead>
            <tr class="uppercase font-semibold text-left text-gray-900 bg-gray-200 border-t border-b border-gray-600">
                <td class="pl-4 py-3 text-sm border-r">#</td>
                <td class="px-2 py-3 text-sm border-r">Dispatched No</td>
                <td class="px-2 py-3 text-sm border-r"></td>
            </tr>
        </thead>
        <tbody class="bodyig">
            @foreach($categories as $category)
                <tr>
                    <td class="pl-4 py-2 text-sm border font-semibold">{{$loop->iteration}}</td>
                    <td class="px-2 py-2 text-sm border font-semibold">{{$category->title}}</td>
                    <td class="px-2 py-2 text-sm border text-center">
                        <div class="w-full flex flex-row justify-around">
                            <a href="{{url('staff/categories')}}/{{$category->id}}/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" wire:click="$set('delete_id', {{ $category->id }})" wire:loading.attr="disabled" data-toggle="modal" data-target="#delete_modal">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @php 
                    $parent = $loop->iteration;
                @endphp
                @foreach ($category->child as $childCategory)
                    @include('livewire.category.child_category', 
                    ['child_category' => $childCategory,'parent_iteration'=>$parent])
                @endforeach
            @endforeach 
        </tbody>
    </table>
    @include('livewire.delete-modal')
</div>
 