<?php

class qa_html_theme_layer extends qa_html_theme_base
{

	private $selchildid;
	
	public function q_view($q_view)
	{
		$this->selchildid = $q_view['raw']['selchildid'];
		qa_html_theme_base::q_view($q_view);
	}

	public function body_footer()
	{
		qa_html_theme_base::body_footer();
		if ($this->template === 'question' && qa_get_logged_in_level() < QA_USER_LEVEL_ADMIN) {
			$plugin_url = qa_path('qa-plugin/q2a-best-answer-restriction/');
			$script = $plugin_url . 'ba-restriction.js';
			$this->output('<script type="text/javascript" src="'.$script.'"></script>');
		}
	}

	public function a_selection($post)
	{
		if (qa_get_logged_in_level() < QA_USER_LEVEL_ADMIN) {
			if (isset($post['select_tags'])) {
				$old_tags = $post['select_tags'];
				$pattern = "/onclick\s?=\s?[\"\']([^\"\']+)[\"\']/i";
				preg_match($pattern, $old_tags, $m);

				$onclick = $m[1];
				$pattern2 = "/qa_answer_click\(([^\])]+)\)/i";
				preg_match($pattern2, $onclick, $m2);

				$new_tags = preg_replace($pattern, '', $old_tags);
				$new_tags .= ' data-args="' . $m2[1] .'"';
				if ($this->selchildid !== $post['raw']['postid']) {
					$new_tags .= ' disabled="disabled"';
				}
				@$post['select_tags'] = $new_tags;
			} elseif (isset($post['unselect_tags'])) {
				// name属性だけ取得
				$pattern = "/name\s?=\s?[\"\']([^\"\']+)[\"\']/i";
				preg_match($pattern, $post['unselect_tags'], $m);
				$new_tag = $m[0];
				@$post['unselect_tags'] = $new_tag . ' disabled="disabled"';
			}
		}
		// print_r($post);
		qa_html_theme_base::a_selection($post);
	}
}
