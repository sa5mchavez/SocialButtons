<?php


namespace Pengo\SocialButtons\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        if (version_compare($context->getVersion(), "1.0.1", "<")) {

            $table_pengo_url_short = $setup->getConnection()->newTable($setup->getTable('pengo_url_short'));
            $table_pengo_url_short->addColumn(
                'url_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
                'Entity ID'
            );
            $table_pengo_url_short->addColumn(
                'url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                1000,
                [],
                'Original Url'
            );
            $table_pengo_url_short->addColumn(
                'url_short',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Short Url'
            );
            $table_pengo_url_short->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
            );
            $table_pengo_url_short->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            );
            $setup->getConnection()->createTable($table_pengo_url_short);

        }
        $setup->endSetup();
    }
}
