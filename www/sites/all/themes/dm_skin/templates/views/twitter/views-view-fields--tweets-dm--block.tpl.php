<div class="bulle">
	<div class="date">
		<?php print render($fields['created_time']->content); ?>
	</div>
	<div class="tweet">
		<?php print render($fields['text']->content); ?>
	</div>
	<div class="fleche"></div>
</div>
<a href="https://twitter.com/CARIF_IDF" class="avatar"><?php print render($fields['profile_image_url']->content); ?></a>
