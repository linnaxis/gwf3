<?php
$bot instanceof Lamb;
$server instanceof Lamb_Server; # 1
#$from # from 2
$origin = $args[0]; # origin 3
$message = trim($args[1]); # msg 4

//if (false === ($user = $server->getUserFromOrigin($from, $origin)))
if ( (false === ($user = $server->getUserFromOrigin($from))) && (false === ($user = $server->getUserByNickname($from))) )
{
	return Lamb_Log::logError(sprintf('Cannot getUserFromOrigin(%s, %s) onPrivmsg on server %s.', $from, $origin, $server->getHostname()));
}

$bot->setCurrentUser($user);

############################
### Anonet IRC-Cloud Fix ###
############################
# Ignore anonetworks where the bot is also online and which are linked via irc-cloud protocol (thx srn) 
if (Lamb_User::isOnAnonetS($server->getBotsNickname()))
{
	$ignored_anonet_links = array('HackInt');
	if (in_array($user->getAnonetPrefix(), $ignored_anonet_links))
	{
		return; 
	}
}

if ($server->isLogging())
{
	Lamb_Log::logChat($server, $message);
}

if (Common::startsWith($message, LAMB_TRIGGER))
{
	$bot->onTrigger($server, $user, $from, $origin, $message);
}
else
{
	$bot->onPrivmsg($server, $user, $from, $origin, $message);
}
?>