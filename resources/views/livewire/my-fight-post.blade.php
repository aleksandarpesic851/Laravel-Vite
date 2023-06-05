<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                            <th scope="col" class="px-6 py-3">
                                {{__('Cancel')}}
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
                                    <td class="px-6 py-4 cursor-pointer" wire:click.stop="cancelFight({{$item['id']}})">
                                        {{ __("Cancel") }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @livewire('modal-fight-detail')

</div>
