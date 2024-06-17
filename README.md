# LiveQuill

Implementing quilljs in a Livewire component.

## Installation

1. Require the package via composer:
    ```bash
    composer require cosaer/live-quill
    ```

2. Install the required npm package:
    ```bash
    npm install quill
    ```

3. Publish the views and configuration:
    ```bash
    php artisan vendor:publish --tag=live-quill-views
    php artisan vendor:publish --tag=live-quill-config
    php artisan vendor:publish --provider="Cosaer\LiveQuill\Providers\LiveQuillServiceProvider"
    ```

4. Run npm:
    ```bash
    npm run dev
    ```

## Usage

Extended Live Quill Component:
```php
	use Cosaer\LiveQuill\LiveQuill;

	class Quill extends LiveQuill
	{

	}
```  

Use the component in your Blade files:
```blade
	<livewire:quill />
```
