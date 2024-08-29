<?php

namespace Tests\Unit;

use App\Http\Livewire\LiveQuill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LiveQuillUnitTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function it_can_generate_quill_id_on_mount()
	{
		$component = new LiveQuill();
		$component->mount();

		$this->assertNotNull($component->quillId);
	}

	/** @test */
	public function it_analyzes_editor_input_for_security()
	{
		$component = new LiveQuill();

		$safeContent = '<p>Hello, Livewire!</p>';
		$unsafeContent = 'SELECT * FROM users';

		$this->assertTrue($component->analyzeEditorInout($safeContent));

		$this->expectException(\Exception::class);
		$component->analyzeEditorInout($unsafeContent);
	}
}
