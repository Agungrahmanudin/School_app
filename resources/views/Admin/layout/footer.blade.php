 <!-- Bootstrap bundle JS -->
  <script src="{{ asset('assets_admin/assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('assets_admin/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets_admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets_admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets_admin/assets/js/pace.min.js') }}"></script>
  <script src="{{ asset('assets_admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
	<script src="{{ asset('assets_admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('assets_admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
  <!--app-->
  <script src="{{ asset('assets_admin/assets/js/app.js') }}"></script>
  <script src="{{ asset('assets_admin/assets/js/index.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      if (typeof tinymce !== 'undefined') {
        tinymce.init({
          selector: 'textarea.tinymce-editor',
          elementpath: true,
          statusbar: true,   
          height: 380,
          menubar: false,
          plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'wordcount'
          ],
          toolbar1: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough |',
          toolbar2: 'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table| fullscreen ',
          toolbar_mode: 'sliding',
          branding: false,
          promotion: false,
          content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.7; color: #333; }',
          setup: function (editor) {
            editor.on('change keyup NodeChange', function () {
              editor.save();
            });
          }
        });

        // Pastikan isi TinyMCE selalu tersinkronisasi sebelum form di-submit
        document.querySelectorAll('form').forEach(function(form) {
          form.addEventListener('submit', function() {
            tinymce.triggerSave();
          });
        });
      }
    });
  </script>
  @stack('scripts')