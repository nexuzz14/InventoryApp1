@props(['messages', "hide"=>true])

@if ($messages )
    <div x-data="{show:true}" x-show="show" {{ $attributes->merge(['class' => 'text-sm text-red-600 mt-1 justify-between h-8 px-2 rounded-md bg-pink-100 flex items-center']) }}>
        @foreach ((array) $messages as $message)
            <div class="flex-1 line-clamp-1">{{ $message }}</div>
            @if ($hide)
            <button type="button" @click="$messages = ''">
                <svg class="w-6 h-full flex-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                </svg>
            </button>
            @endif
       
        @endforeach
    </div>
@endif
