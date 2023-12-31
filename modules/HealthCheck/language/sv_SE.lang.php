<?php

/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

$mod_strings = array(
    'LBL_MODULE_NAME' => 'Hälsokontroll',
    'LBL_MODULE_NAME_SINGULAR' => 'Hälsokontroll',
    'LBL_MODULE_TITLE' => 'Hälsokontroll',
    'LBL_LOGFILE' => 'Loggfil',
    'LBL_BUCKET' => 'Hink',
    'LBL_FLAG' => 'Flagga',
    'LBL_LOGMETA' => 'Logga meta',
    'LBL_ERROR' => 'Fel',

    // Failure handling in SugarBPM upgraders
    'LBL_PA_UNSERIALIZE_DATA_FAILURE' => 'Den serialiserade datan kunde ej avserialiseras',
    'LBL_PA_UNSERIALIZE_OBJECT_FAILURE' => 'Den serialiserade datan kunde ej avserialieras eftersom den innehåller referenser till objekt eller klasser',

    'LBL_SCAN_101_LOG' => '% har studio historia',
    'LBL_SCAN_102_LOG' => '% har tillägg: %',
    'LBL_SCAN_103_LOG' => '% har anpassade vardefs',
    'LBL_SCAN_104_LOG' => '% har anpassade layoutdefs',
    'LBL_SCAN_105_LOG' => '% har anpassade viewdefs',

    'LBL_SCAN_201_LOG' => '% är inte ett stock modul',

    'LBL_SCAN_301_LOG' => '% som skall köras som BWC',
    'LBL_SCAN_302_LOG' => 'Okänd filvyer närvarande - % är inte en MB-modul',
    'LBL_SCAN_303_LOG' => 'Icke-tom formulärfil % - % är inte en MB-modul',
    'LBL_SCAN_304_LOG' => 'Okänd fil % - % är inte en MB-modul',
    'LBL_SCAN_305_LOG' => 'Dåliga vardefs - nyckel %, namn %',
    'LBL_SCAN_306_LOG' => 'Dåliga vardefs - relaterad fält % har tomma &#39;modul&#39;',
    'LBL_SCAN_307_LOG' => 'Dåliga vardefs - link % avser ogiltig relation',
    'LBL_SCAN_308_LOG' => 'Vardef HTML funktion i %',
    'LBL_SCAN_309_LOG' => 'Dårliga md5 för %',
    'LBL_SCAN_310_LOG' => 'Okänd fil % / %',
    'LBL_SCAN_311_LOG' => 'Vardef HTML-funktion % i $ modul modul för fält %',
    'LBL_SCAN_312_LOG' => 'Dåliga vardefs - &#39;namn&#39; fälttyp är ogiltigt  &#39;%&#39;, modul - &#39;%&#39;',
    'LBL_SCAN_313_LOG' => 'Förlängnings dir % upptäcks - % är inte en MB-modul',
    'LBL_SCAN_314_LOG' => "Dåliga vardefs - multienum fältet &#39;%&#39; med alternativ lista &#39;%&#39; nycklar innehåller oförenliga tecken - &#39;{%}&#39;",

    'LBL_SCAN_401_LOG' => 'Integration funnen för leverantörsfiler som flyttats till leverantör:'. PHP_EOL .'%s',
    'LBL_SCAN_402_LOG' => 'Dålig modul % - är inte i beanList och inte i filsystemet',
    'LBL_SCAN_403_LOG' => 'Specifika Sugarfiler hittades inkluderade för:' . PHP_EOL .'%s',
    'LBL_SCAN_520_LOG' => 'Logic hook after_ui_frame upptäckt',
    'LBL_SCAN_521_LOG' => 'Logic hook after_ui_footer upptäckt',
//    'LBL_SCAN_405_LOG' => 'Incompatible Integration - %s %s',
    'LBL_SCAN_406_LOG' => '% anpassade vyer utan support. Dessa anpassade visningsfiler kommer att flyttas till en inaktiverad directory under uppgraderingen',
    'LBL_SCAN_407_LOG' => '% anpassade vyer utan support. Dessa anpassade visningsfiler kommer att flyttas till en inaktiverad directory under uppgraderingen',
    'LBL_SCAN_408_LOG' => 'Anpassade komponenter för skapa-åtgärder hittades i %s. Komponenterna kommer att kopieras och modifieras för att utöka skapa-komponenten under uppgraderingen istället',
    'LBL_SCAN_409_LOG' => 'Dålig vardefs - ”link_file” har nedvärderats. Specificerad länkklass i "link_class" måste kunna läsas in automatiskt',
    'LBL_SCAN_519_LOG' => 'Förlängnings dir % upptäckt',
    'LBL_SCAN_518_LOG' => 'Hittade anpassad kod % i %, fil %',
    'LBL_SCAN_410_LOG' => 'Max fält - Hittade mer än % fält (%) i %',
    'LBL_SCAN_522_LOG' => 'Hittade &#39;get_subpanel_data&#39; med &#39;funktion&#39;: värde i %',
    'LBL_SCAN_412_LOG' => 'Dålig sub ​​panel länk % i %',
    'LBL_SCAN_413_LOG' => 'Okänd widget klass upptäcktes: % för %, modul % i fil %',
    'LBL_SCAN_414_LOG' => 'Okända områden som hanteras av CRYS-36, så inga fler kontroller här',
    'LBL_SCAN_415_LOG' => 'Dålig hook fil i %: %',
    'LBL_SCAN_523_LOG' => 'By-ref parameter i hook filen % funktion %',
    'LBL_SCAN_417_LOG' => 'Inkompatibel modul %',
    'LBL_SCAN_418_LOG' => 'Hittade underpanel med koppling till icke-existerande modul: %',
    'LBL_SCAN_419_LOG' => 'Dåliga vardefs - nyckel %, namn %',
    'LBL_SCAN_420_LOG' => 'Dåliga vardefs - relaterad fält % har tomma &#39;modul&#39;',
    'LBL_SCAN_421_LOG' => 'Dåliga vardefs - link % avser ogiltig relation',
    'LBL_SCAN_422_LOG' => 'Modulen %s har en definition av en annan modul (%s) i filen %s',
    'LBL_SCAN_525_LOG' => 'Vardef HTML funktion i %',
    'LBL_SCAN_423_LOG' => 'Dålig vardefs underfält - % refererar till dåliga underfält %',
    'LBL_SCAN_424_LOG' => 'Inline HTML funnit i % på rad %',
    'LBL_SCAN_425_LOG' => 'Hittade "echo" i % på rad %',
    'LBL_SCAN_426_LOG' => 'Hittade "print" i % på rad %',
    'LBL_SCAN_427_LOG' => 'Hittade "die/exit" i % på rad %',
    'LBL_SCAN_428_LOG' => 'Hittade "print_r" i % på rad %',
    'LBL_SCAN_429_LOG' => 'Hittade "var_dump" i % på rad %',
    'LBL_SCAN_430_LOG' => 'Hittade utgångs buffring (%) i % på rad %',
    'LBL_SCAN_431_LOG' => 'Anpassad Smarty-mall hittades: "%s"',
    'LBL_SCAN_436_LOG' => 'Anpassad PDF-mall hittades: "%s"',
    'LBL_SCAN_437_LOG' => 'Smarty-mall är inkompatibel med Smarty3-syntax: "%s"',
    'LBL_SCAN_438_LOG' => 'Anpassad PDF-mall hittades men den kan inte automatiskt konverteras till Smarty3-syntax: "%s"',
    'LBL_SCAN_439_LOG' => 'Mall är inkompatibel med Smarty3-syntax och hoppades över: "%s".',
    'LBL_SCAN_451_LOG' => 'AuthN kod raderades, använd \IdMSugarAuthenticate, \IdMSAMLAuthenticate, \IdMLDAPAuthenticate istället. Filer som använder raderad kod: ' . PHP_EOL . '%s',
    'LBL_SCAN_524_LOG' => 'Vardef HTML-funktion % i $ modul modul för fält %',
    'LBL_SCAN_432_LOG' => 'Dåliga vardefs - &#39;namn&#39; fälttyp är ogiltigt  &#39;%&#39;, modul - &#39;%&#39;',
    'LBL_SCAN_526_LOG' => "Dålig vardefs - multienum fältet &#39;%&#39; med alternativ lista &#39;%&#39; nycklar innehåller oförenliga tecken - &#39;%&#39;",
    'LBL_SCAN_527_LOG' => "Tabellnamn i bean % matchar inte tabell attribut i % vardefs.php",
    'LBL_SCAN_528_LOG' => 'Fältet % av % modulen har felaktig display_default värde',
    'LBL_SCAN_529_LOG' => '%s: %s i fil %s på rad %s',
    'LBL_SCAN_530_LOG' => 'Saknar anpassad fil: %s',
    'LBL_SCAN_531_LOG' => 'Föråldrad databasdrivrutin: %s',
    'LBL_SCAN_532_LOG' => 'En klass i %s kallar sin vanliga förälders konstruktor som %s::%s()',
    'LBL_SCAN_533_LOG' => 'En klass i %s kallar sin anpassade förälders konstruktor som %s::%s()',
    'LBL_SCAN_534_LOG' => 'Databasdrivrutin utan stöd: %s',
    'LBL_SCAN_535_LOG' => 'Unsupported method call: %s() in %s on line %s',
    'LBL_SCAN_536_LOG' => 'Unsupported property access: $%s in %s on line %s',
    'LBL_SCAN_433_LOG' => 'Hittade anpassade Elasticsearch-filer %s',
    'LBL_SCAN_434_LOG' => 'Hittade användning av array-funktioner på $_SESSION i filerna: %s',
    'LBL_SCAN_435_LOG' => 'Klassen SugarSession har tagits bort ur API: et, använd Sugarcrm\Sugarcrm\Session\SessionStorage istället. Filer som innehåller föråldrad kod: ' . PHP_EOL . '%s',
    'LBL_SCAN_550_LOG' => 'Användning av borttagna Sidecar app.date-API:er i %s',
    'LBL_SCAN_551_LOG' => 'Användning av borttagna Sidecar Bean-API:er i %s',
    'LBL_SCAN_560_LOG' => 'custom/modules/Quotes/quotes.js KAN innehålla anpassningar som inte är kompatibla med nya Offerter.',
    'LBL_SCAN_561_LOG' => 'custom/modules/Quotes/quotes.js KAN innehålla anpassningar som inte är kompatibla med nya Offerter.',
    'LBL_SCAN_562_LOG' => 'Use of removed Sidecar app.view.invokeParent method in %s',
    'LBL_SCAN_563_LOG' => 'Användning av inkompatibel monolog-anpassning: %s',
    'LBL_SCAN_564_LOG' => 'Användning av föråldrad DBAL-funktionalitet: %s',
    'LBL_SCAN_565_LOG' => 'Användning av inaktuell config-egenskap $sugar_config[&#39;passwordHash&#39;]. Från version 13.3 kommer den inte att stödjas: %s',
    'LBL_SCAN_566_LOG' => 'Användning av config-egenskap $sugar_config[&#39;passwordHash&#39;] som inte stöds: %s',
    'LBL_SCAN_570_LOG' => 'Ogiltig status och typ för e-post: status =%s, typ = %s',
    'LBL_SCAN_571_LOG' => 'Föråldrade filen har anpassningar: %s',
    'LBL_SCAN_572_LOG' => 'Anpassad fil har namnkonflikt: %s',
    'LBL_SCAN_573_LOG' => 'Anpassad hjälpfil har namnkonflikt: %s',
    'LBL_SCAN_574_LOG' => 'E-post panelundermeny finns anpassad katalog: %s',
    'LBL_SCAN_575_LOG' => 'Panelundermenyn Kontakter för e-post behöver ändras för att använda subpanel-for-contacts-archived-emails: %s',
    'LBL_SCAN_576_LOG' => 'Skin-anpassningar upptäcktes i: &#39;%s&#39;. Slutligt skin-resultat kanske inte fungerar som förväntat, kontrollera dina skin-anpassningar.',
    'LBL_SCAN_580_LOG' => 'Removed jQuery function(s) detected in: `%s`.',
    'LBL_SCAN_585_LOG' => 'Upptäckte förbjudna påståenden i `%s`: %s',
    'LBL_SCAN_586_LOG' => 'FontAwesome är föråldrad sedan 11.2 och kommer inte att stödjas i 12.0. Användning av FontAwesome har upptäckts i: %s',

    'LBL_SCAN_501_LOG' => 'Saknar fil: %',
    'LBL_SCAN_502_LOG' => 'md5 mismatch för %, förväntade %',
    'LBL_SCAN_503_LOG' => 'Anpassad modul med samma namn som nya Sugar 7 modul: %',
    'LBL_SCAN_504_LOG' => 'Fälttyp saknas i modul %: %',
    'LBL_SCAN_505_LOG' => 'Skriv förändring i % för fält %: från % till %',
    'LBL_SCAN_506_LOG' => '$this användning i %s',
    'LBL_SCAN_507_LOG' => 'Dålig vardefs underfält - % refererar till dåliga underfält %',
    'LBL_SCAN_508_LOG' => 'Inline HTML funnit i % på rad %',
    'LBL_SCAN_509_LOG' => 'Hittade "echo" i % på rad %',
    'LBL_SCAN_510_LOG' => 'Hittade "print" i % på rad %',
    'LBL_SCAN_511_LOG' => 'Hittade "die/exit" i % på rad %',
    'LBL_SCAN_512_LOG' => 'Hittade "print_r" i % på rad %',
    'LBL_SCAN_513_LOG' => 'Hittade "var_dump" i % på rad %',
    'LBL_SCAN_514_LOG' => 'Hittade utgångs buffring (%) i % på rad %',
    'LBL_SCAN_515_LOG' => 'Skript fel: %',
    'LBL_SCAN_516_LOG' => 'Tidigare borttagna filer hittades hänförd till: %',
    'LBL_SCAN_517_LOG' => 'Inkompatibel integration - % %',
    'LBL_SCAN_540_LOG' => 'Inkompatibel integrationsdata återställd - %s %s',
    'LBL_SCAN_541_LOG' => 'Ogiltig SugarBPM serialiseringar - %s ogiltig(a) serialisering(ar) i  kolumnen %s i tabellen %s: %s.',
    'LBL_SCAN_542_LOG' => 'Ogiltig SugarBPM fältanvändning - %s ogiltig(a) fält används i %s.',
    'LBL_SCAN_545_LOG' => 'SugarBPM delvis låst fältgrupp - Fältet %4$s är låst i gruppen %s i processdefinition %s för modulen %s.',
    'LBL_SCAN_546_LOG' => 'Anpassad TinyMCE-inställning för Kunskapsbasen',
    'LBL_SCAN_547_LOG' => 'Användning av borttagen &#39;resetLoadFlag&#39; signatur i %s',
    'LBL_SCAN_548_LOG' => 'Användning av föråldrade &#39;initButtons&#39; metod i %s',
    'LBL_SCAN_549_LOG' => 'Användning av borttagen &#39;getField&#39; signatur i %s',
    'LBL_SCAN_552_LOG' => 'Användning av borttagna Underscore API:er i %s',
    'LBL_SCAN_553_LOG' => 'Användning av borttagna Sidecar Bean-API:er i %s',
    'LBL_SCAN_554_LOG' => 'Sidecar-controllern %s sträcker sig från borttagen Sidecar-controller',

    'LBL_SCAN_901_LOG' => 'Instans redan uppgraderat till Sugar 7',
    'LBL_SCAN_903_LOG' => 'Ej supporterad Upgraderingsversion. Vänligen insatllera Upgrader SugarUpgradeWizardPrereq-to-%s',
    'LBL_SCAN_904_LOG' => 'Hittade NULL-värden i moduleList-strängarna. Fil: %s, Moduler: %s',
    'LBL_SCAN_999_LOG' => 'Okända fel, kontakta support',

    'LBL_SCAN_101_TITLE' => '% har studio historia',
    'LBL_SCAN_102_TITLE' => '% har tillägg: %',
    'LBL_SCAN_103_TITLE' => '% har anpassade vardefs',
    'LBL_SCAN_104_TITLE' => '% har anpassade layoutdefs',
    'LBL_SCAN_105_TITLE' => '% har anpassade viewdefs',

    'LBL_SCAN_201_TITLE' => '% är inte ett stock modul',

    'LBL_SCAN_301_TITLE' => '% som skall köras som BWC',
    'LBL_SCAN_302_TITLE' => 'Okänd filvyer närvarande - % är inte en MB-modul',
    'LBL_SCAN_303_TITLE' => 'Icke-tom formulärfil % - % är inte en MB-modul',
    'LBL_SCAN_304_TITLE' => 'Okänd fil % - % är inte en MB-modul',
    'LBL_SCAN_305_TITLE' => 'Dåliga vardefs - nyckel %, namn %',
    'LBL_SCAN_306_TITLE' => 'Dåliga vardefs - relaterad fält % har tomma &#39;modul&#39;',
    'LBL_SCAN_307_TITLE' => 'Dåliga vardefs - link % avser ogiltig relation',
    'LBL_SCAN_308_TITLE' => 'Vardef HTML funktion i %',
    'LBL_SCAN_309_TITLE' => 'Dårliga md5 för %',
    'LBL_SCAN_310_TITLE' => 'Okänd fil % / %',
    'LBL_SCAN_311_TITLE' => 'Vardef HTML-funktion % i $ modul modul för fält %',
    'LBL_SCAN_312_TITLE' => 'Dåliga vardefs - &#39;namn&#39; fälttyp är ogiltigt  &#39;%&#39;, modul - &#39;%&#39;',
    'LBL_SCAN_313_TITLE' => 'Förlängnings dir % upptäcks - % är inte en MB-modul',

    'LBL_SCAN_401_TITLE' => 'Integration funnen för leverantörsfiler som flyttats till leverantör:'. PHP_EOL .'%s',
    'LBL_SCAN_402_TITLE' => 'Dålig modul % - är inte i beanList och inte i filsystemet',
    'LBL_SCAN_403_TITLE' => 'Specifika Sugarfiler hittades inkluderade för:' . PHP_EOL .'%s',
    'LBL_SCAN_520_TITLE' => 'Logic hook after_ui_frame upptäckt',
    'LBL_SCAN_521_TITLE' => 'Logic hook after_ui_footer upptäckt',
//    'LBL_SCAN_405_TITLE' => 'Incompatible Integration - %s %s',
    'LBL_SCAN_406_TITLE' => '% anpassade vyer utan support. Dessa anpassade visningsfiler kommer att flyttas till en inaktiverad directory under uppgraderingen',
    'LBL_SCAN_407_TITLE' => '% anpassade vyer utan support. Dessa anpassade visningsfiler kommer att flyttas till en inaktiverad directory under uppgraderingen',
    'LBL_SCAN_408_TITLE' => 'Anpassade komponenter för skapa-åtgärder hittades som ej längre stöds.',
    'LBL_SCAN_409_TITLE' => 'Dålig vardefs - %s-modul har ogiltig vardefs för %s-fält.',
    'LBL_SCAN_519_TITLE' => 'Förlängnings dir % upptäckt',
    'LBL_SCAN_518_TITLE' => 'Hittade anpassad kod % i %, fil %',
    'LBL_SCAN_410_TITLE' => 'Max fält - Hittade mer än % fält (%) i %',
    'LBL_SCAN_522_TITLE' => 'Hittade &#39;get_subpanel_data&#39; med &#39;funktion&#39;: värde i %',
    'LBL_SCAN_412_TITLE' => 'Dålig sub ​​panel länk % i %',
    'LBL_SCAN_413_TITLE' => 'Okänd widget klass upptäcktes: % för %, modul % i fil %',
    'LBL_SCAN_414_TITLE' => 'Okända områden som hanteras av CRYS-36, så inga fler kontroller här',
    'LBL_SCAN_415_TITLE' => 'Dålig hook fil i %: %',
    'LBL_SCAN_523_TITLE' => 'By-ref parameter i hook filen % funktion %',
    'LBL_SCAN_417_TITLE' => 'Inkompatibel modul %',
    'LBL_SCAN_418_TITLE' => 'Hittade underpanel med koppling till icke-existerande modul: %',
    'LBL_SCAN_419_TITLE' => 'Dåliga vardefs - nyckel %, namn %',
    'LBL_SCAN_420_TITLE' => 'Dåliga vardefs - relaterad fält % har tomma &#39;modul&#39;',
    'LBL_SCAN_421_TITLE' => 'Dåliga vardefs - link % avser ogiltig relation',
    'LBL_SCAN_422_TITLE' => 'Modulen %s har en definition av en annan modul',
    'LBL_SCAN_525_TITLE' => 'Vardef HTML funktion i %',
    'LBL_SCAN_423_TITLE' => 'Dålig vardefs underfält - % refererar till dåliga underfält %',
    'LBL_SCAN_424_TITLE' => 'Inline HTML funnit i % på rad %',
    'LBL_SCAN_425_TITLE' => 'Hittade "echo" i % på rad %',
    'LBL_SCAN_426_TITLE' => 'Hittade "print" i % på rad %',
    'LBL_SCAN_427_TITLE' => 'Hittade "die/exit" i % på rad %',
    'LBL_SCAN_428_TITLE' => 'Hittade "print_r" i % på rad %',
    'LBL_SCAN_429_TITLE' => 'Hittade "var_dump" i % på rad %',
    'LBL_SCAN_430_TITLE' => 'Hittade utgångs buffring (%) i % på rad %',
    'LBL_SCAN_431_TITLE' => 'Anpassad Smarty-mall hittades: "%s"',
    'LBL_SCAN_436_TITLE' => 'Anpassad PDF-mall hittades: "%s"',
    'LBL_SCAN_437_TITLE' => 'Smarty-mall är inkompatibel med Smarty3-syntax: "%s"',
    'LBL_SCAN_438_TITLE' => 'Anpassad PDF-mall hittades men den kan inte automatiskt konverteras till Smarty3-syntax: "%s"',
    'LBL_SCAN_439_TITLE' => 'Mall är inkompatibel med Smarty3-syntax och hoppades över: "%s"',
    'LBL_SCAN_451_TITLE' => 'AuthN kod raderades, använd \IdMSugarAuthenticate, \IdMSAMLAuthenticate, \IdMLDAPAuthenticate istället. Filer som använder raderad kod: ' . PHP_EOL . '%s',
    'LBL_SCAN_524_TITLE' => 'Vardef HTML-funktion % i $ modul modul för fält %',
    'LBL_SCAN_432_TITLE' => 'Dåliga vardefs - &#39;namn&#39; fälttyp är ogiltigt  &#39;%&#39;, modul - &#39;%&#39;',
    'LBL_SCAN_433_TITLE' => 'Hittade anpassade Elasticsearch-filer %s',
    'LBL_SCAN_434_TITLE' => 'Hittade användning av array-funktioner på $_SESSION i filerna: %s',
    'LBL_SCAN_435_TITLE' => 'Hittade användning av den borttagna SugarSession-klassen',
    'LBL_SCAN_550_TITLE' => 'Användning av borttagna Sidecar app.date-API:er i %s',
    'LBL_SCAN_551_TITLE' => 'Användning av borttagna Sidecar Bean-API:er i %s',

    'LBL_SCAN_501_TITLE' => 'Saknar fil: %',
    'LBL_SCAN_502_TITLE' => 'md5 mismatch för %, förväntade %',
    'LBL_SCAN_503_TITLE' => 'Anpassad modul med samma namn som nya Sugar 7 modul: %',
    'LBL_SCAN_504_TITLE' => 'Fälttyp saknas i modul %: %',
    'LBL_SCAN_505_TITLE' => 'Skriv förändring i % för fält %: från % till %',
    'LBL_SCAN_506_TITLE' => '$this användning i %s',
    'LBL_SCAN_507_TITLE' => 'Dålig vardefs underfält - % refererar till dåliga underfält %',
    'LBL_SCAN_508_TITLE' => 'Inline HTML funnit i % på rad %',
    'LBL_SCAN_509_TITLE' => 'Hittade "echo" i % på rad %',
    'LBL_SCAN_510_TITLE' => 'Hittade "print" i % på rad %',
    'LBL_SCAN_511_TITLE' => 'Hittade "die/exit" i % på rad %',
    'LBL_SCAN_512_TITLE' => 'Hittade "print_r" i % på rad %',
    'LBL_SCAN_513_TITLE' => 'Hittade "var_dump" i % på rad %',
    'LBL_SCAN_514_TITLE' => 'Hittade utgångs buffring (%) i % på rad %',
    'LBL_SCAN_515_TITLE' => 'Skript fel: %',
    'LBL_SCAN_517_TITLE' => 'Inkompatibel integration - % %',
    'LBL_SCAN_526_TITLE' => "Dålig vardefs - multienum fältet &#39;%&#39; med alternativ lista &#39;%&#39; nycklar innehåller oförenliga tecken - &#39;%&#39;",
    'LBL_SCAN_528_TITLE' => 'Fältet % av % modulen har felaktig display_default värde',
    'LBL_SCAN_529_TITLE' => '%s: %s i fil %s på rad %s',
    'LBL_SCAN_530_TITLE' => 'Saknar anpassad fil: %s',
    'LBL_SCAN_531_TITLE' => 'Föråldrad databasdrivrutin: %s',
    'LBL_SCAN_532_TITLE' => 'Kall till PHP4-föräldrakonstruktor i %s',
    'LBL_SCAN_533_TITLE' => 'Kall till anpassad PHP4-föräldrakonstruktor i %s',
    'LBL_SCAN_534_TITLE' => 'Databasdrivrutin utan stöd: %s',
    'LBL_SCAN_535_TITLE' => 'Unsupported method call: %s()',
    'LBL_SCAN_536_TITLE' => 'Unsupported property access: $%s',
    'LBL_SCAN_540_TITLE' => 'Inkompatibel integrationsdata återställd - %s %s',
    'LBL_SCAN_541_TITLE' => 'Ogiltig SugarBPM serialisering - %s ogiltig(a) serialisering(ar) i  kolumnen %s i tabellen %s: %s',
    'LBL_SCAN_542_TITLE' => 'Ogiltig SugarBPM fältanvändning - %s ogiltig(a) fält används i %s.',
    'LBL_SCAN_545_TITLE' => 'SugarBPM delvis låst fältgrupp - %3$s modul: grupp %s är delvis låst i processdefinition %s.',
    'LBL_SCAN_546_TITLE' => 'Anpassad TinyMCE-inställning för Kunskapsbasen',
    'LBL_SCAN_547_TITLE' => 'Användning av borttagen &#39;resetLoadFlag&#39; signatur i %s',
    'LBL_SCAN_548_TITLE' => 'Användning av föråldrade &#39;initButtons&#39; metod i %s',
    'LBL_SCAN_549_TITLE' => 'Användning av borttagen &#39;getField&#39; signatur i %s',
    'LBL_SCAN_552_TITLE' => 'Användning av borttagna Underscore API:er i %s',
    'LBL_SCAN_553_TITLE' => 'Användning av borttagna Sidecar Bean-API:er i %s',
    'LBL_SCAN_554_TITLE' => 'Sidecar-controllern %s sträcker sig från borttagen Sidecar-controller',
    'LBL_SCAN_570_TITLE' => 'Oväntade värden finns i e-postmeddelanden',
    'LBL_SCAN_571_TITLE' => 'Anpassade filen innehåller kod som har upphört',
    'LBL_SCAN_572_TITLE' => 'Det finns en namnkonflikt med en anpassad fil',
    'LBL_SCAN_573_TITLE' => 'Det finns en namnkonflikt med en anpassad hjälpfil',
    'LBL_SCAN_574_TITLE' => 'Det finns anpassningar till e-posts panelundermeny',
    'LBL_SCAN_575_TITLE' => 'Det finns anpassningar till panelundermenyn Kontakter i e-post',
    'LBL_SCAN_576_TITLE' => 'Skin-anpassningar upptäcktes',
    'LBL_SCAN_580_TITLE' => 'Removed jQuery function(s) detected',
    'LBL_SCAN_585_TITLE' => 'Förbjudna påståenden har upptäckts',
    'LBL_SCAN_586_TITLE' => 'Föråldrad användning av FontAwesome har upptäckts',

    'LBL_SCAN_901_TITLE' => 'Instans redan uppgraderat till Sugar 7',
    'LBL_SCAN_903_TITLE' => 'Ej supporterad Upgraderingsversion',
    'LBL_SCAN_904_TITLE' => 'Hittade NULL-värden i moduleList-strängarna',
    'LBL_SCAN_999_TITLE' => 'Okända fel, kontakta support',

    'LBL_SCAN_101_DESCR' => 'Studio anpassningar upptäcktes på din instans. Vi räknar inte med några problem med dessa anpassningar och dina är anpassningar kan uppgraderas till Sugar 7.',
    'LBL_SCAN_102_DESCR' => 'Studio anpassningar upptäcktes på din instans. Vi räknar inte med några problem med dessa anpassningar och dina är anpassningar kan uppgraderas till Sugar 7.',
    'LBL_SCAN_103_DESCR' => 'Studio anpassningar upptäcktes på din instans. Vi räknar inte med några problem med dessa anpassningar och dina är anpassningar kan uppgraderas till Sugar 7.',
    'LBL_SCAN_104_DESCR' => 'Studio anpassningar upptäcktes på din instans. Vi räknar inte med några problem med dessa anpassningar och dina är anpassningar kan uppgraderas till Sugar 7.',
    'LBL_SCAN_105_DESCR' => 'Studio anpassningar upptäcktes på din instans. Vi räknar inte med några problem med dessa anpassningar och dina är anpassningar kan uppgraderas till Sugar 7.',

    'LBL_SCAN_201_DESCR' => 'Studio anpassningar upptäcktes på din instans. Vi räknar inte med några problem med dessa anpassningar och dina är anpassningar kan uppgraderas till Sugar 7.',

    'LBL_SCAN_301_DESCR' => 'Vissa anpassningar upptäcktes och är inte migrerat till Sugar 7. Denna modul (%) kommer att finnas tillgänglig, men det kommer att köras i Backwards Compatability läge på Sugar 7.',
    'LBL_SCAN_302_DESCR' => 'Okända filvisningar upptäcktes och var inte migrerat till Sugar 7. Denna modul (%) kommer att finnas tillgänglig, men det kommer att köras i Backwards Compatability läge på Sugar 7.',
    'LBL_SCAN_303_DESCR' => 'Icke-tomma formulärfiler upptäcktes och var inte migrerat till Sugar 7. Denna modul (%) kommer att finnas tillgänglig, men det kommer att köras i Bakåtkompatibilitet läge på Sugar 7.',
    'LBL_SCAN_304_DESCR' => 'Okända filer (%) upptäcktes och var inte migrerat till Sugar 7. Denna modul (%) kommer att finnas tillgänglig, men det kommer att köras i Backwards Compatability läge på Sugar 7.',
    'LBL_SCAN_305_DESCR' => 'Dålig vardefs (%: %) upptäcktes och var inte migrerat till Sugar 7. Denna anpassning kommer att vara tillgänglig, men det kommer att köras i  Backwards Compatability läge på Sugar 7.',
    'LBL_SCAN_306_DESCR' => 'Dålig vardefs upptäcktes och var inte migrerat till Sugar 7. Relaterad fält (%) har en tom &#39;modul&#39;. Denna anpassning kommer att vara tillgänglig, men det kommer att köras i  Backwards Compatability läge på Sugar 7.',
    'LBL_SCAN_307_DESCR' => 'Dålig vardefs upptäcktes och var inte migrerat till Sugar 7. Länken (%) avser en ogiltig relation. Denna anpassning kommer att vara tillgänglig, men det kommer att köras i Backwards Compatability läge i Sugar 7.',
    'LBL_SCAN_308_DESCR' => 'Vissa anpassningar upptäcktes och inte hade migrerats till Sugar 7. Denna modul (%) kommer att finnas tillgänglig, men det kommer att köras i Backwards Compatability läge i Sugar 7.',
    'LBL_SCAN_309_DESCR' => 'En MD5-hash för % matchar inte out of the box filen. Denna fil kan ha ändrats och kommer inte att uppgraderas till Sugar7',
    'LBL_SCAN_310_DESCR' => 'Okända vyfiler (%) upptäcktes och var inte migrerats till Sugar7. Denna modul (%) kommer att finnas tillgänglig, men det kommer att köras i Backwards Compatability Läge i Sugar 7.',
    'LBL_SCAN_311_DESCR' => 'Vissa anpassningar upptäcktes och inte hade migrerats till Sugar 7. Denna modul (%) kommer att finnas tillgänglig, men det kommer att köras i Backwards Compatability läge i Sugar 7.',
    'LBL_SCAN_312_DESCR' => 'Dålig vardefs upptäcktes och är inte migrerats till Sugar7. Dålig vardefs: &#39;name&#39; fälttyp är ogiltigt &#39;%&#39; för modulen &#39;%&#39;. Denna anpassning kommer att vara tillgänglig, men det kommer att köras i Backwards Kompatibilitesläge i Sugar7.',
    'LBL_SCAN_313_DESCR' => 'Extensions katalogen har upptäckas - % är inte en modul Builder modul. Denna modul kommer att fortsätta att finnas tillgänglig, men bara i Bakåtkompatibilitets läge.',

    'LBL_SCAN_401_DESCR' => 'Anpassad fil innehåller en fil som har flyttats till leverantör directory. Vi har försökt att vidta de korrigerande åtgärder och det krävs inga ytterligare åtgärder.',
    'LBL_SCAN_402_DESCR' => 'Dålig modul % - är inte i beanList och inte i filsystemet',
    'LBL_SCAN_403_DESCR' => 'Vissa Sugar-filer har flyttats i Windows 7. Vi måste rätta till deras include-sökvägar.',
    'LBL_SCAN_520_DESCR' => 'Denna logik hook stöds inte längre i Sugar 7',
    'LBL_SCAN_521_DESCR' => 'Denna logik hook stöds inte längre i Sugar 7',
//    'LBL_SCAN_405_DESCR' => 'Package detected which has been blacklisted as not supported in Sugar 7',
    'LBL_SCAN_406_DESCR' => 'Stock Sugar modul har utan stöd anpassade vyer i anpassad/modules/%/vyer. Dessa anpassade vyfiler kommer att flyttas till en inaktiverad directory under uppgraderingen',
    'LBL_SCAN_407_DESCR' => 'Stock Sugar modul har utan stöd anpassade vyer i anpassad/modules/%/vyer. Dessa anpassade vyfiler kommer att flyttas till en inaktiverad directory under uppgraderingen',
    'LBL_SCAN_408_DESCR' => 'Anpassade komponenter för skapa-åtgärder hittades i %s. Komponenterna kommer att kopieras och modifieras för att utöka skapa-komponenten under uppgraderingen istället',
    'LBL_SCAN_409_DESCR' => '”link_file”-attributet i vardefs har nedvärderats. Länkklassen måste kunna läsas in automatiskt',
    'LBL_SCAN_519_DESCR' => 'Stock Sugar-modulen har en av de förlängningar som vi inte stöder för uppgradering, till exempel anpassade routing, tillträdeskontroll, Javascript, etc.',
    'LBL_SCAN_518_DESCR' => 'De vardefs inkluderar användar anpassad kod definitioner som vi inte vet hur man omvandlar',
    'LBL_SCAN_410_DESCR' => 'För många fält i vyn',
    'LBL_SCAN_522_DESCR' => 'Underpanel data hämtas av en funktion, men vi stöder inte uppgradering av detta ännu.',
    'LBL_SCAN_412_DESCR' => 'Underpanelen hänvisar till en länk som inte finns eller är inte korrekt definierad',
    'LBL_SCAN_413_DESCR' => 'Fält hänvisar till et widget klassnamn som inte har matchande widget klassfil',
    'LBL_SCAN_414_DESCR' => 'Okända områden som hanteras av CRYS-36, så inga fler kontroller här',
    'LBL_SCAN_415_DESCR' => 'Logic hook hänvisar till en fil som inte finns',
    'LBL_SCAN_523_DESCR' => 'Gammal logik hook filen använder för-referensparameteröverföring, vilket kan leda till felmeddelanden som visas (och därmed förstöra REST)',
    'LBL_SCAN_417_DESCR' => 'Modul-feed eller iFrames upptäcks, som inte bör finns längre',
    'LBL_SCAN_418_DESCR' => 'Underpanelen hänvisar till en modul som inte existerar',
    'LBL_SCAN_419_DESCR' => 'Vardef nyckeln matchar inte vardef namn',
    'LBL_SCAN_420_DESCR' => 'Vardef innehåller relaterade fält som avser relationen som inte kan vara riktigt laddad',
    'LBL_SCAN_421_DESCR' => 'Vardef innehåller länkfält som inte kan bli ordentligt laddat',
    'LBL_SCAN_422_DESCR' => 'Modulen %s har en definition av en annan modul (%s) i filen %s',
    'LBL_SCAN_525_DESCR' => 'Vardef definierar enum som är ett resultat av HTML-funktion, vilket inte stöds för Sugar 7',
    'LBL_SCAN_423_DESCR' => 'Vardef definieras som sammansatta fält som innehåller underfält, och en av dessa underfält existerar faktiskt inte',
    'LBL_SCAN_424_DESCR' => 'Filen innehåller inline HTML',
    'LBL_SCAN_425_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_426_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_427_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_428_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion. Notera att print_r (..., sann) är tillåtet.',
    'LBL_SCAN_429_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_430_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_431_DESCR' => 'Det kommer att konverteras för att överensstämma med Smarty3-syntax',
    'LBL_SCAN_436_DESCR' => 'Det kommer att konverteras för att överensstämma med Smarty3-syntax',
    'LBL_SCAN_437_DESCR' => 'Det finns syntax i .tpl-filen som inte kan konverteras för att bli kompatibel med Smarty3. Korrigera den manuellt för att uppgradera instansen.',
    'LBL_SCAN_438_DESCR' => 'Det går inte att konvertera anpassad PDF-mall för att överensstämma med Smarty 3-syntaxen. Korrigera den manuellt för att uppgradera instansen.',
    'LBL_SCAN_439_DESCR' => 'Det finns syntax i .tpl-filen som inte kan konverteras för att bli kompatibel med Smarty3. Den hoppades över. Om syntaxen är en giltig Smarty-mall kan du korrigera den manuellt.',
    'LBL_SCAN_451_DESCR' => 'AuthN-koden raderades, använd \IdMSugarAuthenticate, \IdMSAMLAuthenticate, \IdMLDAPAuthenticate istället',
    'LBL_SCAN_524_DESCR' => 'Fält är definierad som funktion producerande HTML och kan inte automatiskt omvandlas (vi vet hur man omvandlar en del stock fält som mail och valuta)',
    'LBL_SCAN_432_DESCR' => 'Fältet "namn" har en typ annat än namn, fullständigt namn, varchar eller id typ',
    'LBL_SCAN_433_DESCR' => 'Hittade anpassade Elasticsearch-filer %s',
    'LBL_SCAN_434_DESCR' => 'Hittade användning av array-funktioner på $_SESSION i filerna: %s',
    'LBL_SCAN_550_DESCR' => 'Användning av borttagna Sidecar app.date-API:er i %s, denna kod kommer att migreras av uppgraderingsskript',
    'LBL_SCAN_551_DESCR' => 'Användning av borttagna Sidecar Bean-API:er i %s, denna kod kommer att migreras av uppgraderingsskript',

    'LBL_SCAN_501_DESCR' => 'En av kärn filerna finns inte i förekomst',
    'LBL_SCAN_502_DESCR' => 'En av de viktigaste filerna har ändrats i denna installation',
    'LBL_SCAN_503_DESCR' => 'Anpassad modul har samma namn som en av Sugars nya moduler',
    'LBL_SCAN_504_DESCR' => 'Vardef fältet definition utelämnar typ',
    'LBL_SCAN_505_DESCR' => 'Icke-blob fälttypen ändras till blob fältet. Detta är inte tillåtet eftersom blob typer inte kan indexeras och vi kan ha filter som bygger på at detta fält indexeras.',
    'LBL_SCAN_506_DESCR' => '$this används i metadatafilen. Eftersom metadatafilen laddas i annat sammanhang i Sugar 7, skulle det misslyckas.',
    'LBL_SCAN_507_DESCR' => 'Vardef definieras som sammansatta fält som innehåller underfält, och en av dessa underfält existerar faktiskt inte',
    'LBL_SCAN_508_DESCR' => 'Filen innehåller inline HTML',
    'LBL_SCAN_509_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_510_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_511_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_512_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion. Notera att print_r (..., sann) är tillåtet.',
    'LBL_SCAN_513_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_514_DESCR' => 'Koden innehåller denna utgång-produktionsfunktion',
    'LBL_SCAN_515_DESCR' => 'Kontroll av skriptet misslyckades, vilket innebär att instaScannerMeta.phpnce innehåller förmodligen dåligt PHP-kod som skriptet försökte ladda.',
    'LBL_SCAN_517_DESCR' => 'Paket upptäckt och svartlistat eftersom det inte stöds i Sugar 7',
    'LBL_SCAN_526_DESCR' => "Listan innehåller artikelnummer namn värden som hindrar uppgraderingen.",
    'LBL_SCAN_528_DESCR' => 'Datum/Tid fält med felaktig visning_standardvärde som -none-',
    'LBL_SCAN_529_DESCR' => 'Interpretern kan ge PHP-fel när den stöter på felaktig PHP-syntax eller om den stöter på körtidsproblem.',
    'LBL_SCAN_530_DESCR' => 'En fil som används i den anpassade koden finns inte tillgänglig i instansen.',
    'LBL_SCAN_531_DESCR' => '%s databasdrivrutinen är inaktuell. Vänligen överväg att använda %s istället.',
    'LBL_SCAN_532_DESCR' => 'En klass deklarerad i %s kallar sin vanliga förälders konstruktor som %s::%s()',
    'LBL_SCAN_533_DESCR' => 'En klass deklarerad i %s kallar sin anpassade förälders konstruktor som %s::%s()',
    'LBL_SCAN_534_DESCR' => '%s databasdrivrutinen är inaktuell. Vänligen överväg att använda %s istället.',
    'LBL_SCAN_535_DESCR' => 'A call to unsupported method %s() found in %s on line %d',
    'LBL_SCAN_536_DESCR' => 'Access to an unsupported property $%s found in %s on line %d',
    'LBL_SCAN_540_DESCR' => 'Paket upptäckt och svartlistat eftersom det inte stöds i den valda Sugar-versionen. Paketen måste avinstalleras OCH raderas innan uppgradering. Observera att tabellerna och datan som genererats av paketen och dess moduler kommer att raderas samtidigt vid avinstallationen.',
    'LBL_SCAN_541_DESCR' => 'Data har upptäckts i dina processhanteringstabeller som inte är serialiserbar eller konverterbar',
    'LBL_SCAN_542_DESCR' => 'Invalid fields have been found in your Process Management Business Rules and/or Actions. These fields must be removed from Business Rules and/or Actions in order to upgrade.',
    'LBL_SCAN_545_DESCR' => 'Ett grupperingsfält är delvis låst i en processdefinition. Dessa fält måste låsas upp i processen definitionen för att uppgraderingen ska gå vidare.',
    'LBL_SCAN_546_DESCR' => 'Kan inte migrera anpassade TinyMCE-inställningar i Kunskapsbasen. '
        . 'Parametern "tinyConfig" i %s-filen kommer att tömmas. '
        . 'Om du har anpassat TinyMCE borde du spara dina modifikationer innan du uppgraderar '
        . 'och lägga till dem manuellt efter uppgraderingen.',
    'LBL_SCAN_547_DESCR' => 'Användning av borttagen &#39;resetLoadFlag&#39; signatur i %s',
    'LBL_SCAN_548_DESCR' => 'Användning av föråldrade &#39;initButtons&#39; metod i %s',
    'LBL_SCAN_549_DESCR' => 'Användning av borttagen &#39;getField&#39; signatur i %s',
    'LBL_SCAN_552_DESCR' => 'Användning av borttagna Underscore API:er i %s',
    'LBL_SCAN_553_DESCR' => 'Användning av borttagna Sidecar Bean-API:er i %s',
    'LBL_SCAN_554_DESCR' => 'Sidecar-controllern %s sträcker sig från borttagen Sidecar-controller',

    'LBL_SCAN_901_DESCR' => 'Instans redan uppgraderat till Sugar 7',
    'LBL_SCAN_903_DESCR' => 'Ej supporterad Upgraderingsversion. Vänligen insatllera Upgrader SugarUpgradeWizardPrereq-to-%s',
    'LBL_SCAN_904_DESCR' => 'Fil: %s Moduler: %s',
    'LBL_SCAN_999_DESCR' => 'Okända fel, kontakta support',

    'LBL_SCAN_577_TITLE' => 'Inkompatibel databassortering',
    'LBL_SCAN_577_LOG' => "Sortering '%s' är oförenlig med '%s' teckenuppsättningen",
    'LBL_SCAN_577_DESCR' => "Välj en annan sortering i dina lokala inställningar, eller ta bort 'dbconfigoption.collation' konfigurationen för att använda den förinställda sorteringen.",

    'LBL_SCAN_578_TITLE' => 'Kunde inte radera temporär databastabell:%s',
    'LBL_SCAN_578_LOG' => 'Kunde inte radera temporär databastabell:%s',
    'LBL_SCAN_578_DESCR' => 'En temporär tabell skapades för säkert kontrollera om teckenuppsättnings konversion misslyckades att bli raderad under uppgradering och måste raderas manuellt',

    'LBL_SCAN_579_TITLE' => 'Oförmögen att utföra teckenuppsättning/sortering konversion: (%s) i tabell: %s',
    'LBL_SCAN_579_LOG' => 'Oförmögen att utföra teckenuppsättning/sortering konversion: (%s) i tabell: %s',
);
