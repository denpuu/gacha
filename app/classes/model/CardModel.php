<?php

namespace model;

use model\CsvModel;

class CardModel extends CsvModel
{
    protected function getCSVFile()
    {
        return 'ms_card.txt';
    }
}