<?php
	/**
	 * The abstract AccountGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Account subclass which
	 * extends this AccountGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Account class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $FullName the value for strFullName 
	 * @property string $FirstName the value for strFirstName 
	 * @property string $LastName the value for strLastName 
	 * @property string $EmailAddress the value for strEmailAddress 
	 * @property string $Username the value for strUsername (Unique)
	 * @property string $Password the value for strPassword 
	 * @property string $ChangedBy the value for strChangedBy 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $UserRole the value for intUserRole 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property UserRole $UserRoleObject the value for the UserRole object referenced by intUserRole 
	 * @property-read LoginToken $_LoginToken the value for the private _objLoginToken (Read-Only) if set due to an expansion on the LoginToken.Account reverse relationship
	 * @property-read LoginToken[] $_LoginTokenArray the value for the private _objLoginTokenArray (Read-Only) if set due to an ExpandAsArray on the LoginToken.Account reverse relationship
	 * @property-read PasswordReset $_PasswordReset the value for the private _objPasswordReset (Read-Only) if set due to an expansion on the PasswordReset.Account reverse relationship
	 * @property-read PasswordReset[] $_PasswordResetArray the value for the private _objPasswordResetArray (Read-Only) if set due to an ExpandAsArray on the PasswordReset.Account reverse relationship
	 * @property-read Subscription $_Subscription the value for the private _objSubscription (Read-Only) if set due to an expansion on the Subscription.Account reverse relationship
	 * @property-read Subscription[] $_SubscriptionArray the value for the private _objSubscriptionArray (Read-Only) if set due to an ExpandAsArray on the Subscription.Account reverse relationship
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class AccountGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column Account.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.FullName
		 * @var string strFullName
		 */
		protected $strFullName;
		const FullNameMaxLength = 50;
		const FullNameDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.FirstName
		 * @var string strFirstName
		 */
		protected $strFirstName;
		const FirstNameMaxLength = 50;
		const FirstNameDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.LastName
		 * @var string strLastName
		 */
		protected $strLastName;
		const LastNameMaxLength = 50;
		const LastNameDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.EmailAddress
		 * @var string strEmailAddress
		 */
		protected $strEmailAddress;
		const EmailAddressMaxLength = 50;
		const EmailAddressDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.Username
		 * @var string strUsername
		 */
		protected $strUsername;
		const UsernameMaxLength = 50;
		const UsernameDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.Password
		 * @var string strPassword
		 */
		protected $strPassword;
		const PasswordMaxLength = 200;
		const PasswordDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.ChangedBy
		 * @var string strChangedBy
		 */
		protected $strChangedBy;
		const ChangedByMaxLength = 50;
		const ChangedByDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.UserRole
		 * @var integer intUserRole
		 */
		protected $intUserRole;
		const UserRoleDefault = null;


		/**
		 * Protected member variable that maps to the database column Account.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Private member variable that stores a reference to a single LoginToken object
		 * (of type LoginToken), if this Account object was restored with
		 * an expansion on the LoginToken association table.
		 * @var LoginToken _objLoginToken;
		 */
		private $_objLoginToken;

		/**
		 * Private member variable that stores a reference to an array of LoginToken objects
		 * (of type LoginToken[]), if this Account object was restored with
		 * an ExpandAsArray on the LoginToken association table.
		 * @var LoginToken[] _objLoginTokenArray;
		 */
		private $_objLoginTokenArray = null;

		/**
		 * Private member variable that stores a reference to a single PasswordReset object
		 * (of type PasswordReset), if this Account object was restored with
		 * an expansion on the PasswordReset association table.
		 * @var PasswordReset _objPasswordReset;
		 */
		private $_objPasswordReset;

		/**
		 * Private member variable that stores a reference to an array of PasswordReset objects
		 * (of type PasswordReset[]), if this Account object was restored with
		 * an ExpandAsArray on the PasswordReset association table.
		 * @var PasswordReset[] _objPasswordResetArray;
		 */
		private $_objPasswordResetArray = null;

		/**
		 * Private member variable that stores a reference to a single Subscription object
		 * (of type Subscription), if this Account object was restored with
		 * an expansion on the Subscription association table.
		 * @var Subscription _objSubscription;
		 */
		private $_objSubscription;

		/**
		 * Private member variable that stores a reference to an array of Subscription objects
		 * (of type Subscription[]), if this Account object was restored with
		 * an ExpandAsArray on the Subscription association table.
		 * @var Subscription[] _objSubscriptionArray;
		 */
		private $_objSubscriptionArray = null;

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
		 * in the database column Account.UserRole.
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
			$this->intId = Account::IdDefault;
			$this->strFullName = Account::FullNameDefault;
			$this->strFirstName = Account::FirstNameDefault;
			$this->strLastName = Account::LastNameDefault;
			$this->strEmailAddress = Account::EmailAddressDefault;
			$this->strUsername = Account::UsernameDefault;
			$this->strPassword = Account::PasswordDefault;
			$this->strChangedBy = Account::ChangedByDefault;
			$this->strLastUpdated = Account::LastUpdatedDefault;
			$this->intUserRole = Account::UserRoleDefault;
			$this->strSearchMetaInfo = Account::SearchMetaInfoDefault;
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
		 * Load a Account from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Account
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Account', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = Account::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Account()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all Accounts
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Account[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call Account::QueryArray to perform the LoadAll query
			try {
				return Account::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Accounts
		 * @return int
		 */
		public static function CountAll() {
			// Call Account::QueryCount to perform the CountAll query
			return Account::QueryCount(QQ::All());
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
			$objDatabase = Account::GetDatabase();

			// Create/Build out the QueryBuilder object with Account-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'Account');

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
				Account::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('Account');

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
		 * Static Qcubed Query method to query for a single Account object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Account the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Account::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Account object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Account::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return Account::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of Account objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Account[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Account::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Account::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = Account::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of Account objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Account::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Account::GetDatabase();

			$strQuery = Account::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/account', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = Account::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Account
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'Account';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'FullName', $strAliasPrefix . 'FullName');
			    $objBuilder->AddSelectItem($strTableName, 'FirstName', $strAliasPrefix . 'FirstName');
			    $objBuilder->AddSelectItem($strTableName, 'LastName', $strAliasPrefix . 'LastName');
			    $objBuilder->AddSelectItem($strTableName, 'EmailAddress', $strAliasPrefix . 'EmailAddress');
			    $objBuilder->AddSelectItem($strTableName, 'Username', $strAliasPrefix . 'Username');
			    $objBuilder->AddSelectItem($strTableName, 'Password', $strAliasPrefix . 'Password');
			    $objBuilder->AddSelectItem($strTableName, 'ChangedBy', $strAliasPrefix . 'ChangedBy');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'UserRole', $strAliasPrefix . 'UserRole');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
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
		 * Instantiate a Account from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Account::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a Account, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (Account::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the Account object
			$objToReturn = new Account();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'FullName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strFullName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'FirstName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strFirstName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LastName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'EmailAddress';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strEmailAddress = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Username';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strUsername = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Password';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strPassword = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'ChangedBy';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strChangedBy = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'UserRole';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intUserRole = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');

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
				$strAliasPrefix = 'Account__';

			// Check for UserRoleObject Early Binding
			$strAlias = $strAliasPrefix . 'UserRole__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['UserRole']) ? null : $objExpansionAliasArray['UserRole']);
				$objToReturn->objUserRoleObject = UserRole::InstantiateDbRow($objDbRow, $strAliasPrefix . 'UserRole__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			// Check for LoginToken Virtual Binding
			$strAlias = $strAliasPrefix . 'logintoken__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['logintoken']) ? null : $objExpansionAliasArray['logintoken']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objLoginTokenArray)
				$objToReturn->_objLoginTokenArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objLoginTokenArray[] = LoginToken::InstantiateDbRow($objDbRow, $strAliasPrefix . 'logintoken__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objLoginToken)) {
					$objToReturn->_objLoginToken = LoginToken::InstantiateDbRow($objDbRow, $strAliasPrefix . 'logintoken__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for PasswordReset Virtual Binding
			$strAlias = $strAliasPrefix . 'passwordreset__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['passwordreset']) ? null : $objExpansionAliasArray['passwordreset']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objPasswordResetArray)
				$objToReturn->_objPasswordResetArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objPasswordResetArray[] = PasswordReset::InstantiateDbRow($objDbRow, $strAliasPrefix . 'passwordreset__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objPasswordReset)) {
					$objToReturn->_objPasswordReset = PasswordReset::InstantiateDbRow($objDbRow, $strAliasPrefix . 'passwordreset__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for Subscription Virtual Binding
			$strAlias = $strAliasPrefix . 'subscription__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['subscription']) ? null : $objExpansionAliasArray['subscription']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objSubscriptionArray)
				$objToReturn->_objSubscriptionArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objSubscriptionArray[] = Subscription::InstantiateDbRow($objDbRow, $strAliasPrefix . 'subscription__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objSubscription)) {
					$objToReturn->_objSubscription = Subscription::InstantiateDbRow($objDbRow, $strAliasPrefix . 'subscription__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of Accounts from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return Account[]
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
					$objItem = Account::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = Account::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single Account object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return Account next row resulting from the query
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
			return Account::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single Account object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Account
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return Account::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Account()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load a single Account object,
		 * by Username Index(es)
		 * @param string $strUsername
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Account
		*/
		public static function LoadByUsername($strUsername, $objOptionalClauses = null) {
			return Account::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Account()->Username, $strUsername)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of Account objects,
		 * by UserRole Index(es)
		 * @param integer $intUserRole
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Account[]
		*/
		public static function LoadArrayByUserRole($intUserRole, $objOptionalClauses = null) {
			// Call Account::QueryArray to perform the LoadArrayByUserRole query
			try {
				return Account::QueryArray(
					QQ::Equal(QQN::Account()->UserRole, $intUserRole),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Accounts
		 * by UserRole Index(es)
		 * @param integer $intUserRole
		 * @return int
		*/
		public static function CountByUserRole($intUserRole) {
			// Call Account::QueryCount to perform the CountByUserRole query
			return Account::QueryCount(
				QQ::Equal(QQN::Account()->UserRole, $intUserRole)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this Account
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = Account::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = Account::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Account';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("FullName" => $this->strFullName));
                $ChangedArray = array_merge($ChangedArray,array("FirstName" => $this->strFirstName));
                $ChangedArray = array_merge($ChangedArray,array("LastName" => $this->strLastName));
                $ChangedArray = array_merge($ChangedArray,array("EmailAddress" => $this->strEmailAddress));
                $ChangedArray = array_merge($ChangedArray,array("Username" => $this->strUsername));
                $ChangedArray = array_merge($ChangedArray,array("Password" => $this->strPassword));
                $ChangedArray = array_merge($ChangedArray,array("ChangedBy" => $this->strChangedBy));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("UserRole" => $this->intUserRole));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
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
                if (!is_null($ExistingObj->FullName)) {
                    $ExistingValueStr = $ExistingObj->FullName;
                }
                if ($ExistingObj->FullName != $this->strFullName) {
                    $ChangedArray = array_merge($ChangedArray,array("FullName" => array("Before" => $ExistingValueStr,"After" => $this->strFullName)));
                    //$ChangedArray = array_merge($ChangedArray,array("FullName" => "From: ".$ExistingValueStr." to: ".$this->strFullName));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->FirstName)) {
                    $ExistingValueStr = $ExistingObj->FirstName;
                }
                if ($ExistingObj->FirstName != $this->strFirstName) {
                    $ChangedArray = array_merge($ChangedArray,array("FirstName" => array("Before" => $ExistingValueStr,"After" => $this->strFirstName)));
                    //$ChangedArray = array_merge($ChangedArray,array("FirstName" => "From: ".$ExistingValueStr." to: ".$this->strFirstName));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->LastName)) {
                    $ExistingValueStr = $ExistingObj->LastName;
                }
                if ($ExistingObj->LastName != $this->strLastName) {
                    $ChangedArray = array_merge($ChangedArray,array("LastName" => array("Before" => $ExistingValueStr,"After" => $this->strLastName)));
                    //$ChangedArray = array_merge($ChangedArray,array("LastName" => "From: ".$ExistingValueStr." to: ".$this->strLastName));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->EmailAddress)) {
                    $ExistingValueStr = $ExistingObj->EmailAddress;
                }
                if ($ExistingObj->EmailAddress != $this->strEmailAddress) {
                    $ChangedArray = array_merge($ChangedArray,array("EmailAddress" => array("Before" => $ExistingValueStr,"After" => $this->strEmailAddress)));
                    //$ChangedArray = array_merge($ChangedArray,array("EmailAddress" => "From: ".$ExistingValueStr." to: ".$this->strEmailAddress));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Username)) {
                    $ExistingValueStr = $ExistingObj->Username;
                }
                if ($ExistingObj->Username != $this->strUsername) {
                    $ChangedArray = array_merge($ChangedArray,array("Username" => array("Before" => $ExistingValueStr,"After" => $this->strUsername)));
                    //$ChangedArray = array_merge($ChangedArray,array("Username" => "From: ".$ExistingValueStr." to: ".$this->strUsername));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Password)) {
                    $ExistingValueStr = $ExistingObj->Password;
                }
                if ($ExistingObj->Password != $this->strPassword) {
                    $ChangedArray = array_merge($ChangedArray,array("Password" => array("Before" => $ExistingValueStr,"After" => $this->strPassword)));
                    //$ChangedArray = array_merge($ChangedArray,array("Password" => "From: ".$ExistingValueStr." to: ".$this->strPassword));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->ChangedBy)) {
                    $ExistingValueStr = $ExistingObj->ChangedBy;
                }
                if ($ExistingObj->ChangedBy != $this->strChangedBy) {
                    $ChangedArray = array_merge($ChangedArray,array("ChangedBy" => array("Before" => $ExistingValueStr,"After" => $this->strChangedBy)));
                    //$ChangedArray = array_merge($ChangedArray,array("ChangedBy" => "From: ".$ExistingValueStr." to: ".$this->strChangedBy));
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
                if (!is_null($ExistingObj->UserRole)) {
                    $ExistingValueStr = $ExistingObj->UserRole;
                }
                if ($ExistingObj->UserRole != $this->intUserRole) {
                    $ChangedArray = array_merge($ChangedArray,array("UserRole" => array("Before" => $ExistingValueStr,"After" => $this->intUserRole)));
                    //$ChangedArray = array_merge($ChangedArray,array("UserRole" => "From: ".$ExistingValueStr." to: ".$this->intUserRole));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->SearchMetaInfo)) {
                    $ExistingValueStr = $ExistingObj->SearchMetaInfo;
                }
                if ($ExistingObj->SearchMetaInfo != $this->strSearchMetaInfo) {
                    $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => array("Before" => $ExistingValueStr,"After" => $this->strSearchMetaInfo)));
                    //$ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => "From: ".$ExistingValueStr." to: ".$this->strSearchMetaInfo));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `Account` (
							`FullName`,
							`FirstName`,
							`LastName`,
							`EmailAddress`,
							`Username`,
							`Password`,
							`ChangedBy`,
							`UserRole`,
							`SearchMetaInfo`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strFullName) . ',
							' . $objDatabase->SqlVariable($this->strFirstName) . ',
							' . $objDatabase->SqlVariable($this->strLastName) . ',
							' . $objDatabase->SqlVariable($this->strEmailAddress) . ',
							' . $objDatabase->SqlVariable($this->strUsername) . ',
							' . $objDatabase->SqlVariable($this->strPassword) . ',
							' . $objDatabase->SqlVariable($this->strChangedBy) . ',
							' . $objDatabase->SqlVariable($this->intUserRole) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('Account', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
									
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `Account` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('Account');
                }
			
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `Account` SET
							`FullName` = ' . $objDatabase->SqlVariable($this->strFullName) . ',
							`FirstName` = ' . $objDatabase->SqlVariable($this->strFirstName) . ',
							`LastName` = ' . $objDatabase->SqlVariable($this->strLastName) . ',
							`EmailAddress` = ' . $objDatabase->SqlVariable($this->strEmailAddress) . ',
							`Username` = ' . $objDatabase->SqlVariable($this->strUsername) . ',
							`Password` = ' . $objDatabase->SqlVariable($this->strPassword) . ',
							`ChangedBy` = ' . $objDatabase->SqlVariable($this->strChangedBy) . ',
							`UserRole` = ' . $objDatabase->SqlVariable($this->intUserRole) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . '
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
                error_log('Could not save audit log while saving Account. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
									            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `Account` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
			
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this Account
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Account with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Account';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("FullName" => $this->strFullName));
            $ChangedArray = array_merge($ChangedArray,array("FirstName" => $this->strFirstName));
            $ChangedArray = array_merge($ChangedArray,array("LastName" => $this->strLastName));
            $ChangedArray = array_merge($ChangedArray,array("EmailAddress" => $this->strEmailAddress));
            $ChangedArray = array_merge($ChangedArray,array("Username" => $this->strUsername));
            $ChangedArray = array_merge($ChangedArray,array("Password" => $this->strPassword));
            $ChangedArray = array_merge($ChangedArray,array("ChangedBy" => $this->strChangedBy));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("UserRole" => $this->intUserRole));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting Account. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Account`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this Account ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Account', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all Accounts
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Account`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate Account table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `Account`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this Account from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved Account object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = Account::Load($this->intId);

			// Update $this's local variables to match
			$this->strFullName = $objReloaded->strFullName;
			$this->strFirstName = $objReloaded->strFirstName;
			$this->strLastName = $objReloaded->strLastName;
			$this->strEmailAddress = $objReloaded->strEmailAddress;
			$this->strUsername = $objReloaded->strUsername;
			$this->strPassword = $objReloaded->strPassword;
			$this->strChangedBy = $objReloaded->strChangedBy;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->UserRole = $objReloaded->UserRole;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
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

				case 'FullName':
					/**
					 * Gets the value for strFullName 
					 * @return string
					 */
					return $this->strFullName;

				case 'FirstName':
					/**
					 * Gets the value for strFirstName 
					 * @return string
					 */
					return $this->strFirstName;

				case 'LastName':
					/**
					 * Gets the value for strLastName 
					 * @return string
					 */
					return $this->strLastName;

				case 'EmailAddress':
					/**
					 * Gets the value for strEmailAddress 
					 * @return string
					 */
					return $this->strEmailAddress;

				case 'Username':
					/**
					 * Gets the value for strUsername (Unique)
					 * @return string
					 */
					return $this->strUsername;

				case 'Password':
					/**
					 * Gets the value for strPassword 
					 * @return string
					 */
					return $this->strPassword;

				case 'ChangedBy':
					/**
					 * Gets the value for strChangedBy 
					 * @return string
					 */
					return $this->strChangedBy;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'UserRole':
					/**
					 * Gets the value for intUserRole 
					 * @return integer
					 */
					return $this->intUserRole;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;


				///////////////////
				// Member Objects
				///////////////////
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

				case '_LoginToken':
					/**
					 * Gets the value for the private _objLoginToken (Read-Only)
					 * if set due to an expansion on the LoginToken.Account reverse relationship
					 * @return LoginToken
					 */
					return $this->_objLoginToken;

				case '_LoginTokenArray':
					/**
					 * Gets the value for the private _objLoginTokenArray (Read-Only)
					 * if set due to an ExpandAsArray on the LoginToken.Account reverse relationship
					 * @return LoginToken[]
					 */
					return $this->_objLoginTokenArray;

				case '_PasswordReset':
					/**
					 * Gets the value for the private _objPasswordReset (Read-Only)
					 * if set due to an expansion on the PasswordReset.Account reverse relationship
					 * @return PasswordReset
					 */
					return $this->_objPasswordReset;

				case '_PasswordResetArray':
					/**
					 * Gets the value for the private _objPasswordResetArray (Read-Only)
					 * if set due to an ExpandAsArray on the PasswordReset.Account reverse relationship
					 * @return PasswordReset[]
					 */
					return $this->_objPasswordResetArray;

				case '_Subscription':
					/**
					 * Gets the value for the private _objSubscription (Read-Only)
					 * if set due to an expansion on the Subscription.Account reverse relationship
					 * @return Subscription
					 */
					return $this->_objSubscription;

				case '_SubscriptionArray':
					/**
					 * Gets the value for the private _objSubscriptionArray (Read-Only)
					 * if set due to an ExpandAsArray on the Subscription.Account reverse relationship
					 * @return Subscription[]
					 */
					return $this->_objSubscriptionArray;


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
				case 'FullName':
					/**
					 * Sets the value for strFullName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFullName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FirstName':
					/**
					 * Sets the value for strFirstName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFirstName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LastName':
					/**
					 * Sets the value for strLastName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLastName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EmailAddress':
					/**
					 * Sets the value for strEmailAddress 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEmailAddress = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Username':
					/**
					 * Sets the value for strUsername (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUsername = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Password':
					/**
					 * Sets the value for strPassword 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPassword = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ChangedBy':
					/**
					 * Sets the value for strChangedBy 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strChangedBy = QType::Cast($mixValue, QType::String));
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


				///////////////////
				// Member Objects
				///////////////////
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
							throw new QCallerException('Unable to set an unsaved UserRoleObject for this Account');

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



		// Related Objects' Methods for LoginToken
		//-------------------------------------------------------------------

		/**
		 * Gets all associated LoginTokens as an array of LoginToken objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return LoginToken[]
		*/
		public function GetLoginTokenArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return LoginToken::LoadArrayByAccount($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated LoginTokens
		 * @return int
		*/
		public function CountLoginTokens() {
			if ((is_null($this->intId)))
				return 0;

			return LoginToken::CountByAccount($this->intId);
		}

		/**
		 * Associates a LoginToken
		 * @param LoginToken $objLoginToken
		 * @return void
		*/
		public function AssociateLoginToken(LoginToken $objLoginToken) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateLoginToken on this unsaved Account.');
			if ((is_null($objLoginToken->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateLoginToken on this Account with an unsaved LoginToken.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`LoginToken`
				SET
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objLoginToken->Id) . '
			');
		}

		/**
		 * Unassociates a LoginToken
		 * @param LoginToken $objLoginToken
		 * @return void
		*/
		public function UnassociateLoginToken(LoginToken $objLoginToken) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateLoginToken on this unsaved Account.');
			if ((is_null($objLoginToken->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateLoginToken on this Account with an unsaved LoginToken.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`LoginToken`
				SET
					`Account` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objLoginToken->Id) . ' AND
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all LoginTokens
		 * @return void
		*/
		public function UnassociateAllLoginTokens() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateLoginToken on this unsaved Account.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`LoginToken`
				SET
					`Account` = null
				WHERE
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated LoginToken
		 * @param LoginToken $objLoginToken
		 * @return void
		*/
		public function DeleteAssociatedLoginToken(LoginToken $objLoginToken) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateLoginToken on this unsaved Account.');
			if ((is_null($objLoginToken->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateLoginToken on this Account with an unsaved LoginToken.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`LoginToken`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objLoginToken->Id) . ' AND
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated LoginTokens
		 * @return void
		*/
		public function DeleteAllLoginTokens() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateLoginToken on this unsaved Account.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`LoginToken`
				WHERE
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for PasswordReset
		//-------------------------------------------------------------------

		/**
		 * Gets all associated PasswordResets as an array of PasswordReset objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PasswordReset[]
		*/
		public function GetPasswordResetArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return PasswordReset::LoadArrayByAccount($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated PasswordResets
		 * @return int
		*/
		public function CountPasswordResets() {
			if ((is_null($this->intId)))
				return 0;

			return PasswordReset::CountByAccount($this->intId);
		}

		/**
		 * Associates a PasswordReset
		 * @param PasswordReset $objPasswordReset
		 * @return void
		*/
		public function AssociatePasswordReset(PasswordReset $objPasswordReset) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePasswordReset on this unsaved Account.');
			if ((is_null($objPasswordReset->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePasswordReset on this Account with an unsaved PasswordReset.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PasswordReset`
				SET
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPasswordReset->Id) . '
			');
		}

		/**
		 * Unassociates a PasswordReset
		 * @param PasswordReset $objPasswordReset
		 * @return void
		*/
		public function UnassociatePasswordReset(PasswordReset $objPasswordReset) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePasswordReset on this unsaved Account.');
			if ((is_null($objPasswordReset->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePasswordReset on this Account with an unsaved PasswordReset.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PasswordReset`
				SET
					`Account` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPasswordReset->Id) . ' AND
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all PasswordResets
		 * @return void
		*/
		public function UnassociateAllPasswordResets() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePasswordReset on this unsaved Account.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PasswordReset`
				SET
					`Account` = null
				WHERE
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated PasswordReset
		 * @param PasswordReset $objPasswordReset
		 * @return void
		*/
		public function DeleteAssociatedPasswordReset(PasswordReset $objPasswordReset) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePasswordReset on this unsaved Account.');
			if ((is_null($objPasswordReset->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePasswordReset on this Account with an unsaved PasswordReset.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PasswordReset`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPasswordReset->Id) . ' AND
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated PasswordResets
		 * @return void
		*/
		public function DeleteAllPasswordResets() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePasswordReset on this unsaved Account.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PasswordReset`
				WHERE
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for Subscription
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Subscriptions as an array of Subscription objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription[]
		*/
		public function GetSubscriptionArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Subscription::LoadArrayByAccount($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Subscriptions
		 * @return int
		*/
		public function CountSubscriptions() {
			if ((is_null($this->intId)))
				return 0;

			return Subscription::CountByAccount($this->intId);
		}

		/**
		 * Associates a Subscription
		 * @param Subscription $objSubscription
		 * @return void
		*/
		public function AssociateSubscription(Subscription $objSubscription) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSubscription on this unsaved Account.');
			if ((is_null($objSubscription->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSubscription on this Account with an unsaved Subscription.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Subscription`
				SET
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objSubscription->Id) . '
			');
		}

		/**
		 * Unassociates a Subscription
		 * @param Subscription $objSubscription
		 * @return void
		*/
		public function UnassociateSubscription(Subscription $objSubscription) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSubscription on this unsaved Account.');
			if ((is_null($objSubscription->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSubscription on this Account with an unsaved Subscription.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Subscription`
				SET
					`Account` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objSubscription->Id) . ' AND
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Subscriptions
		 * @return void
		*/
		public function UnassociateAllSubscriptions() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSubscription on this unsaved Account.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Subscription`
				SET
					`Account` = null
				WHERE
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Subscription
		 * @param Subscription $objSubscription
		 * @return void
		*/
		public function DeleteAssociatedSubscription(Subscription $objSubscription) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSubscription on this unsaved Account.');
			if ((is_null($objSubscription->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSubscription on this Account with an unsaved Subscription.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Subscription`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objSubscription->Id) . ' AND
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Subscriptions
		 * @return void
		*/
		public function DeleteAllSubscriptions() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSubscription on this unsaved Account.');

			// Get the Database Object for this Class
			$objDatabase = Account::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Subscription`
				WHERE
					`Account` = ' . $objDatabase->SqlVariable($this->intId) . '
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
			return "Account";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[Account::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="Account"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="FullName" type="xsd:string"/>';
			$strToReturn .= '<element name="FirstName" type="xsd:string"/>';
			$strToReturn .= '<element name="LastName" type="xsd:string"/>';
			$strToReturn .= '<element name="EmailAddress" type="xsd:string"/>';
			$strToReturn .= '<element name="Username" type="xsd:string"/>';
			$strToReturn .= '<element name="Password" type="xsd:string"/>';
			$strToReturn .= '<element name="ChangedBy" type="xsd:string"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="UserRoleObject" type="xsd1:UserRole"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Account', $strComplexTypeArray)) {
				$strComplexTypeArray['Account'] = Account::GetSoapComplexTypeXml();
				UserRole::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Account::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Account();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'FullName'))
				$objToReturn->strFullName = $objSoapObject->FullName;
			if (property_exists($objSoapObject, 'FirstName'))
				$objToReturn->strFirstName = $objSoapObject->FirstName;
			if (property_exists($objSoapObject, 'LastName'))
				$objToReturn->strLastName = $objSoapObject->LastName;
			if (property_exists($objSoapObject, 'EmailAddress'))
				$objToReturn->strEmailAddress = $objSoapObject->EmailAddress;
			if (property_exists($objSoapObject, 'Username'))
				$objToReturn->strUsername = $objSoapObject->Username;
			if (property_exists($objSoapObject, 'Password'))
				$objToReturn->strPassword = $objSoapObject->Password;
			if (property_exists($objSoapObject, 'ChangedBy'))
				$objToReturn->strChangedBy = $objSoapObject->ChangedBy;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'UserRoleObject')) &&
				($objSoapObject->UserRoleObject))
				$objToReturn->UserRoleObject = UserRole::GetObjectFromSoapObject($objSoapObject->UserRoleObject);
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Account::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
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
			$iArray['FullName'] = $this->strFullName;
			$iArray['FirstName'] = $this->strFirstName;
			$iArray['LastName'] = $this->strLastName;
			$iArray['EmailAddress'] = $this->strEmailAddress;
			$iArray['Username'] = $this->strUsername;
			$iArray['Password'] = $this->strPassword;
			$iArray['ChangedBy'] = $this->strChangedBy;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['UserRole'] = $this->intUserRole;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
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
     * @property-read QQNode $FullName
     * @property-read QQNode $FirstName
     * @property-read QQNode $LastName
     * @property-read QQNode $EmailAddress
     * @property-read QQNode $Username
     * @property-read QQNode $Password
     * @property-read QQNode $ChangedBy
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $UserRole
     * @property-read QQNodeUserRole $UserRoleObject
     * @property-read QQNode $SearchMetaInfo
     *
     *
     * @property-read QQReverseReferenceNodeLoginToken $LoginToken
     * @property-read QQReverseReferenceNodePasswordReset $PasswordReset
     * @property-read QQReverseReferenceNodeSubscription $Subscription

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeAccount extends QQNode {
		protected $strTableName = 'Account';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Account';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'FullName':
					return new QQNode('FullName', 'FullName', 'VarChar', $this);
				case 'FirstName':
					return new QQNode('FirstName', 'FirstName', 'VarChar', $this);
				case 'LastName':
					return new QQNode('LastName', 'LastName', 'VarChar', $this);
				case 'EmailAddress':
					return new QQNode('EmailAddress', 'EmailAddress', 'VarChar', $this);
				case 'Username':
					return new QQNode('Username', 'Username', 'VarChar', $this);
				case 'Password':
					return new QQNode('Password', 'Password', 'VarChar', $this);
				case 'ChangedBy':
					return new QQNode('ChangedBy', 'ChangedBy', 'VarChar', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'UserRole':
					return new QQNode('UserRole', 'UserRole', 'Integer', $this);
				case 'UserRoleObject':
					return new QQNodeUserRole('UserRole', 'UserRoleObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'LoginToken':
					return new QQReverseReferenceNodeLoginToken($this, 'logintoken', 'reverse_reference', 'Account', 'LoginToken');
				case 'PasswordReset':
					return new QQReverseReferenceNodePasswordReset($this, 'passwordreset', 'reverse_reference', 'Account', 'PasswordReset');
				case 'Subscription':
					return new QQReverseReferenceNodeSubscription($this, 'subscription', 'reverse_reference', 'Account', 'Subscription');

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
     * @property-read QQNode $FullName
     * @property-read QQNode $FirstName
     * @property-read QQNode $LastName
     * @property-read QQNode $EmailAddress
     * @property-read QQNode $Username
     * @property-read QQNode $Password
     * @property-read QQNode $ChangedBy
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $UserRole
     * @property-read QQNodeUserRole $UserRoleObject
     * @property-read QQNode $SearchMetaInfo
     *
     *
     * @property-read QQReverseReferenceNodeLoginToken $LoginToken
     * @property-read QQReverseReferenceNodePasswordReset $PasswordReset
     * @property-read QQReverseReferenceNodeSubscription $Subscription

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeAccount extends QQReverseReferenceNode {
		protected $strTableName = 'Account';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Account';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'FullName':
					return new QQNode('FullName', 'FullName', 'string', $this);
				case 'FirstName':
					return new QQNode('FirstName', 'FirstName', 'string', $this);
				case 'LastName':
					return new QQNode('LastName', 'LastName', 'string', $this);
				case 'EmailAddress':
					return new QQNode('EmailAddress', 'EmailAddress', 'string', $this);
				case 'Username':
					return new QQNode('Username', 'Username', 'string', $this);
				case 'Password':
					return new QQNode('Password', 'Password', 'string', $this);
				case 'ChangedBy':
					return new QQNode('ChangedBy', 'ChangedBy', 'string', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'UserRole':
					return new QQNode('UserRole', 'UserRole', 'integer', $this);
				case 'UserRoleObject':
					return new QQNodeUserRole('UserRole', 'UserRoleObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'LoginToken':
					return new QQReverseReferenceNodeLoginToken($this, 'logintoken', 'reverse_reference', 'Account', 'LoginToken');
				case 'PasswordReset':
					return new QQReverseReferenceNodePasswordReset($this, 'passwordreset', 'reverse_reference', 'Account', 'PasswordReset');
				case 'Subscription':
					return new QQReverseReferenceNodeSubscription($this, 'subscription', 'reverse_reference', 'Account', 'Subscription');

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
