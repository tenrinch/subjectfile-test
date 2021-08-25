<label class="block text-sm font-medium text-gray-700">
Uploaded Files
</label>
<div class="grid grid-cols-2 gap-2">
    @foreach($medias as $media)
        <div class="md:col-span-1 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <div class="border border-gray-200 rounded-md divide-y divide-gray-200">
                <div class="pl-2 pr-3 py-3 flex items-center justify-between text-sm">
                    <div class="w-0 flex-1 flex items-center">
                        <i class="fas fa-paperclip flex-shrink-0 h-5 w-5 text-gray-400"></i>
                        <p class="ml-2 flex-1 w-0 truncate">
                            {{$media->name}}
                        </p>
                    </div>
                    <div class="ml-auto flex-shrink-0" x-data = "{removeMessage: false}">
                        <button type="button" x-on:click = "removeMessage = true " x-show="! removeMessage">
                            <i class="far fa-trash-alt  flex-shrink-0 h-5 w-5 text-red-400 hover:text-red-600"></i>
                        </button>
                        <div class="flex flex-row slide-right" x-show ="removeMessage">
                            <p class="text-red-600">Remove File?</p>
                            <div class="ml-4">
                                <button type="button" class="text-lead text-blue-400 mx-2 hover:text-blue-600" 
                                wire:click="removeFile({{$media->id}})">Yes</button>
                                <button type="button" class="text-lead text-gray-400 mx-2 hover:text-gray-600" x-on:click="removeMessage = false">No</button>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-span-2">
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-100">
            <div class="space-y-1 text-center" x-data="{ isUploading: false, progress: 0}"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
                <i class="fas fa-paperclip flex-shrink-0 h-5 w-5 text-gray-400"></i>
                @if($files)
                <div class="flex text-sm text-gray-600">
                    <p class="pl-1 text-green-500">{{count($files)}} files uploaded!</p>
                </div>
                @else
                <div class="flex text-sm text-gray-600" x-show="! isUploading">
                    <label class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>Upload file</span>
                        <input type="file" class="sr-only" wire:model="files" multiple>
                    </label>
                    <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500" x-show="! isUploading">
                   PDF, PNG, JPG
                </p>
                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress><br>
                    <div wire:loading wire:target="photo" class="text-xs text-gray-500">Uploading...</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
