<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use sagittaracc\QMap;

final class QMapTest extends TestCase
{
    public function testQMap(): void
    {
        $qmap = new QMap();
        $qmap
            ->setQuery("SHOW KEYS FROM table1 WHERE Key_name = 'PRIMARY'")
            ->setColumn('primary', function($result){
                return $result[0]['Column_name'];
            });

        $query = $qmap->getQuery();
        $result = $this->runQueryStub($query);
        $column = $qmap->getColumn('primary', $result);

        $this->assertEquals("SHOW KEYS FROM table1 WHERE Key_name = 'PRIMARY'", $query);
        $this->assertEquals('id', $column);
    }

    private function runQueryStub($query)
    {
        if ($query === "SHOW KEYS FROM table1 WHERE Key_name = 'PRIMARY'") {
            return [
                [
                    'Table' => 'table1',
                    'Non_unique' => 0,
                    'Key_name' => 'PRIMARY',
                    'Column_name' => 'id',
                    // ...
                ]
            ];
        }
    }
}