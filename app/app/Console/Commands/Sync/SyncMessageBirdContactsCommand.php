<?php

namespace App\Console\Commands\Sync;

use App\ModelsExtended\ContactGroup;
use App\ModelsExtended\Member;
use App\Repositories\SMS\MessageBirdRepository;
use Illuminate\Console\Command;
use MessageBird\Exceptions\AuthenticateException;
use MessageBird\Exceptions\BalanceException;
use MessageBird\Exceptions\HttpException;
use MessageBird\Exceptions\RequestException;
use MessageBird\Exceptions\ServerException;
use MessageBird\Objects\Group;

class SyncMessageBirdContactsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:messagebird-contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will copy message bird contacts to local database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createGroups();
        $this->createContacts();

        $this->info("\nCompleted\n");
        return 0;
    }

    private function createGroups()
    {
        $this->info("\nCreating groups ...\n");
        $SDK = new MessageBirdRepository();
        $this->withProgressBar( $SDK->getGroups()->items, function ( Group $group ){
            ContactGroup::createOrUpdateFromMessageBird($group);
        });
        $this->info("\nCompleted Creating groups ...\n");
    }

    /**
     * @throws \JsonException
     * @throws HttpException
     * @throws BalanceException
     * @throws AuthenticateException
     * @throws ServerException
     * @throws RequestException
     */
    private function createContacts()
    {
        $this->info("\nCreating Contacts ...\n");

        $SDK = new MessageBirdRepository();
        $step = 10;
        $allContactSummary = $SDK->getContacts(0,$step);
        $offset = $allContactSummary->count;

        $contacts = $allContactSummary;

        // total counts always returns all records in database
        $bar = $this->output->createProgressBar(intval($allContactSummary->totalCount/$step));
        $bar->start();

        while ($bar->getProgressPercent() < 1) {
            foreach ($contacts->items as $contact) {
                Member::createOrUpdateFromMessageBird($contact);
            }

            $contacts = $SDK->getContacts( $offset + ($bar->getProgress() * $step), $step);
            $bar->advance();
        }
        $bar->finish();

        $this->info("\nCompleted Creating Contacts ...\n");
    }
}
