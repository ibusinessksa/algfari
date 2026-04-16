@php
    $current = app()->getLocale();
    $action = route('filament.admin.set-locale');

    $itemBase = 'fi-dropdown-list-item flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5';
    $itemActive = 'bg-gray-50 dark:bg-white/5';
    $labelBase = 'fi-dropdown-list-item-label flex-1 truncate text-start text-gray-700 dark:text-gray-200';
@endphp

<div class="fi-panel-locale-switcher flex shrink-0 items-center">
    <x-filament::dropdown placement="bottom-end" teleport width="xs">
        <x-slot name="trigger">
            <button
                type="button"
                class="fi-topbar-item-button group flex items-center gap-x-2 rounded-lg px-2.5 py-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5"
                aria-label="{{ __('panel_locale.language_label') }}"
            >
                <x-filament::icon
                    icon="heroicon-o-language"
                    class="h-5 w-5 shrink-0 text-gray-400 transition group-hover:text-gray-600 dark:text-gray-500 dark:group-hover:text-gray-300"
                />
                <span class="hidden text-sm font-medium text-gray-700 sm:inline dark:text-gray-200">
                    {{ $current === 'ar' ? __('panel_locale.arabic') : __('panel_locale.english') }}
                </span>
                <span class="inline text-xs font-semibold uppercase tracking-wide text-gray-500 sm:hidden dark:text-gray-400">
                    {{ $current }}
                </span>
                <x-filament::icon
                    icon="heroicon-m-chevron-down"
                    class="h-4 w-4 shrink-0 text-gray-400 dark:text-gray-500"
                />
            </button>
        </x-slot>

        <x-filament::dropdown.list>
            <form method="post" action="{{ $action }}" class="block w-full">
                @csrf
                <input type="hidden" name="locale" value="ar">
                <button
                    type="submit"
                    @class([$itemBase, $itemActive => $current === 'ar'])
                >
                    @if ($current === 'ar')
                        <x-filament::icon
                            icon="heroicon-m-check"
                            class="h-5 w-5 shrink-0 text-primary-600 dark:text-primary-400"
                        />
                    @else
                        <span class="h-5 w-5 shrink-0" aria-hidden="true"></span>
                    @endif
                    <span @class([$labelBase, 'font-semibold text-primary-700 dark:text-primary-300' => $current === 'ar'])>
                        {{ __('panel_locale.arabic') }}
                    </span>
                </button>
            </form>

            <form method="post" action="{{ $action }}" class="block w-full">
                @csrf
                <input type="hidden" name="locale" value="en">
                <button
                    type="submit"
                    @class([$itemBase, $itemActive => $current === 'en'])
                >
                    @if ($current === 'en')
                        <x-filament::icon
                            icon="heroicon-m-check"
                            class="h-5 w-5 shrink-0 text-primary-600 dark:text-primary-400"
                        />
                    @else
                        <span class="h-5 w-5 shrink-0" aria-hidden="true"></span>
                    @endif
                    <span @class([$labelBase, 'font-semibold text-primary-700 dark:text-primary-300' => $current === 'en'])>
                        {{ __('panel_locale.english') }}
                    </span>
                </button>
            </form>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
