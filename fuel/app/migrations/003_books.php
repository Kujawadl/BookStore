<?php

namespace Fuel\Migrations;

class Books
{

    function up()
    {
      \DBUtil::create_table('books',
        array(
            'id' => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'author' => array('type' => 'int', 'unsigned' => true),
            'isbn' => array('type' => 'int', 'constraint' => 13),
            'title' => array('type' => 'varchar', 'constraint' => 100),
            'pubdate' => array('type' => 'date'),
            'price' => array('type' => 'double', 'unsigned' => true)
        ),
        array('id', 'isbn'),
        true,
        'InnoDB',
        'utf8_unicode_ci',
        array(
          array(
            'key' => 'author',
            'reference' => array(
              'table' => 'authors',
              'column' => 'id'
            )
          )
        )
      );

      \DBUtil::create_table('categories',
        array(
          'id' => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
          'name' => array('type' => 'varchar', 'constraint' => 20)
        ),
        array('id')
      );

      \DBUtil::create_table('book_categories',
        array(
          'book' => array('type' => 'int', 'unsigned' => true),
          'category' => array('type' => 'int', 'unsigned' => true)
        ),
        array(),
        true,
        'InnoDB',
        'utf8_unicode_ci',
        array(
          array(
            'key' => 'book',
            'reference' => array(
              'table' => 'books',
              'column' => 'id'
            )
          ),
          array(
            'key' => 'category',
            'reference' => array(
              'table' => 'categories',
              'column' => 'id'
            )
          )
        )
      );
    }

    function down()
    {
      \DBUtil::drop_table('book_categories');
      \DBUtil::drop_table('categories');
      \DBUtil::drop_table('books');
    }
}
