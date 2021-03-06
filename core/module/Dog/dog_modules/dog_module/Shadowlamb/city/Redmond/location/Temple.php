<?php
final class Redmond_Temple extends SR_School
{
	public function getRealNPCS() { return array('Redmond_Beggar'); }
	public function getNPCS(SR_Player $player) { return array('talk' => 'Redmond_Teacher'); }
	public function getFoundPercentage() { return 60.00; }
// 	public function getFoundText(SR_Player $player) { return 'A bit outside of the town you can spot an old Temple. Maybe there is still some life in there.'; }
// 	public function getEnterText(SR_Player $player) { return 'You enter the Temple. You see an elve in a white robe coming towards you.'; }
// 	public function getHelpText(SR_Player $player) { $c = Shadowrun4::SR_SHORTCUT; return "You can use {$c}learn or {$c}courses here to see the skill(s) to learn. You can also {$c}talk to the elve."; }
	public function getFoundText(SR_Player $player) { return $this->lang($player, 'found'); }
	public function getEnterText(SR_Player $player) { return $this->lang($player, 'enter'); }
	
	public function getFields(SR_Player $player)
	{
		$p = $player->getTemp(Redmond_Teacher::TEMP_PISSED, 0) * 150;
		return array(
			array('magic', 1000+$p),
			array('calm', 2000+$p),
			array('goliath', 1000+$p),
			array('hawkeye', 1000+$p),
			array('hummingbird', 1500+$p),
			array('turtle', 2500+$p),
			array('firebolt', 1500+$p),
		);
	}
	
	public function onEnter(SR_Player $player)
	{
		$c = Shadowrun4::SR_SHORTCUT;
		$b = chr(2);
		parent::onEnter($player);
		$p = $player->getParty();
		
		foreach ($p->getMembers() as $member)
		{
			$member instanceof SR_Player;
			$member->unsetTemp(Redmond_Teacher::TEMP_PISSED);
		}
		
		$p->notice("The elve says: \"Hi, do you want to {$b}{$c}learn{$b} the arcane powers of {$b}magic{$b}?\"");
	}
}
?>