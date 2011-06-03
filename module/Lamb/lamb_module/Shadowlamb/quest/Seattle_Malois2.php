<?php
final class Quest_Seattle_Malois2 extends SR_Quest
{
	const REWARD_XP = 4;
	
	public function getQuestName() { return 'HelpMalois'; }
	public function getNeededAmount() { return 2000; }
	public function getQuestDescription() { return sprintf('Help Malois and give him %s.', $this->displayNuyen()); }
	
	public function displayNuyen()
	{
		return Shadowfunc::displayPrice($this->getNeededAmount());
	}
	
	public function checkQuest(SR_NPC $npc, SR_Player $player)
	{
		if ($this->isDone($player))
		{
			return false;
		}
		$ny = $this->getNeededAmount();
		if ($player->hasNuyen($ny))
		{
			$player->message(sprintf('You hand Malois %s ...', $this->displayNuyen()));
			$player->giveNuyen(-$ny);
			$npc->reply('Thank you very much my friend. I think i can find out more now.');
			$player->giveXP(self::REWARD_XP);
			$this->onSolve($player);
			return true;
		}
		else
		{
			$npc->reply('Oh, i see you don\'t have enough money :(');
			return true;
		}
	}
	
	public function onNPCQuestTalkB(SR_TalkingNPC $npc, SR_Player $player, $word)
	{
		switch ($word)
		{
			case 'shadowrun':
				$npc->reply('Oh you want to help me again? That is very kind of you :)');
				$npc->reply('Well ... to be honest i am short on nuyen, and i need to hire a decker to get me into level2 of the Renraku office.');
				$npc->reply('If you could give me %s, so i can continue my research ... what do you think?', $this->displayNuyen());
				break;
			
			case 'confirm':
				$npc->reply(sprintf('I think it is of your own interest to know the truth.'));
				break;
				
			case 'yes':
				$npc->reply(sprintf('Yes, it\'s horrible.'));
				break;
				
			case 'no':
				$npc->reply(sprintf('Too bad.'));
				break;
		}
	}
	
	
}
?>
