<?php
class Single extends Page {

	public static $db = array(
		'Test' => 'Varchar'
	);

	public static $has_many=array(
		'TestObjects'=>'TestObject'
	);

	public function getCMSFields() {
		Requirements::css('single/css/single.css');
		Requirements::javascript('single/javascript/single.js');
		$id = 1;
		$blockHtml = '<div id="pageBlock" class="pageBlock"></div>';
		$blockHtml .= '<div id="blockMiddle" class="middleBlock" data-id="' . $id++ . '"></div>';
		$blockHtml .= '<div id="blockTop" class="topBlock" data-id ="' . $id++ . '"></div>';
		$blockHtml .= '<div id="blockRight" class="rightBlock" data-id="' . $id++ . '"></div>';
		$blockHtml .= '<div id="blockBottom" class="bottomBlock" data-id="' . $id++ . '"></div>';
		$blockHtml .= '<div id="blockLeft" class="leftBlock" data-id="' . $id . '"></div>';
		$blocks = new LiteralField('Blocks', $blockHtml);
		$fields = new FieldList($blocks);

		$fields->push( $tree = new TreeDropdownField('Pages', 'Pages', 'SiteTree'));
		$tree->extraClass('TreeDropdown');

		return $fields;
	}

}
class Single_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
		'singlePageUpdate'
	);

	public function init() {
		parent::init();

		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still work
		Requirements::themedCSS('reset');
		Requirements::themedCSS('layout'); 
		Requirements::themedCSS('typography'); 
	}

	public function singlePageUpdate() {
		$ajax = (int)$this->request->getVar('ajax');
		$blockID = (int)$this->request->getVar('blockID');
		$pageID = (int)$this->request->getVar('pageID');
		$block = SinglePage::get()->filter(array('Block' => $blockID))->First();
		if ($block) {
		} else {
			$block = new SinglePage();
		}
		$block->Block = $blockID;
		$block->Page = $pageID;
		$block->write();
	}

}

class SinglePage extends DataObject {
	public static $db=array(
		'Block' => 'Int',
		'Page' => 'Int'
	);

}
