<div x-show="currentStage === 1" class="flex justify-center items-start w-full max-w-full lg:max-w-lg mb-16 relative">
    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">1</div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Параметры очереди</p>
    </div>

    <div class="h-0.5 bg-gray-300 absolute top-5" style="left: calc(100%/6); right: calc(100%/3);"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 font-medium text-lg">2</div>
        <p class="mt-2 text-center text-sm text-gray-500">Данные клиента</p>
    </div>

    <div class="h-0.5 bg-gray-300 absolute top-5" style="left: calc(100%/3 + 10px); right: calc(100%/6 - 10px);"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 font-medium text-lg">3</div>
        <p class="mt-2 text-center text-sm text-gray-500">Условия оплаты</p>
    </div>
</div>

<div x-show="currentStage === 2" class="flex justify-center items-start w-full max-w-full lg:max-w-lg mb-16 relative">
    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Параметры очереди</p>
    </div>

    <div class="h-0.5 bg-yellow-400 absolute top-5" style="left: calc(100%/6); right: calc(100%/3);"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">2</div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Данные клиента</p>
    </div>

    <div class="h-0.5 bg-yellow-400 absolute top-5" style="left: calc(100%/3 + 10px); right: calc(100%/3 + 10px);"></div>
    <div class="h-0.5 bg-gray-300 absolute top-5" style="left: calc(100%/2); right: calc(100%/6 - 10px);"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 font-medium text-lg">3</div>
        <p class="mt-2 text-center text-sm text-gray-500">Условия оплаты</p>
    </div>
</div>

<div x-show="currentStage === 3" class="flex justify-center items-start w-full max-w-full lg:max-w-lg mb-16 relative">
    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Параметры очереди</p>
    </div>

    <div class="h-0.5 bg-yellow-400 absolute top-5" style="left: calc(100%/6); right: calc(100%/3);"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Данные клиента</p>
    </div>

    <div class="h-0.5 bg-yellow-400 absolute top-5" style="left: calc(100%/3 + 10px); right: calc(100%/6 - 10px);"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">3</div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Условия оплаты</p>
    </div>
</div>