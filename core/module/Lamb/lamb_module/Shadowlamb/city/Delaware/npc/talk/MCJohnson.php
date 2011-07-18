<?php
final class Delaware_MCJohnson extends SR_TalkingNPC
{
	public function getName() { return 'Mr.Johnson'; }
	public function getNPCQuests(SR_Player $player) { return array('Delaware_MCJohnson1','Delaware_MCJohnson2'); }
	public function onNPCTalk(SR_Player $player, $word, array $args)
	{
		if ($this->onNPCQuestTalk($player, $word, $args))
		{
			return true;
		}
		
		$b = chr(2);
		switch ($word)
		{
			case 'bounty':
				if ($this->onNPCBountyTalk($player, $word, $args))
				{
					return true;
				}
				return $this->reply('You want to become a bountyhunter?');
				
			default:
				$this->reply("Yo chummer");
				return true;
		}
		
	}
}
?>