<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing posts to avoid duplicates if re-running
        BlogPost::truncate();

        $posts = [
            [
                'title' => [
                    'tr' => 'Kalkan Meyhane Kültürü: Geleneksel Bir Akdeniz Lezzet Yolculuğu',
                    'en' => 'Kalkan Tavern Culture: A Traditional Mediterranean Culinary Journey'
                ],
                'slug' => [
                    'tr' => 'kalkan-meyhane-kulturu',
                    'en' => 'kalkan-tavern-culture'
                ],
                'description' => [
                    'tr' => 'Kalkan meyhanelerinin büyüleyici atmosferi, taze deniz ürünleri, yerel mezeler ve asırlık meyhane geleneği üzerine kapsamlı bir rehber.',
                    'en' => 'A comprehensive guide to the enchanting atmosphere of Kalkan taverns, fresh seafood, local appetizers, and the centuries-old tavern tradition.'
                ],
                'content' => [
                    'tr' => '<h2>Kalkan\'da Meyhane Kültürünün Derinliklerine Yolculuk</h2>
                    <p>Akdeniz\'in incisi Kalkan, sadece turkuaz sularıyla değil, aynı zamanda akşamları liman boyunca ve dar sokaklarında canlanan benzersiz meyhane kültürüyle de bilinir. Bir meyhaneye girmek, sadece yemek yemek değil, yüzyıllardır süregelen bir sosyal ritüelin parçası olmaktır. Kalkan\'ın kendine has coğrafyası ve tarihi dokusu, bu kültürü daha da özel kılar.</p>
                    
                    <h3>Mezelerin Hikayesi: Sofranın Ruhu</h3>
                    <p>Kalkan meyhanelerinde sofra, "soğuk mezeler" ile kurulur. Bu mezeler, bölgenin en taze zeytinyağları, tarladan yeni koparılmış otlar ve yerel mandıralardan gelen peynirlerle hazırlanır. Közlenmiş patlıcanın dumanlı tadından, deniz börülcesinin diri dokusuna; klasik humus ve haydariden, bölgeye özgü "Kalkan usulü" özel salatalara kadar her tabak bir hikaye anlatır. Mezeler, rakının en sadık dostudur ve sohbetin demlenmesini sağlar.</p>
                    
                    <h3>Ara Sıcaklar ve Ana Yemekler</h3>
                    <p>Sohbet ilerledikçe, sahneye ara sıcaklar çıkar. Tereyağında karidesin cızırtısı, kalamar tavasının altın sarısı çıtırlığı ve ahtapot ızgaranın yumuşacık dokusu masadaki neşeyi artırır. Kalkan, deniz ürünleri konusunda oldukça şanslı bir bölgedir. Ana yemekte ise günlük balıklar öne çıkar. Lagos, levrek veya çipura gibi bölgenin en lezzetli balıkları, genellikle en doğal halleriyle, sadece zeytinyağı ve limonun eşliğiyle ızgarada pişirilir.</p>
                    
                    <h3>Sohbetin Gücü: Meyhane Bir Adres Değil, Bir Hissiyattır</h3>
                    <p>Meyhane kültürünü diğer restoran deneyimlerinden ayıran en önemli özellik, zamandır. Meyhanede aceleye yer yoktur. Saatlerce süren akşam yemekleri, eski dostlukların tazelenmesine veya yeni dostlukların kurulmasına imkan verir. Kalkan\'ın yıldızlarla dolu gökyüzü altında, hafif bir Akdeniz esintisi eşliğinde yapılan bu uzun yemekler, ruhu dinlendiren bir terapi gibidir.</p>
                    
                    <h3>Kalkan Meyhanelerinde Dikkat Edilmesi Gerekenler</h3>
                    <p>Kalkan\'da meyhane keyfi yaparken birkaç detaya dikkat etmek deneyiminizi mükemmelleştirebilir. Öncelikle, özellikle yaz aylarında popüler mekanlar için mutlaka rezervasyon yaptırmalısınız. Ayrıca, "çilingir sofrası" adabını yaşamak için mezeleri yavaş yavaş, tadını çıkararak tüketmek önemlidir. Pruva Restaurant olarak biz, bu kadim kültürü en modern ve taze haliyle masanıza taşıyoruz.</p>
                    
                    <p>Sonuç olarak, Kalkan meyhaneleri size sadece bir akşam yemeği vaat etmez; size Akdeniz\'in ruhunu, müziğin tınısını ve unutulmaz anılar sunar. Bir sonraki Kalkan ziyaretinizde kendinizi bu geleneksel lezzet yolculuğuna bırakmayı unutmayın.</p>',
                    'en' => '<h2>A Journey into the Depths of Kalkan Tavern Culture</h2>
                    <p>Kalkan, the pearl of the Mediterranean, is known not only for its turquoise waters but also for its unique tavern (meyhane) culture that comes alive in the evenings along the harbor and in its narrow streets. Entering a tavern is not just about eating; it is about becoming part of a social ritual that has been ongoing for centuries. Kalkan\'s unique geography and historical texture make this culture even more special.</p>
                    
                    <h3>The Story of Mezes: The Soul of the Table</h3>
                    <p>In Kalkan taverns, the table is set with "cold mezes" (appetizers). These mezes are prepared with the freshest olive oils of the region, freshly picked herbsจาก the fields, and cheeses from local dairies. From the smoky flavor of roasted eggplant to the crisp texture of sea beans; from classic hummus and haydari to special "Kalkan style" salads unique to the region, every plate tells a story. Mezes are the most loyal companions of rakı and allow the conversation to brew.</p>
                    
                    <h3>Hot Starters and Main Courses</h3>
                    <p>As the conversation progresses, "ara sıcaklar" (hot starters) take the stage. The sizzle of shrimp in butter, the golden yellow crispiness of fried calamari, and the soft texture of grilled octopus increase the joy at the table. Kalkan is a very lucky region when it comes to seafood. Daily fish stand out for the main course. The most delicious fish of the region, such as grouper, sea bass, or sea bream, are usually cooked on the grill in their most natural state, accompanied only by olive oil and lemon.</p>
                    
                    <h3>The Power of Conversation: A Tavern is a Feeling, Not Just an Address</h3>
                    <p>The most important feature that distinguishes the tavern culture from other restaurant experiences is time. There is no place for rush in a tavern. Dinners lasting for hours allow old friendships to be refreshed or new ones to be established. Under Kalkan\'s star-filled sky, accompanied by a light Mediterranean breeze, these long meals are like a therapy that rests the soul.</p>
                    
                    <h3>Things to Consider in Kalkan Taverns</h3>
                    <p>Paying attention to a few details while enjoying a tavern in Kalkan can perfect your experience. First, you should definitely book in advance for popular venues, especially in the summer months. Also, it is important to consume mezes slowly and enjoy them to experience the etiquette of the "çilingir sofrası" (raki table). As Pruva Restaurant, we bring this ancient culture to your table in its most modern and fresh form.</p>
                    
                    <p>In conclusion, Kalkan taverns do not just promise you a dinner; they offer you the soul of the Mediterranean, the sound of music, and unforgettable memories. Do not forget to let yourself go into this traditional culinary journey on your next Kalkan visit.</p>'
                ],
                'image' => null,
                'published_at' => now(),
            ],
            [
                'title' => [
                    'tr' => 'Kalkan\'da Rakı Balık Keyfi: Gün Batımının ve Tazeliğin Buluşması',
                    'en' => 'Rakı & Fish Delight in Kalkan: Where Sunset and Freshness Meet'
                ],
                'slug' => [
                    'tr' => 'kalkan-raki-balik-keyfi',
                    'en' => 'kalkan-raki-fish-delight'
                ],
                'description' => [
                    'tr' => 'Kalkan\'da rakı balık geleneğinin tüm detayları: Tarihçe, servis adabı, en taze balık türleri ve liman keyfi üzerine derinlikli bir yazı.',
                    'en' => 'All details of the rakı-fish tradition in Kalkan: A deep dive into history, service etiquette, the freshest fish types, and harbor delight.'
                ],
                'content' => [
                    'tr' => '<h2>Kalkan\'da Bir Rakı Balık Klasiği</h2>
                    <p>Türkiye\'nin güney kıyılarında bir tatilin vazgeçilmezidir rakı-balık. Ancak Kalkan\'da bu deneyim, dik bir yamaç üzerine kurulu kasabanın limanına doğru süzülürken bambaşka bir boyuta ulaşır. Kalkan Limanı\'nın ışıltılı suları ve arka plandaki tarihi evler, kadehinize eşlik eden manzarayı oluşturur.</p>
                    
                    <h3>Balık Seçiminin Önemi: Mevsimsellik ve Tazelik</h3>
                    <p>İyi bir rakı balık sofrasının temeli, denizden o gün gelmiş taze balıktır. Kalkan\'da mevsimine göre birçok seçenek bulunur. İlkbaharda barbun ve tekir, yaz aylarında trança ve lagos, sonbahar ve kış aylarında ise kofana veya palamut sofraları süsler. Kalkan\'ın kayalık suları, balıkların etinin daha sıkı ve lezzetli olmasını sağlar. Seçtiğiniz balığın ızgarada mı yoksa fırında mı dahi iyi olacağı konusunda garsonunuzun tavsiyesi genellikle en doğru yoldur.</p>
                    
                    <h3>Rakı Adabı: Yavaş ve Keyifli</h3>
                    <p>Rakı, "aslan sütü" olarak bilinen ve kendine has kuralları olan bir içecektir. Kalkan\'da rakı içmek, hayatın hızını yavaşlatmak demektir. Rakının kadehe konuluşu, suyun ilave edilişi ve beyaz bulutun oluşumu masadaki ilk ritüeldir. Yanına gelen bir dilim sert beyaz peynir ve bir parça kavun, bu başlangıcı tamamlar. Rakı, yudum yudum içilir; her yudumda Akdeniz\'in tuzlu havası ve sofradaki neşeli kahkahalar harmanlanır.</p>
                    
                    <h3>Denizden Masaya: Pruva\'nın Sunumu</h3>
                    <p>Pruva Restaurant olarak biz, balıklarımızı yerel balıkçılarımızdan veya kendi teknemizden temin etmeye büyük önem veriyoruz. Masanıza gelen her balık, sadece bir yemek değil, denizin bize sunduğu bir armağandır. Şeflerimizin imza dokunuşlarıyla hazırlanan marinasyonlar, balığın doğal lezzetini bozmadan onu daha da ön plana çıkarır.</p>
                    
                    <h3>Unutulmaz Bir Akşam İçin İpuçları</h3>
                    <p>Kalkan\'da rakı balık keyfi yapacaksanız, yemeğe gün batımından hemen önce başlamanızı öneririz. Gökyüzünün turuncudan mora çalan renk değişimini izlerken alınan ilk yudum, yemeğin tüm enerjisini belirler. Ayrıca masadaki sohbetin de en az yemek kadar doyurucu olması beklenir. Akıllı telefonları bir kenara bırakıp, denizin sesine ve yanınızdakilerin kelimelerine odaklanmak gerçek huzuru getirir.</p>
                    
                    <p>Kalkan\'da rakı balık, sadece bir karın doyurma eylemi değil, bir yaşam tarzıdır. Bu geleneği yerinde yaşamak için sizi Pruva\'nın eşsiz manzarasına bekliyoruz.</p>',
                    'en' => '<h2>A Rakı-Fish Classic in Kalkan</h2>
                    <p>Rakı-fish is indispensable for a holiday on the southern coast of Turkey. However, in Kalkan, this experience reaches a completely different dimension while gliding towards the harbor of the town built on a steep slope. The sparkling waters of Kalkan Harbor and the historical houses in the background form the view accompanying your glass.</p>
                    
                    <h3>The Importance of Fish Selection: Seasonality and Freshness</h3>
                    <p>The foundation of a good rakı-fish table is fresh fish that came from the sea that day. There are many options in Kalkan depending on the season. Red mullet and surmullet in spring, grouper and dentex in summer months, and larger sea bass or bonito decorate the tables in autumn and winter. Kalkan\'s rocky waters ensure that the flesh of the fish is firmer and tastier. Your waiter\'s advice on whether the fish you choose will be better grilled or baked is usually the correct path.</p>
                    
                    <h3>Rakı Etiquette: Slow and Pleasant</h3>
                    <p>Rakı, known as "aslan sütü" (lion\'s milk), is a drink with its own unique rules. Drinking rakı in Kalkan means slowing down the speed of life. Putting the rakı in the glass, adding the water, and the formation of the white cloud is the first ritual at the table. A slice of hard white cheese and a piece of melon coming next to it complete this start. Rakı is drunk sip by sip; with every sip, the salty air of the Mediterranean and the cheerful laughter at the table are blended.</p>
                    
                    <h3>From Sea to Table: Pruva\'s Presentation</h3>
                    <p>As Pruva Restaurant, we attach great importance to obtaining our fish from our local fishermen or our own boat. Every fish that comes to your table is not just a meal, but a gift from the sea to us. Marinations prepared with our chefs\' signature touches highlight the natural flavor of the fish without spoiling it.</p>
                    
                    <h3>Tips for an Unforgettable Evening</h3>
                    <p>If you are going to enjoy rakı-fish in Kalkan, we recommend you start dinner just before sunset. The first sip taken while watching the color change of the sky from orange to purple determines the entire energy of the meal. Also, the conversation at the table is expected to be at least as fulfilling as the food. Putting smartphones aside and focusing on the sound of the sea and the words of those next to you brings real peace.</p>
                    
                    <p>Rakı-fish in Kalkan is not just an act of filling the stomach, it is a lifestyle. We invite you to Pruva\'s unique view to experience this tradition on site.</p>'
                ],
                'image' => null,
                'published_at' => now()->subDay(),
            ],
            [
                'title' => [
                    'tr' => 'Kalkan Fasıl Geceleri: Nota Nota Akdeniz Eğlencesi',
                    'en' => 'Kalkan Fasıl Nights: Mediterranean Entertainment Note by Note'
                ],
                'slug' => [
                    'tr' => 'kalkan-fasil-geceleri',
                    'en' => 'kalkan-fasil-nights'
                ],
                'description' => [
                    'tr' => 'Kalkan\'ın enerjik gecelerinde fasıl müziğinin yeri, geleneksel enstrümanlar ve bu özel gecelerin gastronomik eşlikçileri üzerine bir inceleme.',
                    'en' => 'The place of fasıl music in Kalkan\'s energetic nights, traditional instruments, and the gastronomic accompaniments of these special nights.'
                ],
                'content' => [
                    'tr' => '<h2>Kalkan Gecelerinin Rüzgarı: Fasıl</h2>
                    <p>Güneş Kalkan\'ın üzerinden batıp yerini yıldızlara bıraktığında, kasabanın sokaklarından ince ince süzülen bir ses duyulur: Kanun, keman ve udun büyüleyici uyumu. Fasıl müziği, Kalkan\'ın modern turizm dokusuyla geleneksel Türk ruhunu birleştiren en güçlü köprülerden biridir.</p>
                    
                    <h3>Fasıl Nedir? Bir Gelenek Mirası</h3>
                    <p>Aslında bir müzik formu olan fasıl, zamanla bütünsel bir eğlence kültürüne dönüşmüştür. Türk Sanat Müziği\'nin en seçkin eserlerinin icra edildiği bu gecelerde, dinleyiciler sadece birer izleyici değil, aynı zamanda koro halinde şarkılara eşlik eden birer katılımcıdır. Kalkan\'da fasıl, genellikle açık hava teraslarında veya limana nazır mekanlarda yapılır, bu da müziğin etkisini on kat artırır.</p>
                    
                    <h3>Fasıl Masasının Olmazsa Olmazları</h3>
                    <p>Bir fasıl masası, normal bir yemek masasından farklıdır. Burada odak noktası paylaşımdır. Ortaya gelen büyük tabaklarda sunulan "paylaşımlık" mezeler, masadaki bağın güçlenmesini sağlar. Humus, süzme yoğurtlu atom, acılı ezme ve çiğ börek gibi lezzetler müziğin ritmine eşlik eder. Ara ara yükselen kadeh sesleri, fasılın doğal bir parçası olan neşe vurgusudur.</p>
                    
                    <h3>Hüzün ve Neşe Arasında Bir Denge</h3>
                    <p>Fasıl müziği, duyguların en geniş yelpazesini sunar. Gecenin ilk saatlerinde daha hüzünlü ve ağır şarkılarla (gazeller, ağır aksak formlar) başlayan program, ilerleyen saatlerde yerini enerjik oyun havalarına ve neşeli şarkılara bırakır. Bu geçiş, aslında insan hayatının bir özetidir. Kalkan\'ın mistik havası, bu duygusal geçişleri daha da derin hissetmenizi sağlar.</p>
                    
                    <h3>Pruva\'da Özel Fasıl Akşamları</h3>
                    <p>Pruva Restaurant olarak, misafirlerimize dönem dönem düzenlediğimiz fasıl geceleriyle unutulmaz anlar yaşatıyoruz. Usta müzisyenlerin elinden çıkan her nota, Ege ve Akdeniz\'in ortak kültürel mirasını masanıza taşır. Bizim için fasıl, sadece müzik değil, kalpleri birleştiren bir dildir.</p>
                    
                    <h3>Deneyiminizi Güzelleştirecek Öneriler</h3>
                    <p>Fasıl gecesine katılacaksanız, şarkı listesine (repertuvar) aşina olmak veya en azından nakaratlara eşlik etmek keyfinizi artıracaktır. Ayrıca, müziğin akışına kendinizi bırakmalı ve masadaki diğer misafirlerle olan iletişimi koparmamalısınız. Fasıl, paylaşıldıkça çoğalan bir mutluluktur.</p>
                    
                    <p>Kalkan tatilinizi bir fasıl gecesiyle taçlandırmak, size bölgenin sadece bir tatil beldesi değil, yaşayan bir kültür merkezi olduğunu kanıtlayacaktır.</p>',
                    'en' => '<h2>The Breeze of Kalkan Nights: Fasıl</h2>
                    <p>When the sun sets over Kalkan and leaves its place to the stars, a subtle sound is heard gliding through the streets of the town: the enchanting harmony of the qanun, violin, and oud. Fasıl music is one of the strongest bridges combining the traditional Turkish soul with Kalkan\'s modern tourism texture.</p>
                    
                    <h3>What is Fasıl? A Heritage of Tradition</h3>
                    <p>Fasıl, which is actually a music form, has transformed into a holistic entertainment culture over time. In these nights where the most distinguished works of Turkish Classical Music are performed, listeners are not just spectators but also participants accompanying the songs in a choir. In Kalkan, fasıl is usually held on open-air terraces or venues facing the harbor, which increases the effect of the music tenfold.</p>
                    
                    <h3>Essentials of a Fasıl Table</h3>
                    <p>A fasıl table is different from a normal dining table. The focus here is on sharing. "Sharable" mezes served in large plates in the middle ensure that the bond at the table is strengthened. Flavors such as hummus, atom with strained yogurt, spicy paste, and raw pastry accompany the rhythm of the music. The sounds of clinking glasses rising from time to time are the emphasis of joy, which is a natural part of the fasıl.</p>
                    
                    <h3>A Balance Between Sadness and Joy</h3>
                    <p>Fasıl music offers the widest range of emotions. The program, which starts with more sad and heavy songs in the first hours of the night, gives way to energetic dance tunes and cheerful songs in the later hours. This transition is actually a summary of human life. Kalkan\'s mystic atmosphere allows you to feel these emotional transitions even more deeply.</p>
                    
                    <h3>Special Fasıl Evenings at Pruva</h3>
                    <p>As Pruva Restaurant, we provide our guests with unforgettable moments with the fasıl nights we organize from time to time. Every note coming from the hands of master musicians carries the shared cultural heritage of the Aegean and the Mediterranean to your table. For us, fasıl is not just music, but a language that unites hearts.</p>
                    
                    <h3>Suggestions to Beautiful Your Experience</h3>
                    <p>If you are going to participate in a fasıl night, being familiar with the song list (repertoire) or at least accompanying the choruses will increase your pleasure. Also, you should let yourself go into the flow of the music and not break communication with other guests at the table. Fasıl is a happiness that increases as it is shared.</p>
                    
                    <p>Crowning your Kalkan holiday with a fasıl night will prove to you that the region is not just a holiday resort, but a living cultural center.</p>'
                ],
                'image' => null,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => [
                    'tr' => 'Kalkan\'ın En İyi Balık Restoranları: 2024 Gastronomi Rehberi',
                    'en' => 'The Best Fish Restaurants in Kalkan: 2024 Gastronomy Guide'
                ],
                'slug' => [
                    'tr' => 'kalkan-en-iyi-balik-restoranlari-rehberi',
                    'en' => 'best-fish-restaurants-in-kalkan-guide'
                ],
                'description' => [
                    'tr' => 'Kalkan\'da kusursuz bir deniz mahsulleri deneyimi için en iyi adresler, şeflerin önerileri ve rezervasyon ipuçlarıyla dolu kapsamlı bir rehber.',
                    'en' => 'A comprehensive guide full of the best addresses, chefs\' recommendations, and reservation tips for a perfect seafood experience in Kalkan.'
                ],
                'content' => [
                    'tr' => '<h2>Kalkan\'da Gurmeler İçin Balık Restoranı Seçimi</h2>
                    <p>Kalkan, sadece bir tatil beldesi değil, aynı zamanda Akdeniz mutfağının en seçkin örneklerinin sunulduğu bir gastronomi merkezidir. Onlarca restoran arasında "en iyi"yi bulmak, bazen zorlayıcı olabilir. Bu rehberimizde, kalite, tazelik ve atmosfer kriterlerini gözeterek hazırladığımız en iyi balık restoranı ipuçlarını bulacaksınız.</p>
                    
                    <h3>Balık Restoranında Kaliteyi Nasıl Anlarsınız?</h3>
                    <p>İyi bir balık restoranı, öncelikle mevsimsel davranır. Eğer Ocak ayında size taze Lagos vaat ediliyorsa, orada bir soru işareti olmalıdır. Kalkan\'ın en iyi restoranları, yerel kooperatiflerle çalışır ve o gün denizden ne çıktıysa menüsünü ona göre günceller. Ayrıca, restoranın vitrinindeki balıkların gözlerinin parlaklığı ve solungaçlarının rengi, tazeliğin en somut kanıtıdır.</p>
                    
                    <h3>Liman vs. Yamaç: Hangi Atmosfer?</h3>
                    <p>Kalkan\'da balık restoranı seçerken iki temel atmosferden birini tercih edersiniz: Liman içi veya yamaç terasları. Liman içindeki restoranlar, hareketin ve kasaba hayatının tam merkezindedir. Tekne sesleri ve kalabalığın neşesi size eşlik eder. Yamaçlardaki teras restoranlar ise uçsuz bucaksız deniz manzarası ve sessizlik vaat eder. Pruva Restaurant olarak biz, her iki avantajı da birleştiren, hem denizle iç içe hem de kaostan uzak bir konumda hizmet sunuyoruz.</p>
                    
                    <h3>İmza Lezzetler: Sadece Balık Değil</h3>
                    <p>En iyi Kalkan balık restoranları, sadece ana yemeğiyle değil, imza ara sıcaklarıyla da öne çıkar. Şevketi bostanlı levrek, fesleğenli balık kokoreç veya limon soslu ahtapot carpaccio gibi modern dokunuşlar, restoranın yaratıcılığını gösterir. Geleneksel yöntemleri modern sunumlarla birleştiren şefler, Kalkan\'ı bir gastronomi markası haline getiriyor.</p>
                    
                    <h3>Kalkan Balık Restoranı Fiyatları ve Rezervasyon</h3>
                    <p>2024 yılı itibarıyla Kalkan\'da fiyatlar mekanın konumu ve sunduğu hizmetin kalitesine göre farklılık gösterir. Ancak unutmayın ki, "en pahalı" her zaman "en iyi" demek değildir. Gerçek lezzet, malzemenin dürüstlüğündedir. Özellikle Temmuz ve Ağustos aylarında, istediğiniz masayı alabilmek için en az 2 gün önceden rezervasyon yaptırmanızı şiddetle tavsiye ederiz.</p>
                    
                    <p>Sonuç olarak, Kalkan\'ın balık restoranları size Akdeniz\'in cömertliğini sunacaktır. Doğru seçimle, bu yemek tatilinizin en parlak anısı olabilir.</p>',
                    'en' => '<h2>Choosing a Fish Restaurant for Gourmets in Kalkan</h2>
                    <p>Kalkan is not just a holiday resort, but also a gastronomy center where the most distinguished examples of Mediterranean cuisine are presented. Finding the "best" among dozens of restaurants can sometimes be challenging. In this guide, you will find information on the best fish restaurants prepared by considering quality, freshness, and atmospheric criteria.</p>
                    
                    <h3>How Do You Recognize Quality in a Fish Restaurant?</h3>
                    <p>A good fish restaurant acts seasonally. If you are promised fresh grouper in January, there should be a question mark. The best restaurants in Kalkan work with local cooperatives and update their menus according to what comes out of the sea that day. Also, the brightness of the eyes and the color of the gills of the fish in the restaurant\'s showcase are the most concrete evidence of freshness.</p>
                    
                    <h3>Harbor vs. Hillside: Which Atmosphere?</h3>
                    <p>When choosing a fish restaurant in Kalkan, you choose one of two basic atmospheres: in the harbor or on the hillside terraces. The restaurants in the harbor are at the center of the movement and town life. The sounds of boats and the joy of the crowd accompany you. Hillside terrace restaurants promise an endless sea view and silence. As Pruva Restaurant, we offer service in a location that combines both advantages, both integrated with the sea and away from the chaos.</p>
                    
                    <h3>Signature Flavors: Not Just Fish</h3>
                    <p>The best Kalkan fish restaurants stand out not only with their main courses but also with their signature hot starters. Modern touches such as sea bass with cnicus benedictus, fish kokoreç with basil, or octopus carpaccio with lemon sauce show the creativity of the restaurant. Chefs who combine traditional methods with modern presentations are making Kalkan a gastronomy brand.</p>
                    
                    <h3>Kalkan Fish Restaurant Prices and Reservation</h3>
                    <p>As of 2024, prices in Kalkan vary according to the location of the venue and the quality of the service provided. But remember that "the most expensive" does not always mean "the best". True flavor is in the honesty of the ingredients. Especially in July and August, we strongly recommend you book at least 2 days in advance to get the table you want.</p>
                    
                    <p>In conclusion, Kalkan\'s fish restaurants will offer you the generosity of the Mediterranean. With the right choice, this meal can be the brightest memory of your holiday.</p>'
                ],
                'image' => null,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => [
                    'tr' => 'Kalkan Balık Restoranı Deneyimi: Neden Pruva Tek Kelimeyle Farklı?',
                    'en' => 'Kalkan Fish Restaurant Experience: Why Pruva is Simply Different?'
                ],
                'slug' => [
                    'tr' => 'kalkan-balik-restorani-deneyimi-pruva',
                    'en' => 'kalkan-fish-restaurant-experience-pruva'
                ],
                'description' => [
                    'tr' => 'Kalkan\'ın kalbinde, deniz kenarında konumlanan Pruva Restaurant\'ın hikayesi, servis felsefesi ve mutfak sırları üzerine bir yolculuk.',
                    'en' => 'A journey through the story, service philosophy, and kitchen secrets of Pruva Restaurant, located by the seaside in the heart of Kalkan.'
                ],
                'content' => [
                    'tr' => '<h2>Pruva Restaurant: Bir Kalkan Masalı</h2>
                    <p>Kalkan Yarımadası\'nın o eşsiz kıvrımında, denizin kokusunu her an hissedebileceğiniz bir noktada yer alıyor Pruva. Bizim için bir balık restoranı işletmek sadece bir ticaret değil, bir misafir ağırlama sanatıdır. Pruva\'yı diğerlerinden ayıran en önemli özelliklerden biri, kendinizi evinizdeymiş gibi hissettiren samimiyetimizdir.</p>
                    
                    <h3>Mutfak Felsefemiz: Doğallığa Saygı</h3>
                    <p>Şeflerimiz, her sabah Kalkan Limanı\'ndan gelen taze mahsulleri bizzat seçer. Mutfağımızda dondurulmuş ürünlere veya yapay tatlandırıcılara yer yoktur. Balığın kendi suyunun içinde pişmesi, zeytinyağının kalitesi ve baharatların dengesi bizim için kutsaldır. Kendi bahçemizden gelen taze kekik ve biberiyeler, yemeklerimizin ruhunu oluşturur.</p>
                    
                    <h3>Şarap ve Rakı Kavımız</h3>
                    <p>İyi bir yemek, doğru içecek eşleşmesiyle tamamlanır. Pruva\'da yerel Türk şaraplarından dünyanın en seçkin bölgelerine kadar uzanan geniş bir kavımız bulunmaktadır. Rakı çeşitlerimiz ise, "beyaz bulutun" en iyi eşlikçilerini sunmak üzere özenle seçilmiştir. Garsonlarımız, seçtiğiniz yemeğe en uygun içecek konusunda size her zaman rehberlik eder.</p>
                    
                    <h3>Sürdürülebilirlik ve Deniz Sevgisi</h3>
                    <p>Biz denize aşığız ve bu aşk beraberinde büyük bir sorumluluk getiriyor. Pruva Restaurant olarak, sürdürülebilir balıkçılığı destekliyor, avlanma yasaklarına harfiyen uyuyoruz. Denizin bize sunduklarına saygı duyarak, gelecek nesillerin de bu lezzetleri tadabilmesi için üzerimize düşeni yapıyoruz. Kullandığımız her malzeme, bu saygının bir ürünüdür.</p>
                    
                    <h3>Misafirlerimizin Gözünden Pruva</h3>
                    <p>Yıllardır bizi tercih eden misafirlerimizden duyduğumuz en ortak cümle: "Huzur". Pruva\'ya geldiğinizde sadece karnınız doymaz, ruhunuz da Akdeniz\'in dingin sularıyla birleşir. Akşam yemeğiniz bittiğinde, kahvenizi yudumlarken hissettiğiniz o tatlı yorgunluk, bizim en büyük başarımızdır.</p>
                    
                    <h3>Sizi Bekliyoruz</h3>
                    <p>Kalkan Balık Restoranı arayışınızda, sizi sıradanlıktan uzak, lezzet ve manzaranın doruk noktasına davet ediyoruz. Pruva ailesi olarak, Akdeniz akşamlarını birlikte paylaşmak için sabırsızlanıyoruz.</p>',
                    'en' => '<h2>Pruva Restaurant: A Kalkan Tale</h2>
                    <p>Pruva is located at that unique curve of the Kalkan Peninsula, at a point where you can feel the smell of the sea at any moment. For us, running a fish restaurant is not just a business, but an art of hospitality. One of the most important features that distinguish Pruva from others is our sincerity that makes you feel at home.</p>
                    
                    <h3>Our Kitchen Philosophy: Respect for Naturalness</h3>
                    <p>Our chefs personally select the fresh produce coming from Kalkan Harbor every morning. There is no place for frozen products or artificial sweeteners in our kitchen. The fish cooking in its own juice, the quality of the olive oil, and the balance of the spices are sacred to us. Fresh thyme and rosemary from our own garden form the soul of our meals.</p>
                    
                    <h3>Our Wine and Rakı Cellar</h3>
                    <p>A good meal is completed with the correct drink pairing. At Pruva, we have a wide cellar ranging from local Turkish wines to the most exclusive regions of the world. Our rakı varieties are carefully selected to offer the best companions to the "white cloud". Our waiters always guide you on the most suitable drink for the meal you choose.</p>
                    
                    <h3>Sustainability and Love for the Sea</h3>
                    <p>We are in love with the sea, and this love brings a great responsibility with it. As Pruva Restaurant, we support sustainable fishing and strictly comply with hunting bans. By respecting what the sea offers us, we do our part so that future generations can taste these flavors too. Every material we use is a product of this respect.</p>
                    
                    <h3>Pruva Through the Eyes of Our Guests</h3>
                    <p>The most common sentence we hear from our guests who have been choosing us for years is: "Peace". When you come to Pruva, not only is your stomach filled, but your soul also merges with the calm waters of the Mediterranean. That sweet fatigue you feel while sipping your coffee when your dinner is finished is our greatest achievement.</p>
                    
                    <h3>We Are Waiting for You</h3>
                    <p>In your search for a Kalkan Fish Restaurant, we invite you to the peak of flavor and view, away from the ordinary. As the Pruva family, we look forward to sharing Mediterranean evenings together.</p>'
                ],
                'image' => null,
                'published_at' => now()->subDays(4),
            ],
        ];

        foreach ($posts as $postData) {
            BlogPost::create($postData);
        }
    }
}
