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
        // Customers (harus pertama sebelum services karena FK)
        $customers = [
            ['customer_id'=>'CUST-001','full_name'=>'Budi Santoso','email'=>'budi@rt01.net','phone'=>'081234567890','address'=>'Jl. Merdeka No.1, RT01 RW05','id_number'=>'1234567890123456','status'=>'ACTIVE'],
            ['customer_id'=>'CUST-002','full_name'=>'Ani Wulandari','email'=>'ani@rt02.net','phone'=>'082345678901','address'=>'Jl. Sudirman No.5, RT02 RW03','id_number'=>'9876543210987654','status'=>'ACTIVE'],
            ['customer_id'=>'CUST-003','full_name'=>'Dedi Kurniawan','email'=>'dedi@rumah.net','phone'=>'083456789012','address'=>'Jl. Pancasila No.10, RT01 RW02','id_number'=>'1112223334445556','status'=>'SUSPENDED'],
        ];
        foreach ($customers as $c) {
            Customer::create($c);
        }

        // Services (sesuai schema DB rt_rw_net)
        $services = [
            ['service_id'=>'SVC-001','customer_id'=>1,'package_id'=>1,'status'=>'ACTIVE','install_date'=>'2026-08-01','activation_date'=>'2026-08-01','pppoe_username'=>'budi_pppoe','pppoe_password'=>'secret123','vlan_id'=>101,'assigned_ip'=>'192.168.1.10'],
            ['service_id'=>'SVC-002','customer_id'=>2,'package_id'=>2,'status'=>'ACTIVE','install_date'=>'2026-08-05','activation_date'=>'2026-08-05','pppoe_username'=>'ani_pppoe','pppoe_password'=>'secret456','vlan_id'=>102,'assigned_ip'=>'192.168.1.11'],
        ];
        foreach ($services as $s) {
            Service::create($s);
        }

        // Tickets (sesuai schema DB)
        $tickets = [
            ['ticket_id'=>'TKT-001','customer_id'=>1,'category'=>'TECHNICAL','priority'=>'P1','status'=>'OPEN','description'=>'Koneksi internet sering terputus sejak pagi','resolution_notes'=>''],
            ['ticket_id'=>'TKT-002','customer_id'=>2,'category'=>'BILLING','priority'=>'P3','status'=>'IN_PROGRESS','description'=>'Tagihan bulan ini belum masuk ke aplikasi','resolution_notes'=>''],
            ['ticket_id'=>'TKT-003','customer_id'=>3,'category'=>'TECHNICAL','priority'=>'P2','status'=>'RESOLVED','description'=>'Kabel internet putus di depan rumah','resolution_notes'=>'Sudah diperbaiki'],
        ];
        foreach ($tickets as $t) {
            Ticket::create($t);
        }
    }
}
