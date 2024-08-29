<?php

namespace Cosaer\LiveQuill;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class LiveQuill extends Component
{
	#[Modelable]
	public $value;

	public $quillId;

	public function mount()
	{
		$this->quillId = 'quill-'.uniqid() ;
	}

	public function updatedValue($value) {
		self::analyzeEditorInout($value);
	}

	private static function analyzeEditorInout($cadena)
	{
		// Remove HTML tags allowed by QuillJS
		$permitidas = ['p', 'span', 'a', 'img', 'ul', 'ol', 'li', 'b', 'i', 'u', 'strike', 'sub', 'sup', 'code', 'blockquote', 'hr'];
		$cadena = strip_tags($cadena, '<' . implode('><', $permitidas) . '>');

		// Verify SQL Injection
		$sql_keywords = ['SELECT', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'CREATE', 'ALTER', 'TRUNCATE', 'EXEC', 'UNION'];
		foreach ($sql_keywords as $keyword) {
			if (stripos($cadena, $keyword) !== false) {
				throw new \Exception("Posible inyección de SQL detectada: $keyword");
			}
		}

		// Verify JavaScript injection
		$js_keywords = ['<script', 'javascript:', 'eval(', 'unescape('];
		foreach ($js_keywords as $keyword) {
			if (stripos($cadena, $keyword) !== false) {
				throw new \Exception("Posible inyección de JavaScript detectada: $keyword");
			}
		}

		// Verify that there is no PHP code
		if (preg_match('/<\?.*?\?>/s', $cadena)) {
			throw new \Exception("Posible inyección de código PHP detectada");
		}

		return true; // La cadena es segura
	}

	public function render()
	{
		return view('live-quill::live-quill');
	}
}