<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VendorImport;
class ImportVendors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Import:vendors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import  file into vendors';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

           $import = Excel::import( new VendorImport(), public_path('NY_MIAMI_LA_HAMPTONS_VENDORS_-_IMPORTABLE.xlsx'));
            
    }
}
