<?php
namespace app\db\migration;

use app\env\Constants;
use \Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;

/**
 * Class Schema
 * @package lib\migration
 * @api
 */
class Schema extends \Doctrine\DBAL\Schema\Schema
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $db = null;
    private $initData = array();

    /**
     * @param \Doctrine\DBAL\Connection $db - object
    */
    public function __construct(Connection $db)
    {
        parent::__construct();
        $this->db = $db;
    }

    /**
     * @param string $tableName - table name
     * @param string $prefix - prefix for table
     * @return string - table name with prefix
     */
    public static function prependPrefix($tableName, $prefix)
    {
        return $prefix == null ? $tableName : $prefix . $tableName;
    }

    /**
     *  Method apply new schema to DB
     */
    public function apply()
    {
        $this->migrateSchema($this->db, $this);
        $this->insertInitData();
    }

    /**
     *  Set init data for new schema
     * @param array $initData - array('tableName' => array(
     *                           array('column' => 'value', ...)))  // row
     */
    public function setInitData($initData)
    {
        $this->initData = array_merge($initData, $this->initData);
    }

    /**
     *  Create new tables in schema
     *  set common options ( as engine) for tables
     * @param string $tableName
     * @param bool $setIdPrimaryKey - (optional) default true add Id column as primary key
     * @param bool $changeTimeSet - (optional) if true will set action and error_id field
     * @return \Doctrine\DBAL\Schema\Table
     */
    public function createTable($tableName, $setIdPrimaryKey = true, $changeTimeSet = false)
    {
        $table = parent::createTable($tableName);

        if ($setIdPrimaryKey) {
            $table->addColumn(Constants::ID_FIELD, TYPE::INTEGER, array('unsigned' => true, 'autoincrement' => true));
            /* Add a primary key */
            $table->setPrimaryKey(array(Constants::ID_FIELD));
        }

        if ($changeTimeSet) {
            /* Add changetime tracking column */
            $table->addColumn(Constants::UPDATED_AT, Type::DATETIME, array(
                'columnDefinition' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        }
        return $table;
    }

    /**
     * @return string - SQL DDL for all loaded schemas
     */
    public function getDefinedSchema()
    {
        return implode(';' . PHP_EOL, $this->toSql($this->db->getDatabasePlatform())) . ';';
    }

    /**
     * @param \Doctrine\DBAL\Connection $db - object
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    private function migrateSchema(Connection $db, \Doctrine\DBAL\Schema\Schema $schema)
    {
        $schemaManager = $db->getSchemaManager();
        $fromSchema = $schemaManager->createSchema();
        $sql = $fromSchema->getMigrateToSql($schema, $db->getDatabasePlatform());
        foreach ($sql as $request) {
            $db->executeUpdate($request);
        }
    }

    private function insertInitData()
    {
        if (is_array($this->initData))
            foreach ($this->initData as $table => $data) {
                foreach ($data as $row) {
                    $filteredRow = array_filter((array)$row, 'strlen');
                    try {
                        $this->db->insert($table, $filteredRow);
                    } catch (\Exception $e) {
                        $this->db->update($table, $filteredRow, $filteredRow);
                    }
                }
            }
    }
} 