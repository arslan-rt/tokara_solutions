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
/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$mod_strings = array(

	'LBL_ASSIGN_TEAM'		=> 'Priradiť tímom',

	'LBL_RE'					=> 'RE:',

	'ERR_BAD_LOGIN_PASSWORD'=> 'Prihlásenie alebo heslo nie je správne',
	'ERR_BODY_TOO_LONG'		=> '\rText v tele je príliš dlhý na zaznamenanie CELÉHO e-mailu. Nadbytočný text bol odstránený.',
	'ERR_INI_ZLIB'			=> 'Dočasne sa nepodarilo vypnúť Zlib kompresiu. "Nastavenia testu" môžu zlyhať.',
	'ERR_MAILBOX_FAIL'		=> 'Nepodarilo sa načítať žiadne e-mailové účty.',
	'ERR_NO_IMAP'			=> 'Nepodarilo sa nájsť žiadne IMAP knižnice. Vyriešte tento problém pred tým, ako budete pokračovať s prichádzajúcimi e-mailami',
    'ERR_NO_OPTS_SAVED' => 'Žiadne optimá neboli uložené s vaším účtom prichádzajúcej pošty. Skontrolujte nastavenia',
	'ERR_TEST_MAILBOX'		=> 'Skontrolujte nastavenia a skúste to znova.',
    'ERR_DELETE_FOLDER' => 'Priečinok sa nepodarilo odstrániť.',
    'ERR_UNSUBSCRIBE_FROM_FOLDER' => 'Pred vymazaním sa z priečinka nepodarilo odhlásiť.',

	'LBL_APPLY_OPTIMUMS'	=> 'Použiť optimá',
	'LBL_ASSIGN_TO_USER'	=> 'Priradiť používateľovi',
	'LBL_AUTOREPLY_OPTIONS'	=> 'Možnosť automatickej odpovede',
	'LBL_AUTOREPLY'			=> 'Šablóna automatickej odpovede',
	'LBL_AUTOREPLY_HELP'	=> 'Vyberte automatickú odpoveď, ktorá odosielateľom e-mailu potvrdí, že ich správa s odpoveďou bola prijatá.',
	'LBL_BASIC'				=> 'Informácie o e-mailovom účte',
	'LBL_CASE_MACRO'		=> 'Makro pre prípady',
	'LBL_CASE_MACRO_DESC'	=> 'Nastavte makro, ktoré bude analyzované a používané na prepojenie importovaných e-mailov k prípadu.',
	'LBL_CASE_MACRO_DESC2'	=> 'Nastavte hocijakú hodnotu, ale zachovajte <b>"%1"</b>.',
	'LBL_CERT_DESC'			=> 'Vynútiť overenie platnosti bezpečnostného certifikátu e-mailového servera – nepoužívajte túto možnosť, ak sa prihlasujete sami.',
	'LBL_CERT'				=> 'Schváliť platnosť certifikát',
	'LBL_CLOSE_POPUP'		=> 'Zavrieť okno',
	'LBL_CREATE_NEW_GROUP'	=> '--Vytvoriť skupinu na uloženie--',
	'LBL_CREATE_TEMPLATE'	=> 'Vytvoriť',
	'LBL_SUBSCRIBE_FOLDERS'	=> 'Prihlásiť priečinky',
	'LBL_DEFAULT_FROM_ADDR'	=> 'Prednastavenie:',
	'LBL_DEFAULT_FROM_NAME'	=> 'Prednastavenie: ',
	'LBL_DELETE_SEEN'		=> 'Vymazať prečítané e-maily po importovaní',
	'LBL_EDIT_TEMPLATE'		=> 'Upraviť',
	'LBL_EMAIL_OPTIONS'		=> 'Možnosti zaobchádzania s e-mailami',
	'LBL_EMAIL_BOUNCE_OPTIONS' => 'Možnosti spracovania vrátenej pošty',
    'LBL_FILTER_DOMAINS_DESC'=> 'Zoznam domén oddelených čiarkou, ktorým sa nebudú posielať e-maily s automatickou odpoveďou.',
	'LBL_ASSIGN_TO_GROUP_FOLDER_DESC'=> 'Vyberte možnosť automaticky v aplikácii Sugar vytvárať záznamy e-mailov pre všetky prichádzajúce e-maily.',
	'LBL_POSSIBLE_ACTION_DESC'		=> 'Pre možnosť vytvorenia prípadu musí byť vybratý priečinok skupiny',
    'LBL_FILTER_DOMAINS'    => 'Žiadna automatická odpoveď na túto doménu',
	'LBL_FIND_OPTIMUM_KEY'	=> 'f',
	'LBL_FIND_OPTIMUM_MSG'	=> '<br>Hľadanie optimálnych premenných pripojení.',
	'LBL_FIND_OPTIMUM_TITLE'=> 'Nájsť optimálnu konfiguráciu',
	'LBL_FIND_SSL_WARN'		=> '<br>Testovanie SSL môže trvať dlhší čas. Ďakujeme za trpezlivosť.<br>',
	'LBL_FORCE_DESC'		=> 'Niektoré IMAP/POP3 servery vyžadujú špeciálne prepínače. Skontrolujte vynútenie negatívneho prepínača pri pripojení (napr., /notls)',
	'LBL_FORCE'				=> 'Vynútiť negatívny',
	'LBL_FOUND_MAILBOXES'	=> 'Našli sa nasledujúce použiteľné priečinky. <br>Ak chcete niektorý vybrať, kliknite naň:',
	'LBL_FOUND_OPTIMUM_MSG'	=> '<br>Našli sa optimálne nastavenia. Stlačte tlačidlo nižšie, ak ich chcete aplikovať na svoj e-mailový účet.',
	'LBL_FROM_ADDR'			=> 'Adresa pre "Odosielateľ"',
    // as long as XTemplate doesn't support output escaping, transform
    // quotes to html-entities right here (bug #48913)
    'LBL_FROM_ADDR_DESC'    => "V dôsledku obmedzení stanovených poskytovateľom služby e-mailu sa tu uvedená e-mailová adresa nemusí zobrazovať v časti pre adresu &quot;Odosielateľ&quot; v odoslanom e-maile. V takýchto prípadoch sa použije e-mailová adresa definovaná na serveri pre odchádzajúcu poštu.",
	'LBL_FROM_NAME_ADDR'	=> 'Od Meno/e-mail',
	'LBL_FROM_NAME'			=> 'Meno pre "Odosielateľ"',
	'LBL_GROUP_QUEUE'		=> 'Priradiť skupine',
    'LBL_HOME'              => 'Domov',
	'LBL_LIST_MAILBOX_TYPE'	=> 'Používanie e-mailového účtu',
	'LBL_LIST_NAME'			=> 'Názov:',
	'LBL_LIST_GLOBAL_PERSONAL'			=> 'Typ',
	'LBL_LIST_SERVER_URL'	=> 'E-mailový server',
	'LBL_LIST_STATUS'		=> 'Stav',
	'LBL_LOGIN'				=> 'Užívateľské meno',
	'LBL_MAILBOX_DEFAULT'	=> 'DORUČENÁ POŠTA',
	'LBL_MAILBOX_SSL_DESC'	=> 'Pri pripájaní použite SSL. V prípade problémov skontrolujte, či vaša PHP inštalácia v konfigurácii zahŕňa "--with-imap-ssl".',
	'LBL_MAILBOX_SSL'		=> 'Použiť SSL',
	'LBL_MAILBOX_TYPE'		=> 'Možné akcie',
	'LBL_DISTRIBUTION_METHOD' => 'Distribučná metóda',
	'LBL_CREATE_CASE_REPLY_TEMPLATE' => 'Nová šablóna automatických odpovedí',
	'LBL_CREATE_CASE_REPLY_TEMPLATE_HELP' => 'Vyberte možnosť automatickej odpovede, ktorou sa odosielateľom e-mailov potvrdí, že prípad bol vytvorený. E-mail zahŕňa číslo prípadu v riadku Predmet, ktoré je v súlade s nastaveniami makra pre prípady. Táto odpoveď sa zašle len pri prijatí prvého e-mailu príjemcom.',
	'LBL_MAILBOX'			=> 'Monitorované priečinky',
	'LBL_TRASH_FOLDER'		=> 'Priečinok Kôš',
	'LBL_GET_TRASH_FOLDER'	=> 'Získať priečinok Kôš',
	'LBL_SENT_FOLDER'		=> 'Priečinok Odoslané',
	'LBL_GET_SENT_FOLDER'	=> 'Získať priečinok Odoslané',
	'LBL_SELECT'				=> 'Vybrať',
	'LBL_MARK_READ_DESC'	=> 'Pri importe označiť správy na servere ako prečítané, nemažte správy.',
	'LBL_MARK_READ_NO'		=> 'Po importe sa e-maily označia ako vymazané',
	'LBL_MARK_READ_YES'		=> 'E-maily po importe zostanú na serveri',
	'LBL_MARK_READ'			=> 'Ponechať správy na serveri',
	'LBL_MAX_AUTO_REPLIES'	=> 'Počet automatických odpovedí',
	'LBL_MAX_AUTO_REPLIES_DESC'	=> 'Nastavte maximálny počet automatických odpovedí na odoslanie na jedinečnú e-mailovú adresu počas 24 hodinového intervalu.',
	'LBL_PERSONAL_MODULE_NAME' => 'Osobný e-mailový účet',
	'LBL_PERSONAL_MODULE_NAME_SINGULAR' => 'Osobný e-mailový účet',
	'LBL_CREATE_CASE'      => 'Vytvoriť prípad z e-mailu',
	'LBL_CREATE_CASE_HELP'  => 'Vyberte možnosť v aplikácii Sugar automaticky vytvárať záznamy prípadov z prichádzajúcich e-mailov.',
	'LBL_MODULE_NAME'		=> 'Prichádzajúci e-mail',
	'LBL_MODULE_NAME_SINGULAR' => 'Prichádzajúci e-mail',
	'LBL_BOUNCE_MODULE_NAME' => 'Poštová schránka na spracovanie vrátenej pošty',
	'LBL_MODULE_TITLE'		=> 'Prichádzajúci e-mail',
	'LBL_NAME'				=> 'Názov',
    'LBL_NONE'              => 'Žiadne',
	'LBL_NO_OPTIMUMS'		=> 'Nepodarilo sa nájsť optimá. Skontrolujte svoje nastavenia a skúste to znovu.',
	'LBL_ONLY_SINCE_DESC'	=> 'Keď používate POP3, PHP nemôže filtrovať Nové/Neprečítané správy. Táto vlajka umožňuje požiadavke skontrolovať správy od momentu, keď bol e-mailový účet naposledy kontrolovaný. Tento postup výrazne zvýši váš výkon, ak váš e-mailový server nepodporuje IMAP.',
	'LBL_ONLY_SINCE_NO'		=> 'Nie. Skontrolovať všetky e-maily na serveri.',
	'LBL_ONLY_SINCE_YES'	=> 'Áno.',
	'LBL_ONLY_SINCE'		=> 'Importovať iba od poslednej kontroly:',
	'LBL_OUTBOUND_SERVER'	=> 'Server pre odchádzajúcu poštu',
	'LBL_PASSWORD_CHECK'	=> 'Kontrola hesla',
	'LBL_PASSWORD'			=> 'Heslo',
	'LBL_POP3_SUCCESS'		=> 'Vaše testovacie pripojenie POP3 prebehlo úspešne.',
	'LBL_POPUP_FAILURE'		=> 'Testovacie pripojenie zlyhalo. Chyba je zobrazená nižšie.',
	'LBL_POPUP_SUCCESS'		=> 'Testovacie pripojenie prebehlo úspešne. Vaše nastavenia fungujú.',
	'LBL_POPUP_TITLE'		=> 'Nastavenia testu',
	'LBL_GETTING_FOLDERS_LIST' 		=> 'Prebieha získanie zoznamu priečinkov',
	'LBL_SELECT_SUBSCRIBED_FOLDERS' 		=> 'Vyberte odoberaný priečinok',
	'LBL_SELECT_TRASH_FOLDERS' 		=> 'Vyberte Kôš',
	'LBL_SELECT_SENT_FOLDERS' 		=> 'Vyberte priečinok Odoslané',
	'LBL_DELETED_FOLDERS_LIST' 		=> 'Nasledujúce priečinky %s buď neexistujú, alebo boli zo servera vymazané',
	'LBL_PORT'				=> 'Port e-mailového servera',
	'LBL_QUEUE'				=> 'Poradie e-mailových účtov',
	'LBL_REPLY_NAME_ADDR'	=> 'Odpovedať Meno/E-mail',
	'LBL_REPLY_TO_NAME'		=> 'Meno pre "Odpoveď komu"',
	'LBL_REPLY_TO_ADDR'		=> 'Adresa pre "Odpoveď komu"',
	'LBL_SAME_AS_ABOVE'		=> 'Používať Meno/Adresa',
	'LBL_SAVE_RAW'			=> 'Uložiť hrubý zdroj',
	'LBL_SAVE_RAW_DESC_1'	=> 'Vyberte možnosť "Áno", ak chcete zachovať hrubý zdroj každého importovaného e-mailu.',
	'LBL_SAVE_RAW_DESC_2'	=> 'Veľké prílohy môžu spôsobiť zlyhanie konzervatívne alebo nesprávne nastavených databáz.',
	'LBL_SERVER_OPTIONS'	=> 'Pokročilé nastavenia',
	'LBL_SERVER_TYPE'		=> 'Protokol e-mailového servera',
	'LBL_SERVER_URL'		=> 'Adresa e-mailového servera',
	'LBL_SSL_DESC'			=> 'Ak váš e-mailový server podporuje zabezpečené pripojenie SSL, povolením tejto možnosti vynútite pripojenia SSL pri importovaní e-mailu.',
	'LBL_ASSIGN_TO_TEAM_DESC' => 'Vybratý tím má prístup k e-mailovému účtu.',
	'LBL_SSL'				=> 'Použiť SSL',
	'LBL_STATUS'			=> 'Stav',
	'LBL_SYSTEM_DEFAULT'	=> 'Predvolené nastavenie systému',
	'LBL_TEST_BUTTON_KEY'	=> 't',
	'LBL_TEST_BUTTON_TITLE'	=> 'Test',
	'LBL_TEST_SETTINGS'		=> 'Nastavenia testu',
	'LBL_TEST_SUCCESSFUL'	=> 'Pripojenie prebehlo úspešne.',
	'LBL_TEST_WAIT_MESSAGE'	=> 'Počkajte chvíľu...',
	'LBL_TLS_DESC'			=> 'Použiť Transport Layer Security, keď sa pripájate k e-mailovému serveru – použite, iba ak váš e-mailový server podporuje tento protokol.',
	'LBL_TLS'				=> 'Použiť TLS',
	'LBL_WARN_IMAP_TITLE'	=> 'Prichádzajúce e-maily zablokované',
	'LBL_WARN_IMAP'			=> 'Upozornenia:',
	'LBL_WARN_NO_IMAP'		=> 'Prichádzajúce emaily <b>nemôžu</b> fungovať, ak knižnice  IMAP c-client nie sú aktivované/kompilované s modulom PHP. Obráťte sa na administrátora, ktorý môže tento problém vyriešiť.',

	'LNK_CREATE_GROUP'		=> 'Vytvoriť novú skupinu',
	'LNK_LIST_CREATE_NEW_GROUP'	 => 'E-mailový účet novej skupiny',
	'LNK_LIST_CREATE_NEW_BOUNCE' => 'Nový účet na spracovanie vrátenej pošty',
	'LNK_LIST_MAILBOXES'	=> 'Všetky e-mailové účty',
	'LNK_LIST_QUEUES'		=> 'Všetky fronty',
	'LNK_LIST_SCHEDULER'	=> 'Plánovače',
	'LNK_LIST_TEST_IMPORT'	=> 'Testovať import e-mailu',
	'LNK_NEW_QUEUES'		=> 'Vytvoriť novú frontu',
	'LNK_SEED_QUEUES'		=> 'Seed fronty tímov',
	'LBL_GROUPFOLDER_ID'	=> 'ID skupinového priečinka',
	'LBL_ASSIGN_TO_GROUP_FOLDER' => 'Prideliť k skupinovému priečinku',
    'LBL_STATUS_ACTIVE'     => 'Aktívne',
    'LBL_STATUS_INACTIVE'   => 'Neaktívne',
    'LBL_IS_PERSONAL' => 'osobný',
    'LBL_IS_GROUP' => 'skupinový',
    'LBL_ENABLE_AUTO_IMPORT' => 'Importujte e-maily automaticky',
    'LBL_WARNING_CHANGING_AUTO_IMPORT' => 'Upozornenie: Upravujete nastavenia automatického importu, čo môže mať za následok stratu dát.',
    'LBL_WARNING_CHANGING_AUTO_IMPORT_WITH_CREATE_CASE' => 'Upozornenie: Automatický import musí byť pri automatickom vytváraní prípadov povolený.',
	'LBL_EDIT_LAYOUT' => 'Upraviť rozloženie' /*for 508 compliance fix*/,
    'LBL_AUTHORIZED_ACCOUNT' => 'E-mailová adresa',
    'LBL_EMAIL_PROVIDER' => 'Poskytovateľ e-mailovej pošty',
    'LBL_AUTH_STATUS' => 'Stav autorizácie',
);
