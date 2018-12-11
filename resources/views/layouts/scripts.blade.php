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
			$('.description').toggle();
		});
	});
</script>	