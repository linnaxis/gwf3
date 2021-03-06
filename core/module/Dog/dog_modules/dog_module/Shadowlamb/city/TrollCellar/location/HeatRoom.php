<?php
final class TrollCellar_HeatRoom extends SR_SearchRoom
{
	const KEY = 'troll_heat';
	
	public function getFoundPercentage() { return 50.00; }
	public function getAreaSize() { return 14; }

// 	public function getFoundText(SR_Player $player) { return "You found a room that seems to contain the houses heating equipment."; }
// 	public function getEnterText(SR_Player $player) { return "You enter the heating room. The air is warm and dry, and it smells old."; }
	public function getFoundText(SR_Player $player) { return $this->lang($player, 'found'); }
	public function getEnterText(SR_Player $player) { return $this->lang($player, 'enter'); }
	
	public function getCommands(SR_Player $player)
	{
		return array('heat');
	}
	
	public function on_heat(SR_Player $player, array $args)
	{
		if ($player->hasConst(self::KEY))
		{
			$player->unsetConst(self::KEY);
			return $player->message($this->lang($player, 'heat_off'));
// 			return $player->message('You have totally turned off the heating in this building.');
		}
		else
		{
			$player->setConst(self::KEY, 1);
			return $player->message($this->lang($player, 'heat_on'));
// 			return $player->message('You have totally turned on the heating in this building.');
		}
	}
	
	public function onLeaveLocation(SR_Party $party)
	{
		foreach ($party->getMembers() as $member)
		{
			$member instanceof SR_Player;
			
			# The heat is on?
			if (!$member->hasConst(self::KEY))
			{
				continue;
			}
			
			if (false !== ($milk = $member->getInvItemByName('Milk', false, false)))
			{
				$amt = $milk->getAmount();
				
				if (false !== ($member->deleteFromInventory($milk)))
				{
					$member->message($this->lang($member, 'sour'));
					$member->giveItems(array(SR_Item::createByName('SourMilk', $amt)));
				}
			}
		}
	}
}
?>
