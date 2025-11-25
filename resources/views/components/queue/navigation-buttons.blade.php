<div class="w-full flex justify-center space-x-6 pt-6 pb-4 px-4 sm:px-6 lg:px-8 border-t border-gray-200 bg-[#F5F5F5]/90 sticky bottom-0 lg:relative">
    <button
            @click="currentStage--"
            x-show="currentStage > 1"
            :disabled="currentStage === 1"
            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 disabled:opacity-50 transition duration-150"
    >
        <x-icons.prev-icon/>
        Назад
    </button>

    <button
            @click="currentStage++"
            x-show="currentStage < 3"
            :disabled="currentStage === 3"
            class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-700 bg-[#FFDD2D]  transition duration-150"
    >
        Далее
        <x-icons.next-icon/>
    </button>
</div>