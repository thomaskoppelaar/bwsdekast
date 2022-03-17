<?php

return array(
	'pages' => array(
		'thuis' => array(
			'title' => 'Thuis',
			'show_in_menu' => true,
		),
		'nieuws' => array(
			'title' => 'Nieuws',
			'show_in_menu' => true,
		),
		'bewoners' => array(
			'title' => 'Bewoners',
			'show_in_menu' => true,
		),
		'oudbewoners' => array(
			'title' => 'Oudbewoners',
			'show_in_menu' => true,
		),
		'fotogalerij' => array(
			'title' => 'Fotogalerij',
			'show_in_menu' => true,
			'subpages' => array(
				'exterieur' => array('title' => 'Exterieur'),
				'interieur' => array('title' => 'Interieur'),
				'bewoners' => array('title' => 'Bewoners')
			),
		),
		'archief' => array(
			'title' => 'Archief',
			'show_in_menu' => true,
			'subpages' => array(
				'bwshistorie' => array('title' => 'Historie van het pand aan de Buitenwatersloot 25'),
				'bwslied' => array('title' => 'Het BWS-lied'),
				'kastenkalender' => array('title' => 'De BWS-pagina van de kastdeurenkalender der VGSD'),
				'kastenkalendergroot' => array('title' => 'De BWS-pagina van de kastdeurenkalender der VGSD'),
				'lustrumbundel86' => array('title' => 'De redactie van de lustrumbundel der VGSD, editie 1986'),
				'lustrumbundel86colofon' => array('title' => 'Lustrumbundel 86 colofon'),
				'lustrumbundel96' => array('title' => 'BWS ontroerend goed'),
			),
		),
		'links' => array(
			'title' => 'Links',
			'show_in_menu' => true,
		),
		'contact' => array(
			'title' => 'Contact',
			'show_in_menu' => true,
		),
		'404' => array(
			'title' => 'Niet gevonden',
			'show_in_menu' => false
		),
	),
	'pagemaps' => array(
		'' => 'thuis'
	)
);