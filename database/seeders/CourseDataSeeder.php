<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Segment;
use App\Models\Fase;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;

class CourseDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // === PEMBESIHAN DATA LEVEL 1, 2, 3 ===
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Segment::truncate(); 
        Fase::truncate(); 
        Materi::truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // ======================================

        // Data Learning Path yang Anda sediakan
        $learningPaths = [
            'Software Development' => [
                'description' => 'Jalur ini mencakup fondasi pemrograman, pengembangan aplikasi web dan mobile dengan framework modern, hingga praktik DevOps dan system design.',
                'fases' => [
                    'Fase 1 — Fundamental' => [
                        'Logika pemrograman', 'Bahasa pemrograman dasar (Python/JavaScript/Java)', 'Git & GitHub', 
                        'Struktur data dasar (array, list, stack, queue)', 'Pemahaman API'
                    ],
                    'Fase 2 — Development' => [
                        'OOP (Object-Oriented Programming)', 'Database (MySQL / PostgreSQL)', 'REST API Development',
                        'Framework: Web: Laravel / Node.js / Django', 'Framework: Mobile: Flutter / React Native',
                        'Testing dasar (unit test)'
                    ],
                    'Fase 3 — Advance' => [
                        'Clean Architecture', 'Design Patterns', 'DevOps dasar (Docker, CI/CD)',
                        'Cloud deployment (AWS/GCP/Azure)', 'Scalable system design'
                    ],
                ]
            ],
            
            'Keamanan Siber' => [
                'description' => 'Fokus pada pertahanan dan serangan sistem, mulai dari dasar networking hingga analisis forensik dan operasi SOC.',
                'fases' => [
                    'Fase 1 — Dasar' => [
                        'Konsep keamanan: CIA Triad', 'Sistem operasi Linux', 'Networking basic', 
                        'Tools dasar: Wireshark, Nmap'
                    ],
                    'Fase 2 — Defensive & Offensive' => [
                        'Web vulnerability (OWASP Top 10)', 'Penetration testing dasar', 'Secure coding',
                        'Firewall dan IDS/IPS', 'Kali Linux'
                    ],
                    'Fase 3 — Profesional' => [
                        'Digital forensics', 'Threat hunting & analysis', 'SOC operations',
                        'Malware analysis', 'Defensive automation (SIEM, SOAR)'
                    ],
                ]
            ],

            'Data & AI (Data Science)' => [
                'description' => 'Membangun keahlian dalam analisis data, statistik, machine learning, dan implementasi model Deep Learning canggih.',
                'fases' => [
                    'Fase 1 — Data Fundamentals' => [
                        'Statistika dasar', 'Python untuk data (NumPy, Pandas)', 'Data visualization (Matplotlib)'
                    ],
                    'Fase 2 — Machine Learning' => [
                        'Supervised & unsupervised learning', 'Scikit-learn', 'Feature engineering', 
                        'Model evaluation (accuracy, recall, dsb.)'
                    ],
                    'Fase 3 — Deep Learning & AI Engineering' => [
                        'Neural networks (PyTorch / TensorFlow)', 'Computer Vision & NLP', 
                        'Membangun model seperti YOLO, LSTM, Transformer',
                        'MLOps: model deployment (TFLite, ONNX, FastAPI)'
                    ],
                ]
            ],
            
            'Jaringan & Infrastruktur' => [
                'description' => 'Pelajari arsitektur jaringan, administrasi server Linux, Cloud computing, hingga orkestrasi kontainer dengan Kubernetes.',
                'fases' => [
                    'Fase 1 — Basic Networking' => [
                        'Konsep IP, subnet, DNS, DHCP', 'OSI model', 'Konfigurasi router dasar (Cisco/ MikroTik)'
                    ],
                    'Fase 2 — Server & Infrastruktur' => [
                        'Linux administration', 'Web server (Nginx/Apache)', 'Virtualization (VMware, VirtualBox)',
                        'Network security fundamental'
                    ],
                    'Fase 3 — Advanced Infrastructure' => [
                        'Cloud networking (AWS/GCP/Azure)', 'Container orchestration (Docker, Kubernetes)',
                        'High availability & load balancing', 'Zero Trust Architecture'
                    ],
                ]
            ],

            'UX/UI Design' => [
                'description' => 'Fokus pada User Experience (UX), estetika antarmuka (UI), hingga pengembangan sistem desain yang sistematis.',
                'fases' => [
                    'Fase 1 — Fundamental UX' => [
                        'Dasar UX dan Human-Centered Design', 'User research', 'Persona & user journey',
                        'Wireframe low fidelity'
                    ],
                    'Fase 2 — UI Design' => [
                        'Typography, layout, color theory', 'Component system', 'Prototyping Figma', 
                        'Responsive design'
                    ],
                    'Fase 3 — Advanced Product Design' => [
                        'Design system (Atomic Design)', 'Usability testing', 'Interaction design (micro-interaction)',
                        'Handoff ke developer & design documentation'
                    ],
                ]
            ],
            
            'STRUKTUR (Computer Science Core)' => [
                'description' => 'Fondasi inti ilmu komputer yang esensial untuk semua bidang IT.',
                'fases' => [
                    'Fase 1 — Core Foundations' => [
                        'Matematika (logika, aljabar)', 'Algoritma dan struktur data', 'Sistem komputer & arsitektur CPU', 
                        'Sistem operasi'
                    ],
                    'Fase 2 — Intermediate' => [
                        'Jaringan komputer', 'Basis data relasional & non-relasional', 
                        'Konsep komputasi modern (parallel & distributed system)'
                    ],
                    'Fase 3 — Advanced' => [
                        'Compiler & interpreter', 'High performance computing', 
                        'Advanced algorithm (graph, greedy, DP)'
                    ],
                ]
            ]
        ];

        // Looping untuk membuat data di database
        foreach ($learningPaths as $segmentName => $segmentData) {
            
            // 1. Buat Segment
            $segment = Segment::create([
                'name' => $segmentName,
                'description' => $segmentData['description'],
            ]);

            $faseOrder = 1;
            foreach ($segmentData['fases'] as $faseName => $materiList) {
                
                // 2. Buat Fase yang terhubung ke Segment
                $fase = $segment->fases()->create([
                    'name' => $faseName,
                    'order' => $faseOrder,
                ]);

                $materiOrder = 1;
                foreach ($materiList as $materiTitle) {
                    
                    // 3. Buat Materi yang terhubung ke Fase
                    $fase->materis()->create([
                        'title' => $materiTitle,
                        'order' => $materiOrder,
                    ]);
                    $materiOrder++;
                }
                $faseOrder++;
            }
        }
    }
}