<?php

namespace Fuel\Migrations;

class Contacts
{
  function up()
  {
    \DBUtil::create_table('contact',
      array(
          'id' => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true)
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array()
    );

    \DBUtil::create_table('contact_phone',
      array(
          'id'      => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
          'contact' => array('type' => 'int', 'unsigned' => true),
          'phone'   => array('type' => 'int', 'constraint' => 10),
          'type'    => array('type' => 'varchar', 'constraint' => 10)
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array(
        array(
          'key'       => 'contact',
          'reference' => array(
            'table'   => 'contact',
            'column'  => 'id'
          )
        )
      )
    );

    \DBUtil::create_table('contact_email',
      array(
          'id'      => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
          'contact' => array('type' => 'int', 'unsigned' => true),
          'email'   => array('type' => 'varchar', 'constraint' => 50)
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array(
        array(
          'key'       => 'contact',
          'reference' => array(
            'table'   => 'contact',
            'column'  => 'id'
          )
        )
      )
    );

    \DBUtil::create_table('contact_address',
      array(
          'id'      => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
          'contact' => array('type' => 'int', 'unsigned' => true),
          'street'  => array('type' => 'varchar', 'constraint' => 50),
          'city'    => array('type' => 'varchar', 'constraint' => 50),
          'state'   => array('type' => 'varchar', 'constraint' => 2),
          'zip'     => array('type' => 'int', 'constraint' => 5, 'unsigned' => true),
          'type'    => array('type' => 'varchar', 'constraint' => 10)
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array(
        array(
          'key'       => 'contact',
          'reference' => array(
            'table'   => 'contact',
            'column'  => 'id'
          )
        )
      )
    );
  }

  function down()
  {
     \DBUtil::drop_table('contact_address');
     \DBUtil::drop_table('contact_email');
     \DBUtil::drop_table('contact_phone');
     \DBUtil::drop_table('contact');
  }
}
