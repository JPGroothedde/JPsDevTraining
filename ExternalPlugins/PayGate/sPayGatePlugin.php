<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 22112016
 * Time: 21:23
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require_once('../../sdev.inc.php');
require_once('paygate.payweb3.php');

class sPayGatePlugin {
	protected $MandatoryFields;
	protected $OptionalFields;
	protected $Data;
	protected $EncryptionKey = 'secret';// Should be more secure and would probably be set by PayGate
	protected $PayWeb3;
	protected $PayGateReturnData;
	protected $ResultData = null;
	protected $IsSub = false;
	
	public function __construct($PayGateId = 'None',$Reference = 'None',$Amount = '1',$Currency = 'ZAR',$Country = 'ZAF',$UserEmail = 'info@stratusolve.co',$EncryptionKey = 'secret',$IsSubscription = false) {
		if ($Reference == 'None')
			$Reference = 'sdevpg_'.QDateTime::Now()->format('YmdHis');
		$protocol = 'http://';
		if (QApplication::isSecure())
			$protocol = 'https://';
		$www = QApplicationBase::HostHasWWW()?'www.':'';
		$server = $_SERVER['SERVER_NAME'];
		$ReturnUrl = $protocol.$www.$server.$_SERVER['REQUEST_URI'];
		if (!$IsSubscription) {
			$this->MandatoryFields = array(
				'PAYGATE_ID'        => filter_var($PayGateId, FILTER_SANITIZE_STRING),
				'REFERENCE'         => filter_var($Reference, FILTER_SANITIZE_STRING),
				'AMOUNT'            => filter_var($Amount, FILTER_SANITIZE_NUMBER_INT),
				'CURRENCY'          => filter_var($Currency, FILTER_SANITIZE_STRING),
				'RETURN_URL'        => filter_var($ReturnUrl, FILTER_SANITIZE_URL),
				'TRANSACTION_DATE'  => filter_var(QDateTime::Now()->format('Y-m-d H:i:s'), FILTER_SANITIZE_STRING),
				'LOCALE'            => filter_var('en-za', FILTER_SANITIZE_STRING),
				'COUNTRY'           => filter_var($Country, FILTER_SANITIZE_STRING),
				'EMAIL'             => filter_var($UserEmail, FILTER_SANITIZE_EMAIL)
			);
		} else {
			$this->IsSub = true;
			$this->MandatoryFields = array(
				'VERSION'           => filter_var(__PAYGATE_PAYSUBS_VERSION__, FILTER_SANITIZE_STRING),
				'PAYGATE_ID'        => filter_var($PayGateId, FILTER_SANITIZE_STRING),
				'REFERENCE'         => filter_var($Reference, FILTER_SANITIZE_STRING),
				'AMOUNT'            => filter_var($Amount, FILTER_SANITIZE_NUMBER_INT),
				'CURRENCY'          => filter_var($Currency, FILTER_SANITIZE_STRING),
				'RETURN_URL'        => filter_var($ReturnUrl, FILTER_SANITIZE_URL),
				'TRANSACTION_DATE'  => filter_var(QDateTime::Now()->format('Y-m-d H:i:s'), FILTER_SANITIZE_STRING),
				//'LOCALE'            => filter_var('en-za', FILTER_SANITIZE_STRING),
				//'COUNTRY'           => filter_var($Country, FILTER_SANITIZE_STRING),
				'EMAIL'             => filter_var($UserEmail, FILTER_SANITIZE_EMAIL),
				'SUBS_START_DATE'   => filter_var(QDateTime::Now()->format('Y-m-d H:i:s'), FILTER_SANITIZE_STRING),
				'SUBS_END_DATE'     => filter_var(QDateTime::Now()->format('Y-m-d H:i:s'), FILTER_SANITIZE_STRING),
				'SUBS_FREQUENCY'    => filter_var('229', FILTER_SANITIZE_NUMBER_INT),
				'PROCESS_NOW'       => filter_var('NO', FILTER_SANITIZE_STRING),
				'PROCESS_NOW_AMOUNT'  => filter_var('', FILTER_SANITIZE_NUMBER_INT)
			);
		}
		//TODO: Implement this at a later stage
		$this->OptionalFields = array(/*
            'PAY_METHOD'        => (isset($_POST['PAY_METHOD']) ? filter_var($_POST['PAY_METHOD'], FILTER_SANITIZE_STRING) : ''),
            'PAY_METHOD_DETAIL' => (isset($_POST['PAY_METHOD_DETAIL']) ? filter_var($_POST['PAY_METHOD_DETAIL'], FILTER_SANITIZE_STRING) : ''),
            'NOTIFY_URL'        => (isset($_POST['NOTIFY_URL']) ? filter_var($_POST['NOTIFY_URL'], FILTER_SANITIZE_URL) : ''),
            'USER1'             => (isset($_POST['USER1']) ? filter_var($_POST['USER1'], FILTER_SANITIZE_URL) : ''),
            'USER2'             => (isset($_POST['USER2']) ? filter_var($_POST['USER2'], FILTER_SANITIZE_URL) : ''),
            'USER3'             => (isset($_POST['USER3']) ? filter_var($_POST['USER3'], FILTER_SANITIZE_URL) : ''),
            'VAULT'             => (isset($_POST['VAULT']) ? filter_var($_POST['VAULT'], FILTER_SANITIZE_NUMBER_INT) : ''),
            'VAULT_ID'          => (isset($_POST['VAULT_ID']) ? filter_var($_POST['VAULT_ID'], FILTER_SANITIZE_STRING) : '')*/
		);
		
		if (isset($_SESSION['PayGateEncryptKey'])) {
			$this->EncryptionKey = $_SESSION['PayGateEncryptKey'];
		} else {
			$this->EncryptionKey = $EncryptionKey;
		}
		if ($this->IsSub) {
			if (isset($_POST['RESULT_CODE'])) {
				$this->ResultData = array(
					//'PAYGATE_ID'         => $_SESSION['PayGateId'],
					'RESULT_CODE'        => $_POST['RESULT_CODE'],
					'TRANSACTION_STATUS' => $_POST['TRANSACTION_STATUS'],
					//'REFERENCE'          => $_SESSION['PayGateReference'],
					//'CHECKSUM'           => $_POST['CHECKSUM']
				);
				unset($_POST['RESULT_CODE']);
			}
		} else {
			if (isset($_POST['PAY_REQUEST_ID'])) {
				$this->ResultData = array(
					'PAYGATE_ID'         => $_SESSION['PayGateId'],
					'PAY_REQUEST_ID'     => $_POST['PAY_REQUEST_ID'],
					'TRANSACTION_STATUS' => $_POST['TRANSACTION_STATUS'],
					'REFERENCE'          => $_SESSION['PayGateReference'],
					'CHECKSUM'           => $_POST['CHECKSUM']
				);
				unset($_POST['PAY_REQUEST_ID']);
			}
		}
	}
	public function makePayment($Amount = null,$Reference = null,$Currency = 'ZAR',$Country = 'ZAF',$UserEmail = 'info@stratusolve.co',
	                            $SubscriptionStartDate = null,$SubscriptionEndDate = null,$SubscriptionFrequency = 229,$ProcessFirstSubPaymentNow = 'NO',$ProcessNowAmount = '') {
		if ($Amount) {
			$this->MandatoryFields['AMOUNT'] = filter_var($Amount, FILTER_SANITIZE_NUMBER_INT);
		}
		if ($Reference) {
			$this->MandatoryFields['REFERENCE'] = filter_var($Reference, FILTER_SANITIZE_STRING);
		}
		if (strlen($UserEmail) > 0) {
			$this->MandatoryFields['EMAIL'] = filter_var($UserEmail, FILTER_SANITIZE_EMAIL);
		}
		$this->MandatoryFields['CURRENCY'] = filter_var($Currency, FILTER_SANITIZE_STRING);
		if ($this->IsSub) {
			if ($SubscriptionStartDate)
				$this->MandatoryFields['SUBS_START_DATE'] = filter_var($SubscriptionStartDate, FILTER_SANITIZE_STRING);
			if ($SubscriptionEndDate)
				$this->MandatoryFields['SUBS_END_DATE'] = filter_var($SubscriptionEndDate, FILTER_SANITIZE_STRING);
			$this->MandatoryFields['PROCESS_NOW'] = filter_var($ProcessFirstSubPaymentNow, FILTER_SANITIZE_STRING);
			if (strlen($ProcessNowAmount) > 0)
				$this->MandatoryFields['PROCESS_NOW_AMOUNT'] = filter_var($ProcessNowAmount, FILTER_SANITIZE_NUMBER_INT);
			else
				$this->MandatoryFields['PROCESS_NOW_AMOUNT'] = '';
		} else {
			$this->MandatoryFields['COUNTRY'] = filter_var($Country, FILTER_SANITIZE_STRING);
		}
		
		$this->Data = array_merge($this->MandatoryFields, $this->OptionalFields);
		$this->PayWeb3 = new PayGate_PayWeb3($this->IsSub);
		//if debug is set to true, the curl request and result as well as the calculated checksum source will be logged to the php error log
		$this->PayWeb3->setDebug(true);
		$this->PayWeb3->setEncryptionKey($this->EncryptionKey);
		$this->PayWeb3->setInitiateRequest($this->Data);
		if (!$this->IsSub) {
			$this->PayGateReturnData = $this->PayWeb3->doInitiate();
			if (isset($this->PayWeb3->lastError)) {
				AppSpecificFunctions::AddCustomLog('PayGate Error: '.$this->PayWeb3->lastError);
				return false;
			}
			$isValid = $this->PayWeb3->validateChecksum($this->PayWeb3->initiateResponse);
		} else {
			$this->Data['CHECKSUM'] = $this->PayWeb3->doInitiate();
			AppSpecificFunctions::AddCustomLog('Paygate data array: '.json_encode($this->Data));
			$isValid = $this->PayWeb3->validateChecksum($this->Data);
			AppSpecificFunctions::AddCustomLog('Valid Checksum: '.$isValid?'Yes':'No');
		}
		$process_url = $this->PayWeb3->getProcessUrl();
		$htmlForm = '<form action="'.$process_url.'" method="post" name="paygate_process_form">';
		if($isValid){
			//If the checksums match loop through the returned fields and create the redirect from
			$TheDataArray = $this->PayWeb3->processRequest;
			if ($this->IsSub)
				$TheDataArray = $this->Data;
			foreach($TheDataArray as $key => $value){
				$htmlForm .= '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
			}
		} else {
			AppSpecificFunctions::AddCustomLog('PayGate Error: Checksums do not match');
			return false;
		}
		$htmlForm .= '</form>';
		AppSpecificFunctions::AddCustomLog('PayGate form body: <br>'.$htmlForm);
		$_SESSION['PayGateId']      = $this->Data['PAYGATE_ID'];
		$_SESSION['PayGateReference'] = $this->Data['REFERENCE'];
		$_SESSION['PayGateEncryptKey'] = $this->EncryptionKey;
		AppSpecificFunctions::AddCustomLog('The session data before: '.json_encode($_SESSION));
		
		$js = 'var form = $(\''.$htmlForm.'\');
            $(\'body\').append(form);
            form.submit();';
		AppSpecificFunctions::ExecuteJavaScript($js);
	}
	public function checkPaymentResult() {
		if (!$this->ResultData)
			return false;
		AppSpecificFunctions::AddCustomLog('Has Result Data');
		$this->PayWeb3 = new PayGate_PayWeb3(true);
		if ($this->IsSub) {
			if ($this->ResultData['RESULT_CODE'] == '990028')
				return 'Cancelled';
			if ($this->ResultData['RESULT_CODE'] == '9900003')
				return 'Insufficient Funds';
			if ($this->ResultData['RESULT_CODE'] == '9900007')
				return 'Declined';
			return $this->PayWeb3->getTransactionStatusDescription($this->ResultData['TRANSACTION_STATUS']);
		}
		// Set the encryption key of your PayGate PayWeb3 configuration
		$this->PayWeb3->setEncryptionKey($this->EncryptionKey);
		//Check that the checksum returned matches the checksum paygate generates
		$isValid = $this->PayWeb3->validateChecksum($this->ResultData);
		if ($isValid) {
			return $this->PayWeb3->getTransactionStatusDescription($this->ResultData['TRANSACTION_STATUS']);
		} else {
			AppSpecificFunctions::AddCustomLog('PayGate Error: Checksum failed after payment attempt');
			return false;
		}
	}
	public function getData($strAttribute = '') {
		if (array_key_exists($strAttribute,$this->Data))
			return $this->Data[$strAttribute];
		return '';
	}
	protected function generateCountrySelectOptions(){
		$options = '';
		$country = 'ZAF';
		
		$mostUsedCountryArray = array(
			'DEU' => 'Germany',
			'ZAF' => 'South Africa',
			'USA' => 'United States'
		);
		
		$countryArray = array(
			'ARG'  => 'Argentina',
			'BRA'  => 'Brazil',
			'CHL'  => 'Chile',
			'KEN'  => 'Kenya',
			'MEX'  => 'Mexico',
			'GBR'  => 'United Kingdom',
			'USA'  => 'United States',
			'ZAF'  => 'South Africa',
			'AFG'  => 'Afghanistan',
			'ALB'  => 'Albania',
			'DZA'  => 'Algeria',
			'ASM'  => 'American Samoa',
			'AND'  => 'Andorra',
			'AGO'  => 'Angola',
			'AIA'  => 'Anguilla',
			'ATA'  => 'Antarctica',
			'ATG'  => 'Antigua and Barbuda',
			'ARG'  => 'Argentina',
			'ARM'  => 'Armenia',
			'ABW'  => 'Aruba',
			'AUS'  => 'Australia',
			'AUT'  => 'Austria',
			'AZE'  => 'Azerbaijan',
			'BHS'  => 'Bahamas',
			'BHR'  => 'Bahrain',
			'BGD'  => 'Bangladesh',
			'BRB'  => 'Barbados',
			'BLR'  => 'Belarus',
			'BEL'  => 'Belgium',
			'BLZ'  => 'Belize',
			'BEN'  => 'Benin',
			'BMU'  => 'Bermuda',
			'BTN'  => 'Bhutan',
			'BOL'  => 'Bolivia',
			'BIH'  => 'Bosnia and Herzegovina',
			'BWA'  => 'Botswana',
			'BVT'  => 'Bouvet Island',
			'BRA'  => 'Brazil',
			'IOT'  => 'British Indian Ocean Territory',
			'VGB'  => 'British Virgin Islands',
			'BRN'  => 'Brunei Darussalam',
			'BGR'  => 'Bulgaria',
			'BFA'  => 'Burkina Faso',
			'BDI'  => 'Burundi',
			'KHM'  => 'Cambodia',
			'CMR'  => 'Cameroon',
			'CAN'  => 'Canada',
			'CPV'  => 'Cape Verde',
			'CYM'  => 'Cayman Islands',
			'CAF'  => 'Central African Republic',
			'TCD'  => 'Chad',
			'CHL'  => 'Chile',
			'CHN'  => 'China',
			'CXR'  => 'Christmas Island',
			'CCK'  => 'Cocos (Keeling) Islands',
			'COL'  => 'Colombia',
			'COL'  => 'Comoros',
			'COG'  => 'Congo',
			'COD'  => 'Congo, The Democratic Republic of The',
			'COK'  => 'Cook Islands',
			'CRI'  => 'Costa Rica',
			'CIV'  => 'Cote D\'ivoire',
			'CHRV' => 'Croatia',
			'CUB'  => 'Cuba',
			'CYP'  => 'Cyprus',
			'CZE'  => 'Czech Republic',
			'DNK'  => 'Denmark',
			'DJI'  => 'Djibouti',
			'DMA'  => 'Dominica',
			'DOM'  => 'Dominican Republic',
			'ECU'  => 'Ecuador',
			'EGY'  => 'Egypt',
			'SLV'  => 'El Salvador',
			'GNQ'  => 'Equatorial Guinea',
			'ERI'  => 'Eritrea',
			'EST'  => 'Estonia',
			'ETH'  => 'Ethiopia',
			'FLK'  => 'Falkland Islands (Malvinas)',
			'FRO'  => 'Faroe Islands',
			'FJI'  => 'Fiji',
			'FIN'  => 'Finland',
			'FRA'  => 'France',
			'FXX'  => 'French Metropolitan',
			'GUF'  => 'French Guiana',
			'PYF'  => 'French Polynesia',
			'ATF'  => 'French Southern Territories',
			'GAB'  => 'Gabon',
			'GMB'  => 'Gambia',
			'GEO'  => 'Georgia',
			'DEU'  => 'Germany',
			'GHA'  => 'Ghana',
			'GIB'  => 'Gibraltar',
			'GRC'  => 'Greece',
			'GRL'  => 'Greenland',
			'GRD'  => 'Grenada',
			'GLP'  => 'Guadeloupe',
			'GUM'  => 'Guam',
			'GTM'  => 'Guatemala',
			'GIN'  => 'Guinea',
			'GNB'  => 'Guinea-bissau',
			'GUY'  => 'Guyana',
			'HTI'  => 'Haiti',
			'HMD'  => 'Heard Island and Mcdonald Islands',
			'VAT'  => 'Holy See (Vatican City State)',
			'HND'  => 'Honduras',
			'HKG'  => 'Hong Kong',
			'HUN'  => 'Hungary',
			'ISL'  => 'Iceland',
			'IND'  => 'India',
			'IDN'  => 'Indonesia',
			'IRN'  => 'Iran, Islamic Republic of',
			'IRQ'  => 'Iraq',
			'IRL'  => 'Ireland',
			'ISR'  => 'Israel',
			'ITA'  => 'Italy',
			'JAM'  => 'Jamaica',
			'JPN'  => 'Japan',
			'JOR'  => 'Jordan',
			'KAZ'  => 'Kazakhstan',
			'KEN'  => 'Kenya',
			'KIR'  => 'Kiribati',
			'PRK'  => 'Korea, Democratic People\'s Republic of',
			'KOR'  => 'Korea, Republic of',
			'KWT'  => 'Kuwait',
			'KGZ'  => 'Kyrgyzstan',
			'LAO'  => 'Lao People\'s Democratic Republic',
			'LVA'  => 'Latvia',
			'LBN'  => 'Lebanon',
			'LSO'  => 'Lesotho',
			'LBR'  => 'Liberia',
			'LBY'  => 'Libyan Arab Jamahiriya',
			'LIE'  => 'Liechtenstein',
			'LTU'  => 'Lithuania',
			'LUX'  => 'Luxembourg',
			'MAC'  => 'Macau China',
			'MKD'  => 'Macedonia, The Former Yugoslav Republic of',
			'MDG'  => 'Madagascar',
			'MWI'  => 'Malawi',
			'MYS'  => 'Malaysia',
			'MDV'  => 'Maldives',
			'MLI'  => 'Mali',
			'MLT'  => 'Malta',
			'MHL'  => 'Marshall Islands',
			'MTQ'  => 'Martinique',
			'MRT'  => 'Mauritania',
			'MUS'  => 'Mauritius',
			'MYT'  => 'Mayotte',
			'MEX'  => 'Mexico',
			'FSM'  => 'Micronesia, Federated States of',
			'MDA'  => 'Moldova, Republic of',
			'MCO'  => 'Monaco',
			'MNG'  => 'Mongolia',
			'MSR'  => 'Montserrat',
			'MAR'  => 'Morocco',
			'MOZ'  => 'Mozambique',
			'MMR'  => 'Myanmar',
			'NAM'  => 'Namibia',
			'NRU'  => 'Nauru',
			'NPL'  => 'Nepal',
			'NLD'  => 'Netherlands',
			'ANT'  => 'Netherlands Antilles',
			'NCL'  => 'New Caledonia',
			'NZL'  => 'New Zealand',
			'NIC'  => 'Nicaragua',
			'NER'  => 'Niger',
			'NGA'  => 'Nigeria',
			'NIU'  => 'Niue',
			'NFK'  => 'Norfolk Island',
			'MNP'  => 'Northern Mariana Islands',
			'NOR'  => 'Norway',
			'OMN'  => 'Oman',
			'PAK'  => 'Pakistan',
			'PLW'  => 'Palau',
			'PAN'  => 'Panama',
			'PNG'  => 'Papua New Guinea',
			'PRY'  => 'Paraguay',
			'PER'  => 'Peru',
			'PHL'  => 'Philippines',
			'PCN'  => 'Pitcairn',
			'POL'  => 'Poland',
			'PRT'  => 'Portugal',
			'PRI'  => 'Puerto Rico',
			'QAT'  => 'Qatar',
			'REU'  => 'Reunion',
			'ROM'  => 'Romania',
			'RUS'  => 'Russian Federation',
			'RWA'  => 'Rwanda',
			'SHN'  => 'Saint Helena',
			'KNA'  => 'Saint Kitts and Nevis',
			'LCA'  => 'Saint Lucia',
			'SPM'  => 'Saint Pierre and Miquelon',
			'VCT'  => 'Saint Vincent and The Grenadines',
			'WSM'  => 'Samoa',
			'SMR'  => 'San Marino',
			'STP'  => 'Sao Tome and Principe',
			'SAU'  => 'Saudi Arabia',
			'SEN'  => 'Senegal',
			'SYC'  => 'Seychelles',
			'SLE'  => 'Sierra Leone',
			'SGP'  => 'Singapore',
			'SVK'  => 'Slovakia',
			'SVN'  => 'Slovenia',
			'SLB'  => 'Solomon Islands',
			'SOM'  => 'Somalia',
			'ZAF'  => 'South Africa',
			'SGS'  => 'South Georgia and The South Sandwich Islands',
			'ESP'  => 'Spain',
			'LKA'  => 'Sri Lanka',
			'SDN'  => 'Sudan',
			'SUR'  => 'Suriname',
			'SJM'  => 'Svalbard and Jan Mayen',
			'SWZ'  => 'Swaziland',
			'SWE'  => 'Sweden',
			'CHE'  => 'Switzerland',
			'SYR'  => 'Syrian Arab Republic',
			'TWN'  => 'Taiwan, Province of China',
			'TJK'  => 'Tajikistan',
			'TZA'  => 'Tanzania, United Republic of',
			'THA'  => 'Thailand',
			'TGO'  => 'Togo',
			'TKL'  => 'Tokelau',
			'TON'  => 'Tonga',
			'TTO'  => 'Trinidad and Tobago',
			'TUN'  => 'Tunisia',
			'TUR'  => 'Turkey',
			'TKM'  => 'Turkmenistan',
			'TCA'  => 'Turks and Caicos Islands',
			'TUV'  => 'Tuvalu',
			'UGA'  => 'Uganda',
			'UKR'  => 'Ukraine',
			'ARE'  => 'United Arab Emirates',
			'GBR'  => 'United Kingdom',
			'USA'  => 'United States',
			'UMI'  => 'United States Minor Outlying Islands',
			'VIR'  => 'U.S. Virgin Islands',
			'URY'  => 'Uruguay',
			'UZB'  => 'Uzbekistan',
			'VUT'  => 'Vanuatu',
			'VEN'  => 'Venezuela',
			'VNM'  => 'Vietnam',
			'WLF'  => 'Wallis and Futuna',
			'ESH'  => 'Western Sahara',
			'YEM'  => 'Yemen',
			'YUG'  => 'Yugoslavia',
			'ZMB'  => 'Zambia',
			'ZWE'  => 'Zimbabwe'
		);
		
		return $countryArray;
	}
	
	protected function getSubscriptionFrequency() {
		$FrequencyOptions = array();
		
	}
}
?>