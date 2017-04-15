eBank
=====

Welcome to the eBank test, this is a simple implemetation for eBanking.

Requirements
-------------

  - Composer
  - PHP 7.1
  - Apache
  - bower
  - TypeScript (developer mode)

Features
--------
  - As executive
    - Add Cardholder and account creation
    - Add Card for account (credit, debi)
  - As cashier
    - Add founds
  - User
    - Login with number card and NIP
    - Change NIP
    - Query transactions
    - Query balance

Notice
------

Mail Service is usign mailgun, it looks like the domain for sending
emails is a sandbox, the Client is getting a valid JSON response.
The authentication for executive and cashier is via HTTP basic
authentication

   - Card loaded: number/NIP 4111111111111111/1111
   - User executive: executive/executive
   - User cashier: cashier/cashier

Migrations and Translations
---------------------------

Translations files are missing, the english version don't is more
complete.

      # Load Database and data
    - bin/console doctrine:migrations:execute 20170413072204 --up
      # Extract translations
    - bin/console translation:extract {en|es} --config=app
