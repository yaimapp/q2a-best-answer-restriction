$(document).ready(function(){
	$('input.qa-a-select-button').click(function(){
		if (confirm('ベストアンサーを一度選択すると変更はできません。よろしいですか？ (なお、選択後も回答は受け付けられます) ')) {
			var args = $(this).data('args').split(',');
			qa_answer_click(args[0].trim(), args[1].trim(), this);
			location.reload();
		}
		return false;
	});
});
