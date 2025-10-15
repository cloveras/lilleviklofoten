add_action('wp_head', function () {
    $locale_full = get_locale();
    // Normalize locale codes for languages with region/script variants
    if (in_array($locale_full, ['zh_TW', 'en_GB', 'pt_BR'])) {
        $locale = str_replace('_', '-', $locale_full);
    } else {
        $locale = substr($locale_full, 0, 2);
    }

    // Multilingual descriptions
    $descriptions = [
        'en' => "Possibly Lofoten's best location — a peaceful beachfront holiday home on Gimsøy with a private beach, stunning views, and total quiet. The perfect base for exploring Lofoten all year round: midnight sun in summer, northern lights in winter. Loved by couples, families, and nature seekers alike.",
        'nb' => "Muligens Lofotens beste beliggenhet — et fredelig strandhus på Gimsøy med privat strand, fantastisk utsikt og total stillhet. Det perfekte utgangspunktet for å utforske Lofoten året rundt: midnattssol om sommeren, nordlys om vinteren. Elsket av par, familier og naturelskere.",
        'de' => "Möglicherweise die beste Lage auf den Lofoten – ein friedliches Ferienhaus direkt am Strand in Gimsøy mit privatem Strand, atemberaubender Aussicht und völliger Ruhe. Der perfekte Ausgangspunkt, um die Lofoten das ganze Jahr über zu erkunden: Mitternachtssonne im Sommer, Nordlichter im Winter. Geliebt von Paaren, Familien und Naturliebhabern.",
        'fr' => "Peut-être le meilleur emplacement des Lofoten — une paisible maison de vacances en bord de mer à Gimsøy, avec plage privée, vue imprenable et calme absolu. Le point de départ parfait pour explorer les Lofoten toute l’année : soleil de minuit en été, aurores boréales en hiver. Apprécié par les couples, les familles et les amoureux de la nature.",
        'es' => "Posiblemente la mejor ubicación de Lofoten: una tranquila casa de vacaciones frente a la playa en Gimsøy, con playa privada, vistas increíbles y total tranquilidad. La base perfecta para explorar Lofoten todo el año: sol de medianoche en verano y auroras boreales en invierno. Amada por parejas, familias y amantes de la naturaleza.",
        'it' => "Forse la posizione migliore delle Lofoten — una tranquilla casa vacanze fronte mare a Gimsøy con spiaggia privata, vista mozzafiato e totale tranquillità. La base perfetta per esplorare le Lofoten tutto l’anno: sole di mezzanotte d’estate e aurore boreali d’inverno. Amata da coppie, famiglie e amanti della natura.",
        'nl' => "Mogelijk de beste locatie op de Lofoten — een rustig vakantiehuis aan het strand in Gimsøy met een privéstrand, prachtig uitzicht en volledige rust. De perfecte uitvalsbasis om de Lofoten het hele jaar door te verkennen: middernachtzon in de zomer, noorderlicht in de winter. Geliefd bij stellen, gezinnen en natuurliefhebbers.",
        'da' => "Måske Lofotens bedste beliggenhed – et fredeligt feriehus ved stranden på Gimsøy med privat strand, fantastisk udsigt og total ro. Det perfekte udgangspunkt for at udforske Lofoten året rundt: midnatssol om sommeren og nordlys om vinteren. Elsket af par, familier og naturelskere.",
        'sv' => "Kanske Lofotens bästa läge — ett lugnt semesterhus vid stranden på Gimsøy med privat strand, fantastisk utsikt och total stillhet. Den perfekta basen för att utforska Lofoten året runt: midnattssol på sommaren och norrsken på vintern. Älskad av par, familjer och naturälskare.",
        'fi' => "Mahdollisesti Lofotenin paras sijainti — rauhallinen rantamökki Gimsøyssa, yksityisellä rannalla, upeilla näkymillä ja täydellisellä rauhalla. Täydellinen tukikohta Lofotenin tutkimiseen ympäri vuoden: keskiyön aurinko kesällä, revontulet talvella. Rakastettu parien, perheiden ja luonnonystäviä keskuudessa.",
        'pl' => "Możliwe, że to najlepsza lokalizacja na Lofotach — spokojny domek wakacyjny przy plaży w Gimsøy z prywatną plażą, wspaniałym widokiem i całkowitą ciszą. Idealna baza wypadowa do zwiedzania Lofot przez cały rok: słońce o północy latem, zorza polarna zimą. Uwielbiany przez pary, rodziny i miłośników przyrody.",
        'pt' => "Possivelmente a melhor localização das Lofoten — uma casa de férias tranquila à beira-mar em Gimsøy, com praia privada, vistas deslumbrantes e total tranquilidade. A base perfeita para explorar as Lofoten durante todo o ano: sol da meia-noite no verão e auroras boreais no inverno. Amada por casais, famílias e amantes da natureza.",
        'pt-BR' => "Possivelmente a melhor localização das Lofoten — uma casa de férias tranquila à beira-mar em Gimsøy, com praia privativa, vistas incríveis e total tranquilidade. A base perfeita para explorar as Lofoten o ano todo: sol da meia-noite no verão e auroras boreais no inverno. Amada por casais, famílias e amantes da natureza.",
        'zh' => "可能是洛弗敦群岛上最好的位置——位于Gimsøy的宁静海滨度假屋，配有私人沙滩、壮丽景色和绝对的宁静。全年探索洛弗敦的完美基地：夏季的午夜太阳，冬季的北极光。深受情侣、家庭和自然爱好者喜爱。",
        'zh-TW' => "可能是羅弗敦群島最棒的位置——位於 Gimsøy 的寧靜海濱度假小屋，擁有私人沙灘、壯麗景觀與絕對的寧靜。全年探索羅弗敦的完美基地：夏季的午夜太陽與冬季的極光。深受情侶、家庭與自然愛好者喜愛。",
        'ja' => "おそらくロフォーテンで最高のロケーション。ギムソイの静かなビーチフロントの貸別荘で、プライベートビーチ、美しい景色、そして静けさを楽しめます。一年を通してロフォーテンを探検するのに最適な拠点です。夏は白夜、冬はオーロラを満喫。カップルや家族、自然好きに人気です。",
        'ko' => "로포텐 최고의 위치일지도 모릅니다. Gimsøy에 있는 조용한 해변가 휴양주택으로, 전용 해변과 멋진 전망, 완벽한 고요함을 갖추고 있습니다. 일년 내내 로포텐을 탐험하기에 완벽한 베이스캠프입니다. 여름엔 백야, 겨울엔 오로라를 즐기세요. 커플, 가족, 자연을 사랑하는 이들에게 사랑받는 장소입니다.",
        'th' => "อาจเป็นทำเลที่ดีที่สุดในโลโฟเทน — บ้านพักตากอากาศริมชายหาดอันเงียบสงบใน Gimsøy พร้อมชายหาดส่วนตัว วิวสวย และความสงบสมบูรณ์แบบ เหมาะสำหรับการท่องเที่ยวโลโฟเทนตลอดปี ทั้งพระอาทิตย์เที่ยงคืนในฤดูร้อนและแสงเหนือในฤดูหนาว เป็นที่รักของคู่รัก ครอบครัว และคนรักธรรมชาติ.",
        'hi' => "संभवतः लोफोटेन में सबसे अच्छी जगह — Gimsøy में शांत समुद्र तट पर एक अवकाश गृह, निजी बीच, शानदार दृश्य और पूर्ण शांति के साथ। पूरे साल लोफोटेन घूमने का आदर्श ठिकाना: गर्मियों में मिडनाइट सन और सर्दियों में नॉर्दर्न लाइट्स। जोड़ों, परिवारों और प्रकृति प्रेमियों द्वारा पसंद किया गया।",
        'ms' => "Mungkin lokasi terbaik di Lofoten — rumah percutian yang tenang di tepi pantai Gimsøy dengan pantai peribadi, pemandangan menakjubkan dan ketenangan mutlak. Pangkalan sempurna untuk meneroka Lofoten sepanjang tahun: matahari tengah malam pada musim panas, cahaya utara pada musim sejuk. Diminati oleh pasangan, keluarga dan pencinta alam.",
        'id' => "Mungkin lokasi terbaik di Lofoten — rumah liburan tenang di tepi pantai Gimsøy dengan pantai pribadi, pemandangan menakjubkan, dan ketenangan total. Tempat ideal untuk menjelajahi Lofoten sepanjang tahun: matahari tengah malam di musim panas, cahaya utara di musim dingin. Disukai oleh pasangan, keluarga, dan pecinta alam.",
        'en-GB' => "Possibly the best spot in Lofoten — a peaceful beachfront holiday home on Gimsøy with a private beach, stunning views, and complete calm. The perfect base for exploring Lofoten all year round: midnight sun in summer, northern lights in winter. Loved by couples, families, and nature lovers alike.",
    ];


    // Multilingual amenities - re-sorted by importance and fully translated
    $amenities = [
        'en' => ["Free WiFi", "Free private parking", "Fully equipped kitchen", "Beachfront", "Private beach area", "Sea view", "Mountain view", "Northern lights", "Midnight sun", "Fireplace", "Heating", "Self check-in/check-out", "Instant bookable", "Electric vehicle charging", "Washing machine", "Dryer", "Oven/stove", "Microwave", "Ironing board", "Balcony", "Terrace", "Patio", "Barbecue", "Outdoor dining area", "Outdoor furniture", "Hammocks in garden", "Private entrance", "Sun deck", "Quiet", "Calm"],
        'nb' => ["Gratis WiFi", "Gratis privat parkering", "Fullt utstyrt kjøkken", "Strandtomt", "Privat strandområde", "Havutsikt", "Fjellutsikt", "Nordlys", "Midnattssol", "Peis", "Oppvarming", "Selvinnsjekking/-utsjekking", "Kan bookes umiddelbart", "Lading av elbil", "Vaskemaskin", "Tørketrommel", "Stekeovn/komfyr", "Mikrobølgeovn", "Strykebrett", "Balkong", "Terrasse", "Uteplass", "Grill", "Spiseområde ute", "Utemøbler", "Hengekøyer i hagen", "Privat inngang", "Soldekk", "Rolig", "Stillhet"],
        'de' => ["Kostenloses WLAN", "Kostenlose Privatparkplätze", "Voll ausgestattete Küche", "Strandlage", "Privater Strandbereich", "Meerblick", "Bergblick", "Nordlichter", "Mitternachtssonne", "Kamin", "Heizung", "Selbstständiger Check-in/Check-out", "Sofort buchbar", "Elektroauto-Ladestation", "Waschmaschine", "Trockner", "Backofen/Herd", "Mikrowelle", "Bügelbrett", "Balkon", "Terrasse", "Patio", "Grill", "Essbereich im Freien", "Gartenmöbel", "Hängematten im Garten", "Privater Eingang", "Sonnendeck", "Ruhig", "Friedlich"],
        'fr' => ["WiFi gratuit", "Parking privé gratuit", "Cuisine entièrement équipée", "Bord de mer", "Plage privée", "Vue sur la mer", "Vue sur la montagne", "Aurores boréales", "Soleil de minuit", "Cheminée", "Chauffage", "Arrivée/départ autonome", "Réservation instantanée", "Borne de recharge pour véhicules électriques", "Lave-linge", "Sèche-linge", "Four/cuisinière", "Micro-ondes", "Planche à repasser", "Balcon", "Terrasse", "Patio", "Barbecue", "Coin repas extérieur", "Mobilier d'extérieur", "Hamacs dans le jardin", "Entrée privée", "Solarium", "Calme", "Tranquille"],
        'es' => ["WiFi gratis", "Aparcamiento privado gratuito", "Cocina totalmente equipada", "Frente a la playa", "Zona de playa privada", "Vista al mar", "Vista a la montaña", "Auroras boreales", "Sol de medianoche", "Chimenea", "Calefacción", "Check-in/check-out propio", "Reserva inmediata", "Carga de vehículos eléctricos", "Lavadora", "Secadora", "Horno/estufa", "Microondas", "Tabla de planchar", "Balcón", "Terraza", "Patio", "Barbacoa", "Zona de comedor exterior", "Mobiliario exterior", "Hamacas en el jardín", "Entrada privada", "Solárium", "Tranquilo", "Calma"],
        'it' => ["WiFi gratuito", "Parcheggio privato gratuito", "Cucina completamente attrezzata", "Fronte spiaggia", "Spiaggia privata", "Vista mare", "Vista montagna", "Aurora boreale", "Sole di mezzanotte", "Camino", "Riscaldamento", "Check-in/check-out autonomo", "Prenotazione immediata", "Ricarica veicoli elettrici", "Lavatrice", "Asciugatrice", "Forno/fornelli", "Microonde", "Asse da stiro", "Balcone", "Terrazza", "Patio", "Barbecue", "Zona pranzo all'aperto", "Mobili da esterno", "Amache in giardino", "Ingresso privato", "Solarium", "Silenzioso", "Tranquillo"],
        'pt' => ["WiFi gratuito", "Estacionamento privado gratuito", "Cozinha totalmente equipada", "Frente à praia", "Área de praia privada", "Vista para o mar", "Vista para a montanha", "Auroras boreais", "Sol da meia-noite", "Lareira", "Aquecimento", "Check-in/check-out automático", "Reserva instantânea", "Carregamento de veículos elétricos", "Máquina de lavar", "Secadora", "Forno/fogão", "Micro-ondas", "Tábua de engomar", "Varanda", "Terraço", "Pátio", "Churrasqueira", "Área de refeições ao ar livre", "Mobiliário de exterior", "Redes de dormir no jardim", "Entrada privada", "Deck para sol", "Silencioso", "Calmo"],
        'nl' => ["Gratis wifi", "Gratis privéparkeergelegenheid", "Volledig uitgeruste keuken", "Aan het strand", "Privéstrand", "Uitzicht op zee", "Uitzicht op de bergen", "Noorderlicht", "Middernachtzon", "Open haard", "Verwarming", "Zelf in- en uitchecken", "Direct boekbaar", "Oplaadpunt voor elektrische auto's", "Wasmachine", "Droger", "Oven/fornuis", "Magnetron", "Strijkplank", "Balkon", "Terras", "Patio", "Barbecue", "Eethoek buiten", "Buitenmeubilair", "Hangmatten in de tuin", "Eigen ingang", "Zonneterras", "Rustig", "Kalm"],
        'ja' => ["無料WiFi", "無料専用駐車場", "設備の整ったキッチン", "ビーチフロント", "プライベートビーチエリア", "海の景色", "山の景色", "オーロラ", "白夜", "暖炉", "暖房", "セルフチェックイン/チェックアウト", "即時予約可能", "電気自動車充電", "洗濯機", "乾燥機", "オーブン/コンロ", "電子レンジ", "アイロン台", "バルコニー", "テラス", "パティオ", "バーベキュー", "屋外ダイニングエリア", "屋外用家具", "庭のハンモック", "専用エントランス", "サンデッキ", "静か", "穏やか"],
        'th' => ["ฟรี WiFi", "ที่จอดรถส่วนตัวฟรี", "ห้องครัวพร้อมอุปกรณ์ครบครัน", "ติดชายหาด", "พื้นที่ชายหาดส่วนตัว", "วิวทะเล", "วิวภูเขา", "แสงเหนือ", "พระอาทิตย์เที่ยงคืน", "เตาผิง", "เครื่องทำความร้อน", "เช็คอิน/เช็คเอาท์ด้วยตนเอง", "จองได้ทันที", "ที่ชาร์จรถยนต์ไฟฟ้า", "เครื่องซักผ้า", "เครื่องอบผ้า", "เตาอบ/เตาแก๊ส", "ไมโครเวฟ", "เตารีด", "ระเบียง", "เทอร์เรซ", "ลานเฉลียง", "บาร์บีคิว", "พื้นที่รับประทานอาหารกลางแจ้ง", "เฟอร์นิเจอร์กลางแจ้ง", "เปลญวนในสวน", "ทางเข้าส่วนตัว", "ดาดฟ้าอาบแดด", "เงียบสงบ", "สงบ"],
        'ko' => ["무료 WiFi", "무료 전용 주차장", "완비된 주방", "해변가", "전용 해변 공간", "바다 전망", "산 전망", "오로라", "백야", "벽난로", "난방", "셀프 체크인/체크아웃", "즉시 예약 가능", "전기차 충전", "세탁기", "건조기", "오븐/스토브", "전자레인지", "다리미판", "발코니", "테라스", "파티오", "바비큐", "야외 식사 공간", "야외 가구", "정원의 해먹", "전용 출입구", "일광욕 테라스", "조용한", "고요한"],
        'pl' => ["Darmowe Wi-Fi", "Bezpłatny prywatny parking", "W pełni wyposażona kuchnia", "Przy plaży", "Prywatna plaża", "Widok na morze", "Widok na góry", "Zorza polarna", "Białe noce", "Kominek", "Ogrzewanie", "Samodzielne zameldowanie/wymeldowanie", "Natychmiastowa rezerwacja", "Ładowanie pojazdów elektrycznych", "Pralka", "Suszarka", "Piekarnik/kuchenka", "Kuchenka mikrofalowa", "Deska do prasowania", "Balkon", "Taras", "Patio", "Grill", "Jadalnia na świeżym powietrzu", "Meble ogrodowe", "Hamaki w ogrodzie", "Prywatne wejście", "Taras słoneczny", "Cisza", "Spokój"],
        'zh' => ["免费WiFi", "免费私人停车场", "设备齐全的厨房", "海滨", "私人海滩区", "海景", "山景", "北极光", "午夜太阳", "壁炉", "暖气", "自助入住/退房", "即时预订", "电动汽车充电", "洗衣机", "烘干机", "烤箱/炉灶", "微波炉", "熨衣板", "阳台", "露台", "庭院", "烧烤", "户外用餐区", "户外家具", "花园吊床", "独立入口", "阳光甲板", "安静", "平静"],
        'fi' => ["Ilmainen WiFi", "Ilmainen yksityinen pysäköinti", "Täysin varustettu keittiö", "Rannalla", "Yksityinen ranta-alue", "Merinäköala", "Vuoristonäköala", "Revontulet", "Keskiyön aurinko", "Takka", "Lämmitys", "Itsepalvelusisään-/-uloskirjautuminen", "Välittömästi varattavissa", "Sähköauton lataus", "Pesukone", "Kuivausrumpu", "Uuni/liesi", "Mikroaaltouuni", "Silityslauta", "Parveke", "Terassi", "Patio", "Grilli", "Ruokailutila ulkona", "Ulkokalusteet", "Riippumatot puutarhassa", "Oma sisäänkäynti", "Aurinkokansi", "Hiljainen", "Rauhallinen"],
        'sv' => ["Gratis WiFi", "Gratis privat parkering", "Fullt utrustat kök", "Vid stranden", "Privat strandområde", "Havsutsikt", "Bergsutsikt", "Norrsken", "Midnattssol", "Öppen spis", "Värme", "Självincheckning/utcheckning", "Omedelbar bokning", "Laddning för elbil", "Tvättmaskin", "Torktumlare", "Ugn/spis", "Mikrovågsugn", "Strykbräda", "Balkong", "Terrass", "Uteplats", "Grill", "Matplats utomhus", "Utemöbler", "Hängmattor i trädgården", "Egen ingång", "Soldäck", "Tyst", "Lugnt"],
        'da' => ["Gratis WiFi", "Gratis privat parkering", "Fuldt udstyret køkken", "Lige ved stranden", "Privat strandområde", "Havudsigt", "Bjergudsigt", "Nordlys", "Midnatssol", "Pejs", "Varme", "Selv-check-in/check-ud", "Øjeblikkelig booking", "Opladning af elbil", "Vaskemaskine", "Tørretumbler", "Ovn/komfur", "Mikrobølgeovn", "Strygebræt", "Balkon", "Terrasse", "Gårdhave", "Grill", "Udendørs spiseplads", "Udendørsmøbler", "Hængekøjer i haven", "Egen indgang", "Solterrasse", "Stille", "Roligt"],
        'hi' => ["मुफ्त वाई-फाई", "मुफ्त निजी पार्किंग", "पूरी तरह से सुसज्जित रसोई", "समुद्र तट के सामने", "निजी समुद्र तट क्षेत्र", "समुद्र का दृश्य", "पहाड़ का दृश्य", "उत्तरी लाइट्स", "आधी रात का सूरज", "फायरप्लेस", "हीटिंग", "स्वयं चेक-इन/चेक-आउट", "तुरंत बुक करने योग्य", "इलेक्ट्रिक वाहन चार्जिंग", "वॉशिंग मशीन", "ड्रायर", "ओवन/स्टोव", "माइक्रोवेव", "इस्त्री बोर्ड", "बालकनी", "छत", "आंगन", "बारबेक्यू", "आउटडोर डाइनिंग क्षेत्र", "आउटडोर फर्नीचर", "बगीचे में झूला", "निजी प्रवेश द्वार", "सन डेक", "शांत", "शांत"],
        'ms' => ["WiFi percuma", "Tempat letak kenderaan persendirian percuma", "Dapur yang lengkap", "Depan pantai", "Kawasan pantai persendirian", "Pemandangan laut", "Pemandangan gunung", "Cahaya utara", "Matahari tengah malam", "Pendiang api", "Pemanasan", "Daftar masuk/daftar keluar sendiri", "Boleh ditempah serta-merta", "Pengecasan kenderaan elektrik", "Mesin basuh", "Pengering", "Ketuhar/dapur", "Ketuhar gelombang mikro", "Papan seterika", "Balkoni", "Teres", "Patio", "Barbeku", "Ruang makan di luar", "Perabot luaran", "Buaian di taman", "Pintu masuk persendirian", "Dek matahari", "Tenang", "Sunyi"],
        'id' => ["WiFi gratis", "Parkir pribadi gratis", "Dapur lengkap", "Tepi pantai", "Area pantai pribadi", "Pemandangan laut", "Pemandangan gunung", "Cahaya utara", "Matahari tengah malam", "Perapian", "Pemanas", "Check-in/check-out mandiri", "Dapat dipesan instan", "Pengisian kendaraan listrik", "Mesin cuci", "Pengering", "Oven/kompor", "Microwave", "Papan setrika", "Balkon", "Teras", "Teras", "Barbekyu", "Area makan di luar", "Perabotan luar ruangan", "Tempat tidur gantung di taman", "Pintu masuk pribadi", "Dek berjemur", "Tenang", "Sunyi"],
        'zh-TW' => ["免費WiFi", "免費私人停車場", "設備齊全的廚房", "海濱", "私人海灘區", "海景", "山景", "北極光", "午夜太陽", "壁爐", "暖氣", "自助入住/退房", "即時預訂", "電動車充電", "洗衣機", "烘乾機", "烤箱/爐灶", "微波爐", "熨衣板", "陽台", "露台", "庭院", "燒烤", "戶外用餐區", "戶外家具", "花園吊床", "獨立入口", "陽光甲板", "安靜", "平靜"],
        'en-GB' => ["Free WiFi", "Free private parking", "Fully equipped kitchen", "Beachfront", "Private beach area", "Sea view", "Mountain view", "Northern lights", "Midnight sun", "Fireplace", "Heating", "Self check-in/check-out", "Instant bookable", "Electric vehicle charging", "Washing machine", "Dryer", "Oven/stove", "Microwave", "Ironing board", "Balcony", "Terrace", "Patio", "Barbecue", "Outdoor dining area", "Outdoor furniture", "Hammocks in garden", "Private entrance", "Sun deck", "Quiet", "Calm"],
        'pt-BR' => ["WiFi gratuito", "Estacionamento privativo gratuito", "Cozinha totalmente equipada", "Beira-mar", "Área de praia privativa", "Vista para o mar", "Vista para a montanha", "Aurora boreal", "Sol da meia-noite", "Lareira", "Aquecimento", "Check-in/check-out automático", "Reserva instantânea", "Carregamento de veículos elétricos", "Máquina de lavar", "Secadora", "Forno/fogão", "Micro-ondas", "Tábua de passar", "Varanda", "Terraço", "Pátio", "Churrasqueira", "Área para refeições ao ar livre", "Móveis de exterior", "Redes no jardim", "Entrada privativa", "Deck", "Silencioso", "Calmo"],
    ];

    $description = $descriptions[$locale] ?? $descriptions['en'];
    $localizedAmenities = $amenities[$locale] ?? $amenities['en'];

    $address = [
        "@type" => "PostalAddress",
        "streetAddress" => "Årstrandveien 663",
        "postalCode" => "8314",
        "addressLocality" => "Gimsøy",
        "addressRegion" => "Nordland",
        "addressCountry" => "NO"
    ];

    $social = [
        "https://facebook.com/lilleviklofoten",
        "https://instagram.com/lilleviklofoten",
        "https://www.tiktok.com/@lilleviklofoten",
        "https://www.reddit.com/user/Lillevik_Lofoten/",
        "https://bsky.app/profile/lilleviklofoten.bsky.social",
        "https://www.booking.com/hotel/no/lillevik-lofoten.html",
        "https://www.airbnb.com/rooms/44385543",
        "https://lofotenvacation.com/en/lillevik-lofoten",
        "https://maps.app.goo.gl/nKPJn2wFm5uWBZTg7",
        "https://maps.apple.com/?ll=68.330081,14.091728&q=Lillevik%20Lofoten"
    ];

    // Optional, but recommended: separate sameAs for the business node
    $businessSameAs = [
        "https://www.booking.com/hotel/no/lillevik-lofoten.html",
        "https://www.airbnb.com/rooms/44385543",
        "https://lofotenvacation.com/en/lillevik-lofoten",
        "https://maps.app.goo.gl/nKPJn2wFm5uWBZTg7"
    ];

    // Map amenity display name -> stable propertyID key (kept from your version)
    $amenity_mapping = [
        // WiFi
        "Free WiFi" => "Wifi", "Gratis WiFi" => "Wifi", "Kostenloses WLAN" => "Wifi", "WiFi gratuit" => "Wifi", "WiFi gratis" => "Wifi", "WiFi gratuito" => "Wifi", "Gratis wifi" => "Wifi", "無料WiFi" => "Wifi", "ฟรี WiFi" => "Wifi", "무료 WiFi" => "Wifi", "Darmowe Wi-Fi" => "Wifi", "免费WiFi" => "Wifi", "Ilmainen WiFi" => "Wifi", "मुफ्त वाई-फाई" => "Wifi", "WiFi percuma" => "Wifi", "免費WiFi" => "Wifi",
        // Parking
        "Free private parking" => "Parking", "Gratis privat parkering" => "Parking", "Kostenlose Privatparkplätze" => "Parking", "Parking privé gratuit" => "Parking", "Aparcamiento privado gratuito" => "Parking", "Parcheggio privato gratuito" => "Parking", "Estacionamento privado gratuito" => "Parking", "Gratis privéparkeergelegenheid" => "Parking", "無料専用駐車場" => "Parking", "ที่จอดรถส่วนตัวฟรี" => "Parking", "무료 전용 주차장" => "Parking", "Bezpłatny prywatny parking" => "Parking", "免费私人停车场" => "Parking", "Ilmainen yksityinen pysäköinti" => "Parking", "मुफ्त निजी पार्किंग" => "Parking", "Tempat letak kenderaan persendirian percuma" => "Parking", "Parkir pribadi gratis" => "Parking", "免費私人停車場" => "Parking", "Estacionamento privativo gratuito" => "Parking",
        // Kitchen
        "Fully equipped kitchen" => "Kitchen", "Fullt utstyrt kjøkken" => "Kitchen", "Voll ausgestattete Küche" => "Kitchen", "Cuisine entièrement équipée" => "Kitchen", "Cocina totalmente equipada" => "Kitchen", "Cucina completamente attrezzata" => "Kitchen", "Cozinha totalmente equipada" => "Kitchen", "Volledig uitgeruste keuken" => "Kitchen", "設備の整ったキッチン" => "Kitchen", "ห้องครัวพร้อมอุปกรณ์ครบครัน" => "Kitchen", "완비된 주방" => "Kitchen", "W pełni wyposażona kuchnia" => "Kitchen", "设备齐全的厨房" => "Kitchen", "Täysin varustettu keittiö" => "Kitchen", "पूरी तरह से सुसज्जित रसोई" => "Kitchen", "Dapur yang lengkap" => "Kitchen", "Dapur lengkap" => "Kitchen",
        // BeachAccess
        "Beachfront" => "BeachAccess", "Strandtomt" => "BeachAccess", "Strandlage" => "BeachAccess", "Bord de mer" => "BeachAccess", "Frente a la playa" => "BeachAccess", "Fronte spiaggia" => "BeachAccess", "Frente à praia" => "BeachAccess", "Aan het strand" => "BeachAccess", "ビーチフロント" => "BeachAccess", "ติดชายหาด" => "BeachAccess", "해변가" => "BeachAccess", "Przy plaży" => "BeachAccess", "海滨" => "BeachAccess", "Rannalla" => "BeachAccess", "Vid stranden" => "BeachAccess", "Lige ved stranden" => "BeachAccess", "समुद्र तट के सामने" => "BeachAccess", "Depan pantai" => "BeachAccess", "Tepi pantai" => "BeachAccess", "Beira-mar" => "BeachAccess",
        // PrivateBeachAccess
        "Private beach area" => "PrivateBeachAccess", "Privat strandområde" => "PrivateBeachAccess", "Privater Strandbereich" => "PrivateBeachAccess", "Plage privée" => "PrivateBeachAccess", "Zona de playa privada" => "PrivateBeachAccess", "Spiaggia privata" => "PrivateBeachAccess", "Área de praia privada" => "PrivateBeachAccess", "Privéstrand" => "PrivateBeachAccess", "プライベートビーチエリア" => "PrivateBeachAccess", "พื้นที่ชายหาดส่วนตัว" => "PrivateBeachAccess", "전용 해변 공간" => "PrivateBeachAccess", "Prywatna plaża" => "PrivateBeachAccess", "私人海滩区" => "PrivateBeachAccess", "Yksityinen ranta-alue" => "PrivateBeachAccess", "Privat strandområde" => "PrivateBeachAccess", "निजी समुद्र तट क्षेत्र" => "PrivateBeachAccess", "Kawasan pantai persendirian" => "PrivateBeachAccess", "Area pantai pribadi" => "PrivateBeachAccess", "私人海灘區" => "PrivateBeachAccess", "Área de praia privativa" => "PrivateBeachAccess",
        // SeaView
        "Sea view" => "SeaView", "Havutsikt" => "SeaView", "Meerblick" => "SeaView", "Vue sur la mer" => "SeaView", "Vista al mar" => "SeaView", "Vista mare" => "SeaView", "Vista para o mar" => "SeaView", "Uitzicht op zee" => "SeaView", "海の景色" => "SeaView", "วิวทะเล" => "SeaView", "바다 전망" => "SeaView", "Widok na morze" => "SeaView", "海景" => "SeaView", "Merinäköala" => "SeaView", "Havsutsikt" => "SeaView", "Havudsigt" => "SeaView", "समुद्र का दृश्य" => "SeaView", "Pemandangan laut" => "SeaView",
        // MountainView
        "Mountain view" => "MountainView", "Fjellutsikt" => "MountainView", "Bergblick" => "MountainView", "Vue sur la montagne" => "MountainView", "Vista a la montaña" => "MountainView", "Vista montagna" => "MountainView", "Vista para a montanha" => "MountainView", "Uitzicht op de bergen" => "MountainView", "山の景色" => "MountainView", "วิวภูเขา" => "MountainView", "산 전망" => "MountainView", "Widok na góry" => "MountainView", "山景" => "MountainView", "Vuoristonäköala" => "MountainView", "Bergsutsikt" => "MountainView", "Bjergudsigt" => "MountainView", "पहाड़ का दृश्य" => "MountainView", "Pemandangan gunung" => "MountainView",
        // NorthernLights
        "Northern lights" => "NorthernLights", "Nordlys" => "NorthernLights", "Nordlichter" => "NorthernLights", "Aurores boréales" => "NorthernLights", "Auroras boreales" => "NorthernLights", "Aurora boreale" => "NorthernLights", "Auroras boreais" => "NorthernLights", "Noorderlicht" => "NorthernLights", "オーロラ" => "NorthernLights", "แสงเหนือ" => "NorthernLights", "오로라" => "NorthernLights", "Zorza polarna" => "NorthernLights", "北极光" => "NorthernLights", "Revontulet" => "NorthernLights", "Norrsken" => "NorthernLights", "उत्तरी लाइट्स" => "NorthernLights", "Cahaya utara" => "NorthernLights", "Cahaya utara" => "NorthernLights", "Aurora boreal" => "NorthernLights",
        // MidnightSun
        "Midnight sun" => "MidnightSun", "Midnattssol" => "MidnightSun", "Mitternachtssonne" => "MidnightSun", "Soleil de minuit" => "MidnightSun", "Sol de medianoche" => "MidnightSun", "Sole di mezzanotte" => "MidnightSun", "Sol da meia-noite" => "MidnightSun", "Middernachtzon" => "MidnightSun", "白夜" => "MidnightSun", "พระอาทิตย์เที่ยงคืน" => "MidnightSun", "백야" => "MidnightSun", "Białe noce" => "MidnightSun", "午夜太阳" => "MidnightSun", "Keskiyön aurinko" => "MidnightSun", "आधी रात का सूरज" => "MidnightSun", "Matahari tengah malam" => "MidnightSun",
        // FirePlace
        "Fireplace" => "FirePlace", "Peis" => "FirePlace", "Kamin" => "FirePlace", "Cheminée" => "FirePlace", "Chimenea" => "FirePlace", "Camino" => "FirePlace", "Lareira" => "FirePlace", "Open haard" => "FirePlace", "暖炉" => "FirePlace", "เตาผิง" => "FirePlace", "벽난로" => "FirePlace", "Kominek" => "FirePlace", "壁炉" => "FirePlace", "Takka" => "FirePlace", "Öppen spis" => "FirePlace", "Pejs" => "FirePlace", "फायरप्लेस" => "FirePlace", "Pendiang api" => "FirePlace", "Perapian" => "FirePlace",
        // Heating
        "Heating" => "Heating", "Oppvarming" => "Heating", "Heizung" => "Heating", "Chauffage" => "Heating", "Calefacción" => "Heating", "Riscaldamento" => "Heating", "Aquecimento" => "Heating", "Verwarming" => "Heating", "暖房" => "Heating", "เครื่องทำความร้อน" => "Heating", "난방" => "Heating", "Ogrzewanie" => "Heating", "暖气" => "Heating", "Lämmitys" => "Heating", "Värme" => "Heating", "Varme" => "Heating", "हीटिंग" => "Heating", "Pemanasan" => "Heating", "Pemanas" => "Heating",
        // SelfCheckinCheckout
        "Self check-in/check-out" => "SelfCheckinCheckout", "Selvinnsjekking/-utsjekking" => "SelfCheckinCheckout", "Selbstständiger Check-in/Check-out" => "SelfCheckinCheckout", "Arrivée/départ autonome" => "SelfCheckinCheckout", "Check-in/check-out propio" => "SelfCheckinCheckout", "Check-in/check-out autonomo" => "SelfCheckinCheckout", "Check-in/check-out automático" => "SelfCheckinCheckout", "Zelf in- en uitchecken" => "SelfCheckinCheckout", "セルフチェックイン/チェックアウト" => "SelfCheckinCheckout", "เช็คอิน/เช็คเอาท์ด้วยตนเอง" => "SelfCheckinCheckout", "셀프 체크인/체크아웃" => "SelfCheckinCheckout", "Samodzielne zameldowanie/wymeldowanie" => "SelfCheckinCheckout", "自助入住/退房" => "SelfCheckinCheckout", "Itsepalvelusisään-/-uloskirjautuminen" => "SelfCheckinCheckout", "Självincheckning/utcheckning" => "SelfCheckinCheckout", "Selv-check-in/check-ud" => "SelfCheckinCheckout", "स्वयं चेक-इन/चेक-आउट" => "SelfCheckinCheckout", "Daftar masuk/daftar keluar sendiri" => "SelfCheckinCheckout", "Check-in/check-out mandiri" => "SelfCheckinCheckout",
        // InstantBookable
        "Instant bookable" => "InstantBookable", "Kan bookes umiddelbart" => "InstantBookable", "Sofort buchbar" => "InstantBookable", "Réservation instantanée" => "InstantBookable", "Reserva inmediata" => "InstantBookable", "Prenotazione immediata" => "InstantBookable", "Reserva instantânea" => "InstantBookable", "Direct boekbaar" => "InstantBookable", "即時予約可能" => "InstantBookable", "จองได้ทันที" => "InstantBookable", "즉시 예약 가능" => "InstantBookable", "Natychmiastowa rezerwacja" => "InstantBookable", "即时预订" => "InstantBookable", "Välittömästi varattavissa" => "InstantBookable", "Omedelbar bokning" => "InstantBookable", "Øjeblikkelig booking" => "InstantBookable", "तुरंत बुक करने योग्य" => "InstantBookable", "Boleh ditempah serta-merta" => "InstantBookable", "Dapat dipesan instan" => "InstantBookable", "即時預訂" => "InstantBookable",
        // ElectricCarCharging
        "Electric vehicle charging" => "ElectricCarCharging", "Lading av elbil" => "ElectricCarCharging", "Elektroauto-Ladestation" => "ElectricCarCharging", "Borne de recharge pour véhicules électriques" => "ElectricCarCharging", "Carga de vehículos eléctricos" => "ElectricCarCharging", "Ricarica veicoli elettrici" => "ElectricCarCharging", "Carregamento de veículos elétricos" => "ElectricCarCharging", "Oplaadpunt voor elektrische auto's" => "ElectricCarCharging", "電気自動車充電" => "ElectricCarCharging", "ที่ชาร์จรถยนต์ไฟฟ้า" => "ElectricCarCharging", "전기차 충전" => "ElectricCarCharging", "Ładowanie pojazdów elektrycznych" => "ElectricCarCharging", "电动汽车充电" => "ElectricCarCharging", "Sähköauton lataus" => "ElectricCarCharging", "Laddning för elbil" => "ElectricCarCharging", "Opladning af elbil" => "ElectricCarCharging", "इलेक्ट्रिक वाहन चार्जिंग" => "ElectricCarCharging", "Pengecasan kenderaan elektrik" => "ElectricCarCharging", "Pengisian kendaraan listrik" => "ElectricCarCharging", "電動車充電" => "ElectricCarCharging",
        // Washer
        "Washing machine" => "Washer", "Vaskemaskin" => "Washer", "Waschmaschine" => "Washer", "Lave-linge" => "Washer", "Lavadora" => "Washer", "Lavatrice" => "Washer", "Máquina de lavar" => "Washer", "Wasmachine" => "Washer", "洗濯機" => "Washer", "เครื่องซักผ้า" => "Washer", "세탁기" => "Washer", "Pralka" => "Washer", "洗衣机" => "Washer", "Pesukone" => "Washer", "Tvättmaskin" => "Washer", "Vaskemaskine" => "Washer", "वॉशिंग मशीन" => "Washer", "Mesin basuh" => "Washer", "Mesin cuci" => "Washer",
        // Dryer
        "Dryer" => "Dryer", "Tørketrommel" => "Dryer", "Trockner" => "Dryer", "Sèche-linge" => "Dryer", "Secadora" => "Dryer", "Asciugatrice" => "Dryer", "Droger" => "Dryer", "乾燥機" => "Dryer", "เครื่องอบผ้า" => "Dryer", "건조기" => "Dryer", "Suszarka" => "Dryer", "烘干机" => "Dryer", "Kuivausrumpu" => "Dryer", "Torktumlare" => "Dryer", "Tørretumbler" => "Dryer", "ड्रायर" => "Dryer", "Pengering" => "Dryer",
        // OvenStove
        "Oven/stove" => "OvenStove", "Stekeovn/komfyr" => "OvenStove", "Backofen/Herd" => "OvenStove", "Four/cuisinière" => "OvenStove", "Horno/estufa" => "OvenStove", "Forno/fornelli" => "OvenStove", "Forno/fogão" => "OvenStove", "Oven/fornuis" => "OvenStove", "オーブン/コンロ" => "OvenStove", "เตาอบ/เตาแก๊ส" => "OvenStove", "오븐/스토브" => "OvenStove", "Piekarnik/kuchenka" => "OvenStove", "烤箱/炉灶" => "OvenStove", "Uuni/liesi" => "OvenStove", "Ugn/spis" => "OvenStove", "Ovn/komfur" => "OvenStove", "ओवन/स्टोव" => "OvenStove", "Ketuhar/dapur" => "OvenStove", "Oven/kompor" => "OvenStove",
        // Microwave
        "Microwave" => "Microwave", "Mikrobølgeovn" => "Microwave", "Mikrowelle" => "Microwave", "Micro-ondes" => "Microwave", "Microondas" => "Microwave", "電子レンジ" => "Microwave", "ไมโครเวฟ" => "Microwave", "전자레인지" => "Microwave", "Kuchenka mikrofalowa" => "Microwave", "微波炉" => "Microwave", "Mikroaaltouuni" => "Microwave", "Mikrovågsugn" => "Microwave", "माइक्रोवेव" => "Microwave", "Ketuhar gelombang mikro" => "Microwave",
        // IroningBoard
        "Ironing board" => "IroningBoard", "Strykebrett" => "IroningBoard", "Bügelbrett" => "IroningBoard", "Planche à repasser" => "IroningBoard", "Tabla de planchar" => "IroningBoard", "Asse da stiro" => "IroningBoard", "Tábua de engomar" => "IroningBoard", "Strijkplank" => "IroningBoard", "アイロン台" => "IroningBoard", "เตารีด" => "IroningBoard", "다리미판" => "IroningBoard", "Deska do prasowania" => "IroningBoard", "熨衣板" => "IroningBoard", "Silityslauta" => "IroningBoard", "Strykbräda" => "IroningBoard", "Strygebræt" => "IroningBoard", "इस्त्री बोर्ड" => "IroningBoard", "Papan seterika" => "IroningBoard", "Papan setrika" => "IroningBoard", "Tábua de passar" => "IroningBoard",
        // Balcony
        "Balcony" => "Balcony", "Balkong" => "Balcony", "Balcon" => "Balcony", "Varanda" => "Balcony", "バルコニー" => "Balcony", "ระเบียง" => "Balcony", "발코니" => "Balcony", "阳台" => "Balcony", "Parveke" => "Balcony", "बालकनी" => "Balcony", "Balkoni" => "Balcony",
        // Terrace
        "Terrace" => "Terrace", "Terrasse" => "Terrace", "Terrazza" => "Terrace", "Terraço" => "Terrace", "テラス" => "Terrace", "เทอร์เรซ" => "Terrace", "테라스" => "Terrace", "Taras" => "Terrace", "露台" => "Terrace", "Terassi" => "Terrace", "छत" => "Terrace", "Teres" => "Terrace",
        // Patio
        "Patio" => "Patio", "Uteplass" => "Patio", "Pátio" => "Patio", "パティオ" => "Patio", "ลานเฉลียง" => "Patio", "파티오" => "Patio", "庭院" => "Patio", "Gårdhave" => "Patio", "आंगन" => "Patio",
        // OutdoorGrill
        "Barbecue" => "OutdoorGrill", "Grill" => "OutdoorGrill", "Barbacoa" => "OutdoorGrill", "Churrasqueira" => "OutdoorGrill", "バーベキュー" => "OutdoorGrill", "บาร์บีคิว" => "OutdoorGrill", "바비큐" => "OutdoorGrill", "烧烤" => "OutdoorGrill", "Grilli" => "OutdoorGrill", "बारबेक्यू" => "OutdoorGrill", "Barbeku" => "OutdoorGrill", "Barbekyu" => "OutdoorGrill",
        // OutdoorDiningArea
        "Outdoor dining area" => "OutdoorDiningArea", "Spiseområde ute" => "OutdoorDiningArea", "Essbereich im Freien" => "OutdoorDiningArea", "Coin repas extérieur" => "OutdoorDiningArea", "Zona de comedor exterior" => "OutdoorDiningArea", "Zona pranzo all'aperto" => "OutdoorDiningArea", "Área de refeições ao ar livre" => "OutdoorDiningArea", "Eethoek buiten" => "OutdoorDiningArea", "屋外ダイニングエリア" => "OutdoorDiningArea", "พื้นที่รับประทานอาหารกลางแจ้ง" => "OutdoorDiningArea", "야외 식사 공간" => "OutdoorDiningArea", "Jadalnia na świeżym powietrzu" => "OutdoorDiningArea", "户外用餐区" => "OutdoorDiningArea", "Ruokailutila ulkona" => "OutdoorDiningArea", "Matplats utomhus" => "OutdoorDiningArea", "Udendørs spiseplads" => "OutdoorDiningArea", "आउटडोर डाइनिंग क्षेत्र" => "OutdoorDiningArea", "Ruang makan di luar" => "OutdoorDiningArea", "Area makan di luar" => "OutdoorDiningArea", "Área para refeições ao ar livre" => "OutdoorDiningArea",
        // OutdoorFurniture
        "Outdoor furniture" => "OutdoorFurniture", "Utemøbler" => "OutdoorFurniture", "Gartenmöbel" => "OutdoorFurniture", "Mobilier d'extérieur" => "OutdoorFurniture", "Mobiliario exterior" => "OutdoorFurniture", "Mobili da esterno" => "OutdoorFurniture", "Mobiliário de exterior" => "OutdoorFurniture", "Buitenmeubilair" => "OutdoorFurniture", "屋外用家具" => "OutdoorFurniture", "เฟอร์นิเจอร์กลางแจ้ง" => "OutdoorFurniture", "야외 가구" => "OutdoorFurniture", "Meble ogrodowe" => "OutdoorFurniture", "户外家具" => "OutdoorFurniture", "Ulkokalusteet" => "OutdoorFurniture", "Udendørsmøbler" => "OutdoorFurniture", "आउटडोर फर्नीचर" => "OutdoorFurniture", "Perabot luaran" => "OutdoorFurniture", "Perabotan luar ruangan" => "OutdoorFurniture", "Móveis de exterior" => "OutdoorFurniture",
        // Hammocks
        "Hammocks in garden" => "Hammocks", "Hengekøyer i hagen" => "Hammocks", "Hängematten im Garten" => "Hammocks", "Hamacs dans le jardin" => "Hammocks", "Hamacas en el jardín" => "Hammocks", "Amache in giardino" => "Hammocks", "Redes de dormir no jardim" => "Hammocks", "Hangmatten in de tuin" => "Hammocks", "庭のハンモック" => "Hammocks", "เปลญวนในสวน" => "Hammocks", "정원의 해먹" => "Hammocks", "Hamaki w ogrodzie" => "Hammocks", "花园吊床" => "Hammocks", "Riippumatot puutarhassa" => "Hammocks", "Hängmattor i trädgården" => "Hammocks", "Hængekøjer i haven" => "Hammocks", "बगीचे में झूला" => "Hammocks", "Buaian di taman" => "Hammocks", "Tempat tidur gantung di taman" => "Hammocks", "Redes no jardim" => "Hammocks",
        // PrivateEntrance
        "Private entrance" => "PrivateEntrance", "Privat inngang" => "PrivateEntrance", "Privater Eingang" => "PrivateEntrance", "Entrée privée" => "PrivateEntrance", "Entrada privada" => "PrivateEntrance", "Ingresso privato" => "PrivateEntrance", "Eigen ingang" => "PrivateEntrance", "専用エントランス" => "PrivateEntrance", "ทางเข้าส่วนตัว" => "PrivateEntrance", "전용 출입구" => "PrivateEntrance", "Prywatne wejście" => "PrivateEntrance", "独立入口" => "PrivateEntrance", "Oma sisäänkäynti" => "PrivateEntrance", "Egen ingång" => "PrivateEntrance", "Egen indgang" => "PrivateEntrance", "निजी प्रवेश द्वार" => "PrivateEntrance", "Pintu masuk persendirian" => "PrivateEntrance", "Pintu masuk pribadi" => "PrivateEntrance", "Entrada privativa" => "PrivateEntrance",
        // SunDeck
        "Sun deck" => "SunDeck", "Soldekk" => "SunDeck", "Sonnendeck" => "SunDeck", "Solarium" => "SunDeck", "Solárium" => "SunDeck", "Deck para sol" => "SunDeck", "Zonneterras" => "SunDeck", "サンデッキ" => "SunDeck", "ดาดฟ้าอาบแดด" => "SunDeck", "일광욕 테라스" => "SunDeck", "Taras słoneczny" => "SunDeck", "阳光甲板" => "SunDeck", "Aurinkokansi" => "SunDeck", "Soldäck" => "SunDeck", "Solterrasse" => "SunDeck", "सन डेक" => "SunDeck", "Dek matahari" => "SunDeck", "Dek berjemur" => "SunDeck", "Deck" => "SunDeck",
        // QuietLocation
        "Quiet" => "QuietLocation", "Rolig" => "QuietLocation", "Ruhig" => "QuietLocation", "Calme" => "QuietLocation", "Tranquilo" => "QuietLocation", "Silenzioso" => "QuietLocation", "Silencioso" => "QuietLocation", "Rustig" => "QuietLocation", "静か" => "QuietLocation", "เงียบสงบ" => "QuietLocation", "조용한" => "QuietLocation", "Cisza" => "QuietLocation", "安静" => "QuietLocation", "Hiljainen" => "QuietLocation", "Tyst" => "QuietLocation", "Stille" => "QuietLocation", "शांत" => "QuietLocation", "Tenang" => "QuietLocation",
        // CalmLocation
        "Calm" => "CalmLocation", "Stillhet" => "CalmLocation", "Friedlich" => "CalmLocation", "Tranquille" => "CalmLocation", "Calma" => "CalmLocation", "Tranquillo" => "CalmLocation", "Kalm" => "CalmLocation", "穏やか" => "CalmLocation", "สงบ" => "CalmLocation", "고요한" => "CalmLocation", "Spokój" => "CalmLocation", "平静" => "CalmLocation", "Rauhallinen" => "CalmLocation", "Lugnt" => "CalmLocation", "Roligt" => "CalmLocation", "Sunyi" => "CalmLocation",
    ];

    // Build amenity features as LocationFeatureSpecification (instead of PropertyValue)
    $amenityFeatures = [];
    foreach ($localizedAmenities as $name) {
        $feature = [
            "@type" => "LocationFeatureSpecification",
            "name"  => $name,
            "value" => true
        ];
        if (isset($amenity_mapping[$name])) {
            $feature['propertyID'] = $amenity_mapping[$name];
        }
        $amenityFeatures[] = $feature;
    }

    // Organization node
    $organization = [
        "@type" => "Organization",
        "@id"   => "https://lilleviklofoten.no/#organization",
        "name"  => "Lillevik Lofoten",
        "url"   => "https://lilleviklofoten.no/",
        "email" => "post@lofotenvacation.no",
        "telephone" => "+4741130944",
        "foundingDate" => "2018",
        "logo"  => "https://lilleviklofoten.no/logo/lillevik-logo-1000.jpg",
        "image" => "https://lilleviklofoten.no/logo/lillevik-logo-1000.jpg",
        "address" => $address,
        "sameAs"  => $social
    ];

    $website = [
        "@type" => "WebSite",
        "@id" => "https://lilleviklofoten.no/#website",
        "url" => "https://lilleviklofoten.no/",
        "name" => "Lillevik Lofoten",
        "publisher" => [
            "@id" => "https://lilleviklofoten.no/#organization"
        ],
        "inLanguage" => "en"
    ];

    $faq = [
        "@type" => "FAQPage",
        "@id" => "https://lilleviklofoten.no/en/frequently-asked-questions-faq/#faq",
        "url" => "https://lilleviklofoten.no/en/frequently-asked-questions-faq/",
        "name" => "Frequently Asked Questions (FAQ) — Lillevik Lofoten",
        "inLanguage" => "en",
        "headline" => "Frequently Asked Questions about Lillevik Lofoten",
        "description" => "Answers to the most common questions about Lillevik Lofoten — a peaceful beachfront holiday home in the heart of Lofoten. Includes travel tips, amenities, and booking details.",
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => "https://lilleviklofoten.no/en/frequently-asked-questions-faq/"
        ],
        "isPartOf" => [
            "@type" => "WebSite",
            "@id" => "https://lilleviklofoten.no/#website"
        ],
        "about" => [
            "@type" => "LodgingBusiness",
            "@id" => "https://lilleviklofoten.no/#business",
            "name" => "Lillevik Lofoten",
            "url" => "https://lilleviklofoten.no/en/",
            "image" => "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-001-20230710-2048x1365.jpg",
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => "Årstrandveien 663",
                "postalCode" => "8314",
                "addressLocality" => "Gimsøysand",
                "addressRegion" => "Nordland",
                "addressCountry" => "NO"
            ]
        ],
        "publisher" => [
            "@type" => "Organization",
            "@id" => "https://lilleviklofoten.no/#organization",
            "name" => "Lillevik Lofoten",
            "url" => "https://lilleviklofoten.no/",
            "logo" => [
                "@type" => "ImageObject",
                "url" => "https://lilleviklofoten.no/logo/lillevik-logo-1000.jpg"
            ]
        ],
        "mainEntity" => [
            [
                "@type" => "Question",
                "name" => "Where is Lillevik Lofoten?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "On Gimsøy, centrally between Svolvær, Henningsvær and Leknes — a quiet, scenic base for exploring the whole archipelago. See Location: https://lilleviklofoten.no/en/location/"
                ]
            ],
            [
                "@type" => "Question",
                "name" => "How far is it from the airports?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Approx. 35 minutes from Svolvær (SVJ) and Leknes (LKN); about 3.5 hours from Evenes/Harstad/Narvik (EVE). See Travel: https://lilleviklofoten.no/en/travel/"
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Are roads open year-round?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes. Both E10, bridges and all roads on Gimsøy are maintained all year. In winter (Oct–Apr), use proper snow tires."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Do I need a car in Lofoten?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes, a car is strongly recommended for exploring Lofoten. Public transport is limited, and there are no taxis based on Gimsøy."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Do you offer airport transfers?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "No — there is no transfer service. Guests typically rent a car at the airport."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "How many guests and bedrooms?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Up to 7 guests in 4 bedrooms — comfortable for families or small groups, and couples too."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "How many bathrooms?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "One full bathroom (shower + WC) plus an additional WC."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "What amenities are included?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Beachfront with private beach area; free, fast Wi-Fi; fully equipped kitchen; washer & dryer; fireplace; terrace; garden; free on-site parking; freeEV charging."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is it family-friendly? Accessibility?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes, family-friendly (baby bed and children’s high chair available). The house entrance and upper floors are accessible by stairs only."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "House rules (pets, smoking, parties)",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "No pets. Non-smoking property. No parties/events."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is there a minimum stay?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes. Minimum stay is usually 2 nights (may vary by season). Check your booking platform for exact terms."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Are cleaning fees included?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes — final cleaning is included in the total price. Guests are asked to leave the house tidy."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is late check-out possible?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Late check-out may be possible depending on availability. Contact the booking agency after booking to arrange."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is bed linen and towels included?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes — all bed linen, duvets, pillows and towels are included in the rental price."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Check-in / Check-out",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Check-in after 17:00; check-out before 10:00. See your booking confirmation for details. They keybox code will be sent by email before arrival."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is there heating in the house?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes. The house is very well insulated and heated with electric panel ovens and a fireplace."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is there Wi-Fi and mobile coverage?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes — fast, free Wi-Fi (120/100 Mbps) and good 4G/5G coverage (with Telenor)."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is there a grocery store nearby?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes. The nearest grocery store is Gimsøy Landhandel (about 8 min by car), open 24/7/365. Larger supermarkets are in Svolvær and Leknes."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Parking & EV charging",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Free private parking on site (up to three cars) and free EV charging."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "When can I see the Northern Lights?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Typically late August–early April on clear, dark nights."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "When is the Midnight Sun?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Late May–mid-July."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Kayaking and rentals",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Direct sea access for guests bringing their own kayak. Nearest kayak rental is in Henningsvær (35 min by car)."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Are there hiking trails directly from the house?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes — you can start the popular hike to Hoven (368 m) from the house, plus other scenic trails."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is swimming possible?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes, the water is cold but clean. The temperature ranges from about 2°C in winter to 12–15°C in summer."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "What activities are nearby?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Hiking, kayaking, beach walks, surfing, northern lights watching, fishing, birdwatching and midnight sun experiences."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is Lillevik environmentally friendly?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes — the house is heated with renewable hydroelectric energy, has LED lighting, EV charging, and encourages low-waste travel."
                ]
            ]
        ]
    ];


    // LodgingBusiness node (cleaned & linked to org via brand)
    $lodging = [
        "@type" => "LodgingBusiness",
        "@id"   => "https://lilleviklofoten.no/#business",
        "name"  => "Lillevik Lofoten",
        "url"   => "https://lilleviklofoten.no/",
        "description" => $description,
        "telephone"   => "+4741130944",
        "brand"       => [ "@id" => "https://lilleviklofoten.no/#organization" ],
        "subjectOf" => [ [ "@id" => "https://lilleviklofoten.no/en/frequently-asked-questions-faq/#faq" ] ],
        "priceRange"  => "NOK 1,800–4,000 per night",
        "checkinTime" => "17:00",
        "checkoutTime"=> "10:00",
        "petsAllowed" => false,
        "smokingAllowed" => false,
        "address" => $address,
		"hasMap" => "https://maps.app.goo.gl/nKPJn2wFm5uWBZTg7",
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude"  => 68.330081,
            "longitude" => 14.091728
        ],
        "amenityFeature" => $amenityFeatures,
        "aggregateRating" => [
            "@type"      => "AggregateRating",
            "ratingValue"=> "10",
            "reviewCount"=> 38,
            "bestRating" => 10,
            "worstRating"=> 1
        ],
        "image" => [
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-001-20230710-2048x1365.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2025/06/20250629-1656-4487.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2025/06/20250627-0959-4412.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-044-20230730.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-050-20240224.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-047-20231110.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2023/11/20230731-1429-2388.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2023/03/lillevik-028-20200718-1850-8287.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-019-20200718-scaled.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-011-20240221.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-014-20240221.jpg",
            "https://lilleviklofoten.no/wp-content/uploads/2024/02/lillevik-043-20230802.jpg"
        ],
        "containsPlace" => [
            "@type" => "Accommodation",
            "name"  => "Beachfront Holiday Home",
            "occupancy" => [
                "@type" => "QuantitativeValue",
                "maxValue" => 7
            ],
            "numberOfRooms" => 4,
            "bed" => [
                "@type" => "BedDetails",
                "numberOfBeds" => 4,
                "typeOfBed"   => "Double bed"
            ]
        ],
        "sameAs" => $businessSameAs
    ];

    // Emit one JSON-LD block with @graph
    $graph = [
        "@context" => "https://schema.org",
        "@graph"   => [ $website, $organization, $lodging, $faq ]
    ];

    echo '<script type="application/ld+json">' .
        wp_json_encode($graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) .
        '</script>';
});
