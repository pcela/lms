<?php

/*
 * LMS version 1.11-git
 *
 *  (C) Copyright 2001-2012 LMS Developers
 *
 *  Please, see the doc/AUTHORS for more information about authors!
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License Version 2 as
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 *  USA.
 *
 *  $Id$
 */

function GetConfigList($order='var,asc', $section='', $search='')
{
	global $DB;

	list($order, $direction) = sscanf($order, '%[^,],%s');

	$direction = ($direction != 'desc') ? 'asc' : 'desc';

	switch($order)
	{
		case 'section':
			$sqlord = " ORDER BY section $direction, var";
		break;
		default:
			$sqlord = " ORDER BY var $direction";
		break;
	}

	$config = $DB->GetAll('SELECT id, section, var, value, description as usercomment, disabled 
			FROM uiconfig WHERE section != \'userpanel\' AND section !=\'inetlms\''
			.($section ? ' AND section = '.$DB->Escape($section) : '')
			.($search ? ' AND var ?LIKE? '.$DB->Escape('%'.$search.'%') : '')
			.$sqlord);

	if($config) foreach ($config as $idx => $item)
	{
		switch($item['section'])
		{
			case 'hiperus_c5' :
			    switch($item['var'])
			    {
				
				case 'lms_login':
					$config[$idx]['description'] = 'login uzytkownika LMS';
				break;
				
				case 'lms_pass':
					$config[$idx]['description'] = 'hasło dla użytkownika';
				break;
				
				case 'lms_url':
					$config[$idx]['description'] = 'domyślny URL dla LMS DEF.: http://localhost/lms';
				break;
				
				case 'leftmonth':
					$config[$idx]['description'] = 'numer miesiaca wstecz za ktory wystawić fakturę, np. dzisiaj mamy sierpien, jeżeli chcemy wystawiac fakturę za lipiec to wartość musi być 1, jeżeli będziemy chcieli wystawić za maj to wpisujemy 3, DEF.: 1';
				break;
				
				case 'numberplanid':
					$config[$idx]['description'] = 'Numer ID planu numeracyjnego dla wystawianych faktur za abonament i rozmowy VoIP. Jeżeli pozostawimy puste pole to będzie brany domyślny plan numeracyjny dla klienta';
				break;
				
				case 'taxrate':
					$config[$idx]['description'] = 'Wartość stawki VAT, jeżeli pozostawimy puste pole to będzie użyta domyślna stawka VAT';
				break;
				
				case 'prodid':
					$config[$idx]['description'] = 'PKWiU';
				break;
				
				case 'content':
					$config[$idx]['description'] = 'domyślna jednostka miary na fakturze. DEF.: szt';
				break;
				
				case 'wlr':
					$config[$idx]['description'] = 'Usługa hurtowego dostępu do sieci telekomunikacyjnej. Wymaga osobnej umowy z operatorem. DEF.: 0';
				break;
				
				case 'accountlist_pagelimit':
					$config[$idx]['description'] = 'Ilość wyświetlanych pozycji na jednej stronie w liście kont VoIP, DEF.: 50';
				break;
				
				case 'terminallist_pagelimit':
					$config[$idx]['description'] = 'Ilość wyświetlanych pozycji na jednej stronie w liście terminali, DEF.: 50';
				break;
				
				case 'force_relationship':
					$config[$idx]['description'] = 'Wymuś powiązanie konta VoIP z klientem z LMS podczas edycji lub tworzenia nowego konta VoIP, DEF.: 1';
				break;
				
				case 'number_manually':
					$config[$idx]['description'] = 'Pozwól na ręczne wprowadzenie numeru telefonicznego przy dodawaniu lub edycji terminala.';
				break;
			    
				default:
					$config[$idx]['description'] = trans('Unknown option. No description.');
				break;
			    }
			break;
			

			case 'radius' :
			    switch($item['var'])
			    {
				
				case 'coa_port':
					$config[$idx]['description'] = 'domyślny port na którym nasłuchuje NAS, DEF 3799';
				break;
				
				case 'auth_login':
					$config[$idx]['description'] = 'pole z karty urządzenia klienta (komputer) które jest loginem dla autoryzacji w radius\'ie.<br>Dopuszczalne wartości : <br><b>id</b> - id komputera<br><b>name</b> - nazwa komputera<br><b>ip</b> - IP komputera<br><b>passwd</b> - hasło logowania urządzenia<br><b>pppoe_login</b> - dodatkowe pole na login z karty komputera<br>DEFAULT : id';
				break;
				
				case 'page_view':
					$config[$idx]['description'] = 'ilość wyświetlanych pozycji na jednej stronie';
				break;
				
				default:
					$config[$idx]['description'] = trans('Unknown option. No description.');
				break;
			    }
			break;



			case 'netdevices':
				switch($item['var'])
				{
					case 'shift_port':
						$config[$idx]['description'] = 'Pozwala na przestawianie kolejności portów w interfejsie sieciowym. DEF: 0';
					break;
					
					case 'def_nameport':
						$config[$idx]['description'] = 'Domyślna nazwa portu dla aktywnych interfejsów sieciowych. DEF: eth';
					break;
					
					case 'def_pnameport':
						$config[$idx]['description'] = 'Domyślna nazwa portu dla pasywnych interfejsów sieciowyh. DEF: port';
					break;
					
					case 'link_networknode':
						$config[$idx]['description'] = 'Interfejs sieciowy musi być przypisany do węzła. DEF.: 1';
					break;
					
					case 'link_tosame':
						$config[$idx]['description'] = 'Pozwól na połączenie sieciowe w obrębie tego samego pasywnego interfejsu sieciowego do innego portu. DEF.: 1';
					break;
					
					case 'link_tosame_active':
						$config[$idx]['description'] = 'Pozwól na połączenie sieciowe w obrębie tego samego aktywnego interfejsu sieciowego do innego portu. DEF.: 0';
					break;
					
					case 'delinfoservice':
						$config[$idx]['description'] = 'Zezwalaj na kasowanie informacji o czynnościach serwisowych w interfejsach sieciowych DEF.: 0';
					break;
					
					case 'force_connection':
						$config[$idx]['description'] = 'wymusza skonfigurowania połączenia sieciowego podczas edycji/dodawania komputera klienta DEF.: 1';
					break;
					
					case 'force_network_to_host':
						$config[$idx]['description'] = 'wymusza powiązanie klasy adresowej IP z hostem  DEF.: 0';
					break;
					
					case 'force_network_gateway':
						$config[$idx]['description'] = 'wymusza wpisanie bramy w konfiguracji sieci DEF.: 1';
					break;
					
					case 'force_network_dns':
						$config[$idx]['description'] = 'wymusza wpisanie chociaż jednego adresu serwera DNS w konfiguracji sieci  DEF.: 1';
					break;
					
					
				default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				} //end: var
			break;
			
			case 'homepage' :
				switch($item['var'])
				{
					case 'box_lms' :
						$config[$idx]['description'] = 'Pokaż box z informacją o iNET LMS. <b>DEFAULT: 1</b>';
					break;
					case 'box_system' :
						$config[$idx]['description'] = 'Pokaż box z informacją o systemie. <b>DEFAULT: 1</b>';
					break;
					case 'box_customer' :
						$config[$idx]['description'] = 'Pokaż box z informacją o klientach. <b>DEFAULT: 1</b>';
					break;
					case 'box_nodes' :
						$config[$idx]['description'] = 'Pokaż box z informacją o komputerach. <b>DEFAULT: 1</b>';
					break;
					case 'box_helpdesk' :
						$config[$idx]['description'] = 'Pokaż box z informacją o zgłoszeniach. <b>DEFAULT: 1</b>';
					break;
					case 'box_links' :
						$config[$idx]['description'] = 'Pokaż box z informacją o użytecznych linkach. <b>DEFAULT: 1</b>';
					break;
					case 'box_totd' :
						$config[$idx]['description'] = 'Pokaż Pana Żaróweczkę :). <b>DEFAULT: 0</b>';
					break;
					case 'box_board' :
						$config[$idx]['description'] = 'Pokaż box z tablicą informacyjną. <b>DEFAULT: 1</b>';
					break;
					case 'box_callcenter' :
						$config[$idx]['description'] = 'Pokaż box Call Center. <b>DEFAULT: 1</b>';
					break;
					
					default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				}
			break;

			
			case 'autobackup' :
			    switch($item['var'])
			    {
				
				case 'ftphost':
					$config[$idx]['description'] = 'adres serwera FTP';
				break;
				
				case 'ftppass':
					$config[$idx]['description'] = 'hasło do konta FTP';
				break;
				
				case 'ftpuser':
					$config[$idx]['description'] = 'login do konta FTP';
				break;
				
				case 'ftpssl':
					$config[$idx]['description'] = 'połączenie SSL FTP DEFAULT: 0';
				break;
				
				case 'db_backup':
					$config[$idx]['description'] = 'czy tworzyć kopię bazy danych do domyślnego katalogu dla LMS DEFAULT: 1';
				break;
				
				case 'db_gz':
					$config[$idx]['description'] = '1 - twórz skompresowaną bazę danych, 0 - nieskompresowaną DEFAULT: 1';
				break;
				
				case 'db_stats':
					$config[$idx]['description'] = 'dołącz statystyki do archiwum DEFAULT: 0';
				break;
				
				case 'db_ftpsend':
					$config[$idx]['description'] = 'wysyłaj kopię bazy na zdalny serwer FTP , DEFAULT: 0';
				break;
				
				case 'db_ftppath':
					$config[$idx]['description'] = 'katalog na FTP do którego będą kopiowane archiwa bazy dancyh DEFAULT: iNET_LMS_DB_DUMP';
				break;
				
				case 'dir_ftpsend':
					$config[$idx]['description'] = 'twórz kopię lolaknych katalogów na serwerze FTP , DEFAULT: 0';
				break;
				
				case 'dir_ftpaction':
					$config[$idx]['description'] = 'typ akcji jaka ma być wykonana, jeżeli dany plik już istnieje na serwerze FTP<br>
					skip - pomin plik<br>
					replace - nadpisz plik<br>
					update - nadpisz plik, jeżeli waga pliku jest inna niż na lokalnym serwerze<br>
					DEFAULT: update';
				break;
				
				case 'dir_local':
					$config[$idx]['description'] = 'analogiczna lista katalogów dla dir_ftp na lokalnym serwerze do skopiowania na FTP. Katalogi należy oddzielać przecinkiem. Kopia jest tworzona z całą strukturą katalogów<br>
					<b>UWAGA</b> liczba katalogów musi być dokładnie taka sama jak w opcji dir_fpt';
				break;
				
				case 'dir_ftp':
					$config[$idx]['description'] = 'analogiczna lista katalogów dla dir_local na FTP do których będą skopiowane pliki z lokalnego serwera. Katalogi należy oddzielać przecinkiem<br>
					<b>UWAGA</b> liczba katalogów musi być dokładnie taka sama jak w opcji dir_local';
				break;
				
				default:
					$config[$idx]['description'] = trans('Unknown option. No description.');
				break;
			    }
			break;
			
			
			case 'phpui':
				switch($item['var'])
				{
				case 'delete_link_in_customerbalancebox':
					$config[$idx]['description'] = 'Dodaje link umożliwiający usunięcie naliczonego zobowiązania w karcie klienta, box konto klienta';
				break;
				
				case 'allow_from':
					$config[$idx]['description'] = trans('List of networks and IP addresses, with access to LMS. If empty, every IP address has access to LMS. When you write list of addresses or address pools here, LMS will dismiss every unwanted user with HTTP 403 error.');
				break;
				
				case 'networknode_pagelimit':
					$config[$idx]['description'] = 'Lista węzłów na jednej stronie';
				break;
				
				case 'default_division':
					$config[$idx]['description'] = 'Domyślne ID firmy dla dokumentów wystawianych dla klientów nie będącymi klientami sieci / brak ich na liście';
				break;
				
				case 'config_empty_value':
					$config[$idx]['description'] = 'Pozwala na zapisanie zmiennej konfiguracyjnej z pustą wartością';
				break;
				
				case 'installation_name':
					$config[$idx]['description'] = 'nazwa instalacji LMS widoczna w górnym prawym rogu, w stopce i oknie logowania.';
				break;
				
				case 'iphistory':
					$config[$idx]['description'] = 'włącz logowanie zmian adresów IP';
				break;
				
				case 'callcenter_pagelimit':
					$config[$idx]['description'] = 'Ilość maksymalnie wyświetlanych rekordów na jednej stronie.<br><B>DEFAULT: 50';
				break;

				case 'lang':
					$config[$idx]['description'] = trans('System language code. If not set, language will be determined on browser settings. Default: en.');
				break;

				case 'timeout':
					$config[$idx]['description'] = trans('WWW session timeout. After that time (in seconds) user will be logged out if action has been made. Default: 600.');
				break;

				case 'customerlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in customers list. Default: 100.');
				break;

				case 'nodelist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in nodes list. Default: 100.');
				break;

				case 'balancelist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in customer\'s balance. Default: 100.');
				break;

				case 'configlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in UI config options list. Default: 100.');
				break;

				case 'invoicelist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in invoices list. Default: 100.');
				break;

				case 'ticketlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in tickets (requests) list. Default: 100.');
				break;

				case 'accountlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in accounts list. Default: 100.');
				break;

				case 'domainlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in domains list. Default: 100.');
				break;

				case 'aliaslist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in aliases list. Default: 100.');
				break;

				case 'receiptlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in cash receipts list. Default: 100.');
				break;

				case 'taxratelist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in tax rates list. Default: 100.');
				break;
				
				case 'numberplanlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in numbering plans list. Default: 100.');
				break;

				case 'divisionlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in divisions list. Default: 100.');
				break;

				case 'documentlist_pagelimit':
					$config[$idx]['description'] = trans('Limit of records displayed on one page in documents list. Default: 100.');
				break;

				case 'networkhosts_pagelimit':
					$config[$idx]['description'] = trans('Limit of nodes displayed on one page in Network Information. Default: 256. With 0, this information is omitted (page is displaying faster).');
				break;

				case 'force_ssl':
					$config[$idx]['description'] = trans('SSL Enforcing. Setting this option to 1 will effect with that LMS will enforce SSL connection with redirect to \'https://\'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI] at every request without SSL. Default: 0 (off).');
				break;

				case 'reload_timer':
					$config[$idx]['description'] = trans('Reload timer. If set to true it will display remaining time to configuration reload. If using more than one host, remember to sync time between them.');
				break;
				
				case 'reload_type':
					$config[$idx]['description'] = trans('Reload type. Allowed values: exec - call some command (most often with sudo, some script or something else, configurable below); sql - writes down to SQL (multiple queries separated with semicolon may be setup).');
				break;
				
				case 'reload_execcmd':
					$config[$idx]['description'] = trans('Command to run during reload, if reload_type is set to \'exec\'. By default /bin/true. That string is sent to command system(), so I propose you to think what you do and how :) Altogether, semicolons should be parsed by bash, but LMS splits that string and execute commands separately.');
				break;
				
				case 'reload_sqlquery':
					$config[$idx]['description'] = trans('SQL query executed while reload, if reload_type = sql. Default: empty. You can use \'%TIME%\' as replacement to current unix timestamp. WARNING! Semicolon is handled as query separator, which means that you can enter couple of SQL queries separated by semicolon sign.');
				break;
				
				case 'allow_mac_sharing':
					$config[$idx]['description'] = trans('Allow nodes addition with duplicated MAC address (not checking that some computer have that MAC yet). Default: 0 (off).');
				break;
				
				case 'default_zip':
				case 'default_city':
				case 'default_address':
					$config[$idx]['description'] = trans('Default zip code, city, street, used while inserting new customer. Useful if you add majority of customers with the same street.');
				break;
				
				case 'lastonline_limit':
					$config[$idx]['description'] = trans('Specify time (in seconds), after which node will be marked offline. It should match with frequency of running nodes activity script (i.e. lms-fping). Default: 600.');
				break;

				case 'use_current_payday':
					$config[$idx]['description'] = trans('Qualify to use current day of month for payment day. Default: 0 (off).');
				break;

				case 'default_monthly_payday':
					$config[$idx]['description'] = trans('Qualify the day of month for payment day. Default: 0 (undefined).');
				break;
				
				case 'smarty_debug':
					$config[$idx]['description'] = trans('Enable Smarty\'s debug console. Useful for tracking values passed from PHP to Smarty. Default: 0 (off).');
				break;
				
				case 'arpd_servers':
					$config[$idx]['description'] = trans('List of arpd servers for MAC addresses retrieval from remote networks. That list should include IP[:port] items separated with spaces. Default: empty.');
				break;
				
				case 'helpdesk_backend_mode':
					$config[$idx]['description'] = trans('When enabled, all messages in helpdesk system (except those sent to requester) will be sent to mail server corresponding queue address. lms-rtparser script should be running on server. Messages won\'t be written directly to database, but on solely responsibility of rtparser script. Default: disabled.');
				break;

				case 'helpdesk_sender_name':
					$config[$idx]['description'] = trans('Name of messages sender or predefined variables: "queue" - queue name, "user" - logged user name. Default: none.');
				break;

				case 'newticket_notify':
					$config[$idx]['description'] = trans('When enabled, system will sent notification to all users with rights for current queue after new ticket creation. Default: disabled.');
				break;
				
				case 'to_words_short_version':
					$config[$idx]['description'] = trans('Specify format of verbal amounts representation (on invoices). e.g. for value "1" verbal expand of 123,15 will be "one two thr 15/100". Default: 0.');
				break;
				
				case 'timetable_days_forward':
					$config[$idx]['description'] = trans('Number of days (including current day) on timetable. Default: 7.');
				break;

				case 'gd_translate_to':
					$config[$idx]['description'] = trans('Charset of data gd library expects (useful if gd library needs ISO-8859-2 instead of UTF-8 to feed imagetext() function).');
				break;

				case 'nodepassword_length':
					$config[$idx]['description'] = trans('Length of (auto-generated) node password. Max.32. Default: 16.');
				break;
				
				case 'custom_accesstable':
					$config[$idx]['description'] = trans('PHP file with user-defined access rules in "lib" directory. Default: empty.');
				break;

				case 'check_for_updates_period':
					$config[$idx]['description'] = trans('How often to check for LMS updates (in seconds). Default: 86400.');
				break;

				case 'map_type':
					$config[$idx]['description'] = trans('Network map type. Use "flash" if you have Ming library or "gd" if your PHP supports gdlib. By default LMS will try to generate flash map, with fallback to GD if it fails.');
				break;

				case 'homedir_prefix':
					$config[$idx]['description'] = trans('Prefix for account home directory. Default: /home/');
				break;

				case 'default_taxrate':
					$config[$idx]['description'] = trans('Value of tax rate which will be selected by default on tax rates lists. Default: 22.0');
				break;

				case 'helpdesk_reply_body':
					$config[$idx]['description'] = trans('Adds body of message in ticket reply. Default: false');
				break;

				case 'big_networks':
					$config[$idx]['description'] = trans('Support for big ISPs e.g. hidding long customers selection dropdowns. Default: false');
				break;

				case 'ewx_support':
					$config[$idx]['description'] = trans('Support for EtherWerX devices. Default: false');
				break;

				case 'helpdesk_stats':
					$config[$idx]['description'] = trans('Adds helpdesk requests causes stats on ticket view and print pages. Default: true');
				break;

				case 'helpdesk_customerinfo':
					$config[$idx]['description'] = trans('Adds customer basic information on ticket view and in notifications. Default: true');
				break;

				case 'ticket_template_file':
					$config[$idx]['description'] = trans('Helpdesk ticket printout template file. Default: rtticketprint.html');
				break;
			
				case 'ticketlist_status':
					$config[$idx]['description'] = trans('Default status filter setting on tickets list. For allowed values see html source code. Default: not set');
				break;

				case 'use_invoices':
					$config[$idx]['description'] = trans('Makes option "with invoice" checked by default. Default: false');
				break;

				case 'default_module':
					$config[$idx]['description'] = trans('Start-up module (filename from /modules without .php). Default: welcome');
				break;

				case 'default_assignment_period':
					$config[$idx]['description'] = trans('Default period value for assignment. Default: 0');
				break;

				case 'arp_table_backend':
					$config[$idx]['description'] = trans('Command which returns IP-MAC bindings. Default: internal backend');
				break;

				case 'report_type':
					$config[$idx]['description'] = trans('Documents type. You can use "html" or "pdf". Default: html.');
				break;
				
				case 'syslog_level':
					$config[$idx]['description'] = trans('System event log level (0/1), 0 - disabled. Default: 1');
				break;
				
				case 'syslog_pagelimit':
					$config[$idx]['description'] = trans('Limit the events displayed on a single page in the system logs. Default: 100');
				break;
				
				case 'syslog_maxrecord':
					$config[$idx]['description'] = 'Maksymalna ilość rekordów jakie mogą być odczytane, zabezpieczenie przed przepełnieniem pamięci przez DB.<br><b>DEF.: 150000</b> ( dla 128MB )';
				break;
				
				case 'gethostbyaddr':
					$config[$idx]['description'] = 'włączenie rozwiązywania adresu IP na nazwę hosta w liście użytkowników.<br><b>DEF.: 1</b>';
				break;
				
				case 'netlist_pagelimit':
					$config[$idx]['description'] = 'Ilość wyświetlanych sieci IP na jednej stronie.<br><b>DEF.: 50</b>';
				break;

				default:
					$config[$idx]['description'] = trans('Unknown option. No description.');
				break;
			} //end: var
			break;

			case 'finances':
				switch($item['var'])
				{
					case 'suspension_percentage':
						$config[$idx]['description'] = trans('Percentage of suspended liabilities. Default: 0');
					break;

					case 'cashimport_checkinvoices':
						$config[$idx]['description'] = trans('Check invoices as accounted when importing cash operations. Default: false');
					break;

    				default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				} //end: var
			break;
			
			
			

			case 'invoices':
				switch($item['var'])
				{
					case 'header':
						$config[$idx]['description'] = trans('This is a seller data. A new line replacement is "\n" sign, e.g. SuperNet ISP\n00-950 Warsaw\nWiosenna 52\n0 49 3883838\n\naccounting@supernet.pl\n\nNIP: 123-123-12-23');
					break;

					case 'footer':
						$config[$idx]['description'] = trans('Small font text appearing in selected (in template) place of the invoice, e.g. Our Bank: SNETISP, 828823917293871928371\nPhone number 555 123 123');
					break;

					case 'default_author':
						$config[$idx]['description'] = trans('Default invoice issuer');
					break;

					case 'edit_closed':
						$config[$idx]['description'] = 'Pozwala na edycję zamkniętych faktur, DEFAULT : 0';
					break;
					
					case 'deleted_closed':
						$config[$idx]['description'] = 'Pozwala na usunięcie zamkniętych faktur, DEFAULT : 0';
					break;


					case 'cplace':
						$config[$idx]['description'] = trans('Invoice draw-up place.');
					break;

					case 'template_file':
						$config[$idx]['description'] = trans('Invoice template file. Default: "invoice.html". Should be placed in templates directory.');
					break;
					
					case 'template_file_proforma':
						$config[$idx]['description'] = 'Szablon dla faktury PROFORMA';
					break;

					case 'cnote_template_file':
						$config[$idx]['description'] = trans('Credit note template file. Default: "invoice.html". Should be placed in templates directory.');
					break;

					case 'content_type':
						$config[$idx]['description'] = trans('Content-type for document. If you enter "application/octet-stream", browser will send file to save on disk, instead of displaying it. It\'s useful if you use your own template which generate e.g. rtf or xls file. Default: "text/html".');
					break;

					case 'attachment_name':
						$config[$idx]['description'] = trans('File name for saving document printout. WARNING: Setting attachment_name with default content_type will (in case of MSIE) print document, and prompt for save on disk. Default: empty.');
					break;

					case 'type':
						$config[$idx]['description'] = trans('Documents type. You can use "html" or "pdf". Default: html.');
					break;
					
					case 'set_protection':
						$config[$idx]['description'] = 'Zabezpieczenie dokumentów PDF przed modyfikacją. <b>DEFAULT :1</b>';;
					break;
					
					case 'create_pdf_file':
						$config[$idx]['description'] = 'Automatyczne tworzenie plików pdf na serwerze dla faktur VAR i faktur korygujących. <b>DEFAULT :0</b>';;
					break;
					
					case 'create_pdf_file_proforma':
						$config[$idx]['description'] = 'Automatyczne tworzenie plików pdf na serwerze dla faktur proforma. <b>DEFAULT :0</b>';;
					break;
					
					case 'print_balance_info':
						$config[$idx]['description'] = 'czy drukować informację o bilansie przed wystawieniem faktury, przełącznik dla faktur w formacie tcpdf wersji 1 i 2';
					break;

					case 'print_balance_history':
						$config[$idx]['description'] = trans('If true on invoice (html) will be printed history of financial operations on customer account. Default: not set.');
					break;

					case 'print_balance_history_limit':
						$config[$idx]['description'] = trans('Number of Records on customer balance list on invoice. Specify last x records. Default: 10.');
					break;

					case 'default_printpage':
						$config[$idx]['description'] = trans('Coma-separated list of default invoice printout pages. You can use "original", "copy", "duplicate". Default: "original,copy".');
					break;

					case 'paytime':
						$config[$idx]['description'] = trans('Default documents paytime in days. Default: 14');
					break;

					case 'paytype':
						$config[$idx]['description'] = trans('Default invoices paytype. Default: "1" (cash)');
					break;
					
					case 'default_type_of_documents':
						$config[$idx]['description'] = 'zmienna określa nam domyślny typ dokumentu przy dodawaniu nowego zobowiązania/taryfy dla klienta, DEFAULT: <br>dozwolone wartości: <Br>invoice - faktura<br>proforma - faktura proforma<br>pusta wartość - tylko naliczenie opłat';
					break;
					
					case 'template_version':
						$config[$idx]['description'] = 'wersja szablonu dokumentu tylko dla pdf, jeżeli mamy własny szablon należy pozostawić wartość 1 !!!<br>
						1 - stary szablon pdf (tcpdf)<br>
						2 - dla szablonu faktur które są obowiązujące od Stycznia 2015 roku (tcpdf)<br>
						<b>DEFAULT : 1</b>';
					break;
					
					case 'sdateview':
					    $config[$idx]['description'] = 'czy wyświetlać datę dostawy / wykonania usługi. zmienna dla faktur w wersji 2.<br>
							Jeżeli w pozycjach faktur mamy zawarty okres usługi wtedy zmienna powinna być na 0 !!! w innym przypadku wartość = 1<br>
							<b>DEFAULT : 0</b>';
					break;
					
					case 'urllogofile':
						$config[$idx]['description'] = 'adres url pliku z logo naszej firmy, Zmienna dla faktur w wersji 2<br><b>UWAGA</b> - musi być podany pełny adres url np. http://localhost/lms/img/moje_logo.jpg';
					break;
					
					

					default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				} //end: var
			break;

			case 'notes':
				switch($item['var'])
				{
					case 'template_file':
						$config[$idx]['description'] = trans('Debit note template file. Default: "note.html". Should be placed in templates directory.');
					break;

					case 'content_type':
						$config[$idx]['description'] = trans('Content-type for document. If you enter "application/octet-stream", browser will send file to save on disk, instead of displaying it. It\'s useful if you use your own template which generate e.g. rtf or xls file. Default: "text/html".');
					break;

					case 'attachment_name':
						$config[$idx]['description'] = trans('File name for saving document printout. WARNING: Setting attachment_name with default content_type will (in case of MSIE) print document, and prompt for save on disk. Default: empty.');
					break;

					case 'type':
						$config[$idx]['description'] = trans('Documents type. You can use "html" or "pdf". Default: html.');
					break;

					case 'paytime':
						$config[$idx]['description'] = trans('Default documents paytime in days. Default: 14');
					break;

					default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				} //end: var
			break;

			case 'receipts':
				switch($item['var'])
				{
					case 'template_file':
						$config[$idx]['description'] = trans('Cash receipt template file. Default: "receipt.html". Should be placed in templates directory.');
					break;

					case 'content_type':
						$config[$idx]['description'] = trans('Content-type for document. If you enter "application/octet-stream", browser will send file to save on disk, instead of displaying it. It\'s useful if you use your own template which generate e.g. rtf or xls file. Default: "text/html".');
					break;

					case 'attachment_name':
						$config[$idx]['description'] = trans('File name for saving document printout. WARNING: Setting attachment_name with default content_type will (in case of MSIE) print document, and prompt for save on disk. Default: empty.');
					break;

					case 'type':
						$config[$idx]['description'] = trans('Documents type. You can use "html" or "pdf". Default: html.');
					break;

					default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				} //end: var
			break;

			case 'mail':
				switch($item['var'])
				{
					case 'debug_email':
						$config[$idx]['description'] = trans('E-mail address for debugging - messages from \'Mailing\' module will be sent at this address, instead to real users.');
					break;
					case 'smtp_port':
					case 'smtp_host':
					case 'smtp_username':
					case 'smtp_password':
					case 'smtp_auth_type':
						$config[$idx]['description'] = trans('SMTP settings.');
					break;

					default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;

				} //end: var
			break;
			
			
			case 'jambox':
				switch($item['var'])
				{
				    case 'numberplanid':
					$config[$idx]['description'] = 'ID planu numeracyjnego dla wystawianych faktur VAT za TV';
				    break;
				    
				    case 'enabled':
					$config[$idx]['description'] = '1 - właczenie , 0 - wyłączenie modułu w systemie';
				    break;
				    
				    case 'login':
					$config[$idx]['description'] = 'Imię i Nazwisko';
				    break;
				    
				    case 'haslo':
					$config[$idx]['description'] = 'Hasło do sms OTWARTYM TEKSTEM !!!';
				    break;
				    
				    case 'serwer':
					$config[$idx]['description'] = 'namiary na serwer<br>Piaskownica : https://sms.sgtsa.pl/test/xmlrpc<br>Produkcja : https://sms.agtsa.pl/sms/xmlrpc';
				    break;
				    
				}
			break;

			case 'sms':
				switch($item['var'])
				{
					case 'service':
						$config[$idx]['description'] = 'Domyślny typ serwisu używanego do wysyłania wiadomości, dozwolone smscenter, smsapi , smstools , serwersms, mikrotik';
					break;
					
					case 'mt_host':
						$config[$idx]['description'] = 'adres IP mikrotika';
					break;
					
					case 'mt_password':
						$config[$idx]['description'] = 'hasło do zalogowania się';
					break;
					
					case 'mt_usb':
						$config[$idx]['description'] = 'port usb do którego jest podpięty modem';
					break;
					
					case 'mt_username':
						$config[$idx]['description'] = 'nazwa użytkownika';
					break;
					
					case 'mt_port':
						$config[$idx]['description'] = 'port na którym działa API na MT';
					break;
					
					case 'mt_debug':
						$config[$idx]['description'] = 'włączenie dodatkowych informacji, używać w razie problemów z wysyłką';
					break;
					
					case 'mt_partreverse':
						$config[$idx]['description'] = 'odwraca kolejność wysyłanych części<br>Wartość 0 : wysyłka jest w kolejności od pierwszej do ostatniej części<br>Wartość 1 : wysyłka w kolejności od ostatniej do pierwszej';
					break;

					case 'prefix':
						$config[$idx]['description'] = trans('Country prefix code, needed for number validation. Default: 48');
					break;

					case 'from':
						$config[$idx]['description'] = trans('Default sender of a text message.');
					break;

					case 'username':
						$config[$idx]['description'] = 'Nazwa użytkownika';
					break;

					case 'password':
						$config[$idx]['description'] = trans('Password for smscenter service');
					break;
					
					case 'smscenter_type':
						$config[$idx]['description'] = trans('Type of account you have at smscenter service. LMS will add sender at the end of message, when static type has been set. Correct values are: static and dynamic');
					break;
					
					case 'smsapi_eco':
						$config[$idx]['description'] = 'SMSAPI / SerwerSMS - Wysyłka ekonomicznej wiadomości, bez pola nadawcy. DEF.: 1';
					break;
					
					case 'smsapi_fast':
						$config[$idx]['description'] = 'SMSAPI - Szybka wysyłka wiadomości. DEF.: 0';
					break;
					
					case 'smsapi_nounicode':
						$config[$idx]['description'] = 'SMSAPI - Ustawienie 1 zabezpiecza przed wysłaniem wiadomości ze znakami specjalnymi (w tym polskimi). DEF.: 1';
					break;
					
					case 'smsapi_normalize':
						$config[$idx]['description'] = 'SMSAPI - Powoduje zmianę polskich znaków na odpowiedniki łacińskie. DEF.: 1';
					break;
					
					case 'smsapi_max_parts':
						$config[$idx]['description'] = 'SMSAPI - Parametr określa maksymalną ilość częsci z jakich może składać się wiadomość, maksymalnie to 6. DEF.: 3';
					break;
					
					case 'smsapi_skip_foreign':
						$config[$idx]['description'] = 'SMSAPI - Ustawienie tego parametru na 1, powoduje pominięcie numerów niepolskich. DEF.: 1';
					break;
					
					case 'encoding':
						$config[$idx]['description'] = 'Kodowanie wiadomości smstools (UTF8, UCS2). DEF.: UCS2';
					break;
					
                                        case 'asterisk_host':
                                                $config[$idx]['description'] = 'Adres managera asteriska.';
                                        break;

                                        case 'asterisk_port':
                                                $config[$idx]['description'] = 'Port managera asteriska.';
                                        break;

                                        case 'asterisk_login':
                                                $config[$idx]['description'] = 'Login managera asteriska.';
                                        break;

                                        case 'asterisk_passwd':
                                                $config[$idx]['description'] = 'Hasło managera asteriska.';
                                        break;

                                        case 'asterisk_action':
                                                $config[$idx]['description'] = 'Action managera asteriska. DEF.: Action: smscommand';
                                        break;

                                        case 'asterisk_command':
                                                $config[$idx]['description'] = 'Command managera asteriska. DEF.: command: gsm send sms 2';
                                        break;

					default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				} //end: var
			break;
			
			case 'gadugadu':
				switch($item['var'])
				{
					case 'gg_number':
						$config[$idx]['description'] = 'Numer konta Gadu-Gadu';
					break;

					case 'gg_passwd':
						$config[$idx]['description'] = 'Hasło do konta Gadu-Gadu';
					break;
					
					case 'gg_signature_statuson':
						$config[$idx]['description'] = 'Domyślny podpis jaki będzie ustawiony gdy konto będzie aktywne';
					break;
					
					case 'gg_signature_statusoff':
						$config[$idx]['description'] = 'Domyślny podpis jaki będzie ustawiony gdy konto będzie nieaktywne';
					break;
					
					case 'gg_header':
						$config[$idx]['description'] = 'Tekst jaki będzie dołączony na początku każdej wiadomości';
					break;
					
					case 'gg_footer':
						$config[$idx]['description'] = 'Tekst jaki będzie dołączony na końcu każdej wiadomości';
					break;

    				default:
						$config[$idx]['description'] = trans('Unknown option. No description.');
					break;
				} //end: var
			break;
			
			case 'monit':
				switch($item['var'])
				{
					case 'active_monitoring'	: $config[$idx]['description'] = 'czy monitorować hosty,wartość globalna, jeżeli ustawimy 0 to nie będą przeprowadzane testy.<br><b>DEFAULT: 1</b>';break;
					case 'display_chart_in_node_box'	: $config[$idx]['description'] = 'Wyświetlaj wykres testu ping i statystyk syngałów w karcie komputera.<br><b>DEFAULT: 1</b>';break;
//					case 'lms_password'		: $config[$idx]['description'] = 'Hasło użytkownika';break;
//					case 'lms_url'			: $config[$idx]['description'] = 'Adres URL do LMS, Domyślnie: http://localhost/lms ';break;
//					case 'lms_user'			: $config[$idx]['description'] = 'Nazwa użytkownika (login)';break;
//					case 'netdev_clear'		: $config[$idx]['description'] = 'Ilość dni trzymanych statystyk testów, starsze wpisy będą kasowane'; break;
					case 'netdev_test'		: $config[$idx]['description'] = 'Włącz testowanie hostów (urządzeń) sieciowych'; break;
					case 'netdev_test_port'		: $config[$idx]['description'] = 'Domyślny port dla protokołu tcp'; break;
					case 'netdev_test_type'		: $config[$idx]['description'] = 'Domyślny protokół lub usługa jaka będzie użyta do testów dla urządzeń sieciowych.<br>dozwolone wartości : icmp, http, https, ssh, ftp, telnet, callbook, rpcbind, samba, pptp, mysql, smtp, dns, nfs, postgresql<br><b>DEFAULT: icmp</b>'; break;
					case 'netdev_time_max'		: $config[$idx]['description'] = 'Wartość maksymalna czasu odpowiedzi w ms dla testowanych urządzeń sieciowych. Po przekroczeniu tej wartości podczas testu, zostanie wysłana odpowiednia informacja. DEFAULT: 100'; break;
					case 'netdev_time_send'		: $config[$idx]['description'] = 'Wyślij informację o przekroczonych czasach odpowiedzi dla urządzeń sieciowych. Wartość domyślna , DEFAULT: 1'; break;
					case 'netdev_timeout_level'	: $config[$idx]['description'] = 'Poziom wysyłąnia informacji o braku aktywności<br>low - informuj przy drugim przebiegu testu jeżeli urządzenie dalej nie odpowiada<br>high - informuj natychmiast jeżeli urządzenie jest nieaktywne DEFAULT: low<br>Ustawienie domyślne '; break;
					case 'netdev_timeout_send'	: $config[$idx]['description'] = 'Wyślij informację o braku aktywności urządzenia sieciowego, wartość domyślna dla testowanych urządzeń. DEFAULT: 1 '; break;
//					case 'nodes_clear'		: $config[$idx]['description'] = 'Ilość dni trzymanych statystyk testów, starsze wpisy będą kasowane'; break;
					case 'nodes_test'		: $config[$idx]['description'] = 'Włącz testowanie hostów (urządzeń) klientów'; break;
					case 'nodes_test_port'		: $config[$idx]['description'] = 'Domyślny port dla protokołu tcp'; break;
					case 'nodes_test_type'		: $config[$idx]['description'] = 'Domyślny protokół lub usługa jaka będzie użyta do testów dla urządzeń klientów. DEFAULT: icmp<br>dozwolone wartości : icmp, http, https, ssh, ftp, telnet, callbook, rpcbind, samba, pptp, mysql, smtp, dns, nfs, postgresql'; break;
					case 'nodes_time_max'		: $config[$idx]['description'] = 'Wartość maksymalna czasu odpowiedzi w ms dla testowanych urządzeń klientów. Po przekroczeniu tej wartości podczas testu, zostanie wysłana odpowiednia informacja. DEFAULT: 150'; break;
					case 'nodes_time_send'		: $config[$idx]['description'] = 'Wyślij informację o przekroczonych czasach odpowiedzi dla urządzeń klientów. Wartość domyślna , DEFAULT: 1'; break;
					case 'nodes_timeout_level'	: $config[$idx]['description'] = 'Poziom wysyłąnia informacji o braku aktywności<br>low - informuj przy drugim przebiegu testu jeżeli urządzenie dalej nie odpowiada<br>high - informuj natychmiast jeżeli urządzenie jest nieaktywne DEFAULT: low<br>Ustawienie domyślne '; break;
					case 'nodes_timeout_send'	: $config[$idx]['description'] = 'Wyślij informację o braku aktywności urządzenia sieciowego, wartość domyślna dla testowanych urządzeń. DEFAULT: 1 '; break;
//					case 'owner_clear'		: $config[$idx]['description'] = 'Ilość dni trzymanych statystyk testów, starsze wpisy będą kasowane'; break;
					case 'owner_test'		: $config[$idx]['description'] = 'Włącz testowanie własnych hostów'; break;
					case 'owner_test_port'		: $config[$idx]['description'] = 'Domyślny port dla protokołu tcp'; break;
					case 'owner_test_type'		: $config[$idx]['description'] = 'Domyślny protokół lub usługa jaka będzie użyta do testów dla własnych urządzeń. DEFAULT: icmp<br>dozwolone wartości : icmp, http, https, ssh, ftp, telnet, callbook, rpcbind, samba, pptp, mysql, smtp, dns, nfs, postgresql'; break;
					case 'owner_time_max'		: $config[$idx]['description'] = 'Wartość maksymalna czasu odpowiedzi w ms dla testowanych urządzeń . Po przekroczeniu tej wartości podczas testu, zostanie wysłana odpowiednia informacja. DEFAULT: 150'; break;
					case 'owner_time_send'		: $config[$idx]['description'] = 'Wyślij informację o przekroczonych czasach odpowiedzi dla własnych urządzeń. Wartość domyślna , DEFAULT: 1'; break;
					case 'owner_timeout_level'	: $config[$idx]['description'] = 'Poziom wysyłąnia informacji o braku aktywności<br>low - informuj przy drugim przebiegu testu jeżeli urządzenie dalej nie odpowiada<br>high - informuj natychmiast jeżeli urządzenie jest nieaktywne DEFAULT: low<br>Ustawienie domyślne '; break;
					case 'owner_timeout_send'	: $config[$idx]['description'] = 'Wyślij informację o braku aktywności własnych urządzenia sieciowego, wartość domyślna dla testowanych urządzeń. DEFAULT: 1 '; break;
					case 'packetsize'		: $config[$idx]['description'] = 'waga pakietu w bajtach podczas pingowania.<BR><B>DEFAULT:</B> 32';break;
					case 'smtp_host'		: $config[$idx]['description'] = 'adres smtp serwera pocztowego.<BR><B>DEFAULT:</B> localhost';break;
					case 'smtp_user'		: $config[$idx]['description'] = 'nazwa użytkownika, najlepiej wraz z domeną.<BR><B>DEFAULT:</B> root';break;
					case 'smtp_pass'		: $config[$idx]['description'] = 'hasło użytkownika do skrzynki pocztowej.<BR><B>DEFAULT:</B> ';break;
					case 'smtp_auth'		: $config[$idx]['description'] = 'typ autoryzacji : LOGIN, PLAIN, CRAM-MD5, NTLM.<BR><B>DEFAULT:</B> LOGIN';break;
					case 'smtp_port'		: $config[$idx]['description'] = 'port na którym słucha serwer smtp.<BR><B>DEFAULT:</B> 25';break;
					case 'send_to_email'		: $config[$idx]['description'] = 'Pozwól na wysyłanie informacji pocztą elekroniczą. DEFAULT: 1. Ustawienie globalne'; break;
					case 'send_to_gg'		: $config[$idx]['description'] = 'Pozwól na wysyłanie wiadomości przez komunikator Gadu-Gadu. DEFAULT.: 1. Ustawienie globalne'; break;
					case 'send_to_sms'		: $config[$idx]['description'] = 'Pozwól na wysyłanie informacji poprzez sms. DEFAULT.: 1. Ustawienie Globalne'; break;
					case 'test_script_dir'		: $config[$idx]['description'] = 'ścieżka do skryptu lms-monitoring.pl<BR><B>DEFAULT:</B> /usr/local/sbin/lms-monitoring.pl';break;
//					case 'img_gen'			: $config[$idx]['description'] = 'automatycznie generuj wykres do obrazka w formacie IP_HOSTA.png, wygenerowane wykresy możemy potem wykorzystać we własnych stronach.<BR>LMS na swoje potrzeby generuje w "locie" wykresy i nie są one powiązane z tą zmienną.<BR><B>DEFAULT:</B> false';break;
//					case 'img_dir'			: $config[$idx]['description'] = 'ścieżka gdzie mają być generowane wykresy dla poszczególnych urządzeń.<BR><B>DEFAULT:</B> /var/www/lms/img/monit';break;
//					case 'img_time'			: $config[$idx]['description'] = 'przedział czasowy wykresu od kiedy ma być wygenerowany do "teraz", podajemy w formacie : -1h -6h -12 -1d -3d itd..<BR><B>DEFAULT:</B> -1d';break;
//					case 'image_width'		: $config[$idx]['description'] = 'szerokość generowanego obrazka w px. widocznego w karcie komputera/urządzenia sieciowego<BR><B>DEFAULT:</B> 450';break;
//					case 'image_height'		: $config[$idx]['description'] = 'wysokość generowanego obrazka w px. widocznego w karcie komputera/urządzenia sieciowego<BR><B>DEFAULT:</B> 250';break;
//					case 'image_width'		: $config[$idx]['description'] = 'szerokość generowanego obrazka w px. widocznego w karcie komputera/urządzenia sieciowego<BR><B>DEFAULT:</B> 530';break;
//					case 'image_height'		: $config[$idx]['description'] = 'wysokość generowanego obrazka w px. widocznego w karcie klienta sieciowego<BR><B>DEFAULT:</B> 320';break;
//					case 'rrd_dir'			: $config[$idx]['description'] = 'ścieżka zapisu danych dla rrdtool.<BR><B>DEFAULT:</B> /var/www/lms/rrd';break;
					case 'rrdtool_dir'		: $config[$idx]['description'] = 'pełna ścieżka do  rrdtool<BR><B>DEFAULT:</B> /usr/bin/rrdtool';break;
//					case 'grep_dir'			: $config[$idx]['description'] = 'ścieżka do binarki grep.<BR><B>DEFAULT:</B> /bin/grep';break;
//					case 'awk_dir'			: $config[$idx]['description'] = 'ścieżka do binarki awk.<BR><B>DEFAULT:</B> /usr/bin/awk';break;
					case 'step_test_netdev'		: $config[$idx]['description'] = 'czas w minutach co ile jest robiony test dla urządzeń sieciowych, w przypadku interwału należy wyczyścić statystyki pomiarów inaczej będą błędy na wykresach<BR><B>DEFAULT:</B> 5';break;
					case 'step_test_nodes'		: $config[$idx]['description'] = 'czas w minutach co ile jest robiony test dla urządzeń klientów, w przypadku zmiany interwału  należy wyczyścić statystyki pomiarów inaczej będą błędy na wykresach<BR><B>DEFAULT:</B> 10';break;
					case 'step_test_owner'		: $config[$idx]['description'] = 'czas w minutach co ile jest robiony test dla własnych urządzeń, w przypadku zmiany interwału należy wyczyścić statystyki pomiarów inaczej będą błędy na wykresach<BR><B>DEFAULT:</B> 10';break;
					case 'live_ping'		: $config[$idx]['description'] = 'włącz dodatek LIVE PING.<br><b>DEFAULT: 1</b>';break;
					
					case 'step_test_signal'		: $config[$idx]['description'] = 'czas w minutach co ile jest robiony test sygnałów Wi-Fi, w przypadku zmiany wartości należy wyczyścić statystyki pomiarów inaczej będą błędy na wykresach<BR><B>DEFAULT:</B> 15';break;
					case 'signal_test'		: $config[$idx]['description'] = 'włącz pomiary sygnałów Wi-Fi';break;
					
					default				: $config[$idx]['description'] = 'Nieznana opcja lub brak opisu';break;
				} //end: monit
			break;
			
                       case 'zones':
                                switch($item['var'])
                                {
                                        case 'hostmaster_mail':
                                                $config[$idx]['description'] = trans('Domain admin e-mail address.');
                                        break;
                                        case 'master_dns':
                                                $config[$idx]['description'] = trans('Primary Name Server name (should be a FQDN).');
                                        break;
                                        case 'slave_dns':
                                                $config[$idx]['description'] = trans('Secondary Name Server name (should be a FQDN).');
                                        break;
                                        case 'default_mx':
                                                $config[$idx]['description'] = trans('Mail Exchange (MX) name record which identifies the name of the server that handles mail for domain (should be a FQDN).');
                                        break;
                                        case 'default_ttl':
                                                $config[$idx]['description'] = trans('The default expiration time of a resource record. Default 86400.');
                                        break;
                                        case 'ttl_refresh':
                                                $config[$idx]['description'] = trans('Time after slave server refreshes records. Default 28800.');
                                        break;
                                        case 'ttl_retry':
                                                $config[$idx]['description'] = trans('Slave server retry time in case of a problem. Default 7200.');
                                        break;
                                        case 'ttl_expire':
                                                $config[$idx]['description'] = trans('Records expiration time. Default 604800.');
                                        break;
                                        case 'ttl_minimum':
                                                $config[$idx]['description'] = trans('Minimum caching time in case of failed lookups. Default 86400.');
                                        break;
                                        case 'default_webserver_ip':
                                                $config[$idx]['description'] = trans('IP address of webserver');
                                        break;
                                        case 'default_mailserver_ip':
                                                $config[$idx]['description'] = trans('IP address of mailserver');
                                        break;
                                        case 'default_spf':
                                                $config[$idx]['description'] = trans('Default SPF record. If you leave the field blank, record will not add. Example: "v=spf1 a mx ip4:ADDRESS_MAILSERVER ~all" (Put in quotes).');
                                        break;
                                } //end: var
                        break;
		    default:
				$config[$idx]['description'] = trans('Unknown option. No description.');
			break;
		} //end: section
	} //end: foreach

	$config['total'] = sizeof($config);
	$config['order'] = $order;
	$config['direction'] = $direction;
	$config['section'] = $section;

	return $config;
}

