# Kiberko - Digitalna bezbednost za decu

Kiberko je interaktivna edukativna web aplikacija koja uci decu o digitalnoj bezbednosti kroz igru, prezentaciju i informativne materijale. Maskota projekta je Kiberko - prijateljski lik koji vodi decu kroz sadrzaj.

## Funkcionalnosti

- **Kviz igra** - Interaktivni kviz sa pitanjima o digitalnoj bezbednosti, tabela rezultata (leaderboard)
- **SlideWire prezentacija** - Edukativna prezentacija o bezbednom koriscenju interneta
- **PDF flajer** - Stampani materijal sa savetima za digitalnu bezbednost
- **Visejezicna podrska** - Srpski latinica (sr-Latn), srpski cirilica (sr-Cyrl), ruski (ru)

## Tehnologije

- PHP 8.4 / Laravel 13
- Livewire 4
- Tailwind CSS 4
- Vite 6
- SQLite
- Pest PHP 4

## Preduslovi

- PHP 8.4+
- Composer
- Node.js / NPM

## Instalacija

Klonirajte repozitorijum i pokrenite setup komandu koja instalira zavisnosti, kreira `.env` fajl, generise kljuc aplikacije, pokrece migracije i bilduje frontend:

```bash
git clone <repo-url>
cd project-path
composer run setup
```

## Razvoj

Pokrenite razvojni server (Laravel server, queue worker, Pail log viewer i Vite dev server istovremeno):

```bash
composer run dev
```

## Testiranje

```bash
composer run test
```

## Produkcioni build

```bash
npm run build
```

## Struktura projekta

```
app/
  Http/Controllers/    # Kontroleri
  Livewire/            # Livewire komponente (ne koristi se direktno - pogledaj resources/views)
  Models/              # Eloquent modeli (GameScore, User)
resources/
  views/
    components/        # Blade komponente (igra, slides, layout, mascot)
    pages/             # Stranice (igra)
    pdf/               # PDF flajer sablon
    welcome.blade.php  # Pocetna stranica
lang/
  sr-Latn/             # Prevodi - srpski latinica (podrazumevano)
  sr-Cyrl/             # Prevodi - srpski cirilica
  ru/                  # Prevodi - ruski
routes/
  web.php              # Web rute sa podrskom za lokalizaciju
database/              # Migracije, fabrike, seederi
tests/                 # Pest PHP testovi
```

## Licenca

Ovaj projekat koristi [MIT licencu](https://opensource.org/licenses/MIT).
