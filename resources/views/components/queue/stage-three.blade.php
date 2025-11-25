<div x-show="queue_type === 'without_down_payment'">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Сколько вы готовы оплачивать ежемесячно?</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <label class="block p-4 h-full rounded-[24px] cursor-pointer shadow-sm border bg-white transition duration-150 ease-in-out hover:border-yellow-400 hover:bg-[#FFFCEA]"
               :class="monthly_payment_no_down === '40000' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="monthly_payment_no_down" value="40000" x-model="monthly_payment_no_down" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="monthly_payment_no_down === '40000' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="monthly_payment_no_down === '40000'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">До 40 000 сом</span>
            </div>
        </label>
        <label class="block p-4 h-full rounded-[24px] cursor-pointer shadow-sm border bg-white transition duration-150 ease-in-out hover:border-yellow-400 hover:bg-[#FFFCEA]"
               :class="monthly_payment_no_down === '60000' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="monthly_payment_no_down" value="60000" x-model="monthly_payment_no_down" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="monthly_payment_no_down === '60000' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="monthly_payment_no_down === '60000'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">До 60 000 сом</span>
            </div>
        </label>
        <label class="block p-4 h-full rounded-[24px] cursor-pointer shadow-sm border bg-white transition duration-150 ease-in-out hover:border-yellow-400 hover:bg-[#FFFCEA]"
               :class="monthly_payment_no_down === '80000' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="monthly_payment_no_down" value="80000" x-model="monthly_payment_no_down" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="monthly_payment_no_down === '80000' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="monthly_payment_no_down === '80000'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">До 80 000 сом</span>
            </div>
        </label>
        <label class="block p-4 h-full rounded-[24px] cursor-pointer shadow-sm border bg-white transition duration-150 ease-in-out hover:border-yellow-400 hover:bg-[#FFFCEA]"
               :class="monthly_payment_no_down === 'other' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="monthly_payment_no_down" value="other" x-model="monthly_payment_no_down" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="monthly_payment_no_down === 'other' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="monthly_payment_no_down === 'other'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">Другая сумма</span>
            </div>
        </label>
    </div>
    <div x-show="monthly_payment_no_down === 'other'" class="mt-6">
        <label for="custom_monthly_input_without" class="block text-sm font-medium text-gray-700 mb-2">Ваша ежемесячная сумма (сом):</label>
        <input type="number"
               id="custom_monthly_input_without"
               x-model="custom_monthly"
               name="custom_monthly_payment"
               class="w-full rounded-[24px] border border-gray-300 bg-white p-4 shadow-sm focus:border-yellow-400 focus:ring-yellow-400 transition duration-150">
    </div>
</div>

<div x-show="queue_type === 'with_down_payment'">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="down_payment" class="block text-sm font-medium text-gray-700 mb-2">Сумма первоначального взноса:</label>
            <input type="text" name="down_payment" min="1000000" placeholder="Минимальная сумма: 1 000 000 сом"
                   x-model="down_payment"
                   class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150" />
        </div>
        <div>
            <label for="monthly_payment_custom" class="block text-sm font-medium text-gray-700 mb-2">Ежемесячный платёж:</label>
            <input type="text" name="monthly_payment_custom" min="1000000" placeholder="Например: 60 000 сом"
                   x-model="custom_monthly"
                   class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-yellow-400 transition duration-150" />
        </div>
        <div class="col-span-full">
            <h4 class="block text-sm font-medium text-gray-700 mb-2 mt-4">Срок оплаты:</h4>
        </div>
        <label class="block p-4 h-full  cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150  ease-in-out"
               :class="payment_term === '2' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="payment_term" value="2" x-model="payment_term" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="payment_term === '2' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="payment_term === '2'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">2 года</span>
            </div>
        </label>
        <label class="block p-4 h-full  cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150  ease-in-out"
               :class="payment_term === '4' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="payment_term" value="4" x-model="payment_term" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="payment_term === '4' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="payment_term === '4'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">4 года</span>
            </div>
        </label>
        <label class="block p-4 h-full  cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150  ease-in-out"
               :class="payment_term === '5' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="payment_term" value="5" x-model="payment_term" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="payment_term === '5' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="payment_term === '5'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">5 лет</span>
            </div>
        </label>
        <label class="block p-4 h-full  cursor-pointer bg-white rounded-[24px] shadow-sm border border-gray-200 hover:border-yellow-400 hover:bg-[#FFFCEA] transition duration-150  ease-in-out"
               :class="payment_term === '6' ? 'border-yellow-400 bg-[#FFFCEA]' : 'border-gray-200'">
            <input type="radio" name="payment_term" value="6" x-model="payment_term" class="sr-only">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 rounded-full border flex items-center justify-center"
                     :class="payment_term === '6' ? 'border-yellow-400' : 'border-gray-400'">
                    <div x-show="payment_term === '6'" class="w-2 h-2 rounded-full bg-yellow-400"></div>
                </div>
                <span class="text-base text-gray-900 select-none">6 лет</span>
            </div>
        </label>
    </div>
</div>