$layout['pagetitle'] = trans('User Interface Configuration');

if(!isset($_GET['o']))
	$SESSION->restore('conlo', $o);
else
	$o = $_GET['o'];
$SESSION->save('conlo', $o);

if(!isset($_GET['s']))
        $SESSION->restore('conls', $s);
else
	$s = $_GET['s'];
$SESSION->save('conls', $s);

if(!isset($_GET['n']))
    $SESSION->restore('conln', $n);
else
	$n = $_GET['n'];
$SESSION->save('conln', $n);

if ($SESSION->is_set('conlp') && !isset($_GET['page']))
	$SESSION->restore('conlp', $_GET['page']);

$configlist = GetConfigList($o, $s, $n);

$listdata['total'] = $configlist['total'];
$listdata['order'] = $configlist['order'];
$listdata['direction'] = $configlist['direction'];
$listdata['section'] = $configlist['section'];
$listdata['search'] = $n;

unset($configlist['total']);
unset($configlist['order']);
unset($configlist['direction']);
unset($configlist['section']);

$page = (!isset($_GET['page']) ? 1 : $_GET['page']); 
$pagelimit = (! $LMS->CONFIG['phpui']['configlist_pagelimit'] ? $listdata['total'] : $LMS->CONFIG['phpui']['configlist_pagelimit']);
$start = ($page - 1) * $pagelimit;

$SESSION->save('conlp', $page);

$SESSION->save('backto', $_SERVER['QUERY_STRING']);

$SMARTY->assign('pagelimit', $pagelimit);
$SMARTY->assign('page', $page);
$SMARTY->assign('start', $start);
$SMARTY->assign('configlist', $configlist);
$SMARTY->assign('listdata', $listdata);
$SMARTY->display('configlist.html');

?>
