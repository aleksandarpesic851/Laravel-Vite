<div class="mt-10" x-data="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Contracts') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">
            <div class="relative overflow-x-auto shadow-md">
                @cannot('boxer')
                    <form class="mt-5"  wire:submit.prevent="saveDocument" >
                        <!-- Boxer -->
                        <div>
                            <x-input-label for="receiver_id" :value="__('Boxers')" />
                            <x-simple-select       
                                wire:model.lazy="receiver_id"
                                name="receiver_id"
                                id="receiver_id"
                                :options="$allBoxers"
                                value-field='id'
                                text-field='name'
                                placeholder="Select Boxer"
                                search-input-placeholder="Search Boxer"
                                :searchable="true"                                               
                                class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"     
                            />
                            <x-input-error :messages="$errors->get('receiver_id')" class="mt-2" />
                        </div>

                        {{-- Document --}}
                        <div class="mt-3">
                            <x-input-label for="document" :value="__('Document')"/>
                            <input
                                type="file"     
                                wire:model.lazy="document"
                                name="document"
                                id="document"
                                placeholder="Select Document"
                                class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-gray-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-gray-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-100 file:px-3 file:py-[0.32rem] file:text-gray-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-200 focus:border-primary focus:text-gray-700 focus:shadow-te-primary focus:outline-none dark:border-gray-600 dark:text-gray-200 dark:file:bg-gray-700 dark:file:text-gray-100 dark:focus:border-primary"
                                wire:loading.attr="disabled"
                                wire:target = ""
                            />
                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>

                        <!-- Apply -->
                        <div class="flex justify-end mt-6">
                            @if (!empty($document) && !empty($receiver_id))
                                <x-danger-button>
                                    {{ __('Post') }}
                                </x-danger-button>
                            @endif
                        </div>
                    </form>
                @endcan
                
                <p class="text-2x1 text-white mt-10">My Contracts</p>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            @can('boxer')
                                <th scope="col" class="px-6 py-3">
                                    {{__('Client')}}
                                </th>
                            @else
                                <th scope="col" class="px-6 py-3">
                                    {{__('Boxer')}}
                                </th>
                            @endcan
                            <th scope="col" class="px-6 py-3">
                                {{__('Origin Document')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__('Signed Document')}}
                            </th>
                            @can('boxer')
                                <th scope="col" class="px-6 py-3">
                                    {{__('Action')}}
                                </th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($documentList))
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                @can('boxer')
                                    <th scope="row" colspan="4" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        No Documents
                                    </th>
                                @else
                                    <th scope="row" colspan="3" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        No Documents
                                    </th>
                                @endcan
                            </tr>            
                        @else
                            @foreach ($documentList as $item)
                                <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    @can('boxer')
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap hover:bg-gray-50 dark:hover:bg-gray-600"
                                            @click="window.open('/profile/{{$item->sender_id}}', '_blank').focus();">
                                            {{$item->sender->name}}
                                        </th>
                                    @else
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap hover:bg-gray-50 dark:hover:bg-gray-600"
                                            @click="window.open('/profile/{{$item->receiver_id}}', '_blank').focus();">
                                            {{$item->receiver->name}}
                                        </th>
                                    @endcan
                                    <td class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        @click="window.open('{{$item->documentRealPath()}}', '_blank').focus();">
                                        {{ __("Link to the document") }}
                                    </td>
                                    @if (empty($item->signed_path))
                                        <td class="px-6 py-4">
                                            {{ __("Not signed yet") }}
                                        </td>
                                        @can('boxer')
                                            <td class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-600"
                                                wire:click.stop="showSignatureModal({{$item->id}})">
                                                {{ __("Sign") }}
                                            </td>
                                        @endcan
                                    @else
                                        <td class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-600"
                                            @click="window.open('{{$item->signedRealPath()}}', '_blank').focus();">
                                            {{ __("Link to the signed document") }}
                                        </td>
                                        @can('boxer')
                                            <td class="px-6 py-4"></td>
                                        @endcan
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('components.modal-signature')
</div>