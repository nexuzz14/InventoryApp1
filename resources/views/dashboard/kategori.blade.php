@extends('layouts.dashboard')
@section('content')
<!-- Start Recent Sales -->
<div class="flex flex-wrap">
    <div class="box flex-1   px-3 py-2" >
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header">Kategori</div>
        
            <table class="table-auto w-full text-left">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-l-0">foto</th>

                        <th class="px-4 py-2 border-r">Nama Kategori</th>
                        <th colspan="2" class=" py-2 text-center border-r">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
        
                    <tr class="hover:bg-gray-200  duration-200">
                        <td class="px-4-py2 border border-l-0" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWUOItP8iGGGN-d-fdiiDKzHVKQFlL09bHhw&s')">
                            
                        </td>
                        <td class="border  px-4 py-2">Lightning to USB-C Adapter Lightning.</td>
                       
                        <td class="border border-l-0 border-r-0 text-center  px-4 py-2">
                            <svg class="w-6 h-6 text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                              </svg>
                              
                        </td>
                        <td class="border text-center border-l-0 px-4 py-2">
                            <svg class="w-6 h-6 text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                              </svg>
                              
                        </td>
                     
                    </tr>
                   
        
                </tbody>
            </table>
        </div>
    </div>
  
    <div class="flex-0   px-3 py-2 w-full max-w-96">
        <div class="form  w-full  bg-white border border-1  px-3 py-2">
            <p class="text-lg font-bold py-2 border-b border-1">Tambah Kategori</p>
            <form action="" class="flex mt-3 flex-col">
                <label for="namaKategori">Nama Kategori</label>
                <input type="text" class="bg-gray-200 mb-2 active:ring-0 active:outline-none px-2 py-1 rounded focus:outline-none focus-within:ring-0" id="namaKategori">
                <label for="foto mt-3 pt-2">Foto Kategori</label>
                <div class="previewImage border border-1 rounded overflow-hidden max-w-full h-32 mt-2 mb-2"  id="previewContainer" style="display: none;">
                        <img id="imagePreview" src="" alt="Image preview" class="w-full h-full object-contain">
                </div>
                <div class="inputfile mb-2 flex relative overflow-hidden bg-blue-400 duration-200 py-2 rounded font-bold text-white mt-1 items-center cursor-pointer px-4">
                    <svg class="w-6 z-0 h-6 text-white absolute" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd"/>
                    </svg>
                
                    <!-- Text will be replaced with file name -->
                    <p style="" id="fileName" class="hover:pl-2 pl-8 line-clamp-1 z-1 text-white bg-transparent duration-200 hover:bg-blue-400 flex-1 w-full">Select File</p>
                
                    <input id="fileInput" class="absolute w-full h-full opacity-0" type="file" accept="image/*" onchange="updateFileName(event)">
                </div>
                
                <div class="flex items-end w-full justify-end">
                    <button class="bg-blue-400 capitalize text-white px-2 hover:px-4 duration-200 py-1 rounded">
                        tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Function to update file name when file is selected
    function updateFileName(event) {
        const fileInput = event.target;
        const fileNameDisplay = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('previewContainer');
        
        // Ensure only one file is selected and it's an image
        if (fileInput.files && fileInput.files[0] && fileInput.files[0].type.startsWith('image/')) {
            const file = fileInput.files[0];
            fileNameDisplay.textContent = file.name;

            // Create a URL for the selected image and set it as the src of the preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.style.display = 'block'; // Show the preview container
            };
            reader.readAsDataURL(file); // Read the file as a data URL to preview
        } else {
            fileNameDisplay.textContent = 'Please select an image file';
            previewContainer.style.display = 'none'; // Hide the preview if no valid file is selected
        }
    }
</script>
<!-- End Recent Sales -->
@endsection