@props(["title"=>"", "multiple"=>false, "name"=>"", "id"=>"file_input", "wiremodel"=>""])
<div class="mt-3">
    @if ($title!="")
    <x-input-label for="{{$id}}">{{$title}}</x-input-label>
        
    @endif
    <div class="flex items-center mt-2 relative h-10 overflow-hidden rounded-md">
        <input {{$wiremodel != "" ? "wire:model=". $wiremodel : ""}} required type="file" id="{{$id}}" name="{{$name}}" {{$multiple ? 'multiple' : ''}} required class="w-full opacity-0 absolute" accept="image/*">
        <span id="file-name" class=" flex-1 p-2 line-clamp-1 space-y-1 bg-white h-full text-gray-700">Pilih File</span>

        <label for="photos" class="flex relative group items-center justify-center px-4 py-2 bg-gradient-to-r from-fuchsia-600 to-purple-600 text-white  cursor-pointer hover:bg-red-500">
            <span class="">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                  </svg>
                
                  
            </span>
            <div class="w-full h-full absolute bg-white bg-opacity-0 group-hover:bg-opacity-25 duration-300 top-0 left-0"></div>

        </label>

    </div>
    <script>
    const fileInput = document.getElementById('{{$id}}');
    const fileNameDisplay = document.getElementById('file-name');

    fileInput.addEventListener('change', function() {
        const files = Array.from(fileInput.files);
        fileNameDisplay.textContent = files.length > 0 ? files.map(file => file.name).join(', ') : '';
    });
</script>


    @if ($multiple)
    <p class="mt-1 text-xs text-gray-500">Pilih lebih dari satu foto</p>
        
    @endif
</div>