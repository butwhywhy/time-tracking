<?php
/**
 * Tzn Framework
 * 
 * @package tzn_language
 * @author IST planbar GmbH - www.istplanbar.de (Lars Wohlfahrt, Franziska Hauser)
 * @version 0.4
 * @copyright GNU Lesser General Public License (LGPL) version 3
 */

$GLOBALS['lang']['data'] = array(
	'new'				=> 'Neuer Eintrag',
	'read'				=> 'Diesen Eintrag lesen',
	'view'				=> 'Details anzeigen',
	'modify'			=> 'Eintrag ändern',
	'delete'			=> 'Diesen Eintrag löschen',
	'delete_confirm'		=> 'Diesen Eintrag wirklich löschen?',
	'remove'			=> 'Diesen Eintrag entfernen',
	'remove_confirm'		=> 'Wirklich aus der Liste entfernen?',
	'search'			=> 'Suchen',
	'next'				=> 'Nächste',
	'previous'			=> 'Vorherige',
	'next_page'			=> 'Nächste Seite',
	'previous_page'			=> 'Vorherige Seite',
	'all'				=> 'Alle',
	'more'				=> 'Mehr',
	'less'				=> 'Weniger',
	'item_found'			=> 'Gefundener Eintrag',
	'items_found'			=> 'Gefundene Einträge',
	'empty'				=> 'Keine Daten verfügbar'
);

$GLOBALS['lang']['message'] = array(
	'saved'				=> 'Daten erfolgreich gespeichert',
	'created'			=> 'Daten erfolgreich erstellt',
	'updated'			=> 'Daten erfolgreich aktualisiert',
	'deleted'			=> 'Daten erfolgreich gelöscht',
	'removed'			=> 'Daten erfolgreich entfernt'
);

$GLOBALS['lang']['error'] = array(
	'db_no_connection'	=> 'Es konnte keine Verbindung zur Datenbank hergestellt werden',
	'db_no_database'	=> 'Datenbank nicht gefunden',
	'db_sql_error'		=> 'Fehler bei der Datenbank-Anfrage',
	'sql_injection'		=> 'Mögliche SQL-Injection intendiert',
	'search_empty'		=> 'Leider konnte kein Eintrag gefunden werden',
	'not_found' 		=> 'Daten nicht gefunden',
	'login_failed'		=> 'Login fehlgeschlagen',
	'access_denied'		=> 'Zugriff verweigert',
	'data_denied'		=> 'Zugriff auf Daten verweigert',
	'not_found_denied'	=> 'Daten nicht gefunden oder Zugriff verweigert',
	'action_failed'		=> 'Die angeforderte Aktion konnte nicht ausgeführt werden',
	'form_error'		=> 'Formular enthält Fehler',
	'compulsory_field'	=> 'Information erforderlich',
	'account_disabled'	=> 'Account ist deaktiviert',
	'account_expired'	=> 'Account ist abgelaufen',
	'account_not_found'	=> 'Account existiert nicht',
	'username_required'	=> 'Bitte geben Sie einen Benutzernamen ein',
	'username_not_found'	=> 'Benutzername existiert nicht',
	'username_invalid'	=> 'Kein gültiger Benutzername (vermeiden Sie Sonder- oder Leerzeichen)',
	'username_length'	=> 'Der Benutzername muss aus mindestens '.APP_USER_NAME_MIN.' und maximal '.APP_USER_NAME_MAX.' Zeichen bestehen',
	'email_not_found'	=> 'E-Mail existiert nicht',
	'password_required'	=> 'Passwort erforderlich',
	'password_invalid'	=> 'Ungültiges Passwort',
	'password_length'	=> 'Passwort muss aus mindestens '.APP_USER_PASS_MIN.' and maximal '.APP_USER_PASS_MAX.' Zeichen betsehen',
	'password_mismatch'	=> 'Passwort und Überprüfung stimmen nicht überein',
	'password_recover'	=> 'Passwort kann nicht wiederhergestellt werden',
	'field_length'		=> 'Zu kurz oder zu lang',
	'field_exists'		=> 'Dieser Eintrag existiert bereits',
	'field_invalid'		=> 'Eintrag ist ungültig',
	'field_mismatch'	=> 'Einträge stimmen nicht überein',
	'invalid_date'		=> 'Ungültiges Datum',
	'invalid_time'		=> 'Ungültige Zeit',
	'invalid_email'		=> 'E-Mail-Adresse ist ungültig',
	'invalid_duration'	=> 'Ungültige Dauer',
	'file_wrong_type'	=> 'Falscher Dateityp',
	'file_empty'		=> 'Bitte wählen Sie eine Datei aus',
	'none_checked'		=> 'Bitte wählen Sie mindestens einen Eintrag'
);

