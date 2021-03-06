<?php
final class Hideout_Room1 extends SR_Location
{
	public function getAreaSize() { return 12; }
	public function getFoundPercentage() { return 100; }
	
// 	public function getFoundText(SR_Player $player) { return 'You found another room. You hear voices from the inside.'; }
// 	public function getEnterText(SR_Player $player) { return 'You enter the room and see three punks playing cards. They attack!'; }
	
	public function getFoundText(SR_Player $player) { return $this->lang($player, 'found'); }
	public function getEnterText(SR_Player $player) { return $this->lang($player, 'enter'); }
	
	public function onEnter(SR_Player $player)
	{
		if (parent::onEnter($player))
		{
			$party = $player->getParty();
			SR_NPC::createEnemyParty('Redmond_Cyberpunk','Redmond_Cyberpunk','Redmond_Cyberpunk')->fight($party, true);
		}
		return true;
	}
}
?>
