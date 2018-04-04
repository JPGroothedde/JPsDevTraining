<?php
	/**
 	 * @package Controls
 	 */
    class QTextBox extends QTextBoxBase {
        ///////////////////////////
        // TextBox Preferences
        ///////////////////////////

        // Feel free to specify global display preferences/defaults for all QTextBox controls
        /** @var string Default CSS class for the textbox */
        protected $strCssClass = 'form-control';
    //		protected $strFontNames = QFontFamily::Verdana;
    //		protected $strFontSize = '12px';
    //		protected $strWidth = '250px';
        protected $blnRenderAsInputGroup = false;
        protected $blnInputGroupIsButton = false;
        protected $txtInputGroupBefore;
        protected $txtInputGroupAfter;

        public function RenderAsInputGroup($inputGroup = true,$strTextBefore = null,$strTextAfter = null,$blnInputGroupIsButton = false) {
            $this->blnRenderAsInputGroup = $inputGroup;
            $this->txtInputGroupBefore = $strTextBefore;
            $this->txtInputGroupAfter = $strTextAfter;
            $this->blnInputGroupIsButton = $blnInputGroupIsButton;
        }

        protected function GetControlHtml() {
            $strStyle = $this->GetStyleAttributes();
            if ($strStyle)
                $strStyle = sprintf('style="%s"', $strStyle);

            $wrappedStrToReturn = '';
            if ($this->blnRenderAsInputGroup) {
                $wrappedStrToReturn .= '<div class="input-group">';
                if ($this->txtInputGroupBefore) {
                    if ($this->blnInputGroupIsButton)
                        $wrappedStrToReturn .= '<span class="input-group-btn" id="'.$this->getJqControlId().'_addonBefore">'.$this->txtInputGroupBefore.'</span>';
                    else
                        $wrappedStrToReturn .= '<span class="input-group-addon" id="'.$this->getJqControlId().'_addonBefore">'.$this->txtInputGroupBefore.'</span>';
                }
            }
            switch ($this->strTextMode) {
                case QTextMode::MultiLine:
                    $strToReturn = sprintf('<textarea name="%s" id="%s" %s%s>' . $this->strFormat . '</textarea>',
                        $this->strControlId,
                        $this->strControlId,
                        $this->GetAttributes(),
                        $strStyle,
                        QApplication::HtmlEntities($this->strText));
                    break;
                case QTextMode::Password:
                    $strToReturn = sprintf('<input type="password" name="%s" id="%s" value="' . $this->strFormat . '" %s%s />',
                        $this->strControlId,
                        $this->strControlId,
                        QApplication::HtmlEntities($this->strText),
                        $this->GetAttributes(),
                        $strStyle);
                    break;
                case QTextMode::DateTime:
                    $strToReturn = sprintf('<input type="datetime" name="%s" id="%s" value="' . $this->strFormat . '" %s%s />',
                        $this->strControlId,
                        $this->strControlId,
                        QApplication::HtmlEntities($this->strText),
                        $this->GetAttributes(),
                        $strStyle);
                    break;
                case QTextMode::Number:
                    $strToReturn = sprintf('<input type="number" name="%s" id="%s" value="' . $this->strFormat . '" %s%s />',
                        $this->strControlId,
                        $this->strControlId,
                        QApplication::HtmlEntities($this->strText),
                        $this->GetAttributes(),
                        $strStyle);
                    break;
                case QTextMode::Date:
                    $strToReturn = sprintf('<input type="Date" name="%s" id="%s" value="' . $this->strFormat . '" %s%s />',
                        $this->strControlId,
                        $this->strControlId,
                        QApplication::HtmlEntities($this->strText),
                        $this->GetAttributes(),
                        $strStyle);
                    break;
                case QTextMode::Email:
                    $strToReturn = sprintf('<input type="email" name="%s" id="%s" value="' . $this->strFormat . '" %s%s />',
                        $this->strControlId,
                        $this->strControlId,
                        QApplication::HtmlEntities($this->strText),
                        $this->GetAttributes(),
                        $strStyle);
                    break;
                case QTextMode::SingleLine:
                case QTextMode::Search:
                default:
                    $typeStr = $this->strTextMode == QTextMode::Search ? 'search' : 'text';
                    $strToReturn = sprintf('<input type="%s" name="%s" id="%s" value="' . $this->strFormat . '" %s%s />',
                        $typeStr,
                        $this->strControlId,
                        $this->strControlId,
                        QApplication::HtmlEntities($this->strText),
                        $this->GetAttributes(),
                        $strStyle);
            }
            $wrappedStrToReturn .= $strToReturn;
            if ($this->blnRenderAsInputGroup) {
                if ($this->txtInputGroupAfter) {
                    if ($this->blnInputGroupIsButton)
                        $wrappedStrToReturn .= '<span class="input-group-btn" id="'.$this->getJqControlId().'_addonAfter">'.$this->txtInputGroupAfter.'</span>';
                    else
                        $wrappedStrToReturn .= '<span class="input-group-addon" id="'.$this->getJqControlId().'_addonAfter">'.$this->txtInputGroupAfter.'</span>';
                }

                $wrappedStrToReturn .= '</div>';
            }
            return $wrappedStrToReturn;
        }
    }
?>