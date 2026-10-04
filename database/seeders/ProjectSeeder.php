<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Data proyek contoh — idempoten (slug dipakai sebagai acuan).
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Web Peta Sebaran & Coverage FTTH',
                'description' => "Platform pemetaan sebaran jaringan FTTH berbasis web yang menampilkan titik distribusi (ODP), area coverage, dan status port pelanggan secara real-time.\n\nDibangun untuk membantu tim Sales & PSB memvalidasi ketersediaan layanan di alamat calon pelanggan tanpa harus cek manual ke perangkat ODP di lapangan.",
                'tech_stack' => ['Laravel', 'MySQL', 'Leaflet.js', 'Tailwind CSS'],
                'github_url' => null,
                'demo_url' => null,
                'is_featured' => true,
            ],
            [
                'title' => 'Otomasi Provisioning ONU ZTE C300',
                'description' => "Tool otomasi provisioning ONU pada OLT ZTE C300 via akses CLI Telnet/SSH menggunakan Python dan Paramiko.\n\nMengubah alur aktivasi pelanggan yang sebelumnya manual (login OLT, create onu, profile, vlan, dll.) menjadi satu perintah — memangkas waktu provisioning dari menit menjadi hitungan detik dan mengurangi human error.",
                'tech_stack' => ['Python', 'Paramiko', 'ZTE C300', 'GPON/EPON'],
                'github_url' => null,
                'demo_url' => null,
                'is_featured' => true,
            ],
            [
                'title' => 'Monitoring Infrastruktur NOC',
                'description' => 'Dashboard internal monitoring perangkat jaringan dan server: status uptime router MikroTik, beban OLT, hingga kapasitas VM di Proxmox VE, lengkap dengan notifikasi saat terjadi anomali.',
                'tech_stack' => ['Proxmox VE', 'MikroTik', 'Debian', 'Python'],
                'github_url' => null,
                'demo_url' => null,
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $data) {
            Project::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($data['title'])],
                $data,
            );
        }
    }
}
