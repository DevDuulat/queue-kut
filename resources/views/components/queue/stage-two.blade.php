<div x-data="{
        first_name: '{{ old('first_name') }}',
        last_name: '{{ old('last_name') }}',
        number: '{{ old('number') }}',
        inn: '{{ old('inn') }}',
        issue_date: '{{ old('issue_date') }}',
        issued_by: '{{ old('issued_by') }}',
        document_number: '{{ old('document_number') }}',
    }">
<h3 class="text-lg font-semibold text-gray-900 mb-4">Личные данные</h3>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
    <div>
        <label for="first_name" class="sr-only">Имя</label>
        <input type="text" name="first_name"  x-model="first_name"  id="first_name" placeholder="Имя *" required class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-150" />
    </div>
    <div>
        <label for="last_name" class="sr-only">Фамилия</label>
        <input type="text" name="last_name"  x-model="last_name" id="last_name" placeholder="Фамилия *" required class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-150" />
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
    <div x-data="phoneMaskExtended()" x-init="setPhoneMask(selectedCountry.mask)">
        <label for="phone_number" class="text-base font-medium text-gray-900 mb-2 block">Номер телефона *</label>
        <div class="relative">
            <div x-data="{ open: false }" class="absolute inset-y-0 left-0 flex items-center pl-4 pr-1">
                <button type="button" @click="open = !open" @click.away="open = false" class="py-4 text-gray-500 font-medium pr-3 flex items-center transition duration-150 hover:text-gray-900 focus:outline-none">
                    <span x-text="selectedCountry.code"></span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-20 mt-2 w-max origin-top-left rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none top-full left-0">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <template x-for="country in countries" :key="country.id">
                            <a href="#" @click.prevent="selectCountry(country); open = false" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" :class="{'bg-gray-100': selectedCountry.id === country.id}">
                                <span x-text="country.name + ' (' + country.code + ')'"></span>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <input
                    type="tel"
                    name="phone_number"
                    id="phone_number"
                    :placeholder="selectedCountry.placeholder"
                    required
                    class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-150 pl-[105px]"
                    x-model="number"
                    @input="formatPhone"
                    x-ref="phoneNumberInput"
            />
            <input type="hidden" name="country_code" :value="selectedCountry.code">
        </div>
    </div>

    <div x-data="{
        open: false,
        selectedCuratorId: null,
        selectedCuratorName: 'Любой куратор',
        search: '',
        filteredCurators() {
            return this.search
                ? curators.filter(c => c.name.toLowerCase().includes(this.search.toLowerCase()))
                : curators;
        }
    }" class="relative max-w-sm">
        <label class="block text-base font-medium text-gray-900 mb-2">Куратор</label>
        <input type="hidden" name="curator_id" :value="selectedCuratorId">
        <div @click="open = !open" class="select-style block w-full rounded-[24px] bg-white p-4 cursor-pointer border border-gray-200">
            <span x-text="selectedCuratorName"></span>
        </div>

        <div x-show="open" x-transition @click.away="open = false" class="absolute z-10 w-full mt-1 bg-white rounded-[24px] shadow-lg p-2 border border-gray-200 max-h-60 overflow-y-auto">
            <input type="text" x-model="search" placeholder="Поиск куратора..." class="w-full mb-2 p-2 border border-gray-300 rounded-lg">
            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl cursor-pointer" @click="selectedCuratorId = null; selectedCuratorName = 'Любой куратор'; open = false">
                <label class="text-base text-gray-700 w-full">Любой куратор</label>
                <input type="radio" :checked="selectedCuratorId === null" class="h-5 w-5 text-yellow-500 border-gray-300 focus:ring-yellow-500">
            </div>
            <hr class="border-gray-100 mb-2">
            <template x-for="curator in filteredCurators()" :key="curator.id">
                <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl cursor-pointer" @click="selectedCuratorId = curator.id; selectedCuratorName = curator.name; open = false">
                    <label class="text-base text-gray-700 w-full" x-text="curator.name"></label>
                    <input type="radio" :checked="selectedCuratorId === curator.id" class="h-5 w-5 text-yellow-500 border-gray-300 focus:ring-yellow-500">
                </div>
            </template>
        </div>
    </div>

    <script>
        const curators = @json($curators); // Assuming this is defined elsewhere
    </script>
</div>

