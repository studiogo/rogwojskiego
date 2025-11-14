# 📚 Instrukcja obsługi - Moduł cen tortów

## 🎯 Spis treści
1. [Konfiguracja globalna - wielkości porcji](#1-konfiguracja-globalna)
2. [Dodawanie ceny do tortu - tryb automatyczny](#2-tryb-automatyczny)
3. [Dodawanie ceny do tortu - tryb ręczny](#3-tryb-ręczny)
4. [Jak to działa na stronie](#4-jak-to-działa-na-stronie)
5. [FAQ - Często zadawane pytania](#5-faq)

---

## 1. Konfiguracja globalna - wielkości porcji

### Krok 1: Wejdź do panelu WordPress
1. Zaloguj się do panelu administratora WordPress
2. W menu bocznym znajdź: **Ceny tortów** (ikona tagu)
3. Kliknij, aby przejść do ustawień globalnych

### Krok 2: Dodaj wielkości porcji
W sekcji **"Wielkości porcji"** dodaj dostępne rozmiary tortów:

| Ilość porcji | Dopłata (zł) |
|--------------|--------------|
| 12           | 40           |
| 15           | 60           |
| 18           | 80           |
| 20           | 100          |

**Przykład:**
- Jeśli tort ma cenę bazową 120 zł
- Klient wybierze 12 porcji: cena = 120 + 40 = **160 zł**
- Klient wybierze 15 porcji: cena = 120 + 60 = **180 zł**

### Krok 3: Zapisz zmiany
Kliknij **"Zapisz zmiany"** na dole strony.

✅ **Gotowe!** Wielkości są teraz dostępne dla wszystkich tortów.

---

## 2. Tryb automatyczny (zalecany)

### Kiedy używać?
Gdy chcesz, aby cena tortu była **automatycznie kalkulowana** na podstawie:
- Ceny bazowej (np. 120 zł, 130 zł, 140 zł...)
- Dopłaty za wielkość (z ustawień globalnych)

### Jak skonfigurować?

#### Krok 1: Edytuj tort
1. Przejdź do **Produkty** → **Wszystkie produkty**
2. Wybierz tort, który chcesz edytować

#### Krok 2: Włącz moduł cen
W prawym panelu bocznym znajdziesz sekcję **"Ustawienia ceny tortu"**:

1. Włącz przełącznik: **"Włącz moduł cen"** → TAK
2. Wybierz tryb: **"Automatyczny"**
3. Wybierz **cenę bazową** z listy (np. 120 zł, 130 zł, 140 zł... 320 zł)

#### Krok 3: Zapisz
Kliknij **"Aktualizuj"** w prawym górnym rogu.

### Podgląd cen
Po zapisaniu, kliknij **"Podgląd"** aby zobaczyć tort na stronie:
- Wyświetli się: **"Od 120 zł"** (lub inna wybrana cena)
- W formularzu klient wybierze wielkość → cena się zaktualizuje

---

## 3. Tryb ręczny

### Kiedy używać?
Gdy chcesz **indywidualnie ustawić ceny** dla każdej wielkości tortu (np. dla tortów specjalnych).

### Jak skonfigurować?

#### Krok 1: Edytuj tort
1. Przejdź do **Produkty** → **Wszystkie produkty**
2. Wybierz tort, który chcesz edytować

#### Krok 2: Włącz tryb ręczny
W prawym panelu bocznym:

1. Włącz przełącznik: **"Włącz moduł cen"** → TAK
2. Wybierz tryb: **"Ręczny"**

#### Krok 3: Ustaw ceny dla każdej wielkości
Pojawi się tabela **"Ceny dla poszczególnych wielkości"**:

⚠️ **WAŻNE:** Kolejność wierszy musi odpowiadać kolejności wielkości w ustawieniach globalnych!

Przykład:
| Wiersz | Wielkość (z ustawień globalnych) | Cena końcowa (zł) |
|--------|----------------------------------|-------------------|
| 1      | 12 porcji                        | 180               |
| 2      | 15 porcji                        | 220               |
| 3      | 18 porcji                        | 260               |
| 4      | 20 porcji                        | 300               |

#### Krok 4: Zapisz
Kliknij **"Aktualizuj"**.

---

## 4. Jak to działa na stronie?

### Strona tortu (front-end)

**Jeśli tort MA cenę:**
- Wyświetla się: **"Od 120 zł"** (najniższa cena)
- Przycisk zmienia się na: **"Zamów teraz"**

**Jeśli tort NIE MA ceny:**
- Nie wyświetla się cena
- Przycisk: **"Zapytaj o cenę"** (bez zmian)

### Formularz zamówienia

**Jeśli tort MA cenę:**
1. Klient klika **"Zamów teraz"**
2. Otwiera się formularz z dodatkowymi polami:
   - **Wielkość tortu** (select) - wybór porcji
   - **Cena końcowa** (read-only) - automatycznie kalkulowana
3. Klient wybiera wielkość → cena się aktualizuje
4. Wysyłka formularza zawiera:
   - Nazwę tortu
   - Wybraną wielkość
   - Cenę końcową

**Jeśli tort NIE MA ceny:**
- Standardowy formularz bez pól wielkości/ceny

---

## 5. FAQ - Często zadawane pytania

### ❓ Jak dodać nową grupę cenową (np. 330 zł)?
Obecnie grupy są ustawione automatycznie (120-320 zł, co 10 zł).
Aby dodać nowe:
1. Edytuj plik: `wp-content/themes/rog/acf-fields-cake-pricing.php`
2. Znajdź sekcję `'choices' => array(`
3. Dodaj nowy wiersz: `'330' => '330 zł',`
4. Zapisz plik

### ❓ Jak zmienić dopłaty za wielkości?
1. Panel WordPress → **Ceny tortów**
2. Edytuj wartości w kolumnie **"Dopłata (zł)"**
3. Zapisz zmiany

### ❓ Mogę zmienić kolejność wielkości?
Tak, ale **UWAGA:**
- Zmiana kolejności wpłynie na torty z trybem ręcznym
- Upewnij się, że ceny nadal odpowiadają właściwym wielkościom

### ❓ Czy mogę ukryć cenę dla niektórych tortów?
Tak! Po prostu:
1. Edytuj tort
2. Ustaw **"Włącz moduł cen"** → NIE
3. Zapisz - tort będzie miał przycisk "Zapytaj o cenę"

### ❓ Jak dodać nową wielkość (np. 24 porcje)?
1. Panel WordPress → **Ceny tortów**
2. Kliknij **"Dodaj wielkość"**
3. Wpisz ilość porcji: **24**
4. Wpisz dopłatę: np. **120 zł**
5. Zapisz zmiany

---

## 🚀 Potrzebujesz pomocy?

Jeśli masz pytania lub problemy:
1. Sprawdź czy wszystkie pola są wypełnione
2. Odśwież stronę (Ctrl+F5)
3. Sprawdź w konsoli przeglądarki czy nie ma błędów (F12)

---

**Ostatnia aktualizacja:** 2025-11-14
**Wersja:** 1.0
