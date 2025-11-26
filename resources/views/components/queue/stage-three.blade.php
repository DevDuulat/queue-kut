<div x-data="{
        monthly_payment_no_down: '{{ old('monthly_payment_no_down') }}',
        custom_monthly_payment: '{{ old('custom_monthly_payment') }}',
        down_payment: '{{ old('down_payment') }}',
        monthly_payment_custom: '{{ old('monthly_payment_custom') }}',
        payment_term: '{{ old('payment_term') }}'
    }">
    <div x-show="queue_type === 'without_down_payment'">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <template x-for="option in ['40000', '60000', '80000']" :key="option">
                <label class="block p-4 h-full rounded-[24px] cursor-pointer shadow-sm border bg-white transition duration-150 ease-in-out hover:border-yellow-400 hover:bg-[#FFFCEA]"
                       :class="monthly_payment_no_down === option ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
                    <input type="radio" name="monthly_payment_no_down" :value="option" x-model="monthly_payment_no_down" class="sr-only">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                             :class="monthly_payment_no_down === option ? 'border-yellow-400' : 'border-gray-400'">
                            <div x-show="monthly_payment_no_down === option" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                        </div>
                        <span class="text-base text-gray-900 select-none" x-text="`До ${Number(option).toLocaleString('ru-RU')} сом`"></span>
                    </div>
                </label>
            </template>
            <label class="block p-4 rounded-[24px] cursor-pointer shadow-sm border bg-white transition duration-150 ease-in-out hover:border-yellow-400 hover:bg-[#FFFCEA]"
                   :class="monthly_payment_no_down === 'other' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
                <input type="radio" name="monthly_payment_no_down" value="other" x-model="monthly_payment_no_down" class="sr-only">
                <div class="flex items-center space-x-3">
                    <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                         :class="monthly_payment_no_down === 'other' ? 'border-yellow-400' : 'border-gray-400'">
                        <div x-show="monthly_payment_no_down === 'other'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                    </div>
                    <span class="text-base text-gray-900 select-none">Другая сумма</span>
                </div>
                <input type="number"
                       name="custom_monthly_payment"
                       x-model="custom_monthly_payment"
                       placeholder="Введите сумму"
                       :class="monthly_payment_no_down !== 'other' ? 'hidden' : 'mt-3 block w-full rounded-[24px] bg-white p-4 border border-yellow-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-150'">
            </label>
            @error('monthly_payment_no_down')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @error('custom_monthly_payment')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div x-show="queue_type === 'with_down_payment'">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="down_payment" class="block text-sm font-medium text-gray-700 mb-2">Сумма первоначального взноса:</label>
                <input type="text" name="down_payment" min="1000000" placeholder="Минимальная сумма: 1 000 000 сом"
                       x-model="down_payment"
                       class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150" />
                @error('down_payment')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="monthly_payment_custom" class="block text-sm font-medium text-gray-700 mb-2">Ежемесячный платёж:</label>
                <input type="number" name="monthly_payment_custom" x-model="monthly_payment_custom" min="60000" placeholder="Например: 60 000 сом"
                       class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-yellow-400 transition duration-150" />
                @error('monthly_payment_custom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <template x-for="term in ['2','4','5','6']" :key="term">
                <label class="block p-4 h-full cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150 ease-in-out"
                       :class="payment_term === term ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
                    <input type="radio" name="payment_term" :value="term" x-model="payment_term" class="sr-only">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                             :class="payment_term === term ? 'border-yellow-400' : 'border-gray-400'">
                            <div x-show="payment_term === term" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                        </div>
                        <span class="text-base text-gray-900 select-none" x-text="`${term} ${term === '2' ? 'года' : 'лет'}`"></span>
                    </div>
                </label>
            </template>
            @error('payment_term')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
