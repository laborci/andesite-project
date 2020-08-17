<?php namespace Application\AdminCodex\Form;

use Andesite\Codex\Form\Dictionary\Dictionary;
use Andesite\Codex\Form\Field;
use Andesite\Codex\Form\FormDecorator;
use Andesite\Codex\Form\FormHandler\FormHandler;
use Andesite\Codex\Form\ListHandler\ListHandler;
use Andesite\Codex\Interfaces\ItemDataImporterInterface;
use Application\AdminCodex\GhostHelper\Cxh_User;
use Application\Component\Constant\Permission\Role;

class Cdx_User extends Cxh_User{

	protected function decorator(FormDecorator $decorator){
		$decorator->setIcons('fal fa-user-md');
		$decorator->setTitle('Felhasználók');
		$decorator->setRole(Role::Admin);
	}

	protected function listHandler(ListHandler $list){
		$list->addJSPlugin('ListButtonAddNew');
		$list->add($this->id)->visible(false);
		$list->add($this->email);
		$list->add($this->groups)->dictionary(new Dictionary($this->groups->options));
	}

	protected function formHandler(FormHandler $form){
		$form->setLabelField($this->name);
		$form->addJSPlugin('FormButtonSave', 'FormButtonDelete', 'FormButtonReload');
		$form->addJSPlugin('FormButtonFiles');

		$form->setItemDataImporter(new class implements ItemDataImporterInterface{
			public function importItemData($item, $data){
				/** @var \Application\Ghost\User $item */
				$item->import($data);
				if ($data['newpassword']) $item->password = $data['newpassword'];
				return $item;
			}
		});

		$form->addAttachmentCategory($this->avatar);

		$main = $form->section('Adatok');
		$main->input('string', $this->name);
		$main->input('string', $this->email);
		$main->input('string', new Field('newpassword'), 'új jelszó');
		$main->input('checkboxes', $this->groups)
		('options', $this->groups->options);
	}


}
