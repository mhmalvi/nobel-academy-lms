<script>
    $(document).ready(function(){
        $("#tutors").select2({
            placeholder: 'Select course instructor(s)'
        });


        function imagePreview(input){
            if(input.files && input.files[0]){
                var reader =  new FileReader();
                
                reader.onload = function(e){
                    $("#image-preview").addClass("img-thumbnail")
                    $("#image-preview").attr('src', e.target.result).hide().fadeIn('slow');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#image').change(function(){
            imagePreview(this);
        })


        $('#des').summernote({
            height: 500,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            placeholder: 'Descriptions about the course...',
            disableResizeEditor: true
        });
   });
</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
