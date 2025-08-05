<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partnership;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partnerships = [
            // Bank Nasional
            [
                'name' => 'Bank Mandiri',
                'slug' => 'bank-mandiri',
                'description' => 'Bank Mandiri - Layanan perbankan nasional terpercaya',
                'website_url' => 'https://www.bankmandiri.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/512px-Bank_Mandiri_logo_2016.svg.png',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Bank BNI',
                'slug' => 'bank-bni',
                'description' => 'Bank Negara Indonesia - Bank BUMN terpercaya',
                'website_url' => 'https://www.bni.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/512px-BNI_logo.svg.png',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Bank BRI',
                'slug' => 'bank-bri',
                'description' => 'Bank Rakyat Indonesia - Melayani seluruh Indonesia',
                'website_url' => 'https://www.bri.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/BRI_Logo.svg/512px-BRI_Logo.svg.png',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Bank BCA',
                'slug' => 'bank-bca',
                'description' => 'Bank Central Asia - Solusi perbankan modern',
                'website_url' => 'https://www.bca.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/512px-Bank_Central_Asia.svg.png',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Bank BTN',
                'slug' => 'bank-btn',
                'description' => 'Bank Tabungan Negara - Spesialis KPR',
                'website_url' => 'https://www.btn.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Bank_BTN_logo.svg/512px-Bank_BTN_logo.svg.png',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Bank CIMB Niaga',
                'slug' => 'bank-cimb-niaga',
                'description' => 'Bank CIMB Niaga - Forward Banking',
                'website_url' => 'https://www.cimbniaga.co.id',
                'logo_type' => 'upload',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Bank Syariah Indonesia',
                'slug' => 'bank-syariah-indonesia',
                'description' => 'Bank Syariah Indonesia - Perbankan syariah terdepan',
                'website_url' => 'https://www.bsi.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia_Logo.svg/512px-Bank_Syariah_Indonesia_Logo.svg.png',
                'sort_order' => 7,
                'is_active' => true,
            ],

            // Bank Regional
            [
                'name' => 'Bank Jateng',
                'slug' => 'bank-jateng',
                'description' => 'Bank Jawa Tengah - Bank pembangunan daerah Jawa Tengah',
                'website_url' => 'https://www.bankjateng.co.id',
                'logo_type' => 'upload',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Bank BPRS Buana Mitra Perwira',
                'slug' => 'bank-bprs-buana-mitra-perwira',
                'description' => 'Bank BPRS Buana Mitra Perwira - Bank syariah regional',
                'website_url' => 'https://www.bprsbmp.co.id',
                'logo_type' => 'upload',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Bank BPR BKK',
                'slug' => 'bank-bpr-bkk',
                'description' => 'Bank BPR BKK - Bank Kredit Kecamatan',
                'website_url' => 'https://www.bprbkk.co.id',
                'logo_type' => 'upload',
                'sort_order' => 10,
                'is_active' => true,
            ],

            // E-Commerce Platform
            [
                'name' => 'Shopee',
                'slug' => 'shopee',
                'description' => 'Shopee - Platform e-commerce terdepan di Indonesia',
                'website_url' => 'https://www.shopee.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/512px-Shopee.svg.png',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Tokopedia',
                'slug' => 'tokopedia',
                'description' => 'Tokopedia - Mulai aja dulu, marketplace terpercaya',
                'website_url' => 'https://www.tokopedia.com',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Tokopedia_Logo.svg/512px-Tokopedia_Logo.svg.png',
                'sort_order' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Bukalapak',
                'slug' => 'bukalapak',
                'description' => 'Bukalapak - Jual beli online mudah dan terpercaya',
                'website_url' => 'https://www.bukalapak.com',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Bukalapak_logo_2018.svg/512px-Bukalapak_logo_2018.svg.png',
                'sort_order' => 13,
                'is_active' => true,
            ],
            [
                'name' => 'Blibli',
                'slug' => 'blibli',
                'description' => 'Blibli - Big choices. Big deals.',
                'website_url' => 'https://www.blibli.com',
                'logo_type' => 'upload',
                'sort_order' => 14,
                'is_active' => true,
            ],

            // E-Wallet & Fintech
            [
                'name' => 'GoPay',
                'slug' => 'gopay',
                'description' => 'GoPay - Dompet digital untuk segala kebutuhan',
                'website_url' => 'https://www.gopay.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/512px-Gopay_logo.svg.png',
                'sort_order' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'OVO',
                'slug' => 'ovo',
                'description' => 'OVO - Uang elektronik untuk gaya hidup digital',
                'website_url' => 'https://www.ovo.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/512px-Logo_ovo_purple.svg.png',
                'sort_order' => 16,
                'is_active' => true,
            ],
            [
                'name' => 'DANA',
                'slug' => 'dana',
                'description' => 'DANA - Dompet digital untuk semua',
                'website_url' => 'https://www.dana.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/512px-Logo_dana_blue.svg.png',
                'sort_order' => 17,
                'is_active' => true,
            ],
            [
                'name' => 'LinkAja',
                'slug' => 'linkaja',
                'description' => 'LinkAja - Uang elektronik BUMN',
                'website_url' => 'https://www.linkaja.id',
                'logo_type' => 'upload',
                'sort_order' => 18,
                'is_active' => true,
            ],
            [
                'name' => 'ShopeePay',
                'slug' => 'shopeepay',
                'description' => 'ShopeePay - Bayar lebih mudah dengan ShopeePay',
                'website_url' => 'https://www.shopeepay.co.id',
                'logo_type' => 'upload',
                'sort_order' => 19,
                'is_active' => true,
            ],

            // Payment Gateway & Services
            [
                'name' => 'KIPO',
                'slug' => 'kipo',
                'description' => 'KIPO - Koperasi Indonesia Payment Online',
                'website_url' => 'https://www.kipo.co.id',
                'logo_type' => 'upload',
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'PT Pos Indonesia',
                'slug' => 'pt-pos-indonesia',
                'description' => 'PT Pos Indonesia - Layanan pos dan logistik nasional',
                'website_url' => 'https://www.posindonesia.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Pos_Indonesia_2013_logo.svg/512px-Pos_Indonesia_2013_logo.svg.png',
                'sort_order' => 21,
                'is_active' => true,
            ],
            [
                'name' => 'Alfamart',
                'slug' => 'alfamart',
                'description' => 'Alfamart - Pembayaran di minimarket terdekat',
                'website_url' => 'https://www.alfamart.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Logo_Alfamart.svg/512px-Logo_Alfamart.svg.png',
                'sort_order' => 22,
                'is_active' => true,
            ],
            [
                'name' => 'Indomaret',
                'slug' => 'indomaret',
                'description' => 'Indomaret - Mudah dan hemat setiap hari',
                'website_url' => 'https://www.indomaret.co.id',
                'logo_type' => 'url',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Logo_Indomaret.svg/512px-Logo_Indomaret.svg.png',
                'sort_order' => 23,
                'is_active' => true,
            ],
            [
                'name' => 'ATM Bersama',
                'slug' => 'atm-bersama',
                'description' => 'ATM Bersama - Jaringan ATM terlengkap di Indonesia',
                'website_url' => 'https://www.atmbersama.com',
                'logo_type' => 'upload',
                'sort_order' => 24,
                'is_active' => true,
            ],
            [
                'name' => 'ALTO',
                'slug' => 'alto',
                'description' => 'ALTO - ATM Link Terpadu Online',
                'website_url' => 'https://www.alto.id',
                'logo_type' => 'upload',
                'sort_order' => 25,
                'is_active' => true,
            ],

            // Digital Banking & Fintech
            [
                'name' => 'Jenius',
                'slug' => 'jenius',
                'description' => 'Jenius - Digital banking terdepan',
                'website_url' => 'https://www.jenius.com',
                'logo_type' => 'upload',
                'sort_order' => 26,
                'is_active' => true,
            ],
            [
                'name' => 'Digibank DBS',
                'slug' => 'digibank-dbs',
                'description' => 'Digibank DBS - Banking made simple',
                'website_url' => 'https://www.dbs.com/digibank',
                'logo_type' => 'upload',
                'sort_order' => 27,
                'is_active' => true,
            ],
            [
                'name' => 'OCBC NISP',
                'slug' => 'ocbc-nisp',
                'description' => 'Bank OCBC NISP - Terdepan, Terpercaya, Tumbuh bersama Anda',
                'website_url' => 'https://www.ocbcnisp.com',
                'logo_type' => 'upload',
                'sort_order' => 28,
                'is_active' => true,
            ],
        ];

        foreach ($partnerships as $partnership) {
            Partnership::create($partnership);
        }
    }
}
