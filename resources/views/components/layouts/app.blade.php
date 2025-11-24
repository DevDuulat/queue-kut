<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Laravel' }} - Очередь на квартиру</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ADDED: Apply Montserrat font to the body */
        body {
            font-family: 'Montserrat', sans-serif;
        }

        /* CUSTOM CSS FOR RADIO BUTTONS */
        input[type="radio"]:checked + div > div {
            background-color: #fcd34d;
            border-color: #fcd34d;
            box-shadow: 0 0 0 2px white inset;
        }

        input[type="radio"]:checked ~ span {
            font-weight: 600;
        }

        label:has(input[type="radio"]:checked) {
            border-color: #fcd34d;
        }

        /* NEW: Utility to set height for non-desktop devices */
        @media (max-width: 1023px) {
            .mobile-height-fix {
                min-height: 100vh;
            }
        }
        /* Example for WebKit browsers */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #fcd34d;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }
    </style>
</head>
<body class="px-6 lg:px-12">




{{ $slot }}

<script>
    function phoneMask() {
        return {
            number: '',
            formatPhone() {
                let digits = this.number.replace(/\D/g, '').slice(0, 9)
                if(digits.length > 6){
                    this.number = `(${digits.slice(0,3)}) ${digits.slice(3,6)} - ${digits.slice(6,9)}`
                } else if(digits.length > 3){
                    this.number = `(${digits.slice(0,3)}) ${digits.slice(3,6)}`
                } else if(digits.length > 0){
                    this.number = `(${digits}`
                }
            }
        }
    }
</script>
</body>
</html>