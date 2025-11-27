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
        body {
            font-family: 'Montserrat', sans-serif;
        }

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

        @media (max-width: 1023px) {
            .mobile-height-fix {
                min-height: 100vh;
            }
        }
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

        /* --- Общая структура модального окна --- */

        .popup-overlay {
            /* Фон затемнения */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Полупрозрачный серый фон */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            /* Основной блок контента */
            background: #ffffff;
            border-radius: 12px; /* Закругление углов */
            padding: 30px 25px;
            width: 100%;
            max-width: 400px; /* Ограничение ширины, как на фото */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #333333;
        }

        /* --- Кнопка закрытия (X) --- */

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: #999;
            cursor: pointer;
            line-height: 1;
            padding: 0;
        }

        /* --- Иконка успеха (Зеленый круг с галочкой) --- */

        .success-icon {
            /* Имитация зеленой галочки. В реальном проекте используйте SVG/Image/Font Icon */
            width: 60px;
            height: 60px;
            background-color: #4CAF50; /* Ярко-зеленый */
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Простая галочка, если нет иконки */
            font-size: 32px;
            color: white;
        }
        .success-icon::after {
            content: "✓";
            font-weight: bold;
        }



        .popup-title {
            font-size: 22px;
            font-weight: 700; /* Жирный */
            margin-bottom: 30px;
            line-height: 1.3;
        }


        .queue-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .queue-number {
            font-size: 48px;
            font-weight: 800; /* Экстра-жирный */
            color: #FFC107; /* Ярко-желтый/золотистый цвет */
            margin-bottom: 30px;
            line-height: 1;
        }

        /* --- Детали заявки (Таблица) --- */

        .details-section {
            width: 100%;
            text-align: left;
            margin-bottom: 30px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 16px;
            border-bottom: 1px solid #eeeeee;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row span:first-child {
            color: #666;
            font-weight: 400;
        }

        .detail-row span:last-child {
            color: #333;
            font-weight: 500;
            text-align: right;
        }

        .detail-value {
            font-weight: 500;
        }

        .detail-value-bold {
            font-weight: 700;
        }

        .detail-value-light {
            font-weight: 400;
        }



        .popup-actions {
            display: flex;
            gap: 15px;
        }

        .action-button {
            flex-grow: 1;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;

            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;

            justify-content: center;
            transition: background-color 0.2s;
        }

        .action-button svg {
            margin-bottom: 2px;
            width: 24px;
            height: 24px;
        }
        .download-button {
            background: #f0f0f0;
            color: #333;
            border: none;
        }
        .download-button svg path {
            fill: black;
        }
        .whatsapp-button {
            background: #25D366;
            color: white;
            border: none;
        }
        .whatsapp-button svg path {
            stroke: white;
        }
    </style>
</head>
<body class="px-4 py-6 sm:px-6 sm:py-8 lg:px-12 lg:py-12">

@if(session('error'))
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-xl max-w-sm w-full text-center">
            <p class="text-gray-800">{{ session('error') }}</p>
            <button onclick="this.parentElement.parentElement.remove()" class="mt-4 px-4 py-2 bg-yellow-400 rounded-full text-white">Закрыть</button>
        </div>
    </div>
@endif

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