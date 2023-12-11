<?php

namespace model;

use model\CsvModel;

class GachaGroupModel extends CsvModel
{
    protected function getCSVFile()
    {
        return 'ms_gacha_group.txt';
    }
}