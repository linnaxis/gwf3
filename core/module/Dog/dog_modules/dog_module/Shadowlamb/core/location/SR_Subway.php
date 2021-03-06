<?php
abstract class SR_Subway extends SR_Location
{
	public function getAbstractClassName() { return __CLASS__; }
	
	# array(array($target, $price, $time, $level))
	public abstract function getSubwayTargets(SR_Player $player);
	
	public function getLeaderCommands(SR_Player $player) { return array_merge(parent::getLeaderCommands($player), array('travel')); }
	
	public function getFoundText(SR_Player $player)
	{
		return $player->lang('stub_found_subway', array($this->getCity()));
	}
	
	public function getEnterText(SR_Player $player)
	{
		return $player->lang('stub_enter_subway');
	}
	
	public function calcTicketPrice($price, SR_Player $player)
	{
		$neg = Common::clamp($player->get('negotiation'), 0, 10) * 0.01;
		$mc = $player->getParty()->getMemberCount();
		$price = $price * $mc;
		$price = $price * (1.0 - $neg);
		return $price;
	}
	
	private function getSubwayTarget(SR_Player $player, $arg)
	{
		$targets = $this->getFilteredTargets($player);
		
		if (is_numeric($arg))
		{
			$arg = (int)$arg;
			if ($arg < 1 || $arg > count($targets)) {
				return false;
			}
			$arg--;
			list($target, $price, $time) = $targets[$arg];
			return array($target, $this->calcTicketPrice($price, $player), $time);
		}
		
		$arg = strtolower($arg);
		foreach ($targets as $target)
		{
			list($target, $price, $time) = $target;
			
			if (strtolower($target) === $arg)
			{
				return array($target, $this->calcTicketPrice($price, $player), $time);
			}
		}
		return false;
	}

	private function getFilteredTargets(SR_Player $player)
	{
		$back = array();
		$targets = $this->getSubwayTargets($player);
		$party = $player->getParty();
		foreach ($targets as $data)
		{
			list($target, $price, $time, $level) = $data;
			if ($level <= $party->getMin('level', true))
			{
				$back[] = $data;
			}
		}
		return $back;
	}
	
	private function showSubwayTargets(SR_Player $player)
	{
		$bot = Shadowrap::instance($player);
		$out = '';
		$format = $player->lang('fmt_sumlist');
		foreach ($this->getFilteredTargets($player) as $i => $data)
		{
			list($target, $price, $time, $level) = $data;
			$dprice = Shadowfunc::displayNuyen($price);
			$out .= sprintf($format, $i+1, $target, $dprice);
// 			$out .= sprintf(', %s:%s(%s)', $i+1, $target, $price);
		}
		
		if ($out === '')
		{
			return $bot->rply('1152');
// 			$out = 'There are no trains planned for today.';
		}
		
		return $bot->rply('5259', array(ltrim($out, ',; ')));
		
// 		else {
// 			$out = substr($out, 2);
// 		}
		
// 		$bot->reply($out);
	}
	
	public function on_travel(SR_Player $player, array $args)
	{
		$bot = Shadowrap::instance($player);
		$party = $player->getParty();
		$c = Shadowrun4::SR_SHORTCUT;
		
		if (count($args) === 0)
		{
			$this->showSubwayTargets($player);
			return true;
		}
		
		if (false === ($target = $this->getSubwayTarget($player, $args[0])))
		{
			$bot->rply('1153');
// 			$bot->reply("This target is unknown. Check available targets with {$c}travel.");
			return false;
		}
		
		list($target, $price, $time) = $target;
		$dp = Shadowfunc::displayNuyen($price);
		if (false === ($player->pay($price)))
		{
			$bot->rply('1154', array($party->getMemberCount(), $dp));
// 			$bot->reply(sprintf('You can not afford %d tickets for %s', $party->getMemberCount(), $dp));
			return false;
		}
		
		$party->ntice('5200', array($player->getName(), $dp, $target, GWF_Time::humanDuration($time)));
// 		$party->message($player, " paid the price of $dp and you take the next train to $target. ETA: $eta");
		$party->pushAction(SR_Party::ACTION_TRAVEL, $target, $time);
		
		return true;
	}
	
	public function checkLocation()
	{
		foreach ($this->getSubwayTargets(Shadowrun4::getDummyPlayer()) as $data)
		{
			$target = $data[0];
			if (false === ($location = Shadowrun4::getLocationByTarget($target)))
			{
				die(sprintf('The subway %s has an invalid target: %s.', $this->getName(), $target));
			}
		}
	}
}
?>