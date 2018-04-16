<?php
	/**
	 * The abstract EmailTemplateContentRowGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the EmailTemplateContentRow subclass which
	 * extends this EmailTemplateContentRowGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the EmailTemplateContentRow class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property integer $Columns the value for intColumns 
	 * @property integer $RowOrder the value for intRowOrder 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $EmailTemplate the value for intEmailTemplate 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property EmailTemplate $EmailTemplateObject the value for the EmailTemplate object referenced by intEmailTemplate 
	 * @property-read EmailTemplateContentBlock $_EmailTemplateContentBlock the value for the private _objEmailTemplateContentBlock (Read-Only) if set due to an expansion on the EmailTemplateContentBlock.EmailTemplateContentRow reverse relationship
	 * @property-read EmailTemplateContentBlock[] $_EmailTemplateContentBlockArray the value for the private _objEmailTemplateContentBlockArray (Read-Only) if set due to an ExpandAsArray on the EmailTemplateContentBlock.EmailTemplateContentRow reverse relationship
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class EmailTemplateContentRowGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column EmailTemplateContentRow.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplateContentRow.Columns
		 * @var integer intColumns
		 */
		protected $intColumns;
		const ColumnsDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplateContentRow.RowOrder
		 * @var integer intRowOrder
		 */
		protected $intRowOrder;
		const RowOrderDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplateContentRow.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplateContentRow.EmailTemplate
		 * @var integer intEmailTemplate
		 */
		protected $intEmailTemplate;
		const EmailTemplateDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplateContentRow.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Private member variable that stores a reference to a single EmailTemplateContentBlock object
		 * (of type EmailTemplateContentBlock), if this EmailTemplateContentRow object was restored with
		 * an expansion on the EmailTemplateContentBlock association table.
		 * @var EmailTemplateContentBlock _objEmailTemplateContentBlock;
		 */
		private $_objEmailTemplateContentBlock;

		/**
		 * Private member variable that stores a reference to an array of EmailTemplateContentBlock objects
		 * (of type EmailTemplateContentBlock[]), if this EmailTemplateContentRow object was restored with
		 * an ExpandAsArray on the EmailTemplateContentBlock association table.
		 * @var EmailTemplateContentBlock[] _objEmailTemplateContentBlockArray;
		 */
		private $_objEmailTemplateContentBlockArray = null;

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
		 * in the database column EmailTemplateContentRow.EmailTemplate.
		 *
		 * NOTE: Always use the EmailTemplateObject property getter to correctly retrieve this EmailTemplate object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var EmailTemplate objEmailTemplateObject
		 */
		protected $objEmailTemplateObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = EmailTemplateContentRow::IdDefault;
			$this->intColumns = EmailTemplateContentRow::ColumnsDefault;
			$this->intRowOrder = EmailTemplateContentRow::RowOrderDefault;
			$this->strLastUpdated = EmailTemplateContentRow::LastUpdatedDefault;
			$this->intEmailTemplate = EmailTemplateContentRow::EmailTemplateDefault;
			$this->strSearchMetaInfo = EmailTemplateContentRow::SearchMetaInfoDefault;
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
		 * Load a EmailTemplateContentRow from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplateContentRow
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmailTemplateContentRow', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = EmailTemplateContentRow::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailTemplateContentRow()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all EmailTemplateContentRows
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplateContentRow[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call EmailTemplateContentRow::QueryArray to perform the LoadAll query
			try {
				return EmailTemplateContentRow::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all EmailTemplateContentRows
		 * @return int
		 */
		public static function CountAll() {
			// Call EmailTemplateContentRow::QueryCount to perform the CountAll query
			return EmailTemplateContentRow::QueryCount(QQ::All());
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
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Create/Build out the QueryBuilder object with EmailTemplateContentRow-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'EmailTemplateContentRow');

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
				EmailTemplateContentRow::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('EmailTemplateContentRow');

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
		 * Static Qcubed Query method to query for a single EmailTemplateContentRow object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmailTemplateContentRow the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailTemplateContentRow::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new EmailTemplateContentRow object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = EmailTemplateContentRow::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return EmailTemplateContentRow::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of EmailTemplateContentRow objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmailTemplateContentRow[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailTemplateContentRow::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return EmailTemplateContentRow::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = EmailTemplateContentRow::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of EmailTemplateContentRow objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailTemplateContentRow::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			$strQuery = EmailTemplateContentRow::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/emailtemplatecontentrow', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = EmailTemplateContentRow::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this EmailTemplateContentRow
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'EmailTemplateContentRow';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'Columns', $strAliasPrefix . 'Columns');
			    $objBuilder->AddSelectItem($strTableName, 'RowOrder', $strAliasPrefix . 'RowOrder');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'EmailTemplate', $strAliasPrefix . 'EmailTemplate');
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
		 * Instantiate a EmailTemplateContentRow from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this EmailTemplateContentRow::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a EmailTemplateContentRow, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (EmailTemplateContentRow::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the EmailTemplateContentRow object
			$objToReturn = new EmailTemplateContentRow();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'Columns';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intColumns = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'RowOrder';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intRowOrder = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'EmailTemplate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intEmailTemplate = $objDbRow->GetColumn($strAliasName, 'Integer');
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
				$strAliasPrefix = 'EmailTemplateContentRow__';

			// Check for EmailTemplateObject Early Binding
			$strAlias = $strAliasPrefix . 'EmailTemplate__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['EmailTemplate']) ? null : $objExpansionAliasArray['EmailTemplate']);
				$objToReturn->objEmailTemplateObject = EmailTemplate::InstantiateDbRow($objDbRow, $strAliasPrefix . 'EmailTemplate__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			// Check for EmailTemplateContentBlock Virtual Binding
			$strAlias = $strAliasPrefix . 'emailtemplatecontentblock__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['emailtemplatecontentblock']) ? null : $objExpansionAliasArray['emailtemplatecontentblock']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objEmailTemplateContentBlockArray)
				$objToReturn->_objEmailTemplateContentBlockArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objEmailTemplateContentBlockArray[] = EmailTemplateContentBlock::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailtemplatecontentblock__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objEmailTemplateContentBlock)) {
					$objToReturn->_objEmailTemplateContentBlock = EmailTemplateContentBlock::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailtemplatecontentblock__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of EmailTemplateContentRows from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return EmailTemplateContentRow[]
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
					$objItem = EmailTemplateContentRow::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = EmailTemplateContentRow::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single EmailTemplateContentRow object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return EmailTemplateContentRow next row resulting from the query
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
			return EmailTemplateContentRow::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single EmailTemplateContentRow object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplateContentRow
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return EmailTemplateContentRow::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailTemplateContentRow()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of EmailTemplateContentRow objects,
		 * by EmailTemplate Index(es)
		 * @param integer $intEmailTemplate
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplateContentRow[]
		*/
		public static function LoadArrayByEmailTemplate($intEmailTemplate, $objOptionalClauses = null) {
			// Call EmailTemplateContentRow::QueryArray to perform the LoadArrayByEmailTemplate query
			try {
				return EmailTemplateContentRow::QueryArray(
					QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplate, $intEmailTemplate),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count EmailTemplateContentRows
		 * by EmailTemplate Index(es)
		 * @param integer $intEmailTemplate
		 * @return int
		*/
		public static function CountByEmailTemplate($intEmailTemplate) {
			// Call EmailTemplateContentRow::QueryCount to perform the CountByEmailTemplate query
			return EmailTemplateContentRow::QueryCount(
				QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplate, $intEmailTemplate)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this EmailTemplateContentRow
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = EmailTemplateContentRow::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = EmailTemplateContentRow::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmailTemplateContentRow';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("Columns" => $this->intColumns));
                $ChangedArray = array_merge($ChangedArray,array("RowOrder" => $this->intRowOrder));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("EmailTemplate" => $this->intEmailTemplate));
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
                if (!is_null($ExistingObj->Columns)) {
                    $ExistingValueStr = $ExistingObj->Columns;
                }
                if ($ExistingObj->Columns != $this->intColumns) {
                    $ChangedArray = array_merge($ChangedArray,array("Columns" => array("Before" => $ExistingValueStr,"After" => $this->intColumns)));
                    //$ChangedArray = array_merge($ChangedArray,array("Columns" => "From: ".$ExistingValueStr." to: ".$this->intColumns));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->RowOrder)) {
                    $ExistingValueStr = $ExistingObj->RowOrder;
                }
                if ($ExistingObj->RowOrder != $this->intRowOrder) {
                    $ChangedArray = array_merge($ChangedArray,array("RowOrder" => array("Before" => $ExistingValueStr,"After" => $this->intRowOrder)));
                    //$ChangedArray = array_merge($ChangedArray,array("RowOrder" => "From: ".$ExistingValueStr." to: ".$this->intRowOrder));
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
                if (!is_null($ExistingObj->EmailTemplate)) {
                    $ExistingValueStr = $ExistingObj->EmailTemplate;
                }
                if ($ExistingObj->EmailTemplate != $this->intEmailTemplate) {
                    $ChangedArray = array_merge($ChangedArray,array("EmailTemplate" => array("Before" => $ExistingValueStr,"After" => $this->intEmailTemplate)));
                    //$ChangedArray = array_merge($ChangedArray,array("EmailTemplate" => "From: ".$ExistingValueStr." to: ".$this->intEmailTemplate));
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
                    INSERT INTO `EmailTemplateContentRow` (
							`Columns`,
							`RowOrder`,
							`EmailTemplate`,
							`SearchMetaInfo`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intColumns) . ',
							' . $objDatabase->SqlVariable($this->intRowOrder) . ',
							' . $objDatabase->SqlVariable($this->intEmailTemplate) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('EmailTemplateContentRow', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
				
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `EmailTemplateContentRow` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('EmailTemplateContentRow');
                }
			
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `EmailTemplateContentRow` SET
							`Columns` = ' . $objDatabase->SqlVariable($this->intColumns) . ',
							`RowOrder` = ' . $objDatabase->SqlVariable($this->intRowOrder) . ',
							`EmailTemplate` = ' . $objDatabase->SqlVariable($this->intEmailTemplate) . ',
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
                error_log('Could not save audit log while saving EmailTemplateContentRow. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
				            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `EmailTemplateContentRow` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
			
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this EmailTemplateContentRow
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this EmailTemplateContentRow with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmailTemplateContentRow';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("Columns" => $this->intColumns));
            $ChangedArray = array_merge($ChangedArray,array("RowOrder" => $this->intRowOrder));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("EmailTemplate" => $this->intEmailTemplate));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting EmailTemplateContentRow. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplateContentRow`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this EmailTemplateContentRow ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmailTemplateContentRow', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all EmailTemplateContentRows
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplateContentRow`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate EmailTemplateContentRow table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `EmailTemplateContentRow`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this EmailTemplateContentRow from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved EmailTemplateContentRow object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = EmailTemplateContentRow::Load($this->intId);

			// Update $this's local variables to match
			$this->intColumns = $objReloaded->intColumns;
			$this->intRowOrder = $objReloaded->intRowOrder;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->EmailTemplate = $objReloaded->EmailTemplate;
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

				case 'Columns':
					/**
					 * Gets the value for intColumns 
					 * @return integer
					 */
					return $this->intColumns;

				case 'RowOrder':
					/**
					 * Gets the value for intRowOrder 
					 * @return integer
					 */
					return $this->intRowOrder;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'EmailTemplate':
					/**
					 * Gets the value for intEmailTemplate 
					 * @return integer
					 */
					return $this->intEmailTemplate;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;


				///////////////////
				// Member Objects
				///////////////////
				case 'EmailTemplateObject':
					/**
					 * Gets the value for the EmailTemplate object referenced by intEmailTemplate 
					 * @return EmailTemplate
					 */
					try {
						if ((!$this->objEmailTemplateObject) && (!is_null($this->intEmailTemplate)))
							$this->objEmailTemplateObject = EmailTemplate::Load($this->intEmailTemplate);
						return $this->objEmailTemplateObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_EmailTemplateContentBlock':
					/**
					 * Gets the value for the private _objEmailTemplateContentBlock (Read-Only)
					 * if set due to an expansion on the EmailTemplateContentBlock.EmailTemplateContentRow reverse relationship
					 * @return EmailTemplateContentBlock
					 */
					return $this->_objEmailTemplateContentBlock;

				case '_EmailTemplateContentBlockArray':
					/**
					 * Gets the value for the private _objEmailTemplateContentBlockArray (Read-Only)
					 * if set due to an ExpandAsArray on the EmailTemplateContentBlock.EmailTemplateContentRow reverse relationship
					 * @return EmailTemplateContentBlock[]
					 */
					return $this->_objEmailTemplateContentBlockArray;


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
				case 'Columns':
					/**
					 * Sets the value for intColumns 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intColumns = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'RowOrder':
					/**
					 * Sets the value for intRowOrder 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intRowOrder = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EmailTemplate':
					/**
					 * Sets the value for intEmailTemplate 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objEmailTemplateObject = null;
						return ($this->intEmailTemplate = QType::Cast($mixValue, QType::Integer));
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
				case 'EmailTemplateObject':
					/**
					 * Sets the value for the EmailTemplate object referenced by intEmailTemplate 
					 * @param EmailTemplate $mixValue
					 * @return EmailTemplate
					 */
					if (is_null($mixValue)) {
						$this->intEmailTemplate = null;
						$this->objEmailTemplateObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a EmailTemplate object
						try {
							$mixValue = QType::Cast($mixValue, 'EmailTemplate');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED EmailTemplate object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved EmailTemplateObject for this EmailTemplateContentRow');

						// Update Local Member Variables
						$this->objEmailTemplateObject = $mixValue;
						$this->intEmailTemplate = $mixValue->Id;

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



		// Related Objects' Methods for EmailTemplateContentBlock
		//-------------------------------------------------------------------

		/**
		 * Gets all associated EmailTemplateContentBlocks as an array of EmailTemplateContentBlock objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplateContentBlock[]
		*/
		public function GetEmailTemplateContentBlockArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return EmailTemplateContentBlock::LoadArrayByEmailTemplateContentRow($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated EmailTemplateContentBlocks
		 * @return int
		*/
		public function CountEmailTemplateContentBlocks() {
			if ((is_null($this->intId)))
				return 0;

			return EmailTemplateContentBlock::CountByEmailTemplateContentRow($this->intId);
		}

		/**
		 * Associates a EmailTemplateContentBlock
		 * @param EmailTemplateContentBlock $objEmailTemplateContentBlock
		 * @return void
		*/
		public function AssociateEmailTemplateContentBlock(EmailTemplateContentBlock $objEmailTemplateContentBlock) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmailTemplateContentBlock on this unsaved EmailTemplateContentRow.');
			if ((is_null($objEmailTemplateContentBlock->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmailTemplateContentBlock on this EmailTemplateContentRow with an unsaved EmailTemplateContentBlock.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmailTemplateContentBlock`
				SET
					`EmailTemplateContentRow` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmailTemplateContentBlock->Id) . '
			');
		}

		/**
		 * Unassociates a EmailTemplateContentBlock
		 * @param EmailTemplateContentBlock $objEmailTemplateContentBlock
		 * @return void
		*/
		public function UnassociateEmailTemplateContentBlock(EmailTemplateContentBlock $objEmailTemplateContentBlock) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentBlock on this unsaved EmailTemplateContentRow.');
			if ((is_null($objEmailTemplateContentBlock->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentBlock on this EmailTemplateContentRow with an unsaved EmailTemplateContentBlock.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmailTemplateContentBlock`
				SET
					`EmailTemplateContentRow` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmailTemplateContentBlock->Id) . ' AND
					`EmailTemplateContentRow` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all EmailTemplateContentBlocks
		 * @return void
		*/
		public function UnassociateAllEmailTemplateContentBlocks() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentBlock on this unsaved EmailTemplateContentRow.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmailTemplateContentBlock`
				SET
					`EmailTemplateContentRow` = null
				WHERE
					`EmailTemplateContentRow` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated EmailTemplateContentBlock
		 * @param EmailTemplateContentBlock $objEmailTemplateContentBlock
		 * @return void
		*/
		public function DeleteAssociatedEmailTemplateContentBlock(EmailTemplateContentBlock $objEmailTemplateContentBlock) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentBlock on this unsaved EmailTemplateContentRow.');
			if ((is_null($objEmailTemplateContentBlock->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentBlock on this EmailTemplateContentRow with an unsaved EmailTemplateContentBlock.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplateContentBlock`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmailTemplateContentBlock->Id) . ' AND
					`EmailTemplateContentRow` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated EmailTemplateContentBlocks
		 * @return void
		*/
		public function DeleteAllEmailTemplateContentBlocks() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentBlock on this unsaved EmailTemplateContentRow.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplateContentRow::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplateContentBlock`
				WHERE
					`EmailTemplateContentRow` = ' . $objDatabase->SqlVariable($this->intId) . '
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
			return "EmailTemplateContentRow";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[EmailTemplateContentRow::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="EmailTemplateContentRow"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Columns" type="xsd:int"/>';
			$strToReturn .= '<element name="RowOrder" type="xsd:int"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="EmailTemplateObject" type="xsd1:EmailTemplate"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('EmailTemplateContentRow', $strComplexTypeArray)) {
				$strComplexTypeArray['EmailTemplateContentRow'] = EmailTemplateContentRow::GetSoapComplexTypeXml();
				EmailTemplate::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, EmailTemplateContentRow::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new EmailTemplateContentRow();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Columns'))
				$objToReturn->intColumns = $objSoapObject->Columns;
			if (property_exists($objSoapObject, 'RowOrder'))
				$objToReturn->intRowOrder = $objSoapObject->RowOrder;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'EmailTemplateObject')) &&
				($objSoapObject->EmailTemplateObject))
				$objToReturn->EmailTemplateObject = EmailTemplate::GetObjectFromSoapObject($objSoapObject->EmailTemplateObject);
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
				array_push($objArrayToReturn, EmailTemplateContentRow::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objEmailTemplateObject)
				$objObject->objEmailTemplateObject = EmailTemplate::GetSoapObjectFromObject($objObject->objEmailTemplateObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intEmailTemplate = null;
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
			$iArray['Columns'] = $this->intColumns;
			$iArray['RowOrder'] = $this->intRowOrder;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['EmailTemplate'] = $this->intEmailTemplate;
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
     * @property-read QQNode $Columns
     * @property-read QQNode $RowOrder
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $EmailTemplate
     * @property-read QQNodeEmailTemplate $EmailTemplateObject
     * @property-read QQNode $SearchMetaInfo
     *
     *
     * @property-read QQReverseReferenceNodeEmailTemplateContentBlock $EmailTemplateContentBlock

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeEmailTemplateContentRow extends QQNode {
		protected $strTableName = 'EmailTemplateContentRow';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmailTemplateContentRow';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'Columns':
					return new QQNode('Columns', 'Columns', 'Integer', $this);
				case 'RowOrder':
					return new QQNode('RowOrder', 'RowOrder', 'Integer', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'EmailTemplate':
					return new QQNode('EmailTemplate', 'EmailTemplate', 'Integer', $this);
				case 'EmailTemplateObject':
					return new QQNodeEmailTemplate('EmailTemplate', 'EmailTemplateObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'EmailTemplateContentBlock':
					return new QQReverseReferenceNodeEmailTemplateContentBlock($this, 'emailtemplatecontentblock', 'reverse_reference', 'EmailTemplateContentRow', 'EmailTemplateContentBlock');

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
     * @property-read QQNode $Columns
     * @property-read QQNode $RowOrder
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $EmailTemplate
     * @property-read QQNodeEmailTemplate $EmailTemplateObject
     * @property-read QQNode $SearchMetaInfo
     *
     *
     * @property-read QQReverseReferenceNodeEmailTemplateContentBlock $EmailTemplateContentBlock

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeEmailTemplateContentRow extends QQReverseReferenceNode {
		protected $strTableName = 'EmailTemplateContentRow';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmailTemplateContentRow';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'Columns':
					return new QQNode('Columns', 'Columns', 'integer', $this);
				case 'RowOrder':
					return new QQNode('RowOrder', 'RowOrder', 'integer', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'EmailTemplate':
					return new QQNode('EmailTemplate', 'EmailTemplate', 'integer', $this);
				case 'EmailTemplateObject':
					return new QQNodeEmailTemplate('EmailTemplate', 'EmailTemplateObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'EmailTemplateContentBlock':
					return new QQReverseReferenceNodeEmailTemplateContentBlock($this, 'emailtemplatecontentblock', 'reverse_reference', 'EmailTemplateContentRow', 'EmailTemplateContentBlock');

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
