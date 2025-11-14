/**
 * Moduł cen tortów - Dynamiczna kalkulacja ceny w formularzu
 */

(function($) {
    'use strict';

    var CakePricing = {
        pricingData: null,
        $form: null,
        $portionSelect: null,
        $priceDisplay: null,
        hasPricing: false,
        basePrice: 0,
        cakeName: '',

        /**
         * Inicjalizacja modułu
         */
        init: function() {
            var self = this;

            $(document).ready(function() {
                self.bindEvents();
            });
        },

        /**
         * Bindowanie eventów
         */
        bindEvents: function() {
            var self = this;

            // Event po kliknięciu przycisku zamówienia
            $('.rezerwacjaBtn').on('click', function(e) {
                var $btn = $(this);

                self.hasPricing = $btn.data('has-pricing') == '1';
                self.basePrice = parseInt($btn.data('base-price')) || 0;
                self.cakeName = $btn.data('cake-name') || '';

                if (self.hasPricing) {
                    self.loadPricingData();
                }
            });
        },

        /**
         * Pobieranie danych o cenach przez AJAX
         */
        loadPricingData: function() {
            var self = this;

            $.ajax({
                url: cakePricingData.ajaxurl,
                type: 'POST',
                data: {
                    action: 'get_cake_pricing_data',
                    post_id: cakePricingData.postId
                },
                success: function(response) {
                    try {
                        var data = typeof response === 'string' ? JSON.parse(response) : response;

                        if (data.has_pricing) {
                            self.pricingData = data;
                            self.injectFormFields();
                        }
                    } catch(e) {
                        console.error('Błąd parsowania danych cenowych:', e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Błąd pobierania danych cenowych:', error);
                }
            });
        },

        /**
         * Wstrzykiwanie pól do formularza CF7
         */
        injectFormFields: function() {
            var self = this;

            // Czekamy na załadowanie formularza w modalu
            setTimeout(function() {
                self.$form = $('#modalRezerwacja').find('form.wpcf7-form');

                if (!self.$form.length) {
                    console.error('Nie znaleziono formularza CF7');
                    return;
                }

                // Sprawdź czy pola już istnieją (żeby nie duplikować)
                if (self.$form.find('.cake-portion-selector').length > 0) {
                    self.updateFormData();
                    return;
                }

                // Znajdź miejsce do wstawienia pól (po polu z nazwą tortu)
                var $nameField = self.$form.find('input[name="nazwa_tortu"]').closest('p');

                if (!$nameField.length) {
                    console.warn('Nie znaleziono pola nazwa_tortu, dodaję na początku formularza');
                    $nameField = self.$form.find('p').first();
                }

                // Wygeneruj HTML dla pól
                var fieldsHTML = self.generateFormFieldsHTML();

                // Wstaw pola po polu nazwa_tortu
                $nameField.after(fieldsHTML);

                // Zapisz referencje do pól
                self.$portionSelect = self.$form.find('#cake-portion-size');
                self.$priceDisplay = self.$form.find('#cake-final-price');

                // Bindowanie eventów dla selecta
                self.$portionSelect.on('change', function() {
                    self.updatePrice();
                });

                // Inicjalna kalkulacja ceny
                self.updateFormData();
                self.updatePrice();

            }, 500); // Dajemy czas na otwarcie modala i załadowanie formularza
        },

        /**
         * Generowanie HTML dla pól formularza
         */
        generateFormFieldsHTML: function() {
            var self = this;
            var html = '';

            // Pole wyboru wielkości tortu
            html += '<p class="cake-portion-selector">';
            html += '<label for="cake-portion-size">Wielkość tortu <span class="required">*</span></label>';
            html += '<span class="wpcf7-form-control-wrap portion-size">';
            html += '<select id="cake-portion-size" name="portion-size" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" required>';
            html += '<option value="">-- Wybierz wielkość --</option>';

            // Opcje wielkości
            if (self.pricingData && self.pricingData.prices) {
                self.pricingData.prices.forEach(function(item, index) {
                    var portionLabel = item.portions + ' porcji';
                    var priceLabel = self.formatPrice(item.price);
                    html += '<option value="' + index + '" data-price="' + item.price + '">';
                    html += portionLabel + ' - ' + priceLabel;
                    html += '</option>';
                });
            }

            html += '</select>';
            html += '</span>';
            html += '</p>';

            // Pole wyświetlania ceny końcowej (read-only)
            html += '<p class="cake-price-display">';
            html += '<label for="cake-final-price">Cena końcowa</label>';
            html += '<span class="wpcf7-form-control-wrap final-price">';
            html += '<input type="text" id="cake-final-price" name="final-price" class="wpcf7-form-control wpcf7-text" readonly value="" />';
            html += '</span>';
            html += '</p>';

            // Ukryte pola z danymi
            html += '<input type="hidden" name="cake-base-price" id="cake-base-price" value="' + self.basePrice + '" />';
            html += '<input type="hidden" name="cake-portion-selected" id="cake-portion-selected" value="" />';
            html += '<input type="hidden" name="cake-price-final" id="cake-price-final" value="" />';

            return html;
        },

        /**
         * Aktualizacja wyświetlanej ceny
         */
        updatePrice: function() {
            var self = this;

            if (!self.$portionSelect || !self.$priceDisplay) {
                return;
            }

            var selectedOption = self.$portionSelect.find('option:selected');
            var price = parseInt(selectedOption.data('price')) || 0;
            var portionText = selectedOption.text();

            if (price > 0) {
                self.$priceDisplay.val(self.formatPrice(price));

                // Aktualizuj ukryte pola
                self.$form.find('#cake-portion-selected').val(portionText);
                self.$form.find('#cake-price-final').val(price);
            } else {
                self.$priceDisplay.val('');
                self.$form.find('#cake-portion-selected').val('');
                self.$form.find('#cake-price-final').val('');
            }
        },

        /**
         * Aktualizacja danych w formularzu (nazwa tortu, cena bazowa)
         */
        updateFormData: function() {
            var self = this;

            // Aktualizuj nazwę tortu
            if (self.cakeName) {
                self.$form.find('input[name="nazwa_tortu"]').val(self.cakeName);
            }

            // Aktualizuj cenę bazową w ukrytym polu
            if (self.$form.find('#cake-base-price').length) {
                self.$form.find('#cake-base-price').val(self.basePrice);
            }
        },

        /**
         * Formatowanie ceny (np. 180 -> "180 zł")
         */
        formatPrice: function(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' zł';
        }
    };

    // Inicjalizacja modułu
    CakePricing.init();

})(jQuery);
