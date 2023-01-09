<?php

namespace App\ModelsExtended;

class AssetStatus extends \App\Models\AssetStatus
{
    public const Available = 1;
    public const Sold = 2;
    public const Expired = 3;
}