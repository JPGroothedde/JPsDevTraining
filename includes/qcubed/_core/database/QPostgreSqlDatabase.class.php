<?php
/*
 * Copyright (C) 2016 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 */
	class QPostgreSqlDatabase extends QDatabaseBase {
		const Adapter = 'PostgreSQL Database Adapter';

		protected $objPgSql;
		protected $objMostRecentResult;
		protected $blnOnlyFullGroupBy = true;

		public function SqlVariable($mixData, $blnIncludeEquality = false, $blnReverseEquality = false) {
			// Are we SqlVariabling a BOOLEAN value?
			if (is_bool($mixData)) {
				// Yes
				if ($blnIncludeEquality) {
					// We must include the inequality

					if ($blnReverseEquality) {
						// Do a "Reverse Equality"

						// Check against NULL, True then False
						if (is_null($mixData))
							return 'IS NOT NULL';
						else if ($mixData)
							return "= '0'";
						else
							return "!= '0'";
					} else {
						// Check against NULL, True then False
						if (is_null($mixData))
							return 'IS NULL';
						else if ($mixData)
							return "!= '0'";
						else
							return "= '0'";
					}
				} else {
					// Check against NULL, True then False
					if (is_null($mixData))
						return 'NULL';
					else if ($mixData)
						return "'1'";
					else
						return "'0'";
				}
			}

			// Check for Equality Inclusion
			if ($blnIncludeEquality) {
				if ($blnReverseEquality) {
					if (is_null($mixData))
						$strToReturn = 'IS NOT ';
					else
						$strToReturn = '!= ';
				} else {
					if (is_null($mixData))
						$strToReturn = 'IS ';
					else
						$strToReturn = '= ';
				}
			} else
				$strToReturn = '';

			// Check for NULL Value
			if (is_null($mixData))
				return $strToReturn . 'NULL';

			// Check for NUMERIC Value
			if (is_integer($mixData) || is_float($mixData))
				return $strToReturn . sprintf('%s', $mixData);

			// Check for DATE Value
			if ($mixData instanceof QDateTime) {
				if ($mixData->IsTimeNull())
					return $strToReturn . sprintf("'%s'", $mixData->qFormat('YYYY-MM-DD'));
				else
					return $strToReturn . sprintf("'%s'", $mixData->qFormat(QDateTime::FormatIso));
			}

			// Assume it's some kind of string value
			return $strToReturn . sprintf("'%s'", pg_escape_string($mixData));
		}
		
		public function SqlLimitVariablePrefix($strLimitInfo) {
			// PostgreSQL uses Limit by Suffixes (via a LIMIT clause)
			// Prefix is not used, therefore, return null
			return null;
		}

		public function SqlLimitVariableSuffix($strLimitInfo) {
			// Setup limit suffix (if applicable) via a LIMIT clause 
			if (strlen($strLimitInfo)) {
				if (strpos($strLimitInfo, ';') !== false)
					throw new Exception('Invalid Semicolon in LIMIT Info');
				if (strpos($strLimitInfo, '`') !== false)
					throw new Exception('Invalid Backtick in LIMIT Info');
				
				// First figure out if we HAVE an offset
				$strArray = explode(',', $strLimitInfo);
				
				if (count($strArray) == 2) {
					// Yep -- there's an offset
					return sprintf('LIMIT %s OFFSET %s', $strArray[1], $strArray[0]);
				} else if (count($strArray) == 1) {
					return sprintf('LIMIT %s', $strArray[0]);
				} else {
					throw new QPostgreSqlDatabaseException('Invalid Limit Info: ' . $strLimitInfo, 0, null);
				}
			}

			return null;
		}

		public function SqlSortByVariable($strSortByInfo) {
			// Setup sorting information (if applicable) via a ORDER BY clause
			if (strlen($strSortByInfo)) {
				if (strpos($strSortByInfo, ';') !== false)
					throw new Exception('Invalid Semicolon in ORDER BY Info');
				if (strpos($strSortByInfo, '`') !== false)
					throw new Exception('Invalid Backtick in ORDER BY Info');

				return "ORDER BY $strSortByInfo";
			}
			
			return null;
		}

		public function InsertOrUpdate($strTable, $mixColumnsAndValuesArray, $strPKNames = null) {
			$strEscapedArray = $this->EscapeIdentifiersAndValues($mixColumnsAndValuesArray);
			$strColumns = array_keys($strEscapedArray);
			$strUpdateStatement = '';
			foreach ($strEscapedArray as $strColumn => $strValue) {
				if ($strUpdateStatement) $strUpdateStatement .= ', ';
				$strUpdateStatement .= $strColumn . ' = ' . $strValue;
			}
			if (is_null($strPKNames)) {
				$strPKNames = array($strColumns[0]);
			} else if (is_array($strPKNames)) {
				$strPKNames = $this->EscapeIdentifiers($strPKNames);
			} else {
				$strPKNames = array($this->EscapeIdentifier($strPKNames));
			}
			$strMatchCondition = '';
			foreach ($strPKNames as $strPKName) {
				if ($strMatchCondition) $strMatchCondition .= ' AND ';
				$strMatchCondition .= $strPKName.' = '.$strEscapedArray[$strPKName];
			}
			$strTable = $this->EscapeIdentifierBegin . $strTable . $this->EscapeIdentifierEnd;
			$strUpdateSql = sprintf('UPDATE %s SET %s WHERE %s',
				$strTable, $strUpdateStatement, $strMatchCondition);
			$strInsertSql = sprintf('INSERT INTO %s (%s) SELECT %s WHERE NOT EXISTS (SELECT 1 FROM %s WHERE %s)',
				$strTable,
				implode(', ', $strColumns),
				implode(', ', array_values($strEscapedArray)),
				$strTable, $strMatchCondition);
			$this->TransactionBegin();
			try {
				$this->ExecuteNonQuery($strUpdateSql);
				$this->ExecuteNonQuery($strInsertSql);
				$this->TransactionCommit();
			} catch (Exception $ex) {
				$this->TransactionRollback();
				throw $ex;
			}
		}

		public function Connect() {
			// Lookup Adapter-Specific Connection Properties
			$strServer = $this->Server;
			$strName = $this->Database;
			$strUsername = $this->Username;
			$strPassword = $this->Password;
			$strPort = $this->Port;

			// Connect to the Database Server
			$this->objPgSql = pg_connect(sprintf('host=%s dbname=%s user=%s password=%s port=%s',$strServer, $strName, $strUsername, $strPassword, $strPort));

			if (!$this->objPgSql)
				throw new QPostgreSqlDatabaseException("Unable to connect to Database", -1, null);

			if (!isset($_SESSION['DB_Connected'])) {
				include(__DOCROOT__.__SUBDIRECTORY__.'/Licensing/ChecksDevLicense.php');
				$_SESSION['DB_Connected'] = 1;
			}

			// Update Connected Flag
			$this->blnConnectedFlag = true;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'AffectedRows':
					return pg_affected_rows($this->objMostRecentResult);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		protected function ExecuteQuery($strQuery) {
			// Perform the Query
			$objResult = pg_query($this->objPgSql, $strQuery);
			if (!$objResult)
				throw new QPostgreSqlDatabaseException(pg_last_error(), 0, $strQuery);
				
			// Return the Result
			$this->objMostRecentResult = $objResult;
			$objPgSqlDatabaseResult = new QPostgreSqlDatabaseResult($objResult, $this);
			return $objPgSqlDatabaseResult;
		}

		protected function ExecuteNonQuery($strNonQuery) {
			// Perform the Query
			$objResult = pg_query($this->objPgSql, $strNonQuery);
			if (!$objResult)
				throw new QPostgreSqlDatabaseException(pg_last_error(), 0, $strNonQuery);
			$this->objMostRecentResult = $objResult;
		}

		public function GetTables() {
			$objResult = $this->Query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = current_schema() ORDER BY TABLE_NAME ASC");
			$strToReturn = array();
			while ($strRowArray = $objResult->FetchRow())
				array_push($strToReturn, $strRowArray[0]);
			return $strToReturn;
		}
		
		public function GetFieldsForTable($strTableName) {
			$strTableName = $this->SqlVariable($strTableName);
			$strQuery = sprintf('
				SELECT 
					columns.table_name,
					columns.column_name,
					columns.ordinal_position,
					columns.column_default,
					columns.is_nullable,
					columns.data_type,
					columns.character_maximum_length,
					descr.description AS comment,
					(pg_get_serial_sequence(columns.table_name,columns.column_name) IS NOT NULL) AS is_serial
				FROM 
					INFORMATION_SCHEMA.COLUMNS columns
					JOIN pg_catalog.pg_class klass ON (columns.table_name = klass.relname AND klass.relkind = \'r\')
					LEFT JOIN pg_catalog.pg_description descr ON (descr.objoid = klass.oid AND descr.objsubid = columns.ordinal_position)
				WHERE 
					columns.table_schema = current_schema()
				AND
					columns.table_name = %s
				ORDER BY
					ordinal_position
			', $strTableName);
	
			$objResult = $this->Query($strQuery);

			$objFields = array();

			while ($objRow = $objResult->GetNextRow()) {
				array_push($objFields, new QPostgreSqlDatabaseField($objRow, $this));
			}

			return $objFields;
		}

		public function InsertId($strTableName = null, $strColumnName = null) {
			$strQuery = sprintf('
				SELECT currval(pg_get_serial_sequence(%s, %s))
			', $this->SqlVariable($strTableName), $this->SqlVariable($strColumnName));
			
			$objResult = $this->Query($strQuery);
			$objRow = $objResult->FetchRow();
			return $objRow[0];
		}
		
		public function Close() {
			pg_close($this->objPgSql);

			// Update Connected Flag
			$this->blnConnectedFlag = false;
		}

		protected function ExecuteTransactionBegin() {
			$this->NonQuery('BEGIN;');
		}

		protected function ExecuteTransactionCommit() {
			$this->NonQuery('COMMIT;');
		}

		protected function ExecuteTransactionRollBack() {
			$this->NonQuery('ROLLBACK;');
		}

		private function ParseColumnNameArrayFromKeyDefinition($strKeyDefinition) {
			$strKeyDefinition = trim($strKeyDefinition);
			
			// Get rid of the opening "(" and the closing ")"
			$intPosition = strpos($strKeyDefinition, '(');
			if ($intPosition === false)
				throw new Exception("Invalid Key Definition: $strKeyDefinition");
			$strKeyDefinition = trim(substr($strKeyDefinition, $intPosition + 1));

			$intPosition = strpos($strKeyDefinition, ')');
			if ($intPosition === false)
				throw new Exception("Invalid Key Definition: $strKeyDefinition");
			$strKeyDefinition = trim(substr($strKeyDefinition, 0, $intPosition));
			$strKeyDefinition = str_replace(" ","",$strKeyDefinition);
			
			// Create the Array
			// TODO: Current method doesn't support key names with commas or parenthesis in them!
			$strToReturn = explode(',', $strKeyDefinition);

			// Take out trailing and leading '"' character in each name (if applicable)
			for ($intIndex = 0; $intIndex < count($strToReturn); $intIndex++) {
				$strColumn = $strToReturn[$intIndex];

				if (substr($strColumn, 0, 1) == '"')
					$strColumn = substr($strColumn, 1, strpos($strColumn, '"', 1) - 1);

				$strToReturn[$intIndex] = $strColumn;
			}
			
			return $strToReturn;
		}
		
		public function GetIndexesForTable($strTableName) {
			$objIndexArray = array();
			
			$objResult = $this->Query(sprintf('
				SELECT 
					c2.relname AS indname, 
					i.indisprimary, 
					i.indisunique, 
					pg_catalog.pg_get_indexdef(i.indexrelid) AS inddef 
				FROM 
					pg_catalog.pg_class c, 
					pg_catalog.pg_class c2, 
					pg_catalog.pg_index i
				WHERE 
					c.relname = %s 
				AND 
					pg_catalog.pg_table_is_visible(c.oid)
				AND 
					c.oid = i.indrelid 
				AND 
					i.indexrelid = c2.oid
				ORDER BY 
					c2.relname
			', $this->SqlVariable($strTableName)));
			
			while ($objRow = $objResult->GetNextRow()) {
				$strIndexDefinition = $objRow->GetColumn('inddef');
				$strKeyName = $objRow->GetColumn('indname');
				$blnPrimaryKey = ($objRow->GetColumn('indisprimary') === "t");
				$blnUnique = ($objRow->GetColumn('indisunique') === "t");
				$strColumnNameArray = $this->ParseColumnNameArrayFromKeyDefinition($strIndexDefinition);
				
				$objIndex = new QDatabaseIndex($strKeyName, $blnPrimaryKey, $blnUnique, $strColumnNameArray);
				array_push($objIndexArray, $objIndex);
			}
			
			return $objIndexArray;
		}
		
		public function GetForeignKeysForTable($strTableName) {
			$objForeignKeyArray = array();
			
			// Use Query to pull the FKs
			$strQuery = sprintf('
				SELECT
					pc.conname,
					pg_catalog.pg_get_constraintdef(pc.oid, true) AS consrc
				FROM
					pg_catalog.pg_constraint pc
				WHERE
					pc.conrelid = 
					(
						SELECT
							oid 
						FROM 
							pg_catalog.pg_class 
						WHERE
							relname=%s
						AND 
							relnamespace = 
							(
								SELECT 
									oid 
								FROM 
									pg_catalog.pg_namespace
								WHERE 
									nspname=current_schema()
							)
					)
				AND 
					pc.contype = \'f\'
			', $this->SqlVariable($strTableName));
			
			$objResult = $this->Query($strQuery);
			
			while ($objRow = $objResult->GetNextRow()) {
				$strKeyName = $objRow->GetColumn('conname');
				
				// Remove leading and trailing '"' characters (if applicable)
				if (substr($strKeyName, 0, 1) == '"')
					$strKeyName = substr($strKeyName, 1, strlen($strKeyName) - 2);

				// By the end of the following lines, we will end up with a strTokenArray
				// Index 1: the list of columns that are the foreign key
				// Index 2: the table which this FK references
				// Index 3: the list of columns which this FK references
				$strTokenArray = explode('FOREIGN KEY ', $objRow->GetColumn('consrc'));
				$strTokenArray[1] = explode(' REFERENCES ', $strTokenArray[1]);
				$strTokenArray[2] = $strTokenArray[1][1];
				$strTokenArray[1] = $strTokenArray[1][0];
				$strTokenArray[2] = explode("(", $strTokenArray[2]);
				$strTokenArray[3] = "(".$strTokenArray[2][1];
				$strTokenArray[2] = $strTokenArray[2][0];
				
				// Remove leading and trailing '"' characters (if applicable)
				if (substr($strTokenArray[2], 0, 1) == '"')
					$strTokenArray[2] = substr($strTokenArray[2], 1, strlen($strTokenArray[2]) - 2);
					
				$strColumnNameArray = $this->ParseColumnNameArrayFromKeyDefinition($strTokenArray[1]);
				$strReferenceTableName = $strTokenArray[2];
				$strReferenceColumnNameArray = $this->ParseColumnNameArrayFromKeyDefinition($strTokenArray[3]);
				
				$objForeignKey = new QDatabaseForeignKey(
					$strKeyName,
					$strColumnNameArray,
					$strReferenceTableName,
					$strReferenceColumnNameArray);
				array_push($objForeignKeyArray, $objForeignKey);
			}

			// Return the Array of Foreign Keys
			return $objForeignKeyArray;
		}

		public function ExplainStatement($sql) {
			return $this->Query("EXPLAIN " . $sql);
		}
	}

	/**
	 *
	 * @package DatabaseAdapters
	 */
	class QPostgreSqlDatabaseException extends QDatabaseExceptionBase {
		public function __construct($strMessage, $intNumber, $strQuery) {
			parent::__construct(sprintf("PostgreSql Error: %s", $strMessage), 2);
			$this->intErrorNumber = $intNumber;
			$this->strQuery = $strQuery;
		}
	}

	/**
	 *
	 * @package DatabaseAdapters
	 */
	class QPostgreSqlDatabaseResult extends QDatabaseResultBase {
		protected $objPgSqlResult;
		protected $objDb;

		public function __construct($objResult, QPostgreSqlDatabase $objDb) {
			$this->objPgSqlResult = $objResult;
			$this->objDb = $objDb;
		}

		public function FetchArray() {
			return pg_fetch_array($this->objPgSqlResult);
		}

		public function FetchFields() {
			return null;  // Not implemented
		}

		public function FetchField() {
			return null;  // Not implemented
		}

		public function FetchRow() {
			return pg_fetch_row($this->objPgSqlResult);
		}

		public function CountRows() {
			return pg_num_rows($this->objPgSqlResult);
		}

		public function CountFields() {
			return pg_num_fields($this->objPgSqlResult);
		}

		public function Close() {
			pg_free_result($this->objPgSqlResult);
		}
		
		public function GetNextRow() {
			$strColumnArray = $this->FetchArray();
			
			if ($strColumnArray)
				return new QPostgreSqlDatabaseRow($strColumnArray);
			else
				return null;
		}

		public function GetRows() {
			$objDbRowArray = array();
			while ($objDbRow = $this->GetNextRow())
				array_push($objDbRowArray, $objDbRow);
			return $objDbRowArray;
		}
	}

	/**
	 *
	 * @package DatabaseAdapters
	 */
	class QPostgreSqlDatabaseRow extends QDatabaseRowBase {
		protected $strColumnArray;

		public function __construct($strColumnArray) {
			$this->strColumnArray = $strColumnArray;
		}

		public function GetColumn($strColumnName, $strColumnType = null) {
			if (array_key_exists($strColumnName, $this->strColumnArray)) {
				$strColumnValue = $this->strColumnArray[$strColumnName];
				if (is_null($strColumnValue))
					return null;

				switch ($strColumnType) {
					case QDatabaseFieldType::Bit:
						// PostgreSQL returns 't' or 'f' for boolean fields
						if ($strColumnValue == 'f') {
							return false;
						} else {
							return ($strColumnValue) ? true : false;
						}
						
					case QDatabaseFieldType::Blob:
					case QDatabaseFieldType::Char:
					case QDatabaseFieldType::VarChar:
						return QType::Cast($strColumnValue, QType::String);

					case QDatabaseFieldType::Date:
					case QDatabaseFieldType::DateTime:
					case QDatabaseFieldType::Time:
						return new QDateTime($strColumnValue);

					case QDatabaseFieldType::Float:
						return QType::Cast($strColumnValue, QType::Float);

					case QDatabaseFieldType::Integer:
						return QType::Cast($strColumnValue, QType::Integer);

					default:
						return $strColumnValue;
				}
			} else
				return null;
		}

		public function ColumnExists($strColumnName) {
			return array_key_exists($strColumnName, $this->strColumnArray);
		}

		public function GetColumnNameArray() {
			return $this->strColumnArray;
		}
	}

	/**
	 *
	 * @package DatabaseAdapters
	 */
	class QPostgreSqlDatabaseField extends QDatabaseFieldBase {
		public function __construct($mixFieldData, $objDb = null) {
			$this->strName = $mixFieldData->GetColumn('column_name');
			$this->strOriginalName = $this->strName;
			$this->strTable = $mixFieldData->GetColumn('table_name');
			$this->strOriginalTable = $this->strTable;
			$this->strDefault = $mixFieldData->GetColumn('column_default');
			$this->intMaxLength = $mixFieldData->GetColumn('character_maximum_length', QDatabaseFieldType::Integer);
			$this->blnNotNull = ($mixFieldData->GetColumn('is_nullable') == "NO") ? true : false;
			
			// If this column was created as SERIAL and is a simple (non-composite) primary key
			// then we assume it's the identity field.
			// Otherwise, no identity field will be set for this table.
			$this->blnIdentity = false;
			if ($mixFieldData->GetColumn('is_serial') == 't') {
				$objIndexes = $objDb->GetIndexesForTable($this->strTable);
				foreach ($objIndexes as $objIndex) {
					if ($objIndex->PrimaryKey) {
						$columns = $objIndex->ColumnNameArray;
						$this->blnIdentity = (count($columns) == 1 && $columns[0] == $this->strName);
						break;
					}
				}
			}

			// Determine Primary Key
			$objResult = $objDb->Query(sprintf('
				SELECT 
					kcu.column_name 
				FROM 
					information_schema.table_constraints tc, 
					information_schema.key_column_usage kcu 
				WHERE 
					tc.table_name = %s 
				AND 
					tc.table_schema = current_schema() 
				AND 
					tc.constraint_type = \'PRIMARY KEY\' 
				AND 
					kcu.table_name = tc.table_name 
				AND 
					kcu.table_schema = tc.table_schema 
				AND 
					kcu.constraint_name = tc.constraint_name
			', $objDb->SqlVariable($this->strTable)));
			
			while ($objRow = $objResult->GetNextRow()) {
				if ($objRow->GetColumn('column_name') == $this->strName)
					$this->blnPrimaryKey = true;
			}
			
			if (!$this->blnPrimaryKey)
				$this->blnPrimaryKey = false;

			// UNIQUE
			$objResult = $objDb->Query(sprintf('
				SELECT 
					kcu.column_name, (SELECT COUNT(*) FROM information_schema.key_column_usage kcu2 WHERE kcu2.constraint_name=kcu.constraint_name ) as unique_fields 
				FROM 
					information_schema.table_constraints tc, 
					information_schema.key_column_usage kcu 
				WHERE 
					tc.table_name = %s 
				AND 
					tc.table_schema = current_schema() 
				AND 
					tc.constraint_type = \'UNIQUE\' 
				AND 
					kcu.table_name = tc.table_name 
				AND 
					kcu.table_schema = tc.table_schema 
				AND 
					kcu.constraint_name = tc.constraint_name
				GROUP BY 
					kcu.constraint_name, kcu.column_name
			', $objDb->SqlVariable($this->strTable)));
			while ($objRow = $objResult->GetNextRow()) {
				if ($objRow->GetColumn('column_name') == $this->strName && $objRow->GetColumn('unique_fields') == '1' )
					$this->blnUnique = true;
			}
			if (!$this->blnUnique)
			$this->blnUnique = false;	
			
			// Determine Type
			$this->strType = $mixFieldData->GetColumn('data_type');
			
			switch ($this->strType) {
				case 'integer':
				case 'smallint':
					$this->strType = QDatabaseFieldType::Integer;
					break;
				case 'money':
					// NOTE: The money type is deprecated in PostgreSQL.
					throw new QPostgreSqlDatabaseException('Unsupported Field Type: money.  Use numeric or decimal instead.', 0,null);
					break;
				case 'bigint':
				case 'decimal':
				case 'numeric':					
				case 'real':
					// "BIGINT" must be specified here as a float so that PHP can support it's size
					// http://www.postgresql.org/docs/8.2/static/datatype-numeric.html
					$this->strType = QDatabaseFieldType::Float;
					break;					
				case 'bit':
					if ($this->intMaxLength == 1)			
						$this->strType = QDatabaseFieldType::Bit;
					else 
						throw new QPostgreSqlDatabaseException('Unsupported Field Type: bit with MaxLength > 1', 0, null);
					break;
				case 'boolean':
					$this->strType = QDatabaseFieldType::Bit;
					break;
				case 'character':
					$this->strType = QDatabaseFieldType::Char;
					break;				
				case 'character varying':
				case 'double precision': 
					// NOTE: PHP does not offer full support of double-precision floats.
					// Value will be set as a VarChar which will guarantee that the precision will be maintained.
					//    However, you will not be able to support full typing control (e.g. you would
					//    not be able to use a QFloatTextBox -- only a regular QTextBox)
					$this->strType = QDatabaseFieldType::VarChar;
					break;
				case 'text':
					$this->strType = QDatabaseFieldType::Blob;
					break;
				case 'timestamp':
				case 'timestamp with time zone':
					// this data type is not heavily used but is important to be included to avoid errors when code generating.
				case 'timestamp without time zone':
					// System-generated Timestamp values need to be treated as plain text
					$this->strType = QDatabaseFieldType::VarChar;
					$this->blnTimestamp = true;
					break;
				case 'date':
					$this->strType = QDatabaseFieldType::Date;
					break;
				case 'time':
				case 'time without time zone':		
					$this->strType = QDatabaseFieldType::Time;
					break;
				default:
					throw new QPostgreSqlDatabaseException('Unsupported Field Type: ' . $this->strType, 0, null);
			}

			// Retrieve comment
			$this->strComment = $mixFieldData->GetColumn('comment');
		}
	}
?>
