<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogsTable extends Migration
{
	
	public function up()
	{
		//

		$this->forge->addField([
			'id'								=> [
				'type'						=> 'INT',
				'constraint'			=> 11,
				'unsigned'				=> true,
				'auto_increment'	=> true,
			],
			'title'					=> [
				'type'						=> 'VARCHAR',
				'constraint'			=> 100,
				'null' 						=> false,
			],
			'description'	=> [
				'type'						=> 'VARCHAR',
				'constraint'			=> 500,
				'null' 						=> false,
			],
			'slug'	=> [
				'type'						=> 'VARCHAR',
				'constraint'			=> 100,
				'null' 						=> true,
			],
			'created_at'				=> [
				'type'						=> 'DATETIME',
				'null' 						=> false,
			],
			'created_by'				=> [
				'type'						=> 'INT',
				'null' 						=> false,
				'default'					=> -1
			],
			'updated_at'				=> [
				'type'						=> 'DATETIME',
				'null' 						=> false,
			],
			'updated_by'				=> [
				'type'						=> 'INT',
				'null' 						=> false,
				'default'					=> -1
			],
			'delflag'						=> [
				'type'						=> 'TINYINT',
				'null' 						=> false,
				'default'					=> 0
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('blogs');
	}

	public function down()
	{
		//
		$this->forge->dropTable('blogs');
	}
}
