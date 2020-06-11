<div class="w-1/2 my-10">
    @error('photos') <span class="error">{{ $message }}</span> @enderror


    <!-- <div wire:loading wire:target="photo">Uploading...</div>
    <div wire:loading wire:target="save">Storing to S3...</div> -->
    @if (session()->has('message'))
    <div class="p-2 bg-green-800 text-white my-10 rounded shadow">
        {{ session('message') }}
    </div>
    @endif

    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <div class="w-full h-40 rounded-lg text-center text-gray-500 p-16 cursor-pointer border border-dashed border-gray-500"
            style="background-image: linear-gradient( 89.9deg,  rgba(208,246,255,1) 0.1%, rgba(255,237,237,1) 47.9%, rgba(255,255,231,1) 100.2% );"
            @click="$refs.fileInput.click()">Upload Images</div>
        <input x-ref="fileInput" type="file" multiple wire:model="photos" class="hidden" />

        <!-- Progress Bar -->
        <div x-show="isUploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>
    </div>
    @if ($photos)
    @foreach($photos as $photo)
    <div class="p-4 my-3 rounded-lg shadow-lg transition-all duration-500"
        style="background-image: radial-gradient( circle farthest-corner at 14.2% 27.5%,  rgba(104,199,255,1) 0%, rgba(181,126,255,1) 90% );"
        wire:key="{{$loop->index}}">
        <i class="fas fa-times-circle text-gray-700 text-2xl float-right cursor-pointer"
            wire:click="remove({{$loop->index}})"></i>
        <div class="flex justify-center">
            <img src="{{ $photo->temporaryUrl() }}" width="250">
        </div>
    </div>
    @endforeach
    <button wire:loading.remove wire:click.prevent="save" class="w-full p-2 text-white rounded shadow-lg"
        style="background-image: linear-gradient( 65.4deg,  rgba(56,248,249,1) -9.1%, rgba(213,141,240,1) 48%, rgba(249,56,152,1) 111.1% );">Save</button>
    <button wire:loading wire:target="save" class="w-full p-2 text-white rounded shadow-lg"
        style="background-image: linear-gradient( 65.4deg,  rgba(56,248,249,1) -9.1%, rgba(213,141,240,1) 48%, rgba(249,56,152,1) 111.1% );">
        <i class="fas fa-spinner fa-spin text-2xl"></i>
    </button>
    @endif
</div>