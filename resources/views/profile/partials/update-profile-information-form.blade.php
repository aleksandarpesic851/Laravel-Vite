<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="flex">
        <div class="flex-none">
            @livewire('profile-avatar', ['id' => $user->id])
        </div>
        <div class="flex-1 ml-5">
            {{-- WLD --}}
            @if($user->hasRole('Boxer'))
                <div class="text-center">
                    @if ($WLD['win'] > 0)
                        <span class="px-5 py-2 bg-green-500"> {{ $WLD['win'] }}W </span>
                    @endif
                    @if ($WLD['loos'] > 0)
                        <span class="px-5 py-2 bg-red-500"> {{ $WLD['loos'] }}L </span>
                    @endif
                    @if ($WLD['draw'] > 0)
                        <span class="px-5 py-2 bg-cyan-500"> {{ $WLD['draw'] }}D </span>
                    @endif
                    @if ($WLD['win_ko'] > 0)
                        <span class="ml-1 px-5 py-2 bg-green-500"> {{ $WLD['win_ko'] }}KO </span>
                    @endif
                    @if ($WLD['loos_ko'] > 0)
                        <span class="px-5 py-2 bg-red-500"> {{ $WLD['loos_ko'] }}KO </span>
                    @endif
                </div>
            @endif

            <form wire:submit.prevent="updateProfile">
                @csrf
                @method('patch')
                <div class="grid grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model.lazy="name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <!-- Home Town -->
                    <div>
                        <x-input-label for="home_town" :value="__('Home Town')" />
                        <x-text-input id="home_town" class="block mt-1 w-full" type="text" name="home_town" wire:model.lazy="home_town" required autocomplete="home_town" />
                        <x-input-error :messages="$errors->get('home_town')" class="mt-2" />
                    </div>
                    
                    @if($user->hasRole('Boxer'))
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
                            <x-input-error :messages="$errors->get('division')" class="mt-2" />
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
                            <x-input-error :messages="$errors->get('round')" class="mt-2" />
                        </div>
                        <!-- Passport -->
                        <div class="mt-4 flex">
                            <div>
                                <label for="passport" class="inline-flex items-center">
                                    <input id="passport" type="checkbox" 
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                        name="passport" wire:model.lazy="passport">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Passport') }}</span>
                                </label>
                                <x-input-error :messages="$errors->get('passport')" class="mt-2" />
                            </div>
                            <!-- US Visa -->
                            <div class="ml-3">
                                <label for="visa" class="inline-flex items-center">
                                    <input id="visa" type="checkbox" 
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                        name="visa" wire:model.lazy="visa">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('US Visa') }}</span>
                                </label>
                                <x-input-error :messages="$errors->get('visa')" class="mt-2" />
                            </div>
                        </div>

                        <!-- BoxRec ID -->
                        <div class="mt-4">
                            <x-input-label for="boxrec_id" :value="__('Boxrec ID')" />
                            <x-text-input id="boxrec_id" class="block mt-1 w-full" type="text" name="boxrec_id" wire:model.lazy="boxrec_id" required autocomplete="boxrec_id" />
                            <x-input-error :messages="$errors->get('boxrec_id')" class="mt-2" />
                        </div>

                        <!-- BoxRec Profile Link -->
                        <div class="mt-4">
                            <a class="text-blue-500 text-lg" href="https://boxrec.com/en/box-pro/{{$boxrec_id}}"> Boxrec Profile </a>
                        </div>

                        
                        <!-- My Manager -->
                        <p class="mt-4">
                            <strong class="font-medium text-gray-500">My Manager:</strong>
                            @if (empty($myManager))
                                <span class="font-medium text-gray-300"> {{ __('Not Hired') }}</span>
                            @else
                                <a class="font-medium text-blue-500 text-lg" href="/profile/{{$myManager['id']}}">
                                    {{ $myManager['name'] }}
                                </a>
                            @endif
                        </p>

                    @elseif($user->hasRole('MatchMaker'))
                        <!-- MatchMaker at -->
                        <div class="mt-4">
                            <x-input-label for="matchmaker_at" :value="__('Match Maker At')" />
                            <x-text-input id="matchmaker_at" class="block mt-1 w-full" type="text" name="matchmaker_at" wire:model.lazy="matchmaker_at" required autocomplete="matchmaker_at" />
                            <x-input-error :messages="$errors->get('matchmaker_at')" class="mt-2" />
                        </div>
                    @elseif($user->hasRole('Manager'))
                        <!-- Manager Company -->
                        <div class="mt-4">
                            <x-input-label for="company" :value="__('Management Company')" />
                            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" wire:model.lazy="company" required autocomplete="company" />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>
                    @elseif($user->hasRole('Promoter'))
                        <!-- Promoter Company -->
                        <div class="mt-4">
                            <x-input-label for="company" :value="__('Promoter Company')" />
                            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" wire:model.lazy="company" required autocomplete="company" />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>
                    @endif
                </div>

                <div class="flex float-right mt-4">
                    <x-danger-button>{{ __('Save') }}</x-danger-button>
                </div>
            </form>
            @if(!$user->hasRole('Boxer'))            
                @livewire('my-boxer', ['editable' => false, 'separatable' => false])
            @endif

            @if($user->hasRole('MatchMaker'))
                @include('profile.partials.recent-posts', ['fights' => $myPosts])
            @elseif($user->hasRole('Manager'))
            @elseif($user->hasRole('Promoter'))
                @livewire('my-boxing-show', ['separatable' => false])
            @endif
        </div>
    </div>
</section>
