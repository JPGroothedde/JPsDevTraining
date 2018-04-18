<?php
	/**
	 * This file contains the QButtonBase class.
	 *
	 * @package Controls
	 */

	/**
	 * This class will render an HTML Button.
	 *
	 * @package Controls
	 *
	 * @property string $Text is used to display the button's text
	 * @property boolean $PrimaryButton is a boolean to specify whether or not the button is 'primary' (e.g. makes this button a "Submit" form element rather than a "Button" form element)
	 * @property boolean $HtmlEntities
	 * @property boolean $IsToggled is used to display the button's text
	 * @property boolean $IsToggle is used to indicate that this is a toggle button
	 */
	abstract class QButtonBase extends QActionControl {
		///////////////////////////
		// Private Member Variables
		///////////////////////////

		// APPEARANCE
		/** @var string Text on the button  */
		protected $strText = null;
		/** @var bool Whether or not to use Htmlentities for the control */
		protected $blnHtmlEntities = true;

		// BEHAVIOR
		/** @var bool Is the button a primary button (causes form submission)? */
		protected $blnPrimaryButton = false;

		// SETTINGS
		/**
		 * @var bool Prevent any more actions from happening once action has been taken on this control
		 *  causes "event.preventDefault()" to be called on the client side
		 */
		protected $blnActionsMustTerminate = true;
		/**
		 * @var bool Indicate whether this button serves as a toggle
		 *  If so, we can use $blnToggled to check its state
		 */
		protected $blnIsToggle = false;
		/**
		 * @var bool Indicates whether this button is toggled
		 */
		protected $blnIsToggled = false;
		/**
		 * @var string The control's text when it is toggled
		 */
		protected $strToggledPreText = '<i class="fa fa-check-square-o"></i> ';
		/**
		 * @var string The control's text when it is not toggled
		 */
		protected $strUnToggledPreText = '<i class="fa fa-square-o"></i> ';
		/**
		 * @var string The control's text when it is toggled
		 */
		protected $strToggledText;
		/**
		 * @var string The control's text when it is not toggled
		 */
		protected $strUnToggledText;

		//////////
		// Methods
		//////////

		public function __construct($objParentObject, $strControlId = null) {
			parent::__construct($objParentObject,$strControlId);
			$this->strToggledPreText = '<i class="fa fa-check-square-o"></i> ';
			$this->strUnToggledPreText = '<i class="fa fa-square-o"></i> ';
		}
		/**
		 * Return the HTML string for the control
		 * @return string The HTML string of the control
		 */
		protected function GetControlHtml() {
			$strStyle = $this->GetStyleAttributes();
			if ($strStyle)
				$strStyle = sprintf('style="%s"', $strStyle);

			if ($this->blnPrimaryButton)
				$strCommand = "submit";
			else
				$strCommand = "button";

			$strToReturn = sprintf('<button type="%s" name="%s" id="%s" %s%s > %s </button>',
				$strCommand,
				$this->strControlId,
				$this->strControlId,
				$this->GetAttributes(),
				$strStyle,                    
				($this->blnHtmlEntities) ? QApplication::HtmlEntities($this->strText) : $this->strText
			);
  
			return $strToReturn;

		}
		public function Toggle($toggleOn = true) {
			$this->blnIsToggled = $toggleOn;
			if ($this->blnIsToggled)
				$this->Text = $this->strToggledText;
			else
				$this->Text = $this->strUnToggledText;
			$this->Refresh();
		}
		public function setAsToggle($isToggle = true,$toggledText = 'True',$unToggledText = 'False') {
			if (strlen($toggledText) > 0)
				$this->strToggledText = $this->strToggledPreText.$toggledText;
			else
				$this->strToggledText = $this->strToggledPreText.'True';
			if (strlen($unToggledText) > 0)
				$this->strUnToggledText = $this->strUnToggledPreText.$unToggledText;
			else
				$this->strUnToggledText = $this->strUnToggledPreText.'False';

			if ($isToggle) {
				$this->blnHtmlEntities = false;
				$this->strDisplayStyle = QDisplayStyle::Block;
				$this->blnIsToggle = $isToggle;
				$this->blnIsToggled = false;
				$this->Toggle($this->blnIsToggled);
			}
		}

		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		/**
		 * PHP Magic __get method implementation
		 * @param string $strName Name of the property to be fetched
		 *
		 * @return array|bool|int|mixed|null|QControl|QForm|string
		 * @throws Exception|QCallerException
		 */
		public function __get($strName) {
			switch ($strName) {
				// APPEARANCE
				case "Text": return $this->strText;
				case "HtmlEntities": return $this->blnHtmlEntities;

				// BEHAVIOR
				case "PrimaryButton": return $this->blnPrimaryButton;
				case "IsToggle": return $this->blnIsToggle;
				case "IsToggled": return $this->blnIsToggled;
				case "ToggledText": return $this->strToggledText;
				case "UnToggledText": return $this->strUnToggledText;
				case "ToggledPreText": return $this->strToggledPreText;
				case "UnToggledPreText": return $this->strUnToggledPreText;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/////////////////////////
		// Public Properties: SET
		/////////////////////////
		/**
		 * PHP Magic method __set implementation for this class (QButtonBase)
		 * @param string $strName Name of the property
		 * @param string $mixValue Value of the property
		 *
		 * @return mixed
		 * @throws Exception|QCallerException
		 * @throws Exception|QInvalidCastException
		 */
		public function __set($strName, $mixValue) {
			$this->blnModified = true;

			switch ($strName) {
				// APPEARANCE
				case "Text": 
					try {
						$this->strText = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "HtmlEntities":
					try {
						$this->blnHtmlEntities = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "ToggledText":
					try {
						$this->strToggledText = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "UnToggledText":
					try {
						$this->strUnToggledText = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "ToggledPreText":
					try {
						$this->strToggledPreText = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "UnToggledPreText":
					try {
						$this->strUnToggledPreText = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				// BEHAVIOR
				case "PrimaryButton":
					try {
						$this->blnPrimaryButton = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "IsToggle":
					try {
						$this->blnIsToggle = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "IsToggled":
					try {
						$this->blnIsToggled = QType::Cast($mixValue, QType::Boolean);
						$this->Toggle($this->blnIsToggled);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						parent::__set($strName, $mixValue);
						break;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}
?>
