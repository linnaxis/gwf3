<?php
final class Quest_Redmond_AresDwarf_II extends SR_Quest
{
// 	public function getQuestName() { return 'Punks!'; }
// 	public function getQuestDescription() { return sprintf('Bring %d/%d punk scalps to the Redmond_Ares.', $this->getAmount(), $this->getNeededAmount()); }
	public function getQuestDescription() { return $this->lang('descr', array($this->getAmount(), $this->getNeededAmount())); }
	public function getNeededAmount() { return 25; }
	public function onQuestSolve(SR_Player $player)
	{
		$xp = 7;
		$ny = 1500;
		$this->msg('solved', array(Shadowfunc::displayNuyen($ny), $xp));
// 		$player->message(sprintf('The dwarf cheers and hands you %s. You also gained %s XP.', Shadowfunc::displayNuyen($ny), $xp));
		$player->giveXP($xp);
		$player->giveNuyen($ny);
		
		if (false !== ($scalps = $player->getInvItemByName('PunkScalp')))
		{
			$scalps->deleteItem($player);
		}

		$quest = SR_Quest::getQuest($player, 'Redmond_AresDwarf_I');
		
		if ($quest->isDone($player))
		{
			$this->onSolveDuo($player);
		}
	}
	
	public function onSolveDuo(SR_Player $player)
	{
		$this->msg('solve2a');
		$this->msg('solve2b');
// 		$player->message('The dwarfs look very pleased.');
// 		$player->message('"Thank you so much", Aron says, "For your help we have thought of a special reward..."');
		
		$max = $player->isRunner() ? Shadowcmd_lvlup::MAX_VAL_SKILL_RUNNER : Shadowcmd_lvlup::MAX_VAL_SKILL;
		if ($player->getBase('melee') > $max)
		{
			$player->giveNuyen(5000);
			$this->msg('solve2c');
// 			$player->message('You received another 5000 nuyen!');
		}
		else
		{
			$this->msg('solve2d');
// 			$player->message('Your melee skill has increased by 1.');
			$player->increase('sr4pl_melee', 1);
			$player->modify();
		}
		return true;
		
	}
	
} 
?>