<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - Очередь на квартиру</title>

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
    </style>
</head>
<body class="p-6 lg:p-0">

<div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 mobile-height-fix lg:max-h-screen lg:overflow-hidden p-0 lg:p-6">

    <div class="h-full rounded-[24px] hidden lg:block">
        <img src="{{ asset('img/kut.webp') }}" class="w-full h-full object-cover rounded-[24px]">
    </div>

    <div class="bg-[#F5F5F5] flex flex-col items-center py-10 px-4 sm:px-6 lg:px-8 lg:col-span-2 rounded-[24px] border border-gray-100 h-full overflow-y-auto">

        <div class="mb-12 text-center">
            <img src="{{ asset('img/logo.png') }}" class="w-36 object-cover">
        </div>

        <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-10">
            ОЧЕРЕДЬ НА КВАРТИРУ
        </h2>

        <div class="flex justify-center items-center w-full max-w-lg mb-16 relative">
            <div class="flex flex-col items-center w-1/3 relative z-10">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400  text-black font-bold text-lg">1</div>
                <p class="mt-2 text-center text-sm font-semibold text-gray-900">Параметры очереди</p>
            </div>

            <div class="h-0.5 bg-gray-300 absolute left-[calc(1/6*100%-10px)] right-[calc(1/3*100%+10px)] top-5"></div>

            <div class="flex flex-col items-center w-1/3 relative z-10">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 font-medium text-lg">2</div>
                <p class="mt-2 text-center text-sm text-gray-500">Данные клиента</p>
            </div>

            <div class="h-0.5 bg-gray-300 absolute left-[calc(1/3*100%+10px)] right-[calc(1/6*100%-10px)] top-5"></div>

            <div class="flex flex-col items-center w-1/3 relative z-10">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 font-medium text-lg">3</div>
                <p class="mt-2 text-center text-sm text-gray-500">Условия оплаты</p>
            </div>
        </div>

        <div class="w-full max-w-3xl">

            <h3 class="text-lg font-semibold text-gray-900 mb-4">Тип очереди</h3>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-8">

                <label class="flex-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
                    <input type="radio" name="queue_type" value="without_down_payment" class="sr-only" checked>
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border border-gray-400"></div>
                        <span class="text-base text-gray-900">Без первоначального взноса</span>
                    </div>
                </label>
                <label class="flex-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
                    <input type="radio" name="queue_type" value="with_down_payment" class="sr-only">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border border-gray-400"></div>
                        <span class="text-base text-gray-900">С первоначальным взносом</span>
                    </div>
                </label>
            </div>

            <h3 class="text-lg font-semibold text-gray-900 mb-4">Тип квартиры</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-12">

                <label class="col-span-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 flex items-center justify-center hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
                    <input type="radio" name="apartment_type" value="1_room" class="sr-only" checked>
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border border-gray-400"></div>
                        <span class="text-base text-gray-900">1-комнатная</span>
                    </div>
                </label>

                <label class="col-span-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 flex items-center justify-center hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
                    <input type="radio" name="apartment_type" value="2_room" class="sr-only">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border border-gray-400"></div>
                        <span class="text-base text-gray-900">2-х комнатная</span>
                    </div>
                </label>

                <label class="col-span-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 flex items-center justify-center hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
                    <input type="radio" name="apartment_type" value="3_room" class="sr-only">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border border-gray-400"></div>
                        <span class="text-base text-gray-900">3-х комнатная</span>
                    </div>
                </label>

                <label class="col-span-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 flex items-center justify-center hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
                    <input type="radio" name="apartment_type" value="4_room" class="sr-only">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border border-gray-400"></div>
                        <span class="text-base text-gray-900">4-х комнатная</span>
                    </div>
                </label>

            </div>


            <div class="flex justify-center space-x-6 pb-6"> <button class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 disabled:opacity-50 transition duration-150" disabled>
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Назад
                </button>

                <button class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-[#FFDD2D]  transition duration-150">
                    Далее
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

</body>
</html>