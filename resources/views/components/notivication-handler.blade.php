@props(["message"=>""])

@if ($message)
<div x-data="{show:true}"
     x-show="show" 
    class="fixed top-18 w-screen max-w-96 -right-10 z-40">
        <div
        x-init="setTimeout(() => show = false, 5000)" 
            x-show="show"
            x-transition:enter="animate__animated animate__faster animate__fadeInRight"
            x-transition:leave="animate__animated animate__faster animate__fadeOutRight"

        
        class="bg-white border w-5/6 items-center justify-center  p-2 shadow-md border-l-8 border-l-blue-400 rounded flex animate__animated animate__faster animate__fadeInRight">
            <p class="flex-1 line-clamp-2 rounded bg-blue-100 text-blue-600 p-2">{{$message}}</p>
            <div class="btonBox flex-0 w-10 h-full justify-center items-center flex">
                <button @click="show=false">
                    <svg class="w-8 h-8 text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                      </svg>
                      
                </button>
            </div>
        </div>
</div>
@endif
