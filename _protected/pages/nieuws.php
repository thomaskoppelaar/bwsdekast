<?php

$news = new News(Config::get('news'));

foreach ($news->getNewsFiles() as $newsFile) {
	$newsItem = $news->readNewsFile($newsFile);

?>
	<article>
		<header>
			<h3>
				<?php echo Util::h($newsItem['title']); ?>
			</h3>

			<p><small>Geplaatst op:
				<time pubdate="pubdate" datetime="<?php echo date(DATE_RFC3339, $newsItem['ctime']); ?>">
					<?php echo NLDate::format('l j F Y', $newsItem['ctime']); ?>
				</time>
			</small></p>
		</header>

		<?php
			foreach ($newsItem['paragraphs'] as $paragraph) {
		?>
		<p>
			<?php echo Util::h($paragraph); ?>
		</p>
		<?php
			}
		?>
	</article>

<?php
}