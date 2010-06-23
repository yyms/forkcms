<?php

/**
 * BackendUsersAdd
 * This is the add-action, it will display a form to create a new user
 *
 * @package		backend
 * @subpackage	users
 *
 * @author 		Tijs Verkoyen <tijs@netlash.com>
 * @author		Davy Hellemans <davy@netlash.com>
 * @since		2.0
 */
class BackendUsersAdd extends BackendBaseActionAdd
{
	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// load the form
		$this->loadForm();

		// validate the form
		$this->validateForm();

		// parse the datagrid
		$this->parse();

		// display the page
		$this->display();
	}


	/**
	 * Load the form
	 *
	 * @return	void
	 */
	private function loadForm()
	{
		// create form
		$this->frm = new BackendForm('add');

		$groups = BackendUsersModel::getGroups();
		$groupIds = array_keys($groups);
		$defaultGroupId = BackendModel::getSetting('users', 'default_group', $groupIds[0]);

		// create elements
		$this->frm->addText('username', null, 75);
		$this->frm->addPassword('password', null, 75);
		$this->frm->addPassword('confirm_password', null, 75);
		$this->frm->addText('nickname', null, 75);
		$this->frm->addText('email', null, 255);
		$this->frm->addText('name', null, 255);
		$this->frm->addText('surname', null, 255);
		$this->frm->addDropdown('interface_language', BackendLanguage::getInterfaceLanguages());
		$this->frm->addDropdown('date_format', BackendUsersModel::getDateFormats(), BackendAuthentication::getUser()->getSetting('date_format'));
		$this->frm->addDropdown('time_format', BackendUsersModel::getTimeFormats(), BackendAuthentication::getUser()->getSetting('time_format'));
		$this->frm->addImage('avatar');
		$this->frm->addCheckbox('active', true);
		$this->frm->addDropdown('group', $groups, $defaultGroupId);

		// disable autocomplete
		$this->frm->getField('password')->setAttributes(array('autocomplete' => 'off'));
		$this->frm->getField('confirm_password')->setAttributes(array('autocomplete' => 'off'));
	}


	/**
	 * Validate the form
	 *
	 * @return	void
	 */
	private function validateForm()
	{
		// is the form submitted?
		if($this->frm->isSubmitted())
		{
			// cleanup the submitted fields, ignore fields that were added by hackers
			$this->frm->cleanupFields();

			// username is present
			if($this->frm->getField('username')->isFilled(BL::getError('UsernameIsRequired')))
			{
				// only a-z (no spaces) are allowed
				if($this->frm->getField('username')->isAlphaNumeric(BL::getError('AlphaNumericCharactersOnly')))
				{
					// username already exists
					if(BackendUsersModel::existsUsername($this->frm->getField('username')->getValue())) $this->frm->getField('username')->addError(BL::getError('UsernameAlreadyExists'));

					// username doesn't exist
					else
					{
						/*
						 * Some usernames are blacklisted, so we don't allow them. Dieter has asked to be added
						 * to the blacklist, because he's little bitch.
						 */
						if(in_array($this->frm->getField('username')->getValue(), array('admin', 'administrator', 'dieter', 'god', 'netlash', 'root', 'sudo'))) $this->frm->getField('username')->addError(BL::getError('UsernameIsNotAllowed'));
					}
				}
			}

			// required fields
			$this->frm->getField('password')->isFilled(BL::getError('PasswordIsRequired'));
			$this->frm->getField('email')->isEmail(BL::getError('EmailIsInvalid'));
			$this->frm->getField('nickname')->isFilled(BL::getError('NicknameIsRequired'));
			$this->frm->getField('name')->isFilled(BL::getError('NameIsRequired'));
			$this->frm->getField('surname')->isFilled(BL::getError('SurnameIsRequired'));
			$this->frm->getField('interface_language')->isFilled(BL::getError('FieldIsRequired'));
			$this->frm->getField('date_format')->isFilled(BL::getError('FieldIsRequired'));
			$this->frm->getField('time_format')->isFilled(BL::getError('FieldIsRequired'));
			if($this->frm->getField('password')->isFilled())
			{
				if($this->frm->getField('password')->getValue() !== $this->frm->getField('confirm_password')->getValue()) $this->frm->getField('confirm_password')->addError(BL::getError('ValuesDontMatch'));
			}

			// validate avatar
			if($this->frm->getField('avatar')->isFilled())
			{
				// correct extension
				if($this->frm->getField('avatar')->isAllowedExtension(array('jpg', 'jpeg', 'gif'), BL::getError('JPGAndGIFOnly')))
				{
					// correct mimetype?
					$this->frm->getField('avatar')->isAllowedMimeType(array('image/gif', 'image/jpg', 'image/jpeg'), BL::getError('JPGAndGIFOnly'));
				}
			}

			// no errors?
			if($this->frm->isCorrect())
			{
				// build settings-array
				$settings = $this->frm->getValues(array('username', 'password'));
				$settings['password_key'] = uniqid();
				$settings['avatar'] = 'no-avatar.gif';

				// datetime formats
				$settings['date_format'] = $this->frm->getField('date_format')->getValue();
				$settings['time_format'] = $this->frm->getField('time_format')->getValue();
				$settings['datetime_format'] = $settings['date_format'] .' '. $settings['time_format'];

				// build user-array
				$user['username'] = $this->frm->getField('username')->getValue();
				$user['password'] = BackendAuthentication::getEncryptedString($this->frm->getField('password')->getValue(true), $settings['password_key']);
				$user['group_id'] = $this->frm->getField('group')->getValue();

				// save changes
				$user['id'] = (int) BackendUsersModel::insert($user, $settings);

				// does the user submitted an avatar
				if($this->frm->getField('avatar')->isFilled())
				{
					// create new filename
					$filename = rand(0,3) .'_'. $user['id'] .'.'. $this->frm->getField('avatar')->getExtension();

					// add into settings to update
					$settings['avatar'] = $filename;

					// resize (128x128)
					$this->frm->getField('avatar')->createThumbnail(FRONTEND_FILES_PATH .'/backend_users/avatars/128x128/'. $filename, 128, 128, true, false, 100);

					// resize (64x64)
					$this->frm->getField('avatar')->createThumbnail(FRONTEND_FILES_PATH .'/backend_users/avatars/64x64/'. $filename, 64, 64, true, false, 100);

					// resize (32x32)
					$this->frm->getField('avatar')->createThumbnail(FRONTEND_FILES_PATH .'/backend_users/avatars/32x32/'. $filename, 32, 32, true, false, 100);
				}

				// update settings (in this case the avatar)
				BackendUsersModel::update($user, $settings);

				// everything is saved, so redirect to the overview
				$this->redirect(BackendModel::createURLForAction('index') .'&report=added&var='. $user['username'] .'&highlight=userid-'. $user['id']);
			}
		}
	}
}

?>