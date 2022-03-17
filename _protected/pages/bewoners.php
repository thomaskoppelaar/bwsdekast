<?php

$bewoners = array(
	array(
		'voorl' => 'J',
		'naam' => 'Belder',
		'sinds' => '2012',
	),
	array(
		'voorl' => 'ET',
		'naam' => 'Zwarts',
		'sinds' => '2013',
	),
	array(
		'voorl' => 'RJ',
		'naam' => 'Meesen',
		'sinds' => '2013',
	),
	array(
		'voorl' => 'JM',
		'naam' => 'Harms',
		'sinds' => '2015',
	),
	array(
		'voorl' => 'H',
		'naam' => 'Denekamp',
		'sinds' => '2015',
	),
);
?>

<p>Dit zijn de bewoners van De Kast:</p>
<?php
	foreach ($bewoners as $bewoner) {
?>
		<p class="bewoner">
			<span class="voorl"><?php echo Util::toInitials($bewoner['voorl']); ?></span>
			<?php echo Util::h($bewoner['naam']); ?>
			<span class="more-info">Sinds <?php echo Util::h($bewoner['sinds']); ?></span>
		</p>
<?php
	}
?>
