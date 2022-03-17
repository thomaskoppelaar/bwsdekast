<p>
	<a href="/fotogalerij">Terug naar overzicht</a>
<?php
	foreach ($page->path['fotogalerij']['subpages'] as $key => $subpage) {
		if ($key !== $page->current) {
?>
		<a href="/fotogalerij/<?php echo Util::h($key); ?>"><?php echo Util::h($subpage['title']); ?></a>
<?php
		}
	}
?>
</p>