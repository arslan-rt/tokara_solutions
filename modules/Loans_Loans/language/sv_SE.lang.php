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
$mod_strings = array (
  'LBL_TEAM' => 'Team',
  'LBL_TEAMS' => 'Team',
  'LBL_TEAM_ID' => 'Lag-ID',
  'LBL_ASSIGNED_TO_ID' => 'Tilldelat användar-ID',
  'LBL_ASSIGNED_TO_NAME' => 'Tilldelad användare',
  'LBL_TAGS_LINK' => 'Taggar',
  'LBL_TAGS' => 'Taggar',
  'LBL_ID' => 'ID',
  'LBL_DATE_ENTERED' => 'Datum skapat',
  'LBL_DATE_MODIFIED' => 'Modifierat Datum',
  'LBL_MODIFIED' => 'Modifierat Av',
  'LBL_MODIFIED_ID' => 'Modifierat Av Id',
  'LBL_MODIFIED_NAME' => 'Modifierat Av Namn',
  'LBL_CREATED' => 'Skapat Av',
  'LBL_CREATED_ID' => 'Skapat Av',
  'LBL_DOC_OWNER' => 'Ägare av dokument',
  'LBL_USER_FAVORITES' => 'Användare som favorite',
  'LBL_DESCRIPTION' => 'Beskrivning',
  'LBL_DELETED' => 'Raderad',
  'LBL_NAME' => 'Namn',
  'LBL_CREATED_USER' => 'Skapat Av Användare',
  'LBL_MODIFIED_USER' => 'Modifierat Av Användare',
  'LBL_LIST_NAME' => 'Namn',
  'LBL_EDIT_BUTTON' => 'Redigera',
  'LBL_REMOVE' => 'Ta bort',
  'LBL_EXPORT_MODIFIED_BY_NAME' => 'Ändrad av namn',
  'LBL_MODULE_NAME' => 'Loans',
  'LBL_MODULE_TITLE' => 'Loans',
  'LBL_SEARCH_FORM_TITLE' => 'Search Loans',
  'LBL_VIEW_FORM_TITLE' => 'Försäljningsvy',
  'LBL_LIST_FORM_TITLE' => 'Loans List',
  'LBL_SALE_NAME' => 'Försäljningsnamn:',
  'LBL_SALE' => 'Försäljning:',
  'LBL_LIST_SALE_NAME' => 'Namn',
  'LBL_LIST_ACCOUNT_NAME' => 'Organisationsnamn',
  'LBL_LIST_AMOUNT' => 'Summa',
  'LBL_LIST_DATE_CLOSED' => 'Stäng',
  'LBL_LIST_SALE_STAGE' => 'Försäljningsstage',
  'LBL_ACCOUNT_ID' => 'Konto-ID',
  'db_sales_stage' => 'LBL_LIST_SALES_STAGE',
  'db_name' => 'LBL_NAME',
  'db_amount' => 'LBL_LIST_AMOUNT',
  'db_date_closed' => 'LBL_LIST_DATE_CLOSED',
  'UPDATE' => 'Försäljning - Valuta uppdatering',
  'UPDATE_DOLLARAMOUNTS' => 'Uppdatera summa U.S. Dollar',
  'UPDATE_VERIFY' => 'Verifiera summa',
  'UPDATE_VERIFY_TXT' => 'Verifiera att summan i försäljningen har giltiga decimaler med endast numeriska tecken (0-9) och av separerare (.)',
  'UPDATE_FIX' => 'Fixa summa',
  'UPDATE_FIX_TXT' => 'Försäker fixa ogiltiga summor genom att skapa en giltig decimal från den nuvarande summan. Ändrade summor är sparade i amount_backup databas-fältet. On du kör detta och hittar buggar, kör inte igen utan att först ha återskapat från backup eftersom det kan skriva över backuppen med felaktig data.',
  'UPDATE_DOLLARAMOUNTS_TXT' => 'Uppdatera summan av U.S. Dollars för försäljning baserat på den nuvarande valutakursen. Detta värde används för att räkna ut grafer och ListVy valuta summan.',
  'UPDATE_CREATE_CURRENCY' => 'Skapa ny valuta:',
  'UPDATE_VERIFY_FAIL' => 'Misslyckad verifiering av post:',
  'UPDATE_VERIFY_CURAMOUNT' => 'Nuvarande summa:',
  'UPDATE_VERIFY_FIX' => 'Att köra fix skulle ge',
  'UPDATE_INCLUDE_CLOSE' => 'Inkludera stängda poster',
  'UPDATE_VERIFY_NEWAMOUNT' => 'Ny summa:',
  'UPDATE_VERIFY_NEWCURRENCY' => 'Ny valuta:',
  'UPDATE_DONE' => 'Klart',
  'UPDATE_BUG_COUNT' => 'Bugg funnen och försökt lösas:',
  'UPDATE_BUGFOUND_COUNT' => 'Hittade buggar:',
  'UPDATE_COUNT' => 'Poster uppdaterade:',
  'UPDATE_RESTORE_COUNT' => 'Summa av poster återskapade:',
  'UPDATE_RESTORE' => 'Återskapa summa',
  'UPDATE_RESTORE_TXT' => 'Återskapa summa från backup skapade under fixen.',
  'UPDATE_FAIL' => 'Kunde inte uppdatera -',
  'UPDATE_NULL_VALUE' => 'Summan är NULL sätter den till 0 -',
  'UPDATE_MERGE' => 'Slå ihop valutor',
  'UPDATE_MERGE_TXT' => 'Slå ihop multipla valutor till en valuta. Om det finns flera valuta-poster för samma valuta slår du ihop dom. Detta kommer också att slå ihop valutor för alla andra moduler.',
  'LBL_ACCOUNT_NAME' => 'Organisationsnamn:',
  'LBL_AMOUNT' => 'Summa:',
  'LBL_AMOUNT_USDOLLAR' => 'Summa USD:',
  'LBL_CURRENCY' => 'Valuta:',
  'LBL_DATE_CLOSED' => 'Förväntat slutdatum:',
  'LBL_TYPE' => 'Typ:',
  'LBL_CAMPAIGN' => 'Kampanj:',
  'LBL_LEADS_SUBPANEL_TITLE' => 'Leads',
  'LBL_PROJECTS_SUBPANEL_TITLE' => 'Projekt',
  'LBL_NEXT_STEP' => 'Nästa steg:',
  'LBL_LEAD_SOURCE' => 'Leadkälla:',
  'LBL_SALES_STAGE' => 'Försäljningsstage:',
  'LBL_PROBABILITY' => 'Trolighet (%):',
  'LBL_DUPLICATE' => 'Möjlig duplicerad försäljning',
  'MSG_DUPLICATE' => 'Försäljningsposten du håller på att skapa kan vara en dublett av en redan existerande post. Försäljningar med liknande namn är listade nedan.<br>Klicka Spara för att fortsätta att skapa denna nya försäljning, eller klicka Avbryt för att återgå till modulen utan att skapa försäljningen.',
  'LBL_NEW_FORM_TITLE' => 'Ny Loans',
  'LNK_NEW_SALE' => 'Skapa försäljning',
  'LNK_SALE_LIST' => 'Affär',
  'ERR_DELETE_RECORD' => 'Ett postnummer måste vara specifierat för att ta bort denna försäljning.',
  'LBL_TOP_SALES' => 'Mina topp öpnna-försäljningar',
  'NTC_REMOVE_OPP_CONFIRMATION' => 'Är du säker att du vill ta bort denna kontakt från försäljningen?',
  'SALE_REMOVE_PROJECT_CONFIRM' => 'Är du säker att du vill ta bort denna försäljning från detta projekt?',
  'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Aktivitetsström',
  'LBL_HISTORY_SUBPANEL_TITLE' => 'History',
  'LBL_RAW_AMOUNT' => 'Rå summa',
  'LBL_CONTACTS_SUBPANEL_TITLE' => 'Kontakter',
  'LBL_LIST_ASSIGNED_TO_NAME' => 'Tilldelad användare',
  'LBL_MY_CLOSED_SALES' => 'Mina stängda försäljningar',
  'LBL_TOTAL_SALES' => 'Total försäljning',
  'LBL_CLOSED_WON_SALES' => 'Stängda vunna försäljningar',
  'LBL_SALE_INFORMATION' => 'Försäljningsinformation',
  'LBL_CURRENCY_ID' => 'Valuta ID',
  'LBL_CURRENCY_NAME' => 'Valutanamn',
  'LBL_CURRENCY_SYMBOL' => 'Valutasymbol',
  'LBL_CURRENCY_RATE' => 'Valutakurs',
  'LBL_MODULE_NAME_SINGULAR' => 'Loans',
  'LBL_HOMEPAGE_TITLE' => 'Min Loans',
  'LNK_NEW_RECORD' => 'Create Loans',
  'LNK_LIST' => 'Visa Loans',
  'LNK_IMPORT_LOANS_LOANS' => 'Import Loans',
  'LBL_LOANS_LOANS_SUBPANEL_TITLE' => 'Loans',
  'LNK_IMPORT_VCARD' => 'Import Loans vCard',
  'LBL_IMPORT' => 'Import Loans',
  'LBL_IMPORT_VCARDTEXT' => 'Automatically create a new Loans record by importing a vCard from your file system.',
  'LBL_LOAN_NUMBER' => 'Loan Number',
  'LBL_SEQUENCE_ATTRB' => 'Sequence',
  'LBL_PARTY_ID_REFERENCE' => 'Party Id Reference',
  'LBL_NICKNAME' => 'Nickname',
  'LBL_MORTGAGE_INSURANCE_CASE' => 'Mortgage Insurance Case',
  'LBL_DETAIL_RATE' => 'Rate',
  'LBL_DETAIL_PAYMENT_TOTAL_MONTHLY' => 'Payment Total Monthly',
);