<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['code_saham' => 'AALI', 'name_saham' => 'Astra Agro Lestari Tbk.'],
            ['code_saham' => 'ACES', 'name_saham' => 'Ace Hardware Indonesia Tbk'],
            ['code_saham' => 'ADHI', 'name_saham' => 'Adhi Karya (Persero) Tbk.'],
            ['code_saham' => 'ADRO', 'name_saham' => 'Adaro Energy Tbk.'],
            ['code_saham' => 'AGII', 'name_saham' => 'Aneka Gas Industri Tbk'],
            ['code_saham' => 'AKRA', 'name_saham' => 'AKR Corporindo Tbk.'],
            ['code_saham' => 'ANTM', 'name_saham' => 'Aneka Tambang Tbk.'],
            ['code_saham' => 'APLN', 'name_saham' => 'Agung Podomoro Land Tbk.'],
            ['code_saham' => 'ASRI', 'name_saham' => 'Alam Sutera Realty Tbk.'],
            ['code_saham' => 'BANK', 'name_saham' => 'Bank Aladin Syariah Tbk.'],
            ['code_saham' => 'BEST', 'name_saham' => 'Bekasi Fajar Industrial Estate Tbk.'],
            ['code_saham' => 'BIRD', 'name_saham' => 'Blue Bird Tbk'],
            ['code_saham' => 'BMTR', 'name_saham' => 'Global Mediacom Tbk.'],
            ['code_saham' => 'BRIS', 'name_saham' => 'Bank BRIsyariah Tbk.'],
            ['code_saham' => 'BRPT', 'name_saham' => 'Barito Pacific Tbk.'],
            ['code_saham' => 'BSDE', 'name_saham' => 'Bumi Serpong Damai Tbk.'],
            ['code_saham' => 'BTPS', 'name_saham' => 'Bank BTPN Syariah Tbk.'],
            ['code_saham' => 'CLEO', 'name_saham' => 'Sariguna Primatirta Tbk'],
            ['code_saham' => 'CPIN', 'name_saham' => 'Charoen Pokphand Indonesia Tbk.'],
            ['code_saham' => 'CTRA', 'name_saham' => 'Ciputra Development Tbk.'],
            ['code_saham' => 'DMAS', 'name_saham' => 'Puradelta Lestari Tbk.'],
            ['code_saham' => 'ELSA', 'name_saham' => 'Elnusa Tbk.'],
            ['code_saham' => 'EMTK', 'name_saham' => 'Elang Mahkota Teknologi Tbk.'],
            ['code_saham' => 'ERAA', 'name_saham' => 'Erajaya Swasembada Tbk.'],
            ['code_saham' => 'EXCL', 'name_saham' => 'XL Axiata Tbk.'],
            ['code_saham' => 'FILM', 'name_saham' => 'MD Pictures Tbk.'],
            ['code_saham' => 'GJTL', 'name_saham' => 'Gajah Tunggal Tbk.'],
            ['code_saham' => 'HEAL', 'name_saham' => 'Medikaloka Hermina Tbk.'],
            ['code_saham' => 'HOKI', 'name_saham' => 'Buyung Poetra Sembada Tbk.'],
            ['code_saham' => 'HRUM', 'name_saham' => 'Harum Energy Tbk'],
            ['code_saham' => 'ICBP', 'name_saham' => 'Indofood CBP Sukses Makmur Tbk.'],
            ['code_saham' => 'INAF', 'name_saham' => 'Indofarma Tbk.'],
            ['code_saham' => 'INCO', 'name_saham' => 'Vale Indonesia Tbk.'],
            ['code_saham' => 'INDF', 'name_saham' => 'Indofood Sukses Makmur Tbk.'],
            ['code_saham' => 'INKP', 'name_saham' => 'Indah Kiat Pulp & Paper Tbk.'],
            ['code_saham' => 'INTP', 'name_saham' => 'Indocement Tunggal Prakarsa Tbk.'],
            ['code_saham' => 'IPTV', 'name_saham' => 'MNC Vision Networks Tbk.'],
            ['code_saham' => 'IRRA', 'name_saham' => 'Itama Ranoraya Tbk.'],
            ['code_saham' => 'ISAT', 'name_saham' => 'Indosat Tbk.'],
            ['code_saham' => 'ITMG', 'name_saham' => 'Indo Tambangraya Megah Tbk'],
            ['code_saham' => 'JPFA', 'name_saham' => 'Japfa Comfeed Indonesia Tbk.'],
            ['code_saham' => 'JRPT', 'name_saham' => 'Jaya Real Property Tbk.'],
            ['code_saham' => 'KAEF', 'name_saham' => 'Kimia Farma Tbk.'],
            ['code_saham' => 'KINO', 'name_saham' => 'Kino Indonesia Tbk'],
            ['code_saham' => 'KLBF', 'name_saham' => 'Kalbe Farma Tbk.'],
            ['code_saham' => 'KPIG', 'name_saham' => 'MNC Land Tbk.'],
            ['code_saham' => 'LINK', 'name_saham' => 'Link Net Tbk.'],
            ['code_saham' => 'LPKR', 'name_saham' => 'Lippo Karawaci Tbk.'],
            ['code_saham' => 'LPPF', 'name_saham' => 'Matahari Department Store Tbk'],
            ['code_saham' => 'LSIP', 'name_saham' => 'PP London Sumatra Indonesia Tbk.'],
            ['code_saham' => 'MAPI', 'name_saham' => 'Mitra Adiperkasa Tbk'],
            ['code_saham' => 'MDKA', 'name_saham' => 'Merdeka Copper Gold Tbk.'],
            ['code_saham' => 'MIKA', 'name_saham' => 'Mitra Keluarga Karyasehat Tbk.'],
            ['code_saham' => 'MLPL', 'name_saham' => 'Multipolar Tbk.'],
            ['code_saham' => 'MNCN', 'name_saham' => 'Media Nusantara Citra Tbk.'],
            ['code_saham' => 'MPMX', 'name_saham' => 'Mitra Pinasthika Mustika Tbk.'],
            ['code_saham' => 'MTDL', 'name_saham' => 'Metrodata Electronics Tbk'],
            ['code_saham' => 'MYOR', 'name_saham' => 'Mayora Indah Tbk.'],
            ['code_saham' => 'PGAS', 'name_saham' => 'Perusahaan Gas Negara Tbk.'],
            ['code_saham' => 'POWR', 'name_saham' => 'Cikarang Listrindo Tbk.'],
            ['code_saham' => 'PTBA', 'name_saham' => 'Bukit Asam Tbk.'],
            ['code_saham' => 'PTPP', 'name_saham' => 'PP (Persero) Tbk.'],
            ['code_saham' => 'PWON', 'name_saham' => 'Pakuwon Jati Tbk.'],
            ['code_saham' => 'RAJA', 'name_saham' => 'Rukun Raharja Tbk.'],
            ['code_saham' => 'RALS', 'name_saham' => 'Ramayana Lestari Sentosa Tbk'],
            ['code_saham' => 'ROTI', 'name_saham' => 'Nippon Indosari Corpindo Tbk'],
            ['code_saham' => 'SCMA', 'name_saham' => 'Surya Citra Media Tbk.'],
            ['code_saham' => 'SIDO', 'name_saham' => 'Industri Jamu dan Farmasi Sido Muncul Tbk'],
            ['code_saham' => 'SILO', 'name_saham' => 'Siloam International Hospitals Tbk.'],
            ['code_saham' => 'SIMP', 'name_saham' => 'Salim Ivomas Pratama Tbk.'],
            ['code_saham' => 'SMBR', 'name_saham' => 'Semen Baturaja (Persero) Tbk.'],
            ['code_saham' => 'SMGR', 'name_saham' => 'Semen Indonesia (Persero) Tbk.'],
            ['code_saham' => 'SMRA', 'name_saham' => 'Summarecon Agung Tbk'],
            ['code_saham' => 'SMSM', 'name_saham' => 'Selamat Sempurna Tbk.'],
            ['code_saham' => 'SSIA', 'name_saham' => 'Surya Semesta Internusa Tbk.'],
            ['code_saham' => 'TAPG', 'name_saham' => 'Triputra Agro Persada Tbk.'],
            ['code_saham' => 'TINS', 'name_saham' => 'Timah Tbk.'],
            ['code_saham' => 'TKIM', 'name_saham' => 'Pabrik Kertas Tjiwi Kimia Tbk.'],
            ['code_saham' => 'TLKM', 'name_saham' => 'Telekomunikasi Indonesia (Persero) Tbk.'],
            ['code_saham' => 'TPIA', 'name_saham' => 'Chandra Asri Petrochemical Tbk.'],
            ['code_saham' => 'UCID', 'name_saham' => 'Uni-Charm Indonesia Tbk'],
            ['code_saham' => 'ULTJ', 'name_saham' => 'Ultra Jaya Milk Industry & Trading Company Tbk.'],
            ['code_saham' => 'UNTR', 'name_saham' => 'United Tractors Tbk.'],
            ['code_saham' => 'UNVR', 'name_saham' => 'Unilever Indonesia Tbk.'],
            ['code_saham' => 'WEGE', 'name_saham' => 'Wijaya Karya Bangunan Gedung Tbk'],
            ['code_saham' => 'WIKA', 'name_saham' => 'Wijaya Karya (Persero) Tbk.'],
            ['code_saham' => 'WMUU', 'name_saham' => 'Widodo Makmur Unggas Tbk'],
            ['code_saham' => 'WOOD', 'name_saham' => 'Integra Indocabinet Tbk.'],
            ['code_saham' => 'WTON', 'name_saham' => 'Wijaya Karya Beton Tbk.'],
        ];

        foreach ($data as $key => $item) {
            Alternatif::create([
                'code' => $key + 1,
                'code_saham' => $item['code_saham'],
                'name_saham' => $item['name_saham'],
            ]);
        }
    }
}
