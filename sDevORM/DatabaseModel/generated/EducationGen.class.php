<?php
	/**
	 * The abstract EducationGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Education subclass which
	 * extends this EducationGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Education class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $Institution the value for strInstitution 
	 * @property QDateTime $StartDate the value for dttStartDate 
	 * @property QDateTime $EndDate the value for dttEndDate 
	 * @property string $Qualification the value for strQualification 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $Person the value for intPerson 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property integer $FileDocument the value for intFileDocument 
	 * @property Person $PersonObject the value for the Person object referenced by intPerson 
	 * @property FileDocument $FileDocumentObject the value for the FileDocument object referenced by intFileDocument 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class EducationGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column Education.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.Institution
		 * @var string strInstitution
		 */
		protected $strInstitution;
		const InstitutionMaxLength = 50;
		const InstitutionDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.StartDate
		 * @var QDateTime dttStartDate
		 */
		protected $dttStartDate;
		const StartDateDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.EndDate
		 * @var QDateTime dttEndDate
		 */
		protected $dttEndDate;
		const EndDateDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.Qualification
		 * @var string strQualification
		 */
		protected $strQualification;
		const QualificationMaxLength = 50;
		const QualificationDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.Person
		 * @var integer intPerson
		 */
		protected $intPerson;
		const PersonDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column Education.FileDocument
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
		 * in the database column Education.Person.
		 *
		 * NOTE: Always use the PersonObject property getter to correctly retrieve this Person object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Person objPersonObject
		 */
		protected $objPersonObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column Education.FileDocument.
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
			$this->intId = Education::IdDefault;
			$this->strInstitution = Education::InstitutionDefault;
			$this->dttStartDate = (Education::StartDateDefault === null)?null:new QDateTime(Education::StartDateDefault);
			$this->dttEndDate = (Education::EndDateDefault === null)?null:new QDateTime(Education::EndDateDefault);
			$this->strQualification = Education::QualificationDefault;
			$this->strLastUpdated = Education::LastUpdatedDefault;
			$this->intPerson = Education::PersonDefault;
			$this->strSearchMetaInfo = Education::SearchMetaInfoDefault;
			$this->intFileDocument = Education::FileDocumentDefault;
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
		 * Load a Education from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Education
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Education', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = Education::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Education()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all Educations
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Education[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call Education::QueryArray to perform the LoadAll query
			try {
				return Education::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Educations
		 * @return int
		 */
		public static function CountAll() {
			// Call Education::QueryCount to perform the CountAll query
			return Education::QueryCount(QQ::All());
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
			$objDatabase = Education::GetDatabase();

			// Create/Build out the QueryBuilder object with Education-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'Education');

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
				Education::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('Education');

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
		 * Static Qcubed Query method to query for a single Education object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Education the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Education::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Education object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Education::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return Education::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of Education objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Education[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Education::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Education::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = Education::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of Education objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Education::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Education::GetDatabase();

			$strQuery = Education::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/education', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = Education::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Education
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'Education';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'Institution', $strAliasPrefix . 'Institution');
			    $objBuilder->AddSelectItem($strTableName, 'StartDate', $strAliasPrefix . 'StartDate');
			    $objBuilder->AddSelectItem($strTableName, 'EndDate', $strAliasPrefix . 'EndDate');
			    $objBuilder->AddSelectItem($strTableName, 'Qualification', $strAliasPrefix . 'Qualification');
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
		 * Instantiate a Education from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Education::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a Education, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (Education::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the Education object
			$objToReturn = new Education();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'Institution';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strInstitution = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'StartDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttStartDate = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'EndDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttEndDate = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'Qualification';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strQualification = $objDbRow->GetColumn($strAliasName, 'VarChar');
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
				$strAliasPrefix = 'Education__';

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
		 * Instantiate an array of Educations from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return Education[]
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
					$objItem = Education::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = Education::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single Education object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return Education next row resulting from the query
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
			return Education::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single Education object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Education
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return Education::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Education()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of Education objects,
		 * by Person Index(es)
		 * @param integer $intPerson
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Education[]
		*/
		public static function LoadArrayByPerson($intPerson, $objOptionalClauses = null) {
			// Call Education::QueryArray to perform the LoadArrayByPerson query
			try {
				return Education::QueryArray(
					QQ::Equal(QQN::Education()->Person, $intPerson),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Educations
		 * by Person Index(es)
		 * @param integer $intPerson
		 * @return int
		*/
		public static function CountByPerson($intPerson) {
			// Call Education::QueryCount to perform the CountByPerson query
			return Education::QueryCount(
				QQ::Equal(QQN::Education()->Person, $intPerson)
			);
		}

		/**
		 * Load an array of Education objects,
		 * by FileDocument Index(es)
		 * @param integer $intFileDocument
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Education[]
		*/
		public static function LoadArrayByFileDocument($intFileDocument, $objOptionalClauses = null) {
			// Call Education::QueryArray to perform the LoadArrayByFileDocument query
			try {
				return Education::QueryArray(
					QQ::Equal(QQN::Education()->FileDocument, $intFileDocument),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Educations
		 * by FileDocument Index(es)
		 * @param integer $intFileDocument
		 * @return int
		*/
		public static function CountByFileDocument($intFileDocument) {
			// Call Education::QueryCount to perform the CountByFileDocument query
			return Education::QueryCount(
				QQ::Equal(QQN::Education()->FileDocument, $intFileDocument)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this Education
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = Education::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = Education::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Education';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("Institution" => $this->strInstitution));
                $ChangedArray = array_merge($ChangedArray,array("StartDate" => $this->dttStartDate));
                $ChangedArray = array_merge($ChangedArray,array("EndDate" => $this->dttEndDate));
                $ChangedArray = array_merge($ChangedArray,array("Qualification" => $this->strQualification));
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
                if (!is_null($ExistingObj->Institution)) {
                    $ExistingValueStr = $ExistingObj->Institution;
                }
                if ($ExistingObj->Institution != $this->strInstitution) {
                    $ChangedArray = array_merge($ChangedArray,array("Institution" => array("Before" => $ExistingValueStr,"After" => $this->strInstitution)));
                    //$ChangedArray = array_merge($ChangedArray,array("Institution" => "From: ".$ExistingValueStr." to: ".$this->strInstitution));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->StartDate)) {
                    $ExistingValueStr = $ExistingObj->StartDate;
                }
                if ($ExistingObj->StartDate != $this->dttStartDate) {
                    $ChangedArray = array_merge($ChangedArray,array("StartDate" => array("Before" => $ExistingValueStr,"After" => $this->dttStartDate)));
                    //$ChangedArray = array_merge($ChangedArray,array("StartDate" => "From: ".$ExistingValueStr." to: ".$this->dttStartDate));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->EndDate)) {
                    $ExistingValueStr = $ExistingObj->EndDate;
                }
                if ($ExistingObj->EndDate != $this->dttEndDate) {
                    $ChangedArray = array_merge($ChangedArray,array("EndDate" => array("Before" => $ExistingValueStr,"After" => $this->dttEndDate)));
                    //$ChangedArray = array_merge($ChangedArray,array("EndDate" => "From: ".$ExistingValueStr." to: ".$this->dttEndDate));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Qualification)) {
                    $ExistingValueStr = $ExistingObj->Qualification;
                }
                if ($ExistingObj->Qualification != $this->strQualification) {
                    $ChangedArray = array_merge($ChangedArray,array("Qualification" => array("Before" => $ExistingValueStr,"After" => $this->strQualification)));
                    //$ChangedArray = array_merge($ChangedArray,array("Qualification" => "From: ".$ExistingValueStr." to: ".$this->strQualification));
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
                    INSERT INTO `Education` (
							`Institution`,
							`StartDate`,
							`EndDate`,
							`Qualification`,
							`Person`,
							`SearchMetaInfo`,
							`FileDocument`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strInstitution) . ',
							' . $objDatabase->SqlVariable($this->dttStartDate) . ',
							' . $objDatabase->SqlVariable($this->dttEndDate) . ',
							' . $objDatabase->SqlVariable($this->strQualification) . ',
							' . $objDatabase->SqlVariable($this->intPerson) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->intFileDocument) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('Education', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
						
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `Education` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('Education');
                }
				
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `Education` SET
							`Institution` = ' . $objDatabase->SqlVariable($this->strInstitution) . ',
							`StartDate` = ' . $objDatabase->SqlVariable($this->dttStartDate) . ',
							`EndDate` = ' . $objDatabase->SqlVariable($this->dttEndDate) . ',
							`Qualification` = ' . $objDatabase->SqlVariable($this->strQualification) . ',
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
                error_log('Could not save audit log while saving Education. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
						            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `Education` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
				
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this Education
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Education with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Education::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Education';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("Institution" => $this->strInstitution));
            $ChangedArray = array_merge($ChangedArray,array("StartDate" => $this->dttStartDate));
            $ChangedArray = array_merge($ChangedArray,array("EndDate" => $this->dttEndDate));
            $ChangedArray = array_merge($ChangedArray,array("Qualification" => $this->strQualification));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("Person" => $this->intPerson));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("FileDocument" => $this->intFileDocument));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting Education. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Education`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this Education ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Education', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all Educations
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Education::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Education`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate Education table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Education::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `Education`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this Education from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved Education object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = Education::Load($this->intId);

			// Update $this's local variables to match
			$this->strInstitution = $objReloaded->strInstitution;
			$this->dttStartDate = $objReloaded->dttStartDate;
			$this->dttEndDate = $objReloaded->dttEndDate;
			$this->strQualification = $objReloaded->strQualification;
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

				case 'Institution':
					/**
					 * Gets the value for strInstitution 
					 * @return string
					 */
					return $this->strInstitution;

				case 'StartDate':
					/**
					 * Gets the value for dttStartDate 
					 * @return QDateTime
					 */
					return $this->dttStartDate;

				case 'EndDate':
					/**
					 * Gets the value for dttEndDate 
					 * @return QDateTime
					 */
					return $this->dttEndDate;

				case 'Qualification':
					/**
					 * Gets the value for strQualification 
					 * @return string
					 */
					return $this->strQualification;

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
				case 'Institution':
					/**
					 * Sets the value for strInstitution 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strInstitution = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'StartDate':
					/**
					 * Sets the value for dttStartDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttStartDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EndDate':
					/**
					 * Sets the value for dttEndDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttEndDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Qualification':
					/**
					 * Sets the value for strQualification 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strQualification = QType::Cast($mixValue, QType::String));
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
							throw new QCallerException('Unable to set an unsaved PersonObject for this Education');

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
							throw new QCallerException('Unable to set an unsaved FileDocumentObject for this Education');

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
			return "Education";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[Education::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="Education"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Institution" type="xsd:string"/>';
			$strToReturn .= '<element name="StartDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="EndDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="Qualification" type="xsd:string"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="PersonObject" type="xsd1:Person"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="FileDocumentObject" type="xsd1:FileDocument"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Education', $strComplexTypeArray)) {
				$strComplexTypeArray['Education'] = Education::GetSoapComplexTypeXml();
				Person::AlterSoapComplexTypeArray($strComplexTypeArray);
				FileDocument::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Education::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Education();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Institution'))
				$objToReturn->strInstitution = $objSoapObject->Institution;
			if (property_exists($objSoapObject, 'StartDate'))
				$objToReturn->dttStartDate = new QDateTime($objSoapObject->StartDate);
			if (property_exists($objSoapObject, 'EndDate'))
				$objToReturn->dttEndDate = new QDateTime($objSoapObject->EndDate);
			if (property_exists($objSoapObject, 'Qualification'))
				$objToReturn->strQualification = $objSoapObject->Qualification;
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
				array_push($objArrayToReturn, Education::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttStartDate)
				$objObject->dttStartDate = $objObject->dttStartDate->qFormat(QDateTime::FormatSoap);
			if ($objObject->dttEndDate)
				$objObject->dttEndDate = $objObject->dttEndDate->qFormat(QDateTime::FormatSoap);
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
			$iArray['Institution'] = $this->strInstitution;
			$iArray['StartDate'] = $this->dttStartDate;
			$iArray['EndDate'] = $this->dttEndDate;
			$iArray['Qualification'] = $this->strQualification;
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
     * @property-read QQNode $Institution
     * @property-read QQNode $StartDate
     * @property-read QQNode $EndDate
     * @property-read QQNode $Qualification
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
	class QQNodeEducation extends QQNode {
		protected $strTableName = 'Education';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Education';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'Institution':
					return new QQNode('Institution', 'Institution', 'VarChar', $this);
				case 'StartDate':
					return new QQNode('StartDate', 'StartDate', 'Date', $this);
				case 'EndDate':
					return new QQNode('EndDate', 'EndDate', 'Date', $this);
				case 'Qualification':
					return new QQNode('Qualification', 'Qualification', 'VarChar', $this);
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
     * @property-read QQNode $Institution
     * @property-read QQNode $StartDate
     * @property-read QQNode $EndDate
     * @property-read QQNode $Qualification
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
	class QQReverseReferenceNodeEducation extends QQReverseReferenceNode {
		protected $strTableName = 'Education';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Education';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'Institution':
					return new QQNode('Institution', 'Institution', 'string', $this);
				case 'StartDate':
					return new QQNode('StartDate', 'StartDate', 'QDateTime', $this);
				case 'EndDate':
					return new QQNode('EndDate', 'EndDate', 'QDateTime', $this);
				case 'Qualification':
					return new QQNode('Qualification', 'Qualification', 'string', $this);
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
