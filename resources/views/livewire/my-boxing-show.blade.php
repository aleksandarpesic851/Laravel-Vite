<div class="mt-10"  x-data="">
    @if ($isSeparatePage)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Boxing Shows') }}
            </h2>
        </x-slot>
    @else
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Boxing Shows') }}
        </h2>
    @endif

    {{-- My boxing shows --}}
    <div class="pb-12">
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg {{ $isSeparatePage ? 'p-5' : '' }}">
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
                            @if($isSeparatePage)
                                <th scope="col" class="px-6 py-3">
                                    {{__('Cancel')}}
                                </th>
                            @endif
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
                                    @if ($isSeparatePage)
                                        <td class="px-6 py-4 cursor-pointer" wire:click.stop="cancelBoxingShow({{$item['id']}})">
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
