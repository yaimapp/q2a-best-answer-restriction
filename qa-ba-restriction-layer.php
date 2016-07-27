<?php

class qa_html_theme_layer extends qa_html_theme_base
{
	public function body_footer()
	{
		qa_html_theme_base::body_footer();
		if ($this->template === 'question') {
			$plugin_url = qa_path('qa-plugin/q2a-best-answer-restriction/');
			$script = $plugin_url . 'ba-restriction.js';
			$this->output('<script type="text/javascript" src="'.$script.'"></script>');
		}
	}
}
