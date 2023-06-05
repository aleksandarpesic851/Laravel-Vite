<div class="pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post Fight') }}
        </h3>

        <form wire:submit.prevent="createFight">
            @csrf
            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-4 ">
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
                
                <!-- Date -->
                <div class="mt-4">
                    <x-input-label for="post_date" :value="__('Date')" />
                    <x-datepicker id="post_date" class="block mt-1 w-full" name="post_date" wire:model.lazy="post_date" required autocomplete="post_date" />
                    <x-input-error :messages="$errors->get('post_date')" class="mt-2" />
                </div>
                
                <!-- Oponent -->
                <div class="mt-4">
                    <x-input-label for="oponent" :value="__('Oponent')" />
                    <x-text-input id="oponent" class="block mt-1 w-full" type="text" name="oponent" wire:model.lazy="oponent" required autocomplete="oponent" />
                    <x-input-error :messages="$errors->get('oponent')" class="mt-2" />
                </div>

                <!-- Passport Visa -->
                <div class="mt-4">
                    <!-- Passport -->
                    <label for="post_passport" class="inline-flex items-center">
                        <input id="post_passport" type="checkbox" 
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="passport" wire:model.lazy="passport">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Passport') }}</span>
                    </label>

                    <!-- US Visa -->
                    <label for="post_visa" class="ml-5 inline-flex items-center">
                        <input id="post_visa" type="checkbox" 
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="visa" wire:model.lazy="visa">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('US Visa') }}</span>
                    </label>
                </div>

                <!-- Notes -->
                <div class="mt-4 col-span-full">
                    <x-input-label for="notes" :value="__('Notes')" />
                    <x-text-area id="notes" class="block mt-1 w-full" rows="7" name="notes" wire:model.lazy="notes" required autocomplete="notes" />
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                <div class="mt-4 col-span-full">
                    <div class="flex items-center justify-end">
                        <x-danger-button class="ml-4">
                            {{ __('Post') }}
                        </x-danger-button>
                    </div> 
                </div>
            </div>
        </form>
    </div>
</div>