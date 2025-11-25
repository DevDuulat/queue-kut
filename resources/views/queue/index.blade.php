<x-layouts.app title="Очередь на квартиру">
    <form action="{{ route('queue.submit') }}" method="POST" x-data="{
        currentStage: 1,
        queue_type: 'without_down_payment',
        apartment_type: '1_room',
        monthly_payment: null,
        custom_monthly: null,
        down_payment: null,
        payment_term: null,
        number: ''
    }" class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 lg:max-h-screen lg:overflow-hidden p-0 lg:p-6">
        @csrf

        <div class="w-full my-4 lg:hidden">
            <img src="{{ asset('img/kut.webp') }}" class="w-full h-80 sm:h-96 object-cover rounded-[24px]">
        </div>

        <div class="h-full rounded-[24px] hidden lg:block">
            <img src="{{ asset('img/kut.webp') }}" class="w-full h-full object-cover rounded-[24px]">
        </div>

        <div class="bg-[#F5F5F5] flex flex-col items-center lg:col-span-2 rounded-[24px] border border-gray-100 h-auto lg:h-full lg:p-6 py-6 sm:py-8">

            <div class="mb-8 text-center">
                <img src="{{ asset('img/logo.png') }}" class="w-36 object-cover">
            </div>

            <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-8 text-center lg:text-left">ОЧЕРЕДЬ НА КВАРТИРУ</h2>

            <x-queue.steps-indicator />

            <div class="flex flex-col w-full max-w-3xl mx-auto p-[16px] h-[380px] sm:h-[450px]">
                <div class="flex-1 overflow-auto">
                    <div x-show="currentStage === 1" class="h-full" id="stage-1">
                        <x-queue.stage-one />
                    </div>
                    <div x-show="currentStage === 2" class="h-full" id="stage-2">
                        <x-queue.stage-two />
                    </div>
                    <div x-show="currentStage === 3" class="h-full" id="stage-3">
                        <x-queue.stage-three />
                    </div>

                </div>

                <div class="w-full flex justify-center space-x-6 pt-6 pb-4 px-4 sm:px-6 lg:px-8 border-t border-gray-200 bg-[#F5F5F5]/90 sticky bottom-0 lg:relative">
                    <button
                            type="button"
                            @click="currentStage--"
                            x-show="currentStage > 1"
                            :disabled="currentStage === 1"
                            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 disabled:opacity-50 transition duration-150"
                    >
                        <x-icons.prev-icon/>
                        Назад
                    </button>

                    <button
                            type="button"
                            @click="if(validateStep(currentStage)){ currentStage++ }"
                            x-show="currentStage < 3"
                            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-[#FFDD2D] transition duration-150"
                    >
                        Далее
                        <x-icons.next-icon/>
                    </button>

                    <button
                            type="submit"
                            x-show="currentStage === 3"
                            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150"
                    >
                        В очередь
                    </button>
                </div>
            </div>
        </div>
    </form>
    <x-popup />


    <script>
        function validateStep(step) {
            const stage = document.querySelector(`#stage-${step}`);
            if (!stage) return true;
            const inputs = stage.querySelectorAll('input[required], select[required], textarea[required]');
            for (let input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return false;
                }
            }
            return true;
        }
    </script>

</x-layouts.app>
