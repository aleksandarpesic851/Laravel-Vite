<div>
    <div class="px-12 py-5">
        <h2 class="text-gray-300 text-2xl font-semibold">Reviews</h2>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{__('No')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{__('Review')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{__('Rating')}}
                    </th>
                </tr>
            </thead>
            <tbody>
                @if(empty($reviews))
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" colspan="5" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            No Reviews
                        </th>
                    </tr>            
                @else
                    @foreach ($reviews as $review)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            {{-- @click="Livewire.emit('modal:fight-detail', {{$item['id']}})"> --}}
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{$loop->iteration}}
                            </th>
                            <td class="px-6 py-4">
                                {{$review['review']}}
                            </td>
                            <td class="px-6 py-4">
                                <x-rating-mark :rating="$review['mark']"/>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="px-12 py-5">
        <h2 class="text-gray-300 text-2xl font-semibold">Rating</h2>
    </div>
    <x-rating-mark wire:model.lazy="rating"/>
</div>