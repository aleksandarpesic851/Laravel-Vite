<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search Fights') }}
        </h3>

        <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4 ">
            <!-- Country -->
            <div class="mt-4">
                <x-input-label for="country" :value="__('Country')" />
                <x-simple-select       
                    wire:model.lazy="country"
                    name="country"
                    id="country"
                    :options="$countries"
                    value-field='id'
                    text-field='name'
                    placeholder="Select Country"
                    search-input-placeholder="Search Country"
                    :searchable="true"                                               
                    class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"     
                />
            </div>

            <!-- State -->
            <div class="mt-4">
                <x-input-label for="state" :value="__('State')" />
                <x-simple-select       
                    wire:model.lazy="state"
                    name="state"
                    id="state"
                    :options="$states"
                    value-field='id'
                    text-field='name'
                    placeholder="Select State"
                    search-input-placeholder="Search State"
                    :searchable="true"                       
                    class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                />
            </div>
            
            <!-- Division -->
            <div class="mt-4">
                <x-input-label for="division" :value="__('Division')" />
                <x-simple-select       
                    wire:model.lazy="division"
                    name="division"
                    id="division"
                    :options="$divisions"
                    value-field='id'
                    text-field='name'
                    placeholder="Select Division"
                    :searchable="false"                                               
                    class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                />
            </div>
            <!-- Rounds -->
            <div class="mt-4">
                <x-input-label for="round" :value="__('Round')" />
                <x-simple-select       
                    wire:model.lazy="round"
                    name="round"
                    id="round"
                    :options="$rounds"
                    :searchable="false"                                               
                    placeholder="Select Round"
                    class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                />
            </div>

            <div class="mt-4">
                <!-- Passport -->
                <label for="passport" class="inline-flex items-center">
                    <input id="passport" type="checkbox" 
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="passport" wire:model.lazy="passport">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Passport') }}</span>
                </label>

                <!-- US Visa -->
                <label for="visa" class="ml-5 inline-flex items-center">
                    <input id="visa" type="checkbox" 
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="visa" wire:model.lazy="visa">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('US Visa') }}</span>
                </label>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md mt-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{__('Division')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Country')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('State')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Oponent')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Date')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($fights))
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" colspan="5" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                No Data
                            </th>
                        </tr>            
                    @else
                        @foreach ($fights as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                wire:click="showModal({{$item['id']}})">
                                {{-- @click="Livewire.emit('modal:fight-detail', {{$item['id']}})"> --}}
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{$item['division_detail']['name']}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$item['country_detail']['name']}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item['state_detail']['name']}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item['oponent']}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item['date']}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>

    @livewire('modal-fight-detail')

</div>