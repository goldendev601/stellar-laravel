<?php

namespace App\ModelsExtended;

use App\ModelsExtended\Traits\MessageBirdRelatedModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use MessageBird\Objects\Group;

class ContactGroup extends \App\Models\ContactGroup
{
    use MessageBirdRelatedModelTrait;

    /**
     * @param Group $group
     * @return ContactGroup|Builder|Model|object|null|ContactGroup
     */
    public static function createOrUpdateFromMessageBird(Group $group): Model|ContactGroup|Builder|null
    {
        $g = self::getByMessageBirdId($group->getId());
        if ($g)
            $g->update(["name" => $group->name, "updated_at" => $group->getUpdatedDatetime()]);
        else
            $g = self::query()->create([
                "message_bird_id" => $group->getId(),
                "name" => $group->name,
                "created_at" => $group->getCreatedDatetime(),
                "updated_at" => $group->getUpdatedDatetime(),
            ]);
        return $g;
    }

    /**
     * You can use for auto suggest
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getUniqueGroup()
    {
        return self::query()->select('id', 'name')->distinct();
    }

    public function member()
    {
        return $this->hasMany(MemberGroup::class);
    }

    public static function getGroupsWithNotShareAsset($assetId)
    {
        $memberGroupList = self::getUniqueGroup()->with('member')->get();
        foreach ($memberGroupList as $index => $memberGroup) {
            if (count($memberGroup->member) > 0) {
                $member_id = array_column($memberGroup->member->toArray(), 'member_id');
                $NotExistedMember = array_values(array_diff($member_id, array_column((\App\Models\AssetReceiver::whereIn("member_id", $member_id)->where("asset_id", $assetId)->select('member_id')->get()->toArray()), 'member_id')));
                if (!count($NotExistedMember) > 0) {
                    unset($memberGroupList[$index]);
                }

            }
        }
        return ((array_values($memberGroupList->toArray())));
    }
}