$GLOBALS['lang']['security'] = array(
	'login'				=> 'Anmeldung',
	'logout'			=> 'Abmeldung',
	'sign_in'			=> 'Kein Mitglied? Melden Sie sich jetzt an!',
	'my_account'			=> 'Mein Account',
	'account'			=> 'Account',
	'account_active'		=> 'Account ist aktiviert',
	'account_not_active'		=> 'Account ist nicht aktiviert',
	'account_enabled'		=> 'Account ist freigegeben',
	'visit_count'			=> 'Besuche',
	'visit_fail_count'		=> 'Fehlgeschlagene Anmeldeversuche',
	'access_denied'			=> 'Zugriff verweigert',
	'permission_denied'		=> 'Erlaubnis verweigert',
	'session_expired'		=> 'Ihre Session ist abgelaufen',
	'login_last_date'		=> 'Leztes Anmeldedatum',
	'login_last_address'		=> 'Letzte Anmeldeadresse'
);

$GLOBALS['lang']['form'] = array(
	'compulsory'		=> 'obligatorisch',
	'username'         	=> 'Benutzername',
    'password'          	=> 'Passwort',
    'password_confirm'  	=> '(Überprüfung)',
    'auto_login'        	=> 'Login-Daten auf diesem Computer speichern',
    'password_legend'   	=> 'Geben Sie ein Passwort ein (und bestätigen Sie es) nur dann, wenn Sie es ändern möchten.',
	'name'				=> 'Name',
	'category'			=> 'Kategorie',
	'title'				=> 'Titel',
	'last_name'			=> 'Nachname',
	'middle_name'		=> 'Zweiter Vorname',
	'first_name'		=> 'Vorname',
	'nick_name'			=> 'Spitzname',
	'address'			=> 'Adresse',
	'location'          	=> 'Ort',
    'city'              	=> 'Stadt',
    'state'             	=> 'Bundesland',
    'state_us_only'		=> 'nur für US-Bürger',
    'country'          		=> 'Land',
    'time_zone'			=> 'Zeitzone',
    'user_rights'		=> 'Berechtigungen',
    'email'             	=> 'E-Mail',
    'subject'			=> 'Betreff',
    'body'				=> 'Textkörper',
    'comment'			=> 'Kommentar',
    'in'				=> 'In',
    'out'				=> 'Aus',
    'from'				=> 'Von',
    'to'				=> 'An',
    'cc'				=> 'CC',
    'url'				=> 'URL',
    'website'			=> 'Webseite',
    'description'		=> 'Beschreibung',
    'user'				=> 'Benutzer',
    'member'			=> 'Mitglied',
    'author'			=> 'Autor',
    'status'			=> 'Status',
    'file'				=> 'Datei',
    'image'				=> 'Bild',
    'thumbnail'			=> 'Vorschau',
    'document'			=> 'Dokument',
    'file_legend'		=> 'Bitte wählen Sie eine Datei durch Klicken des \'Browse..\'-Buttons',
    'file_name'			=> 'Dateiname',
	'file_size'			=> 'Dateigröße',
	'file_type'			=> 'Dateityp',
    'date'				=> 'Datum',
    'deadline'			=> 'Deadline',
    'start'				=> 'Start',
    'stop'				=> 'Stop',
    'publish_date'		=> 'Veröffentlichen',
    'post_date'			=> 'Absenden',
    'creation_date'		=> 'Erstellungsdatum',
    'last_change_date'		=> 'Letzte Aktualisierung',
    'last_visit_date'		=> 'Letzter Besuch',
    'last_visit_addr'		=> 'Von',
	'posted_on'			=> 'Abgesendet am',
	'published on'		=> 'Veröffentlicht am',
	'by'				=> 'von',
	'action'			=> 'Aktion'
);

