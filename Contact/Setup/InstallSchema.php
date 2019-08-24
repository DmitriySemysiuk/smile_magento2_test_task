<?php

namespace SMile\Contact\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('contact_us_request')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
            'Contact request id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => false
            ],
            'Contact name of the requester'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            '30',
            [
                'nullable' => false
            ],
            'Contact email of the requester'
        )->addColumn(
            'comment',
            Table::TYPE_TEXT,
            '2M',
            [
                'nullable' => false
            ],
            'Contact comment of the requester'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT
            ],
            'Contact request creation time'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            [
                'nullable' => false,
                'default' => '1'
            ],
            'Contact request status'
        )->addColumn(
            'answer',
            Table::TYPE_TEXT,
            '2M',
            [],
            'Contact request answer'
        )->setComment(
            'Requests of contact us table'
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
