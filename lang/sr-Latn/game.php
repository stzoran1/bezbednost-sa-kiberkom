<?php

return [
    'title' => 'Dobro ili Loše? - Igra sa Kiberkom',
    'heading' => 'Dobro ili Loše?',
    'subheading' => 'Igra sa Kiberkom',
    'home' => 'Početna',
    'home_title' => 'Početna strana',

    'start' => [
        'welcome' => 'Dobrodošli u igru!',
        'instructions' => 'Unesite ime igrača ili tima da započnete.',
        'placeholder' => 'Ime igrača ili tima...',
        'button' => 'Započni igru',
    ],

    'show_leaderboard' => 'Pogledaj tabelu rezultata',
    'hide_leaderboard' => 'Sakrij tabelu rezultata',

    'results' => [
        'bravo' => 'Bravo, :name!',
        'score' => 'Tvoj rezultat:',
        'time' => 'Vreme:',
        'perfect' => 'Savršeno! Ti si pravi internet heroj!',
        'good' => 'Odlično! Znaš mnogo o bezbednosti na internetu!',
        'low' => 'Dobar početak! Pogledaj prezentaciju da naučiš još više!',
        'play_again' => 'Igraj ponovo',
        'new_player' => 'Novi igrač',
        'home' => 'Početna strana',
    ],

    'feedback' => [
        'correct' => 'Tačno!',
        'incorrect' => 'Nije tačno, ali ne brini — podsetićemo se zajedno!',
        'view_result' => 'Pogledaj rezultat',
        'next_question' => 'Sledeće pitanje',
    ],

    'question' => [
        'progress' => 'Pitanje :current od :total',
        'points' => 'Poeni:',
        'good' => 'Dobro',
        'bad' => 'Loše',
    ],

    'leaderboard' => [
        'title' => 'Tabela rezultata',
        'empty' => 'Još nema rezultata. Budi prvi!',
        'player' => 'Igrač / Tim',
        'result' => 'Rezultat',
        'time' => 'Vreme',
        'played_at' => 'Datum',
        'reset_success' => 'Tabela rezultata je uspešno obrisana!',
        'reset_placeholder' => 'Unesite lozinku...',
        'reset_confirm' => 'Potvrdi',
        'reset_button' => 'Obriši tabelu rezultata',
        'reset_error' => 'Pogrešna lozinka!',
        'more_players_needed' => 'Još igrača treba da se pridruži! Igraj i osvoji mesto na tabeli.',
    ],

    'validation' => [
        'player_name_required' => 'Ime igrača je obavezno.',
        'player_name_min' => 'Ime mora imati najmanje :min karaktera.',
        'player_name_max' => 'Ime ne sme biti duže od :max karaktera.',
        'player_name_unique' => 'Igrač sa ovim imenom već postoji. Izaberi drugo ime.',
    ],

    'scenarios' => [
        [
            'text' => 'Davanje kućne adrese nepoznatoj osobi na internetu',
            'answer' => false,
            'explanation' => 'Adresa je lični podatak! Nikada je ne deli sa nepoznatim osobama na internetu.',
        ],
        [
            'text' => 'Prijavljivanje čudne poruke mami ili tati',
            'answer' => true,
            'explanation' => 'Odlično! Uvek reci odrasloj osobi ako dobiješ čudnu poruku.',
        ],
        [
            'text' => 'Prihvatanje zahteva za prijateljstvo od nepoznate osobe',
            'answer' => false,
            'explanation' => 'Ne prihvataj zahteve od nepoznatih osoba! Ne znamo ko se krije iza ekrana.',
        ],
        [
            'text' => 'Korišćenje jake lozinke sa slovima i brojevima',
            'answer' => true,
            'explanation' => 'Super! Jake lozinke čuvaju tvoje naloge bezbednim.',
        ],
        [
            'text' => 'Slanje svoje fotografije nepoznatoj osobi na internetu',
            'answer' => false,
            'explanation' => 'Nikada ne šalji svoje fotografije nepoznatim osobama! To nije bezbedno.',
        ],
        [
            'text' => 'Pitanje roditelja pre instaliranja nove aplikacije',
            'answer' => true,
            'explanation' => 'Bravo! Uvek pitaj roditelje pre nego što instaliraš nešto novo.',
        ],
        [
            'text' => 'Deljenje lozinke sa drugom iz škole',
            'answer' => false,
            'explanation' => 'Lozinka je kao ključ od kuće — ne deli je ni sa kim osim sa roditeljima!',
        ],
        [
            'text' => 'Ljubazno ponašanje prema drugima u online igrama',
            'answer' => true,
            'explanation' => 'Fantastično! Lepo ponašanje na internetu je jednako važno kao i uživo.',
        ],
        [
            'text' => 'Odlazak na susret sa internet poznanikom bez roditelja',
            'answer' => false,
            'explanation' => 'Nikada ne idi sam na susret sa osobama sa interneta! Uvek povedi roditelja.',
        ],
        [
            'text' => 'Javljanje odrasloj osobi kad te nešto uplaši na internetu',
            'answer' => true,
            'explanation' => 'Tačno! Odrasli su tu da ti pomognu i nećeš biti u nevolji.',
        ],
        [
            'text' => 'Otvaranje linkova od nepoznatih osoba',
            'answer' => false,
            'explanation' => 'Nepoznati linkovi mogu biti opasni! Mogu da sadrže viruse ili prevare.',
        ],
        [
            'text' => 'Pisanje ružnih komentara drugom detetu na internetu',
            'answer' => false,
            'explanation' => 'Ružni komentari na internetu su sajber nasilje. Budi ljubazan kao i uživo!',
        ],
        [
            'text' => 'Upozoravanje druga da prestane sa ružnim porukama',
            'answer' => true,
            'explanation' => 'Bravo! Kada vidiš sajber nasilje, važno je da reaguješ i pomogneš.',
        ],
        [
            'text' => 'Korišćenje iste lozinke za sve naloge',
            'answer' => false,
            'explanation' => 'Svaki nalog treba da ima svoju lozinku. Ako neko sazna jednu, sve su u opasnosti!',
        ],
        [
            'text' => 'Pitanje roditelja pre igranja nove online igre',
            'answer' => true,
            'explanation' => 'Odlično! Roditelji ti mogu pomoći da proveriš da li je igra bezbedna za tebe.',
        ],
        [
            'text' => 'Objavljivanje slike na kojoj se vidi ime škole',
            'answer' => false,
            'explanation' => 'Slike mogu otkriti tvoju lokaciju! Pazi šta se vidi na fotografijama koje deliš.',
        ],
        [
            'text' => 'Isključivanje lokacije na telefonu prilikom slikanja',
            'answer' => true,
            'explanation' => 'Pametno! Lokacija na slikama može otkriti gde se nalaziš.',
        ],
        [
            'text' => 'Davanje ličnih podataka za besplatan poklon na internetu',
            'answer' => false,
            'explanation' => 'Besplatni pokloni na internetu su često prevare! Nikada ne daj lične podatke.',
        ],
        [
            'text' => 'Ćutanje o uznemiravanju na internetu',
            'answer' => false,
            'explanation' => 'Nemoj ćutati! Uvek reci odrasloj osobi ako te neko uznemirava na internetu.',
        ],
        [
            'text' => 'Blokiranje osobe koja šalje neprijatne poruke',
            'answer' => true,
            'explanation' => 'Tačno! Blokiranje je dobar prvi korak, a zatim reci odrasloj osobi.',
        ],
        // Phishing / scam recognition
        [
            'text' => 'Otvaranje linka u poruci koja kaže da si osvojio telefon u nagradnoj igri',
            'answer' => false,
            'explanation' => 'To je prevara! Niko ne poklanja telefone preko poruka. Obriši takvu poruku.',
        ],
        [
            'text' => 'Popunjavanje ankete koja obećava besplatnu igru ako uneseš podatke roditelja',
            'answer' => false,
            'explanation' => 'To je trik za krađu podataka! Nikada ne unosite tuđe podatke bez dozvole.',
        ],
        // Safe browsing habits
        [
            'text' => 'Preuzimanje programa sa nepoznatog sajta umesto iz zvanične prodavnice',
            'answer' => false,
            'explanation' => 'Programi sa nepoznatih sajtova mogu sadržati viruse! Koristi samo zvanične prodavnice.',
        ],
        // Screen time awareness
        [
            'text' => 'Pravljenje pauze od ekrana posle svakog sata igranja',
            'answer' => true,
            'explanation' => 'Super! Pauze su važne za tvoje oči, telo i mozak. Izađi napolje i igraj se!',
        ],
        [
            'text' => 'Igranje igrica cele noći umesto spavanja',
            'answer' => false,
            'explanation' => 'San je veoma važan za tvoje zdravlje! Ugasi ekran na vreme i dobro se naspavaj.',
        ],
        // Digital footprint
        [
            'text' => 'Razmišljanje o tome da li će ti biti neprijatno ako učiteljica vidi tvoju objavu',
            'answer' => true,
            'explanation' => 'Odlično pravilo! Sve što postaviš na internet može ostati zauvek. Razmisli pre nego što objaviš.',
        ],
        [
            'text' => 'Objavljivanje video snimka druga bez njegovog znanja',
            'answer' => false,
            'explanation' => 'Uvek pitaj za dozvolu pre nego što objaviš nešto o drugima! To je pitanje poštovanja.',
        ],
        // Reporting mechanisms (Safe Line 19833)
        [
            'text' => 'Pozivanje broja 19833 (Siguran kontakt) kada ti treba pomoć na internetu',
            'answer' => true,
            'explanation' => 'Tačno! Broj 19833 je besplatna linija gde možeš da prijaviš probleme i dobiješ pomoć.',
        ],
        [
            'text' => 'Korišćenje dugmeta „Prijavi" kada vidiš uvredljiv sadržaj na internetu',
            'answer' => true,
            'explanation' => 'Bravo! Prijavljivanje lošeg sadržaja pomaže da internet bude bezbednije mesto za sve.',
        ],
        // Peer pressure online
        [
            'text' => 'Odbijanje izazova na internetu koji može biti opasan, čak i kada te drugari nagovaraju',
            'answer' => true,
            'explanation' => 'Hrabro! Pravi prijatelji te neće terati da radiš opasne stvari. Tvoja bezbednost je najvažnija.',
        ],
        [
            'text' => 'Slanje neprimerene poruke jer su svi drugari to uradili',
            'answer' => false,
            'explanation' => 'Samo zato što drugi to rade ne znači da je ispravno! Uvek razmisli svojom glavom.',
        ],
        // Age-appropriate social media use
        [
            'text' => 'Laganje o godinama da bi otvorio nalog na društvenoj mreži',
            'answer' => false,
            'explanation' => 'Laganje o godinama te izlaže sadržaju koji nije za tvoj uzrast. Pravila postoje sa razlogom!',
        ],
    ],
];
