<h3 class="text-lg font-semibold text-gray-900 mb-4">Тип очереди</h3>
<div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
    @foreach (\App\Enums\QueueType::cases() as $type)
        <label class="flex-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
            <input type="radio" name="queue_type" value="{{ $type->frontendValue() }}" x-model="queue_type" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border border-gray-400 flex-shrink-0 flex items-center justify-center">
                    <div class="w-2 h-2 rounded-full bg-gray-900 opacity-0"></div>
                </div>
                <span class="text-base text-gray-900">{{ $type->label() }}</span>
            </div>
        </label>
    @endforeach
</div>

<h3 class="text-lg font-semibold text-gray-900 mb-4">Тип квартиры</h3>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-12">
    @foreach (\App\Enums\ApartmentType::cases() as $apartment)
        <label class="col-span-1 cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 p-6 flex items-center justify-center hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150">
            <input type="radio" name="apartment_type" value="{{ $apartment->value }}" x-model="apartment_type" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border border-gray-400 flex-shrink-0 flex items-center justify-center"></div>
                <span class="text-base text-gray-900">{{ $apartment->label() }}</span>
            </div>
        </label>
    @endforeach
</div>
