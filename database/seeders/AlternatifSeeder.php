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
            ['kode_database' => 'AALI'],
            ['kode_database' => 'ACES'],
            ['kode_database' => 'ADHI'],
            ['kode_database' => 'ADRO'],
            ['kode_database' => 'AGII'],
            ['kode_database' => 'AKRA'],
            ['kode_database' => 'ANTM'],
            ['kode_database' => 'APLN'],
            ['kode_database' => 'ASRI'],
            ['kode_database' => 'BANK'],
            ['kode_database' => 'BEST'],
            ['kode_database' => 'BIRD'],
            ['kode_database' => 'BMTR'],
            ['kode_database' => 'BRIS'],
            ['kode_database' => 'BRPT'],
            ['kode_database' => 'BSDE'],
            ['kode_database' => 'BTPS'],
            ['kode_database' => 'CLEO'],
            ['kode_database' => 'CPIN'],
            ['kode_database' => 'CTRA'],
            ['kode_database' => 'DMAS'],
            ['kode_database' => 'ELSA'],
            ['kode_database' => 'EMTK'],
            ['kode_database' => 'ERAA'],
            ['kode_database' => 'EXCL'],
            ['kode_database' => 'FILM'],
            ['kode_database' => 'GJTL'],
            ['kode_database' => 'HEAL'],
            ['kode_database' => 'HOKI'],
            ['kode_database' => 'HRUM'],
            ['kode_database' => 'ICBP'],
            ['kode_database' => 'INAF'],
            ['kode_database' => 'INCO'],
            ['kode_database' => 'INDF'],
            ['kode_database' => 'INKP'],
            ['kode_database' => 'INTP'],
            ['kode_database' => 'IPTV'],
            ['kode_database' => 'IRRA'],
            ['kode_database' => 'ISAT'],
            ['kode_database' => 'ITMG'],
            ['kode_database' => 'JPFA'],
            ['kode_database' => 'JRPT'],
            ['kode_database' => 'KAEF'],
            ['kode_database' => 'KINO'],
            ['kode_database' => 'KLBF'],
            ['kode_database' => 'KPIG'],
            ['kode_database' => 'LINK'],
            ['kode_database' => 'LPKR'],
            ['kode_database' => 'LPPF'],
            ['kode_database' => 'LSIP'],
            ['kode_database' => 'MAPI'],
            ['kode_database' => 'MDKA'],
            ['kode_database' => 'MIKA'],
            ['kode_database' => 'MLPL'], 
            ['kode_database' => 'MNCN'],
            ['kode_database' => 'MPMX'],
            ['kode_database' => 'MTDL'],
            ['kode_database' => 'MYOR'],
            ['kode_database' => 'PGAS'],
            ['kode_database' => 'POWR'],
            ['kode_database' => 'PTBA'], 
            ['kode_database' => 'PTPP'],
            ['kode_database' => 'PWON'],
            ['kode_database' => 'RAJA'],
            ['kode_database' => 'RALS'],
            ['kode_database' => 'ROTI'],
            ['kode_database' => 'SCMA'],
            ['kode_database' => 'SIDO'],
            ['kode_database' => 'SILO'],
            ['kode_database' => 'SIMP'],
            ['kode_database' => 'SMBR'],
            ['kode_database' => 'SMGR'],
            ['kode_database' => 'SMRA'],
            ['kode_database' => 'SMSM'],
            ['kode_database' => 'SSIA'],
            ['kode_database' => 'TAPG'],
            ['kode_database' => 'TINS'],
            ['kode_database' => 'TKIM'],
            ['kode_database' => 'TLKM'],
            ['kode_database' => 'TPIA'],
            ['kode_database' => 'UCID'],
            ['kode_database' => 'ULTJ'],
            ['kode_database' => 'UNTR'],
            ['kode_database' => 'UNVR'],
            ['kode_database' => 'WEGE'],
            ['kode_database' => 'WIKA'],
            ['kode_database' => 'WMUU'],
            ['kode_database' => 'WOOD'],
            ['kode_database' => 'WTON'],
        ];

        foreach ($data as $key => $item) {
            Alternatif::create([
                'code' => $key + 1,
                'kode_database' => $item['kode_database'],
            ]);
        }
    }
}
