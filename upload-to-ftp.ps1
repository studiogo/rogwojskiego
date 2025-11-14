# PowerShell skrypt do wgrania modułu cen na serwer FTP
# Dla użytkowników Windows

$FTP_HOST = "studiogo2.kylos.pl"
$FTP_USER = "tort"
$FTP_PASS = "VWQtABWMCvYpue2hxWQ3"
$FTP_PATH = "/home/studiog2/domains/torty.studiogo2.kylos.pl/public_html"

Write-Host "🚀 Wgrywanie modułu cen tortów na serwer..." -ForegroundColor Green

# Funkcja do wgrywania pliku
function Upload-File {
    param($LocalPath, $RemotePath)

    $webclient = New-Object System.Net.WebClient
    $webclient.Credentials = New-Object System.Net.NetworkCredential($FTP_USER, $FTP_PASS)

    $uri = "ftp://$FTP_HOST$FTP_PATH/$RemotePath"

    try {
        Write-Host "📤 Wgrywam $LocalPath..." -ForegroundColor Yellow
        $webclient.UploadFile($uri, $LocalPath)
        Write-Host "   ✅ OK" -ForegroundColor Green
    }
    catch {
        Write-Host "   ❌ Błąd: $_" -ForegroundColor Red
    }
}

# Wgrywanie plików
Upload-File "wp-content/themes/rog/functions.php" "wp-content/themes/rog/functions.php"
Upload-File "wp-content/themes/rog/single-produkt.php" "wp-content/themes/rog/single-produkt.php"
Upload-File "wp-content/themes/rog/style.css" "wp-content/themes/rog/style.css"
Upload-File "wp-content/themes/rog/acf-fields-cake-pricing.php" "wp-content/themes/rog/acf-fields-cake-pricing.php"
Upload-File "wp-content/themes/rog/js/cake-pricing.js" "wp-content/themes/rog/js/cake-pricing.js"
Upload-File "INSTRUKCJA-MODUL-CEN.md" "INSTRUKCJA-MODUL-CEN.md"

Write-Host ""
Write-Host "✅ Gotowe! Wszystkie pliki wgrane." -ForegroundColor Green
Write-Host ""
Write-Host "🔍 Następne kroki:" -ForegroundColor Cyan
Write-Host "1. Zaloguj się do panelu WordPress"
Write-Host "2. Przejdź do: Ceny tortów"
Write-Host "3. Skonfiguruj wielkości porcji"
Write-Host "4. Przetestuj na przykładowym torcie"
