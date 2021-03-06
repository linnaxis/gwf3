<?php
final class Shadowcmd_cast extends Shadowcmd
{
	public static function isCombatCommand() { return true; }
	
	public static function execute(SR_Player $player, array $args)
	{
		if (count($args) === 0)
		{
			Shadowcmd_known_spells::execute($player, array());
			return false;
		}
		
		$sn = array_shift($args);
		$wanted_level = Common::substrFrom($sn, ':', true);
		$sn = Common::substrUntil($sn, ':', $sn);
		
		if (false === ($spell = $player->getSpell($sn)))
		{
			$player->msg('1048');
//			self::rply($player, '1048');
// 			$player->message(sprintf('You don\'t know the %s spell.', $sn));
			return false;
		}
		
		$spell->setMode(SR_Spell::MODE_SPELL);
		return $spell->onCast($player, $args, $wanted_level);
	}
}
?>
