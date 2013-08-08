<?php
class Single extends Page {

	public static $db = array(
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$config = GridFieldConfig_RelationEditor::create(10);
		$config->addComponent(new GridFieldSortableRows('SortOrder'));

		$singlePages = SinglePage::get()
			->filter(array('Parent' => $this->ID));
		$vertical = $singlePages->filter(array('Direction' => 'Vertical'));
		$horizontal = $singlePages->filter(array('Direction' => 'Horizontal'));

		$fields->addFieldToTab('Root.Vertical', new Gridfield('SinglePageVertical', 'SinglePage', $vertical, $config));
		$fields->addFieldToTab('Root.Horizontal', new Gridfield('SinglePagehorizontal', 'SinglePage', $horizontal, $config));

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
	);

	public function init() {
		parent::init();
	}


}

class SinglePage extends DataObject {
	public static $db = array(
		'Parent' => 'Int',
		'Page' => 'Int',
		'Direction' => "Enum('Horizontal, Vertical')",
		'SortOrder' => 'Int'
	);

}
