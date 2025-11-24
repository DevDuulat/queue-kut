<h3 class="text-lg font-semibold text-gray-900 mb-4">Личные данные</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">


    <div>
        <label for="first_name" class="sr-only">Имя</label>
        <input type="text" name="first_name" id="first_name" placeholder="Имя" class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150" />
    </div>

    <div>
        <label for="last_name" class="sr-only">Фамилия</label>
        <input type="text" name="last_name" id="last_name" placeholder="Фамилия" class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150" />
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">

    <div x-data="phoneMask()">
        <label for="phone_number" class="text-base font-medium text-gray-900 mb-2 block">Номер телефона</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium pr-3 pointer-events-none">
                <span class="py-4">+996</span>
            </span>
            <input
                    type="tel"
                    name="phone_number"
                    id="phone_number"
                    placeholder="(700) 000 - 000"
                    class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150 pl-[70px]"
                    x-model="number"
                    @input="formatPhone"
            />
        </div>
    </div>
    <div x-data="{ open: false, selectedCurator: 'Любой куратор' }" class="relative max-w-sm">
        <label for="curator-select" class="text-base font-medium text-gray-900 mb-2 block">Выберите куратора</label>

        <div @click="open = !open" id="curator-select"
             class="select-style block w-full rounded-[24px] bg-white p-4 text-gray-700 focus:border-yellow-400 transition duration-150 appearance-none cursor-pointer">
            <span x-text="selectedCurator">Любой куратор</span>
        </div>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700" style="top: 34px;">
            <svg class="h-5 w-5 transition duration-150 transform"
                 :class="{ 'rotate-180': open }"
                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>

        <div x-show="open" @click.away="open = false"
             class="absolute z-10 w-full mt-1 bg-white rounded-[24px] shadow-lg p-2 space-y-1 border border-gray-200">

            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl cursor-pointer"
                 @click="selectedCurator = 'Любой куратор'; open = false">
                <label for="any_curator_radio" class="text-base text-gray-700 cursor-pointer w-full">Любой куратор</label>
                <input id="any_curator_radio" name="curator_radio" type="radio" checked
                       class="h-5 w-5 text-yellow-500 border-gray-300 focus:ring-yellow-500" value="any">
            </div>

            <hr class="border-gray-100">

            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl cursor-pointer"
                 @click="selectedCurator = 'Асан Асанов'; open = false">
                <label for="asan" class="text-base text-gray-700 cursor-pointer w-full">Асан Асанов</label>
                <input id="asan" name="curator_radio" type="radio"
                       class="h-5 w-5 text-yellow-500 border-gray-300 focus:ring-yellow-500" value="asan">
            </div>

            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl cursor-pointer"
                 @click="selectedCurator = 'Иван Иванов'; open = false">
                <label for="ivan" class="text-base text-gray-700 cursor-pointer w-full">Иван Иванов</label>
                <input id="ivan" name="curator_radio" type="radio"
                       class="h-5 w-5 text-yellow-500 border-gray-300 focus:ring-yellow-500" value="ivan">
            </div>

            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl cursor-pointer"
                 @click="selectedCurator = 'Үсөн Үсөнов'; open = false">
                <label for="usen" class="text-base text-gray-700 cursor-pointer w-full">Үсөн Үсөнов</label>
                <input id="usen" name="curator_radio" type="radio"
                       class="h-5 w-5 text-yellow-500 border-gray-300 focus:ring-yellow-500" value="usen">
            </div>

            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl cursor-pointer"
                 @click="selectedCurator = 'Баланчаев Баланча'; open = false">
                <label for="balancha" class="text-base text-gray-700 cursor-pointer w-full">Баланчаев Баланча</label>
                <input id="balancha" name="curator_radio" type="radio"
                       class="h-5 w-5 text-yellow-500 border-gray-300 focus:ring-yellow-500" value="balancha">
            </div>
        </div>
    </div>
</div>

<h3 class="text-lg font-semibold text-gray-900 mb-4">Паспортные данные</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

    <div>
        <label for="inn" class="sr-only">ИНН</label>
        <input type="text" name="inn" id="inn" placeholder="ИНН" class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150" />
    </div>

    <div>
        <label for="document_number" class="sr-only">Номер документа</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium pr-3 pointer-events-none">
              <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 16L4.6 14.575L7.175 12H0V10H7.175L4.6 7.425L6 6L11 11L6 16ZM14 10L9 5L14 0L15.4 1.425L12.825 4H20V6H12.825L15.4 8.575L14 10Z" fill="#999999"/>
                </svg>
                <span class="ml-1 text-black">ID</span>
            </span>
            <input type="text" name="document_number" id="document_number" placeholder="Номер документа" class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150 pl-[90px]" />
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12">

    <div>
        <label for="issued_by" class="sr-only">Кем выдан</label>
        <input type="text" name="issued_by" id="issued_by" placeholder="Кем выдан" class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150" />
    </div>

    <div>
        <label for="issue_date" class="sr-only">Дата выдачи</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium pr-3 pointer-events-none">
        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 20C1.45 20 0.979167 19.8042 0.5875 19.4125C0.195833 19.0208 0 18.55 0 18V4C0 3.45 0.195833 2.97917 0.5875 2.5875C0.979167 2.19583 1.45 2 2 2H3V0H5V2H13V0H15V2H16C16.55 2 17.0208 2.19583 17.4125 2.5875C17.8042 2.97917 18 3.45 18 4V18C18 18.55 17.8042 19.0208 17.4125 19.4125C17.0208 19.8042 16.55 20 16 20H2ZM2 18H16V8H2V18ZM2 6H16V4H2V6Z" fill="#252525"/>
            </svg>

            </span>
            <input type="text" name="issue_date" id="issue_date" placeholder="Дата выдачи" class="input-style block w-full rounded-[24px] bg-white p-4 placeholder-gray-400 focus:border-yellow-400 transition duration-150 pl-[70px]" />
        </div>
    </div>
</div>