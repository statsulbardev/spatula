<div
    x-data="{ shown: false, timeout: null }"
    x-init="@this.on('validate', () => {clearTimeout(timeout);shown = true;timeout = setTimeout(() => { shown = false }, 5000);})"
    x-show.transition.opacity.out.duration.2000ms="shown">
    @error($model)
        <div class="mt-3">
            <span class="flex items-center text-white bg-red-500 rounded p-2 w-fit">
                <x-icons.hero name="information-circle-solid" size="w-5 h-5" />
                <span class="ml-2 text-sm font-medium tracking-wide">{{ $message }}</span>
            </span>
        </div>
    @enderror
</div>
