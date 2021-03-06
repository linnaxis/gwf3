<?php
final class WeChall_SiteDescr extends GWF_Method
{
	private $site;
	
	public function isLoginRequired() { return true; }
	public function execute()
	{
		if (false !== ($errors = $this->sanitize())) {
			return GWF_HTML::error('WC4', $errors, true);
		}
		
		require_once GWF_CORE_PATH.'module/WeChall/WC_SiteDescr.php';
		
		if (false !== Common::getPost('add'))  {
			return $this->onAdd().$this->templateDescr();
		}
		if (false !== Common::getPost('edit')) {
			return $this->onEdit().$this->templateDescr();
		}
		if (false !== Common::getPost('delete')) {
			return $this->onDelete().$this->templateDescr();
		}
		if (false !== Common::getPost('default')) {
			return $this->onDefault().$this->templateDescr();
		}
		
		return $this->templateDescr();
	}
	
	private function sanitize()
	{
		if (false === ($this->site = WC_Site::getByID(Common::getGetInt('siteid', 0)))) {
			return array($this->module->lang('err_site'));
		}
		
		require_once GWF_CORE_PATH.'module/WeChall/WC_SiteAdmin.php';
		if ( (!WC_SiteAdmin::isSiteAdmin(GWF_Session::getUserID(), $this->site->getID())) && (!GWF_User::isAdminS()) ) {
			return array(GWF_HTML::lang('ERR_NO_PERMISSION'));
		}
		return false;
	}
	
	private function templateDescr()
	{
		$descr = WC_SiteDescr::getDescriptions($this->site->getID());
		$form_new = $this->getFormNew($descr);
		$tVars = array(
			'descrs' => $descr,
			'forms_edit' => $this->getFormsEdit($descr),
			'form_new' => $form_new->templateY($this->module->lang('ft_add_descr')),
		);
		return $this->module->templatePHP('site_edit_descr.php', $tVars);
	}
	
	private function getFormNew(array $descr)
	{
		$data = array(
			'langid' => array(GWF_Form::SELECT, GWF_LangSelect::single(0, 'langid', Common::getPostInt('langid')), $this->module->lang('th_site_language')),
			'descr_new' => array(GWF_Form::MESSAGE, '', $this->module->lang('th_site_description')),
			'add' => array(GWF_Form::SUBMIT, $this->module->lang('btn_add')),
		);
		return new GWF_Form($this, $data);
	}
	
	private function getFormsEdit(array $descr)
	{
		unset($_POST['descr']);
		$back = array();
		foreach ($descr as $langid => $desc)
		{
			$langname = GWF_Language::getByID($langid)->getVar('lang_name');
			$form = $this->getFormEdit($langid, $desc);
			$back[] = $form->templateY($this->module->lang('ft_edit_descr', array($langname)));
		}
		return $back;
	}
	
	private function getFormEdit($langid, $desc)
	{
		$buttons = array(
			'edit['.$langid.']' => $this->module->lang('btn_edit'),
			'default['.$langid.']' => $this->module->lang('btn_set_default'),
			'delete['.$langid.']' => $this->module->lang('btn_delete'),
		);
		
		$default = $this->site->getVar('site_descr_lid');
		$is_def = $default == $langid ? GWF_HTML::lang('yes') : GWF_HTML::lang('no');
		$langname = GWF_Language::getByID($langid)->displayName();
		$data = array(
			'default' => array(GWF_Form::HEADLINE, $is_def, $this->module->lang('th_is_default')),
			'langid' => array(GWF_Form::HEADLINE, $langname, $this->module->lang('th_site_language')),
			'descr' => array(GWF_Form::MESSAGE, $desc, $this->module->lang('th_site_description')),
			'btns' => array(GWF_Form::SUBMITS, $buttons),
		);
		return new GWF_Form($this, $data);
	}
	
	### Validators ###
	public function validate_langid(Module_WeChall $m, $arg) { return GWF_LangSelect::validate_langid($arg, false); }
	public function validate_descr(Module_WeChall $m, $arg) { return GWF_Validator::validateString($m, 'descr', $arg, 12, 4096); } 
	public function validate_descr_new(Module_WeChall $m, $arg) { return GWF_Validator::validateString($m, 'descr_new', $arg, 12, 4096); } 
	
	private function onAdd()
	{
		$descr = WC_SiteDescr::getDescriptions($this->site->getID());
		$form = $this->getFormNew($descr);
		if (false !== ($error = $form->validate($this->module))) {
			return $error;
		}
		
		$langid = $form->getVar('langid');
		if (isset($descr[$langid])) {
			return $this->module->error('err_dup_descr');
		}
		
		if (false === WC_SiteDescr::insertDescr($this->site->getID(), $langid, $form->getVar('descr_new'))) {
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}

		return $this->module->message('msg_add_descr');
	}
	
	private function getPostLangID($field)
	{
		if (false === ($lid = Common::getPostArray($field, false))) {
			return false;
		}
		unset($_POST[$field]);
		
		$lid = key($lid);
		if (false === GWF_Language::getByID($lid)) {
			return false;
		}
		return (int)$lid;
	}
		
	private function onEdit()
	{
		if (false === ($langid = $this->getPostLangID('edit'))) {
			return GWF_HTML::err('ERR_UNKNOWN_LANGUAGE');
		}
		$form = $this->getFormEdit($langid, '');
		if (false !== ($error = $form->validate($this->module))) {
			return $error;
		}
		
		if (false === WC_SiteDescr::insertDescr($this->site->getID(), $langid, $form->getVar('descr'))) {
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}
		
		return $this->module->message('msg_edit_descr');
	}

	private function onDelete()
	{
		if (false === ($langid = $this->getPostLangID('delete'))) {
			return GWF_HTML::err('ERR_UNKNOWN_LANGUAGE');
		}
		$form = $this->getFormEdit($langid, '');
		if (false !== ($error = $form->validate($this->module))) {
			return $error;
		}
		if ($langid == $this->site->getVar('site_descr_lid')) {
			return $this->module->error('err_del_default_descr');
		}
		
		if (false === WC_SiteDescr::deleteDescr($this->site->getID(), $langid)) {
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}
		return $this->module->message('msg_del_descr');
	}
	
	private function onDefault()
	{
		if (false === ($langid = $this->getPostLangID('default'))) {
			return GWF_HTML::err('ERR_UNKNOWN_LANGUAGE');
		}
		$form = $this->getFormEdit($langid, '');
		if (false !== ($error = $form->validate($this->module))) {
			return $error;
		}
		
		if ($this->site->getVar('site_descr_lid') == $langid) {
			return '';
		}
		
		$descr = WC_SiteDescr::getDescriptions($this->site->getID());
		if (!isset($descr[$langid])) {
			return $this->module->error('err_no_descr');
		}
		
		if (false === $this->site->saveVars(array(
			'site_descr_lid' => $langid,
//			'site_description' => $descr[$langid],
		))) {
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}
		
		return $this->module->message('msg_def_descr', array(GWF_Language::getByID($langid)->displayName()));
	}
}
?>