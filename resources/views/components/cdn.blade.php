<style>
    *::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    *::-webkit-scrollbar {
        width: 10px;
        background-color: #F5F5F5;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #F90;
        background-image: -webkit-linear-gradient(45deg,
                rgba(255, 255, 255, .2) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, .2) 50%,
                rgba(255, 255, 255, .2) 75%,
                transparent 75%,
                transparent)
    }

    /* Menghilangkan spinner di browser berbasis Webkit (Chrome, Safari, Edge, Opera) */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Menghilangkan spinner di Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<link rel="stylesheet" href="{{ asset('asset/css/config.css') }}">
@vite('resources/css/app.css')
<link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
