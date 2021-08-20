<label class="block text-sm font-medium text-gray-700">
Upload File
</label>
<div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-100">
    <div class="space-y-1 text-center" x-data="{ isUploading: false, progress: 0}"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">
        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
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