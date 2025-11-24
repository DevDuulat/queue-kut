<x-layouts.app title="Очередь на квартиру">
    <div x-data="{ currentStage: 1 }"  class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 mobile-height-fix lg:max-h-screen lg:overflow-hidden p-0 lg:p-6">

        <div class="h-full rounded-[24px] hidden lg:block">
            <img src="{{ asset('img/kut.webp') }}" class="w-full h-full object-cover rounded-[24px]">
        </div>

        <div class="bg-[#F5F5F5] flex flex-col items-center lg:col-span-2 rounded-[24px] border border-gray-100 h-full lg:p-6">
            <div class="mb-12 text-center">
                <img src="{{ asset('img/logo.png') }}" class="w-36 object-cover">
            </div>

            <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-10">
                ОЧЕРЕДЬ НА КВАРТИРУ
            </h2>

            <x-queue.steps-indicator />

            <div x-show="currentStage === 1" class="w-full max-w-3xl mx-auto">
                <x-queue.stage-one />
            </div>

            <div x-show="currentStage === 2"  class="w-full max-w-3xl h-[300px] mx-auto overflow-auto"
            >
                <x-queue.stage-two />
            </div>

            <x-queue.navigation-buttons />

        </div>
    </div>
</x-layouts.app>