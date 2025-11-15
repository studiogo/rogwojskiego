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
	'title' => 'Globalne ustawienia cen tortów',
	'fields' => array(

		// USTAWIENIA AUTO-GENEROWANIA GRUP
		array(
			'key' => 'field_base_group_price',
			'label' => 'Cena startowa (Grupa 1)',
			'name' => 'base_group_price',
			'type' => 'number',
			'instructions' => 'Cena bazowa dla pierwszej grupy cenowej',
			'required' => 1,
			'default_value' => 120,
			'min' => 0,
			'step' => 10,
			'append' => 'zł',
		),
		array(
			'key' => 'field_price_step',
			'label' => 'Krok cenowy',
			'name' => 'price_step',
			'type' => 'number',
			'instructions' => 'O ile zł rośnie cena każdej kolejnej grupy (np. 10 zł)',
			'required' => 1,
			'default_value' => 10,
			'min' => 1,
			'step' => 1,
			'append' => 'zł',
		),
		array(
			'key' => 'field_number_of_groups',
			'label' => 'Ilość grup',
			'name' => 'number_of_groups',
			'type' => 'number',
			'instructions' => 'Ile grup cenowych wygenerować (np. 21)',
			'required' => 1,
			'default_value' => 21,
			'min' => 1,
			'max' => 50,
			'step' => 1,
		),
		array(
			'key' => 'field_auto_generate_help',
			'label' => '',
			'name' => 'auto_generate_help',
			'type' => 'message',
			'message' => '<strong>💡 Auto-generowanie:</strong> Po zapisaniu zmian w powyższych polach, grupy cenowe poniżej zostaną automatycznie zaktualizowane. Możesz też ręcznie edytować każdą grupę.',
			'new_lines' => '',
			'esc_html' => 0,
		),

		// GRUPY CENOWE
		array(
			'key' => 'field_price_groups',
			'label' => 'Grupy cenowe',
			'name' => 'price_groups',
			'type' => 'repeater',
			'instructions' => 'Zdefiniuj grupy cenowe dla tortów. Później przypiszesz torty do odpowiednich grup.',
			'required' => 0,
			'min' => 1,
			'layout' => 'table',
			'button_label' => 'Dodaj grupę cenową',
			'sub_fields' => array(
				array(
					'key' => 'field_group_name',
					'label' => 'Nazwa grupy',
					'name' => 'group_name',
					'type' => 'text',
					'instructions' => 'np. "Grupa 1", "Grupa Standard"',
					'required' => 1,
					'placeholder' => 'Grupa 1',
				),
				array(
					'key' => 'field_group_price',
					'label' => 'Cena bazowa (zł)',
					'name' => 'base_price',
					'type' => 'number',
					'instructions' => 'Cena startowa dla tortów z tej grupy',
					'required' => 1,
					'min' => 0,
					'step' => 10,
					'append' => 'zł',
				),
			),
		),
		// WIELKOŚCI PORCJI
		array(
			'key' => 'field_portion_sizes',
			'label' => 'Wielkości porcji',
			'name' => 'portion_sizes',
			'type' => 'repeater',
			'instructions' => 'Dodaj dostępne wielkości tortów (porcje) i ich dopłaty.',
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
					'instructions' => 'np. 12, 15, 20, 25, 30',
					'required' => 1,
					'min' => 1,
					'step' => 1,
				),
				array(
					'key' => 'field_surcharge',
					'label' => 'Dopłata (zł)',
					'name' => 'surcharge',
					'type' => 'number',
					'instructions' => 'Dopłata do ceny bazowej',
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
				1. Zdefiniuj grupy cenowe (np. Grupa 1: 120 zł, Grupa 2: 130 zł)<br>
				2. Dodaj wielkości porcji i dopłaty (np. 12 porcji: +40 zł)<br>
				3. Przy edycji tortu przypisz go do grupy cenowej<br>
				4. Finalna cena = Cena z grupy + Dopłata za wielkość<br><br>
				<strong>Przykład:</strong><br>
				Tort w Grupie 1 (120 zł):<br>
				• 12 porcji (dopłata 40 zł) = 160 zł<br>
				• 15 porcji (dopłata 60 zł) = 180 zł',
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

		// TRYB AUTOMATYCZNY - Wybór grupy cenowej
		array(
			'key' => 'field_price_group',
			'label' => 'Grupa cenowa',
			'name' => 'price_group',
			'type' => 'select',
			'instructions' => 'Wybierz grupę cenową dla tego tortu. Grupy zarządzasz w "Ceny tortów".',
			'required' => 1,
			'choices' => array(), // Wypełniane dynamicznie
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

/**
 * Dynamicznie wypełnij dropdown grup cenowych
 */
function acf_load_price_group_choices( $field ) {
	$field['choices'] = array();

	if( have_rows('price_groups', 'option') ) {
		while( have_rows('price_groups', 'option') ) {
			the_row();
			$group_name = get_sub_field('group_name');
			$base_price = get_sub_field('base_price');
			$index = get_row_index() - 1;
			$field['choices'][$index] = $group_name . ' (' . $base_price . ' zł)';
		}
	}

	if( empty($field['choices']) ) {
		$field['choices'][''] = 'Brak grup - dodaj w "Ceny tortów"';
	}

	return $field;
}
add_filter('acf/load_field/key=field_price_group', 'acf_load_price_group_choices');

endif;
