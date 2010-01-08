<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


class FormCondition extends Widget
{

	/**
	 * Submit user input
	 * @var boolean
	 */
	protected $blnSubmitInput = true;
	

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'form_condition';
	
	
	/**
	 * Add specific attributes
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		switch ($strKey)
		{
			case 'value':
				$this->varValue = strlen($varValue) ? true : false;
				break;
				
			case 'options':
				break;

			default:
				parent::__set($strKey, $varValue);
				break;
		}
	}
	
	
	/**
	 * Do not check stop fields.
	 * 
	 * @access protected
	 * @param mixed $varInput
	 * @return mixed
	 */
	protected function validator($varInput)
	{
		if ($this->conditionType == 'stop')
		{
			$this->mandatory = false;
			$this->blnSubmitInput = false;
		}
		
		return parent::validator($varInput);
	}
	
	
	public function generate()
	{
		return sprintf('<input type="hidden" name="%s" value="0" /><input type="checkbox" name="%s" id="opt_%s" class="checkbox" value="1" onclick="if(this.checked) { $(\'condition_%s\').style.display=\'block\'; } else { $(\'condition_%s\').style.display=\'none\'; }"%s%s /> <label for="opt_%s">%s</label>',
						$this->strName,
						$this->strName,
						$this->strId,
						$this->strName,
						$this->strName,
						($this->varValue ? ' checked="checked"' : ''),
						$this->getAttributes(),
						$this->strId,
						$this->label);
	}
	
}

