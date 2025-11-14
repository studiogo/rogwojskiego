<?php
/**
 * ACF Field Groups - Moduł cen dla tortów
 * Programowa rejestracja pól ACF dla systemu cenowego
 */

if( function_exists('acf_add_local_field_group') ):

// ============================================
// 1. GLOBALNE USTAWIENIA WIELKOŚCI (Options Page)
// ============================================

acf_add_local_field_group(array(
	'key' => 'group_cake_pricing_global',
	'title' => 'Globalne ustawienia wielkości tortów',
	'fields' => array(
		array(
			'key' => 'field_portion_sizes',
			'label' => 'Wielkości porcji',
			'name' => 'portion_sizes',
			'type' => 'repeater',
			'instructions' => 'Dodaj dostępne wielkości tortów (porcje) i ich dopłaty. Te ustawienia będą używane dla wszystkich tortów z automatyczną ceną.',
			'required' => 0,
			'min' => 1,
			'layout' => 'table',
			'button_label' => 'Dodaj wielkość',
			'sub_fields' => array(
				array(
					'key' => 'field_portions',
					'label' => 'Ilość porcji',
					'name' => 'portions',
					'type' => 'number',
					'instructions' => 'np. 12, 15, 18, 20',
					'required' => 1,
					'min' => 1,
					'step' => 1,
				),
				array(
					'key' => 'field_surcharge',
					'label' => 'Dopłata (zł)',
					'name' => 'surcharge',
					'type' => 'number',
					'instructions' => 'Dopłata do ceny bazowej (np. 40, 60, 80 zł)',
					'required' => 1,
					'min' => 0,
					'step' => 1,
					'append' => 'zł',
				),
			),
		),
		array(
			'key' => 'field_pricing_help',
			'label' => 'Pomoc',
			'name' => 'pricing_help',
			'type' => 'message',
			'message' => '<strong>Jak to działa?</strong><br>
				1. Dodaj wielkości porcji (np. 12, 15, 18, 20)<br>
				2. Dla każdej wielkości ustaw dopłatę do ceny bazowej<br>
				3. Przy edycji tortu wybierz cenę bazową (np. 120 zł)<br>
				4. Finalna cena = Cena bazowa + Dopłata za wielkość<br><br>
				<strong>Przykład:</strong><br>
				Cena bazowa tortu: 120 zł<br>
				12 porcji (dopłata 40 zł) = 160 zł<br>
				15 porcji (dopłata 60 zł) = 180 zł<br>
				18 porcji (dopłata 80 zł) = 200 zł',
			'new_lines' => '',
			'esc_html' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'cake-pricing-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
));

// ============================================
// 2. POLA DLA POJEDYNCZEGO TORTU (Custom Post Type: produkt)
// ============================================

acf_add_local_field_group(array(
	'key' => 'group_cake_pricing_product',
	'title' => 'Ustawienia ceny tortu',
	'fields' => array(
		array(
			'key' => 'field_enable_pricing',
			'label' => 'Włącz moduł cen',
			'name' => 'enable_pricing',
			'type' => 'true_false',
			'instructions' => 'Czy ten tort ma mieć cenę? Jeśli wyłączone, będzie wyświetlany przycisk "Zapytaj o cenę"',
			'required' => 0,
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => 'Tak',
			'ui_off_text' => 'Nie',
		),
		array(
			'key' => 'field_price_mode',
			'label' => 'Tryb ustalania ceny',
			'name' => 'price_mode',
			'type' => 'radio',
			'instructions' => 'Wybierz jak chcesz ustalić cenę dla tego tortu',
			'required' => 1,
			'choices' => array(
				'automatic' => 'Automatyczny (cena bazowa + dopłata za wielkość)',
				'manual' => 'Ręczny (ustaw indywidualne ceny dla każdej wielkości)',
			),
			'default_value' => 'automatic',
			'layout' => 'vertical',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_enable_pricing',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),

		// TRYB AUTOMATYCZNY - Cena bazowa
		array(
			'key' => 'field_base_price',
			'label' => 'Cena bazowa',
			'name' => 'base_price',
			'type' => 'select',
			'instructions' => 'Wybierz cenę bazową dla tego tortu. Finalna cena = cena bazowa + dopłata za wielkość',
			'required' => 1,
			'choices' => array(
				'120' => '120 zł',
				'130' => '130 zł',
				'140' => '140 zł',
				'150' => '150 zł',
				'160' => '160 zł',
				'170' => '170 zł',
				'180' => '180 zł',
				'190' => '190 zł',
				'200' => '200 zł',
				'210' => '210 zł',
				'220' => '220 zł',
				'230' => '230 zł',
				'240' => '240 zł',
				'250' => '250 zł',
				'260' => '260 zł',
				'270' => '270 zł',
				'280' => '280 zł',
				'290' => '290 zł',
				'300' => '300 zł',
				'310' => '310 zł',
				'320' => '320 zł',
			),
			'default_value' => '120',
			'allow_null' => 0,
			'ui' => 1,
			'ajax' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_enable_pricing',
						'operator' => '==',
						'value' => '1',
					),
					array(
						'field' => 'field_price_mode',
						'operator' => '==',
						'value' => 'automatic',
					),
				),
			),
		),

		// TRYB RĘCZNY - Indywidualne ceny
		array(
			'key' => 'field_manual_prices',
			'label' => 'Ceny dla poszczególnych wielkości',
			'name' => 'manual_prices',
			'type' => 'repeater',
			'instructions' => 'Ustaw indywidualne ceny dla każdej wielkości tortu. Dodaj tyle wierszy, ile masz wielkości w globalnych ustawieniach.',
			'required' => 1,
			'min' => 1,
			'layout' => 'table',
			'button_label' => 'Dodaj cenę',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_enable_pricing',
						'operator' => '==',
						'value' => '1',
					),
					array(
						'field' => 'field_price_mode',
						'operator' => '==',
						'value' => 'manual',
					),
				),
			),
			'sub_fields' => array(
				array(
					'key' => 'field_manual_portion_label',
					'label' => 'Wielkość (porcje)',
					'name' => 'portion_label',
					'type' => 'message',
					'message' => 'Pamiętaj: kolejność musi odpowiadać kolejności w globalnych ustawieniach wielkości!',
					'new_lines' => '',
					'esc_html' => 0,
				),
				array(
					'key' => 'field_manual_price',
					'label' => 'Cena końcowa (zł)',
					'name' => 'price',
					'type' => 'number',
					'instructions' => '',
					'required' => 1,
					'min' => 0,
					'step' => 1,
					'append' => 'zł',
				),
			),
		),

		array(
			'key' => 'field_pricing_preview',
			'label' => 'Podgląd cen',
			'name' => 'pricing_preview',
			'type' => 'message',
			'message' => 'Po zapisaniu zmiany, tutaj pojawi się podgląd wszystkich cen dla tego tortu.',
			'new_lines' => '',
			'esc_html' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_enable_pricing',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'produkt',
			),
		),
	),
	'menu_order' => 5,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
));

endif;
