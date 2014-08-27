<?php
namespace app\db\account;

use app\env\Constants;
use Doctrine\DBAL\Types\Type;

class Schema extends \app\db\migration\Schema
{

    /**
     * @static
     * @param \app\db\migration\Schema $schema
     * @param null $tablePrefix as <prefix>TABLE_NAME  (not adding any additional symbols like _ or .)
     * @return \app\db\migration\Schema $schema
     */
    public static final function create(\app\db\migration\Schema $schema, $tablePrefix = null)
    {
        /* Now use the Schema object to create a  table */
        $accountTableName = $schema::prependPrefix(Constants::ACCOUNT_TABLE, $tablePrefix);

        $userTableName = $schema::prependPrefix(Constants::USER_DATA_TABLE, $tablePrefix);
        $historyTableName = $schema::prependPrefix(Constants::HISTORY_TABLE, $tablePrefix);
        /**
         *  TYPES:
         *   'bigint', 'boolean',
         *  'datetime', 'date', 'time',
         *  'decimal', 'integer', 'smallint',
         *  'object', 'string', 'text'.
         */
        // 'default' => 'TEST'
        // 'notnull' => false
        // User login data store
        $accountTable = $schema->createTable($accountTableName, true, true);
        $accountTable->addColumn(Constants::NAME_FIELD, Type::STRING, array('length' => 128, 'notnull' => true));
        $accountTable->addColumn(Constants::PASSWORD_FIELD, Type::STRING, array('length' => 128, 'notnull' => true, /* 'default' => ''*/));
        $accountTable->addColumn(Constants::ROLE_FIELD, Type::STRING, array('length' => 255));
        $accountTable->addUniqueIndex(array(Constants::NAME_FIELD));

        // User personal data store
        $userTable = $schema->createTable($userTableName, true, true);
        $userTable->addColumn(Constants::FIRST_NAME_FIELD, Type::STRING, array('length' => 128, 'notnull' => true));
        $userTable->addColumn(Constants::SECOND_NAME_FIELD, Type::STRING, array('length' => 128, 'notnull' => true));
        $userTable->addColumn(Constants::EMAIL_FIELD, Type::STRING, array('length' => 128, 'notnull' => false));
        $userTable->addColumn(Constants::PHONE_FIELD, Type::STRING, array('length' => 30, 'notnull' => false));
        $userTable->addColumn(Constants::BIRTHDAY_DATE_FIELD, Type::DATE, array('notnull' => false));

        // Changes table
        $historyTable = $schema->createTable($historyTableName, false, true);
        $historyTable->addColumn(Constants::ID_FIELD, TYPE::INTEGER, array('unsigned' => true, 'autoincrement' => false));
        $historyTable->addColumn(Constants::NAME_FIELD, Type::STRING, array('length' => 128, 'notnull' => true));
        $historyTable->addColumn(Constants::FIRST_NAME_FIELD, Type::STRING, array('length' => 128, 'notnull' => true));
        $historyTable->addColumn(Constants::SECOND_NAME_FIELD, Type::STRING, array('length' => 128, 'notnull' => true));
        $historyTable->addColumn(Constants::EMAIL_FIELD, Type::STRING, array('length' => 128, 'notnull' => false));
        $historyTable->addColumn(Constants::PHONE_FIELD, Type::STRING, array('length' => 30, 'notnull' => false));
        $historyTable->addColumn(Constants::BIRTHDAY_DATE_FIELD, Type::DATE, array('notnull' => false));
        $historyTable->addColumn(Constants::ACTION, Type::STRING, array('length' => 30, 'notnull' => true));

        return $schema;
    }

    /**
     * This function prepare module for work
     *  init DB table
     *  $app \Silex\Application - instance
     */
    public static function init($app, $dbInitData = array())
    {
        $dbInitData[Constants::ACCOUNT_TABLE] = array(
            array(Constants::NAME_FIELD => Constants::ADMIN_USER, Constants::ROLE_FIELD => Constants::ROLE_ADMIN,
                // raw password is 'foo'
                Constants::PASSWORD_FIELD => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg=='));
        static::create($app['schema'])->setInitData($dbInitData);
    }
} 