<?php
	/**
	 * The abstract AuditLogEntryGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the AuditLogEntry subclass which
	 * extends this AuditLogEntryGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the AuditLogEntry class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property QDateTime $EntryTimeStamp the value for dttEntryTimeStamp 
	 * @property string $ObjectName the value for strObjectName 
	 * @property string $ModificationType the value for strModificationType 
	 * @property string $UserEmail the value for strUserEmail 
	 * @property string $ObjectId the value for strObjectId 
	 * @property string $AuditLogEntryDetail the value for strAuditLogEntryDetail 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class AuditLogEntryGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column AuditLogEntry.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column AuditLogEntry.EntryTimeStamp
		 * @var QDateTime dttEntryTimeStamp
		 */
		protected $dttEntryTimeStamp;
		const EntryTimeStampDefault = null;


		/**
		 * Protected member variable that maps to the database column AuditLogEntry.ObjectName
		 * @var string strObjectName
		 */
		protected $strObjectName;
		const ObjectNameMaxLength = 50;
		const ObjectNameDefault = null;


		/**
		 * Protected member variable that maps to the database column AuditLogEntry.ModificationType
		 * @var string strModificationType
		 */
		protected $strModificationType;
		const ModificationTypeMaxLength = 15;
		const ModificationTypeDefault = null;


		/**
		 * Protected member variable that maps to the database column AuditLogEntry.UserEmail
		 * @var string strUserEmail
		 */
		protected $strUserEmail;
		const UserEmailMaxLength = 100;
		const UserEmailDefault = null;


		/**
		 * Protected member variable that maps to the database column AuditLogEntry.ObjectId
		 * @var string strObjectId
		 */
		protected $strObjectId;
		const ObjectIdDefault = null;


		/**
		 * Protected member variable that maps to the database column AuditLogEntry.AuditLogEntryDetail
		 * @var string strAuditLogEntryDetail
		 */
		protected $strAuditLogEntryDetail;
		const AuditLogEntryDetailDefault = null;


		/**
		 * Protected array of virtual attributes for this object (e.g. extra/other calculated and/or non-object bound
		 * columns from the run-time database query result for this object).  Used by InstantiateDbRow and
		 * GetVirtualAttribute.
		 * @var string[] $__strVirtualAttributeArray
		 */
		protected $__strVirtualAttributeArray = array();

		/**
		 * Protected internal member variable that specifies whether or not this object is Restored from the database.
		 * Used by Save() to determine if Save() should perform a db UPDATE or INSERT.
		 * @var bool __blnRestored;
		 */
		protected $__blnRestored;




		///////////////////////////////
		// PROTECTED MEMBER OBJECTS
		///////////////////////////////



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = AuditLogEntry::IdDefault;
			$this->dttEntryTimeStamp = (AuditLogEntry::EntryTimeStampDefault === null)?null:new QDateTime(AuditLogEntry::EntryTimeStampDefault);
			$this->strObjectName = AuditLogEntry::ObjectNameDefault;
			$this->strModificationType = AuditLogEntry::ModificationTypeDefault;
			$this->strUserEmail = AuditLogEntry::UserEmailDefault;
			$this->strObjectId = AuditLogEntry::ObjectIdDefault;
			$this->strAuditLogEntryDetail = AuditLogEntry::AuditLogEntryDetailDefault;
		}


		///////////////////////////////
		// CLASS-WIDE LOAD AND COUNT METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[1];
		}

		/**
		 * Load a AuditLogEntry from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AuditLogEntry
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'AuditLogEntry', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = AuditLogEntry::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::AuditLogEntry()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all AuditLogEntries
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AuditLogEntry[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call AuditLogEntry::QueryArray to perform the LoadAll query
			try {
				return AuditLogEntry::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all AuditLogEntries
		 * @return int
		 */
		public static function CountAll() {
			// Call AuditLogEntry::QueryCount to perform the CountAll query
			return AuditLogEntry::QueryCount(QQ::All());
		}




		///////////////////////////////
		// QCUBED QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Internally called method to assist with calling Qcubed Query for this class
		 * on load methods.
		 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause object or array of QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
		 * @param boolean $blnCountOnly only select a rowcount
		 * @return string the query statement
		 */
		protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
			// Get the Database Object for this Class
			$objDatabase = AuditLogEntry::GetDatabase();

			// Create/Build out the QueryBuilder object with AuditLogEntry-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'AuditLogEntry');

			$blnAddAllFieldsToSelect = true;
			if ($objDatabase->OnlyFullGroupBy) {
				// see if we have any group by or aggregation clauses, if yes, don't add the fields to select clause
				if ($objOptionalClauses instanceof QQClause) {
					if ($objOptionalClauses instanceof QQAggregationClause || $objOptionalClauses instanceof QQGroupBy) {
						$blnAddAllFieldsToSelect = false;
					}
				} else if (is_array($objOptionalClauses)) {
					foreach ($objOptionalClauses as $objClause) {
						if ($objClause instanceof QQAggregationClause || $objClause instanceof QQGroupBy) {
							$blnAddAllFieldsToSelect = false;
							break;
						}
					}
				}
			}
			if ($blnAddAllFieldsToSelect) {
				AuditLogEntry::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('AuditLogEntry');

			// Set "CountOnly" option (if applicable)
			if ($blnCountOnly)
				$objQueryBuilder->SetCountOnlyFlag();

			// Apply Any Conditions
			if ($objConditions)
				try {
					$objConditions->UpdateQueryBuilder($objQueryBuilder);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			// Iterate through all the Optional Clauses (if any) and perform accordingly
			if ($objOptionalClauses) {
				if ($objOptionalClauses instanceof QQClause)
					$objOptionalClauses->UpdateQueryBuilder($objQueryBuilder);
				else if (is_array($objOptionalClauses))
					foreach ($objOptionalClauses as $objClause)
						$objClause->UpdateQueryBuilder($objQueryBuilder);
				else
					throw new QCallerException('Optional Clauses must be a QQClause object or an array of QQClause objects');
			}

			// Get the SQL Statement
			$strQuery = $objQueryBuilder->GetStatement();

			// Prepare the Statement with the Query Parameters (if applicable)
			if ($mixParameterArray) {
				if (is_array($mixParameterArray)) {
					if (count($mixParameterArray))
						$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

					// Ensure that there are no other Unresolved Named Parameters
					if (strpos($strQuery, chr(QQNamedValue::DelimiterCode) . '{') !== false)
						throw new QCallerException('Unresolved named parameters in the query');
				} else
					throw new QCallerException('Parameter Array must be an array of name-value parameter pairs');
			}

			// Return the Objects
			return $strQuery;
		}

		/**
		 * Static Qcubed Query method to query for a single AuditLogEntry object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return AuditLogEntry the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = AuditLogEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new AuditLogEntry object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = AuditLogEntry::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
				if (count($objToReturn)) {
					// Since we only want the object to return, lets return the object and not the array.
					return $objToReturn[0];
				} else {
					return null;
				}
			} else {
				// No expands just return the first row
				$objDbRow = $objDbResult->GetNextRow();
				if(null === $objDbRow)
					return null;
				return AuditLogEntry::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of AuditLogEntry objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return AuditLogEntry[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = AuditLogEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return AuditLogEntry::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
		}

		/**
		 * Static Qcodo query method to issue a query and get a cursor to progressively fetch its results.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QDatabaseResultBase the cursor resource instance
		 */
		public static function QueryCursor(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the query statement
			try {
				$strQuery = AuditLogEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the query
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Return the results cursor
			$objDbResult->QueryBuilder = $objQueryBuilder;
			return $objDbResult;
		}

		/**
		 * Static Qcubed Query method to query for a count of AuditLogEntry objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = AuditLogEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and return the row_count
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Figure out if the query is using GroupBy
			$blnGrouped = false;

			if ($objOptionalClauses) {
				if ($objOptionalClauses instanceof QQClause) {
					if ($objOptionalClauses instanceof QQGroupBy) {
						$blnGrouped = true;
					}
				} else if (is_array($objOptionalClauses)) {
					foreach ($objOptionalClauses as $objClause) {
						if ($objClause instanceof QQGroupBy) {
							$blnGrouped = true;
							break;
						}
					}
				} else {
					throw new QCallerException('Optional Clauses must be a QQClause object or an array of QQClause objects');
				}
			}

			if ($blnGrouped)
				// Groups in this query - return the count of Groups (which is the count of all rows)
				return $objDbResult->CountRows();
			else {
				// No Groups - return the sql-calculated count(*) value
				$strDbRow = $objDbResult->FetchRow();
				return QType::Cast($strDbRow[0], QType::Integer);
			}
		}

		public static function QueryArrayCached(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = AuditLogEntry::GetDatabase();

			$strQuery = AuditLogEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/auditlogentry', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = AuditLogEntry::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this AuditLogEntry
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'AuditLogEntry';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'EntryTimeStamp', $strAliasPrefix . 'EntryTimeStamp');
			    $objBuilder->AddSelectItem($strTableName, 'ObjectName', $strAliasPrefix . 'ObjectName');
			    $objBuilder->AddSelectItem($strTableName, 'ModificationType', $strAliasPrefix . 'ModificationType');
			    $objBuilder->AddSelectItem($strTableName, 'UserEmail', $strAliasPrefix . 'UserEmail');
			    $objBuilder->AddSelectItem($strTableName, 'ObjectId', $strAliasPrefix . 'ObjectId');
			    $objBuilder->AddSelectItem($strTableName, 'AuditLogEntryDetail', $strAliasPrefix . 'AuditLogEntryDetail');
            }
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Do a possible array expansion on the given node. If the node is an ExpandAsArray node,
		 * it will add to the corresponding array in the object. Otherwise, it will follow the node
		 * so that any leaf expansions can be handled.
		 *  
		 * @param DatabaseRowBase $objDbRow
		 * @param QQBaseNode $objChildNode
		 * @param QBaseClass $objPreviousItem
		 * @param string[] $strColumnAliasArray
		 */
		
		public static function ExpandArray ($objDbRow, $strAliasPrefix, $objNode, $objPreviousItemArray, $strColumnAliasArray) {
			if (!$objNode->ChildNodeArray) {
				return false;
			}
			
			$strAlias = $strAliasPrefix . 'Id';
			$strColumnAlias = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$blnExpanded = false;
			
			foreach ($objPreviousItemArray as $objPreviousItem) {
				if ($objPreviousItem->intId != $objDbRow->GetColumn($strColumnAlias, 'Integer')) {
					continue;
				}
				
				foreach ($objNode->ChildNodeArray as $objChildNode) {	
					$strPropName = $objChildNode->_PropertyName;
					$strClassName = $objChildNode->_ClassName;
					$blnExpanded = false;
					$strLongAlias = $objChildNode->ExtendedAlias();
				
					if ($objChildNode->ExpandAsArray) {
						$strVarName = '_obj' . $strPropName . 'Array';
						if (null === $objPreviousItem->$strVarName) {
							$objPreviousItem->$strVarName = array();
						}
						if ($intPreviousChildItemCount = count($objPreviousItem->$strVarName)) {
							$objPreviousChildItems = $objPreviousItem->$strVarName;
							if ($objChildNode->_Type == "association") {
								$objChildNode = $objChildNode->FirstChild();
							}
							$nextAlias = $objChildNode->ExtendedAlias() . '__';
							
							$objChildItem = call_user_func(array ($strClassName, 'InstantiateDbRow'), $objDbRow, $nextAlias, $objChildNode, $objPreviousChildItems, $strColumnAliasArray);
							if ($objChildItem) {
								$objPreviousItem->{$strVarName}[] = $objChildItem;
								$blnExpanded = true;
							} elseif ($objChildItem === false) {
								$blnExpanded = true;
							}
						}
					} else {
	
						// Follow single node if keys match
						$nodeType = $objChildNode->_Type;
						if ($nodeType == 'reverse_reference' || $nodeType == 'association') {
							$strVarName = '_obj' . $strPropName;
						} else {	
							$strVarName = 'obj' . $strPropName;
						}
						
						if (null === $objPreviousItem->$strVarName) {
							return false;
						}
											
						$objPreviousChildItems = array($objPreviousItem->$strVarName);
						$blnResult = call_user_func(array ($strClassName, 'ExpandArray'), $objDbRow, $strLongAlias . '__', $objChildNode, $objPreviousChildItems, $strColumnAliasArray);
		
						if ($blnResult) {
							$blnExpanded = true;
						}		
					}
				}	
			}
			return $blnExpanded;
		}
		
		/**
		 * Instantiate a AuditLogEntry from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this AuditLogEntry::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a AuditLogEntry, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $objExpandAsArrayNode = null, $objPreviousItemArray = null, $strColumnAliasArray = array()) {
			// If blank row, return null
			if (!$objDbRow) {
				return null;
			}
			
			if (empty ($strAliasPrefix) && $objPreviousItemArray) {
				$strColumnAlias = !empty($strColumnAliasArray['Id']) ? $strColumnAliasArray['Id'] : 'Id';
				$key = $objDbRow->GetColumn($strColumnAlias, 'Integer');
				$objPreviousItemArray = (!empty ($objPreviousItemArray[$key]) ? $objPreviousItemArray[$key] : null);
			}
			
			

			// Create a new instance of the AuditLogEntry object
			$objToReturn = new AuditLogEntry();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'EntryTimeStamp';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttEntryTimeStamp = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAlias = $strAliasPrefix . 'ObjectName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strObjectName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'ModificationType';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strModificationType = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'UserEmail';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strUserEmail = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'ObjectId';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strObjectId = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'AuditLogEntryDetail';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strAuditLogEntryDetail = $objDbRow->GetColumn($strAliasName, 'Blob');

			if (isset($objPreviousItemArray) && is_array($objPreviousItemArray)) {
				foreach ($objPreviousItemArray as $objPreviousItem) {
					if ($objToReturn->Id != $objPreviousItem->Id) {
						continue;
					}
					// this is a duplicate leaf in a complex join
					return null; // indicates no object created and the db row has not been used
				}
			}
			
			// Instantiate Virtual Attributes
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				if (strncmp($strColumnName, $strVirtualPrefix, $strVirtualPrefixLength) == 0)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}


			// Prepare to Check for Early/Virtual Binding

			$objExpansionAliasArray = array();
			if ($objExpandAsArrayNode) {
				$objExpansionAliasArray = $objExpandAsArrayNode->ChildNodeArray;
			}

			if (!$strAliasPrefix)
				$strAliasPrefix = 'AuditLogEntry__';


				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of AuditLogEntries from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return AuditLogEntry[]
		 */
		public static function InstantiateDbResult(QDatabaseResultBase $objDbResult, $objExpandAsArrayNode = null, $strColumnAliasArray = null) {
			$objToReturn = array();

			if (!$strColumnAliasArray)
				$strColumnAliasArray = array();

			// If blank resultset, then return empty array
			if (!$objDbResult)
				return $objToReturn;

			// Load up the return array with each row
			if ($objExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = AuditLogEntry::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = AuditLogEntry::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single AuditLogEntry object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return AuditLogEntry next row resulting from the query
		 */
		public static function InstantiateCursor(QDatabaseResultBase $objDbResult) {
			// If blank resultset, then return empty result
			if (!$objDbResult) return null;

			// If empty resultset, then return empty result
			$objDbRow = $objDbResult->GetNextRow();
			if (!$objDbRow) return null;

			// We need the Column Aliases
			$strColumnAliasArray = $objDbResult->QueryBuilder->ColumnAliasArray;
			if (!$strColumnAliasArray) $strColumnAliasArray = array();

			// Pull Expansions
			$objExpandAsArrayNode = $objDbResult->QueryBuilder->ExpandAsArrayNode;
			if (!empty ($objExpandAsArrayNode)) {
				throw new QCallerException ("Cannot use InstantiateCursor with ExpandAsArray");
			}

			// Load up the return result with a row and return it
			return AuditLogEntry::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single AuditLogEntry object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AuditLogEntry
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return AuditLogEntry::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::AuditLogEntry()->Id, $intId)
				),
				$objOptionalClauses
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
		 * Save this AuditLogEntry
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = AuditLogEntry::GetDatabase();

			$mixToReturn = null;
			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `AuditLogEntry` (
							`EntryTimeStamp`,
							`ObjectName`,
							`ModificationType`,
							`UserEmail`,
							`ObjectId`,
							`AuditLogEntryDetail`
						) VALUES (
							' . $objDatabase->SqlVariable($this->dttEntryTimeStamp) . ',
							' . $objDatabase->SqlVariable($this->strObjectName) . ',
							' . $objDatabase->SqlVariable($this->strModificationType) . ',
							' . $objDatabase->SqlVariable($this->strUserEmail) . ',
							' . $objDatabase->SqlVariable($this->strObjectId) . ',
							' . $objDatabase->SqlVariable($this->strAuditLogEntryDetail) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('AuditLogEntry', 'Id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`AuditLogEntry`
						SET
							`EntryTimeStamp` = ' . $objDatabase->SqlVariable($this->dttEntryTimeStamp) . ',
							`ObjectName` = ' . $objDatabase->SqlVariable($this->strObjectName) . ',
							`ModificationType` = ' . $objDatabase->SqlVariable($this->strModificationType) . ',
							`UserEmail` = ' . $objDatabase->SqlVariable($this->strUserEmail) . ',
							`ObjectId` = ' . $objDatabase->SqlVariable($this->strObjectId) . ',
							`AuditLogEntryDetail` = ' . $objDatabase->SqlVariable($this->strAuditLogEntryDetail) . '
						WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '
					');
				}

			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Update __blnRestored and any Non-Identity PK Columns (if applicable)
			$this->__blnRestored = true;

            /*Work in progress
            $newAuditLogEntry->ObjectId = $this->intId;
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                AppSpecificFunctions::AddCustomLog('Could not save audit log while saving AuditLogEntry. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }*/
			$this->DeleteCache();

			// Return
			return $mixToReturn;
		}

		/**
		 * Delete this AuditLogEntry
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this AuditLogEntry with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = AuditLogEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`AuditLogEntry`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this AuditLogEntry ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'AuditLogEntry', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all AuditLogEntries
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = AuditLogEntry::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`AuditLogEntry`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate AuditLogEntry table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = AuditLogEntry::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `AuditLogEntry`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this AuditLogEntry from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved AuditLogEntry object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = AuditLogEntry::Load($this->intId);

			// Update $this's local variables to match
			$this->dttEntryTimeStamp = $objReloaded->dttEntryTimeStamp;
			$this->strObjectName = $objReloaded->strObjectName;
			$this->strModificationType = $objReloaded->strModificationType;
			$this->strUserEmail = $objReloaded->strUserEmail;
			$this->strObjectId = $objReloaded->strObjectId;
			$this->strAuditLogEntryDetail = $objReloaded->strAuditLogEntryDetail;
		}



		////////////////////
		// PUBLIC OVERRIDERS
		////////////////////

				/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'Id':
					/**
					 * Gets the value for intId (Read-Only PK)
					 * @return integer
					 */
					return $this->intId;

				case 'EntryTimeStamp':
					/**
					 * Gets the value for dttEntryTimeStamp 
					 * @return QDateTime
					 */
					return $this->dttEntryTimeStamp;

				case 'ObjectName':
					/**
					 * Gets the value for strObjectName 
					 * @return string
					 */
					return $this->strObjectName;

				case 'ModificationType':
					/**
					 * Gets the value for strModificationType 
					 * @return string
					 */
					return $this->strModificationType;

				case 'UserEmail':
					/**
					 * Gets the value for strUserEmail 
					 * @return string
					 */
					return $this->strUserEmail;

				case 'ObjectId':
					/**
					 * Gets the value for strObjectId 
					 * @return string
					 */
					return $this->strObjectId;

				case 'AuditLogEntryDetail':
					/**
					 * Gets the value for strAuditLogEntryDetail 
					 * @return string
					 */
					return $this->strAuditLogEntryDetail;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////


				case '__Restored':
					return $this->__blnRestored;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

				/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'EntryTimeStamp':
					/**
					 * Sets the value for dttEntryTimeStamp 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttEntryTimeStamp = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ObjectName':
					/**
					 * Sets the value for strObjectName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strObjectName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ModificationType':
					/**
					 * Sets the value for strModificationType 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strModificationType = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'UserEmail':
					/**
					 * Sets the value for strUserEmail 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUserEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ObjectId':
					/**
					 * Sets the value for strObjectId 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strObjectId = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AuditLogEntryDetail':
					/**
					 * Sets the value for strAuditLogEntryDetail 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAuditLogEntryDetail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Lookup a VirtualAttribute value (if applicable).  Returns NULL if none found.
		 * @param string $strName
		 * @return string
		 */
		public function GetVirtualAttribute($strName) {
			if (array_key_exists($strName, $this->__strVirtualAttributeArray))
				return $this->__strVirtualAttributeArray[$strName];
			return null;
		}



		///////////////////////////////
		// ASSOCIATED OBJECTS' METHODS
		///////////////////////////////



		
		///////////////////////////////
		// METHODS TO EXTRACT INFO ABOUT THE CLASS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetTableName() {
			return "AuditLogEntry";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[AuditLogEntry::GetDatabaseIndex()]->Database;
		}

		/**
		 * Static method to retrieve the Database index in the configuration.inc.php file.
		 * This can be useful when there are two databases of the same name which create
		 * confusion for the developer. There are no internal uses of this function but are
		 * here to help retrieve info if need be!
		 * @return int position or index of the database in the config file.
		 */
		public static function GetDatabaseIndex() {
			return 1;
		}

		////////////////////////////////////////
		// METHODS for SOAP-BASED WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="AuditLogEntry"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="EntryTimeStamp" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ObjectName" type="xsd:string"/>';
			$strToReturn .= '<element name="ModificationType" type="xsd:string"/>';
			$strToReturn .= '<element name="UserEmail" type="xsd:string"/>';
			$strToReturn .= '<element name="ObjectId" type="xsd:string"/>';
			$strToReturn .= '<element name="AuditLogEntryDetail" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('AuditLogEntry', $strComplexTypeArray)) {
				$strComplexTypeArray['AuditLogEntry'] = AuditLogEntry::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, AuditLogEntry::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new AuditLogEntry();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'EntryTimeStamp'))
				$objToReturn->dttEntryTimeStamp = new QDateTime($objSoapObject->EntryTimeStamp);
			if (property_exists($objSoapObject, 'ObjectName'))
				$objToReturn->strObjectName = $objSoapObject->ObjectName;
			if (property_exists($objSoapObject, 'ModificationType'))
				$objToReturn->strModificationType = $objSoapObject->ModificationType;
			if (property_exists($objSoapObject, 'UserEmail'))
				$objToReturn->strUserEmail = $objSoapObject->UserEmail;
			if (property_exists($objSoapObject, 'ObjectId'))
				$objToReturn->strObjectId = $objSoapObject->ObjectId;
			if (property_exists($objSoapObject, 'AuditLogEntryDetail'))
				$objToReturn->strAuditLogEntryDetail = $objSoapObject->AuditLogEntryDetail;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, AuditLogEntry::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttEntryTimeStamp)
				$objObject->dttEntryTimeStamp = $objObject->dttEntryTimeStamp->qFormat(QDateTime::FormatSoap);
			return $objObject;
		}


		////////////////////////////////////////
		// METHODS for JSON Object Translation
		////////////////////////////////////////

		// this function is required for objects that implement the
		// IteratorAggregate interface
		public function getIterator() {
			///////////////////
			// Member Variables
			///////////////////
			$iArray['Id'] = $this->intId;
			$iArray['EntryTimeStamp'] = $this->dttEntryTimeStamp;
			$iArray['ObjectName'] = $this->strObjectName;
			$iArray['ModificationType'] = $this->strModificationType;
			$iArray['UserEmail'] = $this->strUserEmail;
			$iArray['ObjectId'] = $this->strObjectId;
			$iArray['AuditLogEntryDetail'] = $this->strAuditLogEntryDetail;
			return new ArrayIterator($iArray);
		}

		// this function returns a Json formatted string using the
		// IteratorAggregate interface
		public function getJson() {
			return json_encode($this->getIterator());
		}

		/**
		 * Default "toJsObject" handler
		 * Specifies how the object should be displayed in JQuery UI lists and menus. Note that these lists use
		 * value and label differently.
		 *
		 * value 	= The short form of what to display in the list and selection.
		 * label 	= [optional] If defined, is what is displayed in the menu
		 * id 		= Primary key of object.
		 *
		 * @return an array that specifies how to display the object
		 */
		public function toJsObject () {
			return JavaScriptHelper::toJsObject(array('value' => $this->__toString(), 'id' =>  $this->intId ));
		}



	}



	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCubed QUERY
	/////////////////////////////////////

    /**
     * @uses QQNode
     *
     * @property-read QQNode $Id
     * @property-read QQNode $EntryTimeStamp
     * @property-read QQNode $ObjectName
     * @property-read QQNode $ModificationType
     * @property-read QQNode $UserEmail
     * @property-read QQNode $ObjectId
     * @property-read QQNode $AuditLogEntryDetail
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeAuditLogEntry extends QQNode {
		protected $strTableName = 'AuditLogEntry';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'AuditLogEntry';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'EntryTimeStamp':
					return new QQNode('EntryTimeStamp', 'EntryTimeStamp', 'DateTime', $this);
				case 'ObjectName':
					return new QQNode('ObjectName', 'ObjectName', 'VarChar', $this);
				case 'ModificationType':
					return new QQNode('ModificationType', 'ModificationType', 'VarChar', $this);
				case 'UserEmail':
					return new QQNode('UserEmail', 'UserEmail', 'VarChar', $this);
				case 'ObjectId':
					return new QQNode('ObjectId', 'ObjectId', 'Blob', $this);
				case 'AuditLogEntryDetail':
					return new QQNode('AuditLogEntryDetail', 'AuditLogEntryDetail', 'Blob', $this);

				case '_PrimaryKeyNode':
					return new QQNode('Id', 'Id', 'Integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

    /**
     * @property-read QQNode $Id
     * @property-read QQNode $EntryTimeStamp
     * @property-read QQNode $ObjectName
     * @property-read QQNode $ModificationType
     * @property-read QQNode $UserEmail
     * @property-read QQNode $ObjectId
     * @property-read QQNode $AuditLogEntryDetail
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeAuditLogEntry extends QQReverseReferenceNode {
		protected $strTableName = 'AuditLogEntry';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'AuditLogEntry';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'EntryTimeStamp':
					return new QQNode('EntryTimeStamp', 'EntryTimeStamp', 'QDateTime', $this);
				case 'ObjectName':
					return new QQNode('ObjectName', 'ObjectName', 'string', $this);
				case 'ModificationType':
					return new QQNode('ModificationType', 'ModificationType', 'string', $this);
				case 'UserEmail':
					return new QQNode('UserEmail', 'UserEmail', 'string', $this);
				case 'ObjectId':
					return new QQNode('ObjectId', 'ObjectId', 'string', $this);
				case 'AuditLogEntryDetail':
					return new QQNode('AuditLogEntryDetail', 'AuditLogEntryDetail', 'string', $this);

				case '_PrimaryKeyNode':
					return new QQNode('Id', 'Id', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

?>
