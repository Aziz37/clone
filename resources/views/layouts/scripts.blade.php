<script>
	$(function() {
		$('.showForm').click(function() {
			var formId = $(this).data('form-id');
			$('#'+formId).toggle();
			$('#showForm_'+formId).toggle();
		});
	});
</script>

<script>
	$(function() {
		$('.user-end').click(function() {
			var formId = $(this).data('form-id');
			$('#'+formId).toggle();
			$('#showForm_'+formId).toggle();
		});
	});
</script>

<script>
	$(function() {
		$('.closeForm').click(function() {
			var formId = $(this).data('form-id');
			$('#'+formId).toggle();
			$('#showForm_'+formId).toggle();
		});
	});
</script>

<script>
	$(function() {
		$('.showMembers').click(function() {
			var cardId = $(this).data('form-id');
			$('#members_'+cardId).toggle();
		});
	});

	$(function() {
		$('.moveCard').click(function() {
			var cardId = $(this).data('form-id');
			$('#move_'+cardId).toggle();
		});
	})

	$(function() {
		$('.changeDate').click(function() {
			var cardId = $(this).data('form-id');
			$('#date_'+cardId).toggle();
		});
	});

	$(function() {
		$('.showAttachment').click(function() {
			var cardId = $(this).data('form-id');
			$('#attachment_'+cardId).toggle();
		});
	})
</script>	

<script type="text/javascript">
	$('.clockpicker').clockpicker()
		.find('input').change(function(){
		// TODO: time changed
		console.log(this.value);
	});
</script>

<script>
	$(function() {
		$('.description').click(function() {
			$('#showDescriptionForm').toggle();
			$('.description').toggle();
		});
	});

	$(function() {
		$('#hideDescriptionForm').click(function() {
			$('#showDescriptionForm').toggle();
			$('#description').toggle();
		});
	});
</script>

<script>
	$(document).ready(function() {
	    $('.js-example-basic-single').select2();
	});
</script>

<script>
	$('#noDate').click(function() {
		$('#setDate').toggle();
	});
</script>

<script>
	$(function() {
		$('.setColor').click(function() {
			var cardId = $(this).data('form-id');
			$('#colors_'+cardId).toggle();
		});
	});
</script>

<script>
    $('#customFile').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        var output = fileName.substr(12);
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(output);
    });
</script>