<?php

/*
 * You can place your custom package configuration in here.
 */
return [
	/*
    |--------------------------------------------------------------------------
    | Assets for Quill.js
    |--------------------------------------------------------------------------
    |
    | In this section either the paths to the css and js assets for the 
	| quill.js package or the cdn assets are configured.
	*/
	'pacakge_source' => [
		'css' => 'https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css',
		'js' => 'https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js'
	],
	/*
    |--------------------------------------------------------------------------
    | Editor theme
    |--------------------------------------------------------------------------
    |
    | This configuration variable sets the theme for the editor (only snow available).
    */
	'theme' => 'snow',
	/*
    |--------------------------------------------------------------------------
    | Dark mode widget
    |--------------------------------------------------------------------------
    |
    | Refers to the widget that will switch between color modes.
	| document.querySelector("{{ config('live-quill.dark_widget') }}")
    */
	'dark_widget' => '',
	/*
    |--------------------------------------------------------------------------
    | Dark mode session key
    |--------------------------------------------------------------------------
    |
    | Refers to the session variable that controls the color scheme
	| from the browser session.
    */
	'session_darkmode_key' => ''
];
