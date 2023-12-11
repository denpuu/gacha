<?php

namespace logic;

use model\GachaDropModel;
use model\GachaGroupModel;
use model\GachaModel;

class GachaLogic
{
    protected $gachaId = 0;

    protected $gachaData = null;

    public function __construct($gachaId)
    {
        $this->gachaId = $gachaId;
    }

    public function getGachaName()
    {
        return $this->getGachaData()['name'];
    }

    private function getGachaData()
    {
        if ($this->gachaData === null) {
            // ガチャ情報
            $mGacha = new GachaModel();
            $this->gachaData = $mGacha->findFirst(['id' => $this->gachaId]);
        }
        return $this->gachaData;
    }

    public function lottery()
    {
        // 対象レアリティグループの選出
        $mGachaGroup = new GachaGroupModel();
        $groups = iterator_to_array($mGachaGroup->findAll(['gacha_id' => $this->gachaId]));
        $group = $this->randomSelect($groups);
        $groupId = intval($group['group_id']);

        // グループ内からカードの選出
        $mGachaDrop = new GachaDropModel();
        $drops = iterator_to_array($mGachaDrop->findAll(['gacha_id' => $this->gachaId, 'group_id' => $groupId]));
        $drop = $this->randomSelect($drops);

        return $drop;
    }

    private function randomSelect($groups) {
        $sum_prob = array_sum(array_map(function ($a) {return intval($a['prob']);}, $groups));

        $rand = mt_rand(1, $sum_prob);
        foreach($groups as $group) {
            $prob = intval($group['prob']);
            if ($rand <= $prob) {
                return $group;
            }
            $rand -= $prob;
        }
        throw new \Exception('Logic error.');
    }
}