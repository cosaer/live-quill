<div>
  <!-- Create the editor container -->
  <div id="{{ $quillId }}" wire:ignore></div>
</div>

@push('css')
		<!-- Include stylesheet -->
		<link href="{{ config('live-quill.pacakge_source.css') }}" rel="stylesheet"/>
		@liveQuillDark
@endpush
@push('js')
	<!-- Include the Quill library -->
	<script src="{{ config('live-quill.pacakge_source.js') }}"></script>
  <script>
		<!-- Initialize Quill editor -->
    const quill = new Quill('#{{ $quillId }}', {
      modules: {
        toolbar: [
          [{
            header: [1, 2, false]
          }],
          ['bold', 'italic'],
          ['blockquote', {
            list: 'ordered'
          }, {
            list: 'bullet'
          }],
        ],
      },
      theme: "{{ config('live-quill.theme') }}",
    });
    quill.on('text-change', function() {
      let val = document.getElementsByClassName('ql-editor')[0].innerHTML;
      @this.set('value', val);
    });

		// Function to switch between dark and light mode
		function toggleDarkMode() {
			var quillContainer = document.querySelector('.ql-container');
			var quillToolbar = document.querySelector('.ql-toolbar');
			quillContainer.classList.toggle('ql-dark-mode');
			quillToolbar.classList.toggle('ql-dark-mode');
		}

		document.addEventListener("DOMContentLoaded", () => {
			if(@json(session(config('live-quill.session_darkmode_key',false))))
			{
				toggleDarkMode();
			}
			let darkMode = @json(config('live-quill.dark_widget', null));
			if( darkMode != 'null' && darkMode){
				let darkWidget = document.querySelector("{{ config('live-quill.dark_widget') }}");
				darkWidget.addEventListener('click', (e) => {
					toggleDarkMode();
				});
			}
		});

  </script>
@endpush