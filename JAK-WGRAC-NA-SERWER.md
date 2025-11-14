# 🚀 Jak wgrać moduł cen tortów na serwer?

Masz **3 opcje** - wybierz najwygodniejszą dla Ciebie:

---

## ✅ **OPCJA 1: Automatyczny skrypt (ZALECANE - najszybsze)**

### **Windows:**
1. Otwórz PowerShell w folderze z projektem
2. Uruchom:
```powershell
.\upload-to-ftp.ps1
```

### **Mac/Linux:**
1. Otwórz Terminal w folderze z projektem
2. Nadaj uprawnienia:
```bash
chmod +x upload-to-ftp.sh
```
3. Uruchom:
```bash
./upload-to-ftp.sh
```

✅ **Gotowe!** Pliki są już na serwerze.

---

## ✅ **OPCJA 2: GitHub Actions (automatyczny deployment)**

Idealne jeśli chcesz, aby każda zmiana w kodzie automatycznie wgrywała się na serwer.

### Krok 1: Dodaj sekret FTP do GitHub

1. Wejdź na GitHub → Twoje repo
2. **Settings** → **Secrets and variables** → **Actions**
3. Kliknij **New repository secret**
4. Nazwa: `FTP_PASSWORD`
5. Wartość: `VWQtABWMCvYpue2hxWQ3`
6. Kliknij **Add secret**

### Krok 2: Wrzuć workflow do repo

```bash
git add .github/workflows/deploy-ftp.yml
git commit -m "Add automatic FTP deployment"
git push
```

### Krok 3: Testuj

Od teraz każdy `git push` automatycznie wgra pliki na serwer! 🎉

Możesz też uruchomić deployment ręcznie:
- GitHub → Twoje repo → **Actions** → **Deploy to WordPress FTP** → **Run workflow**

---

## ✅ **OPCJA 3: Ręczne wgranie przez FTP (FileZilla)**

Jeśli wolisz tradycyjnie:

### Dane FTP:
- **Host:** studiogo2.kylos.pl
- **Login:** tort@studiogo2.kylos.pl
- **Hasło:** VWQtABWMCvYpue2hxWQ3
- **Port:** 21 (FTP) lub 22 (SFTP)
- **Ścieżka:** /home/studiog2/domains/torty.studiogo2.kylos.pl/public_html

### Pliki do wgrania:

| Lokalny plik | Gdzie wgrać na serwerze |
|--------------|-------------------------|
| `wp-content/themes/rog/functions.php` | `wp-content/themes/rog/functions.php` |
| `wp-content/themes/rog/single-produkt.php` | `wp-content/themes/rog/single-produkt.php` |
| `wp-content/themes/rog/style.css` | `wp-content/themes/rog/style.css` |
| `wp-content/themes/rog/acf-fields-cake-pricing.php` | `wp-content/themes/rog/acf-fields-cake-pricing.php` ⭐ NOWY |
| `wp-content/themes/rog/js/cake-pricing.js` | `wp-content/themes/rog/js/cake-pricing.js` ⭐ NOWY |
| `INSTRUKCJA-MODUL-CEN.md` | `INSTRUKCJA-MODUL-CEN.md` (opcjonalnie) |

### Krok po kroku:

1. Pobierz **FileZilla** (https://filezilla-project.org/)
2. Połącz się z serwerem (wpisz dane FTP powyżej)
3. Po lewej: Twoje pliki lokalne
4. Po prawej: Serwer
5. Przeciągnij pliki z lewej na prawą stronę (do odpowiednich folderów)

---

## 🔍 Po wgraniu - CO DALEJ?

1. ✅ Zaloguj się do panelu WordPress
2. ✅ Przejdź do **Ceny tortów** (nowa pozycja w menu)
3. ✅ Dodaj wielkości porcji (np. 12, 15, 18, 20 porcji)
4. ✅ Edytuj przykładowy tort i włącz cenę
5. ✅ Sprawdź na stronie czy działa!

📖 Pełna instrukcja obsługi: **INSTRUKCJA-MODUL-CEN.md**

---

## ❓ Problemy?

### "Could not connect to server"
- Sprawdź czy masz połączenie z internetem
- Spróbuj użyć port 22 (SFTP) zamiast 21 (FTP)

### "Permission denied"
- Sprawdź czy hasło FTP jest poprawne
- Skontaktuj się z hostingiem (może być blokada IP)

### "File not found"
- Sprawdź czy jesteś w głównym folderze projektu (gdzie jest `wp-content`)

---

**Powodzenia! 🚀**
