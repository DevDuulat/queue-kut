<h3 class="text-lg font-semibold text-gray-900 mb-4">Тип очереди</h3>
<div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-8">

    <label class="flex-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
        <input type="radio" name="queue_type" value="without_down_payment" x-model="queue_type" class="sr-only">
        <div class="flex items-center space-x-3">
            <div class="w-4 h-4 rounded-full border border-gray-400"></div>
            <span class="text-base text-gray-900">Без первоначального взноса</span>
        </div>
    </label>
    <label class="flex-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">

        <input type="radio" name="queue_type" value="with_down_payment" x-model="queue_type" class="sr-only">
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
        <input type="radio"
               name="queue_type"
               value="without_down_payment"
               x-model="$root.queue_type"
               class="sr-only"
               checked>

        <div class="flex items-center space-x-3">
            <div class="w-4 h-4 rounded-full border border-gray-400"></div>
            <span class="text-base text-gray-900">2-х комнатная</span>
        </div>
    </label>

    <label class="col-span-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 flex items-center justify-center hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
        <input type="radio"
               name="queue_type"
               value="with_down_payment"
               x-model="$root.queue_type"
               class="sr-only">

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