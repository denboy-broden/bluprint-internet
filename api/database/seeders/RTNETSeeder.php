<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Ticket;

class RTNETSeeder extends Seeder
{
    public function run(): void
    {
        // Services
        $services = [
            ['name'=>'Internet 50Mbps','description'=>'Paketan internet rumah 50Mbps unlimited','price'=>150000,'duration_days'=>30,'speed_mbps'=>50,'category'=>'internet','is_active'=>true],
            ['name'=>'Internet 100Mbps','description'=>'Paketan internet rumah 100Mbps unlimited','price'=>250000,'duration_days'=>30,'speed_mbps'=>100,'category'=>'internet','is_active'=>true],
            ['name'=>'TV Cable Basic','description'=>'Paket TV kabel basic 50 saluran','price'=>120000,'duration_days'=>30,'category'=>'tv','is_active'=>true],
            ['name'=>'Maintenance Jaringan','description'=>'Perbaikan jaringan rumahan','price'=>75000,'duration_days'=>1,'category'=>'maintenance','is_active'=>true],
        ];
        foreach ($services as $s) {
            Service::create($s);
        }

        // Customers
        $customers = [
            ['name'=>'Budi Santoso','email'=>'budi@rt01.net','phone'=>'081234567890','address'=>'Jl. Merdeka No.1, RT01 RW05','identity_number'=>'1234567890123456','identity_type'=>'KTP','status'=>'active','package_id'=>1],
            ['name'=>'Ani Wulandari','email'=>'ani@rt02.net','phone'=>'082345678901','address'=>'Jl. Sudirman No.5, RT02 RW03','identity_number'=>'9876543210987654','identity_type'=>'KTP','status'=>'active','package_id'=>2],
            ['name'=>'Dedi Kurniawan','email'=>'dedi@rumah.net','phone'=>'083456789012','address'=>'Jl. Pancasila No.10, RT01 RW02','identity_number'=>'1112223334445556','identity_type'=>'SIM','status'=>'inactive','package_id'=>3],
        ];
        foreach ($customers as $c) {
            Customer::create($c);
        }

        // Tickets
        $tickets = [
            ['customer_id'=>1,'subject'=>'Internet lambat','description'=>'Koneksi internet sering terputus sejak pagi','category'=>'internet','priority'=>'high','status'=>'open'],
            ['customer_id'=>2,'subject'=>'Tagihan belum diterima','description'=>'Tagihan bulan ini belum masuk ke aplikasi','category'=>'billing','priority'=>'medium','status'=>'in_progress'],
            ['customer_id'=>3,'subject'=>'Perbaikan kabel','description'=>'Kabel internet putus di depan rumah','category'=>'maintenance','priority'=>'urgent','status'=>'resolved'],
        ];
        foreach ($tickets as $t) {
            Ticket::create($t);
        }
    }
}
