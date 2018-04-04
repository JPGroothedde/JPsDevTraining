<?php
	/**
	 * The abstract EmailMessageGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the EmailMessage subclass which
	 * extends this EmailMessageGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the EmailMessage class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property QDateTime $SentDate the value for dttSentDate 
	 * @property string $FromAddress the value for strFromAddress 
	 * @property string $ReplyEmail the value for strReplyEmail 
	 * @property string $Recipients the value for strRecipients 
	 * @property string $Cc the value for strCc 
	 * @property string $Bcc the value for strBcc 
	 * @property string $Subject the value for strSubject 
	 * @property string $EmailMessage the value for strEmailMessage 
	 * @property string $Attachments the value for strAttachments 
	 * @property string $ErrorInfo the value for strErrorInfo 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class EmailMessageGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column EmailMessage.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.SentDate
		 * @var QDateTime dttSentDate
		 */
		protected $dttSentDate;
		const SentDateDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.FromAddress
		 * @var string strFromAddress
		 */
		protected $strFromAddress;
		const FromAddressMaxLength = 150;
		const FromAddressDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.ReplyEmail
		 * @var string strReplyEmail
		 */
		protected $strReplyEmail;
		const ReplyEmailMaxLength = 150;
		const ReplyEmailDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.Recipients
		 * @var string strRecipients
		 */
		protected $strRecipients;
		const RecipientsDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.Cc
		 * @var string strCc
		 */
		protected $strCc;
		const CcDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.Bcc
		 * @var string strBcc
		 */
		protected $strBcc;
		const BccDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.Subject
		 * @var string strSubject
		 */
		protected $strSubject;
		const SubjectDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.EmailMessage
		 * @var string strEmailMessage
		 */
		protected $strEmailMessage;
		const EmailMessageDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.Attachments
		 * @var string strAttachments
		 */
		protected $strAttachments;
		const AttachmentsDefault = null;


		/**
		 * Protected member variable that maps to the database column EmailMessage.ErrorInfo
		 * @var string strErrorInfo
		 */
		protected $strErrorInfo;
		const ErrorInfoDefault = null;


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
			$this->intId = EmailMessage::IdDefault;
			$this->dttSentDate = (EmailMessage::SentDateDefault === null)?null:new QDateTime(EmailMessage::SentDateDefault);
			$this->strFromAddress = EmailMessage::FromAddressDefault;
			$this->strReplyEmail = EmailMessage::ReplyEmailDefault;
			$this->strRecipients = EmailMessage::RecipientsDefault;
			$this->strCc = EmailMessage::CcDefault;
			$this->strBcc = EmailMessage::BccDefault;
			$this->strSubject = EmailMessage::SubjectDefault;
			$this->strEmailMessage = EmailMessage::EmailMessageDefault;
			$this->strAttachments = EmailMessage::AttachmentsDefault;
			$this->strErrorInfo = EmailMessage::ErrorInfoDefault;
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
		 * Load a EmailMessage from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailMessage
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmailMessage', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = EmailMessage::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailMessage()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all EmailMessages
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailMessage[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call EmailMessage::QueryArray to perform the LoadAll query
			try {
				return EmailMessage::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all EmailMessages
		 * @return int
		 */
		public static function CountAll() {
			// Call EmailMessage::QueryCount to perform the CountAll query
			return EmailMessage::QueryCount(QQ::All());
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
			$objDatabase = EmailMessage::GetDatabase();

			// Create/Build out the QueryBuilder object with EmailMessage-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'EmailMessage');

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
				EmailMessage::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('EmailMessage');

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
		 * Static Qcubed Query method to query for a single EmailMessage object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmailMessage the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailMessage::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new EmailMessage object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = EmailMessage::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return EmailMessage::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of EmailMessage objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EmailMessage[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailMessage::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return EmailMessage::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = EmailMessage::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of EmailMessage objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EmailMessage::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = EmailMessage::GetDatabase();

			$strQuery = EmailMessage::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/emailmessage', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = EmailMessage::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this EmailMessage
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'EmailMessage';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'SentDate', $strAliasPrefix . 'SentDate');
			    $objBuilder->AddSelectItem($strTableName, 'FromAddress', $strAliasPrefix . 'FromAddress');
			    $objBuilder->AddSelectItem($strTableName, 'ReplyEmail', $strAliasPrefix . 'ReplyEmail');
			    $objBuilder->AddSelectItem($strTableName, 'Recipients', $strAliasPrefix . 'Recipients');
			    $objBuilder->AddSelectItem($strTableName, 'Cc', $strAliasPrefix . 'Cc');
			    $objBuilder->AddSelectItem($strTableName, 'Bcc', $strAliasPrefix . 'Bcc');
			    $objBuilder->AddSelectItem($strTableName, 'Subject', $strAliasPrefix . 'Subject');
			    $objBuilder->AddSelectItem($strTableName, 'EmailMessage', $strAliasPrefix . 'EmailMessage');
			    $objBuilder->AddSelectItem($strTableName, 'Attachments', $strAliasPrefix . 'Attachments');
			    $objBuilder->AddSelectItem($strTableName, 'ErrorInfo', $strAliasPrefix . 'ErrorInfo');
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
		 * Instantiate a EmailMessage from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this EmailMessage::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a EmailMessage, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
			
			

			// Create a new instance of the EmailMessage object
			$objToReturn = new EmailMessage();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SentDate';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttSentDate = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAlias = $strAliasPrefix . 'FromAddress';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strFromAddress = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'ReplyEmail';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strReplyEmail = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Recipients';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strRecipients = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Cc';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strCc = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Bcc';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strBcc = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Subject';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSubject = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'EmailMessage';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strEmailMessage = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'Attachments';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strAttachments = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'ErrorInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strErrorInfo = $objDbRow->GetColumn($strAliasName, 'Blob');

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
				$strAliasPrefix = 'EmailMessage__';


				

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of EmailMessages from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return EmailMessage[]
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
					$objItem = EmailMessage::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = EmailMessage::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single EmailMessage object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return EmailMessage next row resulting from the query
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
			return EmailMessage::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single EmailMessage object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailMessage
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return EmailMessage::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailMessage()->Id, $intId)
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
		 * Save this EmailMessage
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = EmailMessage::GetDatabase();

			$mixToReturn = null;
            $ExistingObj = EmailMessage::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmailMessage';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
    $newAuditLogEntry->AuditLogEntryDetail = '<strong>Values after create:</strong> <br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'SentDate -> '.$this->dttSentDate.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'FromAddress -> '.$this->strFromAddress.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'ReplyEmail -> '.$this->strReplyEmail.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Recipients -> '.$this->strRecipients.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Cc -> '.$this->strCc.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Bcc -> '.$this->strBcc.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Subject -> '.$this->strSubject.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'EmailMessage -> '.$this->strEmailMessage.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Attachments -> '.$this->strAttachments.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'ErrorInfo -> '.$this->strErrorInfo.'<br>';
            } else {
                $newAuditLogEntry->ModificationType = 'Update';
                $newAuditLogEntry->AuditLogEntryDetail = '<strong>Values before update:</strong> <br>';
                if ($ExistingObj->Id) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$ExistingObj->Id.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> NULL<br>';
                }
                if ($ExistingObj->SentDate) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'SentDate -> '.$ExistingObj->SentDate.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'SentDate -> NULL<br>';
                }
                if ($ExistingObj->FromAddress) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'FromAddress -> '.$ExistingObj->FromAddress.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'FromAddress -> NULL<br>';
                }
                if ($ExistingObj->ReplyEmail) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'ReplyEmail -> '.$ExistingObj->ReplyEmail.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'ReplyEmail -> NULL<br>';
                }
                if ($ExistingObj->Recipients) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Recipients -> '.$ExistingObj->Recipients.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Recipients -> NULL<br>';
                }
                if ($ExistingObj->Cc) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Cc -> '.$ExistingObj->Cc.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Cc -> NULL<br>';
                }
                if ($ExistingObj->Bcc) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Bcc -> '.$ExistingObj->Bcc.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Bcc -> NULL<br>';
                }
                if ($ExistingObj->Subject) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Subject -> '.$ExistingObj->Subject.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Subject -> NULL<br>';
                }
                if ($ExistingObj->EmailMessage) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'EmailMessage -> '.$ExistingObj->EmailMessage.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'EmailMessage -> NULL<br>';
                }
                if ($ExistingObj->Attachments) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Attachments -> '.$ExistingObj->Attachments.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'Attachments -> NULL<br>';
                }
                if ($ExistingObj->ErrorInfo) {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'ErrorInfo -> '.$ExistingObj->ErrorInfo.'<br>';
                } else {
                    $newAuditLogEntry->AuditLogEntryDetail .= 'ErrorInfo -> NULL<br>';
                }
                $newAuditLogEntry->AuditLogEntryDetail .= '<strong>Values after update:</strong> <br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'SentDate -> '.$this->dttSentDate.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'FromAddress -> '.$this->strFromAddress.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'ReplyEmail -> '.$this->strReplyEmail.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Recipients -> '.$this->strRecipients.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Cc -> '.$this->strCc.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Bcc -> '.$this->strBcc.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Subject -> '.$this->strSubject.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'EmailMessage -> '.$this->strEmailMessage.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'Attachments -> '.$this->strAttachments.'<br>';
                $newAuditLogEntry->AuditLogEntryDetail .= 'ErrorInfo -> '.$this->strErrorInfo.'<br>';
            }

            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                AppSpecificFunctions::AddCustomLog('Could not save audit log while saving EmailMessage. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `EmailMessage` (
							`SentDate`,
							`FromAddress`,
							`ReplyEmail`,
							`Recipients`,
							`Cc`,
							`Bcc`,
							`Subject`,
							`EmailMessage`,
							`Attachments`,
							`ErrorInfo`
						) VALUES (
							' . $objDatabase->SqlVariable($this->dttSentDate) . ',
							' . $objDatabase->SqlVariable($this->strFromAddress) . ',
							' . $objDatabase->SqlVariable($this->strReplyEmail) . ',
							' . $objDatabase->SqlVariable($this->strRecipients) . ',
							' . $objDatabase->SqlVariable($this->strCc) . ',
							' . $objDatabase->SqlVariable($this->strBcc) . ',
							' . $objDatabase->SqlVariable($this->strSubject) . ',
							' . $objDatabase->SqlVariable($this->strEmailMessage) . ',
							' . $objDatabase->SqlVariable($this->strAttachments) . ',
							' . $objDatabase->SqlVariable($this->strErrorInfo) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('EmailMessage', 'Id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`EmailMessage`
						SET
							`SentDate` = ' . $objDatabase->SqlVariable($this->dttSentDate) . ',
							`FromAddress` = ' . $objDatabase->SqlVariable($this->strFromAddress) . ',
							`ReplyEmail` = ' . $objDatabase->SqlVariable($this->strReplyEmail) . ',
							`Recipients` = ' . $objDatabase->SqlVariable($this->strRecipients) . ',
							`Cc` = ' . $objDatabase->SqlVariable($this->strCc) . ',
							`Bcc` = ' . $objDatabase->SqlVariable($this->strBcc) . ',
							`Subject` = ' . $objDatabase->SqlVariable($this->strSubject) . ',
							`EmailMessage` = ' . $objDatabase->SqlVariable($this->strEmailMessage) . ',
							`Attachments` = ' . $objDatabase->SqlVariable($this->strAttachments) . ',
							`ErrorInfo` = ' . $objDatabase->SqlVariable($this->strErrorInfo) . '
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
                AppSpecificFunctions::AddCustomLog('Could not save audit log while saving EmailMessage. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }*/
			$this->DeleteCache();

			// Return
			return $mixToReturn;
		}

		/**
		 * Delete this EmailMessage
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this EmailMessage with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = EmailMessage::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'EmailMessage';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $newAuditLogEntry->AuditLogEntryDetail = 'Values before delete:<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Id -> '.$this->intId.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'SentDate -> '.$this->dttSentDate.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'FromAddress -> '.$this->strFromAddress.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'ReplyEmail -> '.$this->strReplyEmail.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Recipients -> '.$this->strRecipients.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Cc -> '.$this->strCc.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Bcc -> '.$this->strBcc.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Subject -> '.$this->strSubject.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'EmailMessage -> '.$this->strEmailMessage.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'Attachments -> '.$this->strAttachments.'<br>';
	        $newAuditLogEntry->AuditLogEntryDetail .= 'ErrorInfo -> '.$this->strErrorInfo.'<br>';
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                AppSpecificFunctions::AddCustomLog('Could not save audit log while deleting EmailMessage. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailMessage`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this EmailMessage ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'EmailMessage', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all EmailMessages
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = EmailMessage::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmailMessage`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate EmailMessage table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = EmailMessage::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `EmailMessage`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this EmailMessage from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved EmailMessage object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = EmailMessage::Load($this->intId);

			// Update $this's local variables to match
			$this->dttSentDate = $objReloaded->dttSentDate;
			$this->strFromAddress = $objReloaded->strFromAddress;
			$this->strReplyEmail = $objReloaded->strReplyEmail;
			$this->strRecipients = $objReloaded->strRecipients;
			$this->strCc = $objReloaded->strCc;
			$this->strBcc = $objReloaded->strBcc;
			$this->strSubject = $objReloaded->strSubject;
			$this->strEmailMessage = $objReloaded->strEmailMessage;
			$this->strAttachments = $objReloaded->strAttachments;
			$this->strErrorInfo = $objReloaded->strErrorInfo;
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

				case 'SentDate':
					/**
					 * Gets the value for dttSentDate 
					 * @return QDateTime
					 */
					return $this->dttSentDate;

				case 'FromAddress':
					/**
					 * Gets the value for strFromAddress 
					 * @return string
					 */
					return $this->strFromAddress;

				case 'ReplyEmail':
					/**
					 * Gets the value for strReplyEmail 
					 * @return string
					 */
					return $this->strReplyEmail;

				case 'Recipients':
					/**
					 * Gets the value for strRecipients 
					 * @return string
					 */
					return $this->strRecipients;

				case 'Cc':
					/**
					 * Gets the value for strCc 
					 * @return string
					 */
					return $this->strCc;

				case 'Bcc':
					/**
					 * Gets the value for strBcc 
					 * @return string
					 */
					return $this->strBcc;

				case 'Subject':
					/**
					 * Gets the value for strSubject 
					 * @return string
					 */
					return $this->strSubject;

				case 'EmailMessage':
					/**
					 * Gets the value for strEmailMessage 
					 * @return string
					 */
					return $this->strEmailMessage;

				case 'Attachments':
					/**
					 * Gets the value for strAttachments 
					 * @return string
					 */
					return $this->strAttachments;

				case 'ErrorInfo':
					/**
					 * Gets the value for strErrorInfo 
					 * @return string
					 */
					return $this->strErrorInfo;


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
				case 'SentDate':
					/**
					 * Sets the value for dttSentDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttSentDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FromAddress':
					/**
					 * Sets the value for strFromAddress 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFromAddress = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReplyEmail':
					/**
					 * Sets the value for strReplyEmail 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strReplyEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Recipients':
					/**
					 * Sets the value for strRecipients 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strRecipients = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Cc':
					/**
					 * Sets the value for strCc 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strCc = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Bcc':
					/**
					 * Sets the value for strBcc 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strBcc = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Subject':
					/**
					 * Sets the value for strSubject 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strSubject = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EmailMessage':
					/**
					 * Sets the value for strEmailMessage 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEmailMessage = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Attachments':
					/**
					 * Sets the value for strAttachments 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAttachments = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ErrorInfo':
					/**
					 * Sets the value for strErrorInfo 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strErrorInfo = QType::Cast($mixValue, QType::String));
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
			return "EmailMessage";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[EmailMessage::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="EmailMessage"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="SentDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="FromAddress" type="xsd:string"/>';
			$strToReturn .= '<element name="ReplyEmail" type="xsd:string"/>';
			$strToReturn .= '<element name="Recipients" type="xsd:string"/>';
			$strToReturn .= '<element name="Cc" type="xsd:string"/>';
			$strToReturn .= '<element name="Bcc" type="xsd:string"/>';
			$strToReturn .= '<element name="Subject" type="xsd:string"/>';
			$strToReturn .= '<element name="EmailMessage" type="xsd:string"/>';
			$strToReturn .= '<element name="Attachments" type="xsd:string"/>';
			$strToReturn .= '<element name="ErrorInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('EmailMessage', $strComplexTypeArray)) {
				$strComplexTypeArray['EmailMessage'] = EmailMessage::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, EmailMessage::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new EmailMessage();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'SentDate'))
				$objToReturn->dttSentDate = new QDateTime($objSoapObject->SentDate);
			if (property_exists($objSoapObject, 'FromAddress'))
				$objToReturn->strFromAddress = $objSoapObject->FromAddress;
			if (property_exists($objSoapObject, 'ReplyEmail'))
				$objToReturn->strReplyEmail = $objSoapObject->ReplyEmail;
			if (property_exists($objSoapObject, 'Recipients'))
				$objToReturn->strRecipients = $objSoapObject->Recipients;
			if (property_exists($objSoapObject, 'Cc'))
				$objToReturn->strCc = $objSoapObject->Cc;
			if (property_exists($objSoapObject, 'Bcc'))
				$objToReturn->strBcc = $objSoapObject->Bcc;
			if (property_exists($objSoapObject, 'Subject'))
				$objToReturn->strSubject = $objSoapObject->Subject;
			if (property_exists($objSoapObject, 'EmailMessage'))
				$objToReturn->strEmailMessage = $objSoapObject->EmailMessage;
			if (property_exists($objSoapObject, 'Attachments'))
				$objToReturn->strAttachments = $objSoapObject->Attachments;
			if (property_exists($objSoapObject, 'ErrorInfo'))
				$objToReturn->strErrorInfo = $objSoapObject->ErrorInfo;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, EmailMessage::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttSentDate)
				$objObject->dttSentDate = $objObject->dttSentDate->qFormat(QDateTime::FormatSoap);
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
			$iArray['SentDate'] = $this->dttSentDate;
			$iArray['FromAddress'] = $this->strFromAddress;
			$iArray['ReplyEmail'] = $this->strReplyEmail;
			$iArray['Recipients'] = $this->strRecipients;
			$iArray['Cc'] = $this->strCc;
			$iArray['Bcc'] = $this->strBcc;
			$iArray['Subject'] = $this->strSubject;
			$iArray['EmailMessage'] = $this->strEmailMessage;
			$iArray['Attachments'] = $this->strAttachments;
			$iArray['ErrorInfo'] = $this->strErrorInfo;
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
     * @property-read QQNode $SentDate
     * @property-read QQNode $FromAddress
     * @property-read QQNode $ReplyEmail
     * @property-read QQNode $Recipients
     * @property-read QQNode $Cc
     * @property-read QQNode $Bcc
     * @property-read QQNode $Subject
     * @property-read QQNode $EmailMessage
     * @property-read QQNode $Attachments
     * @property-read QQNode $ErrorInfo
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeEmailMessage extends QQNode {
		protected $strTableName = 'EmailMessage';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmailMessage';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'SentDate':
					return new QQNode('SentDate', 'SentDate', 'DateTime', $this);
				case 'FromAddress':
					return new QQNode('FromAddress', 'FromAddress', 'VarChar', $this);
				case 'ReplyEmail':
					return new QQNode('ReplyEmail', 'ReplyEmail', 'VarChar', $this);
				case 'Recipients':
					return new QQNode('Recipients', 'Recipients', 'Blob', $this);
				case 'Cc':
					return new QQNode('Cc', 'Cc', 'Blob', $this);
				case 'Bcc':
					return new QQNode('Bcc', 'Bcc', 'Blob', $this);
				case 'Subject':
					return new QQNode('Subject', 'Subject', 'Blob', $this);
				case 'EmailMessage':
					return new QQNode('EmailMessage', 'EmailMessage', 'Blob', $this);
				case 'Attachments':
					return new QQNode('Attachments', 'Attachments', 'Blob', $this);
				case 'ErrorInfo':
					return new QQNode('ErrorInfo', 'ErrorInfo', 'Blob', $this);

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
     * @property-read QQNode $SentDate
     * @property-read QQNode $FromAddress
     * @property-read QQNode $ReplyEmail
     * @property-read QQNode $Recipients
     * @property-read QQNode $Cc
     * @property-read QQNode $Bcc
     * @property-read QQNode $Subject
     * @property-read QQNode $EmailMessage
     * @property-read QQNode $Attachments
     * @property-read QQNode $ErrorInfo
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeEmailMessage extends QQReverseReferenceNode {
		protected $strTableName = 'EmailMessage';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'EmailMessage';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'SentDate':
					return new QQNode('SentDate', 'SentDate', 'QDateTime', $this);
				case 'FromAddress':
					return new QQNode('FromAddress', 'FromAddress', 'string', $this);
				case 'ReplyEmail':
					return new QQNode('ReplyEmail', 'ReplyEmail', 'string', $this);
				case 'Recipients':
					return new QQNode('Recipients', 'Recipients', 'string', $this);
				case 'Cc':
					return new QQNode('Cc', 'Cc', 'string', $this);
				case 'Bcc':
					return new QQNode('Bcc', 'Bcc', 'string', $this);
				case 'Subject':
					return new QQNode('Subject', 'Subject', 'string', $this);
				case 'EmailMessage':
					return new QQNode('EmailMessage', 'EmailMessage', 'string', $this);
				case 'Attachments':
					return new QQNode('Attachments', 'Attachments', 'string', $this);
				case 'ErrorInfo':
					return new QQNode('ErrorInfo', 'ErrorInfo', 'string', $this);

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
