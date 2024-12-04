@props(['active'=>false, 'href'=>''])


<a href="{{$href}}" class="flex items-center p-2 {{ $active ? 'text-purple-600 h-12 bg-white rounded-lg shadow-md' : 'text-gray-600 h-8'}} font-semibold ">
    <div class="iconBox w-8 h-8 flex items-center justify-center  bg-gradient-to-r {{$active ? ' from-fuchsia-500 to-cyan-500 rounded-md text-white' : 'bg-white text-gray-800 shadow-md'}}">
        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
          </svg>
    </div>
    <p class="pl-2">
        {{$slot}}
    </p>
</a>