<?php

namespace App\Console\Commands;

use App\ModelsExtended\Member;
use App\ModelsExtended\MemberStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Sample usage: php artisan import:interested-members /var/www/html/convertcsv.csv
 */
class ImportInterestedMembersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:interested-members {file_csv_path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will import members in the csv file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file_csv_path = $this->argument('file_csv_path');
        $file_content = file_get_contents($file_csv_path);

        // 1,#,First Name,Last Name,Phone,Email,Zip,Trim,Datetime,Passed vetting?,Email Sent,SMS Sent"
        $this->withProgressBar( Str::of($file_content)->explode("\r\n")->skip(2) , function ( $row ){
            if(strlen($row) > 10)
            {
                $col = Str::of($row)->explode(",")->skip(2)->reverse()->skip(3)->reverse()->values();
                if( count($col) >= 7 && $col[0] )
                {
                    try {
                        $member = Member::createOrUpdateContact(
                            self::cleanUpPhoneNumber( $col[2] ),
                            $col[0], $col[1], $col[3], Carbon::createFromFormat("n/j/Y", $col[6] )
                        );
                        $member->zipcode = $col[4];
                        $member->member_status_id = MemberStatus::Waitlist;
                        $member->update();
                    }catch (\Exception $exception){
                        dd( $col );
                    }
                }
            }
        });

        $this->info( "-------------------------------------" );
        $this->info( "COMPLETED" );
        return 0;
    }

    /**
     * @param string $to
     * @return string
     */
    private static function cleanUpPhoneNumber(string $to): string
    {
        return preg_replace('/[^0-9_]/', '', $to );
    }
}
