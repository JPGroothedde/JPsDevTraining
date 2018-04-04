<?php
	/**
	 * The abstract LineItemGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the LineItem subclass which
	 * extends this LineItemGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the LineItem class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $Quantity the value for strQuantity 
	 * @property string $LineTotal the value for strLineTotal 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $Product the value for intProduct 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property integer $Invoice the value for intInvoice 
	 * @property Product $ProductObject the value for the Product object referenced by intProduct 
	 * @property Invoice $InvoiceObject the value for the Invoice object referenced by intInvoice 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class LineItemGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column LineItem.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column LineItem.Quantity
		 * @var string strQuantity
		 */
		protected $strQuantity;
		const QuantityMaxLength = 10;
		const QuantityDefault = null;


		/**
		 * Protected member variable that maps to the database column LineItem.LineTotal
		 * @var string strLineTotal
		 */
		protected $strLineTotal;
		const LineTotalMaxLength = 20;
		const LineTotalDefault = null;


		/**
		 * Protected member variable that maps to the database column LineItem.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column LineItem.Product
		 * @var integer intProduct
		 */
		protected $intProduct;
		const ProductDefault = null;


		/**
		 * Protected member variable that maps to the database column LineItem.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column LineItem.Invoice
		 * @var integer intInvoice
		 */
		protected $intInvoice;
		const InvoiceDefault = null;


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
		 * in the database column LineItem.Product.
		 *
		 * NOTE: Always use the ProductObject property getter to correctly retrieve this Product object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Product objProductObject
		 */
		protected $objProductObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column LineItem.Invoice.
		 *
		 * NOTE: Always use the InvoiceObject property getter to correctly retrieve this Invoice object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Invoice objInvoiceObject
		 */
		protected $objInvoiceObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = LineItem::IdDefault;
			$this->strQuantity = LineItem::QuantityDefault;
			$this->strLineTotal = LineItem::LineTotalDefault;
			$this->strLastUpdated = LineItem::LastUpdatedDefault;
			$this->intProduct = LineItem::ProductDefault;
			$this->strSearchMetaInfo = LineItem::SearchMetaInfoDefault;
			$this->intInvoice = LineItem::InvoiceDefault;
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
		 * Load a LineItem from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return LineItem
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'LineItem', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = LineItem::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::LineItem()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all LineItems
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return LineItem[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call LineItem::QueryArray to perform the LoadAll query
			try {
				return LineItem::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all LineItems
		 * @return int
		 */
		public static function CountAll() {
			// Call LineItem::QueryCount to perform the CountAll query
			return LineItem::QueryCount(QQ::All());
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
			$objDatabase = LineItem::GetDatabase();

			// Create/Build out the QueryBuilder object with LineItem-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'LineItem');

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
				LineItem::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('LineItem');

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
		 * Static Qcubed Query method to query for a single LineItem object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return LineItem the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = LineItem::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new LineItem object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = LineItem::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return LineItem::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of LineItem objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return LineItem[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = LineItem::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return LineItem::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = LineItem::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of LineItem objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = LineItem::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = LineItem::GetDatabase();

			$strQuery = LineItem::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/lineitem', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = LineItem::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this LineItem
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'LineItem';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'Quantity', $strAliasPrefix . 'Quantity');
			    $objBuilder->AddSelectItem($strTableName, 'LineTotal', $strAliasPrefix . 'LineTotal');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'Product', $strAliasPrefix . 'Product');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
			    $objBuilder->AddSelectItem($strTableName, 'Invoice', $strAliasPrefix . 'Invoice');
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
		 * Instantiate a LineItem from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this LineItem::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a LineItem, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (LineItem::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the LineItem object
			$objToReturn = new LineItem();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'Quantity';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strQuantity = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LineTotal';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLineTotal = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Product';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intProduct = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Invoice';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intInvoice = $objDbRow->GetColumn($strAliasName, 'Integer');

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
				$strAliasPrefix = 'LineItem__';

			// Check for ProductObject Early Binding
			$strAlias = $strAliasPrefix . 'Product__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Product']) ? null : $objExpansionAliasArray['Product']);
				$objToReturn->objProductObject = Product::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Product__', $objExpansionNode, null, $strColumnAliasArray);
			}
			// Check for InvoiceObject Early Binding
			$strAlias = $strAliasPrefix . 'Invoice__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Invoice']) ? null : $objExpansionAliasArray['Invoice']);
				$objToReturn->objInvoiceObject = Invoice::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Invoice__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of LineItems from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return LineItem[]
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
					$objItem = LineItem::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = LineItem::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single LineItem object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return LineItem next row resulting from the query
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
			return LineItem::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single LineItem object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return LineItem
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return LineItem::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::LineItem()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of LineItem objects,
		 * by Product Index(es)
		 * @param integer $intProduct
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return LineItem[]
		*/
		public static function LoadArrayByProduct($intProduct, $objOptionalClauses = null) {
			// Call LineItem::QueryArray to perform the LoadArrayByProduct query
			try {
				return LineItem::QueryArray(
					QQ::Equal(QQN::LineItem()->Product, $intProduct),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count LineItems
		 * by Product Index(es)
		 * @param integer $intProduct
		 * @return int
		*/
		public static function CountByProduct($intProduct) {
			// Call LineItem::QueryCount to perform the CountByProduct query
			return LineItem::QueryCount(
				QQ::Equal(QQN::LineItem()->Product, $intProduct)
			);
		}

		/**
		 * Load an array of LineItem objects,
		 * by Invoice Index(es)
		 * @param integer $intInvoice
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return LineItem[]
		*/
		public static function LoadArrayByInvoice($intInvoice, $objOptionalClauses = null) {
			// Call LineItem::QueryArray to perform the LoadArrayByInvoice query
			try {
				return LineItem::QueryArray(
					QQ::Equal(QQN::LineItem()->Invoice, $intInvoice),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count LineItems
		 * by Invoice Index(es)
		 * @param integer $intInvoice
		 * @return int
		*/
		public static function CountByInvoice($intInvoice) {
			// Call LineItem::QueryCount to perform the CountByInvoice query
			return LineItem::QueryCount(
				QQ::Equal(QQN::LineItem()->Invoice, $intInvoice)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this LineItem
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = LineItem::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = LineItem::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'LineItem';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("Quantity" => $this->strQuantity));
                $ChangedArray = array_merge($ChangedArray,array("LineTotal" => $this->strLineTotal));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("Product" => $this->intProduct));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
                $ChangedArray = array_merge($ChangedArray,array("Invoice" => $this->intInvoice));
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
                if (!is_null($ExistingObj->Quantity)) {
                    $ExistingValueStr = $ExistingObj->Quantity;
                }
                if ($ExistingObj->Quantity != $this->strQuantity) {
                    $ChangedArray = array_merge($ChangedArray,array("Quantity" => array("Before" => $ExistingValueStr,"After" => $this->strQuantity)));
                    //$ChangedArray = array_merge($ChangedArray,array("Quantity" => "From: ".$ExistingValueStr." to: ".$this->strQuantity));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->LineTotal)) {
                    $ExistingValueStr = $ExistingObj->LineTotal;
                }
                if ($ExistingObj->LineTotal != $this->strLineTotal) {
                    $ChangedArray = array_merge($ChangedArray,array("LineTotal" => array("Before" => $ExistingValueStr,"After" => $this->strLineTotal)));
                    //$ChangedArray = array_merge($ChangedArray,array("LineTotal" => "From: ".$ExistingValueStr." to: ".$this->strLineTotal));
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
                if (!is_null($ExistingObj->Product)) {
                    $ExistingValueStr = $ExistingObj->Product;
                }
                if ($ExistingObj->Product != $this->intProduct) {
                    $ChangedArray = array_merge($ChangedArray,array("Product" => array("Before" => $ExistingValueStr,"After" => $this->intProduct)));
                    //$ChangedArray = array_merge($ChangedArray,array("Product" => "From: ".$ExistingValueStr." to: ".$this->intProduct));
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
                if (!is_null($ExistingObj->Invoice)) {
                    $ExistingValueStr = $ExistingObj->Invoice;
                }
                if ($ExistingObj->Invoice != $this->intInvoice) {
                    $ChangedArray = array_merge($ChangedArray,array("Invoice" => array("Before" => $ExistingValueStr,"After" => $this->intInvoice)));
                    //$ChangedArray = array_merge($ChangedArray,array("Invoice" => "From: ".$ExistingValueStr." to: ".$this->intInvoice));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `LineItem` (
							`Quantity`,
							`LineTotal`,
							`Product`,
							`SearchMetaInfo`,
							`Invoice`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strQuantity) . ',
							' . $objDatabase->SqlVariable($this->strLineTotal) . ',
							' . $objDatabase->SqlVariable($this->intProduct) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->intInvoice) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('LineItem', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
				
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `LineItem` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('LineItem');
                }
				
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `LineItem` SET
							`Quantity` = ' . $objDatabase->SqlVariable($this->strQuantity) . ',
							`LineTotal` = ' . $objDatabase->SqlVariable($this->strLineTotal) . ',
							`Product` = ' . $objDatabase->SqlVariable($this->intProduct) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							`Invoice` = ' . $objDatabase->SqlVariable($this->intInvoice) . '
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
                error_log('Could not save audit log while saving LineItem. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
				            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `LineItem` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
				
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this LineItem
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this LineItem with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = LineItem::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'LineItem';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("Quantity" => $this->strQuantity));
            $ChangedArray = array_merge($ChangedArray,array("LineTotal" => $this->strLineTotal));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("Product" => $this->intProduct));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("Invoice" => $this->intInvoice));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting LineItem. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`LineItem`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this LineItem ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'LineItem', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all LineItems
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = LineItem::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`LineItem`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate LineItem table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = LineItem::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `LineItem`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this LineItem from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved LineItem object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = LineItem::Load($this->intId);

			// Update $this's local variables to match
			$this->strQuantity = $objReloaded->strQuantity;
			$this->strLineTotal = $objReloaded->strLineTotal;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->Product = $objReloaded->Product;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
			$this->Invoice = $objReloaded->Invoice;
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

				case 'Quantity':
					/**
					 * Gets the value for strQuantity 
					 * @return string
					 */
					return $this->strQuantity;

				case 'LineTotal':
					/**
					 * Gets the value for strLineTotal 
					 * @return string
					 */
					return $this->strLineTotal;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'Product':
					/**
					 * Gets the value for intProduct 
					 * @return integer
					 */
					return $this->intProduct;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;

				case 'Invoice':
					/**
					 * Gets the value for intInvoice 
					 * @return integer
					 */
					return $this->intInvoice;


				///////////////////
				// Member Objects
				///////////////////
				case 'ProductObject':
					/**
					 * Gets the value for the Product object referenced by intProduct 
					 * @return Product
					 */
					try {
						if ((!$this->objProductObject) && (!is_null($this->intProduct)))
							$this->objProductObject = Product::Load($this->intProduct);
						return $this->objProductObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'InvoiceObject':
					/**
					 * Gets the value for the Invoice object referenced by intInvoice 
					 * @return Invoice
					 */
					try {
						if ((!$this->objInvoiceObject) && (!is_null($this->intInvoice)))
							$this->objInvoiceObject = Invoice::Load($this->intInvoice);
						return $this->objInvoiceObject;
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
				case 'Quantity':
					/**
					 * Sets the value for strQuantity 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strQuantity = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LineTotal':
					/**
					 * Sets the value for strLineTotal 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLineTotal = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Product':
					/**
					 * Sets the value for intProduct 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objProductObject = null;
						return ($this->intProduct = QType::Cast($mixValue, QType::Integer));
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

				case 'Invoice':
					/**
					 * Sets the value for intInvoice 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objInvoiceObject = null;
						return ($this->intInvoice = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'ProductObject':
					/**
					 * Sets the value for the Product object referenced by intProduct 
					 * @param Product $mixValue
					 * @return Product
					 */
					if (is_null($mixValue)) {
						$this->intProduct = null;
						$this->objProductObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Product object
						try {
							$mixValue = QType::Cast($mixValue, 'Product');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Product object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved ProductObject for this LineItem');

						// Update Local Member Variables
						$this->objProductObject = $mixValue;
						$this->intProduct = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'InvoiceObject':
					/**
					 * Sets the value for the Invoice object referenced by intInvoice 
					 * @param Invoice $mixValue
					 * @return Invoice
					 */
					if (is_null($mixValue)) {
						$this->intInvoice = null;
						$this->objInvoiceObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Invoice object
						try {
							$mixValue = QType::Cast($mixValue, 'Invoice');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Invoice object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved InvoiceObject for this LineItem');

						// Update Local Member Variables
						$this->objInvoiceObject = $mixValue;
						$this->intInvoice = $mixValue->Id;

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
			return "LineItem";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[LineItem::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="LineItem"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Quantity" type="xsd:string"/>';
			$strToReturn .= '<element name="LineTotal" type="xsd:string"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="ProductObject" type="xsd1:Product"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="InvoiceObject" type="xsd1:Invoice"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('LineItem', $strComplexTypeArray)) {
				$strComplexTypeArray['LineItem'] = LineItem::GetSoapComplexTypeXml();
				Product::AlterSoapComplexTypeArray($strComplexTypeArray);
				Invoice::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, LineItem::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new LineItem();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Quantity'))
				$objToReturn->strQuantity = $objSoapObject->Quantity;
			if (property_exists($objSoapObject, 'LineTotal'))
				$objToReturn->strLineTotal = $objSoapObject->LineTotal;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'ProductObject')) &&
				($objSoapObject->ProductObject))
				$objToReturn->ProductObject = Product::GetObjectFromSoapObject($objSoapObject->ProductObject);
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if ((property_exists($objSoapObject, 'InvoiceObject')) &&
				($objSoapObject->InvoiceObject))
				$objToReturn->InvoiceObject = Invoice::GetObjectFromSoapObject($objSoapObject->InvoiceObject);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, LineItem::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objProductObject)
				$objObject->objProductObject = Product::GetSoapObjectFromObject($objObject->objProductObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intProduct = null;
			if ($objObject->objInvoiceObject)
				$objObject->objInvoiceObject = Invoice::GetSoapObjectFromObject($objObject->objInvoiceObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intInvoice = null;
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
			$iArray['Quantity'] = $this->strQuantity;
			$iArray['LineTotal'] = $this->strLineTotal;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['Product'] = $this->intProduct;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
			$iArray['Invoice'] = $this->intInvoice;
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
     * @property-read QQNode $Quantity
     * @property-read QQNode $LineTotal
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Product
     * @property-read QQNodeProduct $ProductObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $Invoice
     * @property-read QQNodeInvoice $InvoiceObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeLineItem extends QQNode {
		protected $strTableName = 'LineItem';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'LineItem';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'Quantity':
					return new QQNode('Quantity', 'Quantity', 'VarChar', $this);
				case 'LineTotal':
					return new QQNode('LineTotal', 'LineTotal', 'VarChar', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'Product':
					return new QQNode('Product', 'Product', 'Integer', $this);
				case 'ProductObject':
					return new QQNodeProduct('Product', 'ProductObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'Invoice':
					return new QQNode('Invoice', 'Invoice', 'Integer', $this);
				case 'InvoiceObject':
					return new QQNodeInvoice('Invoice', 'InvoiceObject', 'Integer', $this);

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
     * @property-read QQNode $Quantity
     * @property-read QQNode $LineTotal
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Product
     * @property-read QQNodeProduct $ProductObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $Invoice
     * @property-read QQNodeInvoice $InvoiceObject
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeLineItem extends QQReverseReferenceNode {
		protected $strTableName = 'LineItem';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'LineItem';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'Quantity':
					return new QQNode('Quantity', 'Quantity', 'string', $this);
				case 'LineTotal':
					return new QQNode('LineTotal', 'LineTotal', 'string', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'Product':
					return new QQNode('Product', 'Product', 'integer', $this);
				case 'ProductObject':
					return new QQNodeProduct('Product', 'ProductObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'Invoice':
					return new QQNode('Invoice', 'Invoice', 'integer', $this);
				case 'InvoiceObject':
					return new QQNodeInvoice('Invoice', 'InvoiceObject', 'integer', $this);

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