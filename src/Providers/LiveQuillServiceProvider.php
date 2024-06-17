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
			], 'live-quill-config');
		}

		Blade::directive('liveQuillDark', function () {
			return <<<'HTML'
				<style>
					/* Dark Mode Editor Text and Background */
					.ql-container.ql-dark-mode.ql-snow {
						background-color: #1e1e1e;
						color: #c9d1d9;
					}

					/* Dark Mode Toolbar */
					.ql-toolbar.ql-dark-mode.ql-snow {
						background-color: #2d2d2d;
						border-color: #444;
					}

					/* Dark Mode Toolbar Buttons */
					.ql-toolbar.ql-dark-mode.ql-snow .ql-picker,
					.ql-toolbar.ql-dark-mode.ql-snow .ql-stroke,
					.ql-toolbar.ql-dark-mode.ql-snow .ql-picker-label,
					.ql-toolbar.ql-dark-mode.ql-snow .ql-picker-item,
					.ql-toolbar.ql-dark-mode.ql-snow .ql-picker-options {
						color: #ffffff; /* Color blanco para mejor visibilidad */
					}

					/* Customize button colors when active */
					.ql-toolbar.ql-dark-mode.ql-snow .ql-active .ql-fill,
					.ql-toolbar.ql-dark-mode.ql-snow .ql-active .ql-stroke {
						color: #ffffff; /* Color blanco para mejor visibilidad */
					}

					/* Dark Mode Selection Menus */
					.ql-toolbar.ql-dark-mode.ql-snow .ql-picker-options {
						background-color: #3a3a3a; /* Fondo del menú */
						border-color: #444;
					}

					/* Dark Mode Editor Text */
					.ql-container.ql-dark-mode.ql-snow .ql-editor {
						color: #c9d1d9;
						border-color: #444;
					}

					/* Dark Mode Editor Cursor */
					.ql-container.ql-dark-mode.ql-snow .ql-editor.ql-blank::before {
						color: #c9d1d9;
					}
				</style>
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
