let dom_array = {
    'user_type': {
        'RM': 'RM',
        'PI': 'PI',
        'FM': 'FM',
        'ED': 'ED',
        'Super Admin': 'Super Admin',
        'Team Member': 'Team Member'
    },
    'login_status': {
        'Active': 'Active',
        'Active': 'Inactive'
    },
    'status': {
        'Active': 'Active',
        'Inactive': 'Inactive'
    },
    'read_unread_dom': {
        '1': 'Read',
        '0': 'Unread'
    },
    'email_status': {
        'archived': 'Archived',
        'closed': 'Closed',
        'draft': 'In Draft',
        'read': 'Read',
        'replied': 'Replied',
        'sent': 'Sent',
        'send_error': 'Send Error',
        'unread': 'Unread',
        'Done': 'Done'
    },
    'module_dashlet': {
       // 'Categorys': 'Categorys',
       // 'SubCategorys': 'SubCategorys',
       // 'Products': 'Products',
        'Applications_active_chart': 'Active Application Chart',
        'Applications_active_table': 'Active Application Table',
        'Applications_active_counter': 'Active Application Counter',
        'Applications_open_table': 'Open Application Table',
        'Applications_open_chart': 'Upcoming Funding Calls',
       // 'Invitees_active_chart':'Recent Invitee Chart',
        'Invitees_active_table':'Recent Invitee Table',
        'Invitees_active_counter':'Recent Invitee Counter',
        // 'Opportunitys_active_chart':'Recent Opportunitys Chart',
        'Opportunitys_active_table': 'Recent Opportunitys Table',
        'Opportunitys_active_counter': 'Recent Opportunitys Counter',
        // 'ExpressionInterests_active_chart':'Recent EOI Chart',
        'ExpressionInterests_active_table': 'Recent EOI Table',
        'ExpressionInterests_active_counter': 'Recent EOI Counter',
        'Notifications_active_table': 'Recent Notifications',
        'Notifications_active_counter': 'Notifications Counter',
        'ApplicationBudgets_default_table': 'Recent Application Budgets',
        'ApplicationBudgets_default_counter': 'Application Budgets Counter',
        'TicketSystems_default_table': 'Recent Ticket System',
        'TicketSystems_default_counter': 'Ticket Systems Counter',
        'EdRequests_default_table': 'Recent Ed Requests',
        'EdRequests_default_counter': 'Ed Requests Counter',
        //'Orders':'Orders'
    },
    'graph_category': {
        'bar': 'bar',
        'bubble': 'bubble',
        'doughnut': 'doughnut',
        'line': 'line',
        'polarArea': 'polarArea',
        'radar': 'radar',
        'scatter': 'scatter',
    },

    'default_date_format': {
        'Y-m-d': '2006-12-23',
        'm-d-Y': '12-23-2006',
        'd-m-Y': '23-12-2006',
        'Y/m/d': '2006/12/23',
        'm/d/Y': '12/23/2006',
        'd/m/Y': '23/12/2006',
        'Y.m.d': '2006.12.23',
        'd.m.Y': '23.12.2006',
        'm.d.Y': '12.23.2006',
    },
    'default_time_format': {
        'H:i': '23:00',
        'h:ia': '11:00pm',
        'h:iA': '11:00PM',
        'H.i': '23.00',
        'h.ia': '11.00pm',
        'h.iA': '11.00PM',
    },
    'default_time_zone': {
        'Africa/Abidjan': 'Africa/Abidjan(GMT+0)',
        'Africa/Accra': 'Africa/Accra(GMT+0)',
        'Africa/Addis_Ababa': 'Africa/Addis Ababa(GMT+3)',
        'Africa/Algiers': 'Africa/Algiers(GMT+1)',
        'Africa/Asmera': 'Africa/Asmera(GMT+3)',
        'Africa/Bamako': 'Africa/Bamako(GMT+0)',
        'Africa/Bangui': 'Africa/Bangui(GMT+1)',
        'Africa/Banjul': 'Africa/Banjul(GMT+0)',
        'Africa/Bissau': 'Africa/Bissau(GMT+0)',
        'Africa/Blantyre': 'Africa/Blantyre(GMT+2)',
        'Africa/Brazzaville': 'Africa/Brazzaville(GMT+1)',
        'Africa/Bujumbura': 'Africa/Bujumbura(GMT+2)',
        'Africa/Cairo': 'Africa/Cairo(GMT+2) (+DST)',
        'Africa/Casablanca': 'Africa/Casablanca(GMT+0)',
        'Africa/Ceuta': 'Africa/Ceuta(GMT+1) (+DST)',
        'Africa/Conakry': 'Africa/Conakry(GMT+0)',
        'Africa/Dakar': 'Africa/Dakar(GMT+0)',
        'Africa/Dar_es_Salaam': 'Africa/Dar es Salaam(GMT+3)',
        'Africa/Djibouti': 'Africa/Djibouti(GMT+3)',
        'Africa/Douala': 'Africa/Douala(GMT+1)',
        'Africa/El_Aaiun': 'Africa/El Aaiun(GMT+0)',
        'Africa/Freetown': 'Africa/Freetown(GMT+0)',
        'Africa/Gaborone': 'Africa/Gaborone(GMT+2)',
        'Africa/Harare': 'Africa/Harare(GMT+2)',
        'Africa/Johannesburg': 'Africa/Johannesburg(GMT+2)',
        'Africa/Kampala': 'Africa/Kampala(GMT+3)',
        'Africa/Khartoum': 'Africa/Khartoum(GMT+3)',
        'Africa/Kigali': 'Africa/Kigali(GMT+2)',
        'Africa/Kinshasa': 'Africa/Kinshasa(GMT+1)',
        'Africa/Lagos': 'Africa/Lagos(GMT+1)',
        'Africa/Libreville': 'Africa/Libreville(GMT+1)',
        'Africa/Lome': 'Africa/Lome(GMT+0)',
        'Africa/Luanda': 'Africa/Luanda(GMT+1)',
        'Africa/Lubumbashi': 'Africa/Lubumbashi(GMT+2)',
        'Africa/Lusaka': 'Africa/Lusaka(GMT+2)',
        'Africa/Malabo': 'Africa/Malabo(GMT+1)',
        'Africa/Maputo': 'Africa/Maputo(GMT+2)',
        'Africa/Maseru': 'Africa/Maseru(GMT+2)',
        'Africa/Mbabane': 'Africa/Mbabane(GMT+2)',
        'Africa/Mogadishu': 'Africa/Mogadishu(GMT+3)',
        'Africa/Monrovia': 'Africa/Monrovia(GMT+0)',
        'Africa/Nairobi': 'Africa/Nairobi(GMT+3)',
        'Africa/Ndjamena': 'Africa/Ndjamena(GMT+1)',
        'Africa/Niamey': 'Africa/Niamey(GMT+1)',
        'Africa/Nouakchott': 'Africa/Nouakchott(GMT+0)',
        'Africa/Ouagadougou': 'Africa/Ouagadougou(GMT+0)',
        'Africa/Porto-Novo': 'Africa/Porto-Novo(GMT+1)',
        'Africa/Sao_Tome': 'Africa/Sao Tome(GMT+0)',
        'Africa/Tripoli': 'Africa/Tripoli(GMT+2)',
        'Africa/Tunis': 'Africa/Tunis(GMT+1) (+DST)',
        'Africa/Windhoek': 'Africa/Windhoek(GMT+1) (+DST)',
        'America/Adak': 'America/Adak(GMT-10) (+DST)',
        'America/Anchorage': 'America/Anchorage(GMT-9) (+DST)',
        'America/Anguilla': 'America/Anguilla(GMT-4)',
        'America/Antigua': 'America/Antigua(GMT-4)',
        'America/Araguaina': 'America/Araguaina(GMT-3)',
        'America/Argentina/Buenos_Aires': 'America/Argentina/Buenos Aires(GMT-3)',
        'America/Argentina/Catamarca': 'America/Argentina/Catamarca(GMT-3)',
        'America/Argentina/Cordoba': 'America/Argentina/Cordoba(GMT-3)',
        'America/Argentina/Jujuy': 'America/Argentina/Jujuy(GMT-3)',
        'America/Argentina/La_Rioja': 'America/Argentina/La Rioja(GMT-3)',
        'America/Argentina/Mendoza': 'America/Argentina/Mendoza(GMT-3)',
        'America/Argentina/Rio_Gallegos': 'America/Argentina/Rio Gallegos(GMT-3)',
        'America/Argentina/San_Juan': 'America/Argentina/San Juan(GMT-3)',
        'America/Argentina/Tucuman': 'America/Argentina/Tucuman(GMT-3)',
        'America/Argentina/Ushuaia': 'America/Argentina/Ushuaia(GMT-3)',
        'America/Aruba': 'America/Aruba(GMT-4)',
        'America/Asuncion': 'America/Asuncion(GMT-4) (+DST)',
        'America/Bahia': 'America/Bahia(GMT-3)',
        'America/Barbados': 'America/Barbados(GMT-4)',
        'America/Belem': 'America/Belem(GMT-3)',
        'America/Belize': 'America/Belize(GMT-6)',
        'America/Boa_Vista': 'America/Boa Vista(GMT-4)',
        'America/Bogota': 'America/Bogota(GMT-5)',
        'America/Boise': 'America/Boise(GMT-7) (+DST)',
        'America/Cambridge_Bay': 'America/Cambridge Bay(GMT-7) (+DST)',
        'America/Campo_Grande': 'America/Campo Grande(GMT-4) (+DST)',
        'America/Cancun': 'America/Cancun(GMT-6) (+DST)',
        'America/Caracas': 'America/Caracas(GMT-4)',
        'America/Cayenne': 'America/Cayenne(GMT-3)',
        'America/Cayman': 'America/Cayman(GMT-5)',
        'America/Chicago': 'America/Chicago(GMT-6) (+DST)',
        'America/Chihuahua': 'America/Chihuahua(GMT-7) (+DST)',
        'America/Coral_Harbour': 'America/Coral Harbour(GMT-5)',
        'America/Costa_Rica': 'America/Costa Rica(GMT-6)',
        'America/Cuiaba': 'America/Cuiaba(GMT-4) (+DST)',
        'America/Curacao': 'America/Curacao(GMT-4)',
        'America/Danmarkshavn': 'America/Danmarkshavn(GMT+0)',
        'America/Dawson': 'America/Dawson(GMT-8) (+DST)',
        'America/Dawson_Creek': 'America/Dawson Creek(GMT-7)',
        'America/Denver': 'America/Denver(GMT-7) (+DST)',
        'America/Detroit': 'America/Detroit(GMT-5) (+DST)',
        'America/Dominica': 'America/Dominica(GMT-4)',
        'America/Edmonton': 'America/Edmonton(GMT-7) (+DST)',
        'America/Eirunepe': 'America/Eirunepe(GMT-5)',
        'America/El_Salvador': 'America/El Salvador(GMT-6)',
        'America/Fortaleza': 'America/Fortaleza(GMT-3)',
        'America/Glace_Bay': 'America/Glace Bay(GMT-4) (+DST)',
        'America/Godthab': 'America/Godthab(GMT-3) (+DST)',
        'America/Goose_Bay': 'America/Goose Bay(GMT-4) (+DST)',
        'America/Grand_Turk': 'America/Grand Turk(GMT-5) (+DST)',
        'America/Grenada': 'America/Grenada(GMT-4)',
        'America/Guadeloupe': 'America/Guadeloupe(GMT-4)',
        'America/Guatemala': 'America/Guatemala(GMT-6)',
        'America/Guayaquil': 'America/Guayaquil(GMT-5)',
        'America/Guyana': 'America/Guyana(GMT-4)',
        'America/Halifax': 'America/Halifax(GMT-4) (+DST)',
        'America/Havana': 'America/Havana(GMT-5) (+DST)',
        'America/Hermosillo': 'America/Hermosillo(GMT-7)',
        'America/Indiana/Indianapolis': 'America/Indiana/Indianapolis(GMT-5) (+DST)',
        'America/Indiana/Knox': 'America/Indiana/Knox(GMT-5) (+DST)',
        'America/Indiana/Marengo': 'America/Indiana/Marengo(GMT-5) (+DST)',
        'America/Indiana/Vevay': 'America/Indiana/Vevay(GMT-5) (+DST)',
        'America/Inuvik': 'America/Inuvik(GMT-7) (+DST)',
        'America/Iqaluit': 'America/Iqaluit(GMT-5) (+DST)',
        'America/Jamaica': 'America/Jamaica(GMT-5)',
        'America/Juneau': 'America/Juneau(GMT-9) (+DST)',
        'America/Kentucky/Louisville': 'America/Kentucky/Louisville(GMT-5) (+DST)',
        'America/Kentucky/Monticello': 'America/Kentucky/Monticello(GMT-5) (+DST)',
        'America/La_Paz': 'America/La Paz(GMT-4)',
        'America/Lima': 'America/Lima(GMT-5)',
        'America/Los_Angeles': 'America/Los Angeles(GMT-8) (+DST)',
        'America/Maceio': 'America/Maceio(GMT-3)',
        'America/Managua': 'America/Managua(GMT-6) (+DST)',
        'America/Manaus': 'America/Manaus(GMT-4)',
        'America/Martinique': 'America/Martinique(GMT-4)',
        'America/Mazatlan': 'America/Mazatlan(GMT-7) (+DST)',
        'America/Menominee': 'America/Menominee(GMT-6) (+DST)',
        'America/Merida': 'America/Merida(GMT-6) (+DST)',
        'America/Mexico_City': 'America/Mexico City(GMT-6) (+DST)',
        'America/Miquelon': 'America/Miquelon(GMT-3) (+DST)',
        'America/Monterrey': 'America/Monterrey(GMT-6) (+DST)',
        'America/Montevideo': 'America/Montevideo(GMT-3) (+DST)',
        'America/Montreal': 'America/Montreal(GMT-5) (+DST)',
        'America/Montserrat': 'America/Montserrat(GMT-4)',
        'America/Nassau': 'America/Nassau(GMT-5) (+DST)',
        'America/New_York': 'America/New York(GMT-5) (+DST)',
        'America/Nipigon': 'America/Nipigon(GMT-5) (+DST)',
        'America/Nome': 'America/Nome(GMT-9) (+DST)',
        'America/Noronha': 'America/Noronha(GMT-2)',
        'America/North_Dakota/Center': 'America/N. Dakota/Center(GMT-6) (+DST)',
        'America/Panama': 'America/Panama(GMT-5)',
        'America/Pangnirtung': 'America/Pangnirtung(GMT-5) (+DST)',
        'America/Paramaribo': 'America/Paramaribo(GMT-3)',
        'America/Phoenix': 'America/Phoenix(GMT-7)',
        'America/Port-au-Prince': 'America/Port-au-Prince(GMT-5) (+DST)',
        'America/Port_of_Spain': 'America/Port of Spain(GMT-4)',
        'America/Porto_Velho': 'America/Porto Velho(GMT-4)',
        'America/Puerto_Rico': 'America/Puerto Rico(GMT-4)',
        'America/Rainy_River': 'America/Rainy River(GMT-6) (+DST)',
        'America/Rankin_Inlet': 'America/Rankin Inlet(GMT-6) (+DST)',
        'America/Recife': 'America/Recife(GMT-3)',
        'America/Regina': 'America/Regina(GMT-6)',
        'America/Rio_Branco': 'America/Rio Branco(GMT-5)',
        'America/Santiago': 'America/Santiago(GMT-4) (+DST)',
        'America/Santo_Domingo': 'America/Santo Domingo(GMT-4)',
        'America/Sao_Paulo': 'America/Sao Paulo(GMT-3) (+DST)',
        'America/Scoresbysund': 'America/Scoresbysund(GMT-1) (+DST)',
        'America/St_Johns': 'America/St Johns(GMT-3.5) (+DST)',
        'America/St_Kitts': 'America/St Kitts(GMT-4)',
        'America/St_Lucia': 'America/St Lucia(GMT-4)',
        'America/St_Thomas': 'America/St Thomas(GMT-4)',
        'America/St_Vincent': 'America/St Vincent(GMT-4)',
        'America/Swift_Current': 'America/Swift Current(GMT-6)',
        'America/Tegucigalpa': 'America/Tegucigalpa(GMT-6)',
        'America/Thule': 'America/Thule(GMT-4) (+DST)',
        'America/Thunder_Bay': 'America/Thunder Bay(GMT-5) (+DST)',
        'America/Tijuana': 'America/Tijuana(GMT-8) (+DST)',
        'America/Toronto': 'America/Toronto(GMT-5) (+DST)',
        'America/Tortola': 'America/Tortola(GMT-4)',
        'America/Vancouver': 'America/Vancouver(GMT-8) (+DST)',
        'America/Whitehorse': 'America/Whitehorse(GMT-8) (+DST)',
        'America/Winnipeg': 'America/Winnipeg(GMT-6) (+DST)',
        'America/Yakutat': 'America/Yakutat(GMT-9) (+DST)',
        'America/Yellowknife': 'America/Yellowknife(GMT-7) (+DST)',
        'Antarctica/Casey': 'Antarctica/Casey(GMT+8)',
        'Antarctica/Davis': 'Antarctica/Davis(GMT+7)',
        'Antarctica/DumontDUrville': 'Antarctica/DumontDUrville(GMT+10)',
        'Antarctica/Mawson': 'Antarctica/Mawson(GMT+6)',
        'Antarctica/McMurdo': 'Antarctica/McMurdo(GMT+12) (+DST)',
        'Antarctica/Palmer': 'Antarctica/Palmer(GMT-4) (+DST)',
        'Antarctica/Rothera': 'Antarctica/Rothera(GMT-3)',
        'Antarctica/Syowa': 'Antarctica/Syowa(GMT+3)',
        'Antarctica/Vostok': 'Antarctica/Vostok(GMT+6)',
        'Asia/Aden': 'Asia/Aden(GMT+3)',
        'Asia/Almaty': 'Asia/Almaty(GMT+6)',
        'Asia/Amman': 'Asia/Amman(GMT+2) (+DST)',
        'Asia/Anadyr': 'Asia/Anadyr(GMT+12) (+DST)',
        'Asia/Aqtau': 'Asia/Aqtau(GMT+5)',
        'Asia/Aqtobe': 'Asia/Aqtobe(GMT+5)',
        'Asia/Ashgabat': 'Asia/Ashgabat(GMT+5)',
        'Asia/Baghdad': 'Asia/Baghdad(GMT+3) (+DST)',
        'Asia/Bahrain': 'Asia/Bahrain(GMT+3)',
        'Asia/Baku': 'Asia/Baku(GMT+4) (+DST)',
        'Asia/Bangkok': 'Asia/Bangkok(GMT+7)',
        'Asia/Beirut': 'Asia/Beirut(GMT+2) (+DST)',
        'Asia/Bishkek': 'Asia/Bishkek(GMT+6)',
        'Asia/Brunei': 'Asia/Brunei(GMT+8)',
        '="Asia/Calcutta" selected="true': 'Asia/Calcutta(GMT+5.5)',
        'Asia/Choibalsan': 'Asia/Choibalsan(GMT+9) (+DST)',
        'Asia/Chongqing': 'Asia/Chongqing(GMT+8)',
        'Asia/Colombo': 'Asia/Colombo(GMT+6)',
        'Asia/Damascus': 'Asia/Damascus(GMT+2) (+DST)',
        'Asia/Dhaka': 'Asia/Dhaka(GMT+6)',
        'Asia/Dili': 'Asia/Dili(GMT+9)',
        'Asia/Dubai': 'Asia/Dubai(GMT+4)',
        'Asia/Dushanbe': 'Asia/Dushanbe(GMT+5)',
        'Asia/Gaza': 'Asia/Gaza(GMT+2) (+DST)',
        'Asia/Harbin': 'Asia/Harbin(GMT+8)',
        'Asia/Hong_Kong': 'Asia/Hong Kong(GMT+8)',
        'Asia/Hovd': 'Asia/Hovd(GMT+7) (+DST)',
        'Asia/Irkutsk': 'Asia/Irkutsk(GMT+8) (+DST)',
        'Asia/Jakarta': 'Asia/Jakarta(GMT+7)',
        'Asia/Jayapura': 'Asia/Jayapura(GMT+9)',
        'Asia/Jerusalem': 'Asia/Jerusalem(GMT+2) (+DST)',
        'Asia/Kabul': 'Asia/Kabul(GMT+4.5)',
        'Asia/Kamchatka': 'Asia/Kamchatka(GMT+12) (+DST)',
        'Asia/Karachi': 'Asia/Karachi(GMT+5)',
        'Asia/Kashgar': 'Asia/Kashgar(GMT+8)',
        'Asia/Katmandu': 'Asia/Katmandu(GMT+5.75)',
        'Asia/Krasnoyarsk': 'Asia/Krasnoyarsk(GMT+7) (+DST)',
        'Asia/Kuala_Lumpur': 'Asia/Kuala Lumpur(GMT+8)',
        'Asia/Kuching': 'Asia/Kuching(GMT+8)',
        'Asia/Kuwait': 'Asia/Kuwait(GMT+3)',
        'Asia/Macau': 'Asia/Macau(GMT+8)',
        'Asia/Magadan': 'Asia/Magadan(GMT+11) (+DST)',
        'Asia/Makassar': 'Asia/Makassar(GMT+8)',
        'Asia/Manila': 'Asia/Manila(GMT+8)',
        'Asia/Muscat': 'Asia/Muscat(GMT+4)',
        'Asia/Nicosia': 'Asia/Nicosia(GMT+2) (+DST)',
        'Asia/Novosibirsk': 'Asia/Novosibirsk(GMT+6) (+DST)',
        'Asia/Omsk': 'Asia/Omsk(GMT+6) (+DST)',
        'Asia/Oral': 'Asia/Oral(GMT+5)',
        'Asia/Phnom_Penh': 'Asia/Phnom Penh(GMT+7)',
        'Asia/Pontianak': 'Asia/Pontianak(GMT+7)',
        'Asia/Pyongyang': 'Asia/Pyongyang(GMT+9)',
        'Asia/Qatar': 'Asia/Qatar(GMT+3)',
        'Asia/Qyzylorda': 'Asia/Qyzylorda(GMT+6)',
        'Asia/Rangoon': 'Asia/Rangoon(GMT+6.5)',
        'Asia/Riyadh': 'Asia/Riyadh(GMT+3)',
        'Asia/Saigon': 'Asia/Saigon(GMT+7)',
        'Asia/Sakhalin': 'Asia/Sakhalin(GMT+10) (+DST)',
        'Asia/Samarkand': 'Asia/Samarkand(GMT+5)',
        'Asia/Seoul': 'Asia/Seoul(GMT+9)',
        'Asia/Shanghai': 'Asia/Shanghai(GMT+8)',
        'Asia/Singapore': 'Asia/Singapore(GMT+8)',
        'Asia/Taipei': 'Asia/Taipei(GMT+8)',
        'Asia/Tashkent': 'Asia/Tashkent(GMT+5)',
        'Asia/Tbilisi': 'Asia/Tbilisi(GMT+3) (+DST)',
        'Asia/Tehran': 'Asia/Tehran(GMT+3.5) (+DST)',
        'Asia/Thimphu': 'Asia/Thimphu(GMT+6)',
        'Asia/Tokyo': 'Asia/Tokyo(GMT+9)',
        'Asia/Ulaanbaatar': 'Asia/Ulaanbaatar(GMT+8) (+DST)',
        'Asia/Urumqi': 'Asia/Urumqi(GMT+8)',
        'Asia/Vientiane': 'Asia/Vientiane(GMT+7)',
        'Asia/Vladivostok': 'Asia/Vladivostok(GMT+10) (+DST)',
        'Asia/Yakutsk': 'Asia/Yakutsk(GMT+9) (+DST)',
        'Asia/Yekaterinburg': 'Asia/Yekaterinburg(GMT+5) (+DST)',
        'Asia/Yerevan': 'Asia/Yerevan(GMT+4) (+DST)',
        'Atlantic/Azores': 'Atlantic/Azores(GMT-1) (+DST)',
        'Atlantic/Bermuda': 'Atlantic/Bermuda(GMT-4) (+DST)',
        'Atlantic/Canary': 'Atlantic/Canary(GMT+0) (+DST)',
        'Atlantic/Cape_Verde': 'Atlantic/Cape Verde(GMT-1)',
        'Atlantic/Faeroe': 'Atlantic/Faeroe(GMT+0) (+DST)',
        'Atlantic/Madeira': 'Atlantic/Madeira(GMT+0) (+DST)',
        'Atlantic/Reykjavik': 'Atlantic/Reykjavik(GMT+0)',
        'Atlantic/South_Georgia': 'Atlantic/South Georgia(GMT-2)',
        'Atlantic/St_Helena': 'Atlantic/St Helena(GMT+0)',
        'Atlantic/Stanley': 'Atlantic/Stanley(GMT-4) (+DST)',
        'Australia/Adelaide': 'Australia/Adelaide(GMT+9.5) (+DST)',
        'Australia/Brisbane': 'Australia/Brisbane(GMT+10)',
        'Australia/Broken_Hill': 'Australia/Broken Hill(GMT+9.5) (+DST)',
        'Australia/Currie': 'Australia/Currie(GMT+10) (+DST)',
        'Australia/Darwin': 'Australia/Darwin(GMT+9.5)',
        'Australia/Hobart': 'Australia/Hobart(GMT+10) (+DST)',
        'Australia/Lindeman': 'Australia/Lindeman(GMT+10)',
        'Australia/Melbourne': 'Australia/Melbourne(GMT+10) (+DST)',
        'Australia/Perth': 'Australia/Perth(GMT+8) (+DST)',
        'Australia/Sydney': 'Australia/Sydney(GMT+10) (+DST)',
        'CET': 'CET(GMT+1) (+DST)',
        'EET': 'EET(GMT+2) (+DST)',
        'Europe/Amsterdam': 'Europe/Amsterdam(GMT+1) (+DST)',
        'Europe/Andorra': 'Europe/Andorra(GMT+1) (+DST)',
        'Europe/Athens': 'Europe/Athens(GMT+2) (+DST)',
        'Europe/Belgrade': 'Europe/Belgrade(GMT+1) (+DST)',
        'Europe/Berlin': 'Europe/Berlin(GMT+1) (+DST)',
        'Europe/Brussels': 'Europe/Brussels(GMT+1) (+DST)',
        'Europe/Bucharest': 'Europe/Bucharest(GMT+2) (+DST)',
        'Europe/Budapest': 'Europe/Budapest(GMT+1) (+DST)',
        'Europe/Chisinau': 'Europe/Chisinau(GMT+2) (+DST)',
        'Europe/Copenhagen': 'Europe/Copenhagen(GMT+1) (+DST)',
        'Europe/Dublin': 'Europe/Dublin(GMT+0) (+DST)',
        'Europe/Gibraltar': 'Europe/Gibraltar(GMT+1) (+DST)',
        'Europe/Helsinki': 'Europe/Helsinki(GMT+2) (+DST)',
        'Europe/Istanbul': 'Europe/Istanbul(GMT+2) (+DST)',
        'Europe/Kaliningrad': 'Europe/Kaliningrad(GMT+2) (+DST)',
        'Europe/Kiev': 'Europe/Kiev(GMT+2) (+DST)',
        'Europe/Lisbon': 'Europe/Lisbon(GMT+0) (+DST)',
        'Europe/London': 'Europe/London(GMT+0) (+DST)',
        'Europe/Luxembourg': 'Europe/Luxembourg(GMT+1) (+DST)',
        'Europe/Madrid': 'Europe/Madrid(GMT+1) (+DST)',
        'Europe/Malta': 'Europe/Malta(GMT+1) (+DST)',
        'Europe/Minsk': 'Europe/Minsk(GMT+2) (+DST)',
        'Europe/Monaco': 'Europe/Monaco(GMT+1) (+DST)',
        'Europe/Moscow': 'Europe/Moscow(GMT+3) (+DST)',
        'Europe/Oslo': 'Europe/Oslo(GMT+1) (+DST)',
        'Europe/Paris': 'Europe/Paris(GMT+1) (+DST)',
        'Europe/Prague': 'Europe/Prague(GMT+1) (+DST)',
        'Europe/Riga': 'Europe/Riga(GMT+2) (+DST)',
        'Europe/Rome': 'Europe/Rome(GMT+1) (+DST)',
        'Europe/Samara': 'Europe/Samara(GMT+4) (+DST)',
        'Europe/Simferopol': 'Europe/Simferopol(GMT+2) (+DST)',
        'Europe/Sofia': 'Europe/Sofia(GMT+2) (+DST)',
        'Europe/Stockholm': 'Europe/Stockholm(GMT+1) (+DST)',
        'Europe/Tallinn': 'Europe/Tallinn(GMT+2) (+DST)',
        'Europe/Tirane': 'Europe/Tirane(GMT+1) (+DST)',
        'Europe/Uzhgorod': 'Europe/Uzhgorod(GMT+2) (+DST)',
        'Europe/Vaduz': 'Europe/Vaduz(GMT+1) (+DST)',
        'Europe/Vienna': 'Europe/Vienna(GMT+1) (+DST)',
        'Europe/Vilnius': 'Europe/Vilnius(GMT+2) (+DST)',
        'Europe/Warsaw': 'Europe/Warsaw(GMT+1) (+DST)',
        'Europe/Zaporozhye': 'Europe/Zaporozhye(GMT+2) (+DST)',
        'Europe/Zurich': 'Europe/Zurich(GMT+1) (+DST)',
        'Indian/Antananarivo': 'Indian/Antananarivo(GMT+3)',
        'Indian/Chagos': 'Indian/Chagos(GMT+6)',
        'Indian/Christmas': 'Indian/Christmas(GMT+7)',
        'Indian/Cocos': 'Indian/Cocos(GMT+6.5)',
        'Indian/Comoro': 'Indian/Comoro(GMT+3)',
        'Indian/Kerguelen': 'Indian/Kerguelen(GMT+5)',
        'Indian/Mahe': 'Indian/Mahe(GMT+4)',
        'Indian/Maldives': 'Indian/Maldives(GMT+5)',
        'Indian/Mauritius': 'Indian/Mauritius(GMT+4)',
        'Indian/Mayotte': 'Indian/Mayotte(GMT+3)',
        'Indian/Reunion': 'Indian/Reunion(GMT+4)',
        'MET': 'MET(GMT+1) (+DST)',
        'Pacific/Apia': 'Pacific/Apia(GMT-11)',
        'Pacific/Auckland': 'Pacific/Auckland(GMT+12) (+DST)',
        'Pacific/Chatham': 'Pacific/Chatham(GMT+12.75) (+DST)',
        'Pacific/Easter': 'Pacific/Easter(GMT-6) (+DST)',
        'Pacific/Efate': 'Pacific/Efate(GMT+11)',
        'Pacific/Enderbury': 'Pacific/Enderbury(GMT+13)',
        'Pacific/Fakaofo': 'Pacific/Fakaofo(GMT-10)',
        'Pacific/Fiji': 'Pacific/Fiji(GMT+12)',
        'Pacific/Funafuti': 'Pacific/Funafuti(GMT+12)',
        'Pacific/Galapagos': 'Pacific/Galapagos(GMT-6)',
        'Pacific/Gambier': 'Pacific/Gambier(GMT-9)',
        'Pacific/Guadalcanal': 'Pacific/Guadalcanal(GMT+11)',
        'Pacific/Guam': 'Pacific/Guam(GMT+10)',
        'Pacific/Honolulu': 'Pacific/Honolulu(GMT-10)',
        'Pacific/Johnston': 'Pacific/Johnston(GMT-10)',
        'Pacific/Kiritimati': 'Pacific/Kiritimati(GMT+14)',
        'Pacific/Kosrae': 'Pacific/Kosrae(GMT+11)',
        'Pacific/Kwajalein': 'Pacific/Kwajalein(GMT+12)',
        'Pacific/Majuro': 'Pacific/Majuro(GMT+12)',
        'Pacific/Marquesas': 'Pacific/Marquesas(GMT-9.5)',
        'Pacific/Midway': 'Pacific/Midway(GMT-11)',
        'Pacific/Nauru': 'Pacific/Nauru(GMT+12)',
        'Pacific/Niue': 'Pacific/Niue(GMT-11)',
        'Pacific/Norfolk': 'Pacific/Norfolk(GMT+11.5)',
        'Pacific/Noumea': 'Pacific/Noumea(GMT+11)',
        'Pacific/Pago_Pago': 'Pacific/Pago Pago(GMT-11)',
        'Pacific/Palau': 'Pacific/Palau(GMT+9)',
        'Pacific/Pitcairn': 'Pacific/Pitcairn(GMT-8)',
        'Pacific/Ponape': 'Pacific/Ponape(GMT+11)',
        'Pacific/Port_Moresby': 'Pacific/Port Moresby(GMT+10)',
        'Pacific/Rarotonga': 'Pacific/Rarotonga(GMT-10)',
        'Pacific/Saipan': 'Pacific/Saipan(GMT+10)',
        'Pacific/Tahiti': 'Pacific/Tahiti(GMT-10)',
        'Pacific/Tarawa': 'Pacific/Tarawa(GMT+12)',
        'Pacific/Tongatapu': 'Pacific/Tongatapu(GMT+13)',
        'Pacific/Truk': 'Pacific/Truk(GMT+10)',
        'Pacific/Wake': 'Pacific/Wake(GMT+12)',
        'Pacific/Wallis': 'Pacific/Wallis(GMT+12)',
        'WET': 'WET(GMT+0) (+DST)',
    },
    'default_language': {
        'en_us': 'English (US)',
        'jp_jp': 'Japanese'
    },
    'default_export_charset': {
        'BIG-5': 'BIG-5',
        'CP1251': 'CP1251',
        'CP1252': 'CP1252',
        'EUC-CN': 'EUC-CN',
        'EUC-JP': 'EUC-JP',
        'EUC-KR': 'EUC-KR',
        'EUC-TW': 'EUC-TW',
        'ISO-2022-JP': 'ISO-2022-JP',
        'ISO-2022-KR': 'ISO-2022-KR',
        'ISO-8859-1': 'ISO-8859-1',
        'ISO-8859-2': 'ISO-8859-2',
        'ISO-8859-3': 'ISO-8859-3',
        'ISO-8859-4': 'ISO-8859-4',
        'ISO-8859-5': 'ISO-8859-5',
        'ISO-8859-6': 'ISO-8859-6',
        'ISO-8859-7': 'ISO-8859-7',
        'ISO-8859-8': 'ISO-8859-8',
        'ISO-8859-9': 'ISO-8859-9',
        'ISO-8859-10': 'ISO-8859-10',
        'ISO-8859-13': 'ISO-8859-13',
        'ISO-8859-14': 'ISO-8859-14',
        'ISO-8859-15': 'ISO-8859-15',
        'KOI8-R': 'KOI8-R',
        'KOI8-U': 'KOI8-U',
        'SJIS': 'SJIS',
        'UTF-8': 'UTF-8'
    },
    'scheme_type': {
        'Fellowship': 'Fellowship',
        'Grant': 'Grant',
    },
    'opportunity_year': {
        '1': '1 Years',
        '2': '2 Years',
        '3': '3 Years',
        '4': '4 Years',
        '5': '5 Years',
    },
    'strategic_priority': {
        'BC': 'BC',
        'BT': 'BT',
        'HS': 'HS',
    },
    'ticket_type': {
        'ED Support': 'ED Support',
        'Others': 'Others',
    },
    'ticket_status': {
        'Open': 'Open',
        'Cancelled': 'Cancelled',
        'Resolved': 'Resolved',
    },
    'application_stages': {
        'Under development': {
            name: 'Under development',
            text:'',
        },
        'Application ready for review': {
            name: 'Application ready for review',
            text:
                ' Download the guidance template from the application work package.<br/>Upload your draft for Internal peer review under documents.<br/>Upload your Budget for Finance review under documents.<br/>Once you have.<br/>uploaded the documents, mark the stage as complete.<br/>You will be notified once you receive comments from internal peer reviewers and the finance team.<br/>In case you need help from the research team, please raise a ticket. For communicating with your team members, use the comments section',
        },
        'Technical review': {
            name: 'Technical review',
            text:
                'Application is being reviewed. You will be notified once you receive comments from internal peer reviewers and the finance team, In case you need help from the research team, please raise a ticket. For communicating with your team members, use the comments section.',
        },
        'Budget Review': {
            name: 'Budget Review',
            text:
                'Application is being reviewed. You will be notified once you receive comments from internal peer reviewers and the finance team, In case you need help from the research team, please raise a ticket. For communicating with your team members, use the comments section.',
        },
        'ED approval': {
            name: 'ED approval',
            text:
                'Application is being reviewed. You will be notified once you receive comments from internal peer reviewers and the finance team, In case you need help from the research team, please raise a ticket. For communicating with your team members, use the comments section.',
        },
        'Pending submission': {
            name: 'Pending submission',
            text:
                ' Please upload your application documents on the portal as per the shared deadline<br/> After submitting the application, share the final version of your application, a proof of submission and the final budget under documents. (This information needs to be in JSON format, should we create a separate pop- up for the final files?) and mark the stage as complete',
        },
        'Submitted': {
            name: 'Submitted',
            text:
                '',
        },
    },
    'application_stages_filter': {
        'Under development': 'Under development',
        'Application ready for review': 'Application ready for review',
        'Technical review': 'Technical review',
        'Budget Review': 'Budget Review',
        'ED approval': 'ED approval',
        'Pending submission': 'Pending submission',
        'Submitted': 'Submitted',
    },
    'ed_request_status': {
        'Requested': 'Requested',
        'Approved': 'Approved',
    },
    'listview_statusColor_dom': {
        'Pending': 'primaryStatus',
        'Confirm': 'infoStatus',
        'Done': 'successStatus',
        'Resolved': 'successStatus',
        'Cancelled': 'dangerStatus',
        'Approved': 'successStatus',
        'Delivered': 'closedStatus',
        'Open': 'primaryStatus',
        'Scheduled': 'infoStatus',
        'Performed': 'secondaryStatus',
        'Reported': 'successStatus',
        'Reschedule': 'closedStatus',
        'Waiting': 'secondaryStatus',
        'In Progress': 'infoStatus',
        'Not Reported': 'dangerStatus',
        'Close': 'closedStatus',
        'Assigned': 'infoStatus',
        'InProgress': 'infoStatus',
        'Closed': 'closedStatus',
        'Re-open': 'secondaryStatus',
        'Received': 'successStatus',
        'Active': 'infoStatus',
        'Inactive': 'closedStatus',
        'Canceled': 'closedStatus',
        'Rejected': 'dangerStatus',
        'Cancel': 'dangerStatus',
        'Expired': 'dangerStatus',
        'In': 'infoStatus',
        'Out': 'closedStatus',
        'Paid': 'successStatus',
        'New': 'primaryStatus',
        'Returned': 'secondaryStatus',
        'Completed': 'closedStatus',
        'Reopen': 'secondaryStatus',
        'Accepted': 'successStatus',
        'closed': 'closedStatus',
        'Receive & Paid': 'successStatus',
        'Receive - Not Paid': 'secondaryStatus',
        'Receive - Partially Paid': 'infoStatus',
        'In-Progress': 'infoStatus',
        'Waiting For Approval': 'secondaryStatus',
        'Re-Open': 'secondaryStatus',
        'Offer-Letter Accepted': 'successStatus',
        'Round Cleared': 'successStatus',
        'Waiting for Response': 'infoStatus',
        'Offer-Letter Rejected': 'dangerStatus',
        'Attended': 'closedStatus',
        'Generated': 'successStatus',
        'Empty': 'secondaryStatus',
        'Booked': 'successStatus',
        'Under Maintenance': 'infoStatus',
        'Requested': 'secondaryStatus',
        'Valid': 'infoStatus',
        'Available': 'successStatus',
        'Under development': 'infoStatus',
        'Application ready for review': 'secondaryStatus',
        'Technical review': 'secondaryStatus',
        'Budget Review': 'successStatus',
        'FM review': 'successStatus',
        'ED approval': 'successStatus',
        'Pending submission': 'secondaryStatus',
        'Submitted': 'closedStatus',
    },
    'Alphabetical_color':{
        'A':'aqua',
        'B':'blue',
        'C':'chocolate',
        'D':'darkgreen',
        'E':'darkviolet',
        'F':'lightblue',
        'G':'green',
        'H':'lightgreen',
        'I':'indigo',
        'J':'lightpink',
        'K':'orange',
        'L':'lime',
        'M':'maroon',
        'N':'darkorange',
        'O':'olive',
        'P':'pink',
        'Q':'olive',
        'R':'purple',
        'S':'skyblue',
        'T':'teal',
        'U':'brown',
        'V':'cyan',
        'W':'magenta',
        'X':'red',
        'Y':'aqua',
        'Z':'violet',
    }

};
export default dom_array;