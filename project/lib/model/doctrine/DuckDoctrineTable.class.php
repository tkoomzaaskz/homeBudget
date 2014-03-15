<?php

class DuckDoctrineTable extends Doctrine_Table {

  public function wrap($records)
  {
    return array(
      'meta' => array (
        'limit' => null,
        'next' => null,
        'offset' => null,
        'previous' => null,
        'total_count' => count($records)
      ),
      'objects' => $records
    );
  }

}
