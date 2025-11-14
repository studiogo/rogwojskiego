# 🚀 Konfiguracja GitHub Actions - Automatyczny deployment

## Krok 1: Dodaj sekrety do repozytorium GitHub

1. **Wejdź na GitHub.com** i zaloguj się
2. Przejdź do swojego repozytorium `studiogo/rogwojskiego`
3. Kliknij **Settings** (⚙️ w górnym menu)
4. W lewym menu kliknij **Secrets and variables** → **Actions**
5. Kliknij przycisk **New repository secret**

### Dodaj 4 sekrety (jeden po drugim):

#### Sekret 1: FTP_SERVER
- **Name:** `FTP_SERVER`
- **Secret:** `studiogo2.kylos.pl`
- Kliknij **Add secret**

#### Sekret 2: FTP_USERNAME
- **Name:** `FTP_USERNAME`
- **Secret:** `tort@studiogo2.kylos.pl`
- Kliknij **Add secret**

#### Sekret 3: FTP_PASSWORD
- **Name:** `FTP_PASSWORD`
- **Secret:** `VWQtABWMCvYpue2hxWQ3`
- Kliknij **Add secret**

#### Sekret 4: FTP_SERVER_DIR
- **Name:** `FTP_SERVER_DIR`
- **Secret:** `/home/studiog2/domains/torty.studiogo2.kylos.pl/public_html/`
- Kliknij **Add secret**

---

## Krok 2: Wrzuć workflow do repozytorium

Workflow już jest przygotowany w pliku `.github/workflows/deploy-ftp.yml`.

Wystarczy, że zrobisz:

```bash
git add .github/workflows/deploy-ftp.yml
git add GITHUB-ACTIONS-SETUP.md
git commit -m "Update GitHub Actions workflow with secrets"
git push origin main
```

**UWAGA:** Zmień `main` na `master` jeśli Twój główny branch nazywa się `master`.

---

## Krok 3: Testuj!

### Automatyczny deployment:
Od teraz każdy `git push` do brancha `main` (lub `master`) automatycznie wgra pliki na serwer FTP! 🎉

### Ręczny deployment:
Możesz też uruchomić deployment ręcznie:

1. Wejdź na GitHub → Twoje repo
2. Kliknij zakładkę **Actions**
3. Wybierz workflow **"Deploy to WordPress"**
4. Kliknij **Run workflow** → wybierz branch → **Run workflow**
5. Obserwuj postęp w czasie rzeczywistym

---

## 📊 Monitorowanie

### Jak sprawdzić czy deployment się udał?

1. GitHub → **Actions**
2. Zobaczysz listę wszystkich deploymentów
3. ✅ Zielony checkmark = sukces
4. ❌ Czerwony X = błąd (kliknij żeby zobaczyć logi)

---

## 🔒 Bezpieczeństwo

✅ Hasło FTP jest bezpieczne - zapisane jako sekret w GitHub
✅ Sekrety nie są widoczne w logach
✅ Tylko Ty (właściciel repo) możesz je zobaczyć/edytować

---

## ❓ FAQ

### Czy mogę zmienić hasło FTP później?
Tak! GitHub → Settings → Secrets → Edytuj `FTP_PASSWORD`

### Czy mogę wyłączyć automatyczny deployment?
Tak! Usuń sekcję `on: push:` z pliku `deploy-ftp.yml` - zostanie tylko ręczny deployment.

### Deployment nie działa - co robić?
1. Sprawdź zakładkę **Actions** - zobacz logi błędów
2. Sprawdź czy wszystkie 4 sekrety są dodane poprawnie
3. Sprawdź czy branch nazywa się `main` czy `master` (i dostosuj w workflow)

---

## ✅ Gotowe!

Po skonfigurowaniu sekretów, każdy push automatycznie wgra zmiany na serwer produkcyjny! 🚀
