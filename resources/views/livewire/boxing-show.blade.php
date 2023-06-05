<div>
    {{-- Create new Boxing Show --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-5 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Post Boxing Show') }}
            </h3>
    
            <form wire:submit.prevent="createBoxingShow">
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
                    
                    <!-- Slots -->
                    <div class="mt-4">
                        <x-input-label for="slot" :value="__('Slots Available')" />
                        <x-simple-select       
                            wire:model.lazy="slot"
                            name="slot"
                            id="slot"
                            :options="$slots"
                            placeholder="Select Slot"
                            class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        />
                    </div>
                    
                    <!-- Event Name -->
                    <div class="mt-4">
                        <x-input-label for="event_name" :value="__('Event')" />
                        <x-text-input id="event_name" class="block mt-1 w-full" type="text" name="event_name" wire:model.lazy="event_name" required autocomplete="event_name" />
                        <x-input-error :messages="$errors->get('event_name')" class="mt-2" />
                    </div>

                    <!-- Link -->
                    <div class="mt-4">
                        <x-input-label for="link" :value="__('Stream/TV/App Link')" />
                        <x-text-input id="link" class="block mt-1 w-full" type="text" name="link" wire:model.lazy="link" required autocomplete="link" />
                        <x-input-error :messages="$errors->get('link')" class="mt-2" />
                    </div>

                    <!-- Date -->
                    <div class="mt-4">
                        <x-input-label for="post_date" :value="__('Date')" />
                        <x-datepicker id="post_date" class="block mt-1 w-full" name="post_date" wire:model.lazy="post_date" required autocomplete="post_date" />
                        <x-input-error :messages="$errors->get('post_date')" class="mt-2" />
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

    {{-- All boxing shows --}}
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Boxing Shows') }}
            </h3>
    
            <div class="relative overflow-x-auto shadow-md mt-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__('Country')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('State')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Slots')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Event Name')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Stream/TV/App Link')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Date')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Creater')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($boxingShows))
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" colspan="7" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No Data
                                </th>
                            </tr>            
                        @else
                            @foreach ($boxingShows as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{$item['country_detail']['name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['state_detail']['name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['slots']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['event_name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['link']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['date']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['creater_detail']['name']}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
    
        </div>
    </div>
</div>
