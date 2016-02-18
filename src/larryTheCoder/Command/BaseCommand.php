<?php
/**
 * Created by NetBeansIDE.
 * User: larrythecoder
 * Date: 18. 2. 2016
 * Time: 10:42
 */

namespace SurvivalGames\Command;


use pocketmine\command\Command;
use pocketmine\command\PluginIdentifiableCommand;
use SurvivalGames\SurvivalGames;

abstract class BaseCommand extends Command implements PluginIdentifiableCommand{

    private $plugin;

    private $consoleUsageMessage;

    public function __construct(SurvivalGames $plugin, $name, $description = "", $usageMessage = null, $consoleUsageMessage = null, array $aliases = []){
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->plugin = $plugin;
        $this->consoleUsageMessage = $consoleUsageMessage;
    }

    public function getPlugin(){
        return $this->plugin;
    }
}
