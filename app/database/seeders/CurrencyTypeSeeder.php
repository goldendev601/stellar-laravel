<?php

namespace Database\Seeders;

use App\ModelsExtended\CurrencyType;
use Illuminate\Database\Seeder;

class CurrencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       self::createOrUpdate();
    }

    public static function createOrUpdate()
    {
        CurrencyType::upsert(
            [
                ["id" => CurrencyType::AED, "description" => "AED"],
                ["id" => CurrencyType::AFN, "description" => "AFN"],
                ["id" => CurrencyType::ALL, "description" => "ALL"],
                ["id" => CurrencyType::AMD, "description" => "AMD"],
                ["id" => CurrencyType::ANG, "description" => "ANG"],
                ["id" => CurrencyType::AOA, "description" => "AOA"],
                ["id" => CurrencyType::ARS, "description" => "ARS"],
                ["id" => CurrencyType::AUD, "description" => "AUD"],
                ["id" => CurrencyType::AWG, "description" => "AWG"],
                ["id" => CurrencyType::AZN, "description" => "AZN"],
                ["id" => CurrencyType::BAM, "description" => "BAM"],
                ["id" => CurrencyType::BBD, "description" => "BBD"],
                ["id" => CurrencyType::BDT, "description" => "BDT"],
                ["id" => CurrencyType::BGN, "description" => "BGN"],
                ["id" => CurrencyType::BHD, "description" => "BHD"],
                ["id" => CurrencyType::BIF, "description" => "BIF"],
                ["id" => CurrencyType::BMD, "description" => "BMD"],
                ["id" => CurrencyType::BND, "description" => "BND"],
                ["id" => CurrencyType::BOB, "description" => "BOB"],
                ["id" => CurrencyType::BRL, "description" => "BRL"],
                ["id" => CurrencyType::BSD, "description" => "BSD"],
                ["id" => CurrencyType::BTN, "description" => "BTN"],
                ["id" => CurrencyType::BWP, "description" => "BWP"],
                ["id" => CurrencyType::BYR, "description" => "BYR"],
                ["id" => CurrencyType::BZD, "description" => "BZD"],
                ["id" => CurrencyType::CAD, "description" => "CAD"],
                ["id" => CurrencyType::CDF, "description" => "CDF"],
                ["id" => CurrencyType::CHF, "description" => "CHF"],
                ["id" => CurrencyType::CLF, "description" => "CLF"],
                ["id" => CurrencyType::CLP, "description" => "CLP"],
                ["id" => CurrencyType::CNY, "description" => "CNY"],
                ["id" => CurrencyType::COP, "description" => "COP"],
                ["id" => CurrencyType::CRC, "description" => "CRC"],
                ["id" => CurrencyType::CUP, "description" => "CUP"],
                ["id" => CurrencyType::CVE, "description" => "CVE"],
                ["id" => CurrencyType::CZK, "description" => "CZK"],
                ["id" => CurrencyType::DJF, "description" => "DJF"],
                ["id" => CurrencyType::DKK, "description" => "DKK"],
                ["id" => CurrencyType::DOP, "description" => "DOP"],
                ["id" => CurrencyType::DZD, "description" => "DZD"],
                ["id" => CurrencyType::EGP, "description" => "EGP"],
                ["id" => CurrencyType::ETB, "description" => "ETB"],
                ["id" => CurrencyType::EUR, "description" => "EUR"],
                ["id" => CurrencyType::FJD, "description" => "FJD"],
                ["id" => CurrencyType::FKP, "description" => "FKP"],
                ["id" => CurrencyType::GBP, "description" => "GBP"],
                ["id" => CurrencyType::GEL, "description" => "GEL"],
                ["id" => CurrencyType::GHS, "description" => "GHS"],
                ["id" => CurrencyType::GIP, "description" => "GIP"],
                ["id" => CurrencyType::GMD, "description" => "GMD"],
                ["id" => CurrencyType::GNF, "description" => "GNF"],
                ["id" => CurrencyType::GTQ, "description" => "GTQ"],
                ["id" => CurrencyType::GYD, "description" => "GYD"],
                ["id" => CurrencyType::HKD, "description" => "HKD"],
                ["id" => CurrencyType::HNL, "description" => "HNL"],
                ["id" => CurrencyType::HRK, "description" => "HRK"],
                ["id" => CurrencyType::HTG, "description" => "HTG"],
                ["id" => CurrencyType::HUF, "description" => "HUF"],
                ["id" => CurrencyType::IDR, "description" => "IDR"],
                ["id" => CurrencyType::ILS, "description" => "ILS"],
                ["id" => CurrencyType::INR, "description" => "INR"],
                ["id" => CurrencyType::IQD, "description" => "IQD"],
                ["id" => CurrencyType::IRR, "description" => "IRR"],
                ["id" => CurrencyType::ISK, "description" => "ISK"],
                ["id" => CurrencyType::JEP, "description" => "JEP"],
                ["id" => CurrencyType::JMD, "description" => "JMD"],
                ["id" => CurrencyType::JOD, "description" => "JOD"],
                ["id" => CurrencyType::JPY, "description" => "JPY"],
                ["id" => CurrencyType::KES, "description" => "KES"],
                ["id" => CurrencyType::KGS, "description" => "KGS"],
                ["id" => CurrencyType::KHR, "description" => "KHR"],
                ["id" => CurrencyType::KMF, "description" => "KMF"],
                ["id" => CurrencyType::KPW, "description" => "KPW"],
                ["id" => CurrencyType::KRW, "description" => "KRW"],
                ["id" => CurrencyType::KWD, "description" => "KWD"],
                ["id" => CurrencyType::KYD, "description" => "KYD"],
                ["id" => CurrencyType::KZT, "description" => "KZT"],
                ["id" => CurrencyType::LAK, "description" => "LAK"],
                ["id" => CurrencyType::LBP, "description" => "LBP"],
                ["id" => CurrencyType::LKR, "description" => "LKR"],
                ["id" => CurrencyType::LRD, "description" => "LRD"],
                ["id" => CurrencyType::LSL, "description" => "LSL"],
                ["id" => CurrencyType::LTL, "description" => "LTL"],
                ["id" => CurrencyType::LVL, "description" => "LVL"],
                ["id" => CurrencyType::LYD, "description" => "LYD"],
                ["id" => CurrencyType::MAD, "description" => "MAD"],
                ["id" => CurrencyType::MDL, "description" => "MDL"],
                ["id" => CurrencyType::MGA, "description" => "MGA"],
                ["id" => CurrencyType::MKD, "description" => "MKD"],
                ["id" => CurrencyType::MMK, "description" => "MMK"],
                ["id" => CurrencyType::MNT, "description" => "MNT"],
                ["id" => CurrencyType::MOP, "description" => "MOP"],
                ["id" => CurrencyType::MRO, "description" => "MRO"],
                ["id" => CurrencyType::MUR, "description" => "MUR"],
                ["id" => CurrencyType::MVR, "description" => "MVR"],
                ["id" => CurrencyType::MWK, "description" => "MWK"],
                ["id" => CurrencyType::MXN, "description" => "MXN"],
                ["id" => CurrencyType::MYR, "description" => "MYR"],
                ["id" => CurrencyType::MZN, "description" => "MZN"],
                ["id" => CurrencyType::NAD, "description" => "NAD"],
                ["id" => CurrencyType::NGN, "description" => "NGN"],
                ["id" => CurrencyType::NIO, "description" => "NIO"],
                ["id" => CurrencyType::NOK, "description" => "NOK"],
                ["id" => CurrencyType::NPR, "description" => "NPR"],
                ["id" => CurrencyType::NZD, "description" => "NZD"],
                ["id" => CurrencyType::OMR, "description" => "OMR"],
                ["id" => CurrencyType::PAB, "description" => "PAB"],
                ["id" => CurrencyType::PEN, "description" => "PEN"],
                ["id" => CurrencyType::PGK, "description" => "PGK"],
                ["id" => CurrencyType::PHP, "description" => "PHP"],
                ["id" => CurrencyType::PKR, "description" => "PKR"],
                ["id" => CurrencyType::PLN, "description" => "PLN"],
                ["id" => CurrencyType::PYG, "description" => "PYG"],
                ["id" => CurrencyType::QAR, "description" => "QAR"],
                ["id" => CurrencyType::RON, "description" => "RON"],
                ["id" => CurrencyType::RSD, "description" => "RSD"],
                ["id" => CurrencyType::RUB, "description" => "RUB"],
                ["id" => CurrencyType::RWF, "description" => "RWF"],
                ["id" => CurrencyType::SAR, "description" => "SAR"],
                ["id" => CurrencyType::SBD, "description" => "SBD"],
                ["id" => CurrencyType::SCR, "description" => "SCR"],
                ["id" => CurrencyType::SDG, "description" => "SDG"],
                ["id" => CurrencyType::SEK, "description" => "SEK"],
                ["id" => CurrencyType::SGD, "description" => "SGD"],
                ["id" => CurrencyType::SHP, "description" => "SHP"],
                ["id" => CurrencyType::SLL, "description" => "SLL"],
                ["id" => CurrencyType::SOS, "description" => "SOS"],
                ["id" => CurrencyType::SRD, "description" => "SRD"],
                ["id" => CurrencyType::STD, "description" => "STD"],
                ["id" => CurrencyType::SVC, "description" => "SVC"],
                ["id" => CurrencyType::SYP, "description" => "SYP"],
                ["id" => CurrencyType::SZL, "description" => "SZL"],
                ["id" => CurrencyType::THB, "description" => "THB"],
                ["id" => CurrencyType::TJS, "description" => "TJS"],
                ["id" => CurrencyType::TMT, "description" => "TMT"],
                ["id" => CurrencyType::TND, "description" => "TND"],
                ["id" => CurrencyType::TOP, "description" => "TOP"],
                ["id" => CurrencyType::TRY, "description" => "TRY"],
                ["id" => CurrencyType::TTD, "description" => "TTD"],
                ["id" => CurrencyType::TWD, "description" => "TWD"],
                ["id" => CurrencyType::TZS, "description" => "TZS"],
                ["id" => CurrencyType::UAH, "description" => "UAH"],
                ["id" => CurrencyType::UGX, "description" => "UGX"],
                ["id" => CurrencyType::USD, "description" => "USD"],
                ["id" => CurrencyType::UYU, "description" => "UYU"],
                ["id" => CurrencyType::UZS, "description" => "UZS"],
                ["id" => CurrencyType::VEF, "description" => "VEF"],
                ["id" => CurrencyType::VND, "description" => "VND"],
                ["id" => CurrencyType::VUV, "description" => "VUV"],
                ["id" => CurrencyType::WST, "description" => "WST"],
                ["id" => CurrencyType::XAF, "description" => "XAF"],
                ["id" => CurrencyType::XCD, "description" => "XCD"],
                ["id" => CurrencyType::XDR, "description" => "XDR"],
                ["id" => CurrencyType::XOF, "description" => "XOF"],
                ["id" => CurrencyType::XPF, "description" => "XPF"],
                ["id" => CurrencyType::YER, "description" => "YER"],
                ["id" => CurrencyType::ZAR, "description" => "ZAR"],
                ["id" => CurrencyType::ZMK, "description" => "ZMK"],
                ["id" => CurrencyType::ZWL, "description" => "ZWL"],
            ],
            [
                "id"
            ]
        );
    }
}
