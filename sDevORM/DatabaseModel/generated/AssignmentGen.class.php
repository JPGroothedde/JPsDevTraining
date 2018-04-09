<?php
	/**
	 * The abstract AssignmentGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Assignment subclass which
	 * extends this AssignmentGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Assignment class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $AssignmentName the value for strAssignmentName 
	 * @property string $Status the value for strStatus 
	 * @property integer $FinalMark the value for intFinalMark 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $Subscription the value for intSubscription 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property Subscription $SubscriptionObject the value for the Subscription object referenced by intSubscription 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class AssignmentGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column Assignment.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column Assignment.AssignmentName
		 * @var string strAssignmentName
		 */
		protected $strAssignmentName;
		const AssignmentNameMaxLength = 20;
		const AssignmentNameDefault = null;


		/**
		 * Protected member variable that maps to the database column Assignment.Status
		 * @var string strStatus
		 */
		protected $strStatus;
		const StatusMaxLength = 20;
		const StatusDefault = null;


		/**
		 * Protected member variable that maps to the database column Assignment.FinalMark
		 * @var integer intFinalMark
		 */
		protected $intFinalMark;
		const FinalMarkDefault = null;


		/**
		 * Protected member variable that maps to the database column Assignment.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column Assignment.Subscription
		 * @var integer intSubscription
		 */
		protected $intSubscription;
		const SubscriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column Assignment.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


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
		 * in the database column Assignment.Subscription.
		 *
		 * NOTE: Always use the SubscriptionObject property getter to correctly retrieve this Subscription object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Subscription objSubscriptionObject
		 */
		protected $objSubscriptionObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = Assignment::IdDefault;
			$this->strAssignmentName = Assignment::AssignmentNameDefault;
			$this->strStatus = Assignment::StatusDefault;
			$this->intFinalMark = Assignment::FinalMarkDefault;
			$this->strLastUpdated = Assignment::LastUpdatedDefault;
			$this->intSubscription = Assignment::SubscriptionDefault;
			$this->strSearchMetaInfo = Assignment::SearchMetaInfoDefault;
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
		 * Load a Assignment from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Assignment
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Assignment', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = Assignment::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Assignment()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all Assignments
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Assignment[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call Assignment::QueryArray to perform the LoadAll query
			try {
				return Assignment::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Assignments
		 * @return int
		 */
		public static function CountAll() {
			// Call Assignment::QueryCount to perform the CountAll query
			return Assignment::QueryCount(QQ::All());
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
			$objDatabase = Assignment::GetDatabase();

			// Create/Build out the QueryBuilder object with Assignment-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'Assignment');

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
				Assignment::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('Assignment');

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
		 * Static Qcubed Query method to query for a single Assignment object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Assignment the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Assignment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Assignment object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Assignment::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return Assignment::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of Assignment objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Assignment[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Assignment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Assignment::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = Assignment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of Assignment objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Assignment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Assignment::GetDatabase();

			$strQuery = Assignment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/assignment', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = Assignment::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Assignment
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'Assignment';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'AssignmentName', $strAliasPrefix . 'AssignmentName');
			    $objBuilder->AddSelectItem($strTableName, 'Status', $strAliasPrefix . 'Status');
			    $objBuilder->AddSelectItem($strTableName, 'FinalMark', $strAliasPrefix . 'FinalMark');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'Subscription', $strAliasPrefix . 'Subscription');
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
		 * Instantiate a Assignment from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Assignment::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a Assignment, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (Assignment::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the Assignment object
			$objToReturn = new Assignment();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'AssignmentName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strAssignmentName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Status';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strStatus = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'FinalMark';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intFinalMark = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Subscription';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intSubscription = $objDbRow->GetColumn($strAliasName, 'Integer');
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
				$strAliasPrefix = 'Assignment__';

			// Check for SubscriptionObject Early Binding
			$strAlias = $strAliasPrefix . 'Subscription__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Subscription']) ? null : $objExpansionAliasArray['Subscription']);
				$objToReturn->objSubscriptionObject = Subscription::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Subscription__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of Assignments from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return Assignment[]
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
					$objItem = Assignment::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = Assignment::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single Assignment object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return Assignment next row resulting from the query
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
			return Assignment::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single Assignment object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Assignment
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return Assignment::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Assignment()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of Assignment objects,
		 * by Subscription Index(es)
		 * @param integer $intSubscription
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Assignment[]
		*/
		public static function LoadArrayBySubscription($intSubscription, $objOptionalClauses = null) {
			// Call Assignment::QueryArray to perform the LoadArrayBySubscription query
			try {
				return Assignment::QueryArray(
					QQ::Equal(QQN::Assignment()->Subscription, $intSubscription),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Assignments
		 * by Subscription Index(es)
		 * @param integer $intSubscription
		 * @return int
		*/
		public static function CountBySubscription($intSubscription) {
			// Call Assignment::QueryCount to perform the CountBySubscription query
			return Assignment::QueryCount(
				QQ::Equal(QQN::Assignment()->Subscription, $intSubscription)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this Assignment
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = Assignment::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = Assignment::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Assignment';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("AssignmentName" => $this->strAssignmentName));
                $ChangedArray = array_merge($ChangedArray,array("Status" => $this->strStatus));
                $ChangedArray = array_merge($ChangedArray,array("FinalMark" => $this->intFinalMark));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("Subscription" => $this->intSubscription));
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
                if (!is_null($ExistingObj->AssignmentName)) {
                    $ExistingValueStr = $ExistingObj->AssignmentName;
                }
                if ($ExistingObj->AssignmentName != $this->strAssignmentName) {
                    $ChangedArray = array_merge($ChangedArray,array("AssignmentName" => array("Before" => $ExistingValueStr,"After" => $this->strAssignmentName)));
                    //$ChangedArray = array_merge($ChangedArray,array("AssignmentName" => "From: ".$ExistingValueStr." to: ".$this->strAssignmentName));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Status)) {
                    $ExistingValueStr = $ExistingObj->Status;
                }
                if ($ExistingObj->Status != $this->strStatus) {
                    $ChangedArray = array_merge($ChangedArray,array("Status" => array("Before" => $ExistingValueStr,"After" => $this->strStatus)));
                    //$ChangedArray = array_merge($ChangedArray,array("Status" => "From: ".$ExistingValueStr." to: ".$this->strStatus));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->FinalMark)) {
                    $ExistingValueStr = $ExistingObj->FinalMark;
                }
                if ($ExistingObj->FinalMark != $this->intFinalMark) {
                    $ChangedArray = array_merge($ChangedArray,array("FinalMark" => array("Before" => $ExistingValueStr,"After" => $this->intFinalMark)));
                    //$ChangedArray = array_merge($ChangedArray,array("FinalMark" => "From: ".$ExistingValueStr." to: ".$this->intFinalMark));
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
                if (!is_null($ExistingObj->Subscription)) {
                    $ExistingValueStr = $ExistingObj->Subscription;
                }
                if ($ExistingObj->Subscription != $this->intSubscription) {
                    $ChangedArray = array_merge($ChangedArray,array("Subscription" => array("Before" => $ExistingValueStr,"After" => $this->intSubscription)));
                    //$ChangedArray = array_merge($ChangedArray,array("Subscription" => "From: ".$ExistingValueStr." to: ".$this->intSubscription));
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
                    INSERT INTO `Assignment` (
							`AssignmentName`,
							`Status`,
							`FinalMark`,
							`Subscription`,
							`SearchMetaInfo`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strAssignmentName) . ',
							' . $objDatabase->SqlVariable($this->strStatus) . ',
							' . $objDatabase->SqlVariable($this->intFinalMark) . ',
							' . $objDatabase->SqlVariable($this->intSubscription) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('Assignment', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
					
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `Assignment` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('Assignment');
                }
			
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `Assignment` SET
							`AssignmentName` = ' . $objDatabase->SqlVariable($this->strAssignmentName) . ',
							`Status` = ' . $objDatabase->SqlVariable($this->strStatus) . ',
							`FinalMark` = ' . $objDatabase->SqlVariable($this->intFinalMark) . ',
							`Subscription` = ' . $objDatabase->SqlVariable($this->intSubscription) . ',
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
                error_log('Could not save audit log while saving Assignment. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
					            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `Assignment` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
			
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this Assignment
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Assignment with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Assignment::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Assignment';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("AssignmentName" => $this->strAssignmentName));
            $ChangedArray = array_merge($ChangedArray,array("Status" => $this->strStatus));
            $ChangedArray = array_merge($ChangedArray,array("FinalMark" => $this->intFinalMark));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("Subscription" => $this->intSubscription));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting Assignment. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Assignment`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this Assignment ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Assignment', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all Assignments
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Assignment::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Assignment`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate Assignment table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Assignment::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `Assignment`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this Assignment from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved Assignment object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = Assignment::Load($this->intId);

			// Update $this's local variables to match
			$this->strAssignmentName = $objReloaded->strAssignmentName;
			$this->strStatus = $objReloaded->strStatus;
			$this->intFinalMark = $objReloaded->intFinalMark;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->Subscription = $objReloaded->Subscription;
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

				case 'AssignmentName':
					/**
					 * Gets the value for strAssignmentName 
					 * @return string
					 */
					return $this->strAssignmentName;

				case 'Status':
					/**
					 * Gets the value for strStatus 
					 * @return string
					 */
					return $this->strStatus;

				case 'FinalMark':
					/**
					 * Gets the value for intFinalMark 
					 * @return integer
					 */
					return $this->intFinalMark;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'Subscription':
					/**
					 * Gets the value for intSubscription 
					 * @return integer
					 */
					return $this->intSubscription;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;


				///////////////////
				// Member Objects
				///////////////////
				case 'SubscriptionObject':
					/**
					 * Gets the value for the Subscription object referenced by intSubscription 
					 * @return Subscription
					 */
					try {
						if ((!$this->objSubscriptionObject) && (!is_null($this->intSubscription)))
							$this->objSubscriptionObject = Subscription::Load($this->intSubscription);
						return $this->objSubscriptionObject;
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
				case 'AssignmentName':
					/**
					 * Sets the value for strAssignmentName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAssignmentName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Status':
					/**
					 * Sets the value for strStatus 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strStatus = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FinalMark':
					/**
					 * Sets the value for intFinalMark 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intFinalMark = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Subscription':
					/**
					 * Sets the value for intSubscription 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objSubscriptionObject = null;
						return ($this->intSubscription = QType::Cast($mixValue, QType::Integer));
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
				case 'SubscriptionObject':
					/**
					 * Sets the value for the Subscription object referenced by intSubscription 
					 * @param Subscription $mixValue
					 * @return Subscription
					 */
					if (is_null($mixValue)) {
						$this->intSubscription = null;
						$this->objSubscriptionObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Subscription object
						try {
							$mixValue = QType::Cast($mixValue, 'Subscription');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Subscription object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved SubscriptionObject for this Assignment');

						// Update Local Member Variables
						$this->objSubscriptionObject = $mixValue;
						$this->intSubscription = $mixValue->Id;

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
			return "Assignment";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[Assignment::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="Assignment"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="AssignmentName" type="xsd:string"/>';
			$strToReturn .= '<element name="Status" type="xsd:string"/>';
			$strToReturn .= '<element name="FinalMark" type="xsd:int"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="SubscriptionObject" type="xsd1:Subscription"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Assignment', $strComplexTypeArray)) {
				$strComplexTypeArray['Assignment'] = Assignment::GetSoapComplexTypeXml();
				Subscription::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Assignment::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Assignment();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'AssignmentName'))
				$objToReturn->strAssignmentName = $objSoapObject->AssignmentName;
			if (property_exists($objSoapObject, 'Status'))
				$objToReturn->strStatus = $objSoapObject->Status;
			if (property_exists($objSoapObject, 'FinalMark'))
				$objToReturn->intFinalMark = $objSoapObject->FinalMark;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'SubscriptionObject')) &&
				($objSoapObject->SubscriptionObject))
				$objToReturn->SubscriptionObject = Subscription::GetObjectFromSoapObject($objSoapObject->SubscriptionObject);
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
				array_push($objArrayToReturn, Assignment::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objSubscriptionObject)
				$objObject->objSubscriptionObject = Subscription::GetSoapObjectFromObject($objObject->objSubscriptionObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intSubscription = null;
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
			$iArray['AssignmentName'] = $this->strAssignmentName;
			$iArray['Status'] = $this->strStatus;
			$iArray['FinalMark'] = $this->intFinalMark;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['Subscription'] = $this->intSubscription;
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
     * @property-read QQNode $AssignmentName
     * @property-read QQNode $Status
     * @property-read QQNode $FinalMark
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Subscription
     * @property-read QQNodeSubscription $SubscriptionObject
     * @property-read QQNode $SearchMetaInfo
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeAssignment extends QQNode {
		protected $strTableName = 'Assignment';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Assignment';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'AssignmentName':
					return new QQNode('AssignmentName', 'AssignmentName', 'VarChar', $this);
				case 'Status':
					return new QQNode('Status', 'Status', 'VarChar', $this);
				case 'FinalMark':
					return new QQNode('FinalMark', 'FinalMark', 'Integer', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'Subscription':
					return new QQNode('Subscription', 'Subscription', 'Integer', $this);
				case 'SubscriptionObject':
					return new QQNodeSubscription('Subscription', 'SubscriptionObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);

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
     * @property-read QQNode $AssignmentName
     * @property-read QQNode $Status
     * @property-read QQNode $FinalMark
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Subscription
     * @property-read QQNodeSubscription $SubscriptionObject
     * @property-read QQNode $SearchMetaInfo
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeAssignment extends QQReverseReferenceNode {
		protected $strTableName = 'Assignment';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Assignment';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'AssignmentName':
					return new QQNode('AssignmentName', 'AssignmentName', 'string', $this);
				case 'Status':
					return new QQNode('Status', 'Status', 'string', $this);
				case 'FinalMark':
					return new QQNode('FinalMark', 'FinalMark', 'integer', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'Subscription':
					return new QQNode('Subscription', 'Subscription', 'integer', $this);
				case 'SubscriptionObject':
					return new QQNodeSubscription('Subscription', 'SubscriptionObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);

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
