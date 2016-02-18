<?php

/*
 * HungerGames plugin for PocketMine-MP
 * Copyright (C) 2015 larryTheCoder Team <https://github.com/larryTheCoder/SimpleHungerGamesV1>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
*/

namespace HungerGames;

use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\level\Explosion;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\plugin\Plugin;


class SGcommand extends MiniGameBase {
    
    	public function __construct(HungerGames $plugin) {
		parent::__construct ( $plugin );
	}
	
	/**
	 * onCommand
	 *
	 * @param CommandSender $sender        	
	 * @param Command $command        	
	 * @param unknown $label        	
	 * @param array $args        	
	 * @return boolean
	 */
        
        public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
                if(strtolower($cmd->getName()) == "sg"){
                    if(isset($args[0])){
                        if($sender instanceof Player){
                        switch(strtolower($args[0])){
                            case "join":
                            if(!$sender->hasPermission("SurvivalGames.command.help")){
                                    $sender->sendMessage("§4You Don't Have Permission to do this!");
                                    break;
                                }
                            if(!isset($args[1]) || isset($args[2])){
                                $sender->sendMessage(TextFormat::YELLOW."use /sg join [arena]");
                                    break;
                                }
                                    if($this->plugin->getPlayerArena($sender)){
                                $sender->sendMessage($this->plugin->messagesManager()->getMsg("already_ingame"));
                                    break;
                                }
                                if(!($arena = $this->plugin->getArena($args[1]))){
                                    $sender->sendMessage("game_doesnt_exist");
                                    break;
                                }
                                    $arena->joinToArena($sender);
                                    break;
                            case "kick": // sg kick [arena] [player] [reason]
                                if(!$sender->hasPermission('SurvivalGames.command.kick')){
                                    $sender->sendMessage("§4You Don't Have Permission to do this!");
                                    break;
                                }
                                if(!isset($args[2]) || isset($args[4])){
                                    $sender->sendMessage($this->getPrefix().$this->getMsg('kick_help'));
                                    break;
                                }
                                if(!isset(array_merge($this->ins[$args[1]]->ingamep, $this->ins[$args[1]]->lobbyp, $this->ins[$args[1]]->spec)[strtolower($args[2])])){
                                    $sender->sendMessage($this->getPrefix().(""));
                                    break;
                                }
                                if(!isset($args[3])){
                                    $args[3] = "";
                                }
                                $this->ins[$args[1]]->kickPlayer($args[2], $args[3]);
                                break;
                            
                        }
                        return;                        
                        }
                        $sender->sendMessage('run command only in-game');
                        return;                        
                        }
                }           
        }    
}
