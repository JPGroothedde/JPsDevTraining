<?php
	/**
	 * The abstract PageViewGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the PageView subclass which
	 * extends this PageViewGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the PageView class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property QDateTime $TimeStamped the value for dttTimeStamped 
	 * @property string $IPAddress the value for strIPAddress 
	 * @property string $PageDetails the value for strPageDetails 
	 * @property string $UserAgentDetails the value for strUserAgentDetails 
	 * @property string $UserRole the value for strUserRole 
	 * @property string $Username the value for strUsername 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class PageViewGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column PageView.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column PageView.TimeStamped
		 * @var QDateTime dttTimeStamped
		 */
		protected $dttTimeStamped;
		const TimeStampedDefault = null;


		/**
		 * Protected member variable that maps to the database column PageView.IPAddress
		 * @var string strIPAddress
		 */
		protected $strIPAddress;
		const IPAddressMaxLength = 50;
		const IPAddressDefault = null;


		/**
		 * Protected member variable that maps to the database column PageView.PageDetails
		 * @var string strPageDetails
		 */
		protected $strPageDetails;
		const PageDetailsMaxLength = 500;
		const PageDetailsDefault = null;


		/**
		 * Protected member variable that maps to the database column PageView.UserAgentDetails
		 * @var string strUserAgentDetails
		 */
		protected $strUserAgentDetails;
		const UserAgentDetailsDefault = null;


		/**
		 * Protected member variable that maps to the database column PageView.UserRole
		 * @var string strUserRole
		 */
		protected $strUserRole;
		const UserRoleMaxLength = 200;
		const UserRoleDefault = null;


		/**
		 * Protected member variable that maps to the database column PageView.Username
		 * @var string strUsername
		 */
		protected $strUsername;
		const UsernameMaxLength = 200;
		const UsernameDefault = null;


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
			$this->intId = PageView::IdDefault;
			$this->dttTimeStamped = (PageView::TimeStampedDefault === null)?null:new QDateTime(PageView::TimeStampedDefault);
			$this->strIPAddress = PageView::IPAddressDefault;
			$this->strPageDetails = PageView::PageDetailsDefault;
			$this->strUserAgentDetails = PageView::UserAgentDetailsDefault;
			$this->strUserRole = PageView::UserRoleDefault;
			$this->strUsername = PageView::UsernameDefault;
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
		 * Load a PageView from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PageView
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'PageView', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = PageView::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::PageView()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all PageViews
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PageView[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call PageView::QueryArray to perform the LoadAll query
			try {
				return PageView::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all PageViews
		 * @return int
		 */
		public static function CountAll() {
			// Call PageView::QueryCount to perform the CountAll query
			return PageView::QueryCount(QQ::All());
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
			$objDatabase = PageView::GetDatabase();

			// Create/Build out the QueryBuilder object with PageView-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'PageView');

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
				PageView::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('PageView');

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
		 * Static Qcubed Query method to query for a single PageView object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return PageView the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = PageView::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new PageView object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = PageView::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return PageView::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of PageView objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return PageView[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = PageView::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return PageView::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = PageView::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of PageView objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = PageView::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = PageView::GetDatabase();

			$strQuery = PageView::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/pageview', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = PageView::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this PageView
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'PageView';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'TimeStamped', $strAliasPrefix . 'TimeStamped');
			    $objBuilder->AddSelectItem($strTableName, 'IPAddress', $strAliasPrefix . 'IPAddress');
			    $objBuilder->AddSelectItem($strTableName, 'PageDetails', $strAliasPrefix . 'PageDetails');
			    $objBuilder->AddSelectItem($strTableName, 'UserAgentDetails', $strAliasPrefix . 'UserAgentDetails');
			    $objBuilder->AddSelectItem($strTableName, 'UserRole', $strAliasPrefix . 'UserRole');
			    $objBuilder->AddSelectItem($strTableName, 'Username', $strAliasPrefix . 'Username');
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
		 * Instantiate a PageView from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this PageView::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a PageView, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
			
			

			// Create a new instance of the PageView object
			$objToReturn = new PageView();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'TimeStamped';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttTimeStamped = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAlias = $strAliasPrefix . 'IPAddress';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strIPAddress = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'PageDetails';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strPageDetails = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'UserAgentDetails';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strUserAgentDetails = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'UserRole';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strUserRole = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Username';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strUsername = $objDbRow->GetColumn($strAliasName, 'VarChar');

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
				$strAliasPrefix = 'PageView__';


				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of PageViews from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return PageView[]
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
					$objItem = PageView::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = PageView::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single PageView object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return PageView next row resulting from the query
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
			return PageView::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single PageView object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PageView
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return PageView::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::PageView()->Id, $intId)
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
		 * Save this PageView
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = PageView::GetDatabase();

			$mixToReturn = null;
            $ExistingObj = PageView::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'PageView';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
    $newAuditLogEntry->AuditLogEntryDetail = '<strong>Values after create:</strong> <br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'TimeStamped -> '.$this->dttTimeStamped.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'IPAddress -> '.$this->strIPAddress.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'PageDetails -> '.$this->strPageDetails.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'UserAgentDetails -> '.$this->strUserAgentDetails.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'UserRole -> '.$this->strUserRole.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Username -> '.$this->strUsername.'<br>';
            } else {
                $newAuditLogEntry->ModificationType = 'Update';
                $newAuditLogEntry->AuditLogEntryDetail = '<strong>Values before update:</strong> <br>';
                if ($ExistingObj->Id) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$ExistingObj->Id.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> NULL<br>';
                }
                if ($ExistingObj->TimeStamped) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'TimeStamped -> '.$ExistingObj->TimeStamped.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'TimeStamped -> NULL<br>';
                }
                if ($ExistingObj->IPAddress) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'IPAddress -> '.$ExistingObj->IPAddress.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'IPAddress -> NULL<br>';
                }
                if ($ExistingObj->PageDetails) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'PageDetails -> '.$ExistingObj->PageDetails.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'PageDetails -> NULL<br>';
                }
                if ($ExistingObj->UserAgentDetails) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'UserAgentDetails -> '.$ExistingObj->UserAgentDetails.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'UserAgentDetails -> NULL<br>';
                }
                if ($ExistingObj->UserRole) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'UserRole -> '.$ExistingObj->UserRole.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'UserRole -> NULL<br>';
                }
                if ($ExistingObj->Username) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Username -> '.$ExistingObj->Username.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Username -> NULL<br>';
                }
                $newAuditLogEntry->AuditLogEntryDetail .= '<strong>Values after update:</strong> <br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'TimeStamped -> '.$this->dttTimeStamped.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'IPAddress -> '.$this->strIPAddress.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'PageDetails -> '.$this->strPageDetails.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'UserAgentDetails -> '.$this->strUserAgentDetails.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'UserRole -> '.$this->strUserRole.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Username -> '.$this->strUsername.'<br>';
            }

            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                AppSpecificFunctions::AddCustomLog('Could not save audit log while saving PageView. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `PageView` (
							`TimeStamped`,
							`IPAddress`,
							`PageDetails`,
							`UserAgentDetails`,
							`UserRole`,
							`Username`
						) VALUES (
							' . $objDatabase->SqlVariable($this->dttTimeStamped) . ',
							' . $objDatabase->SqlVariable($this->strIPAddress) . ',
							' . $objDatabase->SqlVariable($this->strPageDetails) . ',
							' . $objDatabase->SqlVariable($this->strUserAgentDetails) . ',
							' . $objDatabase->SqlVariable($this->strUserRole) . ',
							' . $objDatabase->SqlVariable($this->strUsername) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('PageView', 'Id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`PageView`
						SET
							`TimeStamped` = ' . $objDatabase->SqlVariable($this->dttTimeStamped) . ',
							`IPAddress` = ' . $objDatabase->SqlVariable($this->strIPAddress) . ',
							`PageDetails` = ' . $objDatabase->SqlVariable($this->strPageDetails) . ',
							`UserAgentDetails` = ' . $objDatabase->SqlVariable($this->strUserAgentDetails) . ',
							`UserRole` = ' . $objDatabase->SqlVariable($this->strUserRole) . ',
							`Username` = ' . $objDatabase->SqlVariable($this->strUsername) . '
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
                AppSpecificFunctions::AddCustomLog('Could not save audit log while saving PageView. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }*/
			$this->DeleteCache();

			// Return
			return $mixToReturn;
		}

		/**
		 * Delete this PageView
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this PageView with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = PageView::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'PageView';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $newAuditLogEntry->AuditLogEntryDetail = 'Values before delete:<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'TimeStamped -> '.$this->dttTimeStamped.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'IPAddress -> '.$this->strIPAddress.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'PageDetails -> '.$this->strPageDetails.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'UserAgentDetails -> '.$this->strUserAgentDetails.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'UserRole -> '.$this->strUserRole.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Username -> '.$this->strUsername.'<br>';
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                AppSpecificFunctions::AddCustomLog('Could not save audit log while deleting PageView. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PageView`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this PageView ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'PageView', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all PageViews
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = PageView::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PageView`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate PageView table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = PageView::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `PageView`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this PageView from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved PageView object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = PageView::Load($this->intId);

			// Update $this's local variables to match
			$this->dttTimeStamped = $objReloaded->dttTimeStamped;
			$this->strIPAddress = $objReloaded->strIPAddress;
			$this->strPageDetails = $objReloaded->strPageDetails;
			$this->strUserAgentDetails = $objReloaded->strUserAgentDetails;
			$this->strUserRole = $objReloaded->strUserRole;
			$this->strUsername = $objReloaded->strUsername;
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

				case 'TimeStamped':
					/**
					 * Gets the value for dttTimeStamped 
					 * @return QDateTime
					 */
					return $this->dttTimeStamped;

				case 'IPAddress':
					/**
					 * Gets the value for strIPAddress 
					 * @return string
					 */
					return $this->strIPAddress;

				case 'PageDetails':
					/**
					 * Gets the value for strPageDetails 
					 * @return string
					 */
					return $this->strPageDetails;

				case 'UserAgentDetails':
					/**
					 * Gets the value for strUserAgentDetails 
					 * @return string
					 */
					return $this->strUserAgentDetails;

				case 'UserRole':
					/**
					 * Gets the value for strUserRole 
					 * @return string
					 */
					return $this->strUserRole;

				case 'Username':
					/**
					 * Gets the value for strUsername 
					 * @return string
					 */
					return $this->strUsername;


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
				case 'TimeStamped':
					/**
					 * Sets the value for dttTimeStamped 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttTimeStamped = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'IPAddress':
					/**
					 * Sets the value for strIPAddress 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strIPAddress = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PageDetails':
					/**
					 * Sets the value for strPageDetails 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPageDetails = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'UserAgentDetails':
					/**
					 * Sets the value for strUserAgentDetails 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUserAgentDetails = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'UserRole':
					/**
					 * Sets the value for strUserRole 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUserRole = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Username':
					/**
					 * Sets the value for strUsername 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUsername = QType::Cast($mixValue, QType::String));
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
			return "PageView";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[PageView::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="PageView"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="TimeStamped" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="IPAddress" type="xsd:string"/>';
			$strToReturn .= '<element name="PageDetails" type="xsd:string"/>';
			$strToReturn .= '<element name="UserAgentDetails" type="xsd:string"/>';
			$strToReturn .= '<element name="UserRole" type="xsd:string"/>';
			$strToReturn .= '<element name="Username" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('PageView', $strComplexTypeArray)) {
				$strComplexTypeArray['PageView'] = PageView::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, PageView::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new PageView();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'TimeStamped'))
				$objToReturn->dttTimeStamped = new QDateTime($objSoapObject->TimeStamped);
			if (property_exists($objSoapObject, 'IPAddress'))
				$objToReturn->strIPAddress = $objSoapObject->IPAddress;
			if (property_exists($objSoapObject, 'PageDetails'))
				$objToReturn->strPageDetails = $objSoapObject->PageDetails;
			if (property_exists($objSoapObject, 'UserAgentDetails'))
				$objToReturn->strUserAgentDetails = $objSoapObject->UserAgentDetails;
			if (property_exists($objSoapObject, 'UserRole'))
				$objToReturn->strUserRole = $objSoapObject->UserRole;
			if (property_exists($objSoapObject, 'Username'))
				$objToReturn->strUsername = $objSoapObject->Username;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, PageView::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttTimeStamped)
				$objObject->dttTimeStamped = $objObject->dttTimeStamped->qFormat(QDateTime::FormatSoap);
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
			$iArray['TimeStamped'] = $this->dttTimeStamped;
			$iArray['IPAddress'] = $this->strIPAddress;
			$iArray['PageDetails'] = $this->strPageDetails;
			$iArray['UserAgentDetails'] = $this->strUserAgentDetails;
			$iArray['UserRole'] = $this->strUserRole;
			$iArray['Username'] = $this->strUsername;
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
     * @property-read QQNode $TimeStamped
     * @property-read QQNode $IPAddress
     * @property-read QQNode $PageDetails
     * @property-read QQNode $UserAgentDetails
     * @property-read QQNode $UserRole
     * @property-read QQNode $Username
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodePageView extends QQNode {
		protected $strTableName = 'PageView';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'PageView';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'TimeStamped':
					return new QQNode('TimeStamped', 'TimeStamped', 'DateTime', $this);
				case 'IPAddress':
					return new QQNode('IPAddress', 'IPAddress', 'VarChar', $this);
				case 'PageDetails':
					return new QQNode('PageDetails', 'PageDetails', 'VarChar', $this);
				case 'UserAgentDetails':
					return new QQNode('UserAgentDetails', 'UserAgentDetails', 'Blob', $this);
				case 'UserRole':
					return new QQNode('UserRole', 'UserRole', 'VarChar', $this);
				case 'Username':
					return new QQNode('Username', 'Username', 'VarChar', $this);

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
     * @property-read QQNode $TimeStamped
     * @property-read QQNode $IPAddress
     * @property-read QQNode $PageDetails
     * @property-read QQNode $UserAgentDetails
     * @property-read QQNode $UserRole
     * @property-read QQNode $Username
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodePageView extends QQReverseReferenceNode {
		protected $strTableName = 'PageView';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'PageView';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'TimeStamped':
					return new QQNode('TimeStamped', 'TimeStamped', 'QDateTime', $this);
				case 'IPAddress':
					return new QQNode('IPAddress', 'IPAddress', 'string', $this);
				case 'PageDetails':
					return new QQNode('PageDetails', 'PageDetails', 'string', $this);
				case 'UserAgentDetails':
					return new QQNode('UserAgentDetails', 'UserAgentDetails', 'string', $this);
				case 'UserRole':
					return new QQNode('UserRole', 'UserRole', 'string', $this);
				case 'Username':
					return new QQNode('Username', 'Username', 'string', $this);

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
