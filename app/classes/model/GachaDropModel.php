<?php

namespace model;

use model\CsvModel;

class GachaDropModel extends CsvModel
{
    protected function getCSVFile()
    {
        return 'ms_gacha_drop.txt';
    }
}