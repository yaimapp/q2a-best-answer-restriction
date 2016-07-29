$(document).ready(function(){
	$('input.qa-a-select-button').click(function(){
		if (confirm(confirm_msg)) {
			var args = $(this).data('args').split(',');
			var ret = qa_answer_click(args[0].trim(), args[1].trim(), this);
			hide_select_button();
			return ret;
		}
		return false;
	});

	var hide_select_button = function() {
		$('input.qa-a-select-button').hide();
	};
});
