#!/bin/bash
# Skrypt do wgrania modułu cen na serwer FTP

FTP_HOST="studiogo2.kylos.pl"
FTP_USER="tort"
FTP_PASS="VWQtABWMCvYpue2hxWQ3"
FTP_PATH="/home/studiog2/domains/torty.studiogo2.kylos.pl/public_html"

echo "🚀 Wgrywanie modułu cen tortów na serwer..."

# 1. functions.php
echo "📤 Wgrywam functions.php..."
curl -T wp-content/themes/rog/functions.php \
  ftp://${FTP_HOST}${FTP_PATH}/wp-content/themes/rog/ \
  --user ${FTP_USER}:${FTP_PASS}

# 2. single-produkt.php
echo "📤 Wgrywam single-produkt.php..."
curl -T wp-content/themes/rog/single-produkt.php \
  ftp://${FTP_HOST}${FTP_PATH}/wp-content/themes/rog/ \
  --user ${FTP_USER}:${FTP_PASS}

# 3. style.css
echo "📤 Wgrywam style.css..."
curl -T wp-content/themes/rog/style.css \
  ftp://${FTP_HOST}${FTP_PATH}/wp-content/themes/rog/ \
  --user ${FTP_USER}:${FTP_PASS}

# 4. acf-fields-cake-pricing.php (nowy plik)
echo "📤 Wgrywam acf-fields-cake-pricing.php..."
curl -T wp-content/themes/rog/acf-fields-cake-pricing.php \
  ftp://${FTP_HOST}${FTP_PATH}/wp-content/themes/rog/ \
  --user ${FTP_USER}:${FTP_PASS}

# 5. cake-pricing.js (nowy plik)
echo "📤 Wgrywam cake-pricing.js..."
curl -T wp-content/themes/rog/js/cake-pricing.js \
  ftp://${FTP_HOST}${FTP_PATH}/wp-content/themes/rog/js/ \
  --user ${FTP_USER}:${FTP_PASS}

# 6. Instrukcja (opcjonalnie)
echo "📤 Wgrywam instrukcję..."
curl -T INSTRUKCJA-MODUL-CEN.md \
  ftp://${FTP_HOST}${FTP_PATH}/ \
  --user ${FTP_USER}:${FTP_PASS}

echo "✅ Gotowe! Wszystkie pliki wgrane."
echo ""
echo "🔍 Następne kroki:"
echo "1. Zaloguj się do panelu WordPress"
echo "2. Przejdź do: Ceny tortów"
echo "3. Skonfiguruj wielkości porcji"
echo "4. Przetestuj na przykładowym torcie"
