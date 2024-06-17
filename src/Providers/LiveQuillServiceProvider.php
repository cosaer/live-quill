<?php

namespace Cosaer\LiveQuill\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LiveQuillServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'live-quill');
		Livewire::component('live-quill', \Cosaer\LiveQuill\LiveQuill::class);
		if ($this->app->runningInConsole()) {
			$this->publishes([
				__DIR__ . '/../../resources/views' => resource_path('views/vendor/live-quill'),
			], 'live-quill-views');
			$this->publishes([
				__DIR__ . '/../../config/config.php' => config_path('live-quill.php'),
			], 'live-quil-config');
		}

		Blade::directive('liveQuillScripts', function () {
			return <<<'HTML'
                <script>
                        window.livewire.on('livewire-select-focus-search', (data) => {
                            const el = document.getElementById(`${data.name || 'invalid'}`);

                            if (!el) {
                                return;
                            }

                            el.focus();
                        });

                        window.livewire.on('livewire-select-focus-selected', (data) => {
                            const el = document.getElementById(`${data.name || 'invalid'}-selected`);

                            if (!el) {
                                return;
                            }

                            el.focus();
                        });
                    </script>
HTML;
		});
	}

	/**
	 * Register the application services.
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'live-quill');
	}
}
