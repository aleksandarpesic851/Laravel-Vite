<div>
    <form wire:submit.prevent="register">
        <!-- Account Type -->
        <div class="mt-4">
            <x-input-label for="name" class="" :value="__('Register As')" />
            <x-simple-select       
                wire:model.lazy="account_type"
                name="account_type"
                id="account_type"
                :options="$account_types"
                placeholder="Register As"
                :searchable="false"                                               
                class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-100 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"     
            />
            <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full dark:bg-gray-100" type="text" name="name" wire:model.lazy="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <x-simple-select       
                wire:model.lazy="gender"
                name="gender"
                id="gender"
                :options="$genders"
                :searchable="false"                                               
                class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-100 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"     
            />
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

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
                class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-100 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"     
            />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
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
                class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-100 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            />
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>
        
        @if($account_type == 'Boxer')
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
                    class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-100 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
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
                    class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-100 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                />
                <x-input-error :messages="$errors->get('round')" class="mt-2" />
            </div>
        @else
            <!-- Company -->
            <div class="mt-4">
                <x-input-label for="company" :value="__('Company')" />
                <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" wire:model.lazy="company" required autocomplete="company" />
                <x-input-error :messages="$errors->get('company')" class="mt-2" />
            </div>
        @endif
        
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full dark:bg-gray-100" type="email" name="email" wire:model.lazy="email" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full dark:bg-gray-100" type="text" name="phone" wire:model.lazy="phone" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        @if($account_type == 'Boxer')
            <!-- Passport -->
            <div class="mt-4">
                <label for="passport" class="inline-flex items-center">
                    <input id="passport" type="checkbox" 
                        class="rounded dark:bg-gray-100 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="passport" wire:model.lazy="passport">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Passport') }}</span>
                </label>
                <x-input-error :messages="$errors->get('passport')" class="mt-2" />
            </div>
            
            <!-- US Visa -->
            <div class="mt-4">
                <label for="visa" class="inline-flex items-center">
                    <input id="visa" type="checkbox" 
                        class="rounded dark:bg-gray-100 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="visa" wire:model.lazy="visa">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('US Visa') }}</span>
                </label>
                <x-input-error :messages="$errors->get('visa')" class="mt-2" />
            </div>

            <!-- BoxRec ID -->
            <div class="mt-4">
                <x-input-label for="boxrec_id" :value="__('Boxrec ID')" />
                <x-text-input id="boxrec_id" class="block mt-1 w-full dark:bg-gray-100" type="text" name="boxrec_id" wire:model.lazy="boxrec_id" required autocomplete="company" />
                <x-input-error :messages="$errors->get('boxrec_id')" class="mt-2" />
            </div>
        @endif

        <!-- Language -->
        <div class="mt-4">
            <x-input-label for="language" :value="__('Language')" />
            <x-simple-select       
                wire:model.lazy="language"
                name="language"
                id="language"
                :options="$languages"
                :searchable="false"                                               
                placeholder="Select Language"
                class="py-1 block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-100 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            />
            <x-input-error :messages="$errors->get('language')" class="mt-2" />
        </div>

        <!-- BoxRec ID -->
        <div class="mt-4">
            <x-input-label for="home_town" :value="__('Home Town')" />
            <x-text-input id="home_town" class="block mt-1 w-full dark:bg-gray-100" type="text" name="home_town" wire:model.lazy="home_town" required autocomplete="home_town" />
            <x-input-error :messages="$errors->get('home_town')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full dark:bg-gray-100"
                            type="password"
                            name="password"
                            wire:model.lazy="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full dark:bg-gray-100"
                            type="password"
                            name="password_confirmation"
                            wire:model.lazy="password_confirmation"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-danger-button class="ml-4">
                {{ __('Register') }}
            </x-danger-button>
        </div> 
         
    </form>

</div>
