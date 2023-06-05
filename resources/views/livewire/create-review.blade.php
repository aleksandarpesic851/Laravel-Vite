<div class="py-3">
    <div class="px-12 py-5">
        <h2 class="text-gray-300 text-2xl font-semibold">Write a review!</h2>
    </div>
    <form class="w-full"  wire:submit.prevent="createReview">
        <div>
            <textarea rows="5" class="p-4 text-gray-800 rounded-xl resize-none w-full" wire:model.lazy="review"></textarea>
            <x-input-error :messages="$errors->get('review')" class="mt-2" />
        </div>
        <div>
            <x-rating-mark wire:model.lazy="mark" :disabled="false" class="mt-2"/>
            <x-input-error :messages="$errors->get('mark')" class="mt-2" />
        </div>
        <div class="my-5 text-right">
            <button type="sumit" class="ml-auto px-10 py-3 tracking-wide text-lg bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl text-white">Rate now</button>
        </div>
    </form>
</div>