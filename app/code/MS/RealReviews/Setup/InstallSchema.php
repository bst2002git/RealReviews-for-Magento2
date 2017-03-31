<?php

namespace MS\RealReviews\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	  {
	    $installer = $setup;
	
	    $installer->startSetup();
	
	    $eavTable = $installer->getTable('review_detail');
	
	    $columns = [
	        'email' => [
	            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
	            128,
	            'nullable' => true,
	            'comment' => 'User E-Mail Address',
	        ],
	
	    ];
	
	    $connection = $installer->getConnection();
	    foreach ($columns as $name => $definition) {
	        $connection->addColumn($eavTable, $name, $definition);
	    }
	
	    $installer->endSetup();
	}
}