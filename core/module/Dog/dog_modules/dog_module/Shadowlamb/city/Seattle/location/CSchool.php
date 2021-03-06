<?php
final class Seattle_CSchool extends SR_School
{
	public function getNPCS(SR_Player $player) { return array('talk' => 'Seattle_Caesum'); }
	public function getFoundPercentage() { return 20.00; }

// 	public function getFoundText(SR_Player $player) { return "You find a small school \"Caesums school of cryptography and applied math\". You wonder if you should improve your math skills."; }
// 	public function getEnterText(SR_Player $player) { return "You enter the school."; }
// 	public function getHelpText(SR_Player $player) { $c = Shadowrun4::SR_SHORTCUT; return "You can use {$c}talk, {$c}learn and {$c}courses here."; }
	
	public function getFoundText(SR_Player $player) { return $this->lang($player, 'found'); }
	public function getEnterText(SR_Player $player) { return $this->lang($player, 'enter'); }
	public function getHelpText(SR_Player $player) { return $this->lang($player, 'help'); }
	
	public function getFields(SR_Player $player)
	{
		return array(
			array('math', 5000),
			array('crypto', 5000),
			array('stegano', 5000),
		);
	}
}
?>