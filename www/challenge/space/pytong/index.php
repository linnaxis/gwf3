<?php
$solution = require 'pytong_solution.php';
chdir('../../../');
define('GWF_PAGE_TITLE', 'Py-Tong');
require_once('challenge/html_head.php');
require_once GWF_CORE_PATH.'module/WeChall/solutionbox.php';
if (false === ($chall = WC_Challenge::getByTitle(GWF_PAGE_TITLE)))
{
	$chall = WC_Challenge::dummyChallenge(GWF_PAGE_TITLE, 2, 'challenge/space/pytong/index.php', $solution);
}
$chall->showHeader();
$chall->onCheckSolution();

# First link is to warchall begins so people know where to create warbox account.
echo GWF_Box::box($chall->lang('info', array(GWF_WEB_ROOT.'challenge/warchall/begins/index.php', 'index.php?highlight=christmas')), $chall->lang('title'));

$filename = 'challenge/space/pytong/pytong.py';
if (Common::getGetString('highlight') === 'christmas')
{
	$message = '[code lang=python title=pytong.py]'.file_get_contents($filename).'[/code]';
	echo GWF_Message::display($message);
}

formSolutionbox($chall);
echo $chall->copyrightFooter();
require_once('challenge/html_foot.php');
?>
