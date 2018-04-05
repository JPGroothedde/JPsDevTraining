<?php
	/**
	 * The abstract SubscriptionGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Subscription subclass which
	 * extends this SubscriptionGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Subscription class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property QDateTime $StartDate the value for dttStartDate 
	 * @property QDateTime $EndDate the value for dttEndDate 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property integer $Account the value for intAccount 
	 * @property integer $Course the value for intCourse 
	 * @property integer $Assignment the value for intAssignment 
	 * @property Account $AccountObject the value for the Account object referenced by intAccount 
	 * @property Course $CourseObject the value for the Course object referenced by intCourse 
	 * @property Assignment $AssignmentObject the value for the Assignment object referenced by intAssignment 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class SubscriptionGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column Subscription.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.StartDate
		 * @var QDateTime dttStartDate
		 */
		protected $dttStartDate;
		const StartDateDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.EndDate
		 * @var QDateTime dttEndDate
		 */
		protected $dttEndDate;
		const EndDateDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.Account
		 * @var integer intAccount
		 */
		protected $intAccount;
		const AccountDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.Course
		 * @var integer intCourse
		 */
		protected $intCourse;
		const CourseDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.Assignment
		 * @var integer intAssignment
		 */
		protected $intAssignment;
		const AssignmentDefault = null;


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
		 * in the database column Subscription.Account.
		 *
		 * NOTE: Always use the AccountObject property getter to correctly retrieve this Account object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Account objAccountObject
		 */
		protected $objAccountObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column Subscription.Course.
		 *
		 * NOTE: Always use the CourseObject property getter to correctly retrieve this Course object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Course objCourseObject
		 */
		protected $objCourseObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column Subscription.Assignment.
		 *
		 * NOTE: Always use the AssignmentObject property getter to correctly retrieve this Assignment object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Assignment objAssignmentObject
		 */
		protected $objAssignmentObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = Subscription::IdDefault;
			$this->dttStartDate = (Subscription::StartDateDefault === null)?null:new QDateTime(Subscription::StartDateDefault);
			$this->dttEndDate = (Subscription::EndDateDefault === null)?null:new QDateTime(Subscription::EndDateDefault);
			$this->strLastUpdated = Subscription::LastUpdatedDefault;
			$this->strSearchMetaInfo = Subscription::SearchMetaInfoDefault;
			$this->intAccount = Subscription::AccountDefault;
			$this->intCourse = Subscription::CourseDefault;
			$this->intAssignment = Subscription::AssignmentDefault;
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
		 * Load a Subscription from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Subscription', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = Subscription::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Subscription()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all Subscriptions
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call Subscription::QueryArray to perform the LoadAll query
			try {
				return Subscription::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Subscriptions
		 * @return int
		 */
		public static function CountAll() {
			// Call Subscription::QueryCount to perform the CountAll query
			return Subscription::QueryCount(QQ::All());
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
			$objDatabase = Subscription::GetDatabase();

			// Create/Build out the QueryBuilder object with Subscription-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'Subscription');

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
				Subscription::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('Subscription');

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
		 * Static Qcubed Query method to query for a single Subscription object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Subscription the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Subscription::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Subscription object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Subscription::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return Subscription::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of Subscription objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Subscription[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Subscription::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Subscription::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = Subscription::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of Subscription objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Subscription::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Subscription::GetDatabase();

			$strQuery = Subscription::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/subscription', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = Subscription::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Subscription
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'Subscription';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'StartDate', $strAliasPrefix . 'StartDate');
			    $objBuilder->AddSelectItem($strTableName, 'EndDate', $strAliasPrefix . 'EndDate');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
			    $objBuilder->AddSelectItem($strTableName, 'Account', $strAliasPrefix . 'Account');
			    $objBuilder->AddSelectItem($strTableName, 'Course', $strAliasPrefix . 'Course');
			    $objBuilder->AddSelectItem($strTableName, 'Assignment', $strAliasPrefix . 'Assignment');
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
		 * Instantiate a Subscription from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Subscription::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a Subscription, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (Subscription::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the Subscription object
			$objToReturn = new Subscription();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'StartDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttStartDate = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'EndDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttEndDate = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Account';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intAccount = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'Course';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intCourse = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'Assignment';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intAssignment = $objDbRow->GetColumn($strAliasName, 'Integer');

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
				$strAliasPrefix = 'Subscription__';

			// Check for AccountObject Early Binding
			$strAlias = $strAliasPrefix . 'Account__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Account']) ? null : $objExpansionAliasArray['Account']);
				$objToReturn->objAccountObject = Account::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Account__', $objExpansionNode, null, $strColumnAliasArray);
			}
			// Check for CourseObject Early Binding
			$strAlias = $strAliasPrefix . 'Course__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Course']) ? null : $objExpansionAliasArray['Course']);
				$objToReturn->objCourseObject = Course::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Course__', $objExpansionNode, null, $strColumnAliasArray);
			}
			// Check for AssignmentObject Early Binding
			$strAlias = $strAliasPrefix . 'Assignment__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Assignment']) ? null : $objExpansionAliasArray['Assignment']);
				$objToReturn->objAssignmentObject = Assignment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Assignment__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of Subscriptions from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return Subscription[]
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
					$objItem = Subscription::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = Subscription::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single Subscription object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return Subscription next row resulting from the query
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
			return Subscription::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single Subscription object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return Subscription::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Subscription()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of Subscription objects,
		 * by Account Index(es)
		 * @param integer $intAccount
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription[]
		*/
		public static function LoadArrayByAccount($intAccount, $objOptionalClauses = null) {
			// Call Subscription::QueryArray to perform the LoadArrayByAccount query
			try {
				return Subscription::QueryArray(
					QQ::Equal(QQN::Subscription()->Account, $intAccount),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Subscriptions
		 * by Account Index(es)
		 * @param integer $intAccount
		 * @return int
		*/
		public static function CountByAccount($intAccount) {
			// Call Subscription::QueryCount to perform the CountByAccount query
			return Subscription::QueryCount(
				QQ::Equal(QQN::Subscription()->Account, $intAccount)
			);
		}

		/**
		 * Load an array of Subscription objects,
		 * by Course Index(es)
		 * @param integer $intCourse
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription[]
		*/
		public static function LoadArrayByCourse($intCourse, $objOptionalClauses = null) {
			// Call Subscription::QueryArray to perform the LoadArrayByCourse query
			try {
				return Subscription::QueryArray(
					QQ::Equal(QQN::Subscription()->Course, $intCourse),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Subscriptions
		 * by Course Index(es)
		 * @param integer $intCourse
		 * @return int
		*/
		public static function CountByCourse($intCourse) {
			// Call Subscription::QueryCount to perform the CountByCourse query
			return Subscription::QueryCount(
				QQ::Equal(QQN::Subscription()->Course, $intCourse)
			);
		}

		/**
		 * Load an array of Subscription objects,
		 * by Assignment Index(es)
		 * @param integer $intAssignment
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription[]
		*/
		public static function LoadArrayByAssignment($intAssignment, $objOptionalClauses = null) {
			// Call Subscription::QueryArray to perform the LoadArrayByAssignment query
			try {
				return Subscription::QueryArray(
					QQ::Equal(QQN::Subscription()->Assignment, $intAssignment),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Subscriptions
		 * by Assignment Index(es)
		 * @param integer $intAssignment
		 * @return int
		*/
		public static function CountByAssignment($intAssignment) {
			// Call Subscription::QueryCount to perform the CountByAssignment query
			return Subscription::QueryCount(
				QQ::Equal(QQN::Subscription()->Assignment, $intAssignment)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this Subscription
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = Subscription::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = Subscription::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Subscription';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("StartDate" => $this->dttStartDate));
                $ChangedArray = array_merge($ChangedArray,array("EndDate" => $this->dttEndDate));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
                $ChangedArray = array_merge($ChangedArray,array("Account" => $this->intAccount));
                $ChangedArray = array_merge($ChangedArray,array("Course" => $this->intCourse));
                $ChangedArray = array_merge($ChangedArray,array("Assignment" => $this->intAssignment));
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
                if (!is_null($ExistingObj->LastUpdated)) {
                    $ExistingValueStr = $ExistingObj->LastUpdated;
                }
                if ($ExistingObj->LastUpdated != $this->strLastUpdated) {
                    $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => array("Before" => $ExistingValueStr,"After" => $this->strLastUpdated)));
                    //$ChangedArray = array_merge($ChangedArray,array("LastUpdated" => "From: ".$ExistingValueStr." to: ".$this->strLastUpdated));
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
                if (!is_null($ExistingObj->Account)) {
                    $ExistingValueStr = $ExistingObj->Account;
                }
                if ($ExistingObj->Account != $this->intAccount) {
                    $ChangedArray = array_merge($ChangedArray,array("Account" => array("Before" => $ExistingValueStr,"After" => $this->intAccount)));
                    //$ChangedArray = array_merge($ChangedArray,array("Account" => "From: ".$ExistingValueStr." to: ".$this->intAccount));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Course)) {
                    $ExistingValueStr = $ExistingObj->Course;
                }
                if ($ExistingObj->Course != $this->intCourse) {
                    $ChangedArray = array_merge($ChangedArray,array("Course" => array("Before" => $ExistingValueStr,"After" => $this->intCourse)));
                    //$ChangedArray = array_merge($ChangedArray,array("Course" => "From: ".$ExistingValueStr." to: ".$this->intCourse));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Assignment)) {
                    $ExistingValueStr = $ExistingObj->Assignment;
                }
                if ($ExistingObj->Assignment != $this->intAssignment) {
                    $ChangedArray = array_merge($ChangedArray,array("Assignment" => array("Before" => $ExistingValueStr,"After" => $this->intAssignment)));
                    //$ChangedArray = array_merge($ChangedArray,array("Assignment" => "From: ".$ExistingValueStr." to: ".$this->intAssignment));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `Subscription` (
							`StartDate`,
							`EndDate`,
							`SearchMetaInfo`,
							`Account`,
							`Course`,
							`Assignment`
						) VALUES (
							' . $objDatabase->SqlVariable($this->dttStartDate) . ',
							' . $objDatabase->SqlVariable($this->dttEndDate) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->intAccount) . ',
							' . $objDatabase->SqlVariable($this->intCourse) . ',
							' . $objDatabase->SqlVariable($this->intAssignment) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('Subscription', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
				
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `Subscription` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('Subscription');
                }
					
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `Subscription` SET
							`StartDate` = ' . $objDatabase->SqlVariable($this->dttStartDate) . ',
							`EndDate` = ' . $objDatabase->SqlVariable($this->dttEndDate) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							`Account` = ' . $objDatabase->SqlVariable($this->intAccount) . ',
							`Course` = ' . $objDatabase->SqlVariable($this->intCourse) . ',
							`Assignment` = ' . $objDatabase->SqlVariable($this->intAssignment) . '
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
                error_log('Could not save audit log while saving Subscription. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
				            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `Subscription` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
					
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this Subscription
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Subscription with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Subscription';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("StartDate" => $this->dttStartDate));
            $ChangedArray = array_merge($ChangedArray,array("EndDate" => $this->dttEndDate));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("Account" => $this->intAccount));
            $ChangedArray = array_merge($ChangedArray,array("Course" => $this->intCourse));
            $ChangedArray = array_merge($ChangedArray,array("Assignment" => $this->intAssignment));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting Subscription. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Subscription`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this Subscription ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Subscription', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all Subscriptions
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Subscription`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate Subscription table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `Subscription`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this Subscription from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved Subscription object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = Subscription::Load($this->intId);

			// Update $this's local variables to match
			$this->dttStartDate = $objReloaded->dttStartDate;
			$this->dttEndDate = $objReloaded->dttEndDate;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
			$this->Account = $objReloaded->Account;
			$this->Course = $objReloaded->Course;
			$this->Assignment = $objReloaded->Assignment;
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

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;

				case 'Account':
					/**
					 * Gets the value for intAccount 
					 * @return integer
					 */
					return $this->intAccount;

				case 'Course':
					/**
					 * Gets the value for intCourse 
					 * @return integer
					 */
					return $this->intCourse;

				case 'Assignment':
					/**
					 * Gets the value for intAssignment 
					 * @return integer
					 */
					return $this->intAssignment;


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

				case 'CourseObject':
					/**
					 * Gets the value for the Course object referenced by intCourse 
					 * @return Course
					 */
					try {
						if ((!$this->objCourseObject) && (!is_null($this->intCourse)))
							$this->objCourseObject = Course::Load($this->intCourse);
						return $this->objCourseObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AssignmentObject':
					/**
					 * Gets the value for the Assignment object referenced by intAssignment 
					 * @return Assignment
					 */
					try {
						if ((!$this->objAssignmentObject) && (!is_null($this->intAssignment)))
							$this->objAssignmentObject = Assignment::Load($this->intAssignment);
						return $this->objAssignmentObject;
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

				case 'Course':
					/**
					 * Sets the value for intCourse 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objCourseObject = null;
						return ($this->intCourse = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Assignment':
					/**
					 * Sets the value for intAssignment 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objAssignmentObject = null;
						return ($this->intAssignment = QType::Cast($mixValue, QType::Integer));
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
							throw new QCallerException('Unable to set an unsaved AccountObject for this Subscription');

						// Update Local Member Variables
						$this->objAccountObject = $mixValue;
						$this->intAccount = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'CourseObject':
					/**
					 * Sets the value for the Course object referenced by intCourse 
					 * @param Course $mixValue
					 * @return Course
					 */
					if (is_null($mixValue)) {
						$this->intCourse = null;
						$this->objCourseObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Course object
						try {
							$mixValue = QType::Cast($mixValue, 'Course');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Course object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved CourseObject for this Subscription');

						// Update Local Member Variables
						$this->objCourseObject = $mixValue;
						$this->intCourse = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'AssignmentObject':
					/**
					 * Sets the value for the Assignment object referenced by intAssignment 
					 * @param Assignment $mixValue
					 * @return Assignment
					 */
					if (is_null($mixValue)) {
						$this->intAssignment = null;
						$this->objAssignmentObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Assignment object
						try {
							$mixValue = QType::Cast($mixValue, 'Assignment');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Assignment object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved AssignmentObject for this Subscription');

						// Update Local Member Variables
						$this->objAssignmentObject = $mixValue;
						$this->intAssignment = $mixValue->Id;

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
			return "Subscription";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[Subscription::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="Subscription"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="StartDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="EndDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="AccountObject" type="xsd1:Account"/>';
			$strToReturn .= '<element name="CourseObject" type="xsd1:Course"/>';
			$strToReturn .= '<element name="AssignmentObject" type="xsd1:Assignment"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Subscription', $strComplexTypeArray)) {
				$strComplexTypeArray['Subscription'] = Subscription::GetSoapComplexTypeXml();
				Account::AlterSoapComplexTypeArray($strComplexTypeArray);
				Course::AlterSoapComplexTypeArray($strComplexTypeArray);
				Assignment::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Subscription::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Subscription();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'StartDate'))
				$objToReturn->dttStartDate = new QDateTime($objSoapObject->StartDate);
			if (property_exists($objSoapObject, 'EndDate'))
				$objToReturn->dttEndDate = new QDateTime($objSoapObject->EndDate);
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if ((property_exists($objSoapObject, 'AccountObject')) &&
				($objSoapObject->AccountObject))
				$objToReturn->AccountObject = Account::GetObjectFromSoapObject($objSoapObject->AccountObject);
			if ((property_exists($objSoapObject, 'CourseObject')) &&
				($objSoapObject->CourseObject))
				$objToReturn->CourseObject = Course::GetObjectFromSoapObject($objSoapObject->CourseObject);
			if ((property_exists($objSoapObject, 'AssignmentObject')) &&
				($objSoapObject->AssignmentObject))
				$objToReturn->AssignmentObject = Assignment::GetObjectFromSoapObject($objSoapObject->AssignmentObject);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Subscription::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttStartDate)
				$objObject->dttStartDate = $objObject->dttStartDate->qFormat(QDateTime::FormatSoap);
			if ($objObject->dttEndDate)
				$objObject->dttEndDate = $objObject->dttEndDate->qFormat(QDateTime::FormatSoap);
			if ($objObject->objAccountObject)
				$objObject->objAccountObject = Account::GetSoapObjectFromObject($objObject->objAccountObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAccount = null;
			if ($objObject->objCourseObject)
				$objObject->objCourseObject = Course::GetSoapObjectFromObject($objObject->objCourseObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCourse = null;
			if ($objObject->objAssignmentObject)
				$objObject->objAssignmentObject = Assignment::GetSoapObjectFromObject($objObject->objAssignmentObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAssignment = null;
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
			$iArray['StartDate'] = $this->dttStartDate;
			$iArray['EndDate'] = $this->dttEndDate;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
			$iArray['Account'] = $this->intAccount;
			$iArray['Course'] = $this->intCourse;
			$iArray['Assignment'] = $this->intAssignment;
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
     * @property-read QQNode $StartDate
     * @property-read QQNode $EndDate
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $Account
     * @property-read QQNodeAccount $AccountObject
     * @property-read QQNode $Course
     * @property-read QQNodeCourse $CourseObject
     * @property-read QQNode $Assignment
     * @property-read QQNodeAssignment $AssignmentObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeSubscription extends QQNode {
		protected $strTableName = 'Subscription';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Subscription';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'StartDate':
					return new QQNode('StartDate', 'StartDate', 'Date', $this);
				case 'EndDate':
					return new QQNode('EndDate', 'EndDate', 'Date', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'Account':
					return new QQNode('Account', 'Account', 'Integer', $this);
				case 'AccountObject':
					return new QQNodeAccount('Account', 'AccountObject', 'Integer', $this);
				case 'Course':
					return new QQNode('Course', 'Course', 'Integer', $this);
				case 'CourseObject':
					return new QQNodeCourse('Course', 'CourseObject', 'Integer', $this);
				case 'Assignment':
					return new QQNode('Assignment', 'Assignment', 'Integer', $this);
				case 'AssignmentObject':
					return new QQNodeAssignment('Assignment', 'AssignmentObject', 'Integer', $this);

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
     * @property-read QQNode $StartDate
     * @property-read QQNode $EndDate
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $Account
     * @property-read QQNodeAccount $AccountObject
     * @property-read QQNode $Course
     * @property-read QQNodeCourse $CourseObject
     * @property-read QQNode $Assignment
     * @property-read QQNodeAssignment $AssignmentObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeSubscription extends QQReverseReferenceNode {
		protected $strTableName = 'Subscription';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Subscription';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'StartDate':
					return new QQNode('StartDate', 'StartDate', 'QDateTime', $this);
				case 'EndDate':
					return new QQNode('EndDate', 'EndDate', 'QDateTime', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'Account':
					return new QQNode('Account', 'Account', 'integer', $this);
				case 'AccountObject':
					return new QQNodeAccount('Account', 'AccountObject', 'integer', $this);
				case 'Course':
					return new QQNode('Course', 'Course', 'integer', $this);
				case 'CourseObject':
					return new QQNodeCourse('Course', 'CourseObject', 'integer', $this);
				case 'Assignment':
					return new QQNode('Assignment', 'Assignment', 'integer', $this);
				case 'AssignmentObject':
					return new QQNodeAssignment('Assignment', 'AssignmentObject', 'integer', $this);

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