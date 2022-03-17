<?php
	foreach ($page->path['fotogalerij']['subpages'] as $key => $subpage) {
?>
	<p><a href="/fotogalerij/<?php echo Util::h($key); ?>"><?php echo Util::h($subpage['title']); ?></a></p>
<?php
	}
?>
