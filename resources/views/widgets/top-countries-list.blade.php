<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('visitor-tracking-filament::widgets.top_countries_list.heading') }}
        </x-slot>

        <x-slot name="description">
            {{ __('visitor-tracking-filament::widgets.top_countries_list.description') }}
        </x-slot>

        <div class="space-y-2 flex flex-col"
             x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('styles', package: 'laravel-visitor-tracking-filament/styles'))]"
        >
            @forelse($countries as $key => $country)
                <div class="flex flex-col p-1">
                    <div class="flex items-center gap-2 justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">#{{$key + 1}}</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="text-sm font-bold">{{ $country['country_name'] }}</span>
                                <span class="text-xs leading-none">{{ $country['flag'] }}</span>
                          </span>
                        </div>

                        <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-200">
                            {{ Number::forHumans($country['visitor_count'], 2, 2, true) }}
                        </span>
                            <span class="text-sm font-semibold">
                            {{ number_format($country['percentage'], 1) }}%
                        </span>
                        </div>
                    </div>
                    <div class="w-full">
                        <progress class="w-full h-[8px] rounded-4xl" max="100"
                                  value="{{ number_format($country['percentage']) }}"></progress>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-gray-400 dark:text-gray-600 mb-4">
                        <x-heroicon-o-globe-alt class="w-12 h-12 mx-auto"/>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('visitor-tracking-filament::widgets.top_countries_list.no_data.title') }}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ __('visitor-tracking-filament::widgets.top_countries_list.no_data.description') }}
                    </p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
