<?php


$bewoners = array(
	array('voorl' => 'P',	'naam' => 'Eigenraam', 'sinds' => 1975),
	array('voorl' => 'S',	'naam' => 'Duyst', 'tot' => 1980),
	array('voorl' => 'EJC',	'naam' => 'Loor'),
	array('voorl' => 'CS',	'naam' => 'Alderliesten'),
	array('voorl' => 'A',	'naam' => 'Hagg'),
	array('naam' => 'JH van den Berg (en M van den Berg-, Haagsma)', 'sinds' => '1982'),
	array('voorl' => 'AA',	'naam' => 'Alkema', 'sinds' => 1988, 'tot' => 1989),
	array('voorl' => 'JA',	'naam' => 'Schelling', 'sinds' => 1989, 'tot' => 1991),
	array('voorl' => 'L',	'naam' => 'Meints', 'tot' => 1992),
	array('voorl' => 'CJ',	'naam' => 'de Wolff', 'sinds' => 1991, 'tot' => 1997),
	array('voorl' => 'RJ',	'naam' => 'van Leeuwen', 'sinds' => 1992, 'tot' => 1999),
	array('voorl' => 'K',	'naam' => 'Buist', 'sinds' => 1992, 'tot' => 1995),
	array('voorl' => 'HM',	'naam' => 'Kwant', 'sinds' => 1993, 'tot' => 1996),
	array('voorl' => 'KJ',	'naam' => 'Bos', 'sinds' => 1993, 'tot' => 1994),
	array('voorl' => 'AJHJ','naam' => 'Gerrits', 'sinds' => 1994, 'tot' => 1998),
	array('voorl' => 'R',	'naam' => 'Triemstra', 'sinds' => 1995, 'tot' => 2000),
	array('voorl' => 'JJ',	'naam' => 'Barnhard', 'sinds' => 1996, 'tot' => 2000),
	array('voorl' => 'JL',	'naam' => 'de Jong', 'sinds' => 1997, 'tot' => 1999),
	array('voorl' => 'GJ',	'naam' => 'Tigelaar', 'sinds' => 1998, 'tot' => 2002),
	array('voorl' => 'LW',	'naam' => 'van Popta', 'sinds' => 1999, 'tot' => 2004),
	array('voorl' => 'EJ',	'naam' => 'Oosterhuis', 'sinds' => 1999, 'tot' => 2003),
	array('voorl' => 'W',	'naam' => 'Geelhoed', 'sinds' => 2000, 'tot' => 2004),
	array('voorl' => 'MT',	'naam' => 'Balk', 'sinds' => 2000, 'tot' => 2008),
	array('voorl' => 'MP',	'naam' => 'Voogt', 'sinds' => 2002, 'tot' => 2004),
	array('voorl' => 'JH',	'naam' => 'Kwakkel', 'sinds' => 2003, 'tot' => 2004),
	array('voorl' => 'J',	'naam' => 'Vreugdenhil', 'sinds' => 2004, 'tot' => 2009),
	array('voorl' => 'DE',	'naam' => 'den Arend', 'sinds' => 2004, 'tot' => 2008),
	array('voorl' => 'RA',	'naam' => 'Fraanje', 'sinds' => 2004, 'tot' => 2007),
	array('voorl' => 'R',	'naam' => 'Horlings', 'sinds' => 2005, 'tot' => 2008),
	array('voorl' => 'JM',	'naam' => 'Keegstra', 'sinds' => 2007, 'tot' => 2012),
	array('voorl' => 'FL',	'naam' => 'Gunnink', 'sinds' => 2008, 'tot' => 2011),
	array('voorl' => 'GJ',	'naam' => 'Meijer', 'sinds' => 2008, 'tot' => 2013),
	array('voorl' => 'L',	'naam' => 'Bogerd', 'sinds' => 2008, 'tot' => 2013),
	array('voorl' => 'PJ',	'naam' => 'Sterrenburg', 'sinds' => 2009, 'tot' => 2013),
	array('voorl' => 'ML',  'naam' => 'de Jong', 'sinds' => 2011, 'tot' => 2015),
	array('voorl' => 'MC',  'naam' => 'Schuurman', 'sinds' => 2013, 'tot' => 2015),
);

?>

<p>De volgende VGSD'ers hebben in het verleden de BWS met hun bewoning verrijkt:</p>

<?php
	foreach ($bewoners as $bewoner) {
?>
		<p class="bewoner"><?php
			if (isset($bewoner['voorl'])) {
				echo '<span class="voorl">' . Util::toInitials($bewoner['voorl']) . '</span> ';
			}

			echo Util::h($bewoner['naam']);

			if (isset($bewoner['tot']) || isset($bewoner['sinds'])) {
				echo '<span class="more-info">';
				if (!isset($bewoner['tot'])) {
					echo 'vanaf ' . $bewoner['sinds'];
				}
				elseif (!isset($bewoner['sinds'])) {
					echo 'tot ' . $bewoner['tot'];
				}
				else {
					echo $bewoner['sinds'] . ' &ndash; ' . $bewoner['tot'];
				}
				echo '</span>';
			}
		?></p>
<?php
	}
?>