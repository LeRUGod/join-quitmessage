<?php

namespace joinquit;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use TEffectAPI\TEffectAPI;
class Main extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

	}
	public function join(PlayerJoinEvent $event){
		$event->setJoinMessage(false);
		$pl = $event->getPlayer();
		$na = $pl->getName();
		$count = count($this->getServer()->getOnlinePlayers());


		if (!($event->getPlayer()->hasPlayedBefore())){
$this->getServer()->broadcastMessage("§6{$na}§f§l님의 첫 접속! §c다같이 §f환영해주세요!");
}


		if (! $pl->isOP()){
			foreach ( $this->getServer()->getOnlinePlayers() as $player ){
$player->sendTip("§c[§f+§c] §f{$na}(§6{$count}§f명)");
		}
	}


		if ( $pl->isOP()){
			foreach ( $this->getServer()->getOnlinePlayers() as $player ){
$player->sendTip("§c[§f+§c] §6{$na}§f(§6{$count}§f명)");
		}
}


		TEffectAPI::getInstance()->setEffect($pl, 10);
		$event->getPlayer()->addTitle("§c접속§f을 §6환영§f합니다!");
		$event->getPlayer()->addSubTitle("§c{$count}§f명이 §6접속§f중입니다.");
	}

	public function quit(PlayerQuitEvent $event){
		$event->setQuitMessage(false);
		$pl = $event->getPlayer();
		$na = $pl->getName();
		$count = count($this->getServer()->getOnlinePlayers());


		if ( $pl->isOP()){
			foreach ( $this->getServer()->getOnlinePlayers() as $player ){
$player->sendTip("§c[§f-§c] §6{$na}§f(§6{$count}§f명)");
		}
	}


		if (! $pl->isOP()){
			foreach ( $this->getServer()->getOnlinePlayers() as $player ){
$player->sendTip("§c[§f-§c] §f{$na}(§6{$count}§f명)");
			}
		}
	}




	public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool {
		if (strtolower ( $command->getName () ) == "서버퇴장"){
			$player->kick("서버에서 퇴장하셨습니다.\n밴드 가입 부탁드립니다!");
			return true;
		}

	}

}