// buttons
$GLOBALS['lang']['button'] = array(
	'add'				=> 'Hinzufügen',
    'create'				=> 'Erstellen',
    'edit'				=> 'Bearbeiten',
	'submit'			=> 'Abschicken',
	'login'				=> 'Anmelden',
	'save'				=> 'Speichern',
    'save_changes'      	=> 'Änderungen speichern',
    'save_and_add'		=> 'Speichern und weitere hinzufügen',
    'save_and_close'		=> 'Speichern und schließen',
    'update'			=> 'Aktualisieren',
    'cancel'            	=> 'Änderungen aufheben',
    'close'			=> 'Schließen',
    'reset'             	=> 'Formular zurücksetzen',
    'delete'			=> 'Löschen',
    'remove'			=> 'Entfernen',
    'start'			=> 'Start',
    'stop'			=> 'Stopp',
    'enable'			=> 'Freigeben',
    'disable'			=> 'Sperren',
    'activate'			=> 'Aktivieren',
    'deactivate'		=> 'Deaktivieren',
    'next_step'			=> 'Nächster Schritt',
    'previous_step'		=> 'Vorheriger Schritt',
    'back'              	=> 'Zurückgehen',
    'back_to_list'		=> 'Zurück zur Liste'
);

$GLOBALS['lang']['date'] = array(
	'future_pre'		=> 'in',	// eg. "in" 2 days
	'future_app'		=> '',		// ie. when keyword needs to be appended to the date
	'past_pre'			=> 'vor',		// eg. "il y a" 2 jours (french)
	'past_app'			=> '',	// eg. 2 days "ago"
	'yesterday'			=> 'Gestern',
	'today'				=> 'Heute',
	'tomorrow'			=> 'Morgen',
	'days'				=> 'Tage',
	'day'				=> 'Tag',
	'weeks'				=> 'Wochen',
	'week'				=> 'Woche',
	'months'			=> 'Monate',
	'month'				=> 'Monat',
	'years'				=> 'Jahre',
	'year'				=> 'Jahr',
	'hour'				=> 'Stunde',
	'hours'				=> 'Stunden',
	'minute'			=> 'Minute',
	'minutes'			=> 'Minuten',
	'second'			=> 'Sekunde',
	'seconds'			=> 'Sekunden',
	'january'			=> 'Januar',
	'february'			=> 'Februar',
	'march'				=> 'März',
	'april'				=> 'April',
	'may'				=> 'Mai',
	'june'				=> 'Juni',
	'july'				=> 'Juli',
	'august'			=> 'August',
	'september'			=> 'September',
	'october'			=> 'Oktober',
	'november'			=> 'November',
	'december'			=> 'Dezember',
	'jan'				=> 'Jan',
	'feb'				=> 'Feb',
	'mar'				=> 'Mär',
	'apr'				=> 'Apr',
	'may'				=> 'Mai',
	'jun'				=> 'Jun',
	'jul'				=> 'Jul',
	'aug'				=> 'Aug',
	'sep'				=> 'Sep',
	'oct'				=> 'Okt',
	'nov'				=> 'Nov',
	'dec'				=> 'Dez',
	'monday'			=> 'Montag',
	'tuesday'			=> 'Dienstag',
	'wednesday'			=> 'Mittwoch',
	'thursday'			=> 'Donnerstag',
	'friday'			=> 'Freitag',
	'saturday'			=> 'Samstag',
	'sunday'			=> 'Sonntag',
	'mon'				=> 'Mo',
	'tue'				=> 'Di',
	'wed'				=> 'Mi',
	'thu'				=> 'Do',
	'fri'				=> 'Fr',
	'sat'				=> 'Sa',
	'sun'				=> 'So'
);
