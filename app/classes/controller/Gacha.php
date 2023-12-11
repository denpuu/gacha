<?php

namespace controller;

use logic\GachaLogic;
use model\CardModel;

class Gacha extends BaseController
{
    public function exec() {
        $gachaId = $this->GetRequestParam('gacha_id');
        if ($gachaId === null) {
            return 'require gacha_id';
        }

        // 抽選を行う
        $gacha = new GachaLogic($gachaId);
        $drop = $gacha->lottery();

        // 獲得したカードの情報を取得
        $mCard = new CardModel();
        $card = $mCard->findFirst(['id' => $drop['card_id']]);

        // 結果出力
        $this->addResponse(sprintf('%s 結果', $gacha->getGachaName()));
        $this->addResponse(sprintf('レア度%d %s GET!', $card['rarity'], $card['name']));

        return $this->getResponse();
    }

}