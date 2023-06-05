<div class="mt-10" x-data="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Clients') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">
            <div class="relative overflow-x-auto">
                <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('My MatchMakers') }}
                </h3>   
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__('Name')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Country')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('State')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Company')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Apply')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($matchMakers))
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" colspan="5" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No Match Makers
                                </th>
                            </tr>            
                        @else
                            @foreach ($matchMakers as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                    @click="window.open('/profile/{{$item['id']}}', '_blank').focus();">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{$item['name']}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$item['country_detail']['name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['state_detail']['name']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['company']}}
                                    </td>
                                    @if ($item['myBoxer']['active'])
                                        <td class="px-6 py-4 text-blue-500">
                                            {{ __("Applied") }}
                                        </td>
                                    @else
                                        <td class="px-6 py-4 text-red-500 cursor-pointer" wire:click.stop="applyBoxer({{ $item['myBoxer']['id'] }})">
                                            {{ __("Apply") }}
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