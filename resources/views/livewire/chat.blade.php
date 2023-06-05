<div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <!-- Chatting -->
    <div class="flex flex-row justify-between">
        <!-- chat list -->
        <div class="flex flex-col w-1/4">
            <!-- search compt -->
            <div class="py-4 px-6  border-gray-500" style="border-bottom-width: 1px">
                <x-text-input id="search" class="block w-full" type="text" name="search" 
                wire:model.lazy="search" placeholder="Search Users"/>
            </div>
            <!-- end search compt -->
            <!-- user list -->
            <div class="overflow-y-auto"  style="height: calc(100vh - 140px)" x-cloak
                x-data="{
                    value: @entangle('selectedUser')
                }">
                @foreach ($users as $item)
                    <div class="cursor-pointer flex flex-row py-4 px-2 justify-center items-center border-gray-500 border-l-indigo-600" :class = " ({{ $item->id }} == value) ? 'border-l-4' : ''"
                        style="border-bottom-width: 1px" @click="value={{$item->id}};">
                        <div class="w-2/5">
                            <img src="{{ $item->avatar() }}" class="object-cover h-12 w-12 rounded-full" alt="" />
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold text-gray-300">{{ $item->name }}</div>
                            {{-- <span class="text-gray-300">Pick me at 9:00 Am</span> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- end user list -->
        </div>
        <!-- end chat list -->
        <!-- message -->
        <div class="w-full px-5 flex flex-col justify-between border-gray-500" style="border-left-width: 1px;">
            <div class="flex flex-col mt-5 border-b-1 overflow-y-auto border-gray-500" style="border-bottom-width: 1px; height: calc(100vh - 175px)">
                @foreach ($chatLists as $item)
                    @if($item->isSent())
                        <div class="flex justify-end mb-4">
                            <div class="mr-2 py-3 px-4 bg-gray-700 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                {{$item->message}}
                            </div>
                            <img src="{{$item->sender->avatar()}}" class="object-cover h-8 w-8 rounded-full"/>
                        </div>
                    @else
                        <div class="flex justify-start mb-4">
                            <img src="{{$item->sender->avatar()}}" class="object-cover h-8 w-8 rounded-full"
                                alt="" />
                            <div class="ml-2 py-3 px-4 bg-gray-700 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                {{$item->message}}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <form wire:submit.prevent="sendMessage" class="py-5 flex flex-row">
                <x-text-input id="message" rows=1 class="px-2 py-3 resize-none block w-full" type="text" name="message"
                wire:model.lazy="message" placeholder="Send Message"/>
                <select wire:model="outputLanguage" id="language-select" name="language-select" rows=1 class="px-2 py-3 bg-gray-50 text-gray-900 text-sm rounded-md focus:ring-blue- block dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($languages as $code => $language)
                        <option value="{{ $code }}">{{ $language }}</option>
                    @endforeach
                </select>
                <x-danger-button class="ml-4 px-5 py-2">
                    {{ __('send') }}
                </x-danger-button>
            </form>
        </div>
    </div>
</div>