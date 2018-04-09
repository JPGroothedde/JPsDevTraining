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
	 * @property double $AverageMark the value for fltAverageMark 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $Student the value for intStudent 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property integer $Course the value for intCourse 
	 * @property Student $StudentObject the value for the Student object referenced by intStudent 
	 * @property Course $CourseObject the value for the Course object referenced by intCourse 
	 * @property-read Assignment $_Assignment the value for the private _objAssignment (Read-Only) if set due to an expansion on the Assignment.Subscription reverse relationship
	 * @property-read Assignment[] $_AssignmentArray the value for the private _objAssignmentArray (Read-Only) if set due to an ExpandAsArray on the Assignment.Subscription reverse relationship
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
		 * Protected member variable that maps to the database column Subscription.AverageMark
		 * @var double fltAverageMark
		 */
		protected $fltAverageMark;
		const AverageMarkDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.Student
		 * @var integer intStudent
		 */
		protected $intStudent;
		const StudentDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column Subscription.Course
		 * @var integer intCourse
		 */
		protected $intCourse;
		const CourseDefault = null;


		/**
		 * Private member variable that stores a reference to a single Assignment object
		 * (of type Assignment), if this Subscription object was restored with
		 * an expansion on the Assignment association table.
		 * @var Assignment _objAssignment;
		 */
		private $_objAssignment;

		/**
		 * Private member variable that stores a reference to an array of Assignment objects
		 * (of type Assignment[]), if this Subscription object was restored with
		 * an ExpandAsArray on the Assignment association table.
		 * @var Assignment[] _objAssignmentArray;
		 */
		private $_objAssignmentArray = null;

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
		 * in the database column Subscription.Student.
		 *
		 * NOTE: Always use the StudentObject property getter to correctly retrieve this Student object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Student objStudentObject
		 */
		protected $objStudentObject;

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
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = Subscription::IdDefault;
			$this->dttStartDate = (Subscription::StartDateDefault === null)?null:new QDateTime(Subscription::StartDateDefault);
			$this->dttEndDate = (Subscription::EndDateDefault === null)?null:new QDateTime(Subscription::EndDateDefault);
			$this->fltAverageMark = Subscription::AverageMarkDefault;
			$this->strLastUpdated = Subscription::LastUpdatedDefault;
			$this->intStudent = Subscription::StudentDefault;
			$this->strSearchMetaInfo = Subscription::SearchMetaInfoDefault;
			$this->intCourse = Subscription::CourseDefault;
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
			    $objBuilder->AddSelectItem($strTableName, 'AverageMark', $strAliasPrefix . 'AverageMark');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'Student', $strAliasPrefix . 'Student');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
			    $objBuilder->AddSelectItem($strTableName, 'Course', $strAliasPrefix . 'Course');
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
			$strAlias = $strAliasPrefix . 'AverageMark';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->fltAverageMark = $objDbRow->GetColumn($strAliasName, 'Float');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Student';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intStudent = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Course';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intCourse = $objDbRow->GetColumn($strAliasName, 'Integer');

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

			// Check for StudentObject Early Binding
			$strAlias = $strAliasPrefix . 'Student__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Student']) ? null : $objExpansionAliasArray['Student']);
				$objToReturn->objStudentObject = Student::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Student__', $objExpansionNode, null, $strColumnAliasArray);
			}
			// Check for CourseObject Early Binding
			$strAlias = $strAliasPrefix . 'Course__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Course']) ? null : $objExpansionAliasArray['Course']);
				$objToReturn->objCourseObject = Course::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Course__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			// Check for Assignment Virtual Binding
			$strAlias = $strAliasPrefix . 'assignment__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['assignment']) ? null : $objExpansionAliasArray['assignment']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objAssignmentArray)
				$objToReturn->_objAssignmentArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objAssignmentArray[] = Assignment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assignment__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objAssignment)) {
					$objToReturn->_objAssignment = Assignment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assignment__', $objExpansionNode, null, $strColumnAliasArray);
				}
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
		 * by Student Index(es)
		 * @param integer $intStudent
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Subscription[]
		*/
		public static function LoadArrayByStudent($intStudent, $objOptionalClauses = null) {
			// Call Subscription::QueryArray to perform the LoadArrayByStudent query
			try {
				return Subscription::QueryArray(
					QQ::Equal(QQN::Subscription()->Student, $intStudent),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Subscriptions
		 * by Student Index(es)
		 * @param integer $intStudent
		 * @return int
		*/
		public static function CountByStudent($intStudent) {
			// Call Subscription::QueryCount to perform the CountByStudent query
			return Subscription::QueryCount(
				QQ::Equal(QQN::Subscription()->Student, $intStudent)
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
                $ChangedArray = array_merge($ChangedArray,array("AverageMark" => $this->fltAverageMark));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("Student" => $this->intStudent));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
                $ChangedArray = array_merge($ChangedArray,array("Course" => $this->intCourse));
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
                if (!is_null($ExistingObj->AverageMark)) {
                    $ExistingValueStr = $ExistingObj->AverageMark;
                }
                if ($ExistingObj->AverageMark != $this->fltAverageMark) {
                    $ChangedArray = array_merge($ChangedArray,array("AverageMark" => array("Before" => $ExistingValueStr,"After" => $this->fltAverageMark)));
                    //$ChangedArray = array_merge($ChangedArray,array("AverageMark" => "From: ".$ExistingValueStr." to: ".$this->fltAverageMark));
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
                if (!is_null($ExistingObj->Student)) {
                    $ExistingValueStr = $ExistingObj->Student;
                }
                if ($ExistingObj->Student != $this->intStudent) {
                    $ChangedArray = array_merge($ChangedArray,array("Student" => array("Before" => $ExistingValueStr,"After" => $this->intStudent)));
                    //$ChangedArray = array_merge($ChangedArray,array("Student" => "From: ".$ExistingValueStr." to: ".$this->intStudent));
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
                if (!is_null($ExistingObj->Course)) {
                    $ExistingValueStr = $ExistingObj->Course;
                }
                if ($ExistingObj->Course != $this->intCourse) {
                    $ChangedArray = array_merge($ChangedArray,array("Course" => array("Before" => $ExistingValueStr,"After" => $this->intCourse)));
                    //$ChangedArray = array_merge($ChangedArray,array("Course" => "From: ".$ExistingValueStr." to: ".$this->intCourse));
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
							`AverageMark`,
							`Student`,
							`SearchMetaInfo`,
							`Course`
						) VALUES (
							' . $objDatabase->SqlVariable($this->dttStartDate) . ',
							' . $objDatabase->SqlVariable($this->dttEndDate) . ',
							' . $objDatabase->SqlVariable($this->fltAverageMark) . ',
							' . $objDatabase->SqlVariable($this->intStudent) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->intCourse) . '
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
							`AverageMark` = ' . $objDatabase->SqlVariable($this->fltAverageMark) . ',
							`Student` = ' . $objDatabase->SqlVariable($this->intStudent) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							`Course` = ' . $objDatabase->SqlVariable($this->intCourse) . '
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
            $ChangedArray = array_merge($ChangedArray,array("AverageMark" => $this->fltAverageMark));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("Student" => $this->intStudent));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("Course" => $this->intCourse));
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
			$this->fltAverageMark = $objReloaded->fltAverageMark;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->Student = $objReloaded->Student;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
			$this->Course = $objReloaded->Course;
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

				case 'AverageMark':
					/**
					 * Gets the value for fltAverageMark 
					 * @return double
					 */
					return $this->fltAverageMark;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'Student':
					/**
					 * Gets the value for intStudent 
					 * @return integer
					 */
					return $this->intStudent;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;

				case 'Course':
					/**
					 * Gets the value for intCourse 
					 * @return integer
					 */
					return $this->intCourse;


				///////////////////
				// Member Objects
				///////////////////
				case 'StudentObject':
					/**
					 * Gets the value for the Student object referenced by intStudent 
					 * @return Student
					 */
					try {
						if ((!$this->objStudentObject) && (!is_null($this->intStudent)))
							$this->objStudentObject = Student::Load($this->intStudent);
						return $this->objStudentObject;
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


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_Assignment':
					/**
					 * Gets the value for the private _objAssignment (Read-Only)
					 * if set due to an expansion on the Assignment.Subscription reverse relationship
					 * @return Assignment
					 */
					return $this->_objAssignment;

				case '_AssignmentArray':
					/**
					 * Gets the value for the private _objAssignmentArray (Read-Only)
					 * if set due to an ExpandAsArray on the Assignment.Subscription reverse relationship
					 * @return Assignment[]
					 */
					return $this->_objAssignmentArray;


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

				case 'AverageMark':
					/**
					 * Sets the value for fltAverageMark 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltAverageMark = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Student':
					/**
					 * Sets the value for intStudent 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objStudentObject = null;
						return ($this->intStudent = QType::Cast($mixValue, QType::Integer));
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


				///////////////////
				// Member Objects
				///////////////////
				case 'StudentObject':
					/**
					 * Sets the value for the Student object referenced by intStudent 
					 * @param Student $mixValue
					 * @return Student
					 */
					if (is_null($mixValue)) {
						$this->intStudent = null;
						$this->objStudentObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Student object
						try {
							$mixValue = QType::Cast($mixValue, 'Student');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Student object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved StudentObject for this Subscription');

						// Update Local Member Variables
						$this->objStudentObject = $mixValue;
						$this->intStudent = $mixValue->Id;

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



		// Related Objects' Methods for Assignment
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Assignments as an array of Assignment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Assignment[]
		*/
		public function GetAssignmentArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Assignment::LoadArrayBySubscription($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Assignments
		 * @return int
		*/
		public function CountAssignments() {
			if ((is_null($this->intId)))
				return 0;

			return Assignment::CountBySubscription($this->intId);
		}

		/**
		 * Associates a Assignment
		 * @param Assignment $objAssignment
		 * @return void
		*/
		public function AssociateAssignment(Assignment $objAssignment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssignment on this unsaved Subscription.');
			if ((is_null($objAssignment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssignment on this Subscription with an unsaved Assignment.');

			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Assignment`
				SET
					`Subscription` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objAssignment->Id) . '
			');
		}

		/**
		 * Unassociates a Assignment
		 * @param Assignment $objAssignment
		 * @return void
		*/
		public function UnassociateAssignment(Assignment $objAssignment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssignment on this unsaved Subscription.');
			if ((is_null($objAssignment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssignment on this Subscription with an unsaved Assignment.');

			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Assignment`
				SET
					`Subscription` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objAssignment->Id) . ' AND
					`Subscription` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Assignments
		 * @return void
		*/
		public function UnassociateAllAssignments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssignment on this unsaved Subscription.');

			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Assignment`
				SET
					`Subscription` = null
				WHERE
					`Subscription` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Assignment
		 * @param Assignment $objAssignment
		 * @return void
		*/
		public function DeleteAssociatedAssignment(Assignment $objAssignment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssignment on this unsaved Subscription.');
			if ((is_null($objAssignment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssignment on this Subscription with an unsaved Assignment.');

			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Assignment`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objAssignment->Id) . ' AND
					`Subscription` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Assignments
		 * @return void
		*/
		public function DeleteAllAssignments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssignment on this unsaved Subscription.');

			// Get the Database Object for this Class
			$objDatabase = Subscription::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Assignment`
				WHERE
					`Subscription` = ' . $objDatabase->SqlVariable($this->intId) . '
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
			$strToReturn .= '<element name="AverageMark" type="xsd:float"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="StudentObject" type="xsd1:Student"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="CourseObject" type="xsd1:Course"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Subscription', $strComplexTypeArray)) {
				$strComplexTypeArray['Subscription'] = Subscription::GetSoapComplexTypeXml();
				Student::AlterSoapComplexTypeArray($strComplexTypeArray);
				Course::AlterSoapComplexTypeArray($strComplexTypeArray);
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
			if (property_exists($objSoapObject, 'AverageMark'))
				$objToReturn->fltAverageMark = $objSoapObject->AverageMark;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'StudentObject')) &&
				($objSoapObject->StudentObject))
				$objToReturn->StudentObject = Student::GetObjectFromSoapObject($objSoapObject->StudentObject);
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if ((property_exists($objSoapObject, 'CourseObject')) &&
				($objSoapObject->CourseObject))
				$objToReturn->CourseObject = Course::GetObjectFromSoapObject($objSoapObject->CourseObject);
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
			if ($objObject->objStudentObject)
				$objObject->objStudentObject = Student::GetSoapObjectFromObject($objObject->objStudentObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intStudent = null;
			if ($objObject->objCourseObject)
				$objObject->objCourseObject = Course::GetSoapObjectFromObject($objObject->objCourseObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCourse = null;
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
			$iArray['AverageMark'] = $this->fltAverageMark;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['Student'] = $this->intStudent;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
			$iArray['Course'] = $this->intCourse;
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
     * @property-read QQNode $AverageMark
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Student
     * @property-read QQNodeStudent $StudentObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $Course
     * @property-read QQNodeCourse $CourseObject
     *
     *
     * @property-read QQReverseReferenceNodeAssignment $Assignment

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
				case 'AverageMark':
					return new QQNode('AverageMark', 'AverageMark', 'Float', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'Student':
					return new QQNode('Student', 'Student', 'Integer', $this);
				case 'StudentObject':
					return new QQNodeStudent('Student', 'StudentObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'Course':
					return new QQNode('Course', 'Course', 'Integer', $this);
				case 'CourseObject':
					return new QQNodeCourse('Course', 'CourseObject', 'Integer', $this);
				case 'Assignment':
					return new QQReverseReferenceNodeAssignment($this, 'assignment', 'reverse_reference', 'Subscription', 'Assignment');

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
     * @property-read QQNode $AverageMark
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Student
     * @property-read QQNodeStudent $StudentObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $Course
     * @property-read QQNodeCourse $CourseObject
     *
     *
     * @property-read QQReverseReferenceNodeAssignment $Assignment

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
				case 'AverageMark':
					return new QQNode('AverageMark', 'AverageMark', 'double', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'Student':
					return new QQNode('Student', 'Student', 'integer', $this);
				case 'StudentObject':
					return new QQNodeStudent('Student', 'StudentObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'Course':
					return new QQNode('Course', 'Course', 'integer', $this);
				case 'CourseObject':
					return new QQNodeCourse('Course', 'CourseObject', 'integer', $this);
				case 'Assignment':
					return new QQReverseReferenceNodeAssignment($this, 'assignment', 'reverse_reference', 'Subscription', 'Assignment');

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
