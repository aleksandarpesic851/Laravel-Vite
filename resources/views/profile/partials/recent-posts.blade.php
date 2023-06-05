<div class="mt-10">
    
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Recent Posts') }}
    </h2>

    <div class="mt-3">
        <div class="mx-auto bg-white dark:bg-gray-800">
            <div class="relative overflow-x-auto shadow-md">
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
                                    wire:click="showFightDetailModal({{$item['id']}})">
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
    </div>
</div>

@livewire('modal-fight-detail')