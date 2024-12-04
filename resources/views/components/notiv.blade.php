@props(["message" => ""])

@if ($message != "")
<div x-data="{ show: false, isVisible: false }" 
     x-init="setTimeout(() => { show = true; isVisible = true; setTimeout(() => { isVisible = false }, 5000); }, 50)" 
     class="fixed w-full top-0 left-0 z-50 flex justify-center">
    
    <div x-show="isVisible" 
         x-transition:enter="animate__animated animate__fadeInDown" 
         x-transition:leave="animate__animated animate__fadeOutUp"
         class="mt-4 flex gap-2 animate__faster  w-full max-w-80 h-12 bg-white rounded-md border-purple-300 border-4">
        <div class="icon flex-0 w flex items-center justify-center text-white bg-gradient-to-r from-fuchsia-600 to-purple-600 w-12 h-full">
          <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M3.559 4.544c.355-.35.834-.544 1.33-.544H19.11c.496 0 .975.194 1.33.544.356.35.559.829.559 1.331v9.25c0 .502-.203.981-.559 1.331-.355.35-.834.544-1.33.544H15.5l-2.7 3.6a1 1 0 0 1-1.6 0L8.5 17H4.889c-.496 0-.975-.194-1.33-.544A1.868 1.868 0 0 1 3 15.125v-9.25c0-.502.203-.981.559-1.331ZM7.556 7.5a1 1 0 1 0 0 2h8a1 1 0 0 0 0-2h-8Zm0 3.5a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2H7.556Z" clip-rule="evenodd"/>
          </svg>
        </div>
        <div class="flex-1 text-center text-black flex items-center justify-center">
            {{ $message }} <!-- Menampilkan pesan -->
        </div>
      </div>
</div>
@endif
