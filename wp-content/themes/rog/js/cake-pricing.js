/**
 * Moduł cen tortów - Integracja z istniejącym formularzem CF7
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
                            self.integrateWithExistingForm();
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
         * Integracja z istniejącym formularzem CF7
         */
        integrateWithExistingForm: function() {
            var self = this;

            // Czekamy na załadowanie formularza w modalu
            setTimeout(function() {
                self.$form = $('#modalRezerwacja').find('form.wpcf7-form');

                if (!self.$form.length) {
                    console.error('Nie znaleziono formularza CF7');
                    return;
                }

                // Znajdź istniejący select z porcjami
                self.$portionSelect = self.$form.find('select[name="ilosc-porcji"]');

                if (!self.$portionSelect.length) {
                    console.error('Nie znaleziono pola ilosc-porcji');
                    return;
                }

                // Sprawdź czy pole ceny już istnieje (żeby nie duplikować)
                if (self.$form.find('.cake-price-display').length > 0) {
                    self.$priceDisplay = self.$form.find('#cake-final-price');
                    self.updateFormData();
                    self.bindPortionChange();
                    self.updatePrice();
                    return;
                }

                // Dodaj pole ceny obok selecta porcji
                var $portionRow = self.$portionSelect.closest('.col-sm-2');

                if ($portionRow.length) {
                    // Wstaw pole ceny w tym samym row
                    var priceHTML = '<div class="col-sm-3 cake-price-display">';
                    priceHTML += '<label>Cena</label>';
                    priceHTML += '<input type="text" id="cake-final-price" name="final-price" class="wpcf7-form-control wpcf7-text" readonly value="" style="font-weight:bold; color:#e16ca1;" />';
                    priceHTML += '</div>';

                    $portionRow.after(priceHTML);
                }

                // Zapisz referencję do pola ceny
                self.$priceDisplay = self.$form.find('#cake-final-price');

                // Dodaj ukryte pola z danymi
                var hiddenHTML = '';
                hiddenHTML += '<input type="hidden" name="cake-base-price" id="cake-base-price" value="' + self.basePrice + '" />';
                hiddenHTML += '<input type="hidden" name="cake-portion-selected" id="cake-portion-selected" value="" />';
                hiddenHTML += '<input type="hidden" name="cake-price-final" id="cake-price-final" value="" />';

                self.$form.append(hiddenHTML);

                // Bindowanie eventów dla selecta
                self.bindPortionChange();

                // Inicjalna kalkulacja ceny
                self.updateFormData();
                self.updatePrice();

            }, 500); // Dajemy czas na otwarcie modala i załadowanie formularza
        },

        /**
         * Bindowanie zmiany wielkości
         */
        bindPortionChange: function() {
            var self = this;

            self.$portionSelect.on('change', function() {
                var selectedValue = $(this).val();

                // Jeśli wybrano "inna", nie pokazuj ceny
                if (selectedValue === 'inna') {
                    self.$priceDisplay.val('');
                    self.$form.find('#cake-portion-selected').val('');
                    self.$form.find('#cake-price-final').val('');
                } else {
                    self.updatePrice();
                }
            });
        },

        /**
         * Aktualizacja wyświetlanej ceny
         */
        updatePrice: function() {
            var self = this;

            if (!self.$portionSelect || !self.$priceDisplay) {
                return;
            }

            var selectedPortion = self.$portionSelect.val();

            // Jeśli wybrano "inna", nie pokazuj ceny
            if (selectedPortion === 'inna' || !selectedPortion) {
                self.$priceDisplay.val('');
                return;
            }

            // Znajdź cenę dla wybranej wielkości
            var price = 0;
            var portionText = selectedPortion + ' porcji';

            if (self.pricingData && self.pricingData.prices) {
                for (var i = 0; i < self.pricingData.prices.length; i++) {
                    if (self.pricingData.prices[i].portions == selectedPortion) {
                        price = self.pricingData.prices[i].price;
                        break;
                    }
                }
            }

            if (price > 0) {
                self.$priceDisplay.val(self.formatPrice(price));

                // Aktualizuj ukryte pola
                self.$form.find('#cake-portion-selected').val(portionText);
                self.$form.find('#cake-price-final').val(price);
            } else {
                self.$priceDisplay.val('Brak ceny');
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
