<?php
	/**
	 * The abstract EmailTemplateGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the EmailTemplate subclass which
	 * extends this EmailTemplateGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the EmailTemplate class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $TemplateName the value for strTemplateName 
	 * @property string $CcAddresses the value for strCcAddresses 
	 * @property string $BccAddresses the value for strBccAddresses 
	 * @property integer $Published the value for intPublished 
	 * @property-read EmailTemplateContentRow $_EmailTemplateContentRow the value for the private _objEmailTemplateContentRow (Read-Only) if set due to an expansion on the EmailTemplateContentRow.EmailTemplate reverse relationship
	 * @property-read EmailTemplateContentRow[] $_EmailTemplateContentRowArray the value for the private _objEmailTemplateContentRowArray (Read-Only) if set due to an ExpandAsArray on the EmailTemplateContentRow.EmailTemplate reverse relationship
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class EmailTemplateGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column EmailTemplate.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplate.TemplateName
		 * @var string strTemplateName
		 */
		protected $strTemplateName;
		const TemplateNameMaxLength = 200;
		const TemplateNameDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplate.CcAddresses
		 * @var string strCcAddresses
		 */
		protected $strCcAddresses;
		const CcAddressesDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplate.BccAddresses
		 * @var string strBccAddresses
		 */
		protected $strBccAddresses;
		const BccAddressesDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailTemplate.Published
		 * @var integer intPublished
		 */
		protected $intPublished;
		const PublishedDefault = null;


		/**
		 * Private member variable that stores a reference to a single EmailTemplateContentRow object
		 * (of type EmailTemplateContentRow), if this EmailTemplate object was restored with
		 * an expansion on the EmailTemplateContentRow association table.
		 * @var EmailTemplateContentRow _objEmailTemplateContentRow;
		 */
		private $_objEmailTemplateContentRow;

		/**
		 * Private member variable that stores a reference to an array of EmailTemplateContentRow objects
		 * (of type EmailTemplateContentRow[]), if this EmailTemplate object was restored with
		 * an ExpandAsArray on the EmailTemplateContentRow association table.
		 * @var EmailTemplateContentRow[] _objEmailTemplateContentRowArray;
		 */
		private $_objEmailTemplateContentRowArray = null;

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
			$this->intId = EmailTemplate::IdDefault;
			$this->strTemplateName = EmailTemplate::TemplateNameDefault;
			$this->strCcAddresses = EmailTemplate::CcAddressesDefault;
			$this->strBccAddresses = EmailTemplate::BccAddressesDefault;
			$this->intPublished = EmailTemplate::PublishedDefault;
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
		 * Load a EmailTemplate from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplate
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmailTemplate', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = EmailTemplate::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailTemplate()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all EmailTemplates
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplate[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call EmailTemplate::QueryArray to perform the LoadAll query
			try {
				return EmailTemplate::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all EmailTemplates
		 * @return int
		 */
		public static function CountAll() {
			// Call EmailTemplate::QueryCount to perform the CountAll query
			return EmailTemplate::QueryCount(QQ::All());
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
			$objDatabase = EmailTemplate::GetDatabase();

			// Create/Build out the QueryBuilder object with EmailTemplate-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'EmailTemplate');

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
				EmailTemplate::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('EmailTemplate');

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
		 * Static Qcubed Query method to query for a single EmailTemplate object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmailTemplate the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailTemplate::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new EmailTemplate object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = EmailTemplate::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return EmailTemplate::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of EmailTemplate objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmailTemplate[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailTemplate::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return EmailTemplate::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = EmailTemplate::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of EmailTemplate objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailTemplate::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = EmailTemplate::GetDatabase();

			$strQuery = EmailTemplate::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/emailtemplate', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = EmailTemplate::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this EmailTemplate
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'EmailTemplate';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'TemplateName', $strAliasPrefix . 'TemplateName');
			    $objBuilder->AddSelectItem($strTableName, 'CcAddresses', $strAliasPrefix . 'CcAddresses');
			    $objBuilder->AddSelectItem($strTableName, 'BccAddresses', $strAliasPrefix . 'BccAddresses');
			    $objBuilder->AddSelectItem($strTableName, 'Published', $strAliasPrefix . 'Published');
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
		 * Instantiate a EmailTemplate from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this EmailTemplate::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a EmailTemplate, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (EmailTemplate::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the EmailTemplate object
			$objToReturn = new EmailTemplate();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'TemplateName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strTemplateName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'CcAddresses';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strCcAddresses = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'BccAddresses';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strBccAddresses = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Published';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intPublished = $objDbRow->GetColumn($strAliasName, 'Integer');

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
				$strAliasPrefix = 'EmailTemplate__';


				

			// Check for EmailTemplateContentRow Virtual Binding
			$strAlias = $strAliasPrefix . 'emailtemplatecontentrow__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['emailtemplatecontentrow']) ? null : $objExpansionAliasArray['emailtemplatecontentrow']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objEmailTemplateContentRowArray)
				$objToReturn->_objEmailTemplateContentRowArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objEmailTemplateContentRowArray[] = EmailTemplateContentRow::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailtemplatecontentrow__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objEmailTemplateContentRow)) {
					$objToReturn->_objEmailTemplateContentRow = EmailTemplateContentRow::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailtemplatecontentrow__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of EmailTemplates from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return EmailTemplate[]
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
					$objItem = EmailTemplate::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = EmailTemplate::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single EmailTemplate object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return EmailTemplate next row resulting from the query
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
			return EmailTemplate::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single EmailTemplate object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplate
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return EmailTemplate::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailTemplate()->Id, $intId)
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
		 * Save this EmailTemplate
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			$mixToReturn = null;
            $ExistingObj = EmailTemplate::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmailTemplate';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
    $newAuditLogEntry->AuditLogEntryDetail = '<strong>Values after create:</strong> <br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'TemplateName -> '.$this->strTemplateName.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'CcAddresses -> '.$this->strCcAddresses.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'BccAddresses -> '.$this->strBccAddresses.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Published -> '.$this->intPublished.'<br>';
            } else {
                $newAuditLogEntry->ModificationType = 'Update';
                $newAuditLogEntry->AuditLogEntryDetail = '<strong>Values before update:</strong> <br>';
                if ($ExistingObj->Id) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$ExistingObj->Id.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> NULL<br>';
                }
                if ($ExistingObj->TemplateName) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'TemplateName -> '.$ExistingObj->TemplateName.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'TemplateName -> NULL<br>';
                }
                if ($ExistingObj->CcAddresses) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'CcAddresses -> '.$ExistingObj->CcAddresses.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'CcAddresses -> NULL<br>';
                }
                if ($ExistingObj->BccAddresses) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'BccAddresses -> '.$ExistingObj->BccAddresses.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'BccAddresses -> NULL<br>';
                }
                if ($ExistingObj->Published) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Published -> '.$ExistingObj->Published.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Published -> NULL<br>';
                }
                $newAuditLogEntry->AuditLogEntryDetail .= '<strong>Values after update:</strong> <br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'TemplateName -> '.$this->strTemplateName.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'CcAddresses -> '.$this->strCcAddresses.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'BccAddresses -> '.$this->strBccAddresses.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Published -> '.$this->intPublished.'<br>';
            }

            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                AppSpecificFunctions::AddCustomLog('Could not save audit log while saving EmailTemplate. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `EmailTemplate` (
							`TemplateName`,
							`CcAddresses`,
							`BccAddresses`,
							`Published`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strTemplateName) . ',
							' . $objDatabase->SqlVariable($this->strCcAddresses) . ',
							' . $objDatabase->SqlVariable($this->strBccAddresses) . ',
							' . $objDatabase->SqlVariable($this->intPublished) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('EmailTemplate', 'Id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`EmailTemplate`
						SET
							`TemplateName` = ' . $objDatabase->SqlVariable($this->strTemplateName) . ',
							`CcAddresses` = ' . $objDatabase->SqlVariable($this->strCcAddresses) . ',
							`BccAddresses` = ' . $objDatabase->SqlVariable($this->strBccAddresses) . ',
							`Published` = ' . $objDatabase->SqlVariable($this->intPublished) . '
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
                AppSpecificFunctions::AddCustomLog('Could not save audit log while saving EmailTemplate. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }*/
			$this->DeleteCache();

			// Return
			return $mixToReturn;
		}

		/**
		 * Delete this EmailTemplate
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this EmailTemplate with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmailTemplate';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $newAuditLogEntry->AuditLogEntryDetail = 'Values before delete:<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'TemplateName -> '.$this->strTemplateName.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'CcAddresses -> '.$this->strCcAddresses.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'BccAddresses -> '.$this->strBccAddresses.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Published -> '.$this->intPublished.'<br>';
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                AppSpecificFunctions::AddCustomLog('Could not save audit log while deleting EmailTemplate. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplate`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this EmailTemplate ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmailTemplate', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all EmailTemplates
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplate`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate EmailTemplate table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `EmailTemplate`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this EmailTemplate from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved EmailTemplate object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = EmailTemplate::Load($this->intId);

			// Update $this's local variables to match
			$this->strTemplateName = $objReloaded->strTemplateName;
			$this->strCcAddresses = $objReloaded->strCcAddresses;
			$this->strBccAddresses = $objReloaded->strBccAddresses;
			$this->intPublished = $objReloaded->intPublished;
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

				case 'TemplateName':
					/**
					 * Gets the value for strTemplateName 
					 * @return string
					 */
					return $this->strTemplateName;

				case 'CcAddresses':
					/**
					 * Gets the value for strCcAddresses 
					 * @return string
					 */
					return $this->strCcAddresses;

				case 'BccAddresses':
					/**
					 * Gets the value for strBccAddresses 
					 * @return string
					 */
					return $this->strBccAddresses;

				case 'Published':
					/**
					 * Gets the value for intPublished 
					 * @return integer
					 */
					return $this->intPublished;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_EmailTemplateContentRow':
					/**
					 * Gets the value for the private _objEmailTemplateContentRow (Read-Only)
					 * if set due to an expansion on the EmailTemplateContentRow.EmailTemplate reverse relationship
					 * @return EmailTemplateContentRow
					 */
					return $this->_objEmailTemplateContentRow;

				case '_EmailTemplateContentRowArray':
					/**
					 * Gets the value for the private _objEmailTemplateContentRowArray (Read-Only)
					 * if set due to an ExpandAsArray on the EmailTemplateContentRow.EmailTemplate reverse relationship
					 * @return EmailTemplateContentRow[]
					 */
					return $this->_objEmailTemplateContentRowArray;


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
				case 'TemplateName':
					/**
					 * Sets the value for strTemplateName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strTemplateName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CcAddresses':
					/**
					 * Sets the value for strCcAddresses 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strCcAddresses = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'BccAddresses':
					/**
					 * Sets the value for strBccAddresses 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strBccAddresses = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Published':
					/**
					 * Sets the value for intPublished 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intPublished = QType::Cast($mixValue, QType::Integer));
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



		// Related Objects' Methods for EmailTemplateContentRow
		//-------------------------------------------------------------------

		/**
		 * Gets all associated EmailTemplateContentRows as an array of EmailTemplateContentRow objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailTemplateContentRow[]
		*/
		public function GetEmailTemplateContentRowArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return EmailTemplateContentRow::LoadArrayByEmailTemplate($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated EmailTemplateContentRows
		 * @return int
		*/
		public function CountEmailTemplateContentRows() {
			if ((is_null($this->intId)))
				return 0;

			return EmailTemplateContentRow::CountByEmailTemplate($this->intId);
		}

		/**
		 * Associates a EmailTemplateContentRow
		 * @param EmailTemplateContentRow $objEmailTemplateContentRow
		 * @return void
		*/
		public function AssociateEmailTemplateContentRow(EmailTemplateContentRow $objEmailTemplateContentRow) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmailTemplateContentRow on this unsaved EmailTemplate.');
			if ((is_null($objEmailTemplateContentRow->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmailTemplateContentRow on this EmailTemplate with an unsaved EmailTemplateContentRow.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmailTemplateContentRow`
				SET
					`EmailTemplate` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmailTemplateContentRow->Id) . '
			');
		}

		/**
		 * Unassociates a EmailTemplateContentRow
		 * @param EmailTemplateContentRow $objEmailTemplateContentRow
		 * @return void
		*/
		public function UnassociateEmailTemplateContentRow(EmailTemplateContentRow $objEmailTemplateContentRow) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentRow on this unsaved EmailTemplate.');
			if ((is_null($objEmailTemplateContentRow->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentRow on this EmailTemplate with an unsaved EmailTemplateContentRow.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmailTemplateContentRow`
				SET
					`EmailTemplate` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmailTemplateContentRow->Id) . ' AND
					`EmailTemplate` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all EmailTemplateContentRows
		 * @return void
		*/
		public function UnassociateAllEmailTemplateContentRows() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentRow on this unsaved EmailTemplate.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmailTemplateContentRow`
				SET
					`EmailTemplate` = null
				WHERE
					`EmailTemplate` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated EmailTemplateContentRow
		 * @param EmailTemplateContentRow $objEmailTemplateContentRow
		 * @return void
		*/
		public function DeleteAssociatedEmailTemplateContentRow(EmailTemplateContentRow $objEmailTemplateContentRow) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentRow on this unsaved EmailTemplate.');
			if ((is_null($objEmailTemplateContentRow->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentRow on this EmailTemplate with an unsaved EmailTemplateContentRow.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplateContentRow`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmailTemplateContentRow->Id) . ' AND
					`EmailTemplate` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated EmailTemplateContentRows
		 * @return void
		*/
		public function DeleteAllEmailTemplateContentRows() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailTemplateContentRow on this unsaved EmailTemplate.');

			// Get the Database Object for this Class
			$objDatabase = EmailTemplate::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailTemplateContentRow`
				WHERE
					`EmailTemplate` = ' . $objDatabase->SqlVariable($this->intId) . '
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
			return "EmailTemplate";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[EmailTemplate::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="EmailTemplate"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="TemplateName" type="xsd:string"/>';
			$strToReturn .= '<element name="CcAddresses" type="xsd:string"/>';
			$strToReturn .= '<element name="BccAddresses" type="xsd:string"/>';
			$strToReturn .= '<element name="Published" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('EmailTemplate', $strComplexTypeArray)) {
				$strComplexTypeArray['EmailTemplate'] = EmailTemplate::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, EmailTemplate::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new EmailTemplate();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'TemplateName'))
				$objToReturn->strTemplateName = $objSoapObject->TemplateName;
			if (property_exists($objSoapObject, 'CcAddresses'))
				$objToReturn->strCcAddresses = $objSoapObject->CcAddresses;
			if (property_exists($objSoapObject, 'BccAddresses'))
				$objToReturn->strBccAddresses = $objSoapObject->BccAddresses;
			if (property_exists($objSoapObject, 'Published'))
				$objToReturn->intPublished = $objSoapObject->Published;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, EmailTemplate::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
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
			$iArray['TemplateName'] = $this->strTemplateName;
			$iArray['CcAddresses'] = $this->strCcAddresses;
			$iArray['BccAddresses'] = $this->strBccAddresses;
			$iArray['Published'] = $this->intPublished;
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
     * @property-read QQNode $TemplateName
     * @property-read QQNode $CcAddresses
     * @property-read QQNode $BccAddresses
     * @property-read QQNode $Published
     *
     *
     * @property-read QQReverseReferenceNodeEmailTemplateContentRow $EmailTemplateContentRow

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeEmailTemplate extends QQNode {
		protected $strTableName = 'EmailTemplate';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmailTemplate';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'TemplateName':
					return new QQNode('TemplateName', 'TemplateName', 'VarChar', $this);
				case 'CcAddresses':
					return new QQNode('CcAddresses', 'CcAddresses', 'Blob', $this);
				case 'BccAddresses':
					return new QQNode('BccAddresses', 'BccAddresses', 'Blob', $this);
				case 'Published':
					return new QQNode('Published', 'Published', 'Integer', $this);
				case 'EmailTemplateContentRow':
					return new QQReverseReferenceNodeEmailTemplateContentRow($this, 'emailtemplatecontentrow', 'reverse_reference', 'EmailTemplate', 'EmailTemplateContentRow');

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
     * @property-read QQNode $TemplateName
     * @property-read QQNode $CcAddresses
     * @property-read QQNode $BccAddresses
     * @property-read QQNode $Published
     *
     *
     * @property-read QQReverseReferenceNodeEmailTemplateContentRow $EmailTemplateContentRow

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeEmailTemplate extends QQReverseReferenceNode {
		protected $strTableName = 'EmailTemplate';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmailTemplate';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'TemplateName':
					return new QQNode('TemplateName', 'TemplateName', 'string', $this);
				case 'CcAddresses':
					return new QQNode('CcAddresses', 'CcAddresses', 'string', $this);
				case 'BccAddresses':
					return new QQNode('BccAddresses', 'BccAddresses', 'string', $this);
				case 'Published':
					return new QQNode('Published', 'Published', 'integer', $this);
				case 'EmailTemplateContentRow':
					return new QQReverseReferenceNodeEmailTemplateContentRow($this, 'emailtemplatecontentrow', 'reverse_reference', 'EmailTemplate', 'EmailTemplateContentRow');

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
