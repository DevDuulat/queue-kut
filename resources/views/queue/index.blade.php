<x-layouts.app title="Очередь на квартиру">
    <form action="{{ route('queue.submit') }}" method="POST"
          x-data="{
        currentStage: {{ old('currentStage', 1) }},
        queue_type: '{{ old('queue_type', 'without_down_payment') }}',
        apartment_type: '{{ old('apartment_type', '1_room') }}',
        monthly_payment: '{{ old('monthly_payment') }}',
        custom_monthly: '{{ old('custom_monthly') }}',
        down_payment: '{{ old('down_payment') }}',
        payment_term: '{{ old('payment_term') }}',
        number: '{{ old('number') }}'
      }" class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 lg:max-h-screen">
        @csrf
        <input type="hidden" name="currentStage" x-model="currentStage">

        <div class="w-full my-4 lg:hidden">
            <img src="{{ asset('img/25.webp') }}" class="w-full h-60 sm:h-64 object-cover rounded-[24px]">
        </div>

        <div class="h-full rounded-[24px] hidden lg:block">
            <img src="{{ asset('img/25.webp') }}" class="w-full h-full object-cover rounded-[24px]">
        </div>

        <div class="bg-[#F5F5F5] flex flex-col items-center lg:col-span-2 rounded-[24px] border border-gray-100 h-auto lg:h-full lg:p-6 py-6 sm:py-8">

            <div class="mb-8 text-center">
                <img src="{{ asset('img/logo.png') }}" class="w-36 object-cover">
            </div>



            <div class="flex flex-col w-full max-w-3xl mx-auto p-4 h-auto sm:h-[calc(100vh-140px)] lg:h-full overflow-auto">


                <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-8 text-center lg:text-center">ОЧЕРЕДЬ НА КВАРТИРУ</h2>

                <div class="flex justify-center w-full mb-4">
                    <x-queue.steps-indicator />
                </div>

                <div x-show="currentStage === 1" id="stage-1">
                    <x-queue.stage-one />
                </div>
                <div x-show="currentStage === 2" id="stage-2">
                    <x-queue.stage-two :curators="$curators" />
                </div>
                <div x-show="currentStage === 3" id="stage-3">
                    <x-queue.stage-three />
                </div>

                <div class="w-full flex justify-center space-x-6 pt-6 pb-4 px-4 sm:px-6 lg:px-8  border-gray-200 bg-[#F5F5F5]/90 sticky bottom-0 lg:relative">
                    <button type="button" @click="currentStage--" x-show="currentStage > 1" :disabled="currentStage === 1"
                            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 disabled:opacity-50 transition duration-150">
                        <x-icons.prev-icon/>
                        Назад
                    </button>

                    <button type="button" @click="if(validateStep(currentStage)){ currentStage++ }" x-show="currentStage < 3"
                            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-[#FFDD2D] transition duration-150">
                        Далее
                        <x-icons.next-icon/>
                    </button>

                    <button type="submit" x-show="currentStage === 3"
                            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150">
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

            const inputs = stage.querySelectorAll('input[required]:not([type="hidden"]), select[required], textarea[required]');

            for (let input of inputs) {
                if (!input.value.trim()) {
                    input.reportValidity();
                    return false;
                }

                if (!input.checkValidity()) {
                    input.reportValidity();
                    return false;
                }
            }

            return true;
        }

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('queueForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ env('GOOGLE_RECAPTCHA_KEY') }}', { action: 'queue_submit' })
                        .then(function(token) {
                            let input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'g-recaptcha-response';
                            input.value = token;
                            form.prepend(input);
                            form.submit();
                        });
                });
            });
        });
    </script>
</x-layouts.app>
