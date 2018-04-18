<?php
	/**
	 * The abstract FileDocumentGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the FileDocument subclass which
	 * extends this FileDocumentGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the FileDocument class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $FileName the value for strFileName 
	 * @property string $Path the value for strPath 
	 * @property QDateTime $CreatedDate the value for dttCreatedDate 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property-read Education $_Education the value for the private _objEducation (Read-Only) if set due to an expansion on the Education.FileDocument reverse relationship
	 * @property-read Education[] $_EducationArray the value for the private _objEducationArray (Read-Only) if set due to an ExpandAsArray on the Education.FileDocument reverse relationship
	 * @property-read EmploymentHistory $_EmploymentHistory the value for the private _objEmploymentHistory (Read-Only) if set due to an expansion on the EmploymentHistory.FileDocument reverse relationship
	 * @property-read EmploymentHistory[] $_EmploymentHistoryArray the value for the private _objEmploymentHistoryArray (Read-Only) if set due to an ExpandAsArray on the EmploymentHistory.FileDocument reverse relationship
	 * @property-read Person $_Person the value for the private _objPerson (Read-Only) if set due to an expansion on the Person.FileDocument reverse relationship
	 * @property-read Person[] $_PersonArray the value for the private _objPersonArray (Read-Only) if set due to an ExpandAsArray on the Person.FileDocument reverse relationship
	 * @property-read Reference $_Reference the value for the private _objReference (Read-Only) if set due to an expansion on the Reference.FileDocument reverse relationship
	 * @property-read Reference[] $_ReferenceArray the value for the private _objReferenceArray (Read-Only) if set due to an ExpandAsArray on the Reference.FileDocument reverse relationship
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class FileDocumentGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column FileDocument.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column FileDocument.FileName
		 * @var string strFileName
		 */
		protected $strFileName;
		const FileNameMaxLength = 200;
		const FileNameDefault = null;


		/**
		 * Protected member variable that maps to the database column FileDocument.Path
		 * @var string strPath
		 */
		protected $strPath;
		const PathMaxLength = 300;
		const PathDefault = null;


		/**
		 * Protected member variable that maps to the database column FileDocument.CreatedDate
		 * @var QDateTime dttCreatedDate
		 */
		protected $dttCreatedDate;
		const CreatedDateDefault = null;


		/**
		 * Protected member variable that maps to the database column FileDocument.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Private member variable that stores a reference to a single Education object
		 * (of type Education), if this FileDocument object was restored with
		 * an expansion on the Education association table.
		 * @var Education _objEducation;
		 */
		private $_objEducation;

		/**
		 * Private member variable that stores a reference to an array of Education objects
		 * (of type Education[]), if this FileDocument object was restored with
		 * an ExpandAsArray on the Education association table.
		 * @var Education[] _objEducationArray;
		 */
		private $_objEducationArray = null;

		/**
		 * Private member variable that stores a reference to a single EmploymentHistory object
		 * (of type EmploymentHistory), if this FileDocument object was restored with
		 * an expansion on the EmploymentHistory association table.
		 * @var EmploymentHistory _objEmploymentHistory;
		 */
		private $_objEmploymentHistory;

		/**
		 * Private member variable that stores a reference to an array of EmploymentHistory objects
		 * (of type EmploymentHistory[]), if this FileDocument object was restored with
		 * an ExpandAsArray on the EmploymentHistory association table.
		 * @var EmploymentHistory[] _objEmploymentHistoryArray;
		 */
		private $_objEmploymentHistoryArray = null;

		/**
		 * Private member variable that stores a reference to a single Person object
		 * (of type Person), if this FileDocument object was restored with
		 * an expansion on the Person association table.
		 * @var Person _objPerson;
		 */
		private $_objPerson;

		/**
		 * Private member variable that stores a reference to an array of Person objects
		 * (of type Person[]), if this FileDocument object was restored with
		 * an ExpandAsArray on the Person association table.
		 * @var Person[] _objPersonArray;
		 */
		private $_objPersonArray = null;

		/**
		 * Private member variable that stores a reference to a single Reference object
		 * (of type Reference), if this FileDocument object was restored with
		 * an expansion on the Reference association table.
		 * @var Reference _objReference;
		 */
		private $_objReference;

		/**
		 * Private member variable that stores a reference to an array of Reference objects
		 * (of type Reference[]), if this FileDocument object was restored with
		 * an ExpandAsArray on the Reference association table.
		 * @var Reference[] _objReferenceArray;
		 */
		private $_objReferenceArray = null;

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
			$this->intId = FileDocument::IdDefault;
			$this->strFileName = FileDocument::FileNameDefault;
			$this->strPath = FileDocument::PathDefault;
			$this->dttCreatedDate = (FileDocument::CreatedDateDefault === null)?null:new QDateTime(FileDocument::CreatedDateDefault);
			$this->strLastUpdated = FileDocument::LastUpdatedDefault;
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
		 * Load a FileDocument from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FileDocument
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'FileDocument', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = FileDocument::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::FileDocument()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all FileDocuments
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FileDocument[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call FileDocument::QueryArray to perform the LoadAll query
			try {
				return FileDocument::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all FileDocuments
		 * @return int
		 */
		public static function CountAll() {
			// Call FileDocument::QueryCount to perform the CountAll query
			return FileDocument::QueryCount(QQ::All());
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
			$objDatabase = FileDocument::GetDatabase();

			// Create/Build out the QueryBuilder object with FileDocument-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'FileDocument');

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
				FileDocument::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('FileDocument');

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
		 * Static Qcubed Query method to query for a single FileDocument object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FileDocument the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FileDocument::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new FileDocument object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = FileDocument::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return FileDocument::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of FileDocument objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FileDocument[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FileDocument::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FileDocument::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = FileDocument::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of FileDocument objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FileDocument::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = FileDocument::GetDatabase();

			$strQuery = FileDocument::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/filedocument', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = FileDocument::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this FileDocument
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'FileDocument';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'FileName', $strAliasPrefix . 'FileName');
			    $objBuilder->AddSelectItem($strTableName, 'Path', $strAliasPrefix . 'Path');
			    $objBuilder->AddSelectItem($strTableName, 'CreatedDate', $strAliasPrefix . 'CreatedDate');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
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
		 * Instantiate a FileDocument from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this FileDocument::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a FileDocument, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (FileDocument::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the FileDocument object
			$objToReturn = new FileDocument();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'FileName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strFileName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Path';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strPath = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'CreatedDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttCreatedDate = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');

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
				$strAliasPrefix = 'FileDocument__';


				

			// Check for Education Virtual Binding
			$strAlias = $strAliasPrefix . 'education__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['education']) ? null : $objExpansionAliasArray['education']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objEducationArray)
				$objToReturn->_objEducationArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objEducationArray[] = Education::InstantiateDbRow($objDbRow, $strAliasPrefix . 'education__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objEducation)) {
					$objToReturn->_objEducation = Education::InstantiateDbRow($objDbRow, $strAliasPrefix . 'education__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for EmploymentHistory Virtual Binding
			$strAlias = $strAliasPrefix . 'employmenthistory__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['employmenthistory']) ? null : $objExpansionAliasArray['employmenthistory']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objEmploymentHistoryArray)
				$objToReturn->_objEmploymentHistoryArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objEmploymentHistoryArray[] = EmploymentHistory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'employmenthistory__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objEmploymentHistory)) {
					$objToReturn->_objEmploymentHistory = EmploymentHistory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'employmenthistory__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for Person Virtual Binding
			$strAlias = $strAliasPrefix . 'person__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['person']) ? null : $objExpansionAliasArray['person']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objPersonArray)
				$objToReturn->_objPersonArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objPersonArray[] = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'person__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objPerson)) {
					$objToReturn->_objPerson = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'person__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for Reference Virtual Binding
			$strAlias = $strAliasPrefix . 'reference__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['reference']) ? null : $objExpansionAliasArray['reference']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objReferenceArray)
				$objToReturn->_objReferenceArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objReferenceArray[] = Reference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'reference__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objReference)) {
					$objToReturn->_objReference = Reference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'reference__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of FileDocuments from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return FileDocument[]
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
					$objItem = FileDocument::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = FileDocument::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single FileDocument object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return FileDocument next row resulting from the query
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
			return FileDocument::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single FileDocument object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FileDocument
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return FileDocument::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::FileDocument()->Id, $intId)
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
* Save this FileDocument
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = FileDocument::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = FileDocument::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'FileDocument';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("FileName" => $this->strFileName));
                $ChangedArray = array_merge($ChangedArray,array("Path" => $this->strPath));
                $ChangedArray = array_merge($ChangedArray,array("CreatedDate" => $this->dttCreatedDate));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
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
                if (!is_null($ExistingObj->FileName)) {
                    $ExistingValueStr = $ExistingObj->FileName;
                }
                if ($ExistingObj->FileName != $this->strFileName) {
                    $ChangedArray = array_merge($ChangedArray,array("FileName" => array("Before" => $ExistingValueStr,"After" => $this->strFileName)));
                    //$ChangedArray = array_merge($ChangedArray,array("FileName" => "From: ".$ExistingValueStr." to: ".$this->strFileName));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Path)) {
                    $ExistingValueStr = $ExistingObj->Path;
                }
                if ($ExistingObj->Path != $this->strPath) {
                    $ChangedArray = array_merge($ChangedArray,array("Path" => array("Before" => $ExistingValueStr,"After" => $this->strPath)));
                    //$ChangedArray = array_merge($ChangedArray,array("Path" => "From: ".$ExistingValueStr." to: ".$this->strPath));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->CreatedDate)) {
                    $ExistingValueStr = $ExistingObj->CreatedDate;
                }
                if ($ExistingObj->CreatedDate != $this->dttCreatedDate) {
                    $ChangedArray = array_merge($ChangedArray,array("CreatedDate" => array("Before" => $ExistingValueStr,"After" => $this->dttCreatedDate)));
                    //$ChangedArray = array_merge($ChangedArray,array("CreatedDate" => "From: ".$ExistingValueStr." to: ".$this->dttCreatedDate));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->LastUpdated)) {
                    $ExistingValueStr = $ExistingObj->LastUpdated;
                }
                if ($ExistingObj->LastUpdated != $this->strLastUpdated) {
                    $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => array("Before" => $ExistingValueStr,"After" => $this->strLastUpdated)));
                    //$ChangedArray = array_merge($ChangedArray,array("LastUpdated" => "From: ".$ExistingValueStr." to: ".$this->strLastUpdated));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `FileDocument` (
							`FileName`,
							`Path`,
							`CreatedDate`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strFileName) . ',
							' . $objDatabase->SqlVariable($this->strPath) . ',
							' . $objDatabase->SqlVariable($this->dttCreatedDate) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('FileDocument', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
					
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `FileDocument` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('FileDocument');
                }
	
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `FileDocument` SET
							`FileName` = ' . $objDatabase->SqlVariable($this->strFileName) . ',
							`Path` = ' . $objDatabase->SqlVariable($this->strPath) . ',
							`CreatedDate` = ' . $objDatabase->SqlVariable($this->dttCreatedDate) . '
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
                error_log('Could not save audit log while saving FileDocument. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
					            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `FileDocument` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
	
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this FileDocument
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this FileDocument with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'FileDocument';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("FileName" => $this->strFileName));
            $ChangedArray = array_merge($ChangedArray,array("Path" => $this->strPath));
            $ChangedArray = array_merge($ChangedArray,array("CreatedDate" => $this->dttCreatedDate));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting FileDocument. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`FileDocument`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this FileDocument ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'FileDocument', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all FileDocuments
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`FileDocument`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate FileDocument table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `FileDocument`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this FileDocument from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved FileDocument object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = FileDocument::Load($this->intId);

			// Update $this's local variables to match
			$this->strFileName = $objReloaded->strFileName;
			$this->strPath = $objReloaded->strPath;
			$this->dttCreatedDate = $objReloaded->dttCreatedDate;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
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

				case 'FileName':
					/**
					 * Gets the value for strFileName 
					 * @return string
					 */
					return $this->strFileName;

				case 'Path':
					/**
					 * Gets the value for strPath 
					 * @return string
					 */
					return $this->strPath;

				case 'CreatedDate':
					/**
					 * Gets the value for dttCreatedDate 
					 * @return QDateTime
					 */
					return $this->dttCreatedDate;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_Education':
					/**
					 * Gets the value for the private _objEducation (Read-Only)
					 * if set due to an expansion on the Education.FileDocument reverse relationship
					 * @return Education
					 */
					return $this->_objEducation;

				case '_EducationArray':
					/**
					 * Gets the value for the private _objEducationArray (Read-Only)
					 * if set due to an ExpandAsArray on the Education.FileDocument reverse relationship
					 * @return Education[]
					 */
					return $this->_objEducationArray;

				case '_EmploymentHistory':
					/**
					 * Gets the value for the private _objEmploymentHistory (Read-Only)
					 * if set due to an expansion on the EmploymentHistory.FileDocument reverse relationship
					 * @return EmploymentHistory
					 */
					return $this->_objEmploymentHistory;

				case '_EmploymentHistoryArray':
					/**
					 * Gets the value for the private _objEmploymentHistoryArray (Read-Only)
					 * if set due to an ExpandAsArray on the EmploymentHistory.FileDocument reverse relationship
					 * @return EmploymentHistory[]
					 */
					return $this->_objEmploymentHistoryArray;

				case '_Person':
					/**
					 * Gets the value for the private _objPerson (Read-Only)
					 * if set due to an expansion on the Person.FileDocument reverse relationship
					 * @return Person
					 */
					return $this->_objPerson;

				case '_PersonArray':
					/**
					 * Gets the value for the private _objPersonArray (Read-Only)
					 * if set due to an ExpandAsArray on the Person.FileDocument reverse relationship
					 * @return Person[]
					 */
					return $this->_objPersonArray;

				case '_Reference':
					/**
					 * Gets the value for the private _objReference (Read-Only)
					 * if set due to an expansion on the Reference.FileDocument reverse relationship
					 * @return Reference
					 */
					return $this->_objReference;

				case '_ReferenceArray':
					/**
					 * Gets the value for the private _objReferenceArray (Read-Only)
					 * if set due to an ExpandAsArray on the Reference.FileDocument reverse relationship
					 * @return Reference[]
					 */
					return $this->_objReferenceArray;


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
				case 'FileName':
					/**
					 * Sets the value for strFileName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFileName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Path':
					/**
					 * Sets the value for strPath 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPath = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CreatedDate':
					/**
					 * Sets the value for dttCreatedDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttCreatedDate = QType::Cast($mixValue, QType::DateTime));
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



		// Related Objects' Methods for Education
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Educations as an array of Education objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Education[]
		*/
		public function GetEducationArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Education::LoadArrayByFileDocument($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Educations
		 * @return int
		*/
		public function CountEducations() {
			if ((is_null($this->intId)))
				return 0;

			return Education::CountByFileDocument($this->intId);
		}

		/**
		 * Associates a Education
		 * @param Education $objEducation
		 * @return void
		*/
		public function AssociateEducation(Education $objEducation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEducation on this unsaved FileDocument.');
			if ((is_null($objEducation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEducation on this FileDocument with an unsaved Education.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Education`
				SET
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEducation->Id) . '
			');
		}

		/**
		 * Unassociates a Education
		 * @param Education $objEducation
		 * @return void
		*/
		public function UnassociateEducation(Education $objEducation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved FileDocument.');
			if ((is_null($objEducation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this FileDocument with an unsaved Education.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Education`
				SET
					`FileDocument` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEducation->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Educations
		 * @return void
		*/
		public function UnassociateAllEducations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Education`
				SET
					`FileDocument` = null
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Education
		 * @param Education $objEducation
		 * @return void
		*/
		public function DeleteAssociatedEducation(Education $objEducation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved FileDocument.');
			if ((is_null($objEducation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this FileDocument with an unsaved Education.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Education`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEducation->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Educations
		 * @return void
		*/
		public function DeleteAllEducations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Education`
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for EmploymentHistory
		//-------------------------------------------------------------------

		/**
		 * Gets all associated EmploymentHistories as an array of EmploymentHistory objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmploymentHistory[]
		*/
		public function GetEmploymentHistoryArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return EmploymentHistory::LoadArrayByFileDocument($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated EmploymentHistories
		 * @return int
		*/
		public function CountEmploymentHistories() {
			if ((is_null($this->intId)))
				return 0;

			return EmploymentHistory::CountByFileDocument($this->intId);
		}

		/**
		 * Associates a EmploymentHistory
		 * @param EmploymentHistory $objEmploymentHistory
		 * @return void
		*/
		public function AssociateEmploymentHistory(EmploymentHistory $objEmploymentHistory) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmploymentHistory on this unsaved FileDocument.');
			if ((is_null($objEmploymentHistory->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmploymentHistory on this FileDocument with an unsaved EmploymentHistory.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmploymentHistory`
				SET
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmploymentHistory->Id) . '
			');
		}

		/**
		 * Unassociates a EmploymentHistory
		 * @param EmploymentHistory $objEmploymentHistory
		 * @return void
		*/
		public function UnassociateEmploymentHistory(EmploymentHistory $objEmploymentHistory) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved FileDocument.');
			if ((is_null($objEmploymentHistory->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this FileDocument with an unsaved EmploymentHistory.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmploymentHistory`
				SET
					`FileDocument` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmploymentHistory->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all EmploymentHistories
		 * @return void
		*/
		public function UnassociateAllEmploymentHistories() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmploymentHistory`
				SET
					`FileDocument` = null
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated EmploymentHistory
		 * @param EmploymentHistory $objEmploymentHistory
		 * @return void
		*/
		public function DeleteAssociatedEmploymentHistory(EmploymentHistory $objEmploymentHistory) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved FileDocument.');
			if ((is_null($objEmploymentHistory->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this FileDocument with an unsaved EmploymentHistory.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmploymentHistory`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmploymentHistory->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated EmploymentHistories
		 * @return void
		*/
		public function DeleteAllEmploymentHistories() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmploymentHistory`
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for Person
		//-------------------------------------------------------------------

		/**
		 * Gets all associated People as an array of Person objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person[]
		*/
		public function GetPersonArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Person::LoadArrayByFileDocument($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated People
		 * @return int
		*/
		public function CountPeople() {
			if ((is_null($this->intId)))
				return 0;

			return Person::CountByFileDocument($this->intId);
		}

		/**
		 * Associates a Person
		 * @param Person $objPerson
		 * @return void
		*/
		public function AssociatePerson(Person $objPerson) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePerson on this unsaved FileDocument.');
			if ((is_null($objPerson->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePerson on this FileDocument with an unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Person`
				SET
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPerson->Id) . '
			');
		}

		/**
		 * Unassociates a Person
		 * @param Person $objPerson
		 * @return void
		*/
		public function UnassociatePerson(Person $objPerson) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this unsaved FileDocument.');
			if ((is_null($objPerson->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this FileDocument with an unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Person`
				SET
					`FileDocument` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPerson->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all People
		 * @return void
		*/
		public function UnassociateAllPeople() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Person`
				SET
					`FileDocument` = null
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Person
		 * @param Person $objPerson
		 * @return void
		*/
		public function DeleteAssociatedPerson(Person $objPerson) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this unsaved FileDocument.');
			if ((is_null($objPerson->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this FileDocument with an unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Person`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPerson->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated People
		 * @return void
		*/
		public function DeleteAllPeople() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Person`
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for Reference
		//-------------------------------------------------------------------

		/**
		 * Gets all associated References as an array of Reference objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Reference[]
		*/
		public function GetReferenceArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Reference::LoadArrayByFileDocument($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated References
		 * @return int
		*/
		public function CountReferences() {
			if ((is_null($this->intId)))
				return 0;

			return Reference::CountByFileDocument($this->intId);
		}

		/**
		 * Associates a Reference
		 * @param Reference $objReference
		 * @return void
		*/
		public function AssociateReference(Reference $objReference) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateReference on this unsaved FileDocument.');
			if ((is_null($objReference->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateReference on this FileDocument with an unsaved Reference.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Reference`
				SET
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objReference->Id) . '
			');
		}

		/**
		 * Unassociates a Reference
		 * @param Reference $objReference
		 * @return void
		*/
		public function UnassociateReference(Reference $objReference) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved FileDocument.');
			if ((is_null($objReference->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this FileDocument with an unsaved Reference.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Reference`
				SET
					`FileDocument` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objReference->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all References
		 * @return void
		*/
		public function UnassociateAllReferences() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Reference`
				SET
					`FileDocument` = null
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Reference
		 * @param Reference $objReference
		 * @return void
		*/
		public function DeleteAssociatedReference(Reference $objReference) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved FileDocument.');
			if ((is_null($objReference->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this FileDocument with an unsaved Reference.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Reference`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objReference->Id) . ' AND
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated References
		 * @return void
		*/
		public function DeleteAllReferences() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved FileDocument.');

			// Get the Database Object for this Class
			$objDatabase = FileDocument::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Reference`
				WHERE
					`FileDocument` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		
		///////////////////////////////
		// METHODS TO EXTRACT INFO ABOUT THE CLASS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetTableName() {
			return "FileDocument";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[FileDocument::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="FileDocument"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="FileName" type="xsd:string"/>';
			$strToReturn .= '<element name="Path" type="xsd:string"/>';
			$strToReturn .= '<element name="CreatedDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('FileDocument', $strComplexTypeArray)) {
				$strComplexTypeArray['FileDocument'] = FileDocument::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, FileDocument::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new FileDocument();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'FileName'))
				$objToReturn->strFileName = $objSoapObject->FileName;
			if (property_exists($objSoapObject, 'Path'))
				$objToReturn->strPath = $objSoapObject->Path;
			if (property_exists($objSoapObject, 'CreatedDate'))
				$objToReturn->dttCreatedDate = new QDateTime($objSoapObject->CreatedDate);
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, FileDocument::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttCreatedDate)
				$objObject->dttCreatedDate = $objObject->dttCreatedDate->qFormat(QDateTime::FormatSoap);
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
			$iArray['FileName'] = $this->strFileName;
			$iArray['Path'] = $this->strPath;
			$iArray['CreatedDate'] = $this->dttCreatedDate;
			$iArray['LastUpdated'] = $this->strLastUpdated;
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
     * @property-read QQNode $FileName
     * @property-read QQNode $Path
     * @property-read QQNode $CreatedDate
     * @property-read QQNode $LastUpdated
     *
     *
     * @property-read QQReverseReferenceNodeEducation $Education
     * @property-read QQReverseReferenceNodeEmploymentHistory $EmploymentHistory
     * @property-read QQReverseReferenceNodePerson $Person
     * @property-read QQReverseReferenceNodeReference $Reference

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeFileDocument extends QQNode {
		protected $strTableName = 'FileDocument';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'FileDocument';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'FileName':
					return new QQNode('FileName', 'FileName', 'VarChar', $this);
				case 'Path':
					return new QQNode('Path', 'Path', 'VarChar', $this);
				case 'CreatedDate':
					return new QQNode('CreatedDate', 'CreatedDate', 'DateTime', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'Education':
					return new QQReverseReferenceNodeEducation($this, 'education', 'reverse_reference', 'FileDocument', 'Education');
				case 'EmploymentHistory':
					return new QQReverseReferenceNodeEmploymentHistory($this, 'employmenthistory', 'reverse_reference', 'FileDocument', 'EmploymentHistory');
				case 'Person':
					return new QQReverseReferenceNodePerson($this, 'person', 'reverse_reference', 'FileDocument', 'Person');
				case 'Reference':
					return new QQReverseReferenceNodeReference($this, 'reference', 'reverse_reference', 'FileDocument', 'Reference');

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
     * @property-read QQNode $FileName
     * @property-read QQNode $Path
     * @property-read QQNode $CreatedDate
     * @property-read QQNode $LastUpdated
     *
     *
     * @property-read QQReverseReferenceNodeEducation $Education
     * @property-read QQReverseReferenceNodeEmploymentHistory $EmploymentHistory
     * @property-read QQReverseReferenceNodePerson $Person
     * @property-read QQReverseReferenceNodeReference $Reference

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeFileDocument extends QQReverseReferenceNode {
		protected $strTableName = 'FileDocument';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'FileDocument';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'FileName':
					return new QQNode('FileName', 'FileName', 'string', $this);
				case 'Path':
					return new QQNode('Path', 'Path', 'string', $this);
				case 'CreatedDate':
					return new QQNode('CreatedDate', 'CreatedDate', 'QDateTime', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'Education':
					return new QQReverseReferenceNodeEducation($this, 'education', 'reverse_reference', 'FileDocument', 'Education');
				case 'EmploymentHistory':
					return new QQReverseReferenceNodeEmploymentHistory($this, 'employmenthistory', 'reverse_reference', 'FileDocument', 'EmploymentHistory');
				case 'Person':
					return new QQReverseReferenceNodePerson($this, 'person', 'reverse_reference', 'FileDocument', 'Person');
				case 'Reference':
					return new QQReverseReferenceNodeReference($this, 'reference', 'reverse_reference', 'FileDocument', 'Reference');

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
