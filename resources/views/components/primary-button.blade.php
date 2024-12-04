<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-gradient-to-r border from-fuchsia-500 to-pink-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 h-10 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
