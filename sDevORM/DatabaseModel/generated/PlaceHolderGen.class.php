<?php
	/**
	 * The abstract PlaceHolderGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the PlaceHolder subclass which
	 * extends this PlaceHolderGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the PlaceHolder class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property QDateTime $DummyOne the value for dttDummyOne 
	 * @property string $DummyTwo the value for strDummyTwo 
	 * @property integer $DummyThree the value for intDummyThree 
	 * @property integer $DummyFour the value for intDummyFour 
	 * @property QDateTime $DummyFive the value for dttDummyFive 
	 * @property string $DummySix the value for strDummySix 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $Account the value for intAccount 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property integer $UserRole the value for intUserRole 
	 * @property Account $AccountObject the value for the Account object referenced by intAccount 
	 * @property UserRole $UserRoleObject the value for the UserRole object referenced by intUserRole 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class PlaceHolderGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column PlaceHolder.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.DummyOne
		 * @var QDateTime dttDummyOne
		 */
		protected $dttDummyOne;
		const DummyOneDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.DummyTwo
		 * @var string strDummyTwo
		 */
		protected $strDummyTwo;
		const DummyTwoMaxLength = 20;
		const DummyTwoDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.DummyThree
		 * @var integer intDummyThree
		 */
		protected $intDummyThree;
		const DummyThreeDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.DummyFour
		 * @var integer intDummyFour
		 */
		protected $intDummyFour;
		const DummyFourDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.DummyFive
		 * @var QDateTime dttDummyFive
		 */
		protected $dttDummyFive;
		const DummyFiveDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.DummySix
		 * @var string strDummySix
		 */
		protected $strDummySix;
		const DummySixDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.Account
		 * @var integer intAccount
		 */
		protected $intAccount;
		const AccountDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column PlaceHolder.UserRole
		 * @var integer intUserRole
		 */
		protected $intUserRole;
		const UserRoleDefault = null;


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
		 * in the database column PlaceHolder.Account.
		 *
		 * NOTE: Always use the AccountObject property getter to correctly retrieve this Account object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Account objAccountObject
		 */
		protected $objAccountObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column PlaceHolder.UserRole.
		 *
		 * NOTE: Always use the UserRoleObject property getter to correctly retrieve this UserRole object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserRole objUserRoleObject
		 */
		protected $objUserRoleObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = PlaceHolder::IdDefault;
			$this->dttDummyOne = (PlaceHolder::DummyOneDefault === null)?null:new QDateTime(PlaceHolder::DummyOneDefault);
			$this->strDummyTwo = PlaceHolder::DummyTwoDefault;
			$this->intDummyThree = PlaceHolder::DummyThreeDefault;
			$this->intDummyFour = PlaceHolder::DummyFourDefault;
			$this->dttDummyFive = (PlaceHolder::DummyFiveDefault === null)?null:new QDateTime(PlaceHolder::DummyFiveDefault);
			$this->strDummySix = PlaceHolder::DummySixDefault;
			$this->strLastUpdated = PlaceHolder::LastUpdatedDefault;
			$this->intAccount = PlaceHolder::AccountDefault;
			$this->strSearchMetaInfo = PlaceHolder::SearchMetaInfoDefault;
			$this->intUserRole = PlaceHolder::UserRoleDefault;
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
		 * Load a PlaceHolder from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PlaceHolder
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'PlaceHolder', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = PlaceHolder::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::PlaceHolder()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all PlaceHolders
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PlaceHolder[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call PlaceHolder::QueryArray to perform the LoadAll query
			try {
				return PlaceHolder::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all PlaceHolders
		 * @return int
		 */
		public static function CountAll() {
			// Call PlaceHolder::QueryCount to perform the CountAll query
			return PlaceHolder::QueryCount(QQ::All());
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
			$objDatabase = PlaceHolder::GetDatabase();

			// Create/Build out the QueryBuilder object with PlaceHolder-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'PlaceHolder');

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
				PlaceHolder::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('PlaceHolder');

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
		 * Static Qcubed Query method to query for a single PlaceHolder object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return PlaceHolder the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = PlaceHolder::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new PlaceHolder object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = PlaceHolder::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return PlaceHolder::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of PlaceHolder objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return PlaceHolder[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = PlaceHolder::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return PlaceHolder::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = PlaceHolder::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of PlaceHolder objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = PlaceHolder::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = PlaceHolder::GetDatabase();

			$strQuery = PlaceHolder::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/placeholder', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = PlaceHolder::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this PlaceHolder
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'PlaceHolder';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'DummyOne', $strAliasPrefix . 'DummyOne');
			    $objBuilder->AddSelectItem($strTableName, 'DummyTwo', $strAliasPrefix . 'DummyTwo');
			    $objBuilder->AddSelectItem($strTableName, 'DummyThree', $strAliasPrefix . 'DummyThree');
			    $objBuilder->AddSelectItem($strTableName, 'DummyFour', $strAliasPrefix . 'DummyFour');
			    $objBuilder->AddSelectItem($strTableName, 'DummyFive', $strAliasPrefix . 'DummyFive');
			    $objBuilder->AddSelectItem($strTableName, 'DummySix', $strAliasPrefix . 'DummySix');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'Account', $strAliasPrefix . 'Account');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
			    $objBuilder->AddSelectItem($strTableName, 'UserRole', $strAliasPrefix . 'UserRole');
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
		 * Instantiate a PlaceHolder from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this PlaceHolder::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a PlaceHolder, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (PlaceHolder::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the PlaceHolder object
			$objToReturn = new PlaceHolder();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'DummyOne';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttDummyOne = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'DummyTwo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strDummyTwo = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'DummyThree';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intDummyThree = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'DummyFour';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intDummyFour = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'DummyFive';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttDummyFive = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAlias = $strAliasPrefix . 'DummySix';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strDummySix = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Account';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intAccount = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'UserRole';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intUserRole = $objDbRow->GetColumn($strAliasName, 'Integer');

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
				$strAliasPrefix = 'PlaceHolder__';

			// Check for AccountObject Early Binding
			$strAlias = $strAliasPrefix . 'Account__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Account']) ? null : $objExpansionAliasArray['Account']);
				$objToReturn->objAccountObject = Account::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Account__', $objExpansionNode, null, $strColumnAliasArray);
			}
			// Check for UserRoleObject Early Binding
			$strAlias = $strAliasPrefix . 'UserRole__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['UserRole']) ? null : $objExpansionAliasArray['UserRole']);
				$objToReturn->objUserRoleObject = UserRole::InstantiateDbRow($objDbRow, $strAliasPrefix . 'UserRole__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of PlaceHolders from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return PlaceHolder[]
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
					$objItem = PlaceHolder::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = PlaceHolder::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single PlaceHolder object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return PlaceHolder next row resulting from the query
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
			return PlaceHolder::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single PlaceHolder object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PlaceHolder
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return PlaceHolder::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::PlaceHolder()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of PlaceHolder objects,
		 * by Account Index(es)
		 * @param integer $intAccount
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PlaceHolder[]
		*/
		public static function LoadArrayByAccount($intAccount, $objOptionalClauses = null) {
			// Call PlaceHolder::QueryArray to perform the LoadArrayByAccount query
			try {
				return PlaceHolder::QueryArray(
					QQ::Equal(QQN::PlaceHolder()->Account, $intAccount),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count PlaceHolders
		 * by Account Index(es)
		 * @param integer $intAccount
		 * @return int
		*/
		public static function CountByAccount($intAccount) {
			// Call PlaceHolder::QueryCount to perform the CountByAccount query
			return PlaceHolder::QueryCount(
				QQ::Equal(QQN::PlaceHolder()->Account, $intAccount)
			);
		}

		/**
		 * Load an array of PlaceHolder objects,
		 * by UserRole Index(es)
		 * @param integer $intUserRole
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PlaceHolder[]
		*/
		public static function LoadArrayByUserRole($intUserRole, $objOptionalClauses = null) {
			// Call PlaceHolder::QueryArray to perform the LoadArrayByUserRole query
			try {
				return PlaceHolder::QueryArray(
					QQ::Equal(QQN::PlaceHolder()->UserRole, $intUserRole),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count PlaceHolders
		 * by UserRole Index(es)
		 * @param integer $intUserRole
		 * @return int
		*/
		public static function CountByUserRole($intUserRole) {
			// Call PlaceHolder::QueryCount to perform the CountByUserRole query
			return PlaceHolder::QueryCount(
				QQ::Equal(QQN::PlaceHolder()->UserRole, $intUserRole)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this PlaceHolder
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = PlaceHolder::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = PlaceHolder::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'PlaceHolder';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("DummyOne" => $this->dttDummyOne));
                $ChangedArray = array_merge($ChangedArray,array("DummyTwo" => $this->strDummyTwo));
                $ChangedArray = array_merge($ChangedArray,array("DummyThree" => $this->intDummyThree));
                $ChangedArray = array_merge($ChangedArray,array("DummyFour" => $this->intDummyFour));
                $ChangedArray = array_merge($ChangedArray,array("DummyFive" => $this->dttDummyFive));
                $ChangedArray = array_merge($ChangedArray,array("DummySix" => $this->strDummySix));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("Account" => $this->intAccount));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
                $ChangedArray = array_merge($ChangedArray,array("UserRole" => $this->intUserRole));
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
                if (!is_null($ExistingObj->DummyOne)) {
                    $ExistingValueStr = $ExistingObj->DummyOne;
                }
                if ($ExistingObj->DummyOne != $this->dttDummyOne) {
                    $ChangedArray = array_merge($ChangedArray,array("DummyOne" => array("Before" => $ExistingValueStr,"After" => $this->dttDummyOne)));
                    //$ChangedArray = array_merge($ChangedArray,array("DummyOne" => "From: ".$ExistingValueStr." to: ".$this->dttDummyOne));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DummyTwo)) {
                    $ExistingValueStr = $ExistingObj->DummyTwo;
                }
                if ($ExistingObj->DummyTwo != $this->strDummyTwo) {
                    $ChangedArray = array_merge($ChangedArray,array("DummyTwo" => array("Before" => $ExistingValueStr,"After" => $this->strDummyTwo)));
                    //$ChangedArray = array_merge($ChangedArray,array("DummyTwo" => "From: ".$ExistingValueStr." to: ".$this->strDummyTwo));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DummyThree)) {
                    $ExistingValueStr = $ExistingObj->DummyThree;
                }
                if ($ExistingObj->DummyThree != $this->intDummyThree) {
                    $ChangedArray = array_merge($ChangedArray,array("DummyThree" => array("Before" => $ExistingValueStr,"After" => $this->intDummyThree)));
                    //$ChangedArray = array_merge($ChangedArray,array("DummyThree" => "From: ".$ExistingValueStr." to: ".$this->intDummyThree));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DummyFour)) {
                    $ExistingValueStr = $ExistingObj->DummyFour;
                }
                if ($ExistingObj->DummyFour != $this->intDummyFour) {
                    $ChangedArray = array_merge($ChangedArray,array("DummyFour" => array("Before" => $ExistingValueStr,"After" => $this->intDummyFour)));
                    //$ChangedArray = array_merge($ChangedArray,array("DummyFour" => "From: ".$ExistingValueStr." to: ".$this->intDummyFour));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DummyFive)) {
                    $ExistingValueStr = $ExistingObj->DummyFive;
                }
                if ($ExistingObj->DummyFive != $this->dttDummyFive) {
                    $ChangedArray = array_merge($ChangedArray,array("DummyFive" => array("Before" => $ExistingValueStr,"After" => $this->dttDummyFive)));
                    //$ChangedArray = array_merge($ChangedArray,array("DummyFive" => "From: ".$ExistingValueStr." to: ".$this->dttDummyFive));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DummySix)) {
                    $ExistingValueStr = $ExistingObj->DummySix;
                }
                if ($ExistingObj->DummySix != $this->strDummySix) {
                    $ChangedArray = array_merge($ChangedArray,array("DummySix" => array("Before" => $ExistingValueStr,"After" => $this->strDummySix)));
                    //$ChangedArray = array_merge($ChangedArray,array("DummySix" => "From: ".$ExistingValueStr." to: ".$this->strDummySix));
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
                if (!is_null($ExistingObj->Account)) {
                    $ExistingValueStr = $ExistingObj->Account;
                }
                if ($ExistingObj->Account != $this->intAccount) {
                    $ChangedArray = array_merge($ChangedArray,array("Account" => array("Before" => $ExistingValueStr,"After" => $this->intAccount)));
                    //$ChangedArray = array_merge($ChangedArray,array("Account" => "From: ".$ExistingValueStr." to: ".$this->intAccount));
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
                if (!is_null($ExistingObj->UserRole)) {
                    $ExistingValueStr = $ExistingObj->UserRole;
                }
                if ($ExistingObj->UserRole != $this->intUserRole) {
                    $ChangedArray = array_merge($ChangedArray,array("UserRole" => array("Before" => $ExistingValueStr,"After" => $this->intUserRole)));
                    //$ChangedArray = array_merge($ChangedArray,array("UserRole" => "From: ".$ExistingValueStr." to: ".$this->intUserRole));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `PlaceHolder` (
							`DummyOne`,
							`DummyTwo`,
							`DummyThree`,
							`DummyFour`,
							`DummyFive`,
							`DummySix`,
							`Account`,
							`SearchMetaInfo`,
							`UserRole`
						) VALUES (
							' . $objDatabase->SqlVariable($this->dttDummyOne) . ',
							' . $objDatabase->SqlVariable($this->strDummyTwo) . ',
							' . $objDatabase->SqlVariable($this->intDummyThree) . ',
							' . $objDatabase->SqlVariable($this->intDummyFour) . ',
							' . $objDatabase->SqlVariable($this->dttDummyFive) . ',
							' . $objDatabase->SqlVariable($this->strDummySix) . ',
							' . $objDatabase->SqlVariable($this->intAccount) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->intUserRole) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('PlaceHolder', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
								
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `PlaceHolder` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('PlaceHolder');
                }
				
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `PlaceHolder` SET
							`DummyOne` = ' . $objDatabase->SqlVariable($this->dttDummyOne) . ',
							`DummyTwo` = ' . $objDatabase->SqlVariable($this->strDummyTwo) . ',
							`DummyThree` = ' . $objDatabase->SqlVariable($this->intDummyThree) . ',
							`DummyFour` = ' . $objDatabase->SqlVariable($this->intDummyFour) . ',
							`DummyFive` = ' . $objDatabase->SqlVariable($this->dttDummyFive) . ',
							`DummySix` = ' . $objDatabase->SqlVariable($this->strDummySix) . ',
							`Account` = ' . $objDatabase->SqlVariable($this->intAccount) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							`UserRole` = ' . $objDatabase->SqlVariable($this->intUserRole) . '
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
                error_log('Could not save audit log while saving PlaceHolder. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
								            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `PlaceHolder` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
				
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this PlaceHolder
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this PlaceHolder with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = PlaceHolder::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'PlaceHolder';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("DummyOne" => $this->dttDummyOne));
            $ChangedArray = array_merge($ChangedArray,array("DummyTwo" => $this->strDummyTwo));
            $ChangedArray = array_merge($ChangedArray,array("DummyThree" => $this->intDummyThree));
            $ChangedArray = array_merge($ChangedArray,array("DummyFour" => $this->intDummyFour));
            $ChangedArray = array_merge($ChangedArray,array("DummyFive" => $this->dttDummyFive));
            $ChangedArray = array_merge($ChangedArray,array("DummySix" => $this->strDummySix));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("Account" => $this->intAccount));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("UserRole" => $this->intUserRole));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting PlaceHolder. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PlaceHolder`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this PlaceHolder ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'PlaceHolder', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all PlaceHolders
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = PlaceHolder::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PlaceHolder`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate PlaceHolder table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = PlaceHolder::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `PlaceHolder`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this PlaceHolder from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved PlaceHolder object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = PlaceHolder::Load($this->intId);

			// Update $this's local variables to match
			$this->dttDummyOne = $objReloaded->dttDummyOne;
			$this->strDummyTwo = $objReloaded->strDummyTwo;
			$this->intDummyThree = $objReloaded->intDummyThree;
			$this->intDummyFour = $objReloaded->intDummyFour;
			$this->dttDummyFive = $objReloaded->dttDummyFive;
			$this->strDummySix = $objReloaded->strDummySix;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->Account = $objReloaded->Account;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
			$this->UserRole = $objReloaded->UserRole;
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

				case 'DummyOne':
					/**
					 * Gets the value for dttDummyOne 
					 * @return QDateTime
					 */
					return $this->dttDummyOne;

				case 'DummyTwo':
					/**
					 * Gets the value for strDummyTwo 
					 * @return string
					 */
					return $this->strDummyTwo;

				case 'DummyThree':
					/**
					 * Gets the value for intDummyThree 
					 * @return integer
					 */
					return $this->intDummyThree;

				case 'DummyFour':
					/**
					 * Gets the value for intDummyFour 
					 * @return integer
					 */
					return $this->intDummyFour;

				case 'DummyFive':
					/**
					 * Gets the value for dttDummyFive 
					 * @return QDateTime
					 */
					return $this->dttDummyFive;

				case 'DummySix':
					/**
					 * Gets the value for strDummySix 
					 * @return string
					 */
					return $this->strDummySix;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'Account':
					/**
					 * Gets the value for intAccount 
					 * @return integer
					 */
					return $this->intAccount;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;

				case 'UserRole':
					/**
					 * Gets the value for intUserRole 
					 * @return integer
					 */
					return $this->intUserRole;


				///////////////////
				// Member Objects
				///////////////////
				case 'AccountObject':
					/**
					 * Gets the value for the Account object referenced by intAccount 
					 * @return Account
					 */
					try {
						if ((!$this->objAccountObject) && (!is_null($this->intAccount)))
							$this->objAccountObject = Account::Load($this->intAccount);
						return $this->objAccountObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'UserRoleObject':
					/**
					 * Gets the value for the UserRole object referenced by intUserRole 
					 * @return UserRole
					 */
					try {
						if ((!$this->objUserRoleObject) && (!is_null($this->intUserRole)))
							$this->objUserRoleObject = UserRole::Load($this->intUserRole);
						return $this->objUserRoleObject;
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
				case 'DummyOne':
					/**
					 * Sets the value for dttDummyOne 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttDummyOne = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DummyTwo':
					/**
					 * Sets the value for strDummyTwo 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strDummyTwo = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DummyThree':
					/**
					 * Sets the value for intDummyThree 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intDummyThree = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DummyFour':
					/**
					 * Sets the value for intDummyFour 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intDummyFour = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DummyFive':
					/**
					 * Sets the value for dttDummyFive 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttDummyFive = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DummySix':
					/**
					 * Sets the value for strDummySix 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strDummySix = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Account':
					/**
					 * Sets the value for intAccount 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objAccountObject = null;
						return ($this->intAccount = QType::Cast($mixValue, QType::Integer));
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

				case 'UserRole':
					/**
					 * Sets the value for intUserRole 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objUserRoleObject = null;
						return ($this->intUserRole = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'AccountObject':
					/**
					 * Sets the value for the Account object referenced by intAccount 
					 * @param Account $mixValue
					 * @return Account
					 */
					if (is_null($mixValue)) {
						$this->intAccount = null;
						$this->objAccountObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Account object
						try {
							$mixValue = QType::Cast($mixValue, 'Account');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Account object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved AccountObject for this PlaceHolder');

						// Update Local Member Variables
						$this->objAccountObject = $mixValue;
						$this->intAccount = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'UserRoleObject':
					/**
					 * Sets the value for the UserRole object referenced by intUserRole 
					 * @param UserRole $mixValue
					 * @return UserRole
					 */
					if (is_null($mixValue)) {
						$this->intUserRole = null;
						$this->objUserRoleObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a UserRole object
						try {
							$mixValue = QType::Cast($mixValue, 'UserRole');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED UserRole object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved UserRoleObject for this PlaceHolder');

						// Update Local Member Variables
						$this->objUserRoleObject = $mixValue;
						$this->intUserRole = $mixValue->Id;

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
			return "PlaceHolder";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[PlaceHolder::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="PlaceHolder"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="DummyOne" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="DummyTwo" type="xsd:string"/>';
			$strToReturn .= '<element name="DummyThree" type="xsd:int"/>';
			$strToReturn .= '<element name="DummyFour" type="xsd:int"/>';
			$strToReturn .= '<element name="DummyFive" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="DummySix" type="xsd:string"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="AccountObject" type="xsd1:Account"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="UserRoleObject" type="xsd1:UserRole"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('PlaceHolder', $strComplexTypeArray)) {
				$strComplexTypeArray['PlaceHolder'] = PlaceHolder::GetSoapComplexTypeXml();
				Account::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserRole::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, PlaceHolder::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new PlaceHolder();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'DummyOne'))
				$objToReturn->dttDummyOne = new QDateTime($objSoapObject->DummyOne);
			if (property_exists($objSoapObject, 'DummyTwo'))
				$objToReturn->strDummyTwo = $objSoapObject->DummyTwo;
			if (property_exists($objSoapObject, 'DummyThree'))
				$objToReturn->intDummyThree = $objSoapObject->DummyThree;
			if (property_exists($objSoapObject, 'DummyFour'))
				$objToReturn->intDummyFour = $objSoapObject->DummyFour;
			if (property_exists($objSoapObject, 'DummyFive'))
				$objToReturn->dttDummyFive = new QDateTime($objSoapObject->DummyFive);
			if (property_exists($objSoapObject, 'DummySix'))
				$objToReturn->strDummySix = $objSoapObject->DummySix;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'AccountObject')) &&
				($objSoapObject->AccountObject))
				$objToReturn->AccountObject = Account::GetObjectFromSoapObject($objSoapObject->AccountObject);
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if ((property_exists($objSoapObject, 'UserRoleObject')) &&
				($objSoapObject->UserRoleObject))
				$objToReturn->UserRoleObject = UserRole::GetObjectFromSoapObject($objSoapObject->UserRoleObject);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, PlaceHolder::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttDummyOne)
				$objObject->dttDummyOne = $objObject->dttDummyOne->qFormat(QDateTime::FormatSoap);
			if ($objObject->dttDummyFive)
				$objObject->dttDummyFive = $objObject->dttDummyFive->qFormat(QDateTime::FormatSoap);
			if ($objObject->objAccountObject)
				$objObject->objAccountObject = Account::GetSoapObjectFromObject($objObject->objAccountObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAccount = null;
			if ($objObject->objUserRoleObject)
				$objObject->objUserRoleObject = UserRole::GetSoapObjectFromObject($objObject->objUserRoleObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intUserRole = null;
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
			$iArray['DummyOne'] = $this->dttDummyOne;
			$iArray['DummyTwo'] = $this->strDummyTwo;
			$iArray['DummyThree'] = $this->intDummyThree;
			$iArray['DummyFour'] = $this->intDummyFour;
			$iArray['DummyFive'] = $this->dttDummyFive;
			$iArray['DummySix'] = $this->strDummySix;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['Account'] = $this->intAccount;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
			$iArray['UserRole'] = $this->intUserRole;
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
     * @property-read QQNode $DummyOne
     * @property-read QQNode $DummyTwo
     * @property-read QQNode $DummyThree
     * @property-read QQNode $DummyFour
     * @property-read QQNode $DummyFive
     * @property-read QQNode $DummySix
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Account
     * @property-read QQNodeAccount $AccountObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $UserRole
     * @property-read QQNodeUserRole $UserRoleObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodePlaceHolder extends QQNode {
		protected $strTableName = 'PlaceHolder';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'PlaceHolder';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'DummyOne':
					return new QQNode('DummyOne', 'DummyOne', 'Date', $this);
				case 'DummyTwo':
					return new QQNode('DummyTwo', 'DummyTwo', 'VarChar', $this);
				case 'DummyThree':
					return new QQNode('DummyThree', 'DummyThree', 'Integer', $this);
				case 'DummyFour':
					return new QQNode('DummyFour', 'DummyFour', 'Integer', $this);
				case 'DummyFive':
					return new QQNode('DummyFive', 'DummyFive', 'DateTime', $this);
				case 'DummySix':
					return new QQNode('DummySix', 'DummySix', 'VarChar', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'Account':
					return new QQNode('Account', 'Account', 'Integer', $this);
				case 'AccountObject':
					return new QQNodeAccount('Account', 'AccountObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'UserRole':
					return new QQNode('UserRole', 'UserRole', 'Integer', $this);
				case 'UserRoleObject':
					return new QQNodeUserRole('UserRole', 'UserRoleObject', 'Integer', $this);

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
     * @property-read QQNode $DummyOne
     * @property-read QQNode $DummyTwo
     * @property-read QQNode $DummyThree
     * @property-read QQNode $DummyFour
     * @property-read QQNode $DummyFive
     * @property-read QQNode $DummySix
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Account
     * @property-read QQNodeAccount $AccountObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $UserRole
     * @property-read QQNodeUserRole $UserRoleObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodePlaceHolder extends QQReverseReferenceNode {
		protected $strTableName = 'PlaceHolder';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'PlaceHolder';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'DummyOne':
					return new QQNode('DummyOne', 'DummyOne', 'QDateTime', $this);
				case 'DummyTwo':
					return new QQNode('DummyTwo', 'DummyTwo', 'string', $this);
				case 'DummyThree':
					return new QQNode('DummyThree', 'DummyThree', 'integer', $this);
				case 'DummyFour':
					return new QQNode('DummyFour', 'DummyFour', 'integer', $this);
				case 'DummyFive':
					return new QQNode('DummyFive', 'DummyFive', 'QDateTime', $this);
				case 'DummySix':
					return new QQNode('DummySix', 'DummySix', 'string', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'Account':
					return new QQNode('Account', 'Account', 'integer', $this);
				case 'AccountObject':
					return new QQNodeAccount('Account', 'AccountObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'UserRole':
					return new QQNode('UserRole', 'UserRole', 'integer', $this);
				case 'UserRoleObject':
					return new QQNodeUserRole('UserRole', 'UserRoleObject', 'integer', $this);

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
