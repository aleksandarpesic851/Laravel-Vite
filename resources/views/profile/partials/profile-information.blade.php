<section>
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

            <div class="grid grid-cols-2 gap-4 text-gray-300">
                <!-- Name -->
                <p>
                    <strong class="font-medium text-gray-500">Name:</strong>
                    {{ $name }}
                </p>
                
                <!-- Home Town -->
                <p>
                    <strong class="font-medium text-gray-500">Home Town:</strong>
                    {{ $home_town }}
                </p>

                @if($user->hasRole('Boxer'))
                    <!-- Division -->
                    <p class="mt-4">
                        <strong class="font-medium text-gray-500">Division:</strong>
                        {{ $user->divisionDetail->name }}weight
                    </p>
                    
                    <!-- Rounds -->
                    <p class="mt-4">
                        <strong class="font-medium text-gray-500">Round:</strong>
                        {{ $round }}
                    </p>

                    <p class="mt-4">
                        <!-- Passport -->
                        <strong class="font-medium text-gray-500">Passport:</strong>
                        {{ $passport ? "Yes" : "No" }}
                        &ensp;
                        <strong class="font-medium text-gray-500">US Visa:</strong>
                        {{ $visa ? "Yes" : "No" }}
                    </p>

                    <p class="mt-4"></p>

                    <!-- Boxrec Profile -->
                    <p class="mt-4">
                        <a class="font-medium text-blue-500 text-lg" href="https://boxrec.com/en/box-pro/{{$boxrec_id}}">Boxrec Profile</a>
                    </p>
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
                @endif
            </div>

            @if(!$user->hasRole('Boxer'))
                @livewire('my-boxer', ['userId' => $user->id, 'editable' => false, 'separatable' => false])
            @endif

            @if($user->hasRole('MatchMaker'))
                @include('profile.partials.recent-posts', ['fights' => $myPosts])
            @elseif($user->hasRole('Manager'))
            @elseif($user->hasRole('Promoter'))
                @livewire('my-boxing-show', ['userId' => $user->id, 'separatable' => false])
            @endif
        </div>
    </div>
</section>
