<?php
namespace model;

abstract class CsvModel
{
    abstract protected function getCSVFile();

    protected $columns = [];

    protected $column_keys = [];

    protected $records = [];

    public function __construct() {
        $this->load();
    }

    public function load() {
        $csvFile = $this->getCSVFile();
        $filePath = APP_DIR . '/Data/' . $csvFile;
        if (!file_exists($filePath)) throw new \Exception('Data load error.');

        $fp = fopen($filePath, 'r');
        $this->loadRecords($fp);
        fclose($fp);
    }

    protected function loadRecords($fp) {
        while(true) {
            $row = fgets($fp);
            if ($row === FALSE) break;
            if ($row[0] === '#') continue;

            // columns
            $row = str_getcsv($row);
            $this->columns = $row;
            $this->column_keys = array_flip($this->columns);

            break;
        }

        // records
        while(true) {
            $row = fgets($fp);
            if ($row === FALSE) break;
            if (empty($row)) break;
            if ($row[0] === '#') continue;

            $row = str_getcsv($row);
            $this->records[] = $row;
        }
    }

    public function findAll($where = []) {
        foreach($this->records as $record) {
            if ($this->recordCheck($record, $where)) {
                yield array_combine($this->columns, $record);
            }
        }
    }
    public function findFirst($where = []) {
        $generator = $this->findAll($where);
        return $generator->current();
    }

    private function recordCheck($record, $where) {
        foreach($where as $key => $val) {
            if (!array_key_exists($key, $this->column_keys)) return false;
            $idx = $this->column_keys[$key];
            if ($record[$idx] != $val) return false;
        }
        return true;
    }
}