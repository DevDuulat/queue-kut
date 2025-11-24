{{--Current 1--}}
<div x-show="currentStage === 1" class="flex justify-center items-center w-full max-w-lg mb-16 relative">
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

{{--Current 2--}}
<div x-show="currentStage === 2" class="flex justify-center items-center w-full max-w-lg mb-16 relative">
    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Параметры очереди</p>
    </div>

    <div class="h-0.5 bg-yellow-400 absolute left-[16.66%] right-[50%] top-5"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">2</div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Данные клиента</p>
    </div>

    <div class="h-0.5 bg-gray-300 absolute left-[50%] right-[16.66%] top-5"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 font-medium text-lg">3</div>
        <p class="mt-2 text-center text-sm text-gray-500">Условия оплаты</p>
    </div>
</div>
{{--Current 3--}}
<div x-show="currentStage === 3" class="flex justify-center items-center w-full max-w-lg mb-16 relative">
    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Параметры очереди</p>
    </div>

    <div class="h-0.5 bg-yellow-400 absolute left-[16.66%] right-[50%] top-5"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Данные клиента</p>
    </div>

    <div class="h-0.5 bg-yellow-400 absolute left-[50%] right-[16.66%] top-5"></div>

    <div class="flex flex-col items-center w-1/3 relative z-10">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-black font-bold text-lg">3</div>
        <p class="mt-2 text-center text-sm font-semibold text-gray-900">Условия оплаты</p>
    </div>
</div>
