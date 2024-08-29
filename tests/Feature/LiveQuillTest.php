<?php

namespace Tests\Feature;

use App\Http\Livewire\LiveQuill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LiveQuillTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function can_render_live_quill_component()
	{
		Livewire::test(LiveQuill::class)
			->assertSee('Quill Editor');
	}

	/** @test */
	public function can_update_value_with_editor_content()
	{
		Livewire::test(LiveQuill::class)
			->set('value', '<p>Hello, Livewire!</p>')
			->call('updatedValue', '<p>Hello, Livewire!</p>')
			->assertEmitted('quill_value_updated', '<p>Hello, Livewire!</p>');
	}

	/** @test */
	public function detects_and_prevents_sql_injection()
	{
		$this->expectException(\Exception::class);

		Livewire::test(LiveQuill::class)
			->call('analyzeEditorInout', 'SELECT * FROM users')
			->assertSee('Possible SQL injection detected');
	}

	/** @test */
	public function detects_and_prevents_javascript_injection()
	{
		$this->expectException(\Exception::class);

		Livewire::test(LiveQuill::class)
			->call('analyzeEditorInout', '<script>alert("Hello")</script>')
			->assertSee('Possible JavaScript injection detected');
	}

	/** @test */
	public function detects_and_prevents_php_code_injection()
	{
		$this->expectException(\Exception::class);

		Livewire::test(LiveQuill::class)
			->call('analyzeEditorInout', '<?php echo "Hello"; ?>')
			->assertSee('Possible PHP code injection detected');
	}
}
