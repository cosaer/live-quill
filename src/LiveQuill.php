<?php
namespace Cosaer\LiveQuill;
 
use Livewire\Component;
 
class LiveQuill extends Component
{
    const EVENT_VALUE_UPDATED = 'quill_value_updated';
 
    public $value;
 
    public $quillId;
 
    public function mount($value = ''){
        $this->value = $value;
        $this->quillId = 'quill-'.uniqid();
    }
 
    public function updatedValue($value) {
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }
 
    public function render()
    {
        return view('live-quill::live-quill');
    }
}