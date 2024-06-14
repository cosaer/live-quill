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
    php artisan vendor:publish --provider="Cosaer\LiveQuill\Providers\LiveQuillServiceProvider"
    ```

4. Run npm:
    ```bash
    npm run dev
    ```

## Usage

Use the component in your Blade files:
```blade
<livewire:live-quill />
