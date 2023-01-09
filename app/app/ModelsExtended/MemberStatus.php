<?php

namespace App\ModelsExtended;

class MemberStatus extends \App\Models\MemberStatus
{
    public const Active = 1;
    public const Archived = 2;
    public const Waitlist = 3;
}