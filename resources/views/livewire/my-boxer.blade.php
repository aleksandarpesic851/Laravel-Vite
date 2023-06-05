<div class="mt-10" x-data="">
    @if ($isSeparatePage)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Boxers') }}
            </h2>
        </x-slot>
    @else
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Boxers') }}
        </h2>
    @endif

    <div>
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg {{ $isSeparatePage ? 'p-5' : '' }}">
            <div class="relative overflow-x-auto shadow-md">
                @if($canEdit)
                    <form class="mt-5"  wire:submit.prevent="applyBoxer">
                        <!-- Boxer -->
                        <div>
                            <x-input-label for="boxer_id" :value="__('Boxers')" />
                            <x-simple-select       
                                wire:model.lazy="boxer_id"
                                name="boxer_id"
                                id="boxer_id"
                                :options="$allBoxers"
                                value-field='id'
                                text-field='name'
                                placeholder="Select Boxer"
                                search-input-placeholder="Search Boxer"
                                :searchable="true"                                               
                                class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"     
                            />
                            <x-input-error :messages="$errors->get('boxer_id')" class="mt-2" />
                        </div>
                        <!-- Apply -->
                        <div class="flex justify-end mt-6">
                            <x-danger-button>
                                {{ __('Apply') }}
                            </x-danger-button>
                        </div>
                    </form>
                @endif

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
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
                                {{__('Name')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Acceptance')}}
                            </th>
                            @if($canEdit)
                                <th scope="col" class="px-6 py-3">
                                    {{__('Cancel')}}
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($myBoxers))
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" colspan="{{ $canEdit ? 6 : 5 }}" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No Boxers
                                </th>
                            </tr>            
                        @else
                            @foreach ($myBoxers as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                    @click="window.open('/profile/{{$item['boxer_id']}}', '_blank').focus();">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{$item['boxer']['division_detail']['name']}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$item['boxer']['country_detail']['name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['boxer']['state_detail']['name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['boxer']['name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['active'] ? "Accepted" : "Invited"}}
                                    </td>
                                    @if ($canEdit)
                                        <td class="px-6 py-4 cursor-pointer" wire:click.stop="cancelBoxer({{$item['id']}})">
                                            {{ __("Cancel") }}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>