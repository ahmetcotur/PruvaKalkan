<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class OurStorySettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero
            [
                'key' => 'our_story_hero_image',
                'type' => 'image',
                'group' => 'our_story',
                'value' => 'gallery/DJI_0834-Edit-scaled.jpg',
            ],
            [
                'key' => 'our_story_hero_title',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Bir Akdeniz Masalı: Pruva\'nın Hikayesi',
                    'en' => 'A Mediterranean Tale: The Pruva Story'
                ],
            ],
            [
                'key' => 'our_story_hero_subtitle',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Denizin, toprağın ve ateşin kalbinden gelen bir lezzet yolculuğu.',
                    'en' => 'A journey of flavor from the heart of the sea, the land, and the flame.'
                ],
            ],

            // Roots
            [
                'key' => 'our_story_roots_title',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Köklerimiz',
                    'en' => 'Our Roots'
                ],
            ],
            [
                'key' => 'our_story_roots_content',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Pruva\'nın hikayesi, antik zamanlardan beri medeniyetlerin beşiği olmuş, Akdeniz\'in en kristal kıyılarına sahip Kaş\'ın ruhunda başlar. \'Pruva\' ismini, bu toprakların en kadim sakini olan ve bilgeliği, barışı ve bereketi simgeleyen zeytin ağacından alır. Yüzyıllardır bu coğrafyada kök salan zeytin ağaçları gibi, biz de yerel kültürümüzün ve misafirperverliğimizin derinliklerine kök saldık. Her bir yaprağında gümüş parıltılar taşıyan zeytin dalları, mutfağımızın ve soframızın temelini oluşturur. Pruva, sadece bir restoran değil, bu bölgenin sunduğu tüm bereketi onurlandırmak için kurulmuş bir buluşma noktasıdır.',
                    'en' => 'The story of Pruva begins in the spirit of Kaş, home to the most crystalline shores of the Mediterranean and a cradle of civilizations since ancient times. Pruva takes its name from the oldest inhabitant of this land: the olive tree, symbolizing wisdom, peace, and abundance. Just as the olive trees have taken root here for centuries, we have rooted ourselves in the depths of our local culture and hospitality. Olive branches, with silver glimmers on every leaf, form the foundation of our kitchen and our table. Pruva is not just a restaurant; it is a gathering point established to honor all the bounty this region offers.'
                ],
            ],
            [
                'key' => 'our_story_roots_image',
                'type' => 'image',
                'group' => 'our_story',
                'value' => 'gallery/029A5168.jpg',
            ],

            // Sea
            [
                'key' => 'our_story_sea_title',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Denizin Bereketi',
                    'en' => 'Bounty of the Sea'
                ],
            ],
            [
                'key' => 'our_story_sea_content',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Göz alabildiğine uzanan turkuaz sular, Pruva mutfağının her gün tazelenen ilham kaynağıdır. Çukurbağ Yarımadası\'nın kıyılarından soframıza uzanan bu yolculukta, sadece en taze malzemeleri seçiyoruz. Sabahın ilk ışıklarıyla ağlarını çeken yerel balıkçıların bereketi, ızgaralarımızda ve mezelerimizde hayat bulur. Levrekten çipuraya, kalamardan ahtapota kadar her deniz ürünü, denizin o kendine has tuzlu kokusunu ve tazeliğini koruyacak şekilde özenle hazırlanır. Bizim için her tabak, Akdeniz’in cömertliğini anlatan bir sahnedir.',
                    'en' => 'Turquoise waters, stretching as far as the eye can see, are the inspiration for the Pruva kitchen that is refreshed every day. In this journey from the shores of the Çukurbağ Peninsula to our table, we choose only the freshest ingredients. The bounty of local fishermen pulling their nets with the first light of morning comes to life in our grills and mezzes. From seabass to seabream, calamari to octopus, every seafood item is carefully prepared to preserve that unique salty scent and freshness of the sea. For us, every plate is a stage telling the story of Mediterranean generosity.'
                ],
            ],
            [
                'key' => 'our_story_sea_image',
                'type' => 'image',
                'group' => 'our_story',
                'value' => 'gallery/029A5151.jpg',
            ],

            // Flame
            [
                'key' => 'our_story_flame_title',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Ateşin Dansı',
                    'en' => 'Dance of the Flame'
                ],
            ],
            [
                'key' => 'our_story_flame_content',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Mutfağımızın merkezinde, lezzetlerin mühürlendiği ve geleneksel dokunuşların modern tekniklerle buluştuğu odun ateşimiz yanar. Bir \'Modern Meyhane\' konseptiyle, geçmişin o samimi atmosferini günümüzün estetik anlayışıyla harmanladık. Etlerimizin ve mevsim sebzelerinin kömür ateşindeki o isli kokusu, Pruva deneyiminin ayrılmaz bir parçasıdır. Geleneksel Anadolu reçetelerini, Akdeniz\'in hafifliği ve ferahlığıyla yeniden yorumlayarak, misafirlerimize hem tanıdık hem de şaşırtıcı lezzet kombinasyonları sunuyoruz. Her lokma, emeğin ve tutkunun bir yansımasıdır.',
                    'en' => 'At the center of our kitchen burns the wood fire where flavors are sealed and traditional touches meet modern techniques. With a \'Modern Meyhane\' concept, we have blended that intimate atmosphere of the past with today\'s aesthetic understanding. That smoky scent of our meats and seasonal vegetables on the charcoal fire is an inseparable part of the Pruva experience. By reinterpreting traditional Anatolian recipes with the lightness and freshness of the Mediterranean, we offer our guests flavor combinations that are both familiar and surprising. Every bite is a reflection of labor and passion.'
                ],
            ],
            [
                'key' => 'our_story_flame_image',
                'type' => 'image',
                'group' => 'our_story',
                'value' => 'gallery/029A0982.jpg',
            ],

            // Gathering
            [
                'key' => 'our_story_gathering_title',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Sofranın Ruhu',
                    'en' => 'The Soul of the Table'
                ],
            ],
            [
                'key' => 'our_story_gathering_content',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Kaş\'ın büyüleyici gün batımı eşliğinde kurulan sofralar, bizim için paylaşmanın ve dostluğun en saf halidir. Çukurbağ Yarımadası\'nın o eşsiz manzarasına karşı, rüzgarın taşıdığı zeytin kokuları arasında kadehlerin dostluğa kalktığı her an kıymetlidir. Pruva\'da sadece yemek servis etmiyoruz; aynı zamanda unutulmaz anılar inşa ediyoruz. Güler yüzlü ekibimiz, her misafirimizin kendini evinde hissetmesini sağlamak için büyük bir tutkuyla çalışır. Müziğin yumuşak ritmi, dalgaların sesi ve sevdiklerinizle paylaştığınız o eşsiz sohbetler, Pruva\'yı Kaş\'ın kalbinde özel bir kaçış noktası yapar.',
                    'en' => 'Tables set accompanied by the mesmerizing sunset of Kaş are, for us, the purest form of sharing and friendship. Set against that unique view of the Çukurbağ Peninsula, among the scents of olives carried by the wind, every moment when glasses are raised to friendship is precious. At Pruva, we don\'t just serve food; we also build unforgettable memories. Our smiling team works with great passion to ensure every guest feels at home. The soft rhythm of music, the sound of waves, and those unique conversations shared with loved ones make Pruva a special escape point in the heart of Kaş.'
                ],
            ],
            [
                'key' => 'our_story_gathering_image',
                'type' => 'image',
                'group' => 'our_story',
                'value' => 'gallery/029A5379.jpg',
            ],

            // Conclusion
            [
                'key' => 'our_story_conclusion_title',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Geleceğe Miras',
                    'en' => 'Legacy for the Future'
                ],
            ],
            [
                'key' => 'our_story_conclusion_content',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Pruva, her geçen gün büyüyen ve gelişen bir aile; ancak özündeki saflığı ve yerelliği asla kaybetmeyecek bir sözdür. Bizler, bu toprakların hikayesini tabaklarımızda anlatmaya, her gün aynı heyecanla mutfağımıza girmeye ve Akdeniz\'in ruhunu her bir misafirimize hissettirmeye devam edeceğiz. Bu hikayenin bir parçası olduğunuz için teşekkür ederiz. Sizi, bu kıyı masalının yeni sayfalarını birlikte yazmaya, zeytin ağaçlarının gölgesinde bir lezzet şölenine davet ediyoruz.',
                    'en' => 'Pruva is a family growing and developing every day; but it is a promise that will never lose its purity and locality at its core. We will continue to tell the story of this land on our plates, to enter our kitchen with the same excitement every day, and to make every guest feel the spirit of the Mediterranean. Thank you for being a part of this story. We invite you to a feast of flavor in the shadow of the olive trees, to write the new pages of this coastal tale together.'
                ],
            ],
            [
                'key' => 'our_story_discover_menu_text',
                'type' => 'text',
                'group' => 'our_story',
                'value' => [
                    'tr' => 'Menüyü Keşfet',
                    'en' => 'Discover Menu'
                ],
            ],
            [
                'key' => 'our_story_meta_title',
                'type' => 'text',
                'group' => 'seo',
                'value' => [
                    'tr' => 'Bir Akdeniz Masalı: Pruva\'nın Hikayesi | Pruva Restaurant Kaş',
                    'en' => 'A Mediterranean Tale: The Pruva Story | Pruva Restaurant Kaş'
                ],
            ],
            [
                'key' => 'our_story_meta_description',
                'type' => 'text',
                'group' => 'seo',
                'value' => [
                    'tr' => 'Denizin, toprağın ve ateşin kalbinden gelen bir lezzet yolculuğu.',
                    'en' => 'A journey of flavor from the heart of the sea, the land, and the flame.'
                ],
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
