<?php
	/**
	 * The abstract PersonGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Person subclass which
	 * extends this PersonGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Person class.
	 *
	 * @package sDev Base App
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $Id the value for intId (Read-Only PK)
	 * @property string $FirstName the value for strFirstName 
	 * @property string $Surname the value for strSurname 
	 * @property string $IDPassportNumber the value for strIDPassportNumber 
	 * @property QDateTime $DateOfBirth the value for dttDateOfBirth 
	 * @property string $TelephoneNumber the value for strTelephoneNumber 
	 * @property string $AlternativeTelephoneNumber the value for strAlternativeTelephoneNumber 
	 * @property string $Nationality the value for strNationality 
	 * @property string $EthnicGroup the value for strEthnicGroup 
	 * @property string $DriversLicense the value for strDriversLicense 
	 * @property string $CurrentAddress the value for strCurrentAddress 
	 * @property-read string $LastUpdated the value for strLastUpdated (Read-Only Timestamp)
	 * @property integer $FileDocument the value for intFileDocument 
	 * @property string $SearchMetaInfo the value for strSearchMetaInfo 
	 * @property integer $PhoneVerified the value for intPhoneVerified 
	 * @property integer $IdentityVerified the value for intIdentityVerified 
	 * @property integer $DriversLicenseVerified the value for intDriversLicenseVerified 
	 * @property FileDocument $FileDocumentObject the value for the FileDocument object referenced by intFileDocument 
	 * @property-read Education $_Education the value for the private _objEducation (Read-Only) if set due to an expansion on the Education.Person reverse relationship
	 * @property-read Education[] $_EducationArray the value for the private _objEducationArray (Read-Only) if set due to an ExpandAsArray on the Education.Person reverse relationship
	 * @property-read EmploymentHistory $_EmploymentHistory the value for the private _objEmploymentHistory (Read-Only) if set due to an expansion on the EmploymentHistory.Person reverse relationship
	 * @property-read EmploymentHistory[] $_EmploymentHistoryArray the value for the private _objEmploymentHistoryArray (Read-Only) if set due to an ExpandAsArray on the EmploymentHistory.Person reverse relationship
	 * @property-read PersonAttachment $_PersonAttachment the value for the private _objPersonAttachment (Read-Only) if set due to an expansion on the PersonAttachment.Person reverse relationship
	 * @property-read PersonAttachment[] $_PersonAttachmentArray the value for the private _objPersonAttachmentArray (Read-Only) if set due to an ExpandAsArray on the PersonAttachment.Person reverse relationship
	 * @property-read PersonLanguage $_PersonLanguage the value for the private _objPersonLanguage (Read-Only) if set due to an expansion on the PersonLanguage.Person reverse relationship
	 * @property-read PersonLanguage[] $_PersonLanguageArray the value for the private _objPersonLanguageArray (Read-Only) if set due to an ExpandAsArray on the PersonLanguage.Person reverse relationship
	 * @property-read PersonSkillsTag $_PersonSkillsTag the value for the private _objPersonSkillsTag (Read-Only) if set due to an expansion on the PersonSkillsTag.Person reverse relationship
	 * @property-read PersonSkillsTag[] $_PersonSkillsTagArray the value for the private _objPersonSkillsTagArray (Read-Only) if set due to an ExpandAsArray on the PersonSkillsTag.Person reverse relationship
	 * @property-read Reference $_Reference the value for the private _objReference (Read-Only) if set due to an expansion on the Reference.Person reverse relationship
	 * @property-read Reference[] $_ReferenceArray the value for the private _objReferenceArray (Read-Only) if set due to an ExpandAsArray on the Reference.Person reverse relationship
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class PersonGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column Person.Id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.FirstName
		 * @var string strFirstName
		 */
		protected $strFirstName;
		const FirstNameMaxLength = 50;
		const FirstNameDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.Surname
		 * @var string strSurname
		 */
		protected $strSurname;
		const SurnameMaxLength = 50;
		const SurnameDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.IDPassportNumber
		 * @var string strIDPassportNumber
		 */
		protected $strIDPassportNumber;
		const IDPassportNumberMaxLength = 20;
		const IDPassportNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.DateOfBirth
		 * @var QDateTime dttDateOfBirth
		 */
		protected $dttDateOfBirth;
		const DateOfBirthDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.TelephoneNumber
		 * @var string strTelephoneNumber
		 */
		protected $strTelephoneNumber;
		const TelephoneNumberMaxLength = 20;
		const TelephoneNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.AlternativeTelephoneNumber
		 * @var string strAlternativeTelephoneNumber
		 */
		protected $strAlternativeTelephoneNumber;
		const AlternativeTelephoneNumberMaxLength = 20;
		const AlternativeTelephoneNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.Nationality
		 * @var string strNationality
		 */
		protected $strNationality;
		const NationalityMaxLength = 20;
		const NationalityDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.EthnicGroup
		 * @var string strEthnicGroup
		 */
		protected $strEthnicGroup;
		const EthnicGroupMaxLength = 20;
		const EthnicGroupDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.DriversLicense
		 * @var string strDriversLicense
		 */
		protected $strDriversLicense;
		const DriversLicenseMaxLength = 5;
		const DriversLicenseDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.CurrentAddress
		 * @var string strCurrentAddress
		 */
		protected $strCurrentAddress;
		const CurrentAddressMaxLength = 50;
		const CurrentAddressDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.LastUpdated
		 * @var string strLastUpdated
		 */
		protected $strLastUpdated;
		const LastUpdatedDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.FileDocument
		 * @var integer intFileDocument
		 */
		protected $intFileDocument;
		const FileDocumentDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.SearchMetaInfo
		 * @var string strSearchMetaInfo
		 */
		protected $strSearchMetaInfo;
		const SearchMetaInfoDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.PhoneVerified
		 * @var integer intPhoneVerified
		 */
		protected $intPhoneVerified;
		const PhoneVerifiedDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.IdentityVerified
		 * @var integer intIdentityVerified
		 */
		protected $intIdentityVerified;
		const IdentityVerifiedDefault = null;


		/**
		 * Protected member variable that maps to the database column Person.DriversLicenseVerified
		 * @var integer intDriversLicenseVerified
		 */
		protected $intDriversLicenseVerified;
		const DriversLicenseVerifiedDefault = null;


		/**
		 * Private member variable that stores a reference to a single Education object
		 * (of type Education), if this Person object was restored with
		 * an expansion on the Education association table.
		 * @var Education _objEducation;
		 */
		private $_objEducation;

		/**
		 * Private member variable that stores a reference to an array of Education objects
		 * (of type Education[]), if this Person object was restored with
		 * an ExpandAsArray on the Education association table.
		 * @var Education[] _objEducationArray;
		 */
		private $_objEducationArray = null;

		/**
		 * Private member variable that stores a reference to a single EmploymentHistory object
		 * (of type EmploymentHistory), if this Person object was restored with
		 * an expansion on the EmploymentHistory association table.
		 * @var EmploymentHistory _objEmploymentHistory;
		 */
		private $_objEmploymentHistory;

		/**
		 * Private member variable that stores a reference to an array of EmploymentHistory objects
		 * (of type EmploymentHistory[]), if this Person object was restored with
		 * an ExpandAsArray on the EmploymentHistory association table.
		 * @var EmploymentHistory[] _objEmploymentHistoryArray;
		 */
		private $_objEmploymentHistoryArray = null;

		/**
		 * Private member variable that stores a reference to a single PersonAttachment object
		 * (of type PersonAttachment), if this Person object was restored with
		 * an expansion on the PersonAttachment association table.
		 * @var PersonAttachment _objPersonAttachment;
		 */
		private $_objPersonAttachment;

		/**
		 * Private member variable that stores a reference to an array of PersonAttachment objects
		 * (of type PersonAttachment[]), if this Person object was restored with
		 * an ExpandAsArray on the PersonAttachment association table.
		 * @var PersonAttachment[] _objPersonAttachmentArray;
		 */
		private $_objPersonAttachmentArray = null;

		/**
		 * Private member variable that stores a reference to a single PersonLanguage object
		 * (of type PersonLanguage), if this Person object was restored with
		 * an expansion on the PersonLanguage association table.
		 * @var PersonLanguage _objPersonLanguage;
		 */
		private $_objPersonLanguage;

		/**
		 * Private member variable that stores a reference to an array of PersonLanguage objects
		 * (of type PersonLanguage[]), if this Person object was restored with
		 * an ExpandAsArray on the PersonLanguage association table.
		 * @var PersonLanguage[] _objPersonLanguageArray;
		 */
		private $_objPersonLanguageArray = null;

		/**
		 * Private member variable that stores a reference to a single PersonSkillsTag object
		 * (of type PersonSkillsTag), if this Person object was restored with
		 * an expansion on the PersonSkillsTag association table.
		 * @var PersonSkillsTag _objPersonSkillsTag;
		 */
		private $_objPersonSkillsTag;

		/**
		 * Private member variable that stores a reference to an array of PersonSkillsTag objects
		 * (of type PersonSkillsTag[]), if this Person object was restored with
		 * an ExpandAsArray on the PersonSkillsTag association table.
		 * @var PersonSkillsTag[] _objPersonSkillsTagArray;
		 */
		private $_objPersonSkillsTagArray = null;

		/**
		 * Private member variable that stores a reference to a single Reference object
		 * (of type Reference), if this Person object was restored with
		 * an expansion on the Reference association table.
		 * @var Reference _objReference;
		 */
		private $_objReference;

		/**
		 * Private member variable that stores a reference to an array of Reference objects
		 * (of type Reference[]), if this Person object was restored with
		 * an ExpandAsArray on the Reference association table.
		 * @var Reference[] _objReferenceArray;
		 */
		private $_objReferenceArray = null;

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
		 * in the database column Person.FileDocument.
		 *
		 * NOTE: Always use the FileDocumentObject property getter to correctly retrieve this FileDocument object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var FileDocument objFileDocumentObject
		 */
		protected $objFileDocumentObject;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intId = Person::IdDefault;
			$this->strFirstName = Person::FirstNameDefault;
			$this->strSurname = Person::SurnameDefault;
			$this->strIDPassportNumber = Person::IDPassportNumberDefault;
			$this->dttDateOfBirth = (Person::DateOfBirthDefault === null)?null:new QDateTime(Person::DateOfBirthDefault);
			$this->strTelephoneNumber = Person::TelephoneNumberDefault;
			$this->strAlternativeTelephoneNumber = Person::AlternativeTelephoneNumberDefault;
			$this->strNationality = Person::NationalityDefault;
			$this->strEthnicGroup = Person::EthnicGroupDefault;
			$this->strDriversLicense = Person::DriversLicenseDefault;
			$this->strCurrentAddress = Person::CurrentAddressDefault;
			$this->strLastUpdated = Person::LastUpdatedDefault;
			$this->intFileDocument = Person::FileDocumentDefault;
			$this->strSearchMetaInfo = Person::SearchMetaInfoDefault;
			$this->intPhoneVerified = Person::PhoneVerifiedDefault;
			$this->intIdentityVerified = Person::IdentityVerifiedDefault;
			$this->intDriversLicenseVerified = Person::DriversLicenseVerifiedDefault;
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
		 * Load a Person from PK Info
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person
		 */
		public static function Load($intId, $objOptionalClauses = null) {
			$strCacheKey = false;
			if (QApplication::$objCacheProvider && !$objOptionalClauses && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Person', $intId);
				$objCachedObject = QApplication::$objCacheProvider->Get($strCacheKey);
				if ($objCachedObject !== false) {
					return $objCachedObject;
				}
			}
			// Use QuerySingle to Perform the Query
			$objToReturn = Person::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Person()->Id, $intId)
				),
				$objOptionalClauses
			);
			if ($strCacheKey !== false) {
				QApplication::$objCacheProvider->Set($strCacheKey, $objToReturn);
			}
			return $objToReturn;
		}

		/**
		 * Load all People
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call Person::QueryArray to perform the LoadAll query
			try {
				return Person::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all People
		 * @return int
		 */
		public static function CountAll() {
			// Call Person::QueryCount to perform the CountAll query
			return Person::QueryCount(QQ::All());
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
			$objDatabase = Person::GetDatabase();

			// Create/Build out the QueryBuilder object with Person-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'Person');

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
				Person::GetSelectFields($objQueryBuilder, null, QQuery::extractSelectClause($objOptionalClauses));
			}
			$objQueryBuilder->AddFromItem('Person');

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
		 * Static Qcubed Query method to query for a single Person object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Person the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Person object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNode) {
				$objToReturn = array();
				$objPrevItemArray = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Person::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNode, $objPrevItemArray, $objQueryBuilder->ColumnAliasArray);
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
				return Person::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of Person objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Person[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Person::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcubed Query method to query for a count of Person objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Person::GetDatabase();

			$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/person', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = Person::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNode, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Person
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, QQSelect $objSelect = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'Person';
				$strAliasPrefix = '';
			}

            if ($objSelect) {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
                $objSelect->AddSelectItems($objBuilder, $strTableName, $strAliasPrefix);
            } else {
			    $objBuilder->AddSelectItem($strTableName, 'Id', $strAliasPrefix . 'Id');
			    $objBuilder->AddSelectItem($strTableName, 'FirstName', $strAliasPrefix . 'FirstName');
			    $objBuilder->AddSelectItem($strTableName, 'Surname', $strAliasPrefix . 'Surname');
			    $objBuilder->AddSelectItem($strTableName, 'IDPassportNumber', $strAliasPrefix . 'IDPassportNumber');
			    $objBuilder->AddSelectItem($strTableName, 'DateOfBirth', $strAliasPrefix . 'DateOfBirth');
			    $objBuilder->AddSelectItem($strTableName, 'TelephoneNumber', $strAliasPrefix . 'TelephoneNumber');
			    $objBuilder->AddSelectItem($strTableName, 'AlternativeTelephoneNumber', $strAliasPrefix . 'AlternativeTelephoneNumber');
			    $objBuilder->AddSelectItem($strTableName, 'Nationality', $strAliasPrefix . 'Nationality');
			    $objBuilder->AddSelectItem($strTableName, 'EthnicGroup', $strAliasPrefix . 'EthnicGroup');
			    $objBuilder->AddSelectItem($strTableName, 'DriversLicense', $strAliasPrefix . 'DriversLicense');
			    $objBuilder->AddSelectItem($strTableName, 'CurrentAddress', $strAliasPrefix . 'CurrentAddress');
			    $objBuilder->AddSelectItem($strTableName, 'LastUpdated', $strAliasPrefix . 'LastUpdated');
			    $objBuilder->AddSelectItem($strTableName, 'FileDocument', $strAliasPrefix . 'FileDocument');
			    $objBuilder->AddSelectItem($strTableName, 'SearchMetaInfo', $strAliasPrefix . 'SearchMetaInfo');
			    $objBuilder->AddSelectItem($strTableName, 'PhoneVerified', $strAliasPrefix . 'PhoneVerified');
			    $objBuilder->AddSelectItem($strTableName, 'IdentityVerified', $strAliasPrefix . 'IdentityVerified');
			    $objBuilder->AddSelectItem($strTableName, 'DriversLicenseVerified', $strAliasPrefix . 'DriversLicenseVerified');
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
		 * Instantiate a Person from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Person::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return mixed Either a Person, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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

				if (Person::ExpandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray)) {
					return false; // db row was used but no new object was created
				}
			}

			// Create a new instance of the Person object
			$objToReturn = new Person();
			$objToReturn->__blnRestored = true;

			$strAlias = $strAliasPrefix . 'Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'FirstName';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strFirstName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Surname';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSurname = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'IDPassportNumber';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strIDPassportNumber = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'DateOfBirth';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->dttDateOfBirth = $objDbRow->GetColumn($strAliasName, 'Date');
			$strAlias = $strAliasPrefix . 'TelephoneNumber';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strTelephoneNumber = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'AlternativeTelephoneNumber';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strAlternativeTelephoneNumber = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'Nationality';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strNationality = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'EthnicGroup';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strEthnicGroup = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'DriversLicense';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strDriversLicense = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'CurrentAddress';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strCurrentAddress = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'LastUpdated';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strLastUpdated = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAlias = $strAliasPrefix . 'FileDocument';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intFileDocument = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'SearchMetaInfo';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->strSearchMetaInfo = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAlias = $strAliasPrefix . 'PhoneVerified';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intPhoneVerified = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'IdentityVerified';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intIdentityVerified = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAlias = $strAliasPrefix . 'DriversLicenseVerified';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objToReturn->intDriversLicenseVerified = $objDbRow->GetColumn($strAliasName, 'Integer');

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
				$strAliasPrefix = 'Person__';

			// Check for FileDocumentObject Early Binding
			$strAlias = $strAliasPrefix . 'FileDocument__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				$objExpansionNode = (empty($objExpansionAliasArray['FileDocument']) ? null : $objExpansionAliasArray['FileDocument']);
				$objToReturn->objFileDocumentObject = FileDocument::InstantiateDbRow($objDbRow, $strAliasPrefix . 'FileDocument__', $objExpansionNode, null, $strColumnAliasArray);
			}

				

			// Check for Education Virtual Binding
			$strAlias = $strAliasPrefix . 'education__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['education']) ? null : $objExpansionAliasArray['education']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objEducationArray)
				$objToReturn->_objEducationArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objEducationArray[] = Education::InstantiateDbRow($objDbRow, $strAliasPrefix . 'education__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objEducation)) {
					$objToReturn->_objEducation = Education::InstantiateDbRow($objDbRow, $strAliasPrefix . 'education__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for EmploymentHistory Virtual Binding
			$strAlias = $strAliasPrefix . 'employmenthistory__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['employmenthistory']) ? null : $objExpansionAliasArray['employmenthistory']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objEmploymentHistoryArray)
				$objToReturn->_objEmploymentHistoryArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objEmploymentHistoryArray[] = EmploymentHistory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'employmenthistory__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objEmploymentHistory)) {
					$objToReturn->_objEmploymentHistory = EmploymentHistory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'employmenthistory__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for PersonAttachment Virtual Binding
			$strAlias = $strAliasPrefix . 'personattachment__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['personattachment']) ? null : $objExpansionAliasArray['personattachment']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objPersonAttachmentArray)
				$objToReturn->_objPersonAttachmentArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objPersonAttachmentArray[] = PersonAttachment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'personattachment__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objPersonAttachment)) {
					$objToReturn->_objPersonAttachment = PersonAttachment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'personattachment__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for PersonLanguage Virtual Binding
			$strAlias = $strAliasPrefix . 'personlanguage__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['personlanguage']) ? null : $objExpansionAliasArray['personlanguage']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objPersonLanguageArray)
				$objToReturn->_objPersonLanguageArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objPersonLanguageArray[] = PersonLanguage::InstantiateDbRow($objDbRow, $strAliasPrefix . 'personlanguage__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objPersonLanguage)) {
					$objToReturn->_objPersonLanguage = PersonLanguage::InstantiateDbRow($objDbRow, $strAliasPrefix . 'personlanguage__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for PersonSkillsTag Virtual Binding
			$strAlias = $strAliasPrefix . 'personskillstag__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['personskillstag']) ? null : $objExpansionAliasArray['personskillstag']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objPersonSkillsTagArray)
				$objToReturn->_objPersonSkillsTagArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objPersonSkillsTagArray[] = PersonSkillsTag::InstantiateDbRow($objDbRow, $strAliasPrefix . 'personskillstag__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objPersonSkillsTag)) {
					$objToReturn->_objPersonSkillsTag = PersonSkillsTag::InstantiateDbRow($objDbRow, $strAliasPrefix . 'personskillstag__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			// Check for Reference Virtual Binding
			$strAlias = $strAliasPrefix . 'reference__Id';
			$strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
			$objExpansionNode = (empty($objExpansionAliasArray['reference']) ? null : $objExpansionAliasArray['reference']);
			$blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
			if ($blnExpanded && null === $objToReturn->_objReferenceArray)
				$objToReturn->_objReferenceArray = array();
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if ($blnExpanded) {
					$objToReturn->_objReferenceArray[] = Reference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'reference__', $objExpansionNode, null, $strColumnAliasArray);
				} elseif (is_null($objToReturn->_objReference)) {
					$objToReturn->_objReference = Reference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'reference__', $objExpansionNode, null, $strColumnAliasArray);
				}
			}

			return $objToReturn;
		}
		
		/**
		 * Instantiate an array of People from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param QQBaseNode $objExpandAsArrayNode
		 * @param string[] $strColumnAliasArray
		 * @return Person[]
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
					$objItem = Person::InstantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objPrevItemArray[$objItem->intId][] = $objItem;
		
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = Person::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}


		/**
		 * Instantiate a single Person object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return Person next row resulting from the query
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
			return Person::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////

		/**
		 * Load a single Person object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return Person::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Person()->Id, $intId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load an array of Person objects,
		 * by FileDocument Index(es)
		 * @param integer $intFileDocument
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person[]
		*/
		public static function LoadArrayByFileDocument($intFileDocument, $objOptionalClauses = null) {
			// Call Person::QueryArray to perform the LoadArrayByFileDocument query
			try {
				return Person::QueryArray(
					QQ::Equal(QQN::Person()->FileDocument, $intFileDocument),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count People
		 * by FileDocument Index(es)
		 * @param integer $intFileDocument
		 * @return int
		*/
		public static function CountByFileDocument($intFileDocument) {
			// Call Person::QueryCount to perform the CountByFileDocument query
			return Person::QueryCount(
				QQ::Equal(QQN::Person()->FileDocument, $intFileDocument)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////





		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
* Save this Person
* @param bool $blnForceInsert
* @param bool $blnForceUpdate
		 * @return int
*/
        public function Save($blnForceInsert = false, $blnForceUpdate = false) {
            // Get the Database Object for this Class
            $objDatabase = Person::GetDatabase();
            $mixToReturn = null;
            $ExistingObj = Person::Load($this->intId);
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Person';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            if (!$ExistingObj) {
                $newAuditLogEntry->ModificationType = 'Create';
                $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
                $ChangedArray = array_merge($ChangedArray,array("FirstName" => $this->strFirstName));
                $ChangedArray = array_merge($ChangedArray,array("Surname" => $this->strSurname));
                $ChangedArray = array_merge($ChangedArray,array("IDPassportNumber" => $this->strIDPassportNumber));
                $ChangedArray = array_merge($ChangedArray,array("DateOfBirth" => $this->dttDateOfBirth));
                $ChangedArray = array_merge($ChangedArray,array("TelephoneNumber" => $this->strTelephoneNumber));
                $ChangedArray = array_merge($ChangedArray,array("AlternativeTelephoneNumber" => $this->strAlternativeTelephoneNumber));
                $ChangedArray = array_merge($ChangedArray,array("Nationality" => $this->strNationality));
                $ChangedArray = array_merge($ChangedArray,array("EthnicGroup" => $this->strEthnicGroup));
                $ChangedArray = array_merge($ChangedArray,array("DriversLicense" => $this->strDriversLicense));
                $ChangedArray = array_merge($ChangedArray,array("CurrentAddress" => $this->strCurrentAddress));
                $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
                $ChangedArray = array_merge($ChangedArray,array("FileDocument" => $this->intFileDocument));
                $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
                $ChangedArray = array_merge($ChangedArray,array("PhoneVerified" => $this->intPhoneVerified));
                $ChangedArray = array_merge($ChangedArray,array("IdentityVerified" => $this->intIdentityVerified));
                $ChangedArray = array_merge($ChangedArray,array("DriversLicenseVerified" => $this->intDriversLicenseVerified));
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
                if (!is_null($ExistingObj->FirstName)) {
                    $ExistingValueStr = $ExistingObj->FirstName;
                }
                if ($ExistingObj->FirstName != $this->strFirstName) {
                    $ChangedArray = array_merge($ChangedArray,array("FirstName" => array("Before" => $ExistingValueStr,"After" => $this->strFirstName)));
                    //$ChangedArray = array_merge($ChangedArray,array("FirstName" => "From: ".$ExistingValueStr." to: ".$this->strFirstName));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Surname)) {
                    $ExistingValueStr = $ExistingObj->Surname;
                }
                if ($ExistingObj->Surname != $this->strSurname) {
                    $ChangedArray = array_merge($ChangedArray,array("Surname" => array("Before" => $ExistingValueStr,"After" => $this->strSurname)));
                    //$ChangedArray = array_merge($ChangedArray,array("Surname" => "From: ".$ExistingValueStr." to: ".$this->strSurname));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->IDPassportNumber)) {
                    $ExistingValueStr = $ExistingObj->IDPassportNumber;
                }
                if ($ExistingObj->IDPassportNumber != $this->strIDPassportNumber) {
                    $ChangedArray = array_merge($ChangedArray,array("IDPassportNumber" => array("Before" => $ExistingValueStr,"After" => $this->strIDPassportNumber)));
                    //$ChangedArray = array_merge($ChangedArray,array("IDPassportNumber" => "From: ".$ExistingValueStr." to: ".$this->strIDPassportNumber));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DateOfBirth)) {
                    $ExistingValueStr = $ExistingObj->DateOfBirth;
                }
                if ($ExistingObj->DateOfBirth != $this->dttDateOfBirth) {
                    $ChangedArray = array_merge($ChangedArray,array("DateOfBirth" => array("Before" => $ExistingValueStr,"After" => $this->dttDateOfBirth)));
                    //$ChangedArray = array_merge($ChangedArray,array("DateOfBirth" => "From: ".$ExistingValueStr." to: ".$this->dttDateOfBirth));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->TelephoneNumber)) {
                    $ExistingValueStr = $ExistingObj->TelephoneNumber;
                }
                if ($ExistingObj->TelephoneNumber != $this->strTelephoneNumber) {
                    $ChangedArray = array_merge($ChangedArray,array("TelephoneNumber" => array("Before" => $ExistingValueStr,"After" => $this->strTelephoneNumber)));
                    //$ChangedArray = array_merge($ChangedArray,array("TelephoneNumber" => "From: ".$ExistingValueStr." to: ".$this->strTelephoneNumber));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->AlternativeTelephoneNumber)) {
                    $ExistingValueStr = $ExistingObj->AlternativeTelephoneNumber;
                }
                if ($ExistingObj->AlternativeTelephoneNumber != $this->strAlternativeTelephoneNumber) {
                    $ChangedArray = array_merge($ChangedArray,array("AlternativeTelephoneNumber" => array("Before" => $ExistingValueStr,"After" => $this->strAlternativeTelephoneNumber)));
                    //$ChangedArray = array_merge($ChangedArray,array("AlternativeTelephoneNumber" => "From: ".$ExistingValueStr." to: ".$this->strAlternativeTelephoneNumber));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->Nationality)) {
                    $ExistingValueStr = $ExistingObj->Nationality;
                }
                if ($ExistingObj->Nationality != $this->strNationality) {
                    $ChangedArray = array_merge($ChangedArray,array("Nationality" => array("Before" => $ExistingValueStr,"After" => $this->strNationality)));
                    //$ChangedArray = array_merge($ChangedArray,array("Nationality" => "From: ".$ExistingValueStr." to: ".$this->strNationality));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->EthnicGroup)) {
                    $ExistingValueStr = $ExistingObj->EthnicGroup;
                }
                if ($ExistingObj->EthnicGroup != $this->strEthnicGroup) {
                    $ChangedArray = array_merge($ChangedArray,array("EthnicGroup" => array("Before" => $ExistingValueStr,"After" => $this->strEthnicGroup)));
                    //$ChangedArray = array_merge($ChangedArray,array("EthnicGroup" => "From: ".$ExistingValueStr." to: ".$this->strEthnicGroup));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DriversLicense)) {
                    $ExistingValueStr = $ExistingObj->DriversLicense;
                }
                if ($ExistingObj->DriversLicense != $this->strDriversLicense) {
                    $ChangedArray = array_merge($ChangedArray,array("DriversLicense" => array("Before" => $ExistingValueStr,"After" => $this->strDriversLicense)));
                    //$ChangedArray = array_merge($ChangedArray,array("DriversLicense" => "From: ".$ExistingValueStr." to: ".$this->strDriversLicense));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->CurrentAddress)) {
                    $ExistingValueStr = $ExistingObj->CurrentAddress;
                }
                if ($ExistingObj->CurrentAddress != $this->strCurrentAddress) {
                    $ChangedArray = array_merge($ChangedArray,array("CurrentAddress" => array("Before" => $ExistingValueStr,"After" => $this->strCurrentAddress)));
                    //$ChangedArray = array_merge($ChangedArray,array("CurrentAddress" => "From: ".$ExistingValueStr." to: ".$this->strCurrentAddress));
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
                if (!is_null($ExistingObj->FileDocument)) {
                    $ExistingValueStr = $ExistingObj->FileDocument;
                }
                if ($ExistingObj->FileDocument != $this->intFileDocument) {
                    $ChangedArray = array_merge($ChangedArray,array("FileDocument" => array("Before" => $ExistingValueStr,"After" => $this->intFileDocument)));
                    //$ChangedArray = array_merge($ChangedArray,array("FileDocument" => "From: ".$ExistingValueStr." to: ".$this->intFileDocument));
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
                if (!is_null($ExistingObj->PhoneVerified)) {
                    $ExistingValueStr = $ExistingObj->PhoneVerified;
                }
                if ($ExistingObj->PhoneVerified != $this->intPhoneVerified) {
                    $ChangedArray = array_merge($ChangedArray,array("PhoneVerified" => array("Before" => $ExistingValueStr,"After" => $this->intPhoneVerified)));
                    //$ChangedArray = array_merge($ChangedArray,array("PhoneVerified" => "From: ".$ExistingValueStr." to: ".$this->intPhoneVerified));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->IdentityVerified)) {
                    $ExistingValueStr = $ExistingObj->IdentityVerified;
                }
                if ($ExistingObj->IdentityVerified != $this->intIdentityVerified) {
                    $ChangedArray = array_merge($ChangedArray,array("IdentityVerified" => array("Before" => $ExistingValueStr,"After" => $this->intIdentityVerified)));
                    //$ChangedArray = array_merge($ChangedArray,array("IdentityVerified" => "From: ".$ExistingValueStr." to: ".$this->intIdentityVerified));
                }
                $ExistingValueStr = "NULL";
                if (!is_null($ExistingObj->DriversLicenseVerified)) {
                    $ExistingValueStr = $ExistingObj->DriversLicenseVerified;
                }
                if ($ExistingObj->DriversLicenseVerified != $this->intDriversLicenseVerified) {
                    $ChangedArray = array_merge($ChangedArray,array("DriversLicenseVerified" => array("Before" => $ExistingValueStr,"After" => $this->intDriversLicenseVerified)));
                    //$ChangedArray = array_merge($ChangedArray,array("DriversLicenseVerified" => "From: ".$ExistingValueStr." to: ".$this->intDriversLicenseVerified));
                }
                $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            }
            try {
                if ((!$this->__blnRestored) || ($blnForceInsert)) {
                    // Perform an INSERT query
                    $objDatabase->NonQuery('
                    INSERT INTO `Person` (
							`FirstName`,
							`Surname`,
							`IDPassportNumber`,
							`DateOfBirth`,
							`TelephoneNumber`,
							`AlternativeTelephoneNumber`,
							`Nationality`,
							`EthnicGroup`,
							`DriversLicense`,
							`CurrentAddress`,
							`FileDocument`,
							`SearchMetaInfo`,
							`PhoneVerified`,
							`IdentityVerified`,
							`DriversLicenseVerified`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strFirstName) . ',
							' . $objDatabase->SqlVariable($this->strSurname) . ',
							' . $objDatabase->SqlVariable($this->strIDPassportNumber) . ',
							' . $objDatabase->SqlVariable($this->dttDateOfBirth) . ',
							' . $objDatabase->SqlVariable($this->strTelephoneNumber) . ',
							' . $objDatabase->SqlVariable($this->strAlternativeTelephoneNumber) . ',
							' . $objDatabase->SqlVariable($this->strNationality) . ',
							' . $objDatabase->SqlVariable($this->strEthnicGroup) . ',
							' . $objDatabase->SqlVariable($this->strDriversLicense) . ',
							' . $objDatabase->SqlVariable($this->strCurrentAddress) . ',
							' . $objDatabase->SqlVariable($this->intFileDocument) . ',
							' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							' . $objDatabase->SqlVariable($this->intPhoneVerified) . ',
							' . $objDatabase->SqlVariable($this->intIdentityVerified) . ',
							' . $objDatabase->SqlVariable($this->intDriversLicenseVerified) . '
						)
                    ');
					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('Person', 'Id');                
                } else {
                    // Perform an UPDATE query
                    // First checking for Optimistic Locking constraints (if applicable)
												
                    if (!$blnForceUpdate) {
                        // Perform the Optimistic Locking check
                        $objResult = $objDatabase->Query('
                        SELECT `LastUpdated` FROM `Person` WHERE
							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

                    $objRow = $objResult->FetchArray();
                    if ($objRow[0] != $this->strLastUpdated)
                        throw new QOptimisticLockingException('Person');
                }
						
                // Perform the UPDATE query
                $objDatabase->NonQuery('
                UPDATE `Person` SET
							`FirstName` = ' . $objDatabase->SqlVariable($this->strFirstName) . ',
							`Surname` = ' . $objDatabase->SqlVariable($this->strSurname) . ',
							`IDPassportNumber` = ' . $objDatabase->SqlVariable($this->strIDPassportNumber) . ',
							`DateOfBirth` = ' . $objDatabase->SqlVariable($this->dttDateOfBirth) . ',
							`TelephoneNumber` = ' . $objDatabase->SqlVariable($this->strTelephoneNumber) . ',
							`AlternativeTelephoneNumber` = ' . $objDatabase->SqlVariable($this->strAlternativeTelephoneNumber) . ',
							`Nationality` = ' . $objDatabase->SqlVariable($this->strNationality) . ',
							`EthnicGroup` = ' . $objDatabase->SqlVariable($this->strEthnicGroup) . ',
							`DriversLicense` = ' . $objDatabase->SqlVariable($this->strDriversLicense) . ',
							`CurrentAddress` = ' . $objDatabase->SqlVariable($this->strCurrentAddress) . ',
							`FileDocument` = ' . $objDatabase->SqlVariable($this->intFileDocument) . ',
							`SearchMetaInfo` = ' . $objDatabase->SqlVariable($this->strSearchMetaInfo) . ',
							`PhoneVerified` = ' . $objDatabase->SqlVariable($this->intPhoneVerified) . ',
							`IdentityVerified` = ' . $objDatabase->SqlVariable($this->intIdentityVerified) . ',
							`DriversLicenseVerified` = ' . $objDatabase->SqlVariable($this->intDriversLicenseVerified) . '
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
                error_log('Could not save audit log while saving Person. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }
            // Update __blnRestored and any Non-Identity PK Columns (if applicable)
            $this->__blnRestored = true;
	
												            // Update Local Timestamp
            $objResult = $objDatabase->Query('SELECT `LastUpdated` FROM
                                                `Person` WHERE
                    							`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

            $objRow = $objResult->FetchArray();
            $this->strLastUpdated = $objRow[0];
						
            $this->DeleteCache();
            
            // Return
            return $mixToReturn;
        }

		/**
		 * Delete this Person
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Person with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();
            $newAuditLogEntry = new AuditLogEntry();
            $ChangedArray = array();
            $newAuditLogEntry->EntryTimeStamp = QDateTime::Now();
            $newAuditLogEntry->ObjectId = $this->intId;
            $newAuditLogEntry->ObjectName = 'Person';
            $newAuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $newAuditLogEntry->ModificationType = 'Delete';
            $ChangedArray = array_merge($ChangedArray,array("Id" => $this->intId));
            $ChangedArray = array_merge($ChangedArray,array("FirstName" => $this->strFirstName));
            $ChangedArray = array_merge($ChangedArray,array("Surname" => $this->strSurname));
            $ChangedArray = array_merge($ChangedArray,array("IDPassportNumber" => $this->strIDPassportNumber));
            $ChangedArray = array_merge($ChangedArray,array("DateOfBirth" => $this->dttDateOfBirth));
            $ChangedArray = array_merge($ChangedArray,array("TelephoneNumber" => $this->strTelephoneNumber));
            $ChangedArray = array_merge($ChangedArray,array("AlternativeTelephoneNumber" => $this->strAlternativeTelephoneNumber));
            $ChangedArray = array_merge($ChangedArray,array("Nationality" => $this->strNationality));
            $ChangedArray = array_merge($ChangedArray,array("EthnicGroup" => $this->strEthnicGroup));
            $ChangedArray = array_merge($ChangedArray,array("DriversLicense" => $this->strDriversLicense));
            $ChangedArray = array_merge($ChangedArray,array("CurrentAddress" => $this->strCurrentAddress));
            $ChangedArray = array_merge($ChangedArray,array("LastUpdated" => $this->strLastUpdated));
            $ChangedArray = array_merge($ChangedArray,array("FileDocument" => $this->intFileDocument));
            $ChangedArray = array_merge($ChangedArray,array("SearchMetaInfo" => $this->strSearchMetaInfo));
            $ChangedArray = array_merge($ChangedArray,array("PhoneVerified" => $this->intPhoneVerified));
            $ChangedArray = array_merge($ChangedArray,array("IdentityVerified" => $this->intIdentityVerified));
            $ChangedArray = array_merge($ChangedArray,array("DriversLicenseVerified" => $this->intDriversLicenseVerified));
            $newAuditLogEntry->AuditLogEntryDetail = json_encode($ChangedArray);
            try {
                $newAuditLogEntry->Save();
            } catch(QCallerException $e) {
                error_log('Could not save audit log while deleting Person. Details: '.$newAuditLogEntry->getJson().'<br>Error details: '.$e->getMessage());
            }

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Person`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			$this->DeleteCache();
		}

        /**
 	     * Delete this Person ONLY from the cache
 		 * @return void
		 */
		public function DeleteCache() {
			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				$strCacheKey = QApplication::$objCacheProvider->CreateKey(QApplication::$Database[1]->Database, 'Person', $this->intId);
				QApplication::$objCacheProvider->Delete($strCacheKey);
			}
		}

		/**
		 * Delete all People
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Person`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Truncate Person table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `Person`');

			if (QApplication::$objCacheProvider && QApplication::$Database[1]->Caching) {
				QApplication::$objCacheProvider->DeleteAll();
			}
		}

		/**
		 * Reload this Person from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved Person object.');

			$this->DeleteCache();

			// Reload the Object
			$objReloaded = Person::Load($this->intId);

			// Update $this's local variables to match
			$this->strFirstName = $objReloaded->strFirstName;
			$this->strSurname = $objReloaded->strSurname;
			$this->strIDPassportNumber = $objReloaded->strIDPassportNumber;
			$this->dttDateOfBirth = $objReloaded->dttDateOfBirth;
			$this->strTelephoneNumber = $objReloaded->strTelephoneNumber;
			$this->strAlternativeTelephoneNumber = $objReloaded->strAlternativeTelephoneNumber;
			$this->strNationality = $objReloaded->strNationality;
			$this->strEthnicGroup = $objReloaded->strEthnicGroup;
			$this->strDriversLicense = $objReloaded->strDriversLicense;
			$this->strCurrentAddress = $objReloaded->strCurrentAddress;
			$this->strLastUpdated = $objReloaded->strLastUpdated;
			$this->FileDocument = $objReloaded->FileDocument;
			$this->strSearchMetaInfo = $objReloaded->strSearchMetaInfo;
			$this->intPhoneVerified = $objReloaded->intPhoneVerified;
			$this->intIdentityVerified = $objReloaded->intIdentityVerified;
			$this->intDriversLicenseVerified = $objReloaded->intDriversLicenseVerified;
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

				case 'FirstName':
					/**
					 * Gets the value for strFirstName 
					 * @return string
					 */
					return $this->strFirstName;

				case 'Surname':
					/**
					 * Gets the value for strSurname 
					 * @return string
					 */
					return $this->strSurname;

				case 'IDPassportNumber':
					/**
					 * Gets the value for strIDPassportNumber 
					 * @return string
					 */
					return $this->strIDPassportNumber;

				case 'DateOfBirth':
					/**
					 * Gets the value for dttDateOfBirth 
					 * @return QDateTime
					 */
					return $this->dttDateOfBirth;

				case 'TelephoneNumber':
					/**
					 * Gets the value for strTelephoneNumber 
					 * @return string
					 */
					return $this->strTelephoneNumber;

				case 'AlternativeTelephoneNumber':
					/**
					 * Gets the value for strAlternativeTelephoneNumber 
					 * @return string
					 */
					return $this->strAlternativeTelephoneNumber;

				case 'Nationality':
					/**
					 * Gets the value for strNationality 
					 * @return string
					 */
					return $this->strNationality;

				case 'EthnicGroup':
					/**
					 * Gets the value for strEthnicGroup 
					 * @return string
					 */
					return $this->strEthnicGroup;

				case 'DriversLicense':
					/**
					 * Gets the value for strDriversLicense 
					 * @return string
					 */
					return $this->strDriversLicense;

				case 'CurrentAddress':
					/**
					 * Gets the value for strCurrentAddress 
					 * @return string
					 */
					return $this->strCurrentAddress;

				case 'LastUpdated':
					/**
					 * Gets the value for strLastUpdated (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strLastUpdated;

				case 'FileDocument':
					/**
					 * Gets the value for intFileDocument 
					 * @return integer
					 */
					return $this->intFileDocument;

				case 'SearchMetaInfo':
					/**
					 * Gets the value for strSearchMetaInfo 
					 * @return string
					 */
					return $this->strSearchMetaInfo;

				case 'PhoneVerified':
					/**
					 * Gets the value for intPhoneVerified 
					 * @return integer
					 */
					return $this->intPhoneVerified;

				case 'IdentityVerified':
					/**
					 * Gets the value for intIdentityVerified 
					 * @return integer
					 */
					return $this->intIdentityVerified;

				case 'DriversLicenseVerified':
					/**
					 * Gets the value for intDriversLicenseVerified 
					 * @return integer
					 */
					return $this->intDriversLicenseVerified;


				///////////////////
				// Member Objects
				///////////////////
				case 'FileDocumentObject':
					/**
					 * Gets the value for the FileDocument object referenced by intFileDocument 
					 * @return FileDocument
					 */
					try {
						if ((!$this->objFileDocumentObject) && (!is_null($this->intFileDocument)))
							$this->objFileDocumentObject = FileDocument::Load($this->intFileDocument);
						return $this->objFileDocumentObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_Education':
					/**
					 * Gets the value for the private _objEducation (Read-Only)
					 * if set due to an expansion on the Education.Person reverse relationship
					 * @return Education
					 */
					return $this->_objEducation;

				case '_EducationArray':
					/**
					 * Gets the value for the private _objEducationArray (Read-Only)
					 * if set due to an ExpandAsArray on the Education.Person reverse relationship
					 * @return Education[]
					 */
					return $this->_objEducationArray;

				case '_EmploymentHistory':
					/**
					 * Gets the value for the private _objEmploymentHistory (Read-Only)
					 * if set due to an expansion on the EmploymentHistory.Person reverse relationship
					 * @return EmploymentHistory
					 */
					return $this->_objEmploymentHistory;

				case '_EmploymentHistoryArray':
					/**
					 * Gets the value for the private _objEmploymentHistoryArray (Read-Only)
					 * if set due to an ExpandAsArray on the EmploymentHistory.Person reverse relationship
					 * @return EmploymentHistory[]
					 */
					return $this->_objEmploymentHistoryArray;

				case '_PersonAttachment':
					/**
					 * Gets the value for the private _objPersonAttachment (Read-Only)
					 * if set due to an expansion on the PersonAttachment.Person reverse relationship
					 * @return PersonAttachment
					 */
					return $this->_objPersonAttachment;

				case '_PersonAttachmentArray':
					/**
					 * Gets the value for the private _objPersonAttachmentArray (Read-Only)
					 * if set due to an ExpandAsArray on the PersonAttachment.Person reverse relationship
					 * @return PersonAttachment[]
					 */
					return $this->_objPersonAttachmentArray;

				case '_PersonLanguage':
					/**
					 * Gets the value for the private _objPersonLanguage (Read-Only)
					 * if set due to an expansion on the PersonLanguage.Person reverse relationship
					 * @return PersonLanguage
					 */
					return $this->_objPersonLanguage;

				case '_PersonLanguageArray':
					/**
					 * Gets the value for the private _objPersonLanguageArray (Read-Only)
					 * if set due to an ExpandAsArray on the PersonLanguage.Person reverse relationship
					 * @return PersonLanguage[]
					 */
					return $this->_objPersonLanguageArray;

				case '_PersonSkillsTag':
					/**
					 * Gets the value for the private _objPersonSkillsTag (Read-Only)
					 * if set due to an expansion on the PersonSkillsTag.Person reverse relationship
					 * @return PersonSkillsTag
					 */
					return $this->_objPersonSkillsTag;

				case '_PersonSkillsTagArray':
					/**
					 * Gets the value for the private _objPersonSkillsTagArray (Read-Only)
					 * if set due to an ExpandAsArray on the PersonSkillsTag.Person reverse relationship
					 * @return PersonSkillsTag[]
					 */
					return $this->_objPersonSkillsTagArray;

				case '_Reference':
					/**
					 * Gets the value for the private _objReference (Read-Only)
					 * if set due to an expansion on the Reference.Person reverse relationship
					 * @return Reference
					 */
					return $this->_objReference;

				case '_ReferenceArray':
					/**
					 * Gets the value for the private _objReferenceArray (Read-Only)
					 * if set due to an ExpandAsArray on the Reference.Person reverse relationship
					 * @return Reference[]
					 */
					return $this->_objReferenceArray;


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

				case 'Surname':
					/**
					 * Sets the value for strSurname 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strSurname = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'IDPassportNumber':
					/**
					 * Sets the value for strIDPassportNumber 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strIDPassportNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DateOfBirth':
					/**
					 * Sets the value for dttDateOfBirth 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttDateOfBirth = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'TelephoneNumber':
					/**
					 * Sets the value for strTelephoneNumber 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strTelephoneNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AlternativeTelephoneNumber':
					/**
					 * Sets the value for strAlternativeTelephoneNumber 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAlternativeTelephoneNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Nationality':
					/**
					 * Sets the value for strNationality 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strNationality = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EthnicGroup':
					/**
					 * Sets the value for strEthnicGroup 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEthnicGroup = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DriversLicense':
					/**
					 * Sets the value for strDriversLicense 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strDriversLicense = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CurrentAddress':
					/**
					 * Sets the value for strCurrentAddress 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strCurrentAddress = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FileDocument':
					/**
					 * Sets the value for intFileDocument 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objFileDocumentObject = null;
						return ($this->intFileDocument = QType::Cast($mixValue, QType::Integer));
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

				case 'PhoneVerified':
					/**
					 * Sets the value for intPhoneVerified 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intPhoneVerified = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'IdentityVerified':
					/**
					 * Sets the value for intIdentityVerified 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intIdentityVerified = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DriversLicenseVerified':
					/**
					 * Sets the value for intDriversLicenseVerified 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intDriversLicenseVerified = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'FileDocumentObject':
					/**
					 * Sets the value for the FileDocument object referenced by intFileDocument 
					 * @param FileDocument $mixValue
					 * @return FileDocument
					 */
					if (is_null($mixValue)) {
						$this->intFileDocument = null;
						$this->objFileDocumentObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a FileDocument object
						try {
							$mixValue = QType::Cast($mixValue, 'FileDocument');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED FileDocument object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved FileDocumentObject for this Person');

						// Update Local Member Variables
						$this->objFileDocumentObject = $mixValue;
						$this->intFileDocument = $mixValue->Id;

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



		// Related Objects' Methods for Education
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Educations as an array of Education objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Education[]
		*/
		public function GetEducationArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Education::LoadArrayByPerson($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Educations
		 * @return int
		*/
		public function CountEducations() {
			if ((is_null($this->intId)))
				return 0;

			return Education::CountByPerson($this->intId);
		}

		/**
		 * Associates a Education
		 * @param Education $objEducation
		 * @return void
		*/
		public function AssociateEducation(Education $objEducation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEducation on this unsaved Person.');
			if ((is_null($objEducation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEducation on this Person with an unsaved Education.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Education`
				SET
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEducation->Id) . '
			');
		}

		/**
		 * Unassociates a Education
		 * @param Education $objEducation
		 * @return void
		*/
		public function UnassociateEducation(Education $objEducation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved Person.');
			if ((is_null($objEducation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this Person with an unsaved Education.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Education`
				SET
					`Person` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEducation->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Educations
		 * @return void
		*/
		public function UnassociateAllEducations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Education`
				SET
					`Person` = null
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Education
		 * @param Education $objEducation
		 * @return void
		*/
		public function DeleteAssociatedEducation(Education $objEducation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved Person.');
			if ((is_null($objEducation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this Person with an unsaved Education.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Education`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEducation->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Educations
		 * @return void
		*/
		public function DeleteAllEducations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEducation on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Education`
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for EmploymentHistory
		//-------------------------------------------------------------------

		/**
		 * Gets all associated EmploymentHistories as an array of EmploymentHistory objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmploymentHistory[]
		*/
		public function GetEmploymentHistoryArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return EmploymentHistory::LoadArrayByPerson($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated EmploymentHistories
		 * @return int
		*/
		public function CountEmploymentHistories() {
			if ((is_null($this->intId)))
				return 0;

			return EmploymentHistory::CountByPerson($this->intId);
		}

		/**
		 * Associates a EmploymentHistory
		 * @param EmploymentHistory $objEmploymentHistory
		 * @return void
		*/
		public function AssociateEmploymentHistory(EmploymentHistory $objEmploymentHistory) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmploymentHistory on this unsaved Person.');
			if ((is_null($objEmploymentHistory->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmploymentHistory on this Person with an unsaved EmploymentHistory.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmploymentHistory`
				SET
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmploymentHistory->Id) . '
			');
		}

		/**
		 * Unassociates a EmploymentHistory
		 * @param EmploymentHistory $objEmploymentHistory
		 * @return void
		*/
		public function UnassociateEmploymentHistory(EmploymentHistory $objEmploymentHistory) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved Person.');
			if ((is_null($objEmploymentHistory->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this Person with an unsaved EmploymentHistory.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmploymentHistory`
				SET
					`Person` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmploymentHistory->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all EmploymentHistories
		 * @return void
		*/
		public function UnassociateAllEmploymentHistories() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`EmploymentHistory`
				SET
					`Person` = null
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated EmploymentHistory
		 * @param EmploymentHistory $objEmploymentHistory
		 * @return void
		*/
		public function DeleteAssociatedEmploymentHistory(EmploymentHistory $objEmploymentHistory) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved Person.');
			if ((is_null($objEmploymentHistory->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this Person with an unsaved EmploymentHistory.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmploymentHistory`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objEmploymentHistory->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated EmploymentHistories
		 * @return void
		*/
		public function DeleteAllEmploymentHistories() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmploymentHistory on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`EmploymentHistory`
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for PersonAttachment
		//-------------------------------------------------------------------

		/**
		 * Gets all associated PersonAttachments as an array of PersonAttachment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PersonAttachment[]
		*/
		public function GetPersonAttachmentArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return PersonAttachment::LoadArrayByPerson($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated PersonAttachments
		 * @return int
		*/
		public function CountPersonAttachments() {
			if ((is_null($this->intId)))
				return 0;

			return PersonAttachment::CountByPerson($this->intId);
		}

		/**
		 * Associates a PersonAttachment
		 * @param PersonAttachment $objPersonAttachment
		 * @return void
		*/
		public function AssociatePersonAttachment(PersonAttachment $objPersonAttachment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePersonAttachment on this unsaved Person.');
			if ((is_null($objPersonAttachment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePersonAttachment on this Person with an unsaved PersonAttachment.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonAttachment`
				SET
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonAttachment->Id) . '
			');
		}

		/**
		 * Unassociates a PersonAttachment
		 * @param PersonAttachment $objPersonAttachment
		 * @return void
		*/
		public function UnassociatePersonAttachment(PersonAttachment $objPersonAttachment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonAttachment on this unsaved Person.');
			if ((is_null($objPersonAttachment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonAttachment on this Person with an unsaved PersonAttachment.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonAttachment`
				SET
					`Person` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonAttachment->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all PersonAttachments
		 * @return void
		*/
		public function UnassociateAllPersonAttachments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonAttachment on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonAttachment`
				SET
					`Person` = null
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated PersonAttachment
		 * @param PersonAttachment $objPersonAttachment
		 * @return void
		*/
		public function DeleteAssociatedPersonAttachment(PersonAttachment $objPersonAttachment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonAttachment on this unsaved Person.');
			if ((is_null($objPersonAttachment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonAttachment on this Person with an unsaved PersonAttachment.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PersonAttachment`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonAttachment->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated PersonAttachments
		 * @return void
		*/
		public function DeleteAllPersonAttachments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonAttachment on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PersonAttachment`
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for PersonLanguage
		//-------------------------------------------------------------------

		/**
		 * Gets all associated PersonLanguages as an array of PersonLanguage objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PersonLanguage[]
		*/
		public function GetPersonLanguageArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return PersonLanguage::LoadArrayByPerson($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated PersonLanguages
		 * @return int
		*/
		public function CountPersonLanguages() {
			if ((is_null($this->intId)))
				return 0;

			return PersonLanguage::CountByPerson($this->intId);
		}

		/**
		 * Associates a PersonLanguage
		 * @param PersonLanguage $objPersonLanguage
		 * @return void
		*/
		public function AssociatePersonLanguage(PersonLanguage $objPersonLanguage) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePersonLanguage on this unsaved Person.');
			if ((is_null($objPersonLanguage->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePersonLanguage on this Person with an unsaved PersonLanguage.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonLanguage`
				SET
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonLanguage->Id) . '
			');
		}

		/**
		 * Unassociates a PersonLanguage
		 * @param PersonLanguage $objPersonLanguage
		 * @return void
		*/
		public function UnassociatePersonLanguage(PersonLanguage $objPersonLanguage) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonLanguage on this unsaved Person.');
			if ((is_null($objPersonLanguage->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonLanguage on this Person with an unsaved PersonLanguage.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonLanguage`
				SET
					`Person` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonLanguage->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all PersonLanguages
		 * @return void
		*/
		public function UnassociateAllPersonLanguages() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonLanguage on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonLanguage`
				SET
					`Person` = null
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated PersonLanguage
		 * @param PersonLanguage $objPersonLanguage
		 * @return void
		*/
		public function DeleteAssociatedPersonLanguage(PersonLanguage $objPersonLanguage) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonLanguage on this unsaved Person.');
			if ((is_null($objPersonLanguage->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonLanguage on this Person with an unsaved PersonLanguage.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PersonLanguage`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonLanguage->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated PersonLanguages
		 * @return void
		*/
		public function DeleteAllPersonLanguages() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonLanguage on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PersonLanguage`
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for PersonSkillsTag
		//-------------------------------------------------------------------

		/**
		 * Gets all associated PersonSkillsTags as an array of PersonSkillsTag objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return PersonSkillsTag[]
		*/
		public function GetPersonSkillsTagArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return PersonSkillsTag::LoadArrayByPerson($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated PersonSkillsTags
		 * @return int
		*/
		public function CountPersonSkillsTags() {
			if ((is_null($this->intId)))
				return 0;

			return PersonSkillsTag::CountByPerson($this->intId);
		}

		/**
		 * Associates a PersonSkillsTag
		 * @param PersonSkillsTag $objPersonSkillsTag
		 * @return void
		*/
		public function AssociatePersonSkillsTag(PersonSkillsTag $objPersonSkillsTag) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePersonSkillsTag on this unsaved Person.');
			if ((is_null($objPersonSkillsTag->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePersonSkillsTag on this Person with an unsaved PersonSkillsTag.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonSkillsTag`
				SET
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonSkillsTag->Id) . '
			');
		}

		/**
		 * Unassociates a PersonSkillsTag
		 * @param PersonSkillsTag $objPersonSkillsTag
		 * @return void
		*/
		public function UnassociatePersonSkillsTag(PersonSkillsTag $objPersonSkillsTag) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonSkillsTag on this unsaved Person.');
			if ((is_null($objPersonSkillsTag->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonSkillsTag on this Person with an unsaved PersonSkillsTag.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonSkillsTag`
				SET
					`Person` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonSkillsTag->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all PersonSkillsTags
		 * @return void
		*/
		public function UnassociateAllPersonSkillsTags() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonSkillsTag on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`PersonSkillsTag`
				SET
					`Person` = null
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated PersonSkillsTag
		 * @param PersonSkillsTag $objPersonSkillsTag
		 * @return void
		*/
		public function DeleteAssociatedPersonSkillsTag(PersonSkillsTag $objPersonSkillsTag) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonSkillsTag on this unsaved Person.');
			if ((is_null($objPersonSkillsTag->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonSkillsTag on this Person with an unsaved PersonSkillsTag.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PersonSkillsTag`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objPersonSkillsTag->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated PersonSkillsTags
		 * @return void
		*/
		public function DeleteAllPersonSkillsTags() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePersonSkillsTag on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`PersonSkillsTag`
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}


		// Related Objects' Methods for Reference
		//-------------------------------------------------------------------

		/**
		 * Gets all associated References as an array of Reference objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Reference[]
		*/
		public function GetReferenceArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Reference::LoadArrayByPerson($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated References
		 * @return int
		*/
		public function CountReferences() {
			if ((is_null($this->intId)))
				return 0;

			return Reference::CountByPerson($this->intId);
		}

		/**
		 * Associates a Reference
		 * @param Reference $objReference
		 * @return void
		*/
		public function AssociateReference(Reference $objReference) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateReference on this unsaved Person.');
			if ((is_null($objReference->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateReference on this Person with an unsaved Reference.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Reference`
				SET
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objReference->Id) . '
			');
		}

		/**
		 * Unassociates a Reference
		 * @param Reference $objReference
		 * @return void
		*/
		public function UnassociateReference(Reference $objReference) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved Person.');
			if ((is_null($objReference->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this Person with an unsaved Reference.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Reference`
				SET
					`Person` = null
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objReference->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all References
		 * @return void
		*/
		public function UnassociateAllReferences() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`Reference`
				SET
					`Person` = null
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Reference
		 * @param Reference $objReference
		 * @return void
		*/
		public function DeleteAssociatedReference(Reference $objReference) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved Person.');
			if ((is_null($objReference->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this Person with an unsaved Reference.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Reference`
				WHERE
					`Id` = ' . $objDatabase->SqlVariable($objReference->Id) . ' AND
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated References
		 * @return void
		*/
		public function DeleteAllReferences() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReference on this unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`Reference`
				WHERE
					`Person` = ' . $objDatabase->SqlVariable($this->intId) . '
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
			return "Person";
		}

		/**
		 * Static method to retrieve the Table name from which this class has been created.
		 * @return string Name of the table from which this class has been created.
		 */
		public static function GetDatabaseName() {
			return QApplication::$Database[Person::GetDatabaseIndex()]->Database;
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
			$strToReturn = '<complexType name="Person"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="FirstName" type="xsd:string"/>';
			$strToReturn .= '<element name="Surname" type="xsd:string"/>';
			$strToReturn .= '<element name="IDPassportNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="DateOfBirth" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="TelephoneNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="AlternativeTelephoneNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="Nationality" type="xsd:string"/>';
			$strToReturn .= '<element name="EthnicGroup" type="xsd:string"/>';
			$strToReturn .= '<element name="DriversLicense" type="xsd:string"/>';
			$strToReturn .= '<element name="CurrentAddress" type="xsd:string"/>';
			$strToReturn .= '<element name="LastUpdated" type="xsd:string"/>';
			$strToReturn .= '<element name="FileDocumentObject" type="xsd1:FileDocument"/>';
			$strToReturn .= '<element name="SearchMetaInfo" type="xsd:string"/>';
			$strToReturn .= '<element name="PhoneVerified" type="xsd:int"/>';
			$strToReturn .= '<element name="IdentityVerified" type="xsd:int"/>';
			$strToReturn .= '<element name="DriversLicenseVerified" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Person', $strComplexTypeArray)) {
				$strComplexTypeArray['Person'] = Person::GetSoapComplexTypeXml();
				FileDocument::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Person::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Person();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'FirstName'))
				$objToReturn->strFirstName = $objSoapObject->FirstName;
			if (property_exists($objSoapObject, 'Surname'))
				$objToReturn->strSurname = $objSoapObject->Surname;
			if (property_exists($objSoapObject, 'IDPassportNumber'))
				$objToReturn->strIDPassportNumber = $objSoapObject->IDPassportNumber;
			if (property_exists($objSoapObject, 'DateOfBirth'))
				$objToReturn->dttDateOfBirth = new QDateTime($objSoapObject->DateOfBirth);
			if (property_exists($objSoapObject, 'TelephoneNumber'))
				$objToReturn->strTelephoneNumber = $objSoapObject->TelephoneNumber;
			if (property_exists($objSoapObject, 'AlternativeTelephoneNumber'))
				$objToReturn->strAlternativeTelephoneNumber = $objSoapObject->AlternativeTelephoneNumber;
			if (property_exists($objSoapObject, 'Nationality'))
				$objToReturn->strNationality = $objSoapObject->Nationality;
			if (property_exists($objSoapObject, 'EthnicGroup'))
				$objToReturn->strEthnicGroup = $objSoapObject->EthnicGroup;
			if (property_exists($objSoapObject, 'DriversLicense'))
				$objToReturn->strDriversLicense = $objSoapObject->DriversLicense;
			if (property_exists($objSoapObject, 'CurrentAddress'))
				$objToReturn->strCurrentAddress = $objSoapObject->CurrentAddress;
			if (property_exists($objSoapObject, 'LastUpdated'))
				$objToReturn->strLastUpdated = $objSoapObject->LastUpdated;
			if ((property_exists($objSoapObject, 'FileDocumentObject')) &&
				($objSoapObject->FileDocumentObject))
				$objToReturn->FileDocumentObject = FileDocument::GetObjectFromSoapObject($objSoapObject->FileDocumentObject);
			if (property_exists($objSoapObject, 'SearchMetaInfo'))
				$objToReturn->strSearchMetaInfo = $objSoapObject->SearchMetaInfo;
			if (property_exists($objSoapObject, 'PhoneVerified'))
				$objToReturn->intPhoneVerified = $objSoapObject->PhoneVerified;
			if (property_exists($objSoapObject, 'IdentityVerified'))
				$objToReturn->intIdentityVerified = $objSoapObject->IdentityVerified;
			if (property_exists($objSoapObject, 'DriversLicenseVerified'))
				$objToReturn->intDriversLicenseVerified = $objSoapObject->DriversLicenseVerified;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Person::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttDateOfBirth)
				$objObject->dttDateOfBirth = $objObject->dttDateOfBirth->qFormat(QDateTime::FormatSoap);
			if ($objObject->objFileDocumentObject)
				$objObject->objFileDocumentObject = FileDocument::GetSoapObjectFromObject($objObject->objFileDocumentObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intFileDocument = null;
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
			$iArray['FirstName'] = $this->strFirstName;
			$iArray['Surname'] = $this->strSurname;
			$iArray['IDPassportNumber'] = $this->strIDPassportNumber;
			$iArray['DateOfBirth'] = $this->dttDateOfBirth;
			$iArray['TelephoneNumber'] = $this->strTelephoneNumber;
			$iArray['AlternativeTelephoneNumber'] = $this->strAlternativeTelephoneNumber;
			$iArray['Nationality'] = $this->strNationality;
			$iArray['EthnicGroup'] = $this->strEthnicGroup;
			$iArray['DriversLicense'] = $this->strDriversLicense;
			$iArray['CurrentAddress'] = $this->strCurrentAddress;
			$iArray['LastUpdated'] = $this->strLastUpdated;
			$iArray['FileDocument'] = $this->intFileDocument;
			$iArray['SearchMetaInfo'] = $this->strSearchMetaInfo;
			$iArray['PhoneVerified'] = $this->intPhoneVerified;
			$iArray['IdentityVerified'] = $this->intIdentityVerified;
			$iArray['DriversLicenseVerified'] = $this->intDriversLicenseVerified;
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
     * @property-read QQNode $FirstName
     * @property-read QQNode $Surname
     * @property-read QQNode $IDPassportNumber
     * @property-read QQNode $DateOfBirth
     * @property-read QQNode $TelephoneNumber
     * @property-read QQNode $AlternativeTelephoneNumber
     * @property-read QQNode $Nationality
     * @property-read QQNode $EthnicGroup
     * @property-read QQNode $DriversLicense
     * @property-read QQNode $CurrentAddress
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $FileDocument
     * @property-read QQNodeFileDocument $FileDocumentObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $PhoneVerified
     * @property-read QQNode $IdentityVerified
     * @property-read QQNode $DriversLicenseVerified
     *
     *
     * @property-read QQReverseReferenceNodeEducation $Education
     * @property-read QQReverseReferenceNodeEmploymentHistory $EmploymentHistory
     * @property-read QQReverseReferenceNodePersonAttachment $PersonAttachment
     * @property-read QQReverseReferenceNodePersonLanguage $PersonLanguage
     * @property-read QQReverseReferenceNodePersonSkillsTag $PersonSkillsTag
     * @property-read QQReverseReferenceNodeReference $Reference

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodePerson extends QQNode {
		protected $strTableName = 'Person';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Person';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'Integer', $this);
				case 'FirstName':
					return new QQNode('FirstName', 'FirstName', 'VarChar', $this);
				case 'Surname':
					return new QQNode('Surname', 'Surname', 'VarChar', $this);
				case 'IDPassportNumber':
					return new QQNode('IDPassportNumber', 'IDPassportNumber', 'VarChar', $this);
				case 'DateOfBirth':
					return new QQNode('DateOfBirth', 'DateOfBirth', 'Date', $this);
				case 'TelephoneNumber':
					return new QQNode('TelephoneNumber', 'TelephoneNumber', 'VarChar', $this);
				case 'AlternativeTelephoneNumber':
					return new QQNode('AlternativeTelephoneNumber', 'AlternativeTelephoneNumber', 'VarChar', $this);
				case 'Nationality':
					return new QQNode('Nationality', 'Nationality', 'VarChar', $this);
				case 'EthnicGroup':
					return new QQNode('EthnicGroup', 'EthnicGroup', 'VarChar', $this);
				case 'DriversLicense':
					return new QQNode('DriversLicense', 'DriversLicense', 'VarChar', $this);
				case 'CurrentAddress':
					return new QQNode('CurrentAddress', 'CurrentAddress', 'VarChar', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'VarChar', $this);
				case 'FileDocument':
					return new QQNode('FileDocument', 'FileDocument', 'Integer', $this);
				case 'FileDocumentObject':
					return new QQNodeFileDocument('FileDocument', 'FileDocumentObject', 'Integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'Blob', $this);
				case 'PhoneVerified':
					return new QQNode('PhoneVerified', 'PhoneVerified', 'Integer', $this);
				case 'IdentityVerified':
					return new QQNode('IdentityVerified', 'IdentityVerified', 'Integer', $this);
				case 'DriversLicenseVerified':
					return new QQNode('DriversLicenseVerified', 'DriversLicenseVerified', 'Integer', $this);
				case 'Education':
					return new QQReverseReferenceNodeEducation($this, 'education', 'reverse_reference', 'Person', 'Education');
				case 'EmploymentHistory':
					return new QQReverseReferenceNodeEmploymentHistory($this, 'employmenthistory', 'reverse_reference', 'Person', 'EmploymentHistory');
				case 'PersonAttachment':
					return new QQReverseReferenceNodePersonAttachment($this, 'personattachment', 'reverse_reference', 'Person', 'PersonAttachment');
				case 'PersonLanguage':
					return new QQReverseReferenceNodePersonLanguage($this, 'personlanguage', 'reverse_reference', 'Person', 'PersonLanguage');
				case 'PersonSkillsTag':
					return new QQReverseReferenceNodePersonSkillsTag($this, 'personskillstag', 'reverse_reference', 'Person', 'PersonSkillsTag');
				case 'Reference':
					return new QQReverseReferenceNodeReference($this, 'reference', 'reverse_reference', 'Person', 'Reference');

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
     * @property-read QQNode $FirstName
     * @property-read QQNode $Surname
     * @property-read QQNode $IDPassportNumber
     * @property-read QQNode $DateOfBirth
     * @property-read QQNode $TelephoneNumber
     * @property-read QQNode $AlternativeTelephoneNumber
     * @property-read QQNode $Nationality
     * @property-read QQNode $EthnicGroup
     * @property-read QQNode $DriversLicense
     * @property-read QQNode $CurrentAddress
     * @property-read QQNode $LastUpdated
     * @property-read QQNode $FileDocument
     * @property-read QQNodeFileDocument $FileDocumentObject
     * @property-read QQNode $SearchMetaInfo
     * @property-read QQNode $PhoneVerified
     * @property-read QQNode $IdentityVerified
     * @property-read QQNode $DriversLicenseVerified
     *
     *
     * @property-read QQReverseReferenceNodeEducation $Education
     * @property-read QQReverseReferenceNodeEmploymentHistory $EmploymentHistory
     * @property-read QQReverseReferenceNodePersonAttachment $PersonAttachment
     * @property-read QQReverseReferenceNodePersonLanguage $PersonLanguage
     * @property-read QQReverseReferenceNodePersonSkillsTag $PersonSkillsTag
     * @property-read QQReverseReferenceNodeReference $Reference

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodePerson extends QQReverseReferenceNode {
		protected $strTableName = 'Person';
		protected $strPrimaryKey = 'Id';
		protected $strClassName = 'Person';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('Id', 'Id', 'integer', $this);
				case 'FirstName':
					return new QQNode('FirstName', 'FirstName', 'string', $this);
				case 'Surname':
					return new QQNode('Surname', 'Surname', 'string', $this);
				case 'IDPassportNumber':
					return new QQNode('IDPassportNumber', 'IDPassportNumber', 'string', $this);
				case 'DateOfBirth':
					return new QQNode('DateOfBirth', 'DateOfBirth', 'QDateTime', $this);
				case 'TelephoneNumber':
					return new QQNode('TelephoneNumber', 'TelephoneNumber', 'string', $this);
				case 'AlternativeTelephoneNumber':
					return new QQNode('AlternativeTelephoneNumber', 'AlternativeTelephoneNumber', 'string', $this);
				case 'Nationality':
					return new QQNode('Nationality', 'Nationality', 'string', $this);
				case 'EthnicGroup':
					return new QQNode('EthnicGroup', 'EthnicGroup', 'string', $this);
				case 'DriversLicense':
					return new QQNode('DriversLicense', 'DriversLicense', 'string', $this);
				case 'CurrentAddress':
					return new QQNode('CurrentAddress', 'CurrentAddress', 'string', $this);
				case 'LastUpdated':
					return new QQNode('LastUpdated', 'LastUpdated', 'string', $this);
				case 'FileDocument':
					return new QQNode('FileDocument', 'FileDocument', 'integer', $this);
				case 'FileDocumentObject':
					return new QQNodeFileDocument('FileDocument', 'FileDocumentObject', 'integer', $this);
				case 'SearchMetaInfo':
					return new QQNode('SearchMetaInfo', 'SearchMetaInfo', 'string', $this);
				case 'PhoneVerified':
					return new QQNode('PhoneVerified', 'PhoneVerified', 'integer', $this);
				case 'IdentityVerified':
					return new QQNode('IdentityVerified', 'IdentityVerified', 'integer', $this);
				case 'DriversLicenseVerified':
					return new QQNode('DriversLicenseVerified', 'DriversLicenseVerified', 'integer', $this);
				case 'Education':
					return new QQReverseReferenceNodeEducation($this, 'education', 'reverse_reference', 'Person', 'Education');
				case 'EmploymentHistory':
					return new QQReverseReferenceNodeEmploymentHistory($this, 'employmenthistory', 'reverse_reference', 'Person', 'EmploymentHistory');
				case 'PersonAttachment':
					return new QQReverseReferenceNodePersonAttachment($this, 'personattachment', 'reverse_reference', 'Person', 'PersonAttachment');
				case 'PersonLanguage':
					return new QQReverseReferenceNodePersonLanguage($this, 'personlanguage', 'reverse_reference', 'Person', 'PersonLanguage');
				case 'PersonSkillsTag':
					return new QQReverseReferenceNodePersonSkillsTag($this, 'personskillstag', 'reverse_reference', 'Person', 'PersonSkillsTag');
				case 'Reference':
					return new QQReverseReferenceNodeReference($this, 'reference', 'reverse_reference', 'Person', 'Reference');

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
