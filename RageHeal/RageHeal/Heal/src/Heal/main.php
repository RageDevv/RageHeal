<?php

namespace Heal;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as c;
use pocketmine\Player;


class main extends PluginBase{
     public function onEnable(){
          $this->getLogger()->info(c::GREEN. "Heal by Rage as been enabled!");
     }
     public function onCommand(CommandSender $sender, Command $command, $labels, array $args) :bool{
          $cmd = strtolower($command);
          if($cmd == "heal"){  //registers the command
               if($sender->hasPermission("heal.command") && $sender instanceof Player) {
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage(c::YELLOW."You've been healed!");
               }
               if(isset($args[0])){
                    if($sender->hasPermission("heal.other")){
                      $player = $this->getServer()->getPlayer($args[0]);
                      if($player !== null){
                          $player->setHealth($sender->getMaxHealth());
                          $sender->sendMessage(c::YELLOW. "$args[0] has been healed");
                          $player->sendMessage(c::YELLOW. "You have been healed by ". $sender->getName()); //sends messages when healed
                     }else{
                          $sender->sendMessage(c::RED. "Oops, player is not online!");
                     }
                    }
               }
          }
          return true;
     }
     public function onDisable(){
          $this->getLogger()->info(c::RED. "Heal by Rage has been disabled!");
     }
}
