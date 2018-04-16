<?php
	/**
	 * The abstract PostGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Post subclass which
	 * extends this PostGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Post class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $PostText the value for strPostText 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $Account the value for intAccount 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property QDateTime $PostTimeStamp the value for dttPostTimeStamp 
	 * @property Account $AccountObject the value for the Account object referenced by intAccount 
	 * @property-read PostComment $_PostComment the value for the private _objPostComment (Read-Only) if set due to an expansion on the PostComment.Post reverse relationship
	 * @property-read PostComment[] $_PostCommentArray the value for the private _objPostCommentArray (Read-Only) if set due to an ExpandAsArray on the PostComment.Post reverse relationship
	 * @property-read PostLike $_PostLike the value for the private _objPostLike (Read-Only) if set due to an expansion on the PostLike.Post reverse relationship
	 * @property-read PostLike[] $_PostLikeArray the value for the private _objPostLikeArray (Read-Only) if set due to an ExpandAsArray on the PostLike.Post reverse relationship
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class PostGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column Post.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column Post.PostText
		 * @var string strPostText
		 */
		protected $strPostText;
		const PostTextMaxLength = 255;
		const PostTextDefault = null;


		/**
		 * Protected member variable that maps to the database column Post.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column Post.Account
		 * @var integer intAccount
		 */
		protected $intAccount;
		const AccountDefault = null;


		/**
		 * Protected member variable that maps to the database column Post.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column Post.PostTimeStamp
		 * @var QDateTime dttPostTimeStamp
		 */
		protected $dttPostTimeStamp;
		const PostTimeStampDefault = null;


		/**
		 * Private member variable that stores a reference to a single PostComment object
		 * (of type PostComment), if this Post object was restored with
		 * an expansion on the PostComment association table.
		 * @var PostComment _objPostComment;
		 */
		private $_objPostComment;

		/**
		 * Private member variable that stores a reference to an array of PostComment objects
		 * (of type PostComment[]), if this Post object was restored with
		 * an ExpandAsArray on the PostComment association table.
		 * @var PostComment[] _objPostCommentArray;
		 */
		private $_objPostCommentArray = null;

		/**
		 * Private member variable that stores a reference to a single PostLike object
		 * (of type PostLike), if this Post object was restored with
		 * an expansion on the PostLike association table.
		 * @var PostLike _objPostLike;
		 */
		private $_objPostLike;

		/**
		 * Private member variable that stores a reference to an array of PostLike objects
		 * (of type PostLike[]), if this Post object was restored with
		 * an ExpandAsArray on the PostLike association table.
		 * @var PostLike[] _objPostLikeArray;
		 */
		private $_objPostLikeArray = null;

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
		 * in the database column Post.Account.
		 *
		 * NOTE: Always use the AccountObject property getter to correctly retrieve this Account object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Account objAccountObject
		 */
		protected $objAccountObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = Post::IdDefault;
			$this->strPostText = Post::PostTextDefault;
			$this->strLastUpdated = Post::LastUpdatedDefault;
			$this->intAccount = Post::AccountDefault;
			$this->strSearchMetaInfo = Post::SearchMetaInfoDefault;
			$this->dttPostTimeStamp = (Post::PostTimeStampDefault === null)?null:new QDateTime(Post::PostTimeStampDefault);
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
		 * Load a Post from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Post
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Post', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = Post::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Post()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all Posts
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Post[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call Post::QueryArray to perform the LoadAll query
			try {
				return Post::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Posts
		 * @return int
		 */
		public static function CountAll() {
			// Call Post::QueryCount to perform the CountAll query
			return Post::QueryCount(QQ::All());
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
			$objDatabase = Post::GetDatabase();

			// Create/Build out the QueryBuilder object with Post-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'Post');

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
				Post::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('Post');

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
		 * Static Qcubed Query method to query for a single Post object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Post the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Post::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Post object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Post::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return Post::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of Post objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Post[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Post::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Post::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = Post::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of Post objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Post::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Post::GetDatabase();

			$strQuery = Post::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/post', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = Post::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Post
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'Post';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'PostText', $strAliasPrefix . 'PostText');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'Account', $strAliasPrefix . 'Account');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
			    $objBuilder->AddSelectItem($strTableName, 'PostTimeStamp', $strAliasPrefix . 'PostTimeStamp');
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
		 * Instantiate a Post from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Post::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a Post, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (Post::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the Post object
			$objToReturn = new Post();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'PostText';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strPostText = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Account';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intAccount = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'PostTimeStamp';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttPostTimeStamp = $objDbRow->GetColumn($strAliasName, 'DateTime');

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
				$strAliasPrefix = 'Post__';

			// Check for AccountObject Early Binding
			$strAlias = $strAliasPrefix . 'Account__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['Account']) ? null : $objExpansionAliasArray['Account']);
				$objToReturn->objAccountObject = Account::InstantiateDbRow($objDbRow, $strAliasPrefix . 'Account__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			// Check for PostComment Virtual Binding
			$strAlias = $strAliasPrefix . 'postcomment__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['postcomment']) ? null : $objExpansionAliasArray['postcomment']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objPostCommentArray)
				$objToReturn->_objPostCommentArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objPostCommentArray[] = PostComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'postcomment__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objPostComment)) {
					$objToReturn->_objPostComment = PostComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'postcomment__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for PostLike Virtual Binding
			$strAlias = $strAliasPrefix . 'postlike__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['postlike']) ? null : $objExpansionAliasArray['postlike']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objPostLikeArray)
				$objToReturn->_objPostLikeArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objPostLikeArray[] = PostLike::InstantiateDbRow($objDbRow, $strAliasPrefix . 'postlike__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objPostLike)) {
					$objToReturn->_objPostLike = PostLike::InstantiateDbRow($objDbRow, $strAliasPrefix . 'postlike__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of Posts from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return Post[]
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
					$objItem = Post::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = Post::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single Post object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return Post next row resulting from the query
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
			return Post::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single Post object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Post
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return Post::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Post()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of Post objects,
		 * by Account Index(es)
		 * @param integer $intAccount
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Post[]
		*/
		public static function LoadArrayByAccount($intAccount, $objOptionalClauses = null) {
			// Call Post::QueryArray to perform the LoadArrayByAccount query
			try {
				return Post::QueryArray(
					QQ::Equal(QQN::Post()->Account, $intAccount),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Posts
		 * by Account Index(es)
		 * @param integer $intAccount
		 * @return int
		*/
		public static function CountByAccount($intAccount) {
			// Call Post::QueryCount to perform the CountByAccount query
			return Post::QueryCount(
				QQ::Equal(QQN::Post()->Account, $intAccount)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this Post
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = Post::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = Post::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Post';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("PostText" => $this->strPostText));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("Account" => $this->intAccount));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
                $ChangedArray = array_merge($ChangedArray,array("PostTimeStamp" => $this->dttPostTimeStamp));
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
                if (!is_null($ExistingObj->PostText)) {
                    $ExistingValueStr = $ExistingObj->PostText;
                }
                if ($ExistingObj->PostText != $this->strPostText) {
                    $ChangedArray = array_merge($ChangedArray,array("PostText" => array("Before" => $ExistingValueStr,"After" => $this->strPostText)));
                    //$ChangedArray = array_merge($ChangedArray,array("PostText" => "From: ".$ExistingValueStr." to: ".$this->strPostText));
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
                if (!is_null($ExistingObj->PostTimeStamp)) {
                    $ExistingValueStr = $ExistingObj->PostTimeStamp;
                }
                if ($ExistingObj->PostTimeStamp != $this->dttPostTimeStamp) {
                    $ChangedArray = array_merge($ChangedArray,array("PostTimeStamp" => array("Before" => $ExistingValueStr,"After" => $this->dttPostTimeStamp)));
                    //$ChangedArray = array_merge($ChangedArray,array("PostTimeStamp" => "From: ".$ExistingValueStr." to: ".$this->dttPostTimeStamp));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `Post` (
							`PostText`,
							`Account`,
							`SearchMetaInfo`,
							`PostTimeStamp`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strPostText) . ',
							' . $objDatabase->SqlVariable($this->intAccount) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->dttPostTimeStamp) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('Post', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
			
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `Post` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('Post');
                }
				
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `Post` SET
							`PostText` = ' . $objDatabase->SqlVariable($this->strPostText) . ',
							`Account` = ' . $objDatabase->SqlVariable($this->intAccount) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							`PostTimeStamp` = ' . $objDatabase->SqlVariable($this->dttPostTimeStamp) . '
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
                error_log('Could not save audit log while saving Post. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
			            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `Post` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
				
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this Post
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Post with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Post';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("PostText" => $this->strPostText));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("Account" => $this->intAccount));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("PostTimeStamp" => $this->dttPostTimeStamp));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting Post. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Post`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this Post ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Post', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all Posts
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Post`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate Post table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `Post`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this Post from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved Post object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = Post::Load($this->intId);

			// Update $this's local variables to match
			$this->strPostText = $objReloaded->strPostText;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->Account = $objReloaded->Account;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
			$this->dttPostTimeStamp = $objReloaded->dttPostTimeStamp;
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

				case 'PostText':
					/**
					 * Gets the value for strPostText 
					 * @return string
					 */
					return $this->strPostText;

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

				case 'PostTimeStamp':
					/**
					 * Gets the value for dttPostTimeStamp 
					 * @return QDateTime
					 */
					return $this->dttPostTimeStamp;


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


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_PostComment':
					/**
					 * Gets the value for the private _objPostComment (Read-Only)
					 * if set due to an expansion on the PostComment.Post reverse relationship
					 * @return PostComment
					 */
					return $this->_objPostComment;

				case '_PostCommentArray':
					/**
					 * Gets the value for the private _objPostCommentArray (Read-Only)
					 * if set due to an ExpandAsArray on the PostComment.Post reverse relationship
					 * @return PostComment[]
					 */
					return $this->_objPostCommentArray;

				case '_PostLike':
					/**
					 * Gets the value for the private _objPostLike (Read-Only)
					 * if set due to an expansion on the PostLike.Post reverse relationship
					 * @return PostLike
					 */
					return $this->_objPostLike;

				case '_PostLikeArray':
					/**
					 * Gets the value for the private _objPostLikeArray (Read-Only)
					 * if set due to an ExpandAsArray on the PostLike.Post reverse relationship
					 * @return PostLike[]
					 */
					return $this->_objPostLikeArray;


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
				case 'PostText':
					/**
					 * Sets the value for strPostText 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPostText = QType::Cast($mixValue, QType::String));
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

				case 'PostTimeStamp':
					/**
					 * Sets the value for dttPostTimeStamp 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttPostTimeStamp = QType::Cast($mixValue, QType::DateTime));
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
							throw new QCallerException('Unable to set an unsaved AccountObject for this Post');

						// Update Local Member Variables
						$this->objAccountObject = $mixValue;
						$this->intAccount = $mixValue->Id;

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



		// Related Objects' Methods for PostComment
		//-------------------------------------------------------------------

		/**
		 * Gets all associated PostComments as an array of PostComment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PostComment[]
		*/
		public function GetPostCommentArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return PostComment::LoadArrayByPost($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated PostComments
		 * @return int
		*/
		public function CountPostComments() {
			if ((is_null($this->intId)))
				return 0;

			return PostComment::CountByPost($this->intId);
		}

		/**
		 * Associates a PostComment
		 * @param PostComment $objPostComment
		 * @return void
		*/
		public function AssociatePostComment(PostComment $objPostComment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePostComment on this unsaved Post.');
			if ((is_null($objPostComment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePostComment on this Post with an unsaved PostComment.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PostComment`
				SET
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPostComment->Id) . '
			');
		}

		/**
		 * Unassociates a PostComment
		 * @param PostComment $objPostComment
		 * @return void
		*/
		public function UnassociatePostComment(PostComment $objPostComment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostComment on this unsaved Post.');
			if ((is_null($objPostComment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostComment on this Post with an unsaved PostComment.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PostComment`
				SET
					`Post` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPostComment->Id) . ' AND
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all PostComments
		 * @return void
		*/
		public function UnassociateAllPostComments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostComment on this unsaved Post.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PostComment`
				SET
					`Post` = null
				WHERE
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated PostComment
		 * @param PostComment $objPostComment
		 * @return void
		*/
		public function DeleteAssociatedPostComment(PostComment $objPostComment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostComment on this unsaved Post.');
			if ((is_null($objPostComment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostComment on this Post with an unsaved PostComment.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PostComment`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPostComment->Id) . ' AND
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated PostComments
		 * @return void
		*/
		public function DeleteAllPostComments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostComment on this unsaved Post.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PostComment`
				WHERE
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for PostLike
		//-------------------------------------------------------------------

		/**
		 * Gets all associated PostLikes as an array of PostLike objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PostLike[]
		*/
		public function GetPostLikeArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return PostLike::LoadArrayByPost($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated PostLikes
		 * @return int
		*/
		public function CountPostLikes() {
			if ((is_null($this->intId)))
				return 0;

			return PostLike::CountByPost($this->intId);
		}

		/**
		 * Associates a PostLike
		 * @param PostLike $objPostLike
		 * @return void
		*/
		public function AssociatePostLike(PostLike $objPostLike) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePostLike on this unsaved Post.');
			if ((is_null($objPostLike->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePostLike on this Post with an unsaved PostLike.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PostLike`
				SET
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPostLike->Id) . '
			');
		}

		/**
		 * Unassociates a PostLike
		 * @param PostLike $objPostLike
		 * @return void
		*/
		public function UnassociatePostLike(PostLike $objPostLike) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostLike on this unsaved Post.');
			if ((is_null($objPostLike->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostLike on this Post with an unsaved PostLike.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PostLike`
				SET
					`Post` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPostLike->Id) . ' AND
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all PostLikes
		 * @return void
		*/
		public function UnassociateAllPostLikes() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostLike on this unsaved Post.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PostLike`
				SET
					`Post` = null
				WHERE
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated PostLike
		 * @param PostLike $objPostLike
		 * @return void
		*/
		public function DeleteAssociatedPostLike(PostLike $objPostLike) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostLike on this unsaved Post.');
			if ((is_null($objPostLike->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostLike on this Post with an unsaved PostLike.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PostLike`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPostLike->Id) . ' AND
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated PostLikes
		 * @return void
		*/
		public function DeleteAllPostLikes() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePostLike on this unsaved Post.');

			// Get the Database Object for this Class
			$objDatabase = Post::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PostLike`
				WHERE
					`Post` = ' . $objDatabase->SqlVariable($this->intId) . '
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
			return "Post";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[Post::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="Post"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="PostText" type="xsd:string"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="AccountObject" type="xsd1:Account"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="PostTimeStamp" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Post', $strComplexTypeArray)) {
				$strComplexTypeArray['Post'] = Post::GetSoapComplexTypeXml();
				Account::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Post::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Post();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'PostText'))
				$objToReturn->strPostText = $objSoapObject->PostText;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'AccountObject')) &&
				($objSoapObject->AccountObject))
				$objToReturn->AccountObject = Account::GetObjectFromSoapObject($objSoapObject->AccountObject);
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if (property_exists($objSoapObject, 'PostTimeStamp'))
				$objToReturn->dttPostTimeStamp = new QDateTime($objSoapObject->PostTimeStamp);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Post::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objAccountObject)
				$objObject->objAccountObject = Account::GetSoapObjectFromObject($objObject->objAccountObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAccount = null;
			if ($objObject->dttPostTimeStamp)
				$objObject->dttPostTimeStamp = $objObject->dttPostTimeStamp->qFormat(QDateTime::FormatSoap);
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
			$iArray['PostText'] = $this->strPostText;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['Account'] = $this->intAccount;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
			$iArray['PostTimeStamp'] = $this->dttPostTimeStamp;
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
     * @property-read QQNode $PostText
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Account
     * @property-read QQNodeAccount $AccountObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $PostTimeStamp
     *
     *
     * @property-read QQReverseReferenceNodePostComment $PostComment
     * @property-read QQReverseReferenceNodePostLike $PostLike

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodePost extends QQNode {
		protected $strTableName = 'Post';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Post';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'PostText':
					return new QQNode('PostText', 'PostText', 'VarChar', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'Account':
					return new QQNode('Account', 'Account', 'Integer', $this);
				case 'AccountObject':
					return new QQNodeAccount('Account', 'AccountObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'PostTimeStamp':
					return new QQNode('PostTimeStamp', 'PostTimeStamp', 'DateTime', $this);
				case 'PostComment':
					return new QQReverseReferenceNodePostComment($this, 'postcomment', 'reverse_reference', 'Post', 'PostComment');
				case 'PostLike':
					return new QQReverseReferenceNodePostLike($this, 'postlike', 'reverse_reference', 'Post', 'PostLike');

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
     * @property-read QQNode $PostText
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $Account
     * @property-read QQNodeAccount $AccountObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $PostTimeStamp
     *
     *
     * @property-read QQReverseReferenceNodePostComment $PostComment
     * @property-read QQReverseReferenceNodePostLike $PostLike

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodePost extends QQReverseReferenceNode {
		protected $strTableName = 'Post';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Post';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'PostText':
					return new QQNode('PostText', 'PostText', 'string', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'Account':
					return new QQNode('Account', 'Account', 'integer', $this);
				case 'AccountObject':
					return new QQNodeAccount('Account', 'AccountObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'PostTimeStamp':
					return new QQNode('PostTimeStamp', 'PostTimeStamp', 'QDateTime', $this);
				case 'PostComment':
					return new QQReverseReferenceNodePostComment($this, 'postcomment', 'reverse_reference', 'Post', 'PostComment');
				case 'PostLike':
					return new QQReverseReferenceNodePostLike($this, 'postlike', 'reverse_reference', 'Post', 'PostLike');

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
