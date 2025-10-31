@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' => '
                bg-white 
                border border-gray-300 
                text-gray-800 
                focus:border-blue-500 
                focus:ring-blue-500 
                rounded-md 
                shadow-sm 
                dark:bg-white 
                dark:text-gray-800 
                dark:border-gray-300 
                dark:focus:border-blue-500 
                dark:focus:ring-blue-500
            ',
    ]) }}>