<h3 class="text-lg font-semibold text-gray-900 mb-4">Паспортные данные</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
    <div>
        <label for="inn" class="sr-only">ИНН</label>
        <input type="text" x-model="inn" name="inn" id="inn" placeholder="ИНН *" maxlength="14" required class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
    </div>

    <div x-data="{ swapped: false }">
        <input type="hidden" name="document_series" x-bind:value="swapped ? 'AN' : 'ID'">

        <div class="relative">
            <button type="button" class="absolute inset-y-0 left-0 flex items-center pl-4 pr-3" @click="swapped = !swapped">
                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 16L4.6 14.575L7.175 12H0V10H7.175L4.6 7.425L6 6L11 11L6 16ZM14 10L9 5L14 0L15.4 1.425L12.825 4H20V6H12.825L15.4 8.575L14 10Z" fill="#999999"/>
                </svg>
                <span class="ml-1 text-black" x-text="swapped ? 'AN' : 'ID'"></span>
            </button>

            <input type="text" name="document_number" x-model="document_number" placeholder="Номер документа *" required maxlength="7" class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-150 pl-[90px]">
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12">
    <div>
        <label for="issued_by" class="sr-only">Кем выдан</label>
        <input type="text" name="issued_by" x-ref="issued_by" x-model="issued_by" id="issued_by" placeholder="Кем выдан *" required class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-150" />
    </div>

    <div id="stage-1">
        <div x-data x-init="
            flatpickr($refs.issueDate, {
                dateFormat: 'd.m.Y',
                locale: 'ru',
                allowInput: true,
                clickOpens: true
            })
        ">
            <label for="issue_date" class="sr-only">Дата выдачи</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 20C1.45 20 0.979167 19.8042 0.5875 19.4125C0.195833 19.0208 0 18.55 0 18V4C0 3.45 0.195833 2.97917 0.5875 2.5875C0.979167 2.19583 1.45 2 2 2H3V0H5V2H13V0H15V2H16C16.55 2 17.0208 2.19583 17.4125 2.5875C17.8042 2.97917 18 3.45 18 4V18C18 18.55 17.8042 19.0208 17.4125 19.4125C17.0208 19.8042 16.55 20 16 20H2ZM2 18H16V8H2V18ZM2 6H16V4H2V6Z" fill="#252525"/>
                    </svg>
                </span>
                <input
                        type="text"
                        name="issue_date"
                        x-ref="issueDate"
                        required
                        x-model="issue_date"
                        placeholder="Дата выдачи *"
                        class="datepicker input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 pl-[70px] focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                />
            </div>
        </div>
    </div>
</div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>

<script>
    function phoneMask() {
        return {
            number: '',
            formatPhone(e) {
                const x = e.target.value.replace(/\D/g, '').slice(0, 9);
                if (x.length > 5) {
                    this.number = `(${x.slice(0, 3)}) ${x.slice(3, 6)} - ${x.slice(6, 9)}`;
                } else if (x.length > 3) {
                    this.number = `(${x.slice(0, 3)}) ${x.slice(3)}`;
                } else {
                    this.number = x;
                }
            }
        }
    }

    function phoneMaskExtended() {
        return {
            number: '',
            countries: [
                { id: 'kg', name: 'Кыргызстан', code: '+996', mask: '(###) ### - ###', placeholder: '(700) 000 - 000', maxlen: 9 },
                { id: 'ru', name: 'Россия', code: '+7', mask: '(###) ### - ## - ##', placeholder: '(900) 000 - 00 - 00', maxlen: 10 },
            ],
            selectedCountry: { id: 'kg', name: 'Кыргызстан', code: '+996', mask: '(###) ### - ###', placeholder: '(700) 000 - 000', maxlen: 9 },
            currentMask: '(###) ### - ###',

            setPhoneMask(mask) {
                this.currentMask = mask;
            },

            selectCountry(country) {
                this.selectedCountry = country;
                this.currentMask = country.mask;
                this.number = '';
                this.$refs.phoneNumberInput.focus();
            },

            formatPhone(e) {
                const input = e.target;
                const cleaned = input.value.replace(/\D/g, '').slice(0, this.selectedCountry.maxlen);
                let formatted = '';
                let cleanedIndex = 0;
                const mask = this.currentMask;

                for (let i = 0; i < mask.length; i++) {
                    const maskChar = mask[i];

                    if (cleanedIndex >= cleaned.length) {
                        break;
                    }

                    if (maskChar === '#') {
                        formatted += cleaned[cleanedIndex];
                        cleanedIndex++;
                    } else {
                        formatted += maskChar;
                    }
                }

                this.number = formatted;
            }
        }
    }


    function validateStep(step) {
        const stage = document.querySelector(`#stage-${step}`);
        if (!stage) return true;
        const inputs = stage.querySelectorAll('input[required], select[required], textarea[required]');
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