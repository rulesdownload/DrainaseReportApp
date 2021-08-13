<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\drainaseProblems;

class problemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     drainaseProblems::truncate();
     drainaseProblems::create([	
             'problem' => 'empty'
         ]);
     drainaseProblems::create([ 
             'problem' => 'Saluran penuh sampah'
         ]);     
     drainaseProblems::create([	
             'problem' => 'Saluran kurang dalam'         	
         ]);
     drainaseProblems::create([	
             'problem' => 'Saluran banyak lumpur atau tanah'   
         ]);
     drainaseProblems::create([	
             'problem' => 'Air disaluran keluar kejalan saat hujan'          	
         ]);
     drainaseProblems::create([	
             'problem' => 'Saluran tak bisa dimasuki air dari jalan'   
         ]);
     drainaseProblems::create([	
             'problem' => 'Sisa penggalian belum diangkat'   
         ]);
     drainaseProblems::create([	
             'problem' => 'Trotoar tidak tertutup'   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Trotoar tidak tertutup dan penuh sampah'   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Trotoar tidak tertutup dan penuh lumpur'   
         ]);
     drainaseProblems::create([	
             'problem' => 'Trotoar berlubang-lubang'   
         ]);
    }
}
