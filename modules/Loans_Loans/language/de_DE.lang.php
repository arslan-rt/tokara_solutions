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
  'LBL_TEAMS' => 'Teams',
  'LBL_TEAM_ID' => 'Team-ID',
  'LBL_ASSIGNED_TO_ID' => 'Zugewiesene Benutzer-Id',
  'LBL_ASSIGNED_TO_NAME' => 'Zugewiesen an',
  'LBL_TAGS_LINK' => 'Tags',
  'LBL_TAGS' => 'Tags',
  'LBL_ID' => 'ID',
  'LBL_DATE_ENTERED' => 'Erstellungsdatum',
  'LBL_DATE_MODIFIED' => 'Änderungsdatum',
  'LBL_MODIFIED' => 'Geändert von',
  'LBL_MODIFIED_ID' => 'Geändert von ID',
  'LBL_MODIFIED_NAME' => 'Geändert von Name',
  'LBL_CREATED' => 'Erstellt von:',
  'LBL_CREATED_ID' => 'Ersteller',
  'LBL_DOC_OWNER' => 'Dokument-Eigentümer',
  'LBL_USER_FAVORITES' => 'Benutzer mit Favoriten',
  'LBL_DESCRIPTION' => 'Beschreibung',
  'LBL_DELETED' => 'Gelöscht',
  'LBL_NAME' => 'Name',
  'LBL_CREATED_USER' => 'Erstellt von',
  'LBL_MODIFIED_USER' => 'Geändert von',
  'LBL_LIST_NAME' => 'Name',
  'LBL_EDIT_BUTTON' => 'Bearbeiten',
  'LBL_REMOVE' => 'Entfernen',
  'LBL_EXPORT_MODIFIED_BY_NAME' => 'Geändert von Name',
  'LBL_MODULE_NAME' => 'Loans',
  'LBL_MODULE_TITLE' => 'Loans',
  'LBL_SEARCH_FORM_TITLE' => 'Suchen Loans',
  'LBL_VIEW_FORM_TITLE' => 'Verkauf: Ansicht',
  'LBL_LIST_FORM_TITLE' => 'Loans Liste',
  'LBL_SALE_NAME' => 'Verkauf: Name:',
  'LBL_SALE' => 'Verkauf:',
  'LBL_LIST_SALE_NAME' => 'Name',
  'LBL_LIST_ACCOUNT_NAME' => 'Firmenname',
  'LBL_LIST_AMOUNT' => 'Betrag',
  'LBL_LIST_DATE_CLOSED' => 'Schließen',
  'LBL_LIST_SALE_STAGE' => 'Verkaufsphase',
  'LBL_ACCOUNT_ID' => 'Firmen-ID',
  'db_sales_stage' => 'LBL_LIST_SALES_STAGE',
  'db_name' => 'LBL_NAME',
  'db_amount' => 'LBL_LIST_AMOUNT',
  'db_date_closed' => 'LBL_LIST_DATE_CLOSED',
  'UPDATE' => 'Verkauf - Währungsaktualisierung',
  'UPDATE_DOLLARAMOUNTS' => 'Euro-Beträge aktualisieren',
  'UPDATE_VERIFY' => 'Beträge überprüfen',
  'UPDATE_VERIFY_TXT' => 'Überprüft, ob alle angegebenen Werte gültige Dezimalwerte sind (bestehend aus den Zahlen 0 - 9 und dem Dezimaltrennzeichen)',
  'UPDATE_FIX' => 'Beträge reparieren',
  'UPDATE_FIX_TXT' => 'Versucht, ungültige Beträge über das Setzen korrekter Dezimalzeichen zu korrigieren. Für jeden geänderten Betrag existiert eine Sicherungskopie im Datenbankfeld "amount_backup". Falls Sie diese Funktion aufrufen und Fehler feststellen, müssen Sie vor einem erneuten Versuch erst die alten Beträge, die sich im Backup befinden, wieder herstellen, da ansonsten Ihre ursprünglichen Einträge in der Datenbank mit den fehlerhaften Beträgen überschrieben werden.',
  'UPDATE_DOLLARAMOUNTS_TXT' => 'Hier werden die Beträge der Verkäufe basierend auf dem angegebenen Wechselkurs neu berechnet. Diese Werte werden für die Grafiken und die Währungstabellen genutzt.',
  'UPDATE_CREATE_CURRENCY' => 'Neue Währung:',
  'UPDATE_VERIFY_FAIL' => 'Der Datensatz konnte nicht verifiziert werden:',
  'UPDATE_VERIFY_CURAMOUNT' => 'Aktueller Betrag:',
  'UPDATE_VERIFY_FIX' => 'Durch Reparation berichtigter Betrag wäre',
  'UPDATE_INCLUDE_CLOSE' => 'Auch abgeschlossenen Angebote überprüfen',
  'UPDATE_VERIFY_NEWAMOUNT' => 'Neuer Betrag:',
  'UPDATE_VERIFY_NEWCURRENCY' => 'Neue Währung:',
  'UPDATE_DONE' => 'Fertig',
  'UPDATE_BUG_COUNT' => 'Gefundene Fehler, deren Behebung versucht wurde:',
  'UPDATE_BUGFOUND_COUNT' => 'Gefundene Fehler:',
  'UPDATE_COUNT' => 'Bearbeitete Einträge:',
  'UPDATE_RESTORE_COUNT' => 'Wiederhergestellte Beträge:',
  'UPDATE_RESTORE' => 'Betrag wiederherstellen',
  'UPDATE_RESTORE_TXT' => 'Stellt die Beträge wieder her, die während der Reparatur gesichert wurden.',
  'UPDATE_FAIL' => 'Update konnte nicht durchgeführt werden -',
  'UPDATE_NULL_VALUE' => 'Betragsfeld ist leer und wird deshalb auf 0 gesetzt -',
  'UPDATE_MERGE' => 'Währungen zusammenführen',
  'UPDATE_MERGE_TXT' => 'Zusammenführen mehrerer Währungen. Wenn Sie feststellen, dass mehrere Einträge mit der gleichen Währung vorhanden sind, können Sie diese zusammenführen. Dadurch werden die Währungen auch für alle anderen Module zusammengeführt.',
  'LBL_ACCOUNT_NAME' => 'Firmenname:',
  'LBL_AMOUNT' => 'Betrag:',
  'LBL_AMOUNT_USDOLLAR' => 'Betrag in Standardwährung:',
  'LBL_CURRENCY' => 'Währung',
  'LBL_DATE_CLOSED' => 'Abschluss geplant:',
  'LBL_TYPE' => 'Typ:',
  'LBL_CAMPAIGN' => 'Kampagne:',
  'LBL_LEADS_SUBPANEL_TITLE' => 'Interessenten',
  'LBL_PROJECTS_SUBPANEL_TITLE' => 'Projekte',
  'LBL_NEXT_STEP' => 'Nächster Schritt:',
  'LBL_LEAD_SOURCE' => 'Quelle:',
  'LBL_SALES_STAGE' => 'Verkaufsphase:',
  'LBL_PROBABILITY' => 'Wahrscheinlichkeit (%):',
  'LBL_DUPLICATE' => 'Möglicher doppelter Verkauf',
  'MSG_DUPLICATE' => 'Der Verkufs-Datensatz, den Sie gerade erstellen, könnte ein Duplikat sein. Ähnliche Einträge sind unten aufgeführt.<br>Klicken Sie auf "Speichern", um den Vorgang fortzusetzen oder auf "Abbrechen", um zum Modul zurückzukehren, ohne den Verkauf zu speichern.',
  'LBL_NEW_FORM_TITLE' => 'Neu Loans',
  'LNK_NEW_SALE' => 'Verkauf erstellen',
  'LNK_SALE_LIST' => 'Verkauf',
  'ERR_DELETE_RECORD' => 'Um diesen Verkauf zu löschen, muss eine Datensatznummer angegeben werden.',
  'LBL_TOP_SALES' => 'Liste der Top-Verkäufe',
  'NTC_REMOVE_OPP_CONFIRMATION' => 'Möchten Sie diesen Kontakt wirklich aus dem Verkauf entfernen?',
  'SALE_REMOVE_PROJECT_CONFIRM' => 'Möchten Sie diesen Verkauf wirklich aus diesem Projekt entfernen?',
  'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Aktivitäten-Stream',
  'LBL_HISTORY_SUBPANEL_TITLE' => 'Verlauf ansehen',
  'LBL_RAW_AMOUNT' => 'Ges. Summe',
  'LBL_CONTACTS_SUBPANEL_TITLE' => 'Kontakte',
  'LBL_LIST_ASSIGNED_TO_NAME' => 'Zugew. Benutzer',
  'LBL_MY_CLOSED_SALES' => 'Meine abgeschlossenen Verkäufe',
  'LBL_TOTAL_SALES' => 'Verkäufe insgesamt',
  'LBL_CLOSED_WON_SALES' => 'Geschlossene gewonnene Verkäufe',
  'LBL_SALE_INFORMATION' => 'Verkaufsinformationen',
  'LBL_CURRENCY_ID' => 'Währungs-ID',
  'LBL_CURRENCY_NAME' => 'Währungsname',
  'LBL_CURRENCY_SYMBOL' => 'Währungssymbol',
  'LBL_CURRENCY_RATE' => 'Wechselkurs',
  'LBL_MODULE_NAME_SINGULAR' => 'Loans',
  'LBL_HOMEPAGE_TITLE' => 'Mein Loans',
  'LNK_NEW_RECORD' => 'Erstellen Loans',
  'LNK_LIST' => 'Ansicht Loans',
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