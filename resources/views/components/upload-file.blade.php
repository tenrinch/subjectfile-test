<label class="block text-sm font-medium text-gray-700">
Upload Files
</label>
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
                    <input type="file" class="sr-only" wire:model.debounce.250ms="files" multiple>
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