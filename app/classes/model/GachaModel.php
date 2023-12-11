<?php

namespace model;

use model\CsvModel;

class GachaModel extends CsvModel
{
    protected function getCSVFile()
    {
        return 'ms_gacha.txt';
    }
}