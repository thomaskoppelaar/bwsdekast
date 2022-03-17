<nav id="menu">
	<ul>
	<?php
		foreach ($this->pages as $_page => $_page_info) {
			if (!empty($_page_info['show_in_menu'])) {
	?>
				<li><a href="/<?php echo Util::h($_page); ?>"><?php echo Util::h($_page_info['title']); ?></a></li>
	<?php
			}
		}
	?>
	</ul>
</nav>