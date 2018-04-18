<?php
	/**
	 * The abstract EmploymentHistoryGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the EmploymentHistory subclass which
	 * extends this EmploymentHistoryGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the EmploymentHistory class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property QDateTime $PeriodStartDate the value for dttPeriodStartDate 
	 * @property QDateTime $PeriodEndDate the value for dttPeriodEndDate 
	 * @property string $EmployerName the value for strEmployerName 
	 * @property string $Title the value for strTitle 
	 * @property string $Duties the value for strDuties 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $Person the value for intPerson 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property integer $FileDocument the value for intFileDocument 
	 * @property Person $PersonObject the value for the Person object referenced by intPerson 
	 * @property FileDocument $FileDocumentObject the value for the FileDocument object referenced by intFileDocument 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class EmploymentHistoryGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column EmploymentHistory.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.PeriodStartDate
		 * @var QDateTime dttPeriodStartDate
		 */
		protected $dttPeriodStartDate;
		const PeriodStartDateDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.PeriodEndDate
		 * @var QDateTime dttPeriodEndDate
		 */
		protected $dttPeriodEndDate;
		const PeriodEndDateDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.EmployerName
		 * @var string strEmployerName
		 */
		protected $strEmployerName;
		const EmployerNameMaxLength = 50;
		const EmployerNameDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.Title
		 * @var string strTitle
		 */
		protected $strTitle;
		const TitleMaxLength = 10;
		const TitleDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.Duties
		 * @var string strDuties
		 */
		protected $strDuties;
		const DutiesMaxLength = 20;
		const DutiesDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.Person
		 * @var integer intPerson
		 */
		protected $intPerson;
		const PersonDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column EmploymentHistory.FileDocument
		 * @var integer intFileDocument
		 */
		protected $intFileDocument;
		const FileDocumentDefault = null;


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
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column EmploymentHistory.Person.
		 *
		 * NOTE: Always use the PersonObject property getter to correctly retrieve this Person object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Person objPersonObject
		 */
		protected $objPersonObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column EmploymentHistory.FileDocument.
		 *
		 * NOTE: Always use the FileDocumentObject property getter to correctly retrieve this FileDocument object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var FileDocument objFileDocumentObject
		 */
		protected $objFileDocumentObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = EmploymentHistory::IdDefault;
			$this->dttPeriodStartDate = (EmploymentHistory::PeriodStartDateDefault === null)?null:new QDateTime(EmploymentHistory::PeriodStartDateDefault);
			$this->dttPeriodEndDate = (EmploymentHistory::PeriodEndDateDefault === null)?null:new QDateTime(EmploymentHistory::PeriodEndDateDefault);
			$this->strEmployerName = EmploymentHistory::EmployerNameDefault;
			$this->strTitle = EmploymentHistory::TitleDefault;
			$this->strDuties = EmploymentHistory::DutiesDefault;
			$this->strLastUpdated = EmploymentHistory::LastUpdatedDefault;
			$this->intPerson = EmploymentHistory::PersonDefault;
			$this->strSearchMetaInfo = EmploymentHistory::SearchMetaInfoDefault;
			$this->intFileDocument = EmploymentHistory::FileDocumentDefault;
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
		 * Load a EmploymentHistory from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmploymentHistory
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmploymentHistory', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = EmploymentHistory::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmploymentHistory()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all EmploymentHistories
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmploymentHistory[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call EmploymentHistory::QueryArray to perform the LoadAll query
			try {
				return EmploymentHistory::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all EmploymentHistories
		 * @return int
		 */
		public static function CountAll() {
			// Call EmploymentHistory::QueryCount to perform the CountAll query
			return EmploymentHistory::QueryCount(QQ::All());
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
			$objDatabase = EmploymentHistory::GetDatabase();

			// Create/Build out the QueryBuilder object with EmploymentHistory-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'EmploymentHistory');

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
				EmploymentHistory::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('EmploymentHistory');

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
		 * Static Qcubed Query method to query for a single EmploymentHistory object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmploymentHistory the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmploymentHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new EmploymentHistory object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = EmploymentHistory::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return EmploymentHistory::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of EmploymentHistory objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmploymentHistory[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmploymentHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return EmploymentHistory::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = EmploymentHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of EmploymentHistory objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmploymentHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = EmploymentHistory::GetDatabase();

			$strQuery = EmploymentHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/employmenthistory', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = EmploymentHistory::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this EmploymentHistory
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'EmploymentHistory';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'PeriodStartDate', $strAliasPrefix . 'PeriodStartDate');
			    $objBuilder->AddSelectItem($strTableName, 'PeriodEndDate', $strAliasPrefix . 'PeriodEndDate');
			    $objBuilder->AddSelectItem($strTableName, 'EmployerName', $strAliasPrefix . 'EmployerName');
			    $objBuilder->AddSelectItem($strTableName, 'Title', $strAliasPrefix . 'Title');
			    $objBuilder->AddSelectItem($strTableName, 'Duties', $strAliasPrefix . 'Duties');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'Person', $strAliasPrefix . 'Person');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
			    $objBuilder->AddSelectItem($strTableName, 'FileDocument', $strAliasPrefix . 'FileDocument');
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
		 * Instantiate a EmploymentHistory from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this EmploymentHistory::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a EmploymentHistory, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
			
			
			// See if we're doing an array expansion on the previous item
			if ($objExpandAsArrayNode && 
					is_array($objPreviousItemArray) && 
					count($objPreviousItemArray)) {

				if (EmploymentHistory::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the EmploymentHistory object
			$objToReturn = new EmploymentHistory();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'PeriodStartDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttPeriodStartDate = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'PeriodEndDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttPeriodEndDate = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'EmployerName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strEmployerName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Title';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strTitle = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Duties';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strDuties = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Person';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intPerson = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'FileDocument';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intFileDocument = $objDbRow->GetColumn($strAliasName, 'Integer');

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
				$strAliasPrefix = 'EmploymentHistory__';

			// Check for PersonObject Early Binding
			$strAlias = $strAliasPrefix . 'Person__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Person']) ? null : $objExpansionAliasArray['Person']);
				$objToReturn->objPersonObject = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Person__', $objExpansionNode, null, $strColumnAliasArray);
			}
			// Check for FileDocumentObject Early Binding
			$strAlias = $strAliasPrefix . 'FileDocument__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['FileDocument']) ? null : $objExpansionAliasArray['FileDocument']);
				$objToReturn->objFileDocumentObject = FileDocument::InstantiateDbRow($objDbRow, $strAliasPrefix . 'FileDocument__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of EmploymentHistories from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return EmploymentHistory[]
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
					$objItem = EmploymentHistory::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = EmploymentHistory::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single EmploymentHistory object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return EmploymentHistory next row resulting from the query
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
			return EmploymentHistory::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single EmploymentHistory object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmploymentHistory
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return EmploymentHistory::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmploymentHistory()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of EmploymentHistory objects,
		 * by Person Index(es)
		 * @param integer $intPerson
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmploymentHistory[]
		*/
		public static function LoadArrayByPerson($intPerson, $objOptionalClauses = null) {
			// Call EmploymentHistory::QueryArray to perform the LoadArrayByPerson query
			try {
				return EmploymentHistory::QueryArray(
					QQ::Equal(QQN::EmploymentHistory()->Person, $intPerson),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count EmploymentHistories
		 * by Person Index(es)
		 * @param integer $intPerson
		 * @return int
		*/
		public static function CountByPerson($intPerson) {
			// Call EmploymentHistory::QueryCount to perform the CountByPerson query
			return EmploymentHistory::QueryCount(
				QQ::Equal(QQN::EmploymentHistory()->Person, $intPerson)
			);
		}

		/**
		 * Load an array of EmploymentHistory objects,
		 * by FileDocument Index(es)
		 * @param integer $intFileDocument
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmploymentHistory[]
		*/
		public static function LoadArrayByFileDocument($intFileDocument, $objOptionalClauses = null) {
			// Call EmploymentHistory::QueryArray to perform the LoadArrayByFileDocument query
			try {
				return EmploymentHistory::QueryArray(
					QQ::Equal(QQN::EmploymentHistory()->FileDocument, $intFileDocument),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count EmploymentHistories
		 * by FileDocument Index(es)
		 * @param integer $intFileDocument
		 * @return int
		*/
		public static function CountByFileDocument($intFileDocument) {
			// Call EmploymentHistory::QueryCount to perform the CountByFileDocument query
			return EmploymentHistory::QueryCount(
				QQ::Equal(QQN::EmploymentHistory()->FileDocument, $intFileDocument)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this EmploymentHistory
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = EmploymentHistory::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = EmploymentHistory::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmploymentHistory';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("PeriodStartDate" => $this->dttPeriodStartDate));
                $ChangedArray = array_merge($ChangedArray,array("PeriodEndDate" => $this->dttPeriodEndDate));
                $ChangedArray = array_merge($ChangedArray,array("EmployerName" => $this->strEmployerName));
                $ChangedArray = array_merge($ChangedArray,array("Title" => $this->strTitle));
                $ChangedArray = array_merge($ChangedArray,array("Duties" => $this->strDuties));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("Person" => $this->intPerson));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
                $ChangedArray = array_merge($ChangedArray,array("FileDocument" => $this->intFileDocument));
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            } else {
                $newAuditLogEntry->ModificationType = 'Update';
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Id)) {
                    $ExistingValueStr = $ExistingObj->Id;
                }
                if ($ExistingObj->Id != $this->intId) {
                    $ChangedArray = array_merge($ChangedArray,array("Id" => array("Before" => $ExistingValueStr,"After" => $this->intId)));
                    //$ChangedArray = array_merge($ChangedArray,array("Id" => "From: ".$ExistingValueStr." to: ".$this->intId));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->PeriodStartDate)) {
                    $ExistingValueStr = $ExistingObj->PeriodStartDate;
                }
                if ($ExistingObj->PeriodStartDate != $this->dttPeriodStartDate) {
                    $ChangedArray = array_merge($ChangedArray,array("PeriodStartDate" => array("Before" => $ExistingValueStr,"After" => $this->dttPeriodStartDate)));
                    //$ChangedArray = array_merge($ChangedArray,array("PeriodStartDate" => "From: ".$ExistingValueStr." to: ".$this->dttPeriodStartDate));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->PeriodEndDate)) {
                    $ExistingValueStr = $ExistingObj->PeriodEndDate;
                }
                if ($ExistingObj->PeriodEndDate != $this->dttPeriodEndDate) {
                    $ChangedArray = array_merge($ChangedArray,array("PeriodEndDate" => array("Before" => $ExistingValueStr,"After" => $this->dttPeriodEndDate)));
                    //$ChangedArray = array_merge($ChangedArray,array("PeriodEndDate" => "From: ".$ExistingValueStr." to: ".$this->dttPeriodEndDate));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->EmployerName)) {
                    $ExistingValueStr = $ExistingObj->EmployerName;
                }
                if ($ExistingObj->EmployerName != $this->strEmployerName) {
                    $ChangedArray = array_merge($ChangedArray,array("EmployerName" => array("Before" => $ExistingValueStr,"After" => $this->strEmployerName)));
                    //$ChangedArray = array_merge($ChangedArray,array("EmployerName" => "From: ".$ExistingValueStr." to: ".$this->strEmployerName));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Title)) {
                    $ExistingValueStr = $ExistingObj->Title;
                }
                if ($ExistingObj->Title != $this->strTitle) {
                    $ChangedArray = array_merge($ChangedArray,array("Title" => array("Before" => $ExistingValueStr,"After" => $this->strTitle)));
                    //$ChangedArray = array_merge($ChangedArray,array("Title" => "From: ".$ExistingValueStr." to: ".$this->strTitle));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Duties)) {
                    $ExistingValueStr = $ExistingObj->Duties;
                }
                if ($ExistingObj->Duties != $this->strDuties) {
                    $ChangedArray = array_merge($ChangedArray,array("Duties" => array("Before" => $ExistingValueStr,"After" => $this->strDuties)));
                    //$ChangedArray = array_merge($ChangedArray,array("Duties" => "From: ".$ExistingValueStr." to: ".$this->strDuties));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->LastUpdated)) {
                    $ExistingValueStr = $ExistingObj->LastUpdated;
                }
                if ($ExistingObj->LastUpdated != $this->strLastUpdated) {
                    $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => array("Before" => $ExistingValueStr,"After" => $this->strLastUpdated)));
                    //$ChangedArray = array_merge($ChangedArray,array("LastUpdated" => "From: ".$ExistingValueStr." to: ".$this->strLastUpdated));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Person)) {
                    $ExistingValueStr = $ExistingObj->Person;
                }
                if ($ExistingObj->Person != $this->intPerson) {
                    $ChangedArray = array_merge($ChangedArray,array("Person" => array("Before" => $ExistingValueStr,"After" => $this->intPerson)));
                    //$ChangedArray = array_merge($ChangedArray,array("Person" => "From: ".$ExistingValueStr." to: ".$this->intPerson));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->SearchMetaInfo)) {
                    $ExistingValueStr = $ExistingObj->SearchMetaInfo;
                }
                if ($ExistingObj->SearchMetaInfo != $this->strSearchMetaInfo) {
                    $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => array("Before" => $ExistingValueStr,"After" => $this->strSearchMetaInfo)));
                    //$ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => "From: ".$ExistingValueStr." to: ".$this->strSearchMetaInfo));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->FileDocument)) {
                    $ExistingValueStr = $ExistingObj->FileDocument;
                }
                if ($ExistingObj->FileDocument != $this->intFileDocument) {
                    $ChangedArray = array_merge($ChangedArray,array("FileDocument" => array("Before" => $ExistingValueStr,"After" => $this->intFileDocument)));
                    //$ChangedArray = array_merge($ChangedArray,array("FileDocument" => "From: ".$ExistingValueStr." to: ".$this->intFileDocument));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `EmploymentHistory` (
							`PeriodStartDate`,
							`PeriodEndDate`,
							`EmployerName`,
							`Title`,
							`Duties`,
							`Person`,
							`SearchMetaInfo`,
							`FileDocument`
						) VALUES (
							' . $objDatabase->SqlVariable($this->dttPeriodStartDate) . ',
							' . $objDatabase->SqlVariable($this->dttPeriodEndDate) . ',
							' . $objDatabase->SqlVariable($this->strEmployerName) . ',
							' . $objDatabase->SqlVariable($this->strTitle) . ',
							' . $objDatabase->SqlVariable($this->strDuties) . ',
							' . $objDatabase->SqlVariable($this->intPerson) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->intFileDocument) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('EmploymentHistory', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
							
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `EmploymentHistory` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('EmploymentHistory');
                }
				
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `EmploymentHistory` SET
							`PeriodStartDate` = ' . $objDatabase->SqlVariable($this->dttPeriodStartDate) . ',
							`PeriodEndDate` = ' . $objDatabase->SqlVariable($this->dttPeriodEndDate) . ',
							`EmployerName` = ' . $objDatabase->SqlVariable($this->strEmployerName) . ',
							`Title` = ' . $objDatabase->SqlVariable($this->strTitle) . ',
							`Duties` = ' . $objDatabase->SqlVariable($this->strDuties) . ',
							`Person` = ' . $objDatabase->SqlVariable($this->intPerson) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							`FileDocument` = ' . $objDatabase->SqlVariable($this->intFileDocument) . '
                WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');
                }

            } catch (QCallerException $objExc) {
                $objExc->IncrementOffset();
                throw $objExc;
            }
            try {
                $newAuditLogEntry->ObjectId = $this->intId;
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while saving EmploymentHistory. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
							            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `EmploymentHistory` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
				
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this EmploymentHistory
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this EmploymentHistory with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = EmploymentHistory::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmploymentHistory';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("PeriodStartDate" => $this->dttPeriodStartDate));
            $ChangedArray = array_merge($ChangedArray,array("PeriodEndDate" => $this->dttPeriodEndDate));
            $ChangedArray = array_merge($ChangedArray,array("EmployerName" => $this->strEmployerName));
            $ChangedArray = array_merge($ChangedArray,array("Title" => $this->strTitle));
            $ChangedArray = array_merge($ChangedArray,array("Duties" => $this->strDuties));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("Person" => $this->intPerson));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("FileDocument" => $this->intFileDocument));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting EmploymentHistory. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmploymentHistory`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this EmploymentHistory ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmploymentHistory', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all EmploymentHistories
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = EmploymentHistory::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmploymentHistory`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate EmploymentHistory table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = EmploymentHistory::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `EmploymentHistory`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this EmploymentHistory from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved EmploymentHistory object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = EmploymentHistory::Load($this->intId);

			// Update $this's local variables to match
			$this->dttPeriodStartDate = $objReloaded->dttPeriodStartDate;
			$this->dttPeriodEndDate = $objReloaded->dttPeriodEndDate;
			$this->strEmployerName = $objReloaded->strEmployerName;
			$this->strTitle = $objReloaded->strTitle;
			$this->strDuties = $objReloaded->strDuties;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->Person = $objReloaded->Person;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
			$this->FileDocument = $objReloaded->FileDocument;
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

				case 'PeriodStartDate':
					/**
					 * Gets the value for dttPeriodStartDate 
					 * @return QDateTime
					 */
					return $this->dttPeriodStartDate;

				case 'PeriodEndDate':
					/**
					 * Gets the value for dttPeriodEndDate 
					 * @return QDateTime
					 */
					return $this->dttPeriodEndDate;

				case 'EmployerName':
					/**
					 * Gets the value for strEmployerName 
					 * @return string
					 */
					return $this->strEmployerName;

				case 'Title':
					/**
					 * Gets the value for strTitle 
					 * @return string
					 */
					return $this->strTitle;

				case 'Duties':
					/**
					 * Gets the value for strDuties 
					 * @return string
					 */
					return $this->strDuties;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'Person':
					/**
					 * Gets the value for intPerson 
					 * @return integer
					 */
					return $this->intPerson;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;

				case 'FileDocument':
					/**
					 * Gets the value for intFileDocument 
					 * @return integer
					 */
					return $this->intFileDocument;


				///////////////////
				// Member Objects
				///////////////////
				case 'PersonObject':
					/**
					 * Gets the value for the Person object referenced by intPerson 
					 * @return Person
					 */
					try {
						if ((!$this->objPersonObject) && (!is_null($this->intPerson)))
							$this->objPersonObject = Person::Load($this->intPerson);
						return $this->objPersonObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FileDocumentObject':
					/**
					 * Gets the value for the FileDocument object referenced by intFileDocument 
					 * @return FileDocument
					 */
					try {
						if ((!$this->objFileDocumentObject) && (!is_null($this->intFileDocument)))
							$this->objFileDocumentObject = FileDocument::Load($this->intFileDocument);
						return $this->objFileDocumentObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


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
				case 'PeriodStartDate':
					/**
					 * Sets the value for dttPeriodStartDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttPeriodStartDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PeriodEndDate':
					/**
					 * Sets the value for dttPeriodEndDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttPeriodEndDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EmployerName':
					/**
					 * Sets the value for strEmployerName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEmployerName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Title':
					/**
					 * Sets the value for strTitle 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strTitle = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Duties':
					/**
					 * Sets the value for strDuties 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strDuties = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Person':
					/**
					 * Sets the value for intPerson 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objPersonObject = null;
						return ($this->intPerson = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SearchMetaInfo':
					/**
					 * Sets the value for strSearchMetaInfo 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strSearchMetaInfo = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FileDocument':
					/**
					 * Sets the value for intFileDocument 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objFileDocumentObject = null;
						return ($this->intFileDocument = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'PersonObject':
					/**
					 * Sets the value for the Person object referenced by intPerson 
					 * @param Person $mixValue
					 * @return Person
					 */
					if (is_null($mixValue)) {
						$this->intPerson = null;
						$this->objPersonObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Person object
						try {
							$mixValue = QType::Cast($mixValue, 'Person');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Person object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved PersonObject for this EmploymentHistory');

						// Update Local Member Variables
						$this->objPersonObject = $mixValue;
						$this->intPerson = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'FileDocumentObject':
					/**
					 * Sets the value for the FileDocument object referenced by intFileDocument 
					 * @param FileDocument $mixValue
					 * @return FileDocument
					 */
					if (is_null($mixValue)) {
						$this->intFileDocument = null;
						$this->objFileDocumentObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a FileDocument object
						try {
							$mixValue = QType::Cast($mixValue, 'FileDocument');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED FileDocument object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved FileDocumentObject for this EmploymentHistory');

						// Update Local Member Variables
						$this->objFileDocumentObject = $mixValue;
						$this->intFileDocument = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

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
			return "EmploymentHistory";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[EmploymentHistory::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="EmploymentHistory"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="PeriodStartDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="PeriodEndDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="EmployerName" type="xsd:string"/>';
			$strToReturn .= '<element name="Title" type="xsd:string"/>';
			$strToReturn .= '<element name="Duties" type="xsd:string"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="PersonObject" type="xsd1:Person"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="FileDocumentObject" type="xsd1:FileDocument"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('EmploymentHistory', $strComplexTypeArray)) {
				$strComplexTypeArray['EmploymentHistory'] = EmploymentHistory::GetSoapComplexTypeXml();
				Person::AlterSoapComplexTypeArray($strComplexTypeArray);
				FileDocument::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, EmploymentHistory::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new EmploymentHistory();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'PeriodStartDate'))
				$objToReturn->dttPeriodStartDate = new QDateTime($objSoapObject->PeriodStartDate);
			if (property_exists($objSoapObject, 'PeriodEndDate'))
				$objToReturn->dttPeriodEndDate = new QDateTime($objSoapObject->PeriodEndDate);
			if (property_exists($objSoapObject, 'EmployerName'))
				$objToReturn->strEmployerName = $objSoapObject->EmployerName;
			if (property_exists($objSoapObject, 'Title'))
				$objToReturn->strTitle = $objSoapObject->Title;
			if (property_exists($objSoapObject, 'Duties'))
				$objToReturn->strDuties = $objSoapObject->Duties;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'PersonObject')) &&
				($objSoapObject->PersonObject))
				$objToReturn->PersonObject = Person::GetObjectFromSoapObject($objSoapObject->PersonObject);
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if ((property_exists($objSoapObject, 'FileDocumentObject')) &&
				($objSoapObject->FileDocumentObject))
				$objToReturn->FileDocumentObject = FileDocument::GetObjectFromSoapObject($objSoapObject->FileDocumentObject);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, EmploymentHistory::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttPeriodStartDate)
				$objObject->dttPeriodStartDate = $objObject->dttPeriodStartDate->qFormat(QDateTime::FormatSoap);
			if ($objObject->dttPeriodEndDate)
				$objObject->dttPeriodEndDate = $objObject->dttPeriodEndDate->qFormat(QDateTime::FormatSoap);
			if ($objObject->objPersonObject)
				$objObject->objPersonObject = Person::GetSoapObjectFromObject($objObject->objPersonObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intPerson = null;
			if ($objObject->objFileDocumentObject)
				$objObject->objFileDocumentObject = FileDocument::GetSoapObjectFromObject($objObject->objFileDocumentObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intFileDocument = null;
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
			$iArray['PeriodStartDate'] = $this->dttPeriodStartDate;
			$iArray['PeriodEndDate'] = $this->dttPeriodEndDate;
			$iArray['EmployerName'] = $this->strEmployerName;
			$iArray['Title'] = $this->strTitle;
			$iArray['Duties'] = $this->strDuties;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['Person'] = $this->intPerson;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
			$iArray['FileDocument'] = $this->intFileDocument;
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
     * @property-read QQNode $PeriodStartDate
     * @property-read QQNode $PeriodEndDate
     * @property-read QQNode $EmployerName
     * @property-read QQNode $Title
     * @property-read QQNode $Duties
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Person
     * @property-read QQNodePerson $PersonObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $FileDocument
     * @property-read QQNodeFileDocument $FileDocumentObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeEmploymentHistory extends QQNode {
		protected $strTableName = 'EmploymentHistory';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmploymentHistory';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'PeriodStartDate':
					return new QQNode('PeriodStartDate', 'PeriodStartDate', 'Date', $this);
				case 'PeriodEndDate':
					return new QQNode('PeriodEndDate', 'PeriodEndDate', 'Date', $this);
				case 'EmployerName':
					return new QQNode('EmployerName', 'EmployerName', 'VarChar', $this);
				case 'Title':
					return new QQNode('Title', 'Title', 'VarChar', $this);
				case 'Duties':
					return new QQNode('Duties', 'Duties', 'VarChar', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'Person':
					return new QQNode('Person', 'Person', 'Integer', $this);
				case 'PersonObject':
					return new QQNodePerson('Person', 'PersonObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'FileDocument':
					return new QQNode('FileDocument', 'FileDocument', 'Integer', $this);
				case 'FileDocumentObject':
					return new QQNodeFileDocument('FileDocument', 'FileDocumentObject', 'Integer', $this);

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
     * @property-read QQNode $PeriodStartDate
     * @property-read QQNode $PeriodEndDate
     * @property-read QQNode $EmployerName
     * @property-read QQNode $Title
     * @property-read QQNode $Duties
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Person
     * @property-read QQNodePerson $PersonObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $FileDocument
     * @property-read QQNodeFileDocument $FileDocumentObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeEmploymentHistory extends QQReverseReferenceNode {
		protected $strTableName = 'EmploymentHistory';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmploymentHistory';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'PeriodStartDate':
					return new QQNode('PeriodStartDate', 'PeriodStartDate', 'QDateTime', $this);
				case 'PeriodEndDate':
					return new QQNode('PeriodEndDate', 'PeriodEndDate', 'QDateTime', $this);
				case 'EmployerName':
					return new QQNode('EmployerName', 'EmployerName', 'string', $this);
				case 'Title':
					return new QQNode('Title', 'Title', 'string', $this);
				case 'Duties':
					return new QQNode('Duties', 'Duties', 'string', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'Person':
					return new QQNode('Person', 'Person', 'integer', $this);
				case 'PersonObject':
					return new QQNodePerson('Person', 'PersonObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'FileDocument':
					return new QQNode('FileDocument', 'FileDocument', 'integer', $this);
				case 'FileDocumentObject':
					return new QQNodeFileDocument('FileDocument', 'FileDocumentObject', 'integer', $this);

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